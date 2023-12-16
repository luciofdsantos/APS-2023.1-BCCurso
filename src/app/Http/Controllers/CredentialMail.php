<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUser;

class CredentialMail extends Controller
{
    private $nome;
    private $email;
    private $senha;

    public function __construct(Request $request)
    {
        $this->nome = $request->nome;
        $this->email = $request->email;
        $this->senha = $request->email;
    }

    public function sendMail(){
        $data = array(
            'nome'=> $this->nome,
            'email'=> $this->email,
            'senha'=> $this->senha
        );

        Mail::to($this->email)->send( new ContactUser($data));
    }
}
