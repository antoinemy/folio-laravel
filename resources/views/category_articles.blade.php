@include('_header')

  <div id="home" class="container">
    <div class="col-md-offset-1 col-md-10">
      <div class="row">
        <div class="col-md-12 mb90 mt30 animated-links">
          <a href="{{ route('index') }}">Retour</a>
          <a href="{{ route('articles') }}" class="float-right">#mesarticles</a>
          <h1 class="text-center title-part uppercase mt90">#{{ $category->name }}</h1>
        </div>
        <div class="col-md-12">
          @if(count($category->articles) > 0)
            @foreach($category->articles as $a)
              <div class="row row-eq-height mb60">
                <div class="col-sm-3">
                  <a href="{{ route('page_article', $a->id) }}">
                    <img src="{{ route('article_image_normal', [$a->id, 'original']) }}" class="img-circle img-thumbnail img-responsive center-block centered mb30"/>
                  </a>
                </div>
                <div class="col-sm-9">
                  <a href="{{ route('page_article', $a->id) }}"><h3>{{ $a->name }}</h3></a>
                  <p>{{ $a->desc }}</p>
                </div>
              </div>
            @endforeach
          @else
            <p>
              Aucun article actuellement.
            </p>
          @endif
        </div>
      </div>
    </div>
  </div>

@include('_footer')
