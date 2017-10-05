<?php

Class TemplatesWidgets {

	public function __construct() {}

	static function get_templates($layout_content,$attr=null){

		$html ='';

		foreach ($layout_content as $key => $layout) {

			include "styles_layout.php";

			if($layout['attr']['field_radio_mobile_setting']==0){
				$class_setting .= ' hidden-xs';
			}

			$html .='<section id="'.$id_setting.'" class="'.$class_setting.'" style="'.implode(' ',$style_bg).' '.implode(' ',$style_attr).'">';

			if($layout['attr']['largura_layout_setting']=='container'){
				$html .='<div class="container">';
			}else{
				$html .='<div class="container-fluid">';
			}

			$html .='<div class="row">';

			$count_column = 0;

			foreach ($layout as $key_l => $w_content) {

				if(array_key_exists('content', $w_content)){

					if($count_column>count($w_content['columns'])-1){
						$count_column = 0;
					}

					//v1 $w_content['columns'][$count_column]

					$layout_widget = str_replace('_widget_acf', '', $w_content['layout']);
					$columns = $w_content['content']['field_tamanho_grid_desktop_'.$layout_widget.'_widget_acf_key'];
					
					$style = '';

					if($columns=='full-widget-acf'){
						$style = 'width: 100%; overflow: hidden;';
					}

					$html .='<article class="widget_acf '.$columns.' '.$w_content['class'].'"  style="'.$style.'">';

					ob_start();

					$layout_widget = str_replace('_','-',$layout_widget);

					$fields = $w_content['content'];

					$fields = TemplatesWidgets::get_image($fields);

					$dir_widget = get_template_directory().'/widgets-templates/'.$layout_widget;

					if(!is_dir($dir_widget)){
						$dir_widget = plugin_dir_path( __FILE__ ).'../widgets-templates/'.$layout_widget;
					}

					include $dir_widget."/index.php";

					$html .= ob_get_clean();

					$html .='</article>';

					$count_column++;
				}
			}

			$html .='</div>';
			$html .='</div>';
			$html .='</section>';

		}

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