<?php
require("functions.php");

Class ActionWidgets {

	public function __construct() {
		add_shortcode( 'acf_widgets', array( $this, 'init' ) );
	}

	public function init($attr=null){

		$p_id = get_queried_object();


		$widgets = $this->widgets($p_id,$attr);

		return $widgets;
	}

	public function widgets($type, $attr=null){

		$widgets = array();

		if (have_rows('linha-widgets',$type)) {

			while (have_rows('linha-widgets',$type)) {

				$columns = the_row();

				if (have_rows('select-the-contents')) {

					while (have_rows('select-the-contents')) {
						the_row();

						$widgets[] = array('layout' => get_row_layout(), 'content' => get_row(),'columns'=>$columns);
					}

				}
			}

		}

		return TemplatesWidgets::get_templates($widgets,$attr);
	}


}
?>