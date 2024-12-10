@extends('layouts.app')

@section('title', 'Add Loan')

@section('content')
    <div class="flex min-h-screen">
        <div class="flex-grow p-8">
            <a href="{{ route('loans.index') }}" class="text-black font-bold py-2 px-4 ">
                < Back to Loans
            </a>
            <h2 class="text-xl font-bold mb-4">Add New Loan</h2>
            <form action="{{ route('loans.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="member_id" class="block text-sm font-medium text-gray-700">Select Member</label>
                    <select id="member_id" name="member_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                        <option value="">-- Select Member --</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                    @error('member_id')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Loan Date</label>
                    <input type="date" id="date" name="date" value="{{ old('date') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('date')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="return_at" class="block text-sm font-medium text-gray-700">Return Date</label>
                    <input type="date" id="return_at" name="return_at" value="{{ old('return_at') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('return_at')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div id="books-container">
                    <label for="books" class="block text-sm font-medium text-gray-700">Select Books</label>
                    <div class="book-group mt-2 flex space-x-2">
                        <select name="books[]" class="book-select block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
                            <option value="">-- Select Book --</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}" data-thumbnail="{{ asset('storage/' . $book->cover) }}">{{ $book->title }}</option>
                            @endforeach
                        </select>
                        <img class="book-thumbnail hidden w-20 h-20 object-cover border border-gray-300 rounded-md" alt="Book Cover" />
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                        Add Loan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const booksContainer = document.getElementById('books-container');
            let selectedBooks = [];

            function updateSelectedBooks() {
                const allSelects = Array.from(booksContainer.querySelectorAll('.book-select'));
                selectedBooks = allSelects
                    .map(select => select.value)
                    .filter(value => value);
            }

            function updateDropdownOptions() {
                const allSelects = Array.from(booksContainer.querySelectorAll('.book-select'));
                allSelects.forEach(select => {
                    const currentValue = select.value;
                    select.querySelectorAll('option').forEach(option => {
                        if (selectedBooks.includes(option.value) && option.value !== currentValue) {
                            option.disabled = true;
                        } else {
                            option.disabled = false;
                        }
                    });
                });
            }

            function addNewDropdown() {
                const newBookGroup = document.createElement('div');
                newBookGroup.classList.add('book-group', 'mt-2', 'flex', 'space-x-2');

                newBookGroup.innerHTML = `
                    <select name="books[]" class="book-select block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        <option value="">-- Select Book --</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}" data-thumbnail="{{ asset('storage/' . $book->cover) }}">
                                {{ $book->title }}
                            </option>
                        @endforeach
                    </select>
                    <img class="book-thumbnail hidden w-20 h-20 object-cover border border-gray-300 rounded-md" alt="Book Cover" />
                `;

                booksContainer.appendChild(newBookGroup);
                updateSelectedBooks();
                updateDropdownOptions();
            }

            function updateThumbnail(select) {
                const thumbnailUrl = select.selectedOptions[0]?.dataset.thumbnail || '';
                const bookThumbnail = select.parentNode.querySelector('.book-thumbnail');

                if (thumbnailUrl) {
                    bookThumbnail.src = thumbnailUrl;
                    bookThumbnail.classList.remove('hidden');
                } else {
                    bookThumbnail.src = '';
                    bookThumbnail.classList.add('hidden');
                }
            }

            booksContainer.addEventListener('change', (e) => {
                if (e.target && e.target.classList.contains('book-select')) {
                    const currentSelect = e.target;

                    updateSelectedBooks();
                    updateDropdownOptions();
                    updateThumbnail(currentSelect);

                    const allSelects = booksContainer.querySelectorAll('.book-select');
                    const lastSelect = allSelects[allSelects.length - 1];
                    if (lastSelect.value && allSelects.length < @json(count($books))) {
                        addNewDropdown();
                    }

                    const allBookGroups = booksContainer.querySelectorAll('.book-group');
                    allBookGroups.forEach((group, index) => {
                        const select = group.querySelector('.book-select');
                        if (!select.value && index !== allBookGroups.length - 1) {
                            booksContainer.removeChild(group);
                        }
                    });
                }
            });

            updateSelectedBooks();
            updateDropdownOptions();
        });
    </script>



@endsection
