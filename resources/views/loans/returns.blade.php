@extends('layouts.app')

@section('title', 'Returned Loans')

@section('content')

    <div class="flex justify-between mt-4">
        <h1 class="text-lg font-semibold">Returned Loans</h1>
    </div>

    <table id="loansTable" class="min-w-full divide-y divide-gray-200 text-sm datatable">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    No
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Librarian
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Member
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Loan Date
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Return Deadline
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Return Time
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($loans as $loan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $loan->user ? $loan->user->name : 'No user assigned'}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $loan->member ? $loan->member->name : 'No member assigned' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->date }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->return_at }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->updated_at->format('Y-m-d H:i:s') }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-white bg-green-500">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('loans.show', $loan) }}">
                            <button class="text-black border border-black rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                                Detail
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
