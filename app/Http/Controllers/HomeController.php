<?php

namespace App\Http\Controllers;

use App\Models\Text;

class HomeController extends Controller
{
    public function index()
    {
        $texts = Text::with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('articles.index', compact('texts'));
    }
}