<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $columns = [
            ['key' => 'title', 'label' => 'Judul'],
            ['key' => 'author', 'label' => 'Penulis'],
            ['key' => 'content', 'label' => 'Konten'],
            ['key' => 'thumbnail', 'label' => 'Gambar'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'created_at', 'label' => 'Tanggal'],
        ];

        $rows = Article::where('status', 'published')
            ->latest('created_at')
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'author' => $article->author ?? 'Unknown',
                    'content' => \Illuminate\Support\Str::limit(strip_tags($article->content), 50),

                    'thumbnail' => $article->thumbnail
                        ? asset('storage/' . $article->thumbnail)
                        : 'https://picsum.photos/100/100?random=' . $article->id,

                    'status' => $article->status ?? 'draft',

                    'created_at' => $article->created_at->format('d M Y'),
                ];
            });

        return view('pages.admin.articles.index', compact('columns', 'rows'));
    }

    public function create()
    {
        return view('pages.admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);

        Article::create($validated);

        return redirect()->route('admin.articles')->with('success', 'Artikel berhasil dibuat');
    }
}
