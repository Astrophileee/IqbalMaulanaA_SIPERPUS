@extends('layouts.app')

@section('title', 'Categories Page')

@section('content')

    <div class="flex mt-4">
        <a href="{{ route('categories.create') }}">
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                + Add Category
            </button>
        </a>
        <a href="{{ route('categories.pdf') }}" class="ml-5">
            <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                <i class="fa-solid fa-file-pdf"></i> Print Pdf
            </button>
        </a>
    </div>

    <table id="categoriesTable" class="min-w-full divide-y divide-gray-200 text-sm datatable">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    No
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Categories
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($categories as $category)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($category->category)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <a href="{{ route('categories.edit', $category) }}">
                                <button class="text-blue-600 hover:text-blue-900 border border-blue-600 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                                    Edit
                                </button>
                            </a>

                            <form id="deleteForm{{ $category->id }}" action="{{ route('categories.destroy', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="confirmDelete('{{ $category->id }}')"
                                        class="text-red-600 hover:text-red-900 border border-red-600 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                                    Delete
                                </button>
                            </form>

                            <script>
                                function confirmDelete(categoryId) {
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
                                            document.getElementById('deleteForm' + categoryId).submit();
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
