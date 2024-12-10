@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
    <div class="flex min-h-screen">
        <div class="flex-grow p-8">
            <a href="{{ route('books.index') }}" class="text-black font-bold py-2 px-4 ">
                < Back to Books
            </a>
            <h2 class="text-xl font-bold mb-4">Add New Book</h2>
            <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('title')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                    <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('author')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                    <input type="number" name="year" id="year" value="{{ old('year', $book->year) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('year')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="publisher" class="block text-sm font-medium text-gray-700">Publisher</label>
                    <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('publisher')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" name="city" id="city" value="{{ old('city', $book->city) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('city')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="cover" class="block text-sm font-medium text-gray-700">Cover</label>
                    <input type="file" name="cover" id="cover"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @if ($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="Current Cover" class="w-20 h-28 object-cover mb-2">
                    @endif
                    @error('cover')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="bookshelf_id" class="block text-sm font-medium text-gray-700">Bookshelf</label>
                    <select name="bookshelf_id" id="bookshelf_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        @foreach ($bookshelves as $bookshelf)
                            <option value="{{ $bookshelf->id }}" {{ $book->bookshelf_id == $bookshelf->id ? 'selected' : '' }}>
                                {{ $bookshelf->code }}
                            </option>
                        @endforeach
                    </select>
                    @error('bookshelf_id')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div id="categories-container">
                    <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>

                    @foreach ($book->categories as $category)
                        <select name="categories[]" class="category-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $category->id == $cat->id ? 'selected' : '' }}>{{ $cat->category }}</option>
                            @endforeach
                        </select>
                    @endforeach

                    <select name="categories[]" class="category-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('categories') == $category->id ? 'selected' : '' }}>{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>

                @error('categories')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

                <div>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                        Update Book
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoriesContainer = document.getElementById('categories-container');
            const categories = @json($categories);
            let selectedCategories = @json($book->categories->pluck('id')->toArray());

            function initializeDropdowns() {
                updateSelectedCategories();
                updateDropdownOptions();
            }

            categoriesContainer.addEventListener('change', function (e) {
                if (e.target && e.target.matches('select.category-select')) {
                    updateSelectedCategories();
                    updateDropdownOptions();

                    const selects = Array.from(categoriesContainer.querySelectorAll('select.category-select'));
                    const allFilled = selects.every(select => select.value);

                    if (allFilled && !selects.some(select => select.options.length <= 1)) {
                        addNewCategoryDropdown();
                    }
                }
            });

            function updateSelectedCategories() {
                const selects = Array.from(categoriesContainer.querySelectorAll('select.category-select'));
                selectedCategories = selects
                    .map(select => select.value)
                    .filter(value => value);
            }


            function updateDropdownOptions() {
                const selects = Array.from(categoriesContainer.querySelectorAll('select.category-select'));

                selects.forEach(select => {
                    const currentValue = select.value;
                    select.querySelectorAll('option').forEach(option => {
                        if (selectedCategories.includes(option.value) && option.value !== currentValue) {
                            option.disabled = true;
                        } else {
                            option.disabled = false;
                        }
                    });
                });
            }

            function addNewCategoryDropdown() {
                const newSelect = document.createElement('select');
                newSelect.name = 'categories[]';
                newSelect.classList.add('category-select', 'mt-1', 'block', 'w-full', 'border', 'border-gray-300', 'rounded-md', 'shadow-sm', 'focus:ring-green-500', 'focus:border-green-500', 'sm:text-sm');

                const firstOption = document.createElement('option');
                firstOption.value = '';
                firstOption.disabled = true;
                firstOption.selected = true;
                firstOption.textContent = 'Select Category';
                newSelect.appendChild(firstOption);

                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.category;
                    newSelect.appendChild(option);
                });

                categoriesContainer.appendChild(newSelect);
                updateDropdownOptions();
            }

            initializeDropdowns();
        });
    </script>
@endsection
