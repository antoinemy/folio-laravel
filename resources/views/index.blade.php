@include('_header')

  <div id="home" class="container centered">
    <div class="col-md-offset-1 col-md-10">
      <div class="row">
        <div class="col-md-12 mt20 mb20">
          <div class="row row-eq-height">
            <div class="col-sm-4">
              <img src="{{ route('page_image_normal', [$page->id, 'original']) }}" class="img-circle img-thumbnail img-responsive center-block centered"/>
              <div class="centered-not">
                <a href="{{ $page->link_github }}" class="btn btn-circle btn-custom mr10" target="_blank"><span class="fa fa-github"></span></a>
                <a href="{{ $page->link_bitbucket }}" class="btn btn-circle btn-primary" target="_blank"><span class="fa fa-bitbucket"></span></a>
              </div>
            </div>
            <div class="col-sm-8">
              <h1 class="slabText">Antoine My <strong>Freelance</strong> <em>conception de sites internet</em> développeur &amp; intégrateur web</h1>
              <div class="animated-links">
                <a href="{{ route('articles') }}">#mesarticles</a>
                <a href="{{ route('projects') }}" class="float-right">@mesprojets</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@include('_footer')
