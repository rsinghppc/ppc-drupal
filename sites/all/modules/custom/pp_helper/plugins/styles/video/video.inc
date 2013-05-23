<?php
/**
* Implementation of hook_panels_styles().
*/
$plugin =  array(
  'video' => array(
    'title' => t( 'Video' ),
    'description'	=> t( 'Pane that contains a video.' ),
    'render pane' => 'video_render_pane',
    'hook theme'	=> array(
      'video_theme_pane' => array(
        'template' => 'video-pane',
        'path' => drupal_get_path( 'module', 'pp_helper' ) .'/plugins/styles/video',
        'process functions' => array( 'template_video_render_pane_process' ),
        'variables' => array(
          'content' => NULL,
          'settings' => NULL,
         ),
       ),
		),
	),
);

/**
 * Renders pane.
 */
function theme_video_render_pane( $vars ){
  return theme( 'video_theme_pane', $vars );
}

/**
 * Process function.
 * @param type $vars
 */
function template_video_render_pane_process( &$vars ){
  
  // Variables.
  $vars[ 'pane_attributes' ] = array( 'class' => "panel-pane pane-{$vars[ 'content' ]->type}" . ( isset( $vars[ 'content' ]->css_class ) ? " {$vars[ 'content' ]->css_class}" : null ) . ' pane-video-player' );
  if( isset( $vars[ 'content' ]->css_id ) ){ $vars[ 'pane_attributes' ][ 'id' ] = $vars[ 'content' ]->css_id; }
  
}