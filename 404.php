<?php get_header(); ?>
<div class="title-bg hero-title-bg">
    <div class="container">
        <div class="row">
            <div class="archive-leader col-sm-12">
                <h1><?php wp_title( '' ); ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 add-btm-margin">
            <p><img src="<?php bloginfo('template_directory'); ?>/img/lola-snow-404-lost.jpg"></p>
            <p>Whoops, we seem to have lost something.</p>
            <p><a href="<?php bloginfo('url'); ?>">Return home</a></p>
            <?php get_search_form(); ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
