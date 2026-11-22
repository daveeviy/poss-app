<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>
    <a href="{{ route('users') }}">Back to Users</a>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div>
            <label for="username">Username *</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}">
            @error('username') <div>{{ $message }}</div> @enderror
        </div>

        <br>

        <div>
            <label for="full_name">Full Name *</label><br>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}">
            @error('full_name') <div>{{ $message }}</div> @enderror
        </div>

        <br>

        <div>
            <label for="email">Email *</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email') <div>{{ $message }}</div> @enderror
        </div>

        <br>

        <div>
            <label for="password">Password *</label><br>
            <input type="password" id="password" name="password">
            @error('password') <div>{{ $message }}</div> @enderror
        </div>

        <br>

        <button type="submit">Create User</button>
    </form>
</body>
</html>