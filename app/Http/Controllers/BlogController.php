<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    // membuat method index
    function index(Request $request)
    {
        // $title = $request->title;
        // $blogs = DB::table('blogs')->where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'desc')->simplePaginate(10);
        // return view('blog', ['blogs' => $blogs, 'title' => $title]);

        $title  = $request->title;
        $blogs = Blog::where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'desc')->simplePaginate(10);
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

    function edit($id)
    {
        $tags = Tag::all();
        $blog = Blog::with(['tags'])->findOrFail($id);
        // if (!$blog) {
        //     abort(404);
        // }
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

        $blog = Blog::findOrFail($id);
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
