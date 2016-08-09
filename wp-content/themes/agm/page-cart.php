<?php get_header('default'); ?>
	<section class="cart-page">
		<div class="container">
			<h1>My Shopping Cart</h1>
			<?php echo do_shortcode('[woocommerce_cart]');?>
		</div>
	</section>
<?php get_footer(); ?>