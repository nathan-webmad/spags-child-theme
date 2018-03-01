<h1>Choose Store</h1>
<div class="my-custom-step choose-store">


<?php 
$id = 'delivery_address';
$label = 'Delivery Address';

//Address
woocommerce_form_field(  $id , array(
		'type'          => 'text',
		'class'         => array('my-field-class form-row-wide autocomplete-address'),
		'label'         => __($label),
		'placeholder'	=> 'Required',
		'required' 		=> true,
), $checkout->get_value( $id ));

?>
<span class="delivery-address-msg"></span>
<?php


$id = 'select_store';
$label = 'Select Store';
$default_value = '';

$options = array();
$options[$default_value] = 'Please Select';
// Query Arguments
$args = array(
		'post_type' => array('store'),
		'post_status' => array('publish'),
		'posts_per_page' => -1,
		'nopaging' => true,
		'order' => 'ASC',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();

		$title = get_the_title();

		$options[$title] = $title;

	}
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

//Choose Store
woocommerce_form_field(  $id , array(
		'type'          => 'select',
		'class'         => array('my-field-class form-row-wide'),
		'label'         => __($label),
		'placeholder'	=> 'Required',
		'required' 		=> true,
		'options'		=> $options,
), $checkout->get_value( $id ));




?>
</div>