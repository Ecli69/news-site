<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Text;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'text' => 'required|string',
        ]);

        Text::create([
            'heading' => $request->heading,
            'text' => $request->text,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home')->with('success', 'Статья опубликована!');
    }

    public function show($id)
{
    $text = Text::with(['category', 'user'])->findOrFail($id);

    return view('articles.show', compact('text'));
}
}