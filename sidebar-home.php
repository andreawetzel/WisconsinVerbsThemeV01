        <aside class="col-md-4 col-lg-3 col-lg-offset-1 sidebar" >
            <div>
                <ul>
                <?php wp_list_categories('title_li='); ?>
                </ul>
            </div>
            <?php if ( ! dynamic_sidebar( 'side-widget-1' ) ); ?>
        </aside>
