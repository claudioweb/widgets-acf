<?php 

if(!defined('ABSPATH')) exit;

class WidgetsLocation extends ACF_Location {
    
    public function initialize() {
        $this->category = 'Forms';
        $this->name = 'widget_acf';
        $this->label = 'Widget ACF';
        // $this->object_type = 'post';
        
        return $this;
    }
    
    public function get_values($rule=null) {
        
        $widgets = array();
        
        $path =
        function_exists('\App\template') || function_exists('\Roots\view') ? 
        get_template_directory() . '/views/widgets-templates' :
        get_template_directory() . '/widgets-templates';
        
        
        if(!is_dir($path)){
            $path = plugin_dir_path(__FILE__) . '../../more-widgets-templates';
        }
        
        if(!is_dir($path))
        return $widgets;
        
        $dir = new DirectoryIterator($path);
        
        foreach($dir as $fileinfo):            
            if($fileinfo->isDir() && !$fileinfo->isDot()):
                
                $widget_label = WidgetsWidgets::parseWidgetHeaders($path.'/'.$fileinfo->getFilename().'/functions.php');
                
                $widget_name =  $widget_label['name'];
                
                $widget_label['title'] = ucfirst(str_replace('_', ' ', $widget_label['name']));
                $widgets[$widget_name] = $widget_label['title'];
            endif;
        endforeach;
        
        return $widgets;
    }
    
    public function export_zip($widget_name){

        $path =
        function_exists('\App\template') || function_exists('\Roots\view') ? 
        get_template_directory() . '/views/widgets-templates' :
        get_template_directory() . '/widgets-templates';

        $dir = $path.'/'.$dir_widget;
        $zip = new ZipArchive();
        $zipname = $widget_name . '.zip';
        $res = $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        if ($res === TRUE) {
            foreach (glob($dir . '/*') as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
        } else {
            echo 'Failed to create to zip. Error: ' . $res;
        }

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);       

    }
    
    public function get_codes($rule=null) {
        
        $widgets = array();
        
        $path =
        function_exists('\App\template') || function_exists('\Roots\view') ? 
        get_template_directory() . '/views/widgets-templates' :
        get_template_directory() . '/widgets-templates';
        
        if(!is_dir($path)){
            return $widgets;
        }
        
        $path_uri =
        function_exists('\App\template') || function_exists('\Roots\view') ? 
        get_template_directory_uri() . '/views/widgets-templates' :
        get_template_directory_uri() . '/widgets-templates';
        
        $dir = new DirectoryIterator($path);
        
        $css_widgets = '';
        $js_widgets = '';

        foreach($dir as $fileinfo):
                      
            if($fileinfo->isDir() && !$fileinfo->isDot()):
                
                $widget_name =  str_replace('-', '_', $fileinfo->getFilename());
                
                $widget_label = WidgetsWidgets::parseWidgetHeaders($path.'/'.$fileinfo->getFilename().'/functions.php');
                
                $widget_label['title'] = ucfirst(str_replace('_', ' ', $widget_label['name']));
                
                $widgets[$widget_name]['title'] = $widget_label['title'];
                
                $dir_widget = $path.'/'.$fileinfo->getFilename();
                
                $style = glob("{$dir_widget}/style.*");
                if($style){
                    $widgets[$widget_name]['style'] = $this->fopen_r($style[0]);
                    $css_widgets .= $widgets[$widget_name]['style'];
                }
                
                $index = glob("{$dir_widget}/index.*");
                if($index){
                    $widgets[$widget_name]['index'] = $this->fopen_r($index[0]);
                }
                
                $js = glob("{$dir_widget}/app.js");
                if($js){
                    $widgets[$widget_name]['js'] = $this->fopen_r($js[0]);
                    $js_widgets .= $widgets[$widget_name]['js'];
                }
                
                $functions = glob("{$dir_widget}/functions.php");
                if($functions){
                    $widgets[$widget_name]['functions'] = $this->fopen_r($functions[0]);
                }
                
                $capa = glob("{$dir_widget}/main.png");
                if($capa){
                    $widgets[$widget_name]['capa'] = $path_uri.'/'.$fileinfo->getFilename().'/main.png';
                }
                
                $json = glob("{$dir_widget}/fields.json");
                if($json){
                    $json = json_decode($this->fopen_r($json[0]), true);
                    foreach($json as $field_group){
                        
                        // Search database for existing field group.
                        $post = acf_get_field_group_post( $field_group['key'] );
                        if( $post ) {
                            $field_group['ID'] = $post->ID;
                        }
                        
                        // Import field group.
                        $field_group = acf_import_field_group( $field_group );
                    }
                    
                }
                
                $widgets[$widget_name]['name'] = $widget_label['title'];
                
            endif;
        endforeach;
        
        $url_widgets = get_template_directory();
        
		$enquee_css = get_field('widgets_acf_enquee_css','options');
        
        if($enquee_css==true){
            // css widgets
            require  plugin_dir_path(__FILE__) . "../../scssphp/scss.inc.php";
            $scss = new scssc();
            $scss->setFormatter("scss_formatter_compressed");
            $css_widgets = $scss->compile($css_widgets);
            $dir_css_widget = $url_widgets.'/widgets_acf.css';
            $fp = fopen($dir_css_widget, 'w');
            fwrite($fp, $css_widgets);
            fclose($fp);

            // Enqueue style
            wp_enqueue_style("widget/widgets_acf", get_template_directory_uri().'/widgets_acf.css', array(), false, 'all');
        }

		$enquee_js = get_field('widgets_acf_enquee_js','options');
        if($enquee_js==true){
            // js widgets
            require plugin_dir_path(__FILE__) . '../../JShrink/Minifier.php';
            $js_widgets = \JShrink\Minifier::minify($js_widgets);
            $dir_js_widget = $url_widgets.'/widgets_acf.js';
            $fp = fopen($dir_js_widget, 'w');
            fwrite($fp, $js_widgets);
            fclose($fp);

            // Enqueue script
            wp_enqueue_script("widget/widgets_acf", get_template_directory_uri().'/widgets_acf.js', array(), false, true);
        }



       
        
        return $widgets;
    }
    
    public function fopen_r($file){
        
        $file  = fopen($file, 'r');
        $lines_file = '';
        while(! feof($file)) {
            $line = fgets($file);
            $lines_file .= $line;
        }
        
        fclose($file);
        
        return $lines_file;
    }
    
    public function match($rule, $screen, $field_group) {
        // Check screen args for "post_id" which will exist when editing a post.
        // Return false for all other edit screens.
        // if( isset($screen['post_id']) ) {
            //     $post_id = $screen['post_id'];
            // } else {
                //     return false;
                // }
                
                // // Load the post object for this edit screen.
                // $post = get_post( $post_id );
                // if( !$post ) {
                    //     return false;
                    // }
                    
                    // // Compare the Post's author attribute to rule value.
                    // $result = ( $post->post_author == $rule['value'] );
                    
                    // // Return result taking into account the operator type.
                    // if( $rule['operator'] == '!=' ) {
                        //     return !$result;
                        // }
                        // return $result;
                    }
                    
                }