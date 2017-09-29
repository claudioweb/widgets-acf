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

		$grid = 0;

		if (have_rows('linha-widgets',$type)) {

			while (have_rows('linha-widgets',$type)) {

				$columns = the_row();

				if (have_rows('select-the-contents')) {

					while (have_rows('select-the-contents')) {

						the_row();

						$class = $this->get_class_widget(get_row());

						$column =  $this->get_column_bs($columns['field_tamanho_grid']);

						$widgets[$grid]['attr'] = $columns['fields_layout_settings'];
						$widgets[$grid][] = array(
							'layout' => get_row_layout(), 
							'content' => get_row(), 
							'class'=>$class, 
							'columns'=>$column
							);
					}

				}

				$grid++;
			}

		}

		return TemplatesWidgets::get_templates($widgets,$attr);
	}

	public function get_class_widget($fields){

		$layout_widget = $fields['acf_fc_layout'];

		// show mobile ?
		$show_mobile = $fields['field_radio_mobile_'.$layout_widget.'_key'];

		if(empty($show_mobile)){
			$show_mobile = 'hidden-xs';
		}else{
			$show_mobile = '';
		}

		return $show_mobile;
		
	}

	public function get_column_bs($column){

		return array();

		$total_grid = 12;

		$columns = array();

		if($column == '2_1'){

			$columns[0] = 'col-sm-8';
			
			$column = str_replace('2_', '3_', $column);

		}else if($column == '2_2'){

			$columns[1] = 'col-sm-8';
			$column = str_replace('2_', '3_', $column);

		}else if($column == '3_1'){
			$columns[1] = 'col-sm-6';
			$column = str_replace('3_', '4_', $column);
		}

		$column = explode('_',$column);

		if($column[0]=='full'){
			$columns[0]='full width';
		}else{

			if(!empty($columns[0])){
				$columns[] = 'col-sm-'.$total_grid/intval($column[0]);
			}else{
				$columns[0] = 'col-sm-'.$total_grid/intval($column[0]);
			}
		}



		return $columns;

	}


}

?>