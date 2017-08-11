jQuery(function(){


	jQuery("[data-key='field_linha_widgets'] .layout").click(function(){

		jQuery('#widget_acf_box_light').remove();

		var this_click = jQuery(this);

		var values_input = jQuery(this).find('.acf-fields');

		values_input.find('select').prop('disabled', false);

		values_input.find('.select2-container').remove();

		jQuery('body').append('<div id="widget_acf_box_light"></div>');
		jQuery('#widget_acf_box_light').html('<div class="acf_box_widgets_content"></div>');
		jQuery('.acf_box_widgets_content')
		.html('<h1>'+
			this_click.find('.acf-fc-layout-handle').text()+
			'</h1><div class="close fa fa-times"></div>'+values_input.html()
			);

		jQuery('.acf_box_widgets_content').find('input').change(function(){
			var name = jQuery(this).attr('name');
			jQuery(this_click).find('[name="'+name+'"]').val(jQuery(this).val());
			console.log(jQuery(this).val());
		});

		jQuery('.acf_box_widgets_content').find('select').change(function(){
			var name = jQuery(this).attr('name');
			jQuery(this_click).find('[name="'+name+'"]').parent().find('input').val(jQuery(this).val());
			console.log(jQuery(this).val());
		});

		jQuery(".acf_box_widgets_content .close").click(function(){
			jQuery('#widget_acf_box_light').remove();
		});

	});



});