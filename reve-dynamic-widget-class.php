<?php
/*
** reve-dynamic-widget-class.php @ Reve Dynamic Widget
** The WordPress widget class
** Used by revedw_register_widgets()
*/ 
if ( !defined('ABSPATH') ) exit;


if ( !class_exists('Reve_Dynamic_Widget') ):

	class Reve_Dynamic_Widget extends WP_Widget {
	
		/*
		** The constructor
		*/
		public function __construct() {
			
			$base_id = REVEDW_BASEID;
			$name = 'Reve Dynamic Widget';
			
			$widget_options = array( 
				'description' 	=> __( 'Add any HTML or PHP code in any page of your site.', 'reve-dynamic-widget' ),
				'classname'		=> REVEDW_BASEID,
				);
			
			$control_options = array ( 'width'=>400 );
			
			parent::__construct( $base_id, $name, $widget_options, $control_options );

			// Checks version (since 1.7.0)
			$this->revedw_check_version();

		} // :/function
		
	
		/*
		** Displays the widget form options at widgets admin
		*/
		public function form($instance) {
			
			// If empty options gets defaults:
			if ( empty($instance) ):
				$instance = $this->revedw_get_defaults();
			endif; 

			// Loads all the form labels:	
			$labels = $this->revedw_get_labels();
							
			// Start title options group:
			echo '<p>';
			
			// Title text:
			$key = 'title';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);		
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);		
			$value = !empty( $instance[$key] ) ? $instance[$key] : '';
			
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '<input type="text" class="widefat" name="' .$name. '" id="' .$id. '" value="' .$value.'">';
			
			// Checkbox show title:
			$key = 'show_title';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);
			$value = !empty( $instance[$key] ) ? ' checked="checked" ' : '';
			
			echo '<span>';
			echo '<input type="checkbox" name="' .$name. '" id="' .$id. '"' .$value. '>';
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '</span>';
			
			// End title options group:
			echo '</p>';
			
			// Begin content options group:
			echo '<p>';
			
			// The content textarea: 
			$key = 'content';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);
			$value = !empty( $instance[$key] ) ? $instance[$key] : '';
			
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '<textarea class="widefat" rows="10" name="' .$name. '" id="' .$id. '">' .$value. '</textarea>';
			
			// The PHP eval option:
			$key = 'php_eval';		
			$id = $this->get_field_id($key);		
			$name = $this->get_field_name($key);		
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);		
			$value = !empty( $instance[$key] ) ? ' checked="checked" ' : '';
			
			echo '<span>';		
			echo '<input type="checkbox" name="' .$name. '" id="' .$id. '"' .$value. '>';		
			echo '<label for="' .$id. '">' .$label. '</label>';		
			echo '</span><br/>';
			
			// The auto paragraphs option:
			$key = 'add_paragraphs';		
			$id = $this->get_field_id($key);		
			$name = $this->get_field_name($key);		
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);		
			$value = !empty( $instance[$key] ) ? ' checked="checked" ' : '';
			
			echo '<span>';		
			echo '<input type="checkbox" name="' .$name. '" id="' .$id. '"' .$value. '>';		
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '</span><br/>';
			
			// End content options group:
			echo '</p>';	
			
			// Start template filter options group:
			echo '<p>';
			
			// Show in frontpage checkbox:
			$key = 'show_in_frontpage';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);
			$value = !empty( $instance[$key] ) ? ' checked="checked" ' : '';	

			echo '<span>';
			echo '<input type="checkbox" name="' .$name. '" id="' .$id. '"' .$value. '>';
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '</span><br/>';	

			// Show in home checkbox:
			$key = 'show_in_home';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);
			$value = !empty( $instance[$key] ) ? ' checked="checked" ' : '';
			
			echo '<span>';
			echo '<input type="checkbox" name="' .$name. '" id="' .$id. '"' .$value. '>';
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '</span><br/>';
			
			// Show in single checkbox:
			$key = 'show_in_single';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);
			$value = !empty( $instance[$key] ) ? ' checked="checked" ' : '';
			
			echo '<span>';
			echo '<input type="checkbox" name="' .$name. '" id="' .$id. '"' .$value. '>';
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '</span><br/>';
			
			// Show in pages checkbox:
			$key = 'show_in_page';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);
			$value = !empty( $instance[$key] ) ? ' checked="checked" ' : '';
			
			echo '<span>';
			echo '<input type="checkbox" name="' .$name. '" id="' .$id. '"' .$value. '>';
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '</span><br/>';
					
			// Show in archive pages checkbox:
			$key = 'show_in_archive';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);
			$value = !empty( $instance[$key] ) ? ' checked="checked" ' : '';
			
			echo '<span>';
			echo '<input type="checkbox" name="' .$name. '" id="' .$id. '"' .$value. '>';
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '</span><br/>';
			
			// Show in searchs checkbox:
			$key = 'show_in_search';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);
			$value = !empty( $instance[$key] ) ? ' checked="checked" ' : '';
			
			echo '<span>';
			echo '<input type="checkbox" name="' .$name. '" id="' .$id. '"' .$value. '>';
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '</span><br/>';
			
			// Show in 404 error pages checkbox:
			$key = 'show_in_404';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);
			$value = !empty( $instance[$key] ) ? ' checked="checked" ' : '';
			
			echo '<span>';
			echo '<input type="checkbox" name="' .$name. '" id="' .$id. '"' .$value. '>';
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '</span><br/>';
			
			// End template filter options group:	
			echo '</p>';
			
			// Start exclude & link group:
			echo '<p>'; 	

			// The exclude ids option:
			$key = 'exclude_ids';
			$id = $this->get_field_id($key);
			$name = $this->get_field_name($key);
			$label = !empty( $labels[$key] ) ? $labels[$key] : ucfirst($key);
			$value = !empty( $instance[$key] ) ? $instance[$key] : '';
				
			echo '<label for="' .$id. '">' .$label. '</label>';
			echo '<input type="text" class="widefat" name="' .$name. '" id="' .$id. '" value="' .$value.'">';
						
			// The plugin version & repository link:
			echo '<small><i>';
			echo '<a href="https://wordpress.org/plugins/reve-dynamic-widget/" target="_blank">';
			echo 'Reve Dynamic Widget '. REVEDW_VERSION;
			echo '</a>';
			echo '</i></small>';
			
			// End exclude & link group
			echo '</p>';
				
		} // :/function
	
		
		/*
		** Gets the widget default options at new instance
		*/
		private function revedw_get_defaults() {
			
			$instance = array(
				'title'				=> '',
				'show_title'		=> 1,
				'content'			=> '',
				'php_eval'			=> 0,
				'add_paragraphs'	=> 0,
				'show_in_frontpage' => 1,
				'show_in_home'		=> 1,
				'show_in_single'	=> 1,
				'show_in_page'		=> 1,
				'show_in_archive'	=> 1,
				'show_in_search'	=> 1,
				'show_in_404'		=> 1,
				'exclude_ids'		=> '',
				);
			return $instance;
		
		} // :/function
	
		

	
		/*
		** Gets the widget form labels 
		*/
		private function revedw_get_labels() {
					
			$labels = array(
				'title'				=> __('Title:', 'reve-dynamic-widget'),			
				'show_title'		=> __('Show title.', 'reve-dynamic-widget'),			
				'content'			=> __('Content (text, HTML or PHP):', 'reve-dynamic-widget'),			
				'php_eval'			=> __('Evaluate content with PHP (be careful).', 'reve-dynamic-widget'),			
				'add_paragraphs'	=> __('Add paragraphs automatically.', 'reve-dynamic-widget'),
				'show_in_frontpage'	=> __('Show in front page.', 'reve-dynamic-widget'),			
				'show_in_home'		=> __('Show in blog page.', 'reve-dynamic-widget'),			
				'show_in_single'	=> __('Show in posts.', 'reve-dynamic-widget'),			
				'show_in_page'		=> __('Show in pages.', 'reve-dynamic-widget'),			
				'show_in_archive'	=> __('Show in archive pages.', 'reve-dynamic-widget'),
				'show_in_search'	=> __('Show in search pages.', 'reve-dynamic-widget'),			
				'show_in_404'		=> __('Show in error pages.', 'reve-dynamic-widget'),			
				'exclude_ids'		=> __('Exclude posts or pages (comma separated ids):', 'reve-dynamic-widget'),
				);
			return $labels;
			
		} // :/function

		
		/*
		** Validates and updates the widget options
		*/
		public function update($new_instance, $old_instance) {
			
			$new_instance = $this->revedw_validate_instance($new_instance);
			return $new_instance;
				
		} // :/function
	
	
		/*
		** Returns all the instance options filtered and validated:
		*/
		public function revedw_validate_instance($instance) {
			
			// Title text:
			$instance['title'] = trim( $instance['title'] );
			
			// Content text have not any filter...
			
			// Checkbox options:
			$instance['show_title'] 		= !empty( $instance['show_title'] ) 		? 1 : 0;
			$instance['php_eval'] 			= !empty( $instance['php_eval'] ) 			? 1 : 0;
			$instance['add_paragraphs'] 	= !empty( $instance['add_paragraphs'] ) 	? 1 : 0;
			$instance['show_in_frontpage']	= !empty( $instance['show_in_frontpage'] ) 	? 1 : 0;   
			$instance['show_in_home'] 		= !empty( $instance['show_in_home'] ) 		? 1 : 0; 
			$instance['show_in_single'] 	= !empty( $instance['show_in_single'] ) 	? 1 : 0; 
			$instance['show_in_page'] 		= !empty( $instance['show_in_page'] ) 		? 1 : 0; 
			$instance['show_in_archive'] 	= !empty( $instance['show_in_archive'] )	? 1 : 0; 
			$instance['show_in_search'] 	= !empty( $instance['show_in_search'] ) 	? 1 : 0; 
			$instance['show_in_404'] 		= !empty( $instance['show_in_404'] ) 		? 1 : 0; 
			
			// Validates exclude ids:
			$instance['exclude_ids'] = trim( $instance['exclude_ids'] );
			
			if ( !empty($instance['exclude_ids']) ):
				
				$old_exclude = explode(',', $instance['exclude_ids'] );
				$new_exclude = array();
				
				foreach ($old_exclude as $key=>$value):
					
					$value = (int)$value;
					if ( !empty($value) && !in_array($value,$new_exclude) ):
						array_push( $new_exclude, $value );
					endif;
				
				endforeach;
				
				$instance['exclude_ids'] = implode(',',$new_exclude);
			
			endif;
	
			return $instance;
			
		} // :revedw_validate_instance() 
	
	
		/*
		** The widget method, renders the widget
		*/
		public function widget($args, $instance) {
			
			// If show widget validation method:
			if ( $this->revedw_validate_show($instance)==false ) return;
		
			$title 	= !empty( $instance['title'] ) ? $instance['title'] : '';
			
			$content  = !empty( $instance['content'] ) ? $instance['content'] : '';
			
			// Empty widget, nothing to show:
			if ( empty($title) && empty($content) ) return;
			
			// Opens the sidebar widget container:
			echo $args['before_widget'];

			// The widget title:
			if ( !empty($title) && !empty($instance['show_title']) ):
				
				echo $args['before_title'] . $title . $args['after_title'];
			
			endif; 
			
			// The content:
			if ( !empty($content) ):
				
				// With PHP eval:
				if ( !empty($instance['php_eval']) ) $content = $this->revedw_php_eval($content);
				
				// With paragraphs:
				if ( !empty( $instance['add_paragraphs'] ) ) $content = wpautop( $content );	
				
				// With shortcodes:
				$content = do_shortcode($content);
				
				// Displays content and its container with custom class:
				echo '<div class="revedw-content">' . $content . '</div>';
				
			endif;
			
			// Closes sidebar widget container:
			echo $args['after_widget'];		
			
		} // :/function 
	
	
		/*
		** Applies the show and exclude filters and returns true/false:
		*/
		private function revedw_validate_show($instance) {
						
			// Filters by template:
			if ( is_front_page() && empty( $instance['show_in_frontpage'] ) )			return false;
			if ( is_home() && empty( $instance['show_in_home'] ) ) 						return false;
			if ( is_single() && empty( $instance['show_in_single'] ) ) 					return false;
			if ( is_page() && !is_front_page() && empty( $instance['show_in_page'] ) ) 	return false;
			if ( is_archive() && empty( $instance['show_in_archive'] ) )				return false;
			if ( is_search() && empty( $instance['show_in_search'] ) ) 					return false;
			if ( is_404() && empty( $instance['show_in_404'] ) ) 						return false;
			
			// Filters by exclude ids (posts or pages):	
			if ( is_singular() && !empty( $instance['exclude_ids'] ) ):
				
				$post_id = get_the_ID();
				$exclude_ids = explode(',', $instance['exclude_ids']);
				if ( in_array( $post_id, $exclude_ids) ) return false;
			
			endif;
		
			return true;
		
		} // :/function
	
	
		/*
		** The content php eval function
		*/
		private function revedw_php_eval($content) {
			
			$content = '?>'.$content;
			
			ob_start();
			// Note that evaluates with error control operator (@), errors will be ignored!
			@ eval($content);
			$content = ob_get_contents();
			ob_clean();
			ob_end_clean();	
			
			return $content;
		
		} // :/function
	

		/*
		** Checks version and updates all widget instances
		** Use by __constructor(), since 1.7.0
		*/
		private function revedw_check_version() {
		
			$version_key = 'widget_' .REVEDW_BASEID. '_version';
			$saved_version = trim( get_option($version_key) );

			// If same version...	
			if ( $saved_version == REVEDW_VERSION ) return false;

			// Updating process... 
			$default_instance = $this->revedw_get_defaults();

			$old_instances = $this->get_settings();
			$new_instances = array();

			// Reads all instances (adds only keys of default instance):

			foreach ( $old_instances as $id=>$instance):

				foreach ( $default_instance as $key => $value ):

					$new_instances[$id][$key] = isset( $old_instances[$id][$key] ) ? $old_instances[$id][$key] : $default_instance[$key];

				endforeach;

			endforeach;
			
			// Depuration
			/*
			echo 'Saved version: '.$saved_version. ' - Current version: '. REVEDW_VERSION.'<br>';
			echo '<br>OLD INSTANCES:<br>';
			print_r($old_instances); '<br><br>';
			echo '<br>NEW INSTANCES:<br>';
			print_r($new_instances); '<br><br>';
			*/

			// Saves new instances & updates version key:
			$this->save_settings( $new_instances );

			update_option($version_key, REVEDW_VERSION);

			return true;	
		
		} // :/function

	
	} // :/class

endif;