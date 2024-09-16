<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blocksy
 */

blocksy_after_current_template();
do_action('blocksy:content:bottom');

?>
	</main>

	<?php
		do_action('blocksy:content:after');
		do_action('blocksy:footer:before');

		blocksy_output_footer();

		do_action('blocksy:footer:after');
	?>
    <!-- Inventory availablity modal (Register Interest)  -->
    <div id="availabilityModal" class="custom-modal-overlay">
      <div class="custom-modal">
        <button class="custom-modal-close">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="https://www.w3.org/2000/svg" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <h6>Register Interest</h6>
        <h3 class="inventory-title" id="inventory">Inventory Name</h3>
        <p>VIN: <span id="vin"></span></p>
        <p>STOCK: <span id="stock"></span></p>
        <?php echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]'); ?>
      </div>
    </div>

</div>

<?php wp_footer(); ?>

</body>
</html>
