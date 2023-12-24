<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->latest()->paginate(10);
        return $this->success($categories);
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::query()->create($request->validated());
        return $this->success($category, 'Category created successfully');
    }

    public function show(Category $category)
    {
        return $this->success($category);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        return $this->success($category, 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success(null, 'Category deleted successfully');
    }
}
