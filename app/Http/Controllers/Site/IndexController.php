<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class IndexController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {
        $posts = Post::paginate(5);
        
        return view('site.index', [
            'posts' => $posts
        ]);
    }

    public function visualizar($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if($post){
            return view('site.visualizar', [
                'post' => $post
            ]);
        }
        return redirect()->route('index');
    }
    
}
