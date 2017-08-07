<?php
Class line_banner {

	static function set_fields(){

		add_action( 'admin_enqueue_scripts', array('line_banner', 'css_widget_admin_line_banner') );

		$fields = array (
			'key' => 'line_banner_key',
			'name' => 'line_banner',
			'label' => 'Banner Horizontal',
			'display' => 'table',
			'sub_fields' => array (
				array (
					'key' => 'field_script_banner_horizontal',
					'label' => 'Script DFP',
					'name' => 'script_banner_horizontal',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => 'line_banner',
						'id' => '',
						),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					),
				)
			);
		return $fields;
	}

	public function css_widget_admin_line_banner() {
		wp_enqueue_style( 'css_widget_admin_line_banner', plugins_url('css/admin.css',__FILE__));
	}

}
?>