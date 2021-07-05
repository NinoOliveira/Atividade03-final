@extends("template.default")

@section("titulo", "Jogadores")

@section("cadastro")
<?php
		$conexao = new mysqli("localhost", "root", "", "atividade3_final");
?>
<h3>Cadastro dos Jogadores</h3>
	
	<form method="POST" action="/jogador" enctype="multipart/form-data" class="row">
		@csrf
		<div class="form-group col-4">
			<label for="nome">Nome: </label>
			<input type="text" id="nome" name="nome" value="{{ $jogador->nome }}" class="form-control" required/>
		</div>
		<div class="form-group col-3">
			<label for="dataNascimento">Data de Nascimento: </label>
			<input type="date" id="dataNascimento" name="dataNascimento" value="{{ $jogador->dataNascimento }}" class="form-control" required/>
		</div>
		<div class="form-group col-4 ">
			<label for="posicao">Posição: </label>
			<select class="form-control" name="posicao">
				<option>Selecione</option>
				<?php
				
					$posicoes = $conexao->query("SELECT * FROM posicao;");
					while($posicao = $posicoes->fetch_assoc()){
				?>
						<option value="<?php echo $posicao['id'];?>">
										<?php
												echo $posicao['descricao'];
											?>
										</option><?php
					}
				?>
				
			</select>
		</div>
		<div class="form-group col-4 ">
			<label for="clube">Clube: </label>
			<select class="form-control" name="clube">
				<option>Selecione</option>
				<?php
				
					$clubes = $conexao->query("SELECT * FROM clube;");
					while($clube = $clubes->fetch_assoc()){
				?>
						<option value="<?php echo $clube['id'];?>">
										<?php
												echo $clube['nome'];
											?>
										</option><?php
					}
				?>
			</select>
		</div>
		<div class="form-group col-4">
			<label for="foto">Foto: </label>
			<div class="custom-file">
				<input class="custom-file-input" type="file" id="foto" name="foto" />
				<label class="custom-file-label" for="foto">Selecionar Foto</label>
			</div>
		</div>
		<div class="form-group col-4">
		</br>
			<label for="colecao">
				<input type="checkbox" name="colecao" value="1" /> 
				Faz parte da coleção
			</label>
			<a class="btn btn-primary" href="/jogador">Novo</a>
			<input type="hidden" id="id" name="id" value="{{ $jogador->id }}" />
			<button class="btn btn-success" type="submit">Salvar</button>
		</div>
	</form>
		
@endsection

@section("listagem")

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Data de Nascimento</th>
				<th>Posição</th>
				<th>Clube</th>
				<th>Faz parte da coleção?</th>
				<th>Foto</th>
				<th>Editar</th>
				<th>Deletar</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($jogadores as $jogador)
				<tr>
					<td>{{ $jogador->nome }}</td>
					<td>{{ $jogador->dataNascimento }}</td>
					<td>
						<?php
							$idPosicao = $jogador->posicao;
							$posicaoDescricao = $conexao->query("SELECT descricao FROM posicao WHERE id = '$idPosicao';");
							while($posicao = $posicaoDescricao->fetch_assoc()){
						?>
										<?php
												echo $posicao['descricao'];
											?>
										<?php
							}
						?>
					</td>
					<td>
						<?php
							$idClube = $jogador->clube;
							$clubeImagem = $conexao->query("SELECT imagem FROM clube WHERE id = '$idClube';");
							while($clube = $clubeImagem->fetch_assoc()){
						?>
										<img src="{{ asset('storage/' . $clube['imagem']) }}" width="100" />
										<?php
							}
						?>
					</td>
					<td>
						@if ($jogador->colecao == 1)
							<i> Sim</i>
						@else
							<button name= "adquirir" type="button" class="btn btn-primary"onclick="alert('Figurinha obtida com sucesso!')">Adquirir</button>
							<?php
								if (isset($_POST["adquirir"]))
								{
									$idJogador = $jogador->id;
									$colecao = $conexao->query("UPDATE jogador SET colecao = 1 WHERE id ='$idJogador';");
								}
							?>
						@endif
					</td>
					<td>
						<img src="{{ asset('storage/' . $jogador->foto) }}" width="100" />
					</td>
					<td>
						<a class="btn btn-warning" href="/jogador/{{ $jogador->id }}/edit">Editar</a>
					</td>
					<td>
						<form action="/jogador/{{ $jogador->id }}" method="POST">
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