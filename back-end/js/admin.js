function insert_line_codemirror(data){

	var cm = jQuery('.CodeMirror')[0].CodeMirror;
	var doc = cm.getDoc();
    var cursor = doc.getCursor(); // gets the line number in the cursor position
    var line = doc.getLine(cursor.line); // get the line contents
    console.log(doc);
    var pos = { // create a new object to avoid mutation of the original selection
        line: (doc.size+5),
        ch: line.length - 1 // set the character position to the end of the line
    }
    doc.replaceRange('\n'+data+'\n', pos); // adds a new line
}

jQuery(function(){

	function change_refresh_rule(change){

		setTimeout(function(){

			if(change==true){
				if(jQuery(".refresh-location-rule").val()=="widget_acf"){
					jQuery('.rule-groups .rule-group[data-id!="group_0"]').remove();
					jQuery('.rule-groups .acf-table tr[data-id!="rule_0"]').remove();
					jQuery(".add-location-group, .add-location-rule").hide();
				}else{
					jQuery(".add-location-group, .add-location-rule").show();
				}
				
			}
			
			jQuery(".refresh-location-rule").change(function(){

				if(jQuery(this).val()=="widget_acf"){
					jQuery('.rule-groups .rule-group[data-id!="group_0"]').remove();
					jQuery('.rule-groups .acf-table tr[data-id!="rule_0"]').remove();
					jQuery(".add-location-group, .add-location-rule").hide();
				}else{
					jQuery(".add-location-group, .add-location-rule").show();
				}
				change_refresh_rule(false);
			});
		},500);
	}
	change_refresh_rule(true);
	

	setTimeout(function(){

		var location_widget_acf = new RegExp('[\?&]location_widget_acf=([^&#]*)').exec(window.location.href);
		if(location_widget_acf){

			jQuery("#title-prompt-text").hide();
			jQuery('input[name="post_title"]').val('Campos personalizados - '+location_widget_acf[1]);
			jQuery("#acf_field_group-location-group_0-rule_0-param").val('widget_acf').change();
			jQuery("#acf_field_group-location-group_0-rule_0-value").val(location_widget_acf[1]).change();
			
		}
		jQuery('#acf-group_widgets_all .acf-tab-group li span.aba_widgets_acf_delete').click(function(){
			if(confirm('Tem certeza que deseja excluir o widget ?')){
				var key_widget = jQuery(this).closest('a').data('key').replace('field_aba_','').replaceAll('_','-');
				window.location.href = window.location.href + '&del=' + key_widget;
			}
		});

		jQuery(".external-field-save label.selected").click(function(){
			jQuery(this).closest("form").submit();
		});

		if( jQuery('#acf-group_widgets_all .acf-code-external').length ) {

			jQuery(".aba_widgets_acf_delete_group_field").click(function(){
				if(confirm("Tem certeza que deseja excluir permanentemente o Grupo de campos ?")){
					
					var id_group_field = jQuery(this).data("group_id");
					window.location.href = window.location.href + '&del_group_field=' + id_group_field;
				}
			});

			jQuery('.choices_fields_group .acf-input .option_group').click(function(){
				window.location.href = jQuery(this).parent().find("input").val();
			});

			jQuery('#acf-group_widgets_all .acf-code-external .acf-tab-group li').click(function(){

				var poisition_tab = jQuery(this).index();

				var mode_codemirror = 'application/x-httpd-php';

				if(poisition_tab==0){
					
					var mode_codemirror = 'css';
				}else if(poisition_tab==1){

					var mode_codemirror = 'htmlmixed';
				}else if(poisition_tab==2){

					var mode_codemirror = 'jsx';
				}
				
				var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
				editorSettings.codemirror = _.extend(
					{},
					editorSettings.codemirror,
					{
						theme: 'monokai',
						tabSize: 2,
						lineNumbers: true,
						styleActiveLine: true,
						matchBrackets: true,
						autoCloseBrackets: true,
						mode: mode_codemirror,
						indentWithTabs: true
					}
				);
				
				var closest = jQuery(this).closest('.acf-code-external');

				var textarea = closest.find('.acf-field-textarea').eq(poisition_tab);

				if(!textarea.find('.CodeMirror').length){
				
					var editor = wp.codeEditor.initialize( textarea.find('textarea'), editorSettings);
				}
				
			});

			jQuery('#acf-group_widgets_all .acf-tab-group').first().find('li').click(function(){

				var poisition_tab = jQuery(this).index();
				
				jQuery('#acf-group_widgets_all .acf-code-external').eq(poisition_tab).find('.acf-tab-group li.active').click();
			});

			jQuery('#acf-group_widgets_all .acf-tab-group').first().find('li.active').click();

		}

	},500);

	jQuery('.acf-field-the-contents').parent().parent().parent().parent().parent().find('.postarea').hide();
	jQuery('.acf-field-the-contents').parent().parent().parent().parent().parent().find('#pageparentdiv').hide();
	jQuery('.acf-field-the-contents').parent().parent().parent().parent().parent().find('#postimagediv').hide();

	jQuery('#poststuff, #edittag').fadeIn(function(){
		// set_column_load();
		// set_column();

		load_new_column();
		change_new_column();
	});

	jQuery(".button[data-event='add-row']").click(function(){
		if(jQuery(this).attr('data-event')=='add-row'){
			setTimeout(function(){
				// set_column();
				add_layout();

			},500);
		}
	});

	jQuery('.acf-field-linha-widgets').parent().parent().parent().parent().parent().find('.term-description-wrap').hide();
	jQuery('.acf-field-linha-widgets').parent().parent().parent().parent().parent().find('.term-parent-wrap').hide();

});

function set_column(){

	// jQuery(".acf-table .acf-field[data-name='tamanho-grid'] ul li input").unbind( "click" );
	jQuery(".acf-table .acf-field[data-name='tamanho-grid'] ul li input").click(function(){
		var parents = jQuery(this).parent().parent().parent().parent().parent().parent();
		console.log(parents);
		parents.find('.acf-field-flexible-content')[0].className = parents.find('.acf-field-flexible-content')[0].className.replace(/\bcolumn_.*?\b/g, '');
		parents.find('.acf-field-flexible-content').addClass('column_'+jQuery(this).val());
	});

}

function set_column_load(){

	jQuery(".acf-table .acf-field[data-name='tamanho-grid']").each(function(){
		console.log();
		var parents = jQuery(this).parent().parent();
		console.log(parents);
		parents.find('.acf-field-flexible-content')[0].className = parents.find('.acf-field-flexible-content')[0].className.replace(/\bcolumn_.*?\b/g, '');
		parents.find('.acf-field-flexible-content').addClass('column_'+jQuery(this).find('ul li input:checked').val());
		
	});

}

function load_new_column(){

	jQuery('.acf-field-the-contents .layout').each(function(){

		var colunagem = jQuery(this).find('.grid_widget_settings select').val();

		jQuery(this).attr("data-widget",colunagem);

	});
}

function change_new_column(){

	jQuery('.grid_widget_settings select').change(function(){
		var colunagem = jQuery(this).val();

		jQuery(this).find('option[selected="selected"]').removeAttr("selected");

        jQuery(this).find('option[value="'+jQuery(this).val()+'"]').attr("selected","selected");

		jQuery(this).closest('.layout').attr("data-widget",colunagem);
	});
}