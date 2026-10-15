<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Text;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Список статей и пользователей
    public function index()
    {
        $texts = Text::with(['category', 'user'])->orderBy('created_at', 'desc')->get();
        $users = User::with('role')->get();
        $roles = Role::all();

        return view('admin.index', compact('texts', 'users', 'roles'));
    }

    // Изменение роли пользователя
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Роль пользователя обновлена.');
    }

    // Форма редактирования статьи
    public function editArticle($id)
    {
        $text = Text::findOrFail($id);
        $categories = \App\Models\Category::all();

        return view('admin.articles.edit', compact('text', 'categories'));
    }

    // Обновление статьи
    public function updateArticle(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'text' => 'required|string',
        ]);

        $text = Text::findOrFail($id);
        $text->heading = $request->heading;
        $text->category_id = $request->category_id;
        $text->text = $request->text;
        $text->save();

        return redirect()->route('admin.index')->with('success', 'Статья обновлена.');
    }

    // Удаление статьи
    public function destroyArticle($id)
    {
        $text = Text::findOrFail($id);
        $text->delete();

        return redirect()->route('admin.index')->with('success', 'Статья удалена.');
    }
}