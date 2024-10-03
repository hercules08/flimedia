<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */


/* 
-----------------------------------------------------------------------------------------------

View Key Concepts: https://www.advancedcustomfields.com/resources/acf-blocks-key-concepts/
View Block.json Metadata: https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/

-----------------------------------------------------------------------------------------------
*/

// Create class attribute allowing for custom "className".
$class_name = 'testimonial';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Fetch block settings
$block_settings = get_block_settings_styles(); 

// Load block values.
$testimonial_quote             = ! empty( get_field( 'testimonial_quote' ) ) ? get_field( 'testimonial_quote' ) : 'Your quote here...';
$testimonial_author            = get_field( 'testimonial_author' );
$testimonial_association       = get_field( 'testimonial_association' );
?>


<?php // Block preview
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/template-parts/blocks/<?php echo esc_attr( $class_name ); ?>/block-preview.jpg" alt="Preview of the <?php echo esc_attr( $class_name ); ?> custom block">
    </figure>
<?php } else { ?>


	<!-- Note: Custom blocks should use either flexbox or css grid for columns. -->

	<div class="<?php echo esc_attr( $class_name . '-block' ); ?> <?php echo esc_attr( $block_settings['classes'] ); ?>">
		<div class="block-wrapper">
			<div class="block-container round" style="<?php echo esc_attr( $block_settings['styles'] ); ?>">
				<blockquote>
					<p>"<?php echo $testimonial_quote; ?>"</p>
				</blockquote>
				<p class="testimonial-author"><?php echo $testimonial_author; ?></p>
				<p><?php echo $testimonial_association; ?></p>
			</div>
		</div>
	</div>


<?php } ?>