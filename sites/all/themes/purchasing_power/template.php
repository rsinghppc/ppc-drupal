<?php
 
// UI libraries.
drupal_add_library( 'system', 'ui.dialog' );

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */
function get_partner_logo($domain, &$vars) {
	$c = mysql_connect("localhost", "drupal", "drupal");
	mysql_select_db("drupal");
	$result = mysql_query("SELECT logo_url from ppc_client where upper(domain)='" . $domain . "';");
	$row = mysql_fetch_assoc($result);
	$logo_url = $row['logo_url'];
	if (strlen($logo_url) > 0) {
		$partner_logo_url = '<img src="/sites/all/themes/purchasing_power/img/' . $logo_url . '" class="partnerLogo"/>';
		$vars['partner_logo_img'] =  $partner_logo_url;
	}
	return $retval;
}

/**
 * Implements hook_process_region().
 */
function purchasing_power_alpha_process_region( &$vars ){

	// Get current theme.
	$theme = alpha_get_theme( );	
	
	// Depending on the region...
	switch( $vars[ 'elements' ][ '#region' ] ){
	
		// For the branding region...
		case 'branding':
			
			// If logo is to be used...
			if( $vars[ 'logo' ] ){
				
				// Changes logo.
				$vars[ 'logo' ] = $theme->page[ 'logo' ] = drupal_get_path( 'theme', 'purchasing_power' ) . '/img/logo.png';				
				$jpg[ 'logo_img' ] = theme( 'image', array(
						'alt'			=>	check_plain( $vars[ 'site_name' ] ),
						'path'		=>	$vars[ 'logo' ],
				) );
				$vars['linked_logo_img'] = l( $vars[ 'logo_img' ], '<front>', 
					array( 'attributes' => array( 'rel' => 'home', 'title' => check_plain ($vars[ 'site_name' ] ) ), 'html' => TRUE ) );


				$domain = $_GET["domain"];
				$vars['domain'] = get_partner_logo($domain);
				if ($domain) {
					get_partner_logo($domain, &$vars);
				}
				//$vars['debug_info'] = "<pre>" . print_r($vars) . "</pre>";
			}
			
			break;
		
		case 'content':
			
			// Removes page title on front page.
			if( drupal_is_front_page( ) ){
				$vars[ 'title' ] = '';
			}
			
			break;
			
	}
	
}

/***
 * Implements template_preprocess_block().
 */
function purchasing_power_preprocess_block( &$vars ){
	
	// Block.
	$b = $vars[ 'block' ];
		
  // Adds menu class.
  if( $b->module == 'menu_block' ){ $vars[ 'attributes_array' ][ 'class' ][ ] = 'block-menu'; }  

	// For menus on the left sidebar...
	if( $b->region == 'sidebar_first' && ( $b->module == 'menu' || $b->module == 'menu_block' ) ){
		
		// Match.
		$matches = array( );
		if( preg_match_all( '/<a[^>]*>.*<\/a>/U' , $vars[ 'content' ], $matches ) ){
			
			// Elements.
			$matches = $matches[ 0 ]; 
			
			// Removes top element.
			$first = array_shift( $matches );
			
			// Replacement for top level.
			$vars[ 'content' ] = str_replace( $clean = strip_tags( $first ), '<span>' . $clean . '</span>', $vars[ 'content' ] );
			
			// For each match...
			foreach( $matches as $m ){
				
				// Adds the decoration.
				$vars[ 'content' ] = str_replace( $clean = strip_tags( $m ), '<span>»</span> ' . $clean, $vars[ 'content' ] );
				
			}
			
		}
		
	}
	
}

/**
 * Implementation of theme_file_icon( ).
 */
function purchasing_power_file_icon( $vars ) {

	// Path to current theme.
	global $theme_path;
	
	// Reference to file.
	$file = $vars[ 'file' ];
	$icon_directory = $vars[ 'icon_directory' ];

	// For PDFs changes icons directory.
	if( ( $mime = check_plain( $file->filemime ) ) == 'application/pdf' ){
		$icon_directory = "{$theme_path}/img";
	}
	
	// Icon URL.
	$icon_url = file_icon_url( $file, $icon_directory );
	
	// Themed output.
	return '<img class="file-icon" alt="" title="' . $mime . '" src="' . $icon_url . '" />';
	
}


function purchasing_power_brightcove_field_embed($variables) {
  if (!isset($variables['player'])) {
    watchdog('brightcove', 'Video Player is missing.', array(), WATCHDOG_ERROR);
  }

  $player = brightcove_player_load($variables['player']);

  $values = array(
    'id' => 'myExperience',
    'bgcolor' => 'FFFFFF',
    'width' => $variables['width'],
    'height' => $variables['height'],
  );

  foreach ($values as $key => $value) {
    if (isset($variables['params'][$key])) {
      $values[$key] = $variables['params'][$key];
    }
  }

  $asset_code = '';

  if (isset($variables['video_id'])) {
    if (is_array($variables['video_id'])) {
      if (drupal_strtolower($variables['type']) == 'video') {
        $asset_code = '<param name="@videoPlayer" value="';
      }
      else {
        // TODO: Add different types than video.
      }

      foreach ($variables['video_id'] as $asset_td) {
        $asset_code .= $asset_td . ',';
      }

      $asset_code = drupal_substr($asset_code, 0, -1);
      $asset_code .= '" />';
    }
    else {
      if (drupal_strtolower($variables['type']) == 'video') {
        $asset_code = '<param name="@videoPlayer" value="' . $variables['video_id'] . '" />';
      }
      else {
        // TODO: Add different types than video.
      }
    }
  }

  $code = '
    <object id="' . $values['id'] . '" class="BrightcoveExperience">
    <param name="bgcolor" value="#' . $values['bgcolor'] . '" />
    <param name="wmode" value="transparent" />
    <param name="width" value="' . $values['width'] . '" />
    <param name="height" value="' . $values['height'] . '" />
    <param name="playerID" value="' . $player->player_id . '" />'
    . $asset_code . '
    <param name="isVid" value="true" />
    <param name="isUI" value="true" />
    <param name="playerKey" value="' . $player->player_key . '" />
    </object>';

  return $code;
}
