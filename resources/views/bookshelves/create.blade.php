@extends('layouts.app')

@section('title', 'Add Bookshelf')

@section('content')
    <div class="flex min-h-screen">
        <div class="flex-grow p-8">
            <a href="{{ route('bookshelves.index') }}" class="text-black font-bold py-2 px-4 ">
                < Back to Bookshelves
            </a>
            <h2 class="text-xl font-bold mb-4">Add New Bookshelf</h2>
            <form action="{{ route('bookshelves.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Bookshelf Code</label>
                    <input type="text" id="code" name="code" value="{{ old('code') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('code')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Bookshelf Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                        Add Bookshelf
                    </button>
                </div>
            </form>

        </div>

    </div>
@endsection
