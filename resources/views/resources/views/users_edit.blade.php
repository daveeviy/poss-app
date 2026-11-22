<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <a href="{{ route('users') }}">Back to Users</a>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="username">Username *</label><br>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}">
            @error('username') <div>{{ $message }}</div> @enderror
        </div>

        <br>

        <div>
            <label for="full_name">Full Name *</label><br>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}">
            @error('full_name') <div>{{ $message }}</div> @enderror
        </div>

        <br>

        <div>
            <label for="email">Email *</label><br>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
            @error('email') <div>{{ $message }}</div> @enderror
        </div>

        <br>

        <div>
            <label for="password">New Password (leave blank to keep current)</label><br>
            <input type="password" id="password" name="password">
            @error('password') <div>{{ $message }}</div> @enderror
        </div>

        <br>

        <div>
            <label for="avatar">Profile Picture (Max 2MB)</label><br>
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar" width="80" height="80"><br>
            @endif
            <input type="file" id="avatar" name="avatar" accept="image/*">
            @error('avatar') <div>{{ $message }}</div> @enderror
        </div>

        <br>

        <button type="submit">Update User</button>
    </form>
</body>
</html>