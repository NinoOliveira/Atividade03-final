<!--DOCTYPE html-->
<html>
	<head>
		<title>Figurinhas Campeonato Brasileiro 2021 - @yield("titulo")</title>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/fancybox.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/estilo.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/fontAwesome.css') }}" />
		
		<script src="{{ asset('js/jquery.js') }}"></script>
		<script src="{{ asset('js/bootstrap.js') }}"></script>
		<script src="{{ asset('js/fancybox.js') }}"></script>
		<script src="{{ asset('js/jquery.mask.js') }}"></script>
		<script src="{{ asset('js/script.js') }}"></script>
		<script src="{{ asset('js/fontAwesome.js') }}"></script>
		
	</head>
	<body>
		
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<div class="collapse navbar-collapse">
					<div class="navbar-nav">
						<ul>
							<li><a class="nav-link" href="/jogador">Jogadores</a></li>
							<li><a class="nav-link" href="/clube">Clubes</a></li>
							<li><a class="nav-link" href="/posicao">Posições</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		
		@if (Session::get("status") == "sucesso")
			<div class="alert alert-success" role="alert">
				Salvo com sucesso!
			</div>
		@endif
		
		@if (Session::get("status") == "excluido")
			<div class="alert alert-danger" role="alert">
				Excluído com sucesso!
			</div>
		@endif
		@if ($errors->any())
				<div class="alert alert-danger alert-dismissible fade show">
					<span>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</span>
				</div>
			@endif
		
		<div class="container">
		
			@yield("cadastro")
			
			@yield("listagem")
			
		</div>
	</body>
</html>