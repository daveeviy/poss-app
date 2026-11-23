<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->get();
        return view('users', compact('users'));
    }

    public function create()
    {
        return view('users_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('pos_users', 'username')],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('pos_users', 'email')],
            'password' => ['required', 'string', 'min:6'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'avatars/' . uniqid('avatar_', true) . '.jpg';

            $preparedImage = Image::read($file->getRealPath())
                ->cover(200, 200)
                ->toJpeg(85);

            Storage::disk('public')->put($filename, (string) $preparedImage);
            $validated['avatar'] = $filename;
        }

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return redirect()->route('users.edit', $user->id);
    }

    public function edit(User $user)
    {
        return view('users_edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('pos_users', 'username')->ignore($user->id)],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('pos_users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $file = $request->file('avatar');
            $filename = 'avatars/' . uniqid('avatar_', true) . '.jpg';

            $preparedImage = Image::read($file->getRealPath())
                ->cover(200, 200)
                ->toJpeg(85);

            Storage::disk('public')->put($filename, (string) $preparedImage);
            $validated['avatar'] = $filename;
        } else {
            unset($validated['avatar']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}