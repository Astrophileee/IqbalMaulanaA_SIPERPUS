@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
    <div class="flex min-h-screen">
        <div class="flex-grow p-8">
            <a href="{{ route('books.index') }}" class="text-black font-bold py-2 px-4 ">
                < Back to Books
            </a>
            <h2 class="text-xl font-bold mb-4">Add New Book</h2>
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('title')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                    <input type="text" id="author" name="author" value="{{ old('author') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('author')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                    <input type="number" id="year" name="year" value="{{ old('year') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('year')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="publisher" class="block text-sm font-medium text-gray-700">Publisher</label>
                    <input type="text" id="publisher" name="publisher" value="{{ old('publisher') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('publisher')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('city')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="cover" class="block text-sm font-medium text-gray-700">Cover</label>
                    <input type="file" id="cover" name="cover" accept="image/*"
                        class="mt-1 block w-full text-gray-600 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        onchange="previewCover(event)">
                    @error('cover')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                    <div class="mt-4">
                        <img id="coverPreview" src="#" alt="Cover Preview"
                            class="hidden w-32 h-48 object-cover border border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>
                <script>
                    function previewCover(event) {
                        const input = event.target;
                        const preview = document.getElementById('coverPreview');

                        if (input.files && input.files[0]) {
                            const reader = new FileReader();

                            reader.onload = function (e) {
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');
                            };

                            reader.readAsDataURL(input.files[0]);
                        } else {
                            preview.src = '#';
                            preview.classList.add('hidden');
                        }
                    }
                </script>

                <div>
                    <label for="bookshelf_id" class="block text-sm font-medium text-gray-700">Bookshelf</label>
                    <select id="bookshelf_id" name="bookshelf_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                        <option value="" disabled selected>Select Bookshelf</option>
                        @foreach ($bookshelves as $bookshelf)
                            <option value="{{ $bookshelf->id }}" {{ old('bookshelf_id') == $bookshelf->id ? 'selected' : '' }}>
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
                    <select id="categories" name="categories[]"
                        class="category-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        <option value="" disabled selected>Select Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </select>
                    @error('categories')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                        Add Book
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const categoriesContainer = document.getElementById('categories-container');
                    let selectedCategories = [];

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
                const newSelect = categoriesContainer.querySelector('select.category-select').cloneNode(true);
                newSelect.value = '';
                categoriesContainer.appendChild(newSelect);
                updateDropdownOptions();
            }
            initializeDropdowns();
        });

    </script>
@endsection
