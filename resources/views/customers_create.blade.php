<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer</title>
</head>
<body>
    <h1>Create Customer</h1>
    <a href="{{ route('customers.index') }}">Back to Customers</a>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

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
            <label for="phone">Phone</label><br>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
            @error('phone') <div>{{ $message }}</div> @enderror
        </div>

        <br>

        <button type="submit">Save Customer</button>
    </form>
</body>
</html>