<?php
/**
* Implementation of hook_panels_styles().
*/
$plugin =  array(
  'with_bg_image' => array(
    'title' => t( 'With background image' ),
    'description'	=> t( 'Pane that has alternate markup to display a background image and content on top of it.' ),
    'render pane' => 'with_bg_image_render_pane',
    'hook theme'	=> array(
      'with_bg_image_theme_pane' => array(
        'template' => 'with_bg_image-pane',
        'process functions' => array( 'template_with_bg_image_render_pane_process' ),
        'path' => drupal_get_path( 'module', 'pp_helper' ) .'/plugins/styles/with_bg_image',
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
function theme_with_bg_image_render_pane( $vars ){
  return theme( 'with_bg_image_theme_pane', $vars );
}


/**
 * Process function.
 * @param type $vars
 */
function template_with_bg_image_render_pane_process( &$vars ){
  
  // Variables.
  $vars[ 'pane_attributes' ] = array( 'class' => "panel-pane pane-{$vars[ 'content' ]->type}" . ( isset( $vars[ 'content' ]->css_class ) ? " {$vars[ 'content' ]->css_class}" : null ) . ' pane-with-bg-img' );
  if( isset( $vars[ 'content' ]->css_id ) ){ $vars[ 'pane_attributes' ][ 'id' ] = $vars[ 'content' ]->css_id; }
  
  // Matches available images.
  $match = array( );
  
  // Content.
  $cnt = $vars[ 'content' ];
  
  // If a match is found...
  if( preg_match( '/<a[^>]*><img[^>]*><\/a>/Ui', $cnt->content, $match ) ){
    
    // Performs replacements.
    $href = strip_tags( $match[ 0 ], '<a>' );
    $href = substr( $href, strpos( $href, '"' ) + 1 );
    $href = substr( $href, 0, strpos( $href, '"' ) );
    
    // Title as link.
    $cnt->title = '<a href="' . $href . '">' . $cnt->title . '</a>';
    
  }
  
}