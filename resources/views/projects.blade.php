@include('_header')

  <div id="home" class="container">
    <div class="col-md-offset-1 col-md-10">
      <div class="row">
        <div class="col-md-12 mb90 mt30 animated-links">
          <a href="{{ route('index') }}">Retour</a>
          <a href="{{ route('articles') }}" class="float-right">#mesarticles</a>
          <h1 class="text-center title-part uppercase mt90">@mesprojets</h1>
        </div>
        <div class="col-md-12">
          @if(count($projects) > 0)
            @foreach($projects as $p)
              <div class="row row-eq-height mb60">
                <div class="col-sm-3">
                  <a href="{{ route('page_project', $p->id) }}">
                    <img src="{{ route('project_image_normal', [$p->id, 'original']) }}" class="img-circle img-thumbnail img-responsive center-block centered mb30"/>
                  </a>
                </div>
                <div class="col-sm-9">
                  <a href="{{ route('page_project', $p->id) }}"><h3>{{ $p->name }}</h3></a>
                  <p>{{ $p->desc }}</p>
                  <a href="{{ route('category_projects', [$p->category->id]) }}">#{{ $p->category->name }}</a>
                </div>
              </div>
            @endforeach
          @else
            <p>
              Aucun projet actuellement.
            </p>
          @endif
        </div>
      </div>
    </div>
  </div>

@include('_footer')
