<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::query()->with('categories')->latest()->paginate(10);
        return view('welcome', compact('articles'));
    }

    public function categories()
    {
        $categories = Category::query()->withCount('articles')->get();
        return view('categories', compact('categories'));
    }
}
