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

				$dir = plugin_dir_path( __FILE__ ).'fields/'.$key_field[0].'.php';
				if(file_exists($dir)){
					include $dir;
				}

				if($key_field[0]=='repeater'){

					$fd = get_fields_acf_widgets::sub_fields($fd);
				}

				$fields_return[] = array_merge($field,$fd);

				$icon = 'not-icon';

			}

		}

		// var_dump($fields_return);

		return $fields_return;

	}

	public function sub_fields($fd){


		$subs_fields = array();

		foreach ($fd['sub_fields'] as $key_sub => $sub) {

			$key_field_name = $key_sub.'_sub';

			$key_sub = explode('__',$key_sub);

			$dir = plugin_dir_path( __FILE__ ).'fields/'.$key_sub[0].'.php';
			if(file_exists($dir)){
				include $dir;
			}

			$subs_fields[] = array_merge($field,$sub);
		}

		$fd['sub_fields'] = $subs_fields;

		$sub_sub = array();
		foreach ($fd['sub_fields'] as $field) {
			if($field['type']=='repeater'){
				$sub_sub[] = get_fields_acf_widgets::sub_fields($field);
			}
		}

		$fd['sub_fields'] = array_merge($fd['sub_fields'],$sub_sub);

		return $fd;

	}

}

?>