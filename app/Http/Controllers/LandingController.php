<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Berita;
use App\Models\ProfileOrganisasi;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

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
            ->latest('created_at')
            ->paginate(9);

        return view('berita.all', compact('berita'));
    }

    public function showBerita($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('berita.show', compact('berita'));
    }
}
