<?php get_header(); ?>
	<div class="main-content container">
		<?php 
			if(have_posts()) {
				while(have_posts()) {
					the_post();
		?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php 
			the_content();
			} //end if
		}//end while
		else {
			/**
			* no content template
			*
			* @see content-empty.php
			*/
			get_template_part( 'content', 'empty' );
		}
		?>
	</div>
<?php get_footer(); ?>