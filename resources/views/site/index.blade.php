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
  <div id="home" class="container centered">
    <div class="col-md-offset-1 col-md-10">
      <div class="row">
        <div class="col-md-12 mt20 mb20">
          <div class="row row-eq-height">
            <div class="col-sm-4">
              <img src="{{ asset('site/img/avatar.jpg') }}" class="img-circle img-thumbnail img-responsive center-block centered"/>
              <div class="centered-not">
                <a href="https://github.com/antoinemy" class="btn btn-circle btn-custom mr10" target="_blank"><span class="fa fa-github"></span></a>
                <a href="https://bitbucket.org/antoinemy/" class="btn btn-circle btn-primary" target="_blank"><span class="fa fa-bitbucket"></span></a>
              </div>
            </div>
            <div class="col-sm-8">
              <h1 class="slabText">Antoine My <strong>Freelance</strong> <em>conception de sites internet</em> développeur &amp; intégrateur web</h1>
              <div class="animated-links">
                <a href="{{ route('site.articles') }}">#mesarticles</a>
                <a href="{{ route('site.projects') }}" class="float-right">@mesprojets</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('site/js/jquery.min.js') }}"></script>
  <script src="{{ asset('site/js/jquery.slabtext.min.js') }}"></script>
  <script type="text/javascript">
    $(function() {
      $(".slabText").slabText({
          "viewportBreakpoint":0
      });
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
