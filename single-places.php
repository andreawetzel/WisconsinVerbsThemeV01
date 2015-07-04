<?php get_header(); ?>

<div class="container">
    <div class="row">     
        <div class="col-md-8 add-btm-margin">

            <?php get_template_part( 'content', 'places' ); ?>
            
        </div>
        <?php get_sidebar(); ?>  
    </div>
</div>

<?php get_footer(); ?>