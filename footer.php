  <div class="container-fluid">
        <footer class="row site-footer">
            <div class="col-xs-12" >
                <p><a href="http://andrearoenning.com"><img src="<?php bloginfo('template_directory'); ?>/img/pretzel.png" alt="Pretzel" title="Designed by Andrea Roenning"></a></p>
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
<?php wp_footer(); ?>
</body>
</html>
