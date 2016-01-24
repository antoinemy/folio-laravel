		<div class="col-xs-12">
			<div class="content">
				<h4>Accès aux parties</h4>
				@foreach($rights as $id=>$right)
					<div class="form-group checkbox checkbox-primary">
						<input type="checkbox" id="{{ $right }}" name="rights[]" value="{{ $id }}" {{ isset($admin) && $admin->has_right($id) ? 'checked' : '' }}>
						<label for="{{ $right }}">{{ $right }}</label>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
	<div class="content">
		<h4>Informations principales</h4>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
			<label for="last_name">Nom</label>
			<input type="text" class="form-control" name="last_name" placeholder="Durand" value="{{ isset($admin) ? $admin->last_name : old('last_name') }}">
		</div>
		<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
			<label for="first_name">Prénom</label>
			<input type="text" class="form-control" name="first_name" placeholder="Pierre" value="{{ isset($admin) ? $admin->first_name : old('first_name') }}">
		</div>
		<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
			<label for="email">Email</label>
			<input type="text" class="form-control" name="email" placeholder="durand.pierre@mail.com" value="{{ isset($admin) ? $admin->email : old('email') }}">
		</div>
		<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
			<label for="password">Mot de passe</label>
			<input type="password" class="form-control" name="password" placeholder="4VsdRsT">
		</div>
		<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
			<label for="confirm_password">Confirmation du mot de passe</label>
			<input type="password" class="form-control" name="password_confirmation" placeholder="4VsdRsT">
		</div>
