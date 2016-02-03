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

		@if(Auth::user()->can_right(1))
	</div>

	<div class="content">
		<h4>Gestion des droits</h4>
		<?php $i = 0; ?>
		@foreach($rights as $id=>$right)

			@if($i%4 == 0)
			<div class="row">
			@endif
			<div class="col-md-3">
				<h5>{{ $right }}</h5>
				<div class="form-group checkbox checkbox-primary">
					<input type="checkbox" id="show_{{ $id }}" name="rights[{{$id}}][show]" value="{{ $id }}" {{ isset($admin) && $admin->can_show($id) ? 'checked' : '' }}>
					<label for="show_{{ $id }}">Voir la partie</label>
				</div>
				<div class="form-group checkbox checkbox-primary">
					<input type="checkbox" id="create_{{ $id }}" name="rights[{{$id}}][create]" value="{{ $id }}" {{ isset($admin) && $admin->can_create($id) ? 'checked' : '' }}>
					<label for="create_{{ $id }}">Créer</label>
				</div>
				<div class="form-group checkbox checkbox-primary">
					<input type="checkbox" id="edit_{{ $id }}" name="rights[{{$id}}][edit]" value="{{ $id }}" {{ isset($admin) && $admin->can_edit($id) ? 'checked' : '' }}>
					<label for="edit_{{ $id }}">Modifier</label>
				</div>
				<div class="form-group checkbox checkbox-primary">
					<input type="checkbox" id="delete_{{ $id }}" name="rights[{{$id}}][delete]" value="{{ $id }}" {{ isset($admin) && $admin->can_delete($id) ? 'checked' : '' }}>
					<label for="delete_{{ $id }}">Supprimer</label>
				</div>
				@if($id == 1)
					<div class="form-group checkbox checkbox-primary">
						<input type="checkbox" id="right" name="rights[{{$id}}][right]" value="{{ $id }}" {{ isset($admin) && $admin->can_right($id) ? 'checked' : '' }}>
						<label for="right">Gérer les droits</label>
					</div>
				@endif
			</div>
			@if($i%4 == 3 || count($rights) == $i+1)
			</div>
			@endif
			<?php $i++; ?>
		@endforeach
@endif
