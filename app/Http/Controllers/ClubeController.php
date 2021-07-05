<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clube;
class ClubeController extends Controller
{
 
	
    public function index()
    {
        $clube = new Clube();
		$clubes = Clube::All();
        return view("clube.index", [
			"clubes" => $clubes,
			"clube" => $clube
		]);
    }
  
    public function store(Request $request)
    {
       $validado = $request->validate([
			"nome" => "required",
			"imagem" => "required|mimes:jpg,png"
		], [
			"required" => ":attribute é obrigatório",
			"imagem.mimes" => "É necessário importar um arquivo de imagem (jpg, png)"
		]);
		
		if ($request->get("id") != "") {
			$clube = Clube::Find($request->get("id"));
		} else {
			$clube = new Clube();
		}
		
		$clube->nome = $request->get("nome");	
		$clube->imagem = $request->file("imagem")->store("clubes");
		
		$clube->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Clube salvo com sucesso!");
		
		return redirect("/clube");
    }

  
    public function edit($id)
    {
        $clube = Clube::Find($id);
		$clubes = Clube::All();
        return view("clube.index", [
			"clube" => $clube,
			"clubes" => $clubes
		]);
    }
   
    public function destroy(Request $request, $id)
    {
         Clube::Destroy($id);
		
		$request->Session()->flash("status", "excluido");
		$request->Session()->flash("mensagem", "Clube excluído com sucesso!");
		
		return redirect("/clube");
    }
}
