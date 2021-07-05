@extends("template.default")
@section("titulo", "Clubes")

@section("cadastro")

<h3>Cadastro de Clubes</h3>
	
	<form method="POST" action="/clube" class="row" enctype="multipart/form-data">
		@csrf
		<div class="form-group col-4">
			<label for="descricao">Nome: </label>
			<input type="text" id="nome" name="nome" value="{{ $clube->nome }}" class="form-control" required/>
		</div>
		<div class="form-group col-4">
			<label for="imagem">Escudo: </label>
			<div class="custom-file">
				<input class="custom-file-input" type="file" id="imagem" name="imagem" required/>
				<label class="custom-file-label" for="imagem">Selecionar Arquivo</label>
			</div>
		</div>
		<div class="form-group col-4 ">
			</br>
			<a class="btn btn-primary" href="/clube">Novo</a>
			<input type="hidden" id="id" name="id" value="{{ $clube->id }}" />
			<button class="btn btn-success" type="submit">Salvar</button>
		</div>
	</form>
		
@endsection

@section("listagem")

	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Escudo</th>
				<th>Editar</th>
				<th>Deletar</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($clubes as $clube)
				<tr>
					<td>{{ $clube->id }}</td>
					<td>{{ $clube->nome }}</td>
					<td>
						<img src="{{ asset('storage/' . $clube->imagem) }}" width="100" />
					</td>
					<td>
						<a class="btn btn-warning" href="/clube/{{ $clube->id }}/edit">Editar</a>
					</td>
					<td>
						<form action="/clube/{{ $clube->id }}" method="POST">
							@csrf
							<input type="hidden" name="_method" value="DELETE" />
							<button  class="btn btn-danger" type="submit" onclick="return confirm('Tem Certeza?');">Excluir</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	<script>
		
		$(document).ready(function() {
			
			$('[data-fancybox]').fancybox({
				toolbar  : false,
				smallBtn : true,
				iframe : {
					preload : false,
					css : {
						width : '600px',
						height : '400px'
					}
				}
			});
			
		});
		
	</script>

@endsection