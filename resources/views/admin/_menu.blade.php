<nav class="navbar navbar-default navbar-custom">
	<div class="container">
		<div class="col-md-12">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="brand-align">
					<img src="{{ route("admin_image_small", [Auth::user()->id, "original"]) }}" alt="" class="float-left img-sm img-circle m-r-10" />
					<ul class="float-left nonul">
						<li><a href="{{ route('admin.admin.edit', [Auth::user()->id]) }}">{{ Auth::user()->last_name.' '.Auth::user()->first_name }}</a></li>
						<li><a href="{{ route('logout') }}"><small>Déconnexion <span class="fa fa-sign-out"></span></small></a></li>
					</ul>
				</div>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="{{ active(['admin/dashboard*'], 'active') }}">
						<a href="{{ route('admin.dashboard.index') }}"><span class="fa fa-modx"></span> Dashboard</a>
					</li>

					@if(Auth::user()->can_show(1))
						<li class="{{ active(['admin/admin*'], 'active') }}">
							<a href="{{ route('admin.admin.index') }}"><span class="fa fa-users"></span> Administrateurs</a>
						</li>
					@endif

					@if(Auth::user()->can_show(2) || Auth::user()->can_show(5))
						<li class="dropdown {{ active(['admin/article*', 'admin/category/article*'], 'active') }}">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<span class="fa fa-paper-plane"></span> Articles <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								@if(Auth::user()->can_show(5))
								<li class="{{ active(['admin/category/article*'], 'active') }}">
									<a href="{{ route('admin.category_article.index') }}">Catégories</a>
								</li>
								@endif
								@if(Auth::user()->can_show(2))
								<li class="{{ active(['admin/article*'], 'active') }}">
									<a href="{{ route('admin.article.index') }}">Articles</a>
								</li>
								@endif
							</ul>
						</li>
					@endif

					@if(Auth::user()->can_show(3) || Auth::user()->can_show(6))
						<li class="dropdown {{ active(['admin/project*', 'admin/category/project*'], 'active') }}">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<span class="fa fa-cube"></span> Projets <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								@if(Auth::user()->can_show(6))
								<li class="{{ active(['admin/category/project*'], 'active') }}">
									<a href="{{ route('admin.category_project.index') }}">Catégories</a>
								</li>
								@endif
								@if(Auth::user()->can_show(3))
								<li class="{{ active(['admin/project*'], 'active') }}">
									<a href="{{ route('admin.project.index') }}">Projets</a>
								</li>
								@endif
							</ul>
						</li>
					@endif

					@if(Auth::user()->can_show(4))
						<li class="{{ active(['admin/page*'], 'active') }}">
							<a href="{{ route('admin.page.index') }}"><span class="fa fa-paperclip"></span> Pages</a>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</nav>
