<?php get_header('default'); ?>
	<section class="cart-page">
		<div class="container">
			<h1>Checkout</h1>
			<?php echo do_shortcode('[woocommerce_checkout]');?>
		</div>
	</section>
<?php get_footer(); ?>