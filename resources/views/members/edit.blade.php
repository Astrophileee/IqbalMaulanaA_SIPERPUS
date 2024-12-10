@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')
    <div class="flex min-h-screen">
        <div class="flex-grow p-8">
            <a href="{{ route('members.index') }}" class="text-black font-bold py-2 px-4 ">
                < Back to Members
            </a>
            <h2 class="text-xl font-bold mb-4">Edit Member</h2>
            <form action="{{ route('members.update', $member) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name Member</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Member</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $member->phone) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('phone')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Member</label>
                    <input type="text" id="name" name="email" value="{{ old('email', $member->email) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Member Address</label>
                    <textarea id="address" name="address" rows="4"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>{{ old('address', $member->address) }}</textarea>
                    @error('address')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
                        Update Member
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
