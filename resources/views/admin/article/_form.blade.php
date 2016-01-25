<div class="content">
	<h4>Référencement</h4>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group {{ $errors->has('meta_title') ? 'has-error' : '' }}">
		<label for="meta_title">Titre de la page</label>
		<input type="text" class="form-control" name="meta_title" placeholder="La Blonde" value="{{ isset($article) ? $article->meta_title : old('meta_title') }}">
	</div>
	<div class="form-group {{ $errors->has('meta_desc') ? 'has-error' : '' }}">
		<label for="meta_desc">Description de la page</label>
		<textarea rows="2" class="form-control" name="meta_desc" placeholder="Suave et chaleureuse...">{{ isset($article) ? $article->meta_desc : old('meta_desc') }}</textarea>
</div>
	<hr/>
	<h4>Informations</h4>
	<div class="form-group checkbox checkbox-primary">
		<input type="checkbox" id="visible" name="is_visible" {{ ((isset($article) && $article->is_visible == 1) || old('is_visible')) ? 'checked' : '' }}>
		<label for="visible">Visible sur le site</label>
	</div>
	<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
		<label for="categories">Catégorie de l'article</label>
		<div class="input-group">
			<select id="categories" name="category" class="form-control">
				@foreach($categories as $c)
					<option value="{{ $c->id }}" {{ isset($article) && $article->article_category_id == $c->id ? 'selected="selected"' : '' }}>{{ $c->name }}</option>
				@endforeach
			</select>
			<span class="input-group-btn">
				<a href="{{ route('admin.category_article.create') }}" class="btn btn-primary">Nouvelle catégorie</a>
			</span>
		</div>
	</div>
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		<label for="name">Nom de l'article</label>
		<input type="text" class="form-control" name="name" placeholder="La Blonde" value="{{ isset($article) ? $article->name : old('name') }}">
	</div>
	<div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
		<label for="desc">Titre de l'article</label>
		<textarea rows="2" class="form-control" name="desc" placeholder="Suave et chaleureuse...">{{ isset($article) ? $article->desc : old('desc') }}</textarea>
	</div>
	<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
		<label for="content">Titre de l'article</label>
		<textarea rows="10" class="form-control ckeditor" name="content" placeholder="Suave et chaleureuse...">{{ isset($article) ? $article->content : old('content') }}</textarea>
	</div>
</div>
