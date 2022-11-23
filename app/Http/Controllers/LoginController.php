<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request){
        
        $erro = '';
        if($request->get('erro') == 1){
            $erro = 'Usuário ou senha não existe';
        }
        if($request->get('erro') == 2){
            $erro = 'Necessario realizar o login para ter acesso a pagina';
        };

        return view('site.login',['titulo'=>'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request){
        
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        //as mensagens de feedback de validação
        $feedback =[
            'usuario.email' => 'O campo email é obrigatório',
            'senha.required' => 'O Campo senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $password = $request->get('senha');

        $user = new User();

        $usuario = $user->where('email',$email)->where('password',$password)->get()->first();
        
        if(isset($usuario->name)){
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.home');
        }else{
            echo 'Usuário não existe';
            return redirect()->route('site.login',['erro' => 1]);
        }
    }

    public function sair(){
        session_destroy();
        return redirect()->route('site.index');
    }
}
