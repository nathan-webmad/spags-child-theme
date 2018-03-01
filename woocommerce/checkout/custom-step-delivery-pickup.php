<h1>Delivery / Pickup</h1>
<div class="my-custom-step">
<?php 

$id = 'delivery_pickup';
$label = 'Delivery or Pickup? ';
$validation_message = 'Please Delivery or Pickup';


$options = array();

$default_value = '';
$options[$default_value] = 'Please Select';
$options['delivery'] = 'Delivery';
$options['pickup'] = 'Pickup';

/* Restore original Post Data */
wp_reset_postdata();

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