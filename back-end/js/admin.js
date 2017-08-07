jQuery(function(){
	jQuery('.acf-field-the-contents').parent().parent().parent().parent().parent().find('.postarea').hide();
	jQuery('.acf-field-the-contents').parent().parent().parent().parent().parent().find('#pageparentdiv').hide();
	jQuery('.acf-field-the-contents').parent().parent().parent().parent().parent().find('#postimagediv').hide();
	jQuery('#poststuff').fadeIn();

	jQuery('.acf-field-the-contents').parent().parent().parent().find('.term-description-wrap').hide();
	jQuery('#edittag').fadeIn();

	jQuery(".acf-table .acf-field[data-name='tamanhos_grid'] ul li input").click(function(){
		jQuery('.acf-field-flexible-content')[0].className = jQuery('.acf-field-flexible-content')[0].className.replace(/\bcolumn_.*?\b/g, '');
		jQuery('.acf-field-flexible-content').addClass('column_'+jQuery(this).val());
	});

});
