<h1 class="page-title"><?php _e( 'Nothing Found', 'agm' ); ?></h1>

<div class="page-content">
	<?php 
		if ( is_home() && current_user_can( 'publish_posts' ) ) {
			printf( __( '<p>Ready to publish your first post? <a href="%1$s">Get started here</a></p>.', 'titan' ), admin_url( 'post-new.php' ) );
		} elseif ( is_search() ) {
			_e( '<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>', 'titan' );
			get_search_form();
		} else {
			_e( '<p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.</p>', 'titan' );
			get_search_form();
		}
	?>
</div><!-- page-content -->