<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package flimedia
 */

get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found text-center">

		<div class="page-content">
			<div class="row">
				<div class="columns small-12 large-6">
					<h1>404 (Page Not Found)</h1>
				</div>
				<div class="columns small-12 large-6">
					<h2>Oops!</h2>
					<p>Something went wrong or this page does not exist.</p>
					<a href="<?php echo site_url(); ?>" aria-label="homepage link" class="button">Return Home</a>
				</div>
			</div>
		</div><!-- END .page-content -->

	</section><!-- END .error-404 -->

</main><!-- #main -->

<?php
get_footer();
