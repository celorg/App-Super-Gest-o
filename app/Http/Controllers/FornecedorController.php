<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedores;

class FornecedorController extends Controller
{
    public function index(Request $request){
           
        $msg = '';

        if($request->get('msg') != ''){
            $msg = $request->get('msg');
        };

        return view('app.fornecedor.index', ['msg'=>$msg]);
    }

    public function listar(Request $request){
        // dd($request->all());
        $fornecedores = Fornecedores::with(['produtos'])->where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('site', 'like', '%'.$request->input('site').'%')
        ->where('uf', 'like', '%'.$request->input('uf').'%')
        ->where('email', 'like', '%'.$request->input('email').'%')
        ->get();
        // ->paginate(2);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores ]);
    }
    
    public function adicionar(Request $request){
        
        $msg = '';
        
        if($request->input('_token') != '' && $request->input('id') == ''){
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];
            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo Uf deve ter no mínimo 3 caracteres',
                'uf.max' => 'O campo Uf deve ter no maxímo 40 caracteres',
                'email.email' => 'O campo e-mail não foi preenchido corretamente'
            ];
            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedores();
            $fornecedor->create($request->all());
            
            $msg = 'Cadastro realizado com sucesso';
        }

        if($request->input('_token') != '' && $request->input('id') != ''){
            $fornecedor = Fornecedores::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update){
                $msg = 'Update realizado com sucesso';
            }else{
                $msg = 'Update apresentou erro';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id') ,'msg'=>$msg]);
        }

        return view('app.fornecedor.adicionar', ['msg'=>$msg]);
    }    


    public function editar($id, $msg = ''){
        // echo $id;
        $fornecedor = Fornecedores::find($id);
         return redirect()->route('app.fornecedor.adicionar',['fornecedor' => $fornecedor, 'msg' => $msg]);
    }


    public function excluir($id, $msg = ''){
        $fornecedor = Fornecedores::find($id)->delete();
        $msg = "Fornecedor removido com sucesso";

        return redirect()->route('app.fornecedor', ['msg'=>$msg] );
    }
}

