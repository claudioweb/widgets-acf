jQuery(function(){
	
	jQuery('.acf-field-the-contents').parent().parent().parent().parent().parent().find('.postarea').hide();
	jQuery('.acf-field-the-contents').parent().parent().parent().parent().parent().find('#pageparentdiv').hide();
	jQuery('.acf-field-the-contents').parent().parent().parent().parent().parent().find('#postimagediv').hide();
	jQuery('#poststuff').fadeIn(function(){
		set_column_load();
		set_column();
	});

	jQuery(".button[data-event='add-row']").click(function(){
		if(jQuery(this).attr('data-event')=='add-row'){
			setTimeout(function(){
				set_column();
			},1000);
		}
	});

	jQuery('.acf-field-the-contents').parent().parent().parent().find('.term-description-wrap').hide();
	jQuery('#edittag').fadeIn();

});

function set_column(){

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
