  <div class="container-fluid">
        <footer class="row site-footer">
            <div class="col-xs-12" >
                <p><a href="http://andreawetzel.com"><img src="<?php bloginfo('template_directory'); ?>/img/pretzel.png" alt="Pretzel" title="Designed by Andrea Wetzel"></a></p>
            </div>
            <div class="col-xs-12">
                <?php if ( ! dynamic_sidebar( 'instagram-widget' ) ); ?>
            </div>
            <div class="col-md-4">
                <?php if ( ! dynamic_sidebar( 'footer-widget-1' ) ); ?>
            </div>
            <div class="col-md-4">
                <?php if ( ! dynamic_sidebar( 'footer-widget-2' ) ); ?>
            </div>
            <div class="col-md-4">
                <?php if ( ! dynamic_sidebar( 'footer-widget-3' ) ); ?>
            </div>
        </footer>
    </div>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-57133531-3', 'auto');
      ga('send', 'pageview');

    </script>
<?php wp_footer(); ?>
</body>
</html>
