<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()->where('user_id', auth()->id())
            ->latest()->paginate(10);
        return $this->success($articles);
    }

    public function store(StoreArticleRequest $request)
    {
        $article = Article::query()->create($request->validated());
        $article->categories()->sync($request->input('category_id'));
        return $this->success($article, 'Article created successfully');
    }

    public function show(Article $article)
    {
        return $this->success($article);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->validated());
        $article->categories()->sync($request->input('category_id'));
        return $this->success($article, 'Article updated successfully');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return $this->success(null, 'Article deleted successfully');
    }
}
