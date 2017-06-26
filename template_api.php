<?php
/*
**Template Name: API Template
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
        <div class="col-md-8 add-btm-margin">
            <div class="page-content">
                <h2>Here are my Git Hub Repos</h2>
                <?php
                    $results = get_transient('wi_verbs_repos2');
                    if ($results === false) {
                        //$response = wp_remote_get('https://api.github.com/users/andreawetzel/repos');

                        $response = wp_remote_get('https://api.github.com/users/andreawetzel/repos');

                        $results = wp_remote_retrieve_body($response);

                        //echo $response;


                        set_transient( 'wi_verbs_repos2', $results, 60*60*12); //Expire in 12 hours
                    }
                    $repos = json_decode($results);


                    //print_r($repos);
                    foreach( $repos AS $r ) {
                       echo '<p>';
                       echo "<a href='{$r->html_url}'>{$r->name}</a>";
                       echo '</p>';
                    }
                 ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>


<?php get_footer(); ?>
