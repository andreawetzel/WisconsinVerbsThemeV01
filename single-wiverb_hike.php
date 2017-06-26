<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col-xs-12 blog-post-single add-btm-margin">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <section <?php post_class() ?> id="post-<?php the_ID(); ?>">         
        <div class="row">
          <div class="col-md-6">
            <h1>Hiking Trail: <?php the_title(); ?></h1> 
            <?php the_content(); ?>
          </div>
          <div class="col-md-6">
            <?php
            if ( has_post_thumbnail() ) { ?>
              <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('medium'); ?></a>
           <?php }  ?>
          </div>
          <div class="col-xs-12">
            <p><a href="<?php echo get_post_type_archive_link( 'wiverb_hike' ); ?>">
                More Hiking Trails
            </a></p>
          </div>
        </div> 
      </section> 
    <?php endwhile; endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
