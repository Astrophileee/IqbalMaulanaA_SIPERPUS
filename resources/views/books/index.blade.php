@extends('layouts.app')

@section('title', 'Books Page')

@section('content')

    <div class="flex mt-4">
        <a href="{{ route('books.create') }}">
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                + Add Book
            </button>
        </a>
        <a href="{{ route('books.pdf') }}" class="ml-5">
            <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                <i class="fa-solid fa-file-pdf"></i> Print Pdf
            </button>
        </a>
    </div>

    <table id="booksTable" class="min-w-full divide-y divide-gray-200 text-sm datatable">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    No
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Title
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Author
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Year
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Publisher
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    City
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Cover
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Category
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Bookshelf
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($books as $book)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($book->title)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($book->author)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($book->year)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($book->publisher)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($book->city)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="w-15 h-20 object-cover rounded">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($book->categories->isEmpty())
                            <span class="text-gray-500">No categories</span>
                        @else
                            <ul>
                                @foreach ($book->categories as $category)
                                    <li>{{ $category->category }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->bookshelf->code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <a href="{{ route('books.edit', $book) }}">
                                <button class="text-blue-600 hover:text-blue-900 border border-blue-600 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                                    Edit
                                </button>
                            </a>

                            <form id="deleteForm{{ $book->id }}" action="{{ route('books.destroy', $book) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="confirmDelete('{{ $book->id }}')"
                                        class="text-red-600 hover:text-red-900 border border-red-600 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                                    Delete
                                </button>
                            </form>

                            <script>
                                function confirmDelete(bookId) {
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
                                            document.getElementById('deleteForm' + bookId).submit();
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
