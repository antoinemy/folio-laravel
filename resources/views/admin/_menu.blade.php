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
				<a class="navbar-brand" href="#">Locabike</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="{{ active(['admin/dashboard*'], 'active') }}">
						<a href="{{ route('admin.dashboard.index') }}"><span class="fa fa-modx"></span> Dashboard</a>
					</li>

					<li class="{{ active(['admin/admin*'], 'active') }}">
						<a href="{{ route('admin.admin.index') }}"><span class="fa fa-users"></span> Administrateurs</a>
					</li>

					<li class="dropdown {{ active(['admin/article*', 'admin/category/news*'], 'active') }}">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="fa fa-paper-plane"></span> Articles <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="{{ active(['admin/category/news*'], 'active') }}">
								<a href="{{ route('admin.category_news.index') }}">Catégories</a>
							</li>
							<li class="{{ active(['admin/article*'], 'active') }}">
								<a href="{{ route('admin.article.index') }}">Articles</a>
							</li>
						</ul>
					</li>

					<li class="{{ active(['admin/page*'], 'active') }}">
						<a href="{{ route('admin.page.index') }}"><span class="fa fa-paperclip"></span> Pages</a>
					</li>

					<li>
						<a class="color-red" href="{{ route('logout') }}"><span class="fa fa-power-off"></span></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
