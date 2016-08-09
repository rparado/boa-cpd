<?php get_header(); ?>
<div class="content-header-wrapper">
	<div class="container">
		<p class="wp4 delay-105s">
			Learn from the most sought after speaker
			in the Accounting Industry TODAY!
		</p>
	</div>
</div>
<div class="main-content container wp3 delay-05s">
	<?php 
		while ( have_posts() ) { 
			the_post(); 
	?>
			<h1 class="page-title hide"><?php the_title(); ?></h1>
	<?php the_content(); 
			
		} 
	?>
	<div class="learn-wrapper clearfix">
		<h3>What can you learn from him?</h3>
		<?php echo get_field('additional_fields'); ?>
	</div>
	<a href="" class="register-now wp5 delay-05s" title="register now">Register Now!</a>
</div><!-- main-content -->
<div class="content-header-wrapper main-page-title">
	<div class="container">
		<h1>Comply, Learn and be extraordinary today!</h1>
	</div>
</div>
<div class="testimonials-wrapper">
	<div class="container mobile-testimonial-title">
		<h4>What participants are saying about us...</h4>
	</div>
	<div class="cycle-slideshow" data-cycle-fx="fade" data-cycle-speed="2000" data-cycle-pager=".cycle-pager">
		<?php 
			$a_args = array(
				'post_type' => 'testimonial-items',
				'posts_per_page' => -1,
				'order' => 'ASC',
				'orderby' => 'menu_order'
			);
			$o_posts = get_posts($a_args);
			foreach($o_posts as $o_post)
			{
				$attr = array(
					'class' => 'img-responsive'
				);
				echo '<div class="slide-items">';
				echo '<div class="hidden-xs visible-md visible-lg">';
					echo get_the_post_thumbnail($o_post->ID, 'testimonial',$attr);
				echo '</div>';
		?>
			<div class="slide-content container">
				<h4>What participants are saying about us...</h4>
				<?php echo wpautop($o_post->post_content); ?>
				<h5><?php echo $o_post->post_title; ?></h5>
				
			</div>
		<div class="cycle-pager"></div>
	</div>
		<?php } wp_reset_postdata(); ?>
	</div>
</div>
<div class="content-header-wrapper speakers-profile">
	<div class="container wp5 delay-05s">
		<h3>Speakers Profile</h3>
	</div>
</div>
<div class="speaker-content-wrapper">
	<div class="container clearfix">
		<div class="speaker-content-left wp3 delay-05s">
			<?php echo get_field('speakers_profile'); ?>
		</div>
		<div class="speaker-image wp3 delay-1s">
			<img src="<?php echo get_bloginfo('template_directory') ?>/images/nus.png" alt="Niel Sison" class="img-responsive" />
		</div>
	</div>
	<div class="promaker-wrapper wp4 delay-1s">
		<div class="container">
			<div class="col-xs-12 col-md-6 promaker-site">
				<a href="http://www.promaker.ph" class="logo-promaker" target="_blank">
					<img src="<?php echo get_bloginfo('template_directory') ?>/images/promaker-logo.png" alt="Promaker" class="img-responsive" />
				</a>
			</div>
			<div class="col-xs-12 col-md-6 cart-counter-wrapper">
				<a class="cart-show" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
					<span class="cart-icon"></span>
					<span class="cart-items"><?php echo $woocommerce->cart->cart_contents_count;?></span>
				</a>
			</div>
		</div>
	</div>
</div>
<div class="promaker-wrapper wp4 delay-1s">
	<div class="container">
		<div class="col-xs-12 col-md-6 promaker-site">
			<a href="http://www.promaker.ph" class="logo-promaker" target="_blank">
				<img src="<?php echo get_bloginfo('template_directory') ?>/images/promaker-logo.png" alt="Promaker" class="img-responsive" />
			</a>
		</div>
		<div class="col-xs-12 col-md-6 cart-counter-wrapper">
			<a class="cart-show" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
				<span class="cart-icon"></span>
				<span class="cart-items"><?php echo $woocommerce->cart->cart_contents_count;?></span>
			</a>
		</div>
	</div>
</div>
<div class="product-wrapper">
	<div class="container">
		<h3>investment fee:</h3>
		<div class="option-group-wrapper clearfix">
			<div class="location-select-wrapper">
				<label for="location">Location:</label>
				<select class="selectpicker" name="location">
					<option>ALL</option>
					<option>Manila</option>
					<option>Cebu</option>
					<option>Cagayan de Oro</option>
					<option>Davao</option>
					<option>Butuan</option>
				</select>
			</div>
			<div class="date-select-wrapper">
				<label for="date">Date:</label>
				<select class="selectpicker" name="date">
					<option>ALL</option>
					<option>July</option>
					<option>August</option>
					<option>September</option>
					<option>October</option>
					<option>November</option>
					<option>December</option>
				</select>
			</div>
			<div class="thematic-select-wrapper">
				<label for="theamtic area">Thematic Area:</label>
				<select class="selectpicker" name="thematic area">
					<option>ALL</option>
					<option>I</option>
					<option>II</option>
					<option>III</option>
					<option>IV</option>
					<option>V</option>
				</select>
			</div>
		</div>
		
		<?php echo do_shortcode('[products orderby="menu_order"]');?>
		<div class="proceed-to-cart">
			<a class="cart-btn" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
				Proceed to cart
			</a>
		</div>
	</div>
	
</div>
<?php get_footer(); ?>