<div class="content">
	<h4>Informations principales</h4>
	<div class="form-group checkbox checkbox-primary">
		<input type="checkbox" id="visible" name="is_visible" {{ ((isset($news) && $news->is_visible == 1) || old('is_visible')) ? 'checked' : '' }}>
		<label for="visible">Visible sur le site</label>
	</div>
	<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
		<label for="typesPages">Type de page</label>
		<select id="typesPages" name="type" class="form-control" {{ isset($page) ? 'disabled' : '' }}>
			@foreach($types as $t)
				<option value="{{ $t->id }}" {{ isset($page) && $page->page_type_id == $t->id ? 'selected="selected"' : '' }}>{{ $t->name }}</option>
			@endforeach
		</select>
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
				<div class="form-group {{ $errors->has('meta_title') ? 'has-error' : '' }}">
					<label for="meta_title">Titre de la page en {{ $l->name }}</label>
					<input type="text" class="form-control" name="meta_title" placeholder="La Blonde" value="{{ isset($page) ? $page->meta_title : old('meta_title') }}">
				</div>
				<div class="form-group {{ $errors->has('meta_desc') ? 'has-error' : '' }}">
					<label for="meta_desc">Description de la page en {{ $l->name }}</label>
					<textarea rows="2" class="form-control" name="meta_desc" placeholder="Suave et chaleureuse...">{{ isset($page) ? $page->meta_desc : old('meta_desc') }}</textarea>
				</div>
			</div>
			<div class="content">
				<h4>Informations en {{ $l->name }}</h4>
				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} typeAccueil typeArticle typeContact typeList typeFooter">
					<label for="name">Nom de la page en {{ $l->name }}</label>
					<input type="text" class="form-control" name="name" placeholder="La Blonde" value="{{ isset($page) ? $page->name : old('name') }}"  {{ isset($page) ? 'disabled' : '' }}>
				</div>
				<div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }} typeArticle typeFooter">
					<label for="desc">Informations en {{ $l->name }}</label>
					<input type="text" class="form-control" name="desc" placeholder="La Bière des Îles d'Or" value="{{ isset($page) ? $page->desc : old('desc') }}">
				</div>
				<div class="form-group {{ $errors->has('desc_plus') ? 'has-error' : '' }} typeFooter">
					<label for="desc_plus">Complément d'informations en {{ $l->name }}</label>
					<input type="text" class="form-control" name="desc_plus" placeholder="Z.A. Palyvestre" value="{{ isset($page) ? $page->desc_plus : old('desc_plus') }}">
				</div>
				<div class="form-group {{ $errors->has('facebook') ? 'has-error' : '' }} typeAccueil">
					<label for="facebook">Lien Facebook en {{ $l->name }}</label>
					<input type="text" class="form-control" name="facebook" placeholder="La Blonde" value="{{ isset($page) ? $page->facebook : old('facebook') }}">
				</div>
				<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }} typeArticle">
					<label for="last_name">Contenu en {{ $l->name }}</label>
					<textarea rows="10" class="form-control ckeditor" name="content" placeholder="Suave et chaleureuse...">{{ isset($page) ? $page->content : old('content') }}</textarea>
				</div>
				<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }} typeContact">
					<label for="address">Adresse en {{ $l->name }}</label>
					<input id="address" type="text" class="form-control" name="address" placeholder="Zone Agricole" value="{{ isset($page) ? $page->address : old('address') }}">
					<div id="map"></div>
					<input id="latitude" type="hidden" name="latitude" value="{{ isset($page) ? $page->latitude : old('latitude') }}">
					<input id="longitude" type="hidden" name="longitude" value="{{ isset($page) ? $page->longitude : old('longitude') }}">
				</div>
				<div class="form-group {{ $errors->has('address_plus') ? 'has-error' : '' }} typeContact">
					<label for="address_plus">Complément d'adresse en {{ $l->name }}</label>
					<input type="text" class="form-control" name="address_plus" placeholder="83400 - ZA Palyvestre" value="{{ isset($page) ? $page->address_plus : old('address_plus') }}">
				</div>
				<hr class="typeArticle typeAccueil"/>
				<span class="file-input btn btn-primary m-b-15 btn-file typeArticle typeAccueil">
				    Ajouter des images <input type="file" name="images[]" id="imagesPreview" multiple />
				</span>
				<div id="filename" class="row typeArticle typeAccueil">
					@if(isset($page))
						@foreach($page->photos as $photo)
							<div id="{{ $photo->photo->id }}" class="col-lg-2 col-md-2 col-sm-4 col-xs-6 m-b-15">
								<div class="img-circle imagePreview" style="background-image:url('{{ route("image", [100, 100, "page", $page->id, $photo->photo->name]) }}');">
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
				<div class="form-group checkbox checkbox-primary typeList">
					<input type="checkbox" id="disponible" name="is_disponible" {{ ((isset($page) && $page->is_disponible == 0) || old('is_disponible')) ? 'checked' : '' }}>
					<label for="disponible">Service actuellement indisponible</label>
				</div>
			</div>
		</div>
	@endforeach
</div>