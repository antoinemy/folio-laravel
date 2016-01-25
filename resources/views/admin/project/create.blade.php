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
				<form action="{{ route('admin.project.store') }}" method="post" enctype="multipart/form-data">

					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<div class="row">
							<div class="col-xs-12">
								<div class="content text-center">
									<div class="col-lg-12">
										<div id="imagePreview" class="img-circle imagePreview"></div>
									</div>
									<span class="file-input btn btn-primary btn-file m-t-20">
						                Ajouter une image <input id="uploadFile" name="image" type="file">
						            </span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">

						@include('admin.project._form')

						<button class="btn btn-success pull-right m-b-15" type="submit">Créer le projet</button>
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
