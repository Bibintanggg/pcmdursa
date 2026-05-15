<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index()
    {
        $columns = [
            ['key' => 'name', 'label' => 'Nama'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'role', 'label' => 'Role'],
            ['key' => 'created_at', 'label' => 'Tanggal Dibuat'],
        ];

        $rows = User::latest('created_at')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => ucfirst($user->role),
                    'created_at' => $user->created_at
                        ? $user->created_at->format('d M Y')
                        : '-',
                ];
            });

        return view('pages.admin.manage-user.index', compact('columns', 'rows'));
    }


    public function create()
    {
        return view('pages.admin.manage-user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create($validated);

        return redirect()
            ->route('admin.manage-user')
            ->with('success', 'User berhasil dibuat!');
    }

    public function edit(User $manage_user)
    {
        return view('pages.admin.manage-user.edit', [
            'user' => $manage_user
        ]);
    }

    public function update(Request $request, User $manage_user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $manage_user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,user',
        ]);

        if (!empty($validated['password'])) {
            $manage_user->update($validated);
        } else {
            unset($validated['password']);
            $manage_user->update($validated);
        }

        return redirect()
            ->route('admin.manage-user')
            ->with('success', 'User berhasil diupdate!');
    }
}
