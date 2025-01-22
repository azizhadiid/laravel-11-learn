<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    // membuat method index
    function index(Request $request)
    {
        // Bagian Policy
        if ($request->user()->cannot('viewAny', Blog::class)) {
            abort(403);
        }

        $title  = $request->title;
        $blogs = Blog::with(['tags', 'comments', 'image', 'ratings', 'categories'])->where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'asc')->simplePaginate(10);
        return view('blog', ['blogs' => $blogs, 'title' => $title]);
    }

    function add()
    {
        $tags = Tag::all();
        return view('blog-add', ['tags' => $tags]);
    }

    function create(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs|max:255',
            'description' => 'required',
        ]);

        // DB::table('blogs')->insert([
        //     'title' => $request->title,
        //     'description' => $request->description
        // ]);

        $blog = Blog::create($request->all());
        $blog->tags()->attach($request->tags);

        // Perbaiki key flash message
        Session::flash('message', 'Blog telah ditambahkan');

        return redirect()->route('blog');
    }

    function detail($id)
    {
        // $blog = DB::table('blogs')->where('id', $id)->first();
        $blog = Blog::with(['comments', 'tags'])->findOrFail($id);

        // if (!$blog) {
        //     abort(404);
        // }
        return view('blog-detail', ['blog' => $blog]);
    }

    function edit(Request $request, $id)
    {
        $tags = Tag::all();
        $blog = Blog::with(['tags'])->findOrFail($id);
        // Bagian Policy
        if ($request->user()->cannot('update', $blog)) {
            abort(403);
        }

        // if (!Gate::allows('update-blog', $blog)) {
        //     abort(403);
        // }
        $response = Gate::inspect('update-blog', $blog);
        if (!$response->allowed()) {
            abort(403, $response->message());
        }

        return view('blog-edit', ['blog' => $blog, 'tags' => $tags]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title,' . $id . '|max:255',
            'description' => 'required',
        ]);

        // DB::table('blogs')->where('id', $id)->update([
        //     'title' => $request->title,
        //     'description' => $request->description
        // ]);
        // Bagian Policy
        $blog = Blog::findOrFail($id);
        if ($request->user()->cannot('update', $blog)) {
            abort(403);
        }

        $blog->tags()->sync($request->tags);
        $blog->update($request->all());

        Session::flash('message', 'Blog telah diedit');

        return redirect()->route('blog');
    }
    function hapus($id)
    {
        // $blog = DB::table('blogs')->where('id', $id)->delete();
        Blog::findOrFail($id)->delete();

        Session::flash('message', 'Blog telah dihapus');

        return redirect()->route('blog');
    }
    function restore($id)
    {
        $blog = BLog::withTrashed()->findOrFail($id)->restore();
    }
}
