<div class="content">
	<h4>Référencement</h4>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group {{ $errors->has('meta_title') ? 'has-error' : '' }}">
		<label for="meta_title">Titre de la page</label>
		<input type="text" class="form-control" name="meta_title" placeholder="La Blonde" value="{{ isset($page) ? $page->meta_title : old('meta_title') }}">
	</div>
	<div class="form-group {{ $errors->has('meta_desc') ? 'has-error' : '' }}">
		<label for="meta_desc">Description de la page</label>
		<textarea rows="2" class="form-control" name="meta_desc" placeholder="Suave et chaleureuse...">{{ isset($page) ? $page->meta_desc : old('meta_desc') }}</textarea>
</div>
	<hr/>
	<h4>Informations</h4>
	<div class="form-group checkbox checkbox-primary">
		<input type="checkbox" id="visible" name="is_visible" {{ ((isset($page) && $page->is_visible == 1) || old('is_visible')) ? 'checked' : '' }}>
		<label for="visible">Visible sur le site</label>
	</div>
	<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
		<label for="typesPages">Type de page</label>
		<select id="typesPages" name="type" class="form-control" {{ isset($page) ? 'readonly' : '' }}>
			@foreach($types as $t)
				<option value="{{ $t->id }}" {{ isset($page) && $page->page_type_id == $t->id ? 'selected="selected"' : '' }}>{{ $t->name }}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group {{ $errors->has('link_github') ? 'has-error' : '' }}">
		<label for="link_github">Lien GitHub</label>
		<input type="text" class="form-control" name="link_github" placeholder="La Blonde" value="{{ isset($page) ? $page->link_github : old('link_github') }}">
	</div>
	<div class="form-group {{ $errors->has('link_bitbucket') ? 'has-error' : '' }}">
		<label for="link_bitbucket">Lien BitBucket</label>
		<input type="text" class="form-control" name="link_bitbucket" placeholder="La Blonde" value="{{ isset($page) ? $page->link_bitbucket : old('link_bitbucket') }}">
	</div>
</div>
