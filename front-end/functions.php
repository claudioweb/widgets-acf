<?php

Class TemplatesWidgets {

	public function __construct() {}

	static function get_templates($layout_content,$attr=null){

		$html ='';

		foreach ($layout_content as $key => $layout) {

			$style_attr = array();
			$style_bg = array();

			$style_attr['padding'] = 'padding: '.
			$layout['attr']['padding_layout_setting']['padding_top_layout_setting'].'px '.
			$layout['attr']['padding_layout_setting']['padding_right_layout_setting'].'px '.
			$layout['attr']['padding_layout_setting']['padding_bottom_layout_setting'].'px '.
			$layout['attr']['padding_layout_setting']['padding_left_layout_setting'].'px;';

			if(!empty($layout['attr']['imagem_layout_setting'])){ 

				if(is_array($img_bg)){
					$img_bg = $layout['attr']['imagem_layout_setting']['sizes']['full'];
				}else{
					$img_bg = wp_get_attachment_url($layout['attr']['imagem_layout_setting']);
				}
			$style_bg['background_image'] = 'background-image: url('.$img_bg.');';
			$style_bg['background_size'] = 'background-size: 100%;';
			$style_bg['background_repeat'] = 'background-repeat: no-repeat;';
			$style_bg['background_position'] = 'background-position: top center;';
			}
			$style_bg['background_color'] = 'background-color: '.$layout['attr']['cor_layout_setting'].';';
			
			$html .='<div style="'.implode(' ',$style_bg).'">';

			if($layout['attr']['largura_layout_setting']=='container'){
				$html .='<div class="container">';
			}else{
				$html .='<div class="container-fluid">';
			}

			$html .='<section class="row" style="'.implode(' ',$style_attr).'">';

			$count_column = 0;

			foreach ($layout as $key_l => $w_content) {

				if(array_key_exists('content', $w_content)){

					if($count_column>count($w_content['columns'])-1){
						$count_column = 0;
					}


					$html .='<article class="widget_acf '.$w_content['columns'][$count_column].' '.$w_content['class'].'">';

					ob_start();

					$layout_widget = str_replace('_widget_acf', '', $w_content['layout']);
					$layout_widget = str_replace('_','-',$layout_widget);

					$fields = $w_content['content'];

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

			$html .='</section>';
			$html .='</div>';

		}

		return $html;
	}
}

?>