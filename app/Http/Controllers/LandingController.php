<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ProfileOrganisasi;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $hero = ProfileOrganisasi::latest('created_at')->first();
        $articles = Article::latest(
            'created_at'
        )->get();
        return view('welcome', [
            'hero' => $hero,
            'articles' => $articles,    
        ]);
    }
}
