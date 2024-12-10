@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="flex min-h-screen">
        <div class="flex-grow p-8">
            <a href="{{ route('categories.index') }}" class="text-black font-bold py-2 px-4 ">
                < Back to Categories
            </a>
            <h2 class="text-xl font-bold mb-4">Edit Category</h2>
            <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" id="category" name="category" value="{{ old('category', $category->category) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('category')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                        Update Category
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
