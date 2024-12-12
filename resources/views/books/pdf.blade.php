<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>All Books</h1>
    <table>
        <thead>
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
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($book->title)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($book->author)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($book->year)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($book->publisher)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($book->city)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $book->cover))) }}" alt="Cover" style="width: 80px; height: 100px; object-fit: cover; border-radius: 5px;">
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
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
