<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Loan</title>
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
    <h1>Detail Loan {{ $loan->member ? $loan->member->name : 'No member assigned' }} {{ $loan->date }}</h1>
    <table>
        <thead>
            <tr>
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
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Charge
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Amount
                </th>
                <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                    Book
                </th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td class="px-4 py-2">{{ $loan->user ? $loan->user->name : 'No librarian assigned' }}</td>
                    <td class="px-4 py-2">{{ $loan->member ? $loan->member->name : 'No member assigned' }}</td>
                    <td class="px-4 py-2">{{ $loan->date }}</td>
                    <td class="px-4 py-2">{{ $loan->return_at }}</td>
                    <td class="px-4 py-2">
                        @if ($loan->status === 'borrowed')
                            -
                        @elseif ($loan->status === 'returned')
                            {{ $loan->updated_at->format('Y-m-d H:i:s') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-white {{ $loan->status === 'returned' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        @if ($loan->status === 'borrowed')
                            -
                        @elseif ($loan->status === 'returned')
                            {{ $loan->loanDetails->some(fn($detail) => $detail->returnBook && $detail->returnBook->charge) ? 'Yes' : 'No' }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if ($loan->status === 'borrowed')
                            -
                        @elseif ($loan->status === 'returned')
                            Rp {{ number_format($loan->loanDetails->sum(fn($detail) => $detail->returnBook->amount ?? 0), 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @foreach ($loan->loanDetails as $detail)
                        <li class="flex flex-col items-center space-y-2">
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/'  . $detail->book->cover))) }}" alt="Cover" style="width: 80px; height: 100px; object-fit: cover; border-radius: 5px;">
                        </li>
                    @endforeach
                    </td>
                </tr>
        </tbody>
    </table>
</body>
</html>
