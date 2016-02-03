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
				<div class="col-md-12">
					<p class="content">Prochainement...</p>
				</div>
			</div>
		</div>
	</div>

@include('admin._footer')
