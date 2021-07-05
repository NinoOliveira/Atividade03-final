<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posicao;
class PosicaoController extends Controller
{
   
    public function index()
    {
        $posicao = new Posicao();
		$posicoes = Posicao::All();
        return view("posicao.index", [
			"posicoes" => $posicoes,
			"posicao" => $posicao
		]);
    }

   
    public function store(Request $request)
    {
		$validado = $request->validate([
			"descricao" => "required"
		], [
			"required" => ":attribute é obrigatório"
		]);

       if ($request->get("id") != ""){
			$posicao = Posicao::Find($request->get("id"));
		}else {
			$posicao = new Posicao();
		}
		
		$posicao->descricao = $request->get("descricao");
		$posicao->save();
		
		$request->Session()->flash("status","sucesso");
		$request->Session()->flash("mensagem", "Posição salva com sucesso!");
		
		return redirect("/posicao");
				
    }

    public function edit($id)
    {
        $posicao = Posicao::Find($id);
		$posicoes = Posicao::All();
        return view("posicao.index", [
			"posicao" => $posicao,
			"posicoes" => $posicoes
		]);
    }
  
    public function destroy(Request $request, $id)
    {
	    Posicao::Destroy($id);
		$request->Session()->flash("status", "excluido");
		$request->Session()->flash("mensagem", "Posição excluída com sucesso!");
		
		return redirect("/posicao");
    }
}
