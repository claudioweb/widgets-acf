<?php

Class get_fields_acf_widgets {

	public function get_field($widget,$fields){

		$fields = get_fields_acf_widgets::set_field($widget,$fields);

		$fields_base = array (
			'key' => $widget.'_widget_acf_key',
			'name' => $widget.'_widget_acf',
			'label' => ucfirst(str_replace('-',' ',str_replace('_', ' ', $widget))),
			'display' => 'line',
			'sub_fields' => $fields,
			'min' => '',
			'max' => '',
			);

		return $fields_base;
	}

	public function set_field($widget,$fields){

		$fields_return = array();

		if(!empty($fields)){

			$icon = $fields['icon'];
			unset($fields['icon']);

			// var_dump($fields);
			foreach ($fields as $key_field => $field) {

				$field['icon'] = $icon;

				if(empty($field['icon'])){
					$field['icon'] = 'fa fa-cube';
				}

				$field['wrapper']['class'] = $field['wrapper']['class'].' '.$field['icon'];

				$fd = $field;

				$key_field_name = $key_field;

				$key_field = explode('__',$key_field);


				include plugin_dir_path( __FILE__ ).'fields/'.$key_field[0].'.php';

				$fields_return[] = array_merge($field,$fd);;

			}

		}

		// var_dump($fields_return);

		return $fields_return;

	}

}

?>