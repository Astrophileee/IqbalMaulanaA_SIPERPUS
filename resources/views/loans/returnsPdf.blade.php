<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Returns</title>
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
    <h1>All Returns</h1>
    <table>
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    No
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Librarian
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Member
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Loan Date
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Return Deadline
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Return Time
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $loan->user ? $loan->user->name : 'No user assigned'}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $loan->member ? $loan->member->name : 'No member assigned' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->date }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->return_at }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loan->updated_at->format('Y-m-d H:i:s') }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-white bg-green-500">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
