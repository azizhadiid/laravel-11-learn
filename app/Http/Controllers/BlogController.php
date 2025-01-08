<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    // membuat method index
    function index(Request $request)
    {
        $title = $request->title;
        $blogs = DB::table('blogs')->where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'desc')->simplePaginate(10);
        return view('blog', ['blogs' => $blogs, 'title' => $title]);
    }

    function add()
    {
        return view('blog-add');
    }

    function create(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs|max:255',
            'description' => 'required',
        ]);

        DB::table('blogs')->insert([
            'title' => $request->title,
            'description' => $request->description
        ]);

        // Perbaiki key flash message
        Session::flash('message', 'Blog telah ditambahkan');

        return redirect()->route('blog');
    }

    function detail($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        if (!$blog) {
            abort(404);
        }
        return view('blog-detail', ['blog' => $blog]);
    }

    function edit($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        if (!$blog) {
            abort(404);
        }
        return view('blog-edit', ['blog' => $blog]);
    }
    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title,' . $id . '|max:255',
            'description' => 'required',
        ]);

        DB::table('blogs')->where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        Session::flash('message', 'Blog telah diedit');

        return redirect()->route('blog');
    }
    function hapus($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->delete();

        Session::flash('message', 'Blog telah dihapus');

        return redirect()->route('blog');
    }
}
