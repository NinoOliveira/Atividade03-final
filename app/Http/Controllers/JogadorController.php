<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador;
class JogadorController extends Controller
{
   
    public function index()
    {
        $jogador = new Jogador();
		$jogadores = Jogador::All();
        return view("jogador.index", [
			"jogadores" => $jogadores,
			"jogador" => $jogador
		]);
    }
  
    public function store(Request $request)
    {
        $validado = $request->validate([
			"nome" => "required",
			"dataNascimento" => "required|before:Today",
			"posicao" => "required",
			"clube" => "required"
			
		], [
			"required" => ":attribute é obrigatório",
			"dataNascimento.before" => "A data de nascimento deve ser menor que a data atual"
			
		]);
		
		if ($request->get("id") != "") {
			$clube = Jogador::Find($request->get("id"));
		} else {
			$jogador = new Jogador();
		}
		
		$jogador->nome = $request->get("nome");	
		$jogador->dataNascimento = $request->get("dataNascimento");
		
		$jogador->posicao = $request->get("posicao");
		$jogador->clube = $request->get("clube");	
		
		if ($request->get("colecao") == 1) {
			$jogador->colecao = 1;
		} else {
			$jogador->colecao = 0;
		}
		$jogador->foto = $request->file("foto")->store("clubes");
		$jogador->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Jogador salvo com sucesso!");
		
		return redirect("/jogador");
    }

   
   
    public function edit($id)
    {
        $jogador = Jogador::Find($id);
		$jogadores = Jogador::All();
        return view("jogador.index", [
			"jogador" => $jogador,
			"jogadores" => $jogadores
		]);
    }

  
    
    public function destroy(Request $request,$id)
    {
        Jogador::Destroy($id);
		$request->Session()->flash("status", "excluido");
		$request->Session()->flash("mensagem", "Jogador excluído com sucesso!");
		
		return redirect("/jogador");
    }
}
