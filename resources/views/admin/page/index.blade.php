@include('admin._header')

@include('admin._menu')

	<div class="container">
		<div class="col-md-12">
			<div id="actions_row" class="row">
				@if(count($pages) > 0)
					<div class="col-md-offset-8 col-md-4 col-sm-offset-7 col-sm-5 m-b-15">
						<input type="text" id="search" class="form-control" placeholder="Rechercher une page">
					</div>
				@endif
			</div>
			@if(session('type') && session('message'))
				<div class="row">
					<div class="col-lg-12">
						<p class="alert alert-custom alert-{{ session('type') }}">{!! session('message') !!}</p>
					</div>
				</div>
			@endif
			<div id="content_row" class="row">
				@if(count($pages) > 0)
					<div class="col-xs-12">
						<div class="content">
							<div class="table-responsive">
								<table id="table" class="table table-striped">
								    <thead>
								        <tr>
								            <th></th>
								            <th>Visible</th>
								            <th>Type de la page</th>
								            <th></th>
								        </tr>
								    </thead>
								    <tbody>
									    @foreach($pages as $p)
									        <tr>
									            <td><img src='{{ route("page_image_small", [$p->id, "original"]) }}' class="img-circle img-xs"/></td>
															<td>{!! $p->is_visible == 1 ? '<span class="label label-success">Oui</span>' : '<span class="label label-danger">Non</span>' !!}</td>
									            <td>{{ $p->type->name }}</td>
									            <td>
										            <form id="form_{{ $p->id }}" method="post" action="{{ route('admin.page.destroy', $p->id) }}">
											            <input type="hidden" name="_token" value="{{ csrf_token() }}">
											            <input type="hidden" name="_method" value="DELETE">
											            <div class="btn-group pull-right">
																		<a class="btn btn-xs btn-default" href="{{ route('admin.page.edit', $p->id) }}">
																			<span class="fa fa-pencil"></span>
																		</a>
																		<a class="btn btn-xs btn-danger" data-bb="confirm" data-id="{{ $p->id }}">
																			<span class="fa fa-times"></span>
																		</a>
																	</div>
																</form>
									            </td>
									        </tr>
								        @endforeach
								    </tbody>
								</table>
							</div>
						</div>
					</div>
					<div id="paging"></div>
				@else
					<div class="col-lg-12">
						<p class="content">Aucune page actuellement.</p>
					</div>
				@endif
			</div>
		</div>
	</div>

	@include('admin._footer')

	<script>
		$(document).ready(function(){
			var datatable = $('#table').DataTable({
				language: {
					url: "{{ asset('/admin/plugins/datatable/languages/french.json') }}"
				},
				oLanguage: {
					"sZeroRecords": "Aucune page trouvée.",
					"sEmptyTable": "Aucune page actuellement."
				},
				"sDom": '<"H">t<"F"p>'
			});

			$('#search').keyup(function(){
				datatable.search($(this).val()).draw() ;
			})
		});
	</script>

</body>
