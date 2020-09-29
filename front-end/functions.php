<?php

Class TemplatesWidgets {
	
	public function __construct() {}
	
	static function get_templates($layout_content, $attr = null) {
		
		$html = '';
		$css_widgets = '';
		$js_widgets = '';
		
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
			$widget_count = 1;
			
			foreach($layout as $w_content):
				
				if(!array_key_exists('content', $w_content))
				continue;
				
				$layout_widget = str_replace('_widget_acf', '', $w_content['layout']);
				$widget_name = str_replace('_', '-', $layout_widget);
				$dir_widget = get_template_directory() . "/widgets-templates/{$widget_name}";
				$url_widget = get_template_directory_uri() . "/widgets-templates/{$widget_name}";
				$plugin_widget = false;
				
				if(function_exists('\App\template') || function_exists('\Roots\view')):
					$dir_widget = get_template_directory() . "/views/widgets-templates/{$widget_name}";
					$url_widget = get_template_directory_uri() . "/views/widgets-templates/{$widget_name}";
				endif;
				
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
				$style = 'style="width: 100%; overflow: hidden;"';
				
				$html .= sprintf(
					"<div id=\"{$widget_name}-{$widget_count}\" class=\"widget-acf {$widget_name} {$columns}%s\"%s>", 
					empty($w_content['class']) ? "" : " " . $w_content['class'], 
					empty($style) ? "" : " " . $style
				);
				
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
					
					$css_widgets .= self::enqueueStyle($dir_widget, $url_widget, $widget_name);
					$js_widgets .= self::enqueueScript($dir_widget, $url_widget, $widget_name);
					
					$widget_count++;
					$count_column++;
				endforeach;
				
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</section>';
			endforeach;
			
			$url_widgets = get_template_directory();
			
			return $html;
		}
		
		/**
		* enqueueStyle Adiciona o css do widget em páginas que ele for utilizado
		*
		* @param  mixed $dir_widget Caminho completo do widget
		* @param  mixed $url_widget URL do widget a partir da raiz do Wordpress
		* @param  mixed $widget_name Nome do widget
		* @return void
		*/
		private static function enqueueStyle($dir_widget, $url_widget, $widget_name) {
			
			$style = "/style.scss";
			
			if(!file_exists($dir_widget . $style))
			return;
			
			include_once(plugin_dir_path(__FILE__).'../back-end/acf/WidgetsLocation.php');
			
			$location = new WidgetsLocation;
			
			return $location->fopen_r($dir_widget . $style);
			
		}
		
		/**
		* enqueueScript Adiciona o script do widget em páginas que ele for utilizado
		*
		* @param  mixed $dir_widget Caminho completo do widget
		* @param  mixed $url_widget URL do widget a partir da raiz do Wordpress
		* @param  mixed $widget_name Nome do widget
		* @return void
		*/
		private static function enqueueScript($dir_widget, $url_widget, $widget_name) {
			$script = "/app.js";
			
			if(!file_exists($dir_widget . $script))
			return;
			
			include_once(plugin_dir_path(__FILE__).'../back-end/acf/WidgetsLocation.php');
			$location = new WidgetsLocation;
			
			return $location->fopen_r($dir_widget . $script);
			
		}
		
		static function get_image($fields){
			$name_fields = array();
			
			foreach ($fields as $field_key => $field) {
				
				$name = get_field_object($field_key);
				
				if($name){
					
					$name_fields[$name['name']] = $field;

					$sub_fields = $name['sub_fields'];
					
					foreach($name_fields[$name['name']] as $f_key => $f){

						$name_parent = get_field_object($f_key);

						if($name_parent['name']){

							$name_fields[$name['name']][$name_parent['name']] = $f;

							unset($name_fields[$name['name']][$f_key]);

							$f_key = $name_parent['name'];
						}
						
						if(!empty($sub_fields)){
							foreach ($sub_fields as $key_sub => $sub) {
								if(!$sub['key']){
									$sub['key'] = $key_sub;
								}
								if(!empty($name_fields[$name['name']][$f_key][$sub['key']])){

									$name_fields[$name['name']][$f_key][$sub['name']] = $name_fields[$name['name']][$f_key][$sub['key']];
									unset($name_fields[$name['name']][$f_key][$sub['key']]);

									foreach($name_fields[$name['name']][$f_key][$sub['name']] as $key_ff => $ff){
										$name_sub = get_field_object($key_ff)['name'];
										if(!empty($name_sub)){
											
											$name_fields[$name['name']][$f_key][$sub['name']][$name_sub] = $ff;
											unset($name_fields[$name['name']][$f_key][$sub['name']][$key_ff]);

											foreach($name_fields[$name['name']][$f_key][$sub['name']][$name_sub] as $key_fff => $fff){
												$name_sub_sub = get_field_object($key_fff)['name'];
												if(!empty(!$name_sub_sub)){

													$name_fields[$name['name']][$f_key][$sub['name']][$name_sub][$name_sub_sub] = $fff;
													unset($name_fields[$name['name']][$f_key][$sub['name']][$name_sub][$key_fff]);
												}
											}
										}

									}
								}
							}
						}
					}
					
					
				}else{
					$name_fields[$field_key] = $field;
				}
			}
			
			return $name_fields;
		}
	}
	
	?>