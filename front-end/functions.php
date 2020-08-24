<?php

Class TemplatesWidgets {

	public function __construct() {}

	static function get_templates($layout_content, $attr = null) {
		$html = '';

		foreach($layout_content as $key => $layout):
			include "styles_layout.php";

			if($layout['attr']['field_radio_mobile_setting'] == 0)
				$class_setting .= ' hidden-xs';

			$html .= "<section id=\"{$id_setting}\" class=\"{$class_setting}\" style=\"" . implode(' ', $style_bg) . ' ' . implode(' ', $style_attr) . "\">";

			if($layout['attr']['largura_layout_setting'] == 'container')
				$html .= '<div class="container">';
			else
				$html .= '<div class="container-fluid" style="padding: 0;">';

			$html .= '<div class="row">';

			$count_column = 0;

			foreach($layout as $key_l => $w_content):
				if(!array_key_exists('content', $w_content))
					continue;

				$layout_widget = str_replace('_widget_acf', '', $w_content['layout']);
				$widget_name = str_replace('_', '-', $layout_widget);
				$dir_widget = get_template_directory() . "/widgets-templates/{$widget_name}";
				$plugin_widget = false;

				if(function_exists('\App\template') || function_exists('\Roots\view'))
					$dir_widget = get_template_directory() . "/views/widgets-templates/{$widget_name}";

				if(!is_dir($dir_widget)):
					$dir_widget = plugin_dir_path(__FILE__) . "../more-widgets-templates/{$widget_name}";
					$plugin_widget = true;
				endif;

				$files = glob("{$dir_widget}/index.*");

				if(empty($files))
					continue;

				if($count_column > count($w_content['columns']) - 1)
					$count_column = 0;

				$columns = $w_content['content']['field_tamanho_grid_desktop_' . $layout_widget . '_widget_acf_key'];
				
				$style = '';

				if($columns == 'full-widget-acf')
					$style = 'width: 100%; overflow: hidden;';

				$html .= "<div class=\"widget_acf {$columns} {$w_content['class']}\" style=\"{$style}\">";

				ob_start();

				$fields = $w_content['content'];
				$widget->fields = TemplatesWidgets::get_image($fields);
				
				if(function_exists('\App\template') && !$plugin_widget):
					$template = "widgets-templates.{$widget_name}.index";

					echo \App\template($template, ['widget' => $widget]);
				elseif(function_exists('\Roots\view') && !$plugin_widget):
					$template = "widgets-templates.{$widget_name}.index";

					echo \Roots\view($template, ['widget' => $widget]);
				else:
					include "{$files[0]}";
				endif;

				$html .= ob_get_clean();
				$html .= '</div>';

				$count_column++;
			endforeach;

			$html .= '</div>';
			$html .= '</div>';
			$html .= '</section>';
		endforeach;

		return $html;
	}

	static function get_image($fields){

		foreach ($fields as $field_key => $field) {
			
			if(strpos($field_key,'image__') || count($field)>0){

				if(!empty($field)){

					if(is_array($field)){

						if(!array_key_exists('sizes', $field)){

							$fields[$field_key] = TemplatesWidgets::get_image($field);
						}
						
					}else if(strpos($field_key,'image__')){

						$id_image = $field;

						$fields[$field_key] = array();

						$images_sizes = get_intermediate_image_sizes();

						$fields[$field_key]['sizes']['full'] = wp_get_attachment_image_src($id_image,'full')[0];

						foreach ($images_sizes as $size) {
							
							$fields[$field_key]['sizes'][$size] = wp_get_attachment_image_src($id_image,$size)[0];
						}

					}
				}
			}
		}
		
		return $fields;
	}
}

?>