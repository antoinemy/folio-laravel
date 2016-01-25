@include('admin._header')

@include('admin._menu')

	<div class="container">
		<div class="col-md-12">
			@if(session('type') && session('message'))
				<div class="row">
					<div class="col-lg-12">
						<p class="alert alert-custom alert-{{ session('type') }}">{!! session('message') !!}</p>
					</div>
				</div>
			@endif
			<div class="row">
				<form action="{{ route('admin.article.update', $article->id) }}" method="post" enctype="multipart/form-data">
					<input name="_method" type="hidden" value="PUT">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<div class="row">
							<div class="col-xs-12">
								<div class="content text-center">
									<div class="col-lg-12">
										<div id="imagePreview" class="img-circle imagePreview" style="background-image: url('{{ route("article_image_small", [$article->id, "original"]) }}')">
											@if($article->has_image == 1)
												<div onclick="removeImagePreview(this)" class="position-center">
													<a class="btn btn-xs btn-danger"><span class="fa fa-times"></span></a>
												</div>
											@endif
										</div>
										<input id="remove_photo" type="hidden" name="remove_photo" value="false">
									</div>
									<span class="file-input btn btn-primary btn-file m-t-20">
						                Modifier l'image <input id="uploadFile" name="image" type="file">
						            </span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">

						@include('admin.article._form')

						<button class="btn btn-success pull-right m-b-15" type="submit">Enregistrer les modifications</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	@include('admin._footer')

	<script type="text/javascript">
		var url = document.location.toString();
		if (url.match('#')) {
		  $('.exemple a[href=#'+url.split('#')[1]+']').tab('show') ;
		}
	</script>

	</body>
</html>
