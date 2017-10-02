jQuery(function(){

  add_layout();
  change_layout();
  set_widget_light_box();
  set_layout_light_box();

});

function add_layout(){
  jQuery('div[data-key="field_the_contents"]').find('a[data-event="add-layout"], a[data-name="add-layout"]').click(function(){
    console.log('clicou add layout');

    setTimeout(function(){

      jQuery(".acf-fc-popup li a").click(function(){

        jQuery('div[data-key="field_the_contents"]').find('a[data-event="add-layout"], a[data-name="add-layout"]').hide();
        console.log('layout adicionado');
        setTimeout(function(){
          
         set_widget_light_box();

         load_new_column();
         change_new_column();

        jQuery('div[data-key="field_the_contents"]').find('a[data-event="add-layout"], a[data-name="add-layout"]').show();

         console.log('lightbox criado');
       },500);
      });

    },100);

  });
}

function change_layout(){

  jQuery('a[data-event="add-row"]').click(function(){
    console.log('linha adicionado');
    setTimeout(function(){
     set_layout_light_box();
     console.log('lightbox criado');
   },500);

  });
}

function set_widget_light_box(){

  jQuery("[data-key='field_linha_widgets'] .layout .acf-fc-layout-handle").click(function(){

    jQuery('#widget_acf_box_light').remove();

    var this_click = jQuery(this).parent();

    var values_input = jQuery(this).parent().find('.acf-fields');

    console.log(values_input.html());

    values_input.find('select').prop('disabled', false);

    values_input.find('.select2-container').remove();

    jQuery('body').append('<div id="widget_acf_box_light"></div>');
    jQuery('#widget_acf_box_light').html('<div class="acf_box_widgets_content"></div>');
    jQuery('.acf_box_widgets_content')
    .html('<div class="fixed_box_light"><h1>'+
     this_click.find('.acf-fc-layout-handle').text()+
     '</h1><div class="close button">Salvar</div></div>'+values_input.html()
     );

    jQuery('.acf_box_widgets_content .wp-picker-container').remove();

    var myOptions = {
    		// you can declare a default color here,
    		// or in the data-default-color attribute on the input
    		defaultColor: false,
    		// a callback to fire whenever the color changes to a valid color
    		change: function(event, ui){
    			console.log(jQuery(this));
    			var name = jQuery(this).attr('name');
    			var img_new = jQuery(this).parent().find('.show-if-value img').attr('src');
    			jQuery(this_click).parent().find('.show-if-value img').attr('src',img_new);
    			jQuery(this_click).find('[name="'+name+'"]').attr('value',jQuery(this).val());
    			console.log(jQuery(this_click).find('[name="'+name+'"]').val());
    		},
    		// a callback to fire when the input is emptied or an invalid color
    		clear: function() {},
    		// hide the color picker controls on load
    		hide: true,
    		// show a group of common colors beneath the square
    		// or, supply an array of colors to customize further
    		palettes: true
    	};

      jQuery('.acf_box_widgets_content .acf-color_picker').find('input').wpColorPicker(myOptions);
      jQuery('.acf_box_widgets_content .acf-color_picker').find('input.wp-color-picker').attr('type','text');
      console.log(jQuery('.acf_box_widgets_content .acf-color_picker').find('input.wp-color-picker').val());
      

    	jQuery('.acf_box_widgets_content').find('input, textarea').change(function(){
    		var name = jQuery(this).attr('name');
    		var img_new = jQuery(this).parent().find('.show-if-value img').attr('src');
    		jQuery(this_click).parent().find('.show-if-value img').attr('src',img_new);
        jQuery(this_click).find('[name="'+name+'"]').val(jQuery(this).val());
        jQuery(this_click).find('[name="'+name+'"]').text(jQuery(this).val());
        jQuery(this_click).find('[name="'+name+'"]').attr('value',jQuery(this).val());

        jQuery(this).attr('value',jQuery(this).val());
        jQuery(this).text(jQuery(this).val());

        var html_file = jQuery(this).parent().find('.file-wrap').html();
        jQuery(this_click).find('[name="'+name+'"]').parent().removeClass('has-value');
        jQuery(this_click).find('[name="'+name+'"]').parent().find('.file-wrap').html(html_file);
        if(jQuery(this).val()!='' && jQuery(this).val()!=0){
          jQuery(this_click).find('[name="'+name+'"]').parent().addClass('has-value');
        }

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

        jQuery(this_click).find(".acf-field-repeater").each(function(){
          var data_key = jQuery(this).attr('data-key');
          jQuery(this).html(jQuery(".acf_box_widgets_content").find('.acf-field-repeater[data-key="'+data_key+'"]').html());
        });

        jQuery('#widget_acf_box_light').remove();

      });


      jQuery('.mce-container-body,.wp-editor-tools, .mce-tinymce, .quicktags-toolbar').remove();

      jQuery('.wp-editor-container textarea').show();


      setTimeout(function(){
        tinymce.remove('.wp-editor-container textarea');

        tinymce.init({
          selector: '.wp-editor-container textarea',
          setup:function(ed) {
           ed.on('change', function(e) {

             jQuery('.wp-editor-container textarea').val(ed.getContent());
             jQuery('.wp-editor-container textarea').text(ed.getContent());
             jQuery('.wp-editor-container textarea').html(ed.getContent());

           });
         }
       });

      },500);

      // jQuery('.mce-first').first().hide();

      jQuery('.acf-date-time-picker').find('input[type="text"]').remove();
      jQuery('.acf-date-time-picker').find('input[type="hidden"]').attr('type','text');
      // jQuery('.acf-ui-datepicker').remove();

      jQuery('.acf-date-time-picker').find('input[type="text"]').datetimepicker({
        altFormat: jQuery('.acf-date-time-picker').attr('data-date_format'),
        timeFormat: jQuery('.acf-date-time-picker').attr('data-time_format')
      });

    });

}

function set_layout_light_box(){

    // jQuery("[data-key='field_linha_widgets'] .layout .acf-fc-layout-handle").unbind( "click" );

    jQuery(".acf-field[data-name='ajustes_de_layout']").click(function(){

      jQuery('#widget_acf_box_light').remove();

      var this_click = jQuery(this).parent();

      var values_input = jQuery(this).parent().find('.acf-fields');

      console.log(values_input.html());

      values_input.find('select').prop('disabled', false);

      values_input.find('.select2-container').remove();

      jQuery('body').append('<div id="widget_acf_box_light" class="light_s"></div>');
      jQuery('#widget_acf_box_light').html('<div class="acf_box_widgets_content"></div>');
      jQuery('.acf_box_widgets_content')
      .html('<div class="fixed_box_light"><h1>Ajustes de Layout</h1><div class="close button">Salvar</div></div>'+values_input.html()
       );

      jQuery('.acf_box_widgets_content .wp-picker-container').remove();

      var myOptions = {
        // you can declare a default color here,
        // or in the data-default-color attribute on the input
        defaultColor: false,
        // a callback to fire whenever the color changes to a valid color
        change: function(event, ui){
          console.log(jQuery(this));
          var name = jQuery(this).attr('name');
          var img_new = jQuery(this).parent().find('.show-if-value img').attr('src');
          jQuery(this_click).parent().find('.show-if-value img').attr('src',img_new);
          jQuery(this_click).find('[name="'+name+'"]').attr('value',jQuery(this).val());
          console.log(jQuery(this_click).find('[name="'+name+'"]').val());
        },
        // a callback to fire when the input is emptied or an invalid color
        clear: function() {},
        // hide the color picker controls on load
        hide: true,
        // show a group of common colors beneath the square
        // or, supply an array of colors to customize further
        palettes: true
      };

      jQuery('.acf_box_widgets_content .acf-color_picker').find('input').wpColorPicker(myOptions);
      jQuery('.acf_box_widgets_content .acf-color_picker').find('input.wp-color-picker').attr('type','text');
      console.log(jQuery('.acf_box_widgets_content .acf-color_picker').find('input.wp-color-picker').val());
      

      jQuery('.acf_box_widgets_content').find('input[type="number"],input[type="hidden"],input[type="text"] , textarea').change(function(){
        var name = jQuery(this).attr('name');
        var img_new = jQuery(this).parent().find('.show-if-value img').attr('src');
        jQuery(this_click).parent().find('.show-if-value img').attr('src',img_new);
        jQuery(this_click).find('[name="'+name+'"]').val(jQuery(this).val());
        jQuery(this_click).find('[name="'+name+'"]').text(jQuery(this).val());
        jQuery(this_click).find('[name="'+name+'"]').attr('value',jQuery(this).val());

        jQuery(this).attr('value',jQuery(this).val());
        jQuery(this).text(jQuery(this).val());

        console.log(jQuery(this_click).find('[name="'+name+'"]').val());
      });

      jQuery('.acf_box_widgets_content').find('input[type="radio"]').change(function(){

        var name = jQuery(this).attr('name');

        jQuery(this_click).find('[name="'+name+'"]').prop('checked', false);
        jQuery(this_click).find('[name="'+name+'"]').removeAttr('checked');
        jQuery(this_click).find('[name="'+name+'"][value="'+jQuery(this).val()+'"]').prop('checked', true);
        jQuery(this_click).find('[name="'+name+'"][value="'+jQuery(this).val()+'"]').attr('checked', 'checked');
        console.log(jQuery(this_click).find('[name="'+name+'"][checked="checked"]').val());
      });

      // jQuery('.acf_box_widgets_content').find('select').select2();

      jQuery('.acf_box_widgets_content').find('select').change(function(){
        var name = jQuery(this).attr('name');
        jQuery(this_click).find('[name="'+name+'"] option:selected').removeAttr("selected");

        for (var i = 0; i < jQuery(this).val().length; i++) {
          jQuery(this_click).find('[name="'+name+'"] option[value="'+jQuery(this).val()[i]+'"]').attr("selected","selected");
        }

        jQuery(this_click).find('[name="'+name+'"]').parent().find('input').attr('value',jQuery(this).val());

        jQuery(this_click).find('[name="'+name+'"]').val(jQuery(this).val()).trigger('change');
        console.log(jQuery(this).val());
      });

      jQuery(".acf_box_widgets_content .close").click(function(){

        jQuery(this_click).find(".acf-field-repeater").each(function(){
          var data_key = jQuery(this).attr('data-key');
          jQuery(this).html(jQuery(".acf_box_widgets_content").find('.acf-field-repeater[data-key="'+data_key+'"]').html());
        });

        jQuery('#widget_acf_box_light').remove();

      });

    });

}