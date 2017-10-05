jQuery(function(){

  add_layout();
  change_layout();
  set_widget_light_box();
  set_layout_light_box();

});

function add_layout(){
  jQuery('div[data-key="field_the_contents"]').find('a[data-event="add-layout"], a[data-name="add-layout"]').click(function(){


    setTimeout(function(){

      jQuery(".acf-fc-popup li a").click(function(){

        jQuery('div[data-key="field_the_contents"]').find('a[data-event="add-layout"], a[data-name="add-layout"]').hide();
        setTimeout(function(){

         set_widget_light_box();

         load_new_column();
         change_new_column();

         jQuery('div[data-key="field_the_contents"]').find('a[data-event="add-layout"], a[data-name="add-layout"]').show();

       },500);
      });

    },100);

  });
}

function change_layout(){

  jQuery('a[data-event="add-row"]').click(function(){
    setTimeout(function(){
     set_layout_light_box();
   },500);

  });
}

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
    .html('<div class="fixed_box_light"><h1>'+
     this_click.find('.acf-fc-layout-handle').text()+
     '</h1><div class="close button">Salvar</div></div>'+values_input.html()
     );

    // jQuery('.acf_box_widgets_content').find('select').select2();

    jQuery('.acf_box_widgets_content').find('select').change(function(){

      console.log(jQuery(this).val());

      jQuery(this).find('option[selected="selected"]').removeAttr("selected");

      jQuery(this).find('option[value="'+jQuery(this).val()+'"]').attr("selected","selected");

    });

    jQuery('.acf_box_widgets_content').find('input[type="radio"]').change(function(){

      console.log(jQuery(this).val());

      jQuery(this).parent().parent().parent().find('input[type="radio"]').removeAttr("checked");

      jQuery(this).attr("checked","checked");

    });

    jQuery('.acf_box_widgets_content .wp-picker-container').remove();
    // jQuery('.acf_box_widgets_content .wp-picker-container .wp-picker-holder').remove();

    var myOptions = {
    		// you can declare a default color here,
    		// or in the data-default-color attribute on the input
    		defaultColor: false,
    		// a callback to fire whenever the color changes to a valid color
    		change: function(event, ui){
          // console.log(event);
          // jquery(this).val(('#'+ui.color._color));
        },
    		// a callback to fire when the input is emptied or an invalid color
    		clear: function() {},
    		// hide the color picker controls on load
    		hide: true,
    		// show a group of common colors beneath the square
    		// or, supply an array of colors to customize further
    		palettes: true
    	};

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

      jQuery('.acf_box_widgets_content .acf-color_picker, .acf_box_widgets_content .acf-color-picker').each(function(){

        if(!jQuery(this).parent().parent().parent().parent().hasClass('acf-clone')){

          var_color_picker = jQuery(this).find('input').first();

          var_color_picker.wpColorPicker(myOptions);
          jQuery(this).find('input.wp-color-picker').attr('type','text');
          jQuery(this).prepend(var_color_picker);
        }

      });

      jQuery(".acf_box_widgets_content .close").click(function(){

        jQuery('.acf_box_widgets_content').find('input, textarea').each(function(){
          jQuery(this).val(jQuery(this).val());
          jQuery(this).attr('value',jQuery(this).val());
          jQuery(this).text(jQuery(this).val());
          jQuery(this).html(jQuery(this).val());
        });

        tinymce.remove('.wp-editor-container textarea');
        
        jQuery('.fixed_box_light').remove();

        var html_box = jQuery('.acf_box_widgets_content').html();
        values_input.html(html_box);

        jQuery('#widget_acf_box_light').remove();

        change_new_column();

      });

    });

}

function set_layout_light_box(){

    // jQuery("[data-key='field_linha_widgets'] .layout .acf-fc-layout-handle").unbind( "click" );

    jQuery(".acf-field[data-name='ajustes_de_layout']").click(function(){

      jQuery('#widget_acf_box_light').remove();

      var this_click = jQuery(this);

      var values_input = jQuery(this).find('.acf-fields');

      
      values_input.find('select').prop('disabled', false);

      values_input.find('.select2-container').remove();

      jQuery('body').append('<div id="widget_acf_box_light" class="light_s"></div>');
      jQuery('#widget_acf_box_light').html('<div class="acf_box_widgets_content"></div>');
      jQuery('.acf_box_widgets_content')
      .html('<div class="fixed_box_light"><h1>Ajustes de Layout</h1><div class="close button">Salvar</div></div>'+values_input.html()
       );

    // jQuery('.acf_box_widgets_content').find('select').select2();

    jQuery('.acf_box_widgets_content').find('select').change(function(){

      console.log(jQuery(this).val());

      jQuery(this).find('option[selected="selected"]').removeAttr("selected");

      jQuery(this).find('option[value="'+jQuery(this).val()+'"]').attr("selected","selected");

    });

    jQuery('.acf_box_widgets_content').find('input[type="radio"]').change(function(){

      console.log(jQuery(this).val());

      jQuery(this).parent().parent().parent().find('input[type="radio"]').removeAttr("checked");

      jQuery(this).attr("checked","checked");

    });

    jQuery('.acf_box_widgets_content .wp-picker-container').remove();
    // jQuery('.acf_box_widgets_content .wp-picker-container .wp-picker-holder').remove();

    var myOptions = {
        // you can declare a default color here,
        // or in the data-default-color attribute on the input
        defaultColor: false,
        // a callback to fire whenever the color changes to a valid color
        change: function(event, ui){
          // console.log(event);
          // jquery(this).val(('#'+ui.color._color));
        },
        // a callback to fire when the input is emptied or an invalid color
        clear: function() {},
        // hide the color picker controls on load
        hide: true,
        // show a group of common colors beneath the square
        // or, supply an array of colors to customize further
        palettes: true
      };

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

      jQuery('.acf_box_widgets_content .acf-color_picker, .acf_box_widgets_content .acf-color-picker').each(function(){

        if(!jQuery(this).parent().parent().parent().parent().hasClass('acf-clone')){

          var_color_picker = jQuery(this).find('input').first();

          var_color_picker.wpColorPicker(myOptions);
          jQuery(this).find('input.wp-color-picker').attr('type','text');
          jQuery(this).prepend(var_color_picker);
        }

      });

      jQuery(".acf_box_widgets_content .close").click(function(){

        jQuery('.acf_box_widgets_content').find('input, textarea').each(function(){
          jQuery(this).val(jQuery(this).val());
          jQuery(this).attr('value',jQuery(this).val());
          jQuery(this).text(jQuery(this).val());
          jQuery(this).html(jQuery(this).val());
        });

        tinymce.remove('.wp-editor-container textarea');

        jQuery('.fixed_box_light').remove();

        var html_box = jQuery('.acf_box_widgets_content').html();
        values_input.html(html_box);

        jQuery('#widget_acf_box_light').remove();

      });

    });

}