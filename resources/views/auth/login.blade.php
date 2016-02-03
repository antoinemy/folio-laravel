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
		<link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container m-t-20">
			<div class="col-md-12">
				@if($errors->any())
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-12">
							<p class="alert alert-danger"><span class="fa fa-times"></span> {{ $errors->first() }}</p>
						</div>
					</div>
				@endif
				<div class="row">
					<form action="{{ route('post_login') }}" method="POST" enctype="multipart/form-data">
						<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-12">
							<div class="content centered">
								<h4>Administration</h4>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
										<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email"/>
								</div>
								<div class="form-group">
										<input type="password" class="form-control" placeholder="Mot de passe"  name="password" id="password"/>
								</div>
								<div class="checkbox checkbox-primary">
												<input type="checkbox" name="remember" id="remember"> <label for="remember">Se souvenir de moi</label>
								</div>
								<div class="login-buttons">
										<button type="submit" class="btn btn-primary btn-block">Connexion</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
