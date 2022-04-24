<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);

        return view('admin.posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->only(['titulo', 'categoria', 'corpo']);
        $dados['slug'] = Str::slug($dados['titulo'], '-');

        $validar = Validator::make($dados, [
            'titulo' => ['required', 'string', 'max:100'],
            'categoria' => ['required', 'string', 'max:100'],
            'corpo' => ['required', 'string'],
            'slug' => ['required', 'unique:posts', 'max:100']
        ]);

        if($validar->fails()){
            return redirect()
                ->route('posts.create')
                ->withErrors($validar)
                ->withInput();
        }

        Post::create([
            'titulo' => $dados['titulo'],
            'categoria' => $dados['categoria'],
            'corpo' => $dados['corpo'],
            'criadoEm' => date('Y-m-d'),
            'slug' => $dados['slug']
        ]);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        echo "vendo o post" . $slug;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if($post){
            return view('admin.posts.edit', [
                'post' => $post
            ]);
        }
        return redirect()
            ->route('pages.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if($post){
            $dados = $request->only(['titulo', 'categoria', 'corpo']);


            if($post->titulo != $dados['titulo']){
                $dados['slug'] = Str::slug($dados['titulo'], '-');

                $validar = Validator::make($dados, [
                    'titulo' => ['required', 'string', 'max:100'],
                    'categoria' => ['required', 'string', 'max:100'],
                    'corpo' => ['required', 'string'],
                    'slug' => ['required', 'max:100']
                ]);
            }else{
                $validar = Validator::make($dados, [
                    'titulo' => ['required', 'string', 'max:100'],
                    'categoria' => ['required', 'string', 'max:100'],
                    'corpo' => ['required', 'string'],
                ]);
            }
            if($validar->fails()){
                return redirect()
                    ->route('posts.edit', ['post' => $id])
                    ->withErrors($validar);
            }

            $post->titulo = $dados['titulo'];
            $post->corpo = $dados['corpo'];
            $post->categoria = $dados['categoria'];
            if(!empty($dados['slug'])){
                $post->slug = $dados['slug'];
            }
            
            $post->save();

        }
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if($post){
            $post->delete();
        }
        return redirect()->route('posts.index');
    }
}
