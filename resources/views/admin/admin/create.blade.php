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
				<form action="{{ route('admin.admin.store') }}" method="post" enctype="multipart/form-data">
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
							
							@include('admin.admin._form')
							
						</div>
						<button class="btn btn-success pull-right m-b-15" type="submit">Créer l'administrateur</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	@include('admin._footer')
	
	</body>
</html>