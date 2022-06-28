<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_name' => 'required',
            'description' => 'required'
        ]);

        $post = new Post([
            'category_name' => $request->get('category_name'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ]);
        $post->save();
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('components.edit', compact(
            'categories',
            'post'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $update = $post->update([
            'title' => $request->title,
            'category_name' => $request->category_name,
            'description' => $request->description
        ]);
        if ($update)
            return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->withTrashed()->delete();
        return redirect('/');
    }
    public function search()
    {
        $categories = Category::all();

        if (isset($_GET['search'])) {
            $search_text = $_GET['search'];
            $posts = Post::where('title', 'like', '%' . implode(' ', preg_split('/(?=_[a-z])/', $search_text)) . '%')
                ->orWhere('description', 'like', '%' . implode(' ', preg_split('/(?=_[a-z])/', $search_text)) . '%')->paginate(3);
            return view('components.search', compact(
                'posts',
                'categories'
            ));
        } else {
            $posts = Post::paginate(3);
            $categories = Category::all();
            return view('components.body', compact(
                'posts',
                'categories'
            ));
        }
    }
    public function category($name)
    {
        $categories = Category::all();
        $posts = Post::where('category_name', $name)->paginate(3);
        return view('admin.admin', compact(
            'posts',
            'categories'
        ));
    }
    public function details($name)
    {
        $categories = Category::all();
        $posts = Post::where('title', $name)->latest()->get();
        return view('components.details', compact(
            'posts',
            'categories'
        ));
    }
}