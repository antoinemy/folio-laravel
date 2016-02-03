@include('admin._header')

@include('admin._menu')

	<div class="container">
		<div class="col-md-12">
			<div id="actions_row" class="row">
				@if(Auth::user()->can_create(6))
				<div class="col-md-8 col-sm-7 m-b-15">
					<a class="btn btn-primary" href="{{ route('admin.category_project.create') }}" title=""><span class="fa fa-plus"></span> Nouveau</a>
				</div>
				@endif
				@if(count($categories) > 0)
					<div class="{{ !Auth::user()->can_create(6) ? 'col-md-offset-8 col-sm-offset-5 col-md-4 col-sm-5 m-b-15' : ' col-md-4 col-sm-5 m-b-15' }}">
						<input type="text" id="search" class="form-control" placeholder="Rechercher une catégorie">
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
				@if(count($categories) > 0)
					<div class="col-xs-12">
						<div class="content">
							<div class="table-responsive">
								<table id="table" class="table table-striped">
								    <thead>
								        <tr>
								            <th>Visible</th>
								            <th>Nom de la catégorie</th>
								            <th></th>
								        </tr>
								    </thead>
								    <tbody>
									    @foreach($categories as $c)
									        <tr>
															<td>{!! $c->is_visible == 1 ? '<span class="label label-success">Oui</span>' : '<span class="label label-danger">Non</span>' !!}</td>
									            <td>{{ $c->name }}</td>
									            <td>
										            <form id="form_{{ $c->id }}" method="post" action="{{ route('admin.category_project.destroy', $c->id) }}">
											            <input type="hidden" name="_token" value="{{ csrf_token() }}">
											            <input type="hidden" name="_method" value="DELETE">
											            <div class="btn-group pull-right">
																		@if(Auth::user()->can_edit(6))
																		<a class="btn btn-xs btn-default" href="{{ route('admin.category_project.edit', $c->id) }}">
																			<span class="fa fa-pencil"></span>
																		</a>
																		@endif
																		@if(Auth::user()->can_delete(6))
																		<a class="btn btn-xs btn-danger" data-bb="confirm" data-id="{{ $c->id }}">
																			<span class="fa fa-times"></span>
																		</a>
																		@endif
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
						<p class="content">Aucune catégorie de projets actuellement.</p>
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
					"sZeroRecords": "Aucune catégorie de projets trouvée.",
					"sEmptyTable": "Aucune catégorie de projets actuellement."
				},
				"sDom": '<"H">t<"F"p>'
			});

			$('#search').keyup(function(){
				datatable.search($(this).val()).draw() ;
			})
		});
	</script>

	</body>
</html>
