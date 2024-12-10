@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="text-xl font-bold mb-4">Dashboard</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-bold">Total Books</h3>
            <p class="text-2xl font-semibold text-blue-500">{{ $data['books_count'] }}</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-bold">Total Categories</h3>
            <p class="text-2xl font-semibold text-green-500">{{ $data['categories_count'] }}</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-bold">Total Members</h3>
            <p class="text-2xl font-semibold text-red-500">{{ $data['members_count'] }}</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-bold">Total Bookshelves</h3>
            <p class="text-2xl font-semibold text-yellow-500">{{ $data['bookshelves_count'] }}</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-bold">Total Loans</h3>
            <p class="text-2xl font-semibold text-purple-500">{{ $data['loans_count'] }}</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-bold">Total Returns</h3>
            <p class="text-2xl font-semibold text-gray-500">{{ $data['returns_count'] }}</p>
        </div>
    </div>
@endsection
