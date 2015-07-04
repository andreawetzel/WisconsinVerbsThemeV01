        <aside class="col-md-4 col-lg-3 col-lg-offset-1 sidebar" >
            <div>
                <h3><a href="<?php bloginfo('site_url'); ?>"><?php bloginfo('name'); ?></a></h3>
                <p><?php bloginfo('description'); ?></p>
            </div>
            <div>
                <ul>
                <?php wp_list_categories('title_li='); ?>
                </ul>
            </div>
            <?php if ( ! dynamic_sidebar( 'side-widget-1' ) ); ?>
        </aside>
