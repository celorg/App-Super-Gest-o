<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{   
    public function contato(Request $request){
        
        // $motivo_contatos = [
        //     '1' => 'Dúvida',
        //     '2' => 'Elogio',
        //     '3' => 'Reclamação'
        // ];
        $motivo_contatos = MotivoContato::all();
        return view('site.contato2',['motivo_contatos' => $motivo_contatos]);

    }
    public function salvar(Request $request){
        //Realizar a validação dos dados enviados antes de salvar
        
        $regras = [
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000',
        ];
        $feedback = [
            'required' => 'O campo :attribute precisa ser preenchida',

            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome precisa ter no máximo 40 caracteres',

            'email.email' => 'O email informado não é válido',

            'mensagem.max' => 'A mendagem deve ter no máximo 2000 caracteres'
            
        ];
        $request->validate($regras, $feedback);

        siteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
