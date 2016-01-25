<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Antoine My - Freelance, développeur et intégrateur web</title>
  <meta name="desc" content="Auto-entrepreneur dans la concéption de sites internet, webmaster, développeur et intégrateur web.">
  <link href='https://fonts.googleapis.com/css?family=Radley:400,400italic|Lato:400,400italic,700,700italic,900,900italic,300italic,300,100italic,100' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="{{ asset('site/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('site/css/animate.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('site/css/style.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
  <div id="home" class="container">
    <div class="col-md-offset-1 col-md-10">
      <div class="row">
        <div class="col-md-12 mb90 mt30 animated-links">
          <a href="{{ route('site.index') }}">Retour</a>
          <a href="{{ route('site.articles') }}" class="float-right">#mesprojets</a>
        </div>

        <div class="col-md-12 mt30">
          <div class="row row-eq-height mb90">
            <div class="col-sm-5">
              <img src="{{ route('article_image_normal', [$article->id, "original"]) }}" class="img-circle img-thumbnail img-responsive center-block centered mb30"/>
            </div>
            <div class="col-sm-7">
              <h1 class="title-page">{{ $article->name }}</h1>
              <a href="{{ route('site.category_articles', [$article->category->id]) }}">#{{ $article->category->name }}</a>
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
  <script src="{{ asset('site/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
    $(function() {
      animation();
      setInterval(animation, 12000);
    });
    function animation() {
      $('.animated-links a:nth-child(2)').addClass('animated rubberBand');
      $('.animated-links a:nth-child(2)').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        $('.animated-links a:nth-child(2)').removeClass('animated rubberBand');
        setTimeout(function() {
          $('.animated-links a:nth-child(1)').addClass('animated tada');
          $('.animated-links a:nth-child(1)').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
            $('.animated-links a:nth-child(1)').removeClass('animated tada');
          });
        }, 6000);
      });
    }
  </script>
</body>
</html>
