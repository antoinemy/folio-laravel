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
				<form action="{{ route('admin.category_project.store') }}" method="post" enctype="multipart/form-data">
					<div class="col-xs-12">

						@include('admin.category_project._form')

						<button class="btn btn-success pull-right m-b-15" type="submit">Créer la catégorie</button>
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
