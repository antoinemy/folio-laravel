@include('_header')

  <div id="home" class="container">
    <div class="col-md-offset-1 col-md-10">
      <div class="row">
        <div class="col-md-12 mb90 mt30 animated-links">
          <a href="{{ route('index') }}">Retour</a>
          <a href="{{ route('projects') }}" class="float-right">#mesprojets</a>
        </div>

        <div class="col-md-12 mt30">
          <div class="row row-eq-height mb90">
            <div class="col-sm-5">
              <img src="{{ route('project_image_normal', [$project->id, "original"]) }}" class="img-circle img-thumbnail img-responsive center-block centered mb30"/>
            </div>
            <div class="col-sm-7">
              <h1 class="title-page">{{ $project->name }}</h1>
              <a href="{{ route('category_projects', [$project->category->id]) }}">#{{ $project->category->name }}</a>
            </div>
          </div>
        </div>

        <div class="col-md-12 mt30">
          <div class="row mb60">
            <div class="col-sm-12 content-page">
              {!! $project->content !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@include('_footer')
