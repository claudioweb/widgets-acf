<?php 
if( function_exists('acf_add_local_field_group') ){

	$types = WidgetsAdmin::get_post_types();
	$pages = WidgetsAdmin::get_pages();
	$categories = WidgetsAdmin::get_taxonomies();

	acf_add_local_field_group(array (
		'key' => 'group_widget',
		'title' => 'Widget config',
		'fields' => array (
			array (
				'key' => 'widget_acf_show_bootstrap',
				'label' => 'Incorporar Bootstrap via plugin',
				'name' => 'widgets_acf_show_bootstrap',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => 'Sim',
				'ui_off_text' => 'Não',
				),
			array (
				'key' => 'widget_acf_show_css',
				'label' => 'Incorporar CSS do plugin',
				'name' => 'widgets_acf_show_css',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'message' => '',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => 'Sim',
				'ui_off_text' => 'Não',
				),
			array (
				'key' => 'widget_type_widget_acf',
				'label' => 'Post type',
				'name' => 'type_widget_acf',
				'type' => 'select',
				'instructions' => 'Widgets em todos os posts',
				'required' => 0,
				'conditional_logic' => array (),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'choices' => $types,
				'default_value' => array (
					),
				'allow_null' => 0,
				'multiple' => 1,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
				),
			array (
				'key' => 'widget_page_widget_acf',
				'label' => 'Páginas',
				'name' => 'page_widget_acf',
				'type' => 'select',
				'instructions' => 'Widgets em página especifica',
				'required' => 0,
				'conditional_logic' => array (),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'choices' => $pages,
				'default_value' => array (
					),
				'allow_null' => 0,
				'multiple' => 1,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
				),
			array (
				'key' => 'widget_tax_widget_acf',
				'label' => 'Tipo de Categoria (taxonomy)',
				'name' => 'tax_widget_acf',
				'type' => 'select',
				'instructions' => 'Categoria que terá MetaBox de Widgets',
				'required' => 0,
				'conditional_logic' => array (),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'choices' => $categories,
				'default_value' => array (
					),
				'allow_null' => 0,
				'multiple' => 1,
				'ui' => 1,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
				),
			),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-'.sanitize_title($plugin_nome),
					),
				),
			),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
		));

}
?>