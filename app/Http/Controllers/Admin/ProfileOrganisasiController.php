<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Models\Profile;
use App\Models\ProfileOrganisasi;
use Illuminate\Http\Request;

class ProfileOrganisasiController extends Controller
{
    public function index()
    {
        $profile = ProfileOrganisasi::latest()->get();

        $columns = [
            ['key' => 'nama',    'label' => 'Nama',    'sortable' => true],
            ['key' => 'visi',    'label' => 'Visi',    'sortable' => false],
            ['key' => 'misi',    'label' => 'Misi',    'sortable' => false],
            ['key' => 'tagline', 'label' => 'Tagline', 'sortable' => false],
        ];

        $rows = $profile->map(fn($p) => [
            'nama'    => $p->nama,
            'visi'    => $p->visi,
            'misi'    => $p->misi,
            'tagline' => $p->tagline,
            'email'   => (string) $p->id, // dipakai sebagai row key unik
        ])->toArray();

        return view('pages.admin.profile-organisasi', compact('profile', 'columns', 'rows'));
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

        ProfileOrganisasi::create($validated);

        return redirect()->route('admin.profile-organisasi')->with('success', 'Data profile berhasil dibuat');
    }

    public function update(Request $request, string $id)
    {
        $profile = ProfileOrganisasi::findOrFail($id);

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
        $profile = ProfileOrganisasi::findOrFail($id);
        $profile->delete();
    }
}
