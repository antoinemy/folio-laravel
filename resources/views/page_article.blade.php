@include('_header')

  <div id="home" class="container">
    <div class="col-md-offset-1 col-md-10">
      <div class="row">
        <div class="col-md-12 mb90 mt30 animated-links">
          <a href="{{ route('index') }}">Retour</a>
          <a href="{{ route('articles') }}" class="float-right">#mesprojets</a>
        </div>

        <div class="col-md-12 mt30">
          <div class="row row-eq-height mb90">
            <div class="col-sm-5">
              <img src="{{ route('article_image_normal', [$article->id, "original"]) }}" class="img-circle img-thumbnail img-responsive center-block centered mb30"/>
            </div>
            <div class="col-sm-7">
              <h1 class="title-page">{{ $article->name }}</h1>
              <a href="{{ route('category_articles', [$article->category->id]) }}">#{{ $article->category->name }}</a>
            </div>
          </div>
        </div>

        <div class="col-md-12 mt30">
          <div class="row mb60">
            <div class="col-sm-12 content-page">
              {!! $article->content !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@include('_footer')
