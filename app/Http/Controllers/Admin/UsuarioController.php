<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsuarioController extends Controller
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
        $usuarios = User::paginate(5);

        return view('admin.usuarios.index', [
            'usuarios' => $usuarios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuarios.novo');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        if($usuario){
            return view('admin.usuarios.editar', [
                'usuario' => $usuario
            ]);
        }
        return redirect()->route('usuarios.index');
        
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
        $usuario = User::find($id);
        if($usuario){ 
            $dados = $request->only(['nome', 'email', 'password', 'password_confirmation']);

            // como o nome e o email são obrigatorios
            // vamo verificar se o que foi mandado é valido
            // obs (sem considerar que o email é unico na tabela)

            $validar = Validator::make([
                'name' => $dados['nome'], 
                'email' => $dados['email']
            ], [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100'],
            ]);

            // se passou pela validação, altera o nome (ja que nao tem nenhuma regra)
            $usuario->nome = ucwords(strtolower($dados['nome']));


            // validando o email enviado pelo usuario
            if($usuario->email != $dados['email']){
                $temEmail = User::where('email', $dados['email'])->get();
                if(count($temEmail) === 0 ){
                    $usuario->email = $dados['email'];
                }else{
                    // então ja tem um email com o nome que o usuario mandou
                    return redirect()
                        ->route('usuarios.edit', ['usuario' => $id])
                        ->with('warning', 'Esse email já existe');
                }
            }
            
            if($validar->fails()){
                return redirect()
                    ->route('usuarios.edit', ['usuario' => $id])
                    ->withErrors($validar)
                    ->withInput();
            }

            if($request->filled('password')){
                // as senhas precisam ter + de 3 caracteres
                if(strlen($dados['password']) >= 4){
                    // a senha e a confirmação precisam ser iguais...
                    if($dados['password'] === $dados['password_confirmation']){
                        $usuario->senha = Hash::make($dados['password']);
                    }else{
                        return redirect()
                            ->route('usuarios.edit', ['usuario' => $id])
                            ->with('warning', 'As senhas nao correspondem');
                    }
                }else{
                    return redirect()
                            ->route('usuarios.edit', ['usuario' => $id])
                            ->with('warning', 'Sua senha precisa ter no minimo 4 caracteres');
                }
            }
            if(count( $validar->errors() ) > 0){
                return redirect()
                ->route('usuarios.edit', ['usuario' => $id])
                ->withErrors($validar)
                ->withInput();
            }
            $usuario->save();

        }   
        return redirect()->route('usuarios.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        if($usuario){
            $usuario->delete();
        }
        return redirect()->route('usuarios.index');
    }
}
