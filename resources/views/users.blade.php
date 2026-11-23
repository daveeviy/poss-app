<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a> |
        <a href="{{ route('customers.index') }}">Customers</a> |
        <a href="{{ route('users.index') }}">Users</a> |
        <a href="{{ route('about') }}">About</a>
    </nav>

    <hr>

    <h1>User Accounts</h1>

    @if (session('success'))
        <div style="color: green; margin-bottom: 12px;">
            {{ session('success') }}
        </div>
    @endif

    <p>
        <a href="{{ route('users.create') }}">+ Add User</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->full_name }} Avatar" width="50" height="50" style="object-fit: cover; border-radius: 50%;">
                        @else
                            <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 50 50'><rect width='50' height='50' rx='25' fill='%23cccccc'/><text x='50%25' y='55%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial, sans-serif' font-size='14' fill='%23333333'>N/A</text></svg>" alt="Default Avatar" width="50" height="50" style="border-radius: 50%;">
                        @endif
                    </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>