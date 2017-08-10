<?php
Class banner_shortcode {

	static function fields(){

		$fields = array (
			'key' => 'banner_shortcode_key',
			'name' => 'banner_shortcode',
			'label' => 'Banner Shortcode',
			'display' => 'line',
			'sub_fields' => array (
				array (
					'key' => 'field_script_banner',
					'label' => 'Script DFP',
					'name' => 'script_banner',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
						),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					)
				)
			);
		return $fields;
	}

}
?>