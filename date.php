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

				<ul>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php if( is_year() ): ?>
						<h3><?php the_date( 'F' ); ?></h3>
			    	<?php endif; ?>
			    	<li><?php the_time( 'jS' ); ?> - <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; endif; ?>
				</ul>

        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
