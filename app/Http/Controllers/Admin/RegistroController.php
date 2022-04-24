<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegistroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.registro.index');
    }

    public function registro(Request $request)
    {
        $dados = $request->only(['name', 'email', 'password', 'password_confirmation']);

        $validar = $this->validator($dados);

        if($validar->fails()){
            return redirect()
                ->route('registro')
                ->withErrors($validar)
                ->withInput();
        }

        $user = $this->create($dados);
        // print_r($user);
        Auth::login($user);
        return redirect()->route('painel');

    }

    protected function validator(array $dados)
    {
        return Validator::make($dados, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:usuarios'],
            'password' => ['required', 'string', 'min:4', 'max:100', 'confirmed']
        ]);
    }
    protected function create(array $dados)
    {
        return User::create([
            'nome' => $dados['name'],
            'email' => $dados['email'],
            'senha' => Hash::make($dados['password'])
        ]);
    }
}
