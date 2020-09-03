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
                $widget_name =  str_replace('-', '_', $fileinfo->getFilename());
                
                $widget_label = WidgetsWidgets::parseWidgetHeaders($path.'/'.$fileinfo->getFilename().'/functions.php');
                
                $widgets[$widget_name] = $widget_label['title'];
            endif;
        endforeach;
        
        return $widgets;
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
        
        foreach($dir as $fileinfo):            
            if($fileinfo->isDir() && !$fileinfo->isDot()):

                $widget_name =  str_replace('-', '_', $fileinfo->getFilename());
                
                $widget_label = WidgetsWidgets::parseWidgetHeaders($path.'/'.$fileinfo->getFilename().'/functions.php');
                
                if(!$widget_label['title']){
                    $widget_label['title'] = ucfirst(str_replace('_', ' ', $widget_label['name']));
                }

                $widgets[$widget_name]['title'] = $widget_label['title'];
                
                $dir_widget = $path.'/'.$fileinfo->getFilename();

                $style = glob("{$dir_widget}/style.*");
                if($style){
                    $widgets[$widget_name]['style'] = $this->fopen_r($style[0]);
                }

                $index = glob("{$dir_widget}/index.*");
                if($index){
                    $widgets[$widget_name]['index'] = $this->fopen_r($index[0]);
                }

                $js = glob("{$dir_widget}/app.js");
                if($js){
                    $widgets[$widget_name]['js'] = $this->fopen_r($js[0]);
                }

                $functions = glob("{$dir_widget}/functions.php");
                if($functions){
                    $widgets[$widget_name]['functions'] = $this->fopen_r($functions[0]);
                }

                $capa = glob("{$dir_widget}/main.png");
                if($capa){
                    $widgets[$widget_name]['capa'] = $path_uri.'/'.$fileinfo->getFilename().'/main.png';
                }
                
            endif;
        endforeach;
        
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