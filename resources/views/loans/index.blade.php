@extends('layouts.app')

@section('title', 'Loans Page')

@section('content')

    <div class="flex justify-between mt-4">
        <a href="{{ route('loans.create') }}">
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                + Add Loan
            </button>
        </a>
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
                        {{ $loan->user ? $loan->user->name : 'No user assigned' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $loan->member ? $loan->member->name : 'No member assigned' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->date }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->return_at }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-white {{ $loan->status === 'returned' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <a href="{{ route('loans.show', $loan) }}">
                                <button class="text-black border border-black rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                                    Detail
                                </button>
                            </a>
                            @if ($loan->status == 'borrowed' && $loan->loanDetails->where('is_return', false)->count() > 0)
                                <form id="returnForm{{ $loan->id }}" action="{{ route('loan-details.return', $loan) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="button"
                                            onclick="confirmReturn('{{ $loan->id }}')"
                                            class="text-blue-600 hover:text-blue-900 border border-blue-600 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                                        Return
                                    </button>
                                </form>
                            @endif
                            @if ($loan->status == 'borrowed')
                            <a href="{{ route('loans.edit', $loan) }}">
                                <button class="text-blue-600 hover:text-blue-900 border border-blue-600 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                                    Edit
                                </button>
                            </a>
                            @endif
                            @if ($loan->status == 'borrowed')
                            <form id="deleteForm{{ $loan->id }}" action="{{ route('loans.destroy', $loan) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="confirmDelete('{{ $loan->id }}')"
                                        class="text-red-600 hover:text-red-900 border border-red-600 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                                    Delete
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function confirmDelete(loanId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + loanId).submit();
                }
            });
        }

        function confirmReturn(loanId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, return it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('returnForm' + loanId).submit();
                }
            });
        }
    </script>
@endsection
