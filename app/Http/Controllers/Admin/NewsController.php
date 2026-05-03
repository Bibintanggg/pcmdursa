<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function index()
    {
        $columns = [
            ['key' => 'judul', 'label' => 'Judul'],
            ['key' => 'kategori', 'label' => 'Kategori'],
            ['key' => 'gambar', 'label' => 'Gambar'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'created_at', 'label' => 'Tanggal'],
        ];

        // Ambil semua data, jangan pake paginate
        $rows = Berita::latest('created_at')
            ->get()
            ->map(function ($berita) {
                return [
                    'id' => $berita->id,
                    'judul' => Str::limit($berita->judul, 50),
                    'kategori' => ucfirst($berita->kategori ?? 'Unknown'),
                    'status' => ucfirst($berita->status ?? 'draft'),
                    'created_at' => $berita->created_at?->format('d M Y') ?? 'N/A',
                    'gambar' => asset($berita->gambar ? 'storage/' . $berita->gambar : 'https://picsum.photos/100/100?random=' . $berita->id),
                    'email' => (string) $berita->id, // ID untuk edit & delete
                ];
            })
            ->toArray();

        return view('pages.admin.news.index', compact('columns', 'rows'));
    }

    public function create()
    {
        return view('pages.admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kategori' => ['required', Rule::in(['dakwah', 'pendidikan', 'sosial', 'organisasi'])],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        // Generate slug (tetap pakai slug untuk SEO frontend)
        $slug = Str::slug($request->judul);
        $count = Berita::where('slug', 'like', $slug . '%')->count();
        $validated['slug'] = $count ? "{$slug}-" . ($count + 1) : $slug;

        Berita::create($validated);

        return redirect()->route('berita.index')
            ->with('success', '✅ Berita berhasil disimpan!');
    }

    public function edit($id) // ✅ ID only
    {
        $berita = Berita::findOrFail($id);
        return view('pages.admin.news.edit', compact('berita'));
    }

    public function update(Request $request, $id) // ✅ ID only
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => ['required', Rule::in(['dakwah', 'pendidikan', 'sosial', 'organisasi'])],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        // Regenerate slug jika judul berubah
        if ($request->judul !== $berita->judul) {
            $slug = Str::slug($request->judul);
            $count = Berita::where('slug', 'like', $slug . '%')->where('id', '!=', $id)->count();
            $validated['slug'] = $count ? "{$slug}-" . ($count + 1) : $slug;
        }

        $berita->update($validated);

        return redirect()->route('berita.index')->with('success', '✅ Berita berhasil diupdate!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return response()->json([
            'success' => true,
            'message' => '✅ Berita berhasil dihapus!'
        ]);
    }
}
