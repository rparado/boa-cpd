<?php get_header('home'); ?>
<div class="subscription-page">
	<div class="container">
		<div class="boa-banner">
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
		</div>
		<div class="form-subscribe-wrapper wp9">
			<?php echo do_shortcode('[contact-form-7 title="Contact form 1"]'); ?>
		</div>
	</div>
</div>
<?php echo get_footer('home'); ?>