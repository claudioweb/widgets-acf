<?php
require("functions.php");

Class ActionWidgets {

	public function __construct() {
		add_shortcode( 'ativo_widget', array( $this, 'init' ) );
	}

	public function init($attr=null){

		$p_id = get_queried_object();


		$widgets = $this->widgets($p_id,$attr);

		return $widgets;
	}

	public function widgets($type, $attr=null){

		$widgets = array();

		if (have_rows('select-the-contents',$type)) {

			while (have_rows('select-the-contents',$type)) {

				the_row();

				$widgets[] = array('layout' => get_row_layout(), 'content' => get_row());
			}

		}

		return TemplatesWidgets::get_templates($widgets,$attr);
	}


}
?>