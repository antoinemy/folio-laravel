@include('admin._header')
	    
@include('admin._menu')
		
	<div class="container">
		<div class="col-md-12">
			<div id="actions_row" class="row"></div>
			@if(session('type') && session('message'))
				<div class="row">
					<div class="col-lg-12">
						<p class="alert alert-custom alert-{{ session('type') }}">{!! session('message') !!}</p>
					</div>
				</div>
			@endif
			<div id="content_row" class="row">
				@if(count($pages) > 0)
					@foreach($pages as $p)
						<div class="item_row col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<div class="content text-center">
								<img class="img-circle m-t-10" src="{{ route('image', [100, 100, 'page', $p->id, $p->photo->name]) }}" alt="">
								<h3><small>{{ $p->name }}</small></h3>
								<div class="btn-group top-right">
									<a class="btn btn-xs btn-default" href="{{ route('admin.page.edit', $p->id) }}" title=""><span class="fa fa-pencil"></span></a>
								</div>
							</div>
						</div>
					@endforeach
				@else
					<div class="col-lg-12">
						<p class="content">Actuellement aucune donnée.</p>
					</div>
				@endif
			</div>
		</div>
	</div>

@include('admin._footer')