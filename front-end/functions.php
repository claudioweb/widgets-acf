<?php

Class TemplatesWidgets {

	public function __construct() {}

	static function get_templates($layout_content,$attr=null){

		$html='<div class="columns is-multiline">';

		foreach ($layout_content as $key => $w_content) {

			$layout_widget = $w_content['layout'];
			$fields = $w_content['content'];
			if(!empty($attr['sidebar'])){
				$column_is = 'is-12';
			}

			if(!empty($attr['column'])){
				$column_is = 'is-'.$attr['column'];
			}

			$show_mobile = $fields['field_radio_mobile_post_unico_key'].' '.$column_is;
			
			ob_start();

			include plugin_dir_path( __FILE__ ).'../widgets/'.$layout_widget.'/index.php';

			$html .= ob_get_clean();
		}

		$html .='</div>';

		return $html;
	}
}

?>