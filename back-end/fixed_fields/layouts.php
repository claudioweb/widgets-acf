<?php 

$sub_fields[] = array(
	'key' => 'field_tamanho_grid_desktop_'.$prefixed_widget,
	'label' => 'Tamanhos Desktop',
	'name' => 'tamanho-grid-desktop',
	'type' => 'select',
	'instructions' => '',
	'required' => 0,
	'conditional_logic' => 0,
	'wrapper' => array (
		'width' => '',
		'class' => 'grid_widget_settings ',
		'id' => '',
		),
	'choices' => array (
		'full' => '100%',
		'col-sm-12' => '12/12',
		'col-sm-8' => '8/12',
		'col-sm-6' => '6/12',
		'col-sm-4' => '4/12',
		'col-sm-3' => '3/12',
		'col-sm-2' => '2/12'
		),
	'default_value' => 'col-sm-6',
	'allow_null' => 0,
	'multiple' => 0,
	'ui' => 0,
	'ajax' => 0,
	'return_format' => 'value',
	'placeholder' => '',
	);

// $sub_fields[] = array(
// 	'key' => 'field_tamanho_grid_mobile'.$prefixed_widget,
// 	'label' => 'Tamanhos Mobile',
// 	'name' => 'tamanho-grid-mobile',
// 	'type' => 'select',
// 	'instructions' => '',
// 	'required' => 0,
// 	'conditional_logic' => 0,
// 	'wrapper' => array (
// 		'width' => '',
// 		'class' => '',
// 		'id' => '',
// 		),
// 	'choices' => array (
// 		'full' => '100%',
// 		'col-xs-12' => '12/12',
// 		'col-xs-8' => '8/12',
// 		'col-xs-6' => '6/12',
// 		'col-xs-4' => '4/12',
// 		'col-xs-3' => '3/12',
// 		'col-xs-2' => '2/2'
// 		),
// 	'default_value' => 'col-sm-6',
// 	'allow_null' => 0,
// 	'multiple' => 0,
// 	'ui' => 1,
// 	'ajax' => 0,
// 	'return_format' => 'value',
// 	'placeholder' => '',
// 	);