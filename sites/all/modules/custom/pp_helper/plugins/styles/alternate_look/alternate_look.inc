<?php
/**
* Implementation of hook_panels_styles().
*/
$plugin =  array(
  'alternate_look' => array(
    'title' => t( 'Alternate look' ),
    'description'	=> t( 'Pane that contains alternate markup.' ),
    'render pane' => 'alternate_look_render_pane',
    'hook theme'	=> array(
      'alternate_look_theme_pane' => array(
        'template' => 'alternate_look-pane',
        'process functions' => array( 'template_alternate_look_render_pane_process' ),
        'path' => drupal_get_path( 'module', 'pp_helper' ) .'/plugins/styles/alternate_look',
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
function theme_alternate_look_render_pane( $vars ){
  return theme( 'alternate_look_theme_pane', $vars );
}


/**
 * Process function.
 * @param type $vars
 */
function template_alternate_look_render_pane_process( &$vars ){
  
  // Variables.
  $vars[ 'pane_attributes' ] = array( 'class' => "panel-pane pane-{$vars[ 'content' ]->type}" . ( isset( $vars[ 'content' ]->css_class ) ? " {$vars[ 'content' ]->css_class}" : null ) . ' alternate-look-pane' );
  if( isset( $vars[ 'content' ]->css_id ) ){ $vars[ 'pane_attributes' ][ 'id' ] = $vars[ 'content' ]->css_id; }
  
}