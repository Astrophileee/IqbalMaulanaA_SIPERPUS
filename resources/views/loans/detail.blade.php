@extends('layouts.app')

@section('title', 'Loan Details')

@section('content')

<div class="mt-4">
    <a href="{{ route('loans.index') }}" class="text-black font-bold py-2 px-4 ">
        < Back to Loans
    </a>
    <a href="{{ route('loans.detailPdf', $loan->id) }}" class="ml-5">
        <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
            <i class="fa-solid fa-file-pdf"></i> Print Pdf
        </button>
    </a>
    <h1 class="text-2xl font-bold">Loan Details</h1>
    <div class="mt-6 bg-white p-6 rounded-lg shadow">
        <table class="table-auto w-full text-sm">
            <tr class="border-b">
                <th class="text-left px-4 py-2 w-1/3">Librarian</th>
                <td class="px-4 py-2">{{ $loan->user ? $loan->user->name : 'No librarian assigned' }}</td>
            </tr>
            <tr class="border-b">
                <th class="text-left px-4 py-2">Member</th>
                <td class="px-4 py-2">{{ $loan->member ? $loan->member->name : 'No member assigned' }}</td>
            </tr>
            <tr class="border-b">
                <th class="text-left px-4 py-2">Loan Date</th>
                <td class="px-4 py-2">{{ $loan->date }}</td>
            </tr>
            <tr class="border-b">
                <th class="text-left px-4 py-2">Return Deadline</th>
                <td class="px-4 py-2">{{ $loan->return_at }}</td>
            </tr>
            <tr class="border-b">
                <th class="text-left px-4 py-2">Return Time</th>
                <td class="px-4 py-2">
                @if ($loan->status === 'borrowed')
                    -
                @elseif ($loan->status === 'returned')
                    {{ $loan->updated_at->format('Y-m-d H:i:s') }}
                @else
                    -
                @endif
                </td>
            </tr>
            <tr class="border-b">
                <th class="text-left px-4 py-2">Status</th>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded text-white {{ $loan->status === 'returned' ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ ucfirst($loan->status) }}
                    </span>
                </td>
            </tr>
            <tr class="border-b">
                <th class="text-left px-4 py-2">Charge</th>
                <td class="px-4 py-2">
                    @if ($loan->status === 'borrowed')
                        -
                    @elseif ($loan->status === 'returned')
                        {{ $loan->loanDetails->some(fn($detail) => $detail->returnBook && $detail->returnBook->charge) ? 'Yes' : 'No' }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr class="border-b">
                <th class="text-left px-4 py-2">Amount</th>
                <td class="px-4 py-2">
                    @if ($loan->status === 'borrowed')
                        -
                    @elseif ($loan->status === 'returned')
                        Rp {{ number_format($loan->loanDetails->sum(fn($detail) => $detail->returnBook->amount ?? 0), 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-bold">Books Borrowed</h2>
        <div class="mt-4 bg-white p-6 rounded-lg shadow">
            @if ($loan->loanDetails->isEmpty())
                <p>No books associated with this loan.</p>
            @else
                <ul class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($loan->loanDetails as $detail)
                        <li class="flex flex-col items-center space-y-2">
                            <img src="{{ asset('storage/' . $detail->book->cover) }}"
                                 alt="{{ $detail->book->title }}"
                                 class="w-24 h-32 object-cover rounded-md shadow">
                            <div class="text-center">
                                <p class="font-medium">{{ $detail->book->title }}</p>
                                <p class="text-sm text-gray-500">by {{ $detail->book->author }}</p>
                                @if ($detail->returnBook)
                                    <p class="text-sm text-red-500 mt-2">
                                        Charge: {{ $detail->returnBook->charge ? 'Yes' : 'No' }}
                                        @if ($detail->returnBook->amount)
                                            - Amount: Rp {{ number_format($detail->returnBook->amount, 0, ',', '.') }}
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

@endsection
