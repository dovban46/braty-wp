<?php
/*
=====================
	ACF functions
=====================
*/


/*
=====================
	ACF options page
=====================
*/
function my_acf_op_init() {

	// Check function exists.
	if ( function_exists( 'acf_add_options_page' ) ) {

		// Add parent.
		$parent = acf_add_options_page(
			array(
				'page_title' => __( 'Theme Options' ),
				'menu_title' => __( 'Theme Options' ),
				'redirect'   => false,
			)
		);

		// Add sub page.
		$headerOptions    = acf_add_options_page(
			array(
				'page_title'  => __( 'Header Options' ),
				'menu_title'  => __( 'Header' ),
				'parent_slug' => $parent['menu_slug'],
			)
		);
		$footerOptions    = acf_add_options_page(
			array(
				'page_title'  => __( 'Footer Options' ),
				'menu_title'  => __( 'Footer' ),
				'parent_slug' => $parent['menu_slug'],
			)
		);
		$locationsOptions = acf_add_options_page(
			array(
				'page_title'  => __( 'Maintenance Mode' ),
				'menu_title'  => __( 'Maintenance Mode' ),
				'parent_slug' => $parent['menu_slug'],
			)
		);
		$scripts          = acf_add_options_page(
			array(
				'page_title'  => __( 'Scripts' ),
				'menu_title'  => __( 'Scripts' ),
				'parent_slug' => $parent['menu_slug'],
			)
		);
	}
}
add_action( 'acf/init', 'my_acf_op_init' );


/*
=====================
	ACF Flexible Template Loop
=====================
*/
function the_acf_loop() {
	get_template_part( 'template-parts/loop/acf-blocks', 'loop' );
}
function the_acf_archive_loop() {
	get_template_part( 'template-parts/loop/acf-blocks-archive', 'loop' );
}


/*
=====================
	ACF Section Options Handler
=====================
*/

function get_acf_block_options() {
	$options = get_sub_field( 'options' );

	$params = array(
		'id'    => '',
		'class' => '',
		'style' => '',
	);

	if ( $options ) :

		//Block spacings
		if ( $options['change_topbottom_spacings'] ) :

			//spacings desktop
			$params['class'] .= ' pt-lg-' . $options['spacing_top_desktop'];
			$params['class'] .= ' pb-lg-' . $options['spacing_bottom_desktop'];

			//spacings tablet
			$params['class'] .= ' pt-md-' . $options['spacing_top_tablet'];
			$params['class'] .= ' pb-md-' . $options['spacing_bottom_tablet'];

			//spacings mobile
			$params['class'] .= ' pt-' . $options['spacing_top_mobile'];
			$params['class'] .= ' pb-' . $options['spacing_bottom_mobile'];

		endif;

		//Block custom classes
		if ( $options['block_custom_classes'] ) :
			$params['class'] .= ' ' . $options['block_custom_classes'];
		endif;

		//Block background color
		if ( $options['add_background_image'] ) :
			$params['style'] .= 'background-size:cover; background-image:url(' . $options['background_image'] . ');';
		endif;

		//Block background image
		if ( $options['change_background_color'] ) :
			$params['style'] .= 'background-color:' . $options['background_color'] . ';';
		endif;

		//Block text color
		if ( $options['text_color'] != 'default' ) :
			$params['class'] .= ' text-color-' . $options['text_color'];
		endif;

		//Block ID
		$params['id'] = $options['block_id'] ? $options['block_id'] : '';
	endif;

	return $params;
}

function get_acf_container_paddings() {
	$change_paddings = get_sub_field( 'container_paddings_change_topbottom_spacings' );

	$classes = '';

	if ( $change_paddings ) {
		$spacing_top_desktop           = get_sub_field( 'container_paddings_spacing_top_desktop' );
		$spacing_bottom_desktop        = get_sub_field( 'container_paddings_spacing_bottom_desktop' );
		$spacing_top_tablet            = get_sub_field( 'container_paddings_spacing_top_tablet' );
		$spacing_bottom_tablet         = get_sub_field( 'container_paddings_spacing_bottom_tablet' );
		$spacing_spacing_top_mobile    = get_sub_field( 'container_paddings_spacing_top_mobile' );
		$spacing_spacing_bottom_mobile = get_sub_field( 'container_paddings_spacing_bottom_mobile' );

		//spacings desktop
		$classes .= ' pt-lg-' . $spacing_top_desktop;
		$classes .= ' pb-lg-' . $spacing_bottom_desktop;

		//spacings tablet
		$classes .= ' pt-md-' . $spacing_top_tablet;
		$classes .= ' pb-md-' . $spacing_bottom_tablet;

		//spacings mobile
		$classes .= ' pt-' . $spacing_spacing_top_mobile;
		$classes .= ' pb-' . $spacing_spacing_bottom_mobile;
	}

	return $classes;
}
