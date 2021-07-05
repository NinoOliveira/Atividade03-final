@extends("template.default")

@section("titulo", "Posições")

@section("cadastro")

<h3>Cadastro das Posições</h3>
	
	<form method="POST" action="/posicao" class="row">
		@csrf
		<div class="form-group col-4">
			<label for="descricao">Descrição: </label>
			<input type="text" id="descricao" name="descricao" value="{{ $posicao->descricao }}" class="form-control" required/>
		</div>
		
		<div class="form-group col-8">
		</br>
			<a class="btn btn-primary" href="/posicao">Novo</a>
			<input type="hidden" id="id" name="id" value="{{ $posicao->id }}" />
			<button class="btn btn-success" type="submit">Salvar</button>
		</div>
	</form>
		
@endsection

@section("listagem")

	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Descrição</th>
				<th>Editar</th>
				<th>Deletar</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($posicoes as $posicao)
				<tr>
					<td>{{ $posicao->id }}</td>
					<td>{{ $posicao->descricao }}</td>
					<td>
						<a class="btn btn-warning" href="/posicao/{{ $posicao->id }}/edit">Editar</a>
					</td>
					<td>
						<form action="/posicao/{{ $posicao->id }}" method="POST">
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