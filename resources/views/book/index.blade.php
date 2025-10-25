<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Books</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">📚 List of Books with Filter</h1>

        <form method="GET" action="{{ route('books.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-3 mb-6">
    {{-- Search --}}
    <input type="text" name="search" value="{{ $search }}" placeholder="Search book or author..."
           class="p-2 border rounded col-span-2">

    {{-- Author --}}
    <select name="author_id" class="p-2 border rounded">
        <option value="">All Authors</option>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}" {{ $author_id == $author->id ? 'selected' : '' }}>
                {{ $author->name }}
            </option>
        @endforeach
    </select>

    {{-- Category --}}
    <select name="category_id" class="p-2 border rounded">
        <option value="">All Categories</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" {{ $category_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    {{-- Rating --}}
    <select name="min_rating" class="p-2 border rounded">
        <option value="">All Ratings</option>
        @for ($i = 1; $i <= 10; $i++)
            <option value="{{ $i }}" {{ $min_rating == $i ? 'selected' : '' }}>
                Rating ≥ {{ $i }}
            </option>
        @endfor
    </select>

    {{-- Limit --}}
    <select name="limit" class="p-2 border rounded">
        @foreach ([10, 20, 50, 100] as $num)
            <option value="{{ $num }}" {{ $limit == $num ? 'selected' : '' }}>
                Show {{ $num }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600">Filter</button>
</form>


        
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Book Name</th>
                    <th class="p-2 border">Category Name</th>
                    <th class="p-2 border">Author Name</th>
                    <th class="p-2 border text-center">Average Rating</th>
                    <th class="p-2 border text-center">Voters</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $index => $book)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border text-center">{{ $loop->iteration }}</td>
                        <td class="p-2 border">{{ $book->title }}</td>
                        <td class="p-2 border">{{ $book->category->name ?? '-' }}</td>
                        <td class="p-2 border">{{ $book->author->name ?? '-' }}</td>
                        <td class="p-2 border text-center">
                            {{ number_format($book->ratings_avg_rating, 2) ?? 0 }}
                        </td>
                        <td class="p-2 border text-center">{{ $book->ratings_count ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>

</body>
</html>
