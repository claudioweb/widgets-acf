<?php

Class TemplatesWidgets {

	public function __construct() {}

	static function get_templates($layout_content,$attr=null){

		$html ='';

		foreach ($layout_content as $key => $layout) {

			$html .='<section class="row">';

			$count_column = 0;

			foreach ($layout as $key_l => $w_content) {

				if($count_column>count($w_content['columns'])-1){
					$count_column = 0;
				}

				$html .='<article class="'.$w_content['columns'][$count_column].' '.$w_content['class'].'">';

				ob_start();

				$layout_widget = str_replace('_widget_acf', '', $w_content['layout']);
				$fields = $w_content['content'];
				include plugin_dir_path( __FILE__ ).'../widgets-acf/'.$layout_widget.'/index.php';

				$html .= ob_get_clean();

				$html .='</article>';

				$count_column++;
			}

			$html .='</section>';

		}

		return $html;
	}
}

?>