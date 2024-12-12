@extends('layouts.app')

@section('title', 'Members Page')

@section('content')

    <div class="flex mt-4">
        <a href="{{ route('members.create') }}">
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                + Add Member
            </button>
        </a>
        <a href="{{ route('members.pdf') }}" class="ml-5">
            <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                <i class="fa-solid fa-file-pdf"></i> Print Pdf
            </button>
        </a>
    </div>

    <table id="membersTable" class="min-w-full divide-y divide-gray-200 text-sm datatable">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    No
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Phone
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Address
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($members as $member)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($member->name)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($member->email)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($member->phone)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($member->address)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <a href="{{ route('members.edit', $member) }}">
                                <button class="text-blue-600 hover:text-blue-900 border border-blue-600 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                                    Edit
                                </button>
                            </a>

                            <form id="deleteForm{{ $member->id }}" action="{{ route('members.destroy', $member) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="confirmDelete('{{ $member->id }}')"
                                        class="text-red-600 hover:text-red-900 border border-red-600 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                                    Delete
                                </button>
                            </form>

                            <script>
                                function confirmDelete(memberId) {
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
                                            document.getElementById('deleteForm' + memberId).submit();
                                        }
                                    });
                                }
                            </script>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
