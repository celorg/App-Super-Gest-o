<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedores;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fornecedor = new Fornecedores();
        $fornecedor->nome = 'fornecedor 100';
        $fornecedor->site = 'fornecedor100.com.br';
        $fornecedor->uf = 'CE';
        $fornecedor->email = 'contato@fornecedor100.com.br';
        $fornecedor->save();

        Fornecedores::create([
            'nome'=>'Fornecedor 200',
            'site'=>'fornecedor200@hotmail.com',
            'uf'=>'RS',
            'email'=>'fornecedor200.com.br'
        ]);
        


    }
}
