	<button class="backToTop"></button>
	<script src="<? echo theme_uri; ?>/js/jquery.min.js"></script>
	<script src="<? echo theme_uri; ?>/js/bootstrap.min.js"></script>
	<script src="<? echo theme_uri; ?>/js/main.js"></script>
  <script type="text/javascript">
    var _sf_async_config={uid:38525,domain:"societeperrier.com"};
    (function(){
      function loadChartbeat() {
        window._sf_endpt=(new Date()).getTime();
        var e = document.createElement('script');
        e.setAttribute('language', 'javascript');
        e.setAttribute('type', 'text/javascript');
        e.setAttribute('src',
           (("https:" == document.location.protocol) ? "https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/" : "http://static.chartbeat.com/") +
           "js/chartbeat.js");
        document.body.appendChild(e);
      }
      var oldonload = window.onload;
      window.onload = (typeof window.onload != 'function') ?
         loadChartbeat : function() { oldonload(); loadChartbeat(); };
    })();

  </script>
  <? if(is_single()) : ?>
  <script type="text/javascript">
    var addthis_config = {"data_track_addressbar":true, "data_track_clickback": false };
  </script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4f79efcc72cb6d9e"></script>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<? endif; ?>
	<? wp_footer(); ?>
</body>
</html>