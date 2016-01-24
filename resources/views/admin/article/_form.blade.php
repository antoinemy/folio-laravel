<div class="content">
	<h4>Informations principales</h4>
	<div class="form-group checkbox checkbox-primary">
		<input type="checkbox" id="visible" name="is_visible" {{ ((isset($news) && $news->is_visible == 1) || old('is_visible')) ? 'checked' : '' }}>
		<label for="visible">Visible sur le site</label>
	</div>
	<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
		<label for="categories">Catégorie de l'actualité</label>
		
		
		<div class="input-group">
			<select id="categories" name="category" class="form-control">
				@foreach($categories as $c)
					<option value="{{ $c->id }}" {{ isset($news) && $news->news_category_id == $c->id ? 'selected="selected"' : '' }}>{{ $c->content()->name }}</option>
				@endforeach
			</select>
			<span class="input-group-btn">
				<a href="{{ route('admin.category_news.create') }}" class="btn btn-primary">Nouvelle catégorie</a>
			</span>
		</div>
	</div>
</div>

<div role="tabpanel">
	<ul class="nav nav-tabs" role="tablist">
		@foreach($languages as $l)
			<li class="{{ $l->short_name == 'fr' ? 'active' : '' }}"><a href="#{{ $l->short_name }}" aria-controls="{{ $l->short_name }}" role="tab" data-toggle="tab">{{ $l->name }}</a></li>
		@endforeach
	</ul>
</div>

<div class="tab-content">
	@foreach($languages as $l)
		<div id="{{ $l->short_name }}" role="tabpanel" class="tab-pane {{ $l->short_name == 'fr' ? 'active' : '' }}">
			<div class="content">
				<h4>Référencement en {{ $l->name }}</h4>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group {{ $errors->has('meta_title_'.$l->short_name) ? 'has-error' : '' }}">
					<label for="meta_title_{{ $l->short_name }}">Titre de la page en {{ $l->name }}</label>
					<input type="text" class="form-control" name="meta_title_{{ $l->short_name }}" placeholder="La Blonde" value="{{ isset($news) ? $news->content($l->id)->meta_title : old('meta_title_'.$l->short_name) }}">
				</div>
				<div class="form-group {{ $errors->has('meta_desc_'.$l->short_name) ? 'has-error' : '' }}">
					<label for="meta_desc_{{ $l->short_name }}">Description de la page en {{ $l->name }}</label>
					<textarea rows="2" class="form-control" name="meta_desc_{{ $l->short_name }}" placeholder="Suave et chaleureuse...">{{ isset($news) ? $news->content($l->id)->meta_desc : old('meta_desc_'.$l->short_name) }}</textarea>
				</div>
				<hr/>
				<h4>Informations en {{ $l->name }}</h4>
				<div class="form-group {{ $errors->has('name_'.$l->short_name) ? 'has-error' : '' }}">
					<label for="name_{{ $l->short_name }}">Nom de l'actualité en {{ $l->name }}</label>
					<input type="text" class="form-control" name="name_{{ $l->short_name }}" placeholder="La Blonde" value="{{ isset($news) ? $news->content($l->id)->name : old('name_'.$l->short_name) }}">
				</div>
				<div class="form-group {{ $errors->has('desc_'.$l->short_name) ? 'has-error' : '' }}">
					<label for="desc_{{ $l->short_name }}">Description de l'actualité en {{ $l->name }}</label>
					<textarea rows="2" class="form-control" name="desc_{{ $l->short_name }}" placeholder="Suave et chaleureuse...">{{ isset($news) ? $news->content($l->id)->desc : old('desc_'.$l->short_name) }}</textarea>
				</div>
				<div class="form-group {{ $errors->has('content_'.$l->short_name) ? 'has-error' : '' }}">
					<label for="content_{{ $l->short_name }}">Contenu en {{ $l->name }}</label>
					<textarea rows="10" class="form-control ckeditor" name="content_{{ $l->short_name }}" placeholder="Suave et chaleureuse...">{{ isset($news) ? $news->content($l->id)->content : old('content_'.$l->short_name) }}</textarea>
				</div>
			</div>
		</div>
	@endforeach
</div>

<div class="content">
	<h4>Photos de l'actualité</h4>
	<span class="file-input btn btn-primary m-b-15 btn-file">
	    Ajouter des images <input type="file" name="images[]" id="imagesPreview" multiple />
	</span>
	<div id="filename" class="row">
		@if(isset($news))
			@foreach($news->photos as $photo)
				<div id="{{ $photo->id }}" class="col-lg-2 col-md-2 col-sm-4 col-xs-6 m-b-15">
					<div class="img-circle imagePreview" style="background-image:url('{{ route("news_image_small", [$news->id, $photo->name]) }}');">
						<div class="position-center">
							<a onclick="removeImageExistsPreview(this)" class="btn btn-xs btn-danger">
								<span class="fa fa-times"></span>
							</a>
						</div>
					</div>
				</div>
			@endforeach
		@endif
		<input id="remove_photos" type="hidden" name="remove_photos">
	</div>
</div>