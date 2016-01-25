    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slabtext.min.js') }}"></script>
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
