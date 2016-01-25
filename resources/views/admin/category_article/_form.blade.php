<div class="content">
	<h4>Référencement</h4>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group {{ $errors->has('meta_title') ? 'has-error' : '' }}">
		<label for="meta_title">Titre de la page</label>
		<input type="text" class="form-control" name="meta_title" placeholder="La Blonde" value="{{ isset($category) ? $category->meta_title : old('meta_title') }}">
	</div>
	<div class="form-group {{ $errors->has('meta_desc') ? 'has-error' : '' }}">
		<label for="meta_desc">Description de la page</label>
		<textarea rows="2" class="form-control" name="meta_desc" placeholder="Suave et chaleureuse...">{{ isset($category) ? $category->meta_desc : old('meta_desc') }}</textarea>
</div>
	<hr/>
	<h4>Informations</h4>
	<div class="form-group checkbox checkbox-primary">
		<input type="checkbox" id="visible" name="is_visible" {{ ((isset($category) && $category->is_visible == 1) || old('is_visible')) ? 'checked' : '' }}>
		<label for="visible">Visible sur le site</label>
	</div>
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		<label for="name">Nom de l'article</label>
		<input type="text" class="form-control" name="name" placeholder="La Blonde" value="{{ isset($category) ? $category->name : old('name') }}">
	</div>
</div>
