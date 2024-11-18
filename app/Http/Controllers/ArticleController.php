<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(9); // Pagination
        return view('admin.article.index', compact('articles'));
    }

    public function showUser()
    {
        $articles = Article::latest()->paginate(9); // Pagination
        return view('articles', compact('articles'));
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'date' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan file ke disk 'public'
            $imagePath = $request->file('image')->store('articles', 'local');
        }

        Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'date' => $request->date,
        ]);

        return redirect()->route('admin.article.index')->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        return view('admin.article.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            // Simpan file ke disk 'public'
            $imagePath = $request->file('image')->store('articles', 'local');
            $article->image = $imagePath;
        }

        $article->update($request->only(['title', 'description', 'date']));

        return redirect()->route('admin.article.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.article.index')->with('success', 'Article deleted successfully.');
    }
}
