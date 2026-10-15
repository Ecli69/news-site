<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Text;

class CategoryController extends Controller
{
    // Список всех категорий
    public function index()
    {
        $categories = Category::withCount('texts')->get();

        return view('categories.index', compact('categories'));
    }

    // Статьи выбранной категории
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $texts = Text::where('category_id', $id)
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('categories.show', compact('category', 'texts'));
    }
}