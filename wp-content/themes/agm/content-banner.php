<div class="banner-wrapper">
	<div class="container">
		<?php
			$a_args = array(
				'post_type' => 'banner-slide',
				'posts_per_page' => 1
			);
			$o_posts = get_posts($a_args);
			if($o_posts) {
				foreach($o_posts as $o_post) {
					$s_attr = array(
						'class' => 'img-responsive'
					);
					echo '<div class="banner-image wp4 delay-1s">';
						echo get_the_post_thumbnail($o_post->ID, 'banner-image', $s_attr);
					echo '</div>';
				}
			}

		?>
		<a href="#product-page-container" class="register-now wp3 delay-05s" title="register now">Go to training!</a>
	</div>
	
</div>