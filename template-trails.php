<?php
/*
**Template Name: Trails Template
*/
?>

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
    <div class="col-md-8">
      <div class="page-content">
        <?php if ( have_posts() ) : while ( have_posts() ): the_post(); 
          // Display page content as intro
        ?>
        <?php the_content(); ?>
        <?php endwhile; endif; ?>
        <? wp_reset_postdata(); ?>
      </div>
    </div>
  </div>

  <?php 
  // Second query to display hiking and biking trails
  $args = array( 'post_type' => array('wiverb_hike', 'wiverb_bike'), 'posts_per_page' => '6', 'orderby' => 'title', 'order' => 'asc' );
  $query2 = new WP_Query( $args );
  
  if ( $query2->have_posts() ) { ?>
  <div class="row">
  <?php while ( $query2->have_posts() ) {
    $query2->the_post(); 
    $postType = get_post_type(get_the_ID());
    switch($postType){
     case 'wiverb_hike':
        $postTypeText = 'Hike';
        $postTypeClass = 'bg-blue';
        break;
     case 'wiverb_bike':
        $postTypeText = 'Bike';
        $postTypeClass = 'bg-red';
        break;
     } ?>
   <div class="col-sm-3">
    <div class="trl-tag <?php echo $postTypeClass ?>"><?php echo $postTypeText; ?></div>
    <div><a href="<?php echo get_the_permalink($query2->post->ID);?>">
      <?php echo get_the_post_thumbnail($query2->post->ID, 'thumbnail') ?>
    </a></div>
   <div class="trl-link"><a href="<?php echo get_the_permalink($query2->post->ID);?>">
      <?php echo get_the_title($query2->post->ID); ?>
   </a></div>
   </div>
   <?php } //End While
    wp_reset_postdata(); ?>
  </div>
  <?php } //End if ?>
</div>
<?php get_footer(); ?>
