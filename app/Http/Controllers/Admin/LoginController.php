<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{

    public function index()
    {
        return view('admin.login.index');
    }
    public function login(Request $request)
    {
        $dados = $request->only(['email', 'password']);

        $validar = $this->validator($dados);
        $remember = $request->input('remember', false);



        if($validar->fails()){
            return redirect()
                ->route('login')
                ->withErrors($validar);
        }
        if(Auth::attempt($dados, $remember)){
            return redirect()->route('painel');
        }else{
            $validar->errors()->add('password', 'Email e/ou senha errados');
            return redirect()
                ->route('login')
                ->withErrors($validar)
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:4']
        ]);
    }
}
