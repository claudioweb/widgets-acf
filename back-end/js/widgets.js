jQuery(function(){

	set_widget_light_box();

	jQuery('a[data-event="add-layout"]').click(function(){
		setTimeout(function(){
			jQuery(".acf-fc-popup li a").click(function(){
				setTimeout(function(){
					set_widget_light_box();
				},1000);
			});
		},500);
	});

});

function set_widget_light_box(){

	jQuery("[data-key='field_linha_widgets'] .layout .acf-fc-layout-handle").click(function(){

		jQuery('#widget_acf_box_light').remove();

		var this_click = jQuery(this).parent();

		var values_input = jQuery(this).parent().find('.acf-fields');

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
			var img_new = jQuery(this).parent().find('.show-if-value img').attr('src');
			jQuery(this_click).parent().find('.show-if-value img').attr('src',img_new);
			jQuery(this_click).find('[name="'+name+'"]').attr('value',jQuery(this).val());
			console.log(jQuery(this_click).find('[name="'+name+'"]').val());
		});

		jQuery('.acf_box_widgets_content').find('select').select2();

		jQuery('.acf_box_widgets_content').find('select').change(function(){
			var name = jQuery(this).attr('name');
			jQuery(this_click).find('[name="'+name+'"] option:selected').removeAttr("selected");

			for (var i = 0; i < jQuery(this).val().length; i++) {
				jQuery(this_click).find('[name="'+name+'"] option[value="'+jQuery(this).val()[i]+'"]').attr("selected","selected");
			}

			jQuery(this_click).find('[name="'+name+'"]').parent().find('input').attr('value',jQuery(this).val());
			console.log(jQuery(this).val());
		});

		jQuery(".acf_box_widgets_content .close").click(function(){
			jQuery('#widget_acf_box_light').remove();
		});

	});

}