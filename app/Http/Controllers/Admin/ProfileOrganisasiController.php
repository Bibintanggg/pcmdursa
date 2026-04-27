<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileOrganisasiController extends Controller
{
    public function index()
    {
        $profile = Profile::latest()->get();

        return view('pages.admin.profile-organisasi', [
            'profile' => $profile
        ]);
    }

    public function create() {}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:200',
            'visi' => 'required|string|max:200',
            'misi' => 'required|string|max:200',
            'image' => 'required|mimes:png,jpg|max:2048',
            'tagline' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images-profile', 'public');
            $validated['image'] = $path;
        }

        Profile::create($validated);

        return redirect()->route('admin.profile-organisasi')->with('success', 'Data profile berhasil dibuat');
    }

    public function update(Request $request, string $id)
    {
        $profile = Profile::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:200',
            'visi' => 'required|string|max:200',
            'misi' => 'required|string|max:200',
            'image' => 'required|mimes:png,jpg|max:2048',
            'tagline' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        } else {
            $validated['image'] = $profile->image;
        }

        $profile->update($validated);
        return redirect()->route('admin.profile-organisasi')->with('success', 'Data profile berhasil dibuat');
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();
    }
}
