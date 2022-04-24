<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        $extensao = $request->file->extension();
        $imageNome = time() . '.' . $extensao;
        $request->file->move(public_path('media/images/'), $imageNome);
    
        return [
            'location' => asset('media/images/'.$imageNome)
        ];
    }
}
