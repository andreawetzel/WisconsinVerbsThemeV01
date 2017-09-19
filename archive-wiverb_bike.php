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
        
      <?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
      <div class="col-md-6 add-btm-margin">
          <article class="blog-post">
              <?php if ( has_post_thumbnail() ) { ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>    
              <?php }  ?>
              <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h4>

          </article>
        </div>
          <?php endwhile ?>
              <div class="previous-next-container">
                  <div class="pull-left"><?php previous_posts_link( 'Newer' ); ?></div>
                  <div class="pull-right"><?php next_posts_link( 'Older' ); ?></div>
              </div>
          <?php else: ?>
          <p>there are no posts to display</p>
      <?php endif; ?>
      
      <?php //get_sidebar(); ?>
    </div>
</div>


<?php get_footer(); ?>
