<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
		
		<title>Locabike</title>
		
		<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<nav class="navbar navbar-default navbar-custom">
			<div class="container-fluid container">
				<div class="navbar-header">
					
				</div>
			</div>
		</nav>
		<div class="container m-b-30">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
						<div class="content-login">
							@if($errors->any())
							    <p class="alert alert-danger"><span class="fa fa-times"></span> {{ $errors->first() }}</p>
							@endif
							<form action="{{ route('post_login') }}" method="POST" class="margin-bottom-0">
				                <input type="hidden" name="_token" value="{{ csrf_token() }}">
			                    <div class="form-group m-b-20">
			                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email"/>
			                    </div>
			                    <div class="form-group m-b-20">
			                        <input type="password" class="form-control" placeholder="Mot de passe"  name="password" id="password"/>
			                    </div>
			                    <div class="checkbox m-b-20">
			                        <label>
			                            <input type="checkbox" name="remember"> Se souvenir de moi
			                        </label>
			                    </div>
			                    <div class="login-buttons">
			                        <button type="submit" class="btn btn-primary btn-block">Connexion</button>
			                    </div>
			                </form>
		                </div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>