<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use Inertia\Inertia;

class ContatoController extends Controller
{
    public function index(){
        //RESGATA TODOS OS CONTATOS
        $contatos = Contato::all();
        return Inertia::render('Contato/Index', ['contatos' => $contatos]);
    }
    
    public function create(){
        return Inertia::render('Contato/Create');
    }

    public function edit(Contato $contato){
        return Inertia::render('Contato/Create', ['contato' => $contato, 'isUpdating' => true]);
    }
    public function update(Request $request, Contato $contato){
        //VALIDAÇÃO DOS CAMPOS DA REQUEST
        $request->validate([
            'email' => 'required|email',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nome' => 'required|string',
            'telefone' => 'required|string',
        ]);
        //VERIFICA SE O CAMPO DA IMAGEM TEM UM ARQUIVO
        if($request->hasFile('imagem')){
            //RESGATA O NOME DA IMAGEM E A SUA EXTENSÃO
            $imageName = time().'.'.$request->imagem->extension();  
            $request->imagem->move(public_path('images'), $imageName);
        }
        $post->update($request->all());
        return redirect()->route('contatos.index');
}
    public function store(Request $request){
        //VALIDAÇÃO DOS CAMPOS DA REQUEST
        $request->validate([
            'email' => 'required|email',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nome' => 'required|string',
            'telefone' => 'required|string',
        ]);
        $path = $request->file('imagem')->store('images', 'public');

        // Criar um novo post e salvar
        $contatos = new Contato($request->all());
        $contatos->imagem = $path; // Salvar o caminho relativo da imagem
        $contatos->save();

        return redirect()->route('contatos.index');
    }
    public function destroy(Contato $contato){
        $contato->delete();
    return redirect()->back();
    }
}
