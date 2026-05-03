<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Berita;
use App\Models\ProfileOrganisasi;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LandingController extends Controller
{
    public function index()
    {
        $hero = ProfileOrganisasi::latest('created_at')->first();

        $articles = Article::where('status', 'published')
            ->latest('created_at')
            ->get();

        $latestBerita = Berita::where('status', 'published')
            ->latest('created_at')
            ->limit(3)
            ->get();

        return view('welcome', [
            'hero' => $hero,
            'articles' => $articles,
            'latestBerita' => $latestBerita,
        ]);
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('pages.admin.articles.article-detail', compact('article'));
    }

    public function showAllArticles()
    {
        $articles = Article::where('status', 'published')
            ->latest('created_at')
            ->paginate(10);

        return view('pages.articles.show-all', compact('articles'));
    }

    public function showStrukturOrganisasi()
    {
        $strukturs = StrukturOrganisasi::orderBy('peran_level')
            ->orderBy('urutan')
            ->get();

        return view('struktur-organisasi', compact('strukturs'));
    }

    public function showAllBerita()
    {
        $berita = Berita::where('status', 'published')
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'slug' => $item->slug,
                    'isi' => $item->isi,
                    'excerpt' => Str::limit(strip_tags($item->isi), 140),
                    'gambar' => $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&fit=crop',
                    'kategori' => $item->kategori,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                ];
            });

        return view('pages.berita.berita-show', compact('berita'));
    }

    public function showBerita($berita)
    {
        $berita = Berita::where('slug', $berita)
            ->where('status', 'published')
            ->firstOrFail();

        $berita->gambar = $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&fit=crop';

        return view('pages.berita.berita-detail', compact('berita'));
    }
}
