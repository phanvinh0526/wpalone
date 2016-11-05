<?php 
/**
 * functions.php
 * 
 */

/**
 * bt_GetAllFileOnDir
 * 
 * @param string $dir
 * @return array
 */
if( ! function_exists( 'bt_ScanAllFileOnDir' ) ) :
	function bt_GetAllFileOnDir( $dir )
	{	
		$files = array();
		if( is_dir( $dir ) && $files = glob( $dir . '*.php', GLOB_BRACE ) ) :
			$files = array_diff( $files, array( '.', '..' ) );
		endif;

		return $files;
	}
endif;

/**
 * bt_ScanCommentInFile
 *
 * @param string $path
 * @return array
 */
if( ! function_exists( 'bt_ScanCommentInFile' ) ) :
	function bt_ScanCommentInFile( $path )
	{
		// require_once( ABSPATH . 'wp-admin/includes/file.php' );
		// WP_Filesystem();
		// global $wp_filesystem;

		$comments = array();
		$params = array();
		$expr = "/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/";
		
	    // $comments = $wp_filesystem->get_contents( $path );
	    $comments = file_get_contents( $path );

	    preg_match_all($expr, $comments, $matches);
	    if( ! isset( $matches[0] ) || ! isset( $matches[0][0] ) ) return;

	    $comments = $matches[0][0];

		if( empty( $comments ) ) return;

		/* filter string */
		$comments = str_replace( array( '/*', '/**', '*/', '**/', '*' ) , '', $comments );

		/*  */
		$segments = explode( chr(10), $comments );

		/* build params */
		if( count( $segments ) == 0 ) return;
		foreach( $segments as $segment ) {
			$segment = trim( $segment );
			if( ! empty( $segment ) ) { 
				$_arr = explode( ':', $segment, 2 );
				if( count( $_arr ) == 2 )
					$params[strtolower( $_arr[0] )] = ltrim( $_arr[1] );
			}
		}

	    return( $params );
	}
endif;

/**
 * bt_LoadHeaderLayout
 *
 */
if( ! function_exists( 'bt_LoadHeaderLayoutOpts' ) ) :
	function bt_LoadHeaderLayoutOpts()
	{
		$files = bt_GetAllFileOnDir( ABS_PATH_FR . '/headers/' );
		if( count( $files ) <= 0 ) return;

		$header_opts = array();
		foreach( $files as $file ) : 
			$path = $file;
			$comment = bt_ScanCommentInFile( $path );

			if( $comment ) :
				$header_opts[basename( $path, '.php' )] = array(
					'alt' => $comment['layout name'],
					'img' => URI_PATH . $comment['preview image'],
					);
			endif;
		endforeach;


		return $header_opts;
	}
endif;

/**
 * bt_LoadHeaderLayoutOptsMetabox
 *
 */
if( ! function_exists( 'bt_LoadHeaderLayoutOptsMetabox' ) ) :
	function bt_LoadHeaderLayoutOptsMetabox()
	{
		$files = bt_GetAllFileOnDir( ABS_PATH_FR . '/headers/' );
		if( count( $files ) <= 0 ) return;

		$header_opts = array( 'global' => __( 'Global', 'bearsthemes' ) );
		foreach( $files as $file ) : 
			$path = $file;
			$comment = bt_ScanCommentInFile( $path );

			if( $comment ) $header_opts[basename( $path, '.php' )] = $comment['layout name'];
		endforeach;
		return $header_opts;
	}
endif;

if( ! function_exists( 'bearsthemes_LoadFooterLayoutOpts' ) ) :
	function bearsthemes_LoadFooterLayoutOpts()
	{
		$files = bt_GetAllFileOnDir( ABS_PATH_FR . '/footers/' );
		if( count( $files ) <= 0 ) return;

		$footer_opts = array();
		foreach( $files as $file ) : 
			$path = $file;
			$comment = bt_ScanCommentInFile( $path );

			if( $comment ) :
				$footer_opts[basename( $path, '.php' )] = array(
					'alt' => $comment['layout name'],
					'img' => URI_PATH . $comment['preview image'],
					);
			endif;
		endforeach;


		return $footer_opts;
	}
endif;

/**
 * bearsthemes_template_part
 *
 * @param [string] $__path
 * @param [string] $__type
 * @param [array] $__param
 */
if( ! function_exists( 'bearsthemes_template_part' ) ) :
	function bearsthemes_template_part( $__path = "", $__type = "", $__params )
	{	
		extract( $__params );

		# check $type exist
		$__new_path = "";
		if( ! empty( $__type ) ) $__new_path = sprintf( '%s-%s', $__path, $__type );

		if( file_exists( $__new_path . '.php' ) ) include $__new_path . '.php';
		else include $__path . '.php';
	}
endif;

/**
 * bearsthemes_renderCarouselByAttachmentId
 *
 * @param [array] $ids
 * @param [string] $size
 * @return [html] $output
 */
if( ! function_exists( 'bearsthemes_renderCarouselByAttachmentId' ) ) :
	function bearsthemes_renderCarouselByAttachmentId( $ids = array(), $size = 'medium' )
	{
		if( count( $ids ) <= 0 ) return;
		$slide_item = "";

		foreach( $ids as $id ) :
			$img_data = wp_get_attachment_image_src( $id, $size );
			$img_url = $img_data[0];

			$slide_item .= sprintf( '
				<div class="s-item">
					<div class="s-item-inner" style="background: url(%s) no-repeat center center / cover;">
					</div>
				</div>', $img_url );
		endforeach;

		$slick_opts = json_encode( array( 'dots' => true, 'arrows' => false, 'autoplay' => true, 'autoplaySpeed' => 5000 ) );
		return sprintf( '<div class="bears-slick-carousel" data-slick-carousel=%s>%s</div>', $slick_opts, $slide_item );
	}
endif;

/**
 * bearsthemes_renderAudio
 *
 * @param [string] $audio_data
 * @param [string] $audio_type
 * @return [html] $output
 */
if( ! function_exists( 'bearsthemes_renderAudio' ) ) :
	function bearsthemes_renderAudio( $audio_data, $audio_type )
	{
		$output = "";

		switch ( $audio_type ) {
			case 'soundcloud':
				$output = $audio_data;
				break;
		}

		return sprintf( '<div class="bears-audio-wrap">%s</div>', $output );
	}
endif;

if( ! function_exists( 'bearsthemes_renderVideo' ) ) :
	function bearsthemes_renderVideo( $video_data, $video_type, $video_height = "" )
	{
		$output = "";

		switch ( $video_type ) {
			case 'vimeo':
				$segment_url = explode( '/' , $video_data );
				$vimeo_ID = end( $segment_url );
				$output = sprintf( '
					<iframe 
					src="https://player.vimeo.com/video/%s"
					width="%s"
					%s
					frameborder="0" 
					webkitallowfullscreen 
					mozallowfullscreen 
					allowfullscreen></iframe>', 
					$vimeo_ID, '100%', ( ! empty( $video_height ) ) ? "height='{$video_height}'" : '' );
				break;
			
			case 'youtube':
				$segment_url = explode( '/' , $video_data );
				$youtu_ID = end( $segment_url );
				$output = sprintf( '
					<iframe 
					src="https://www.youtube.com/embed/%s" 
					width="%s"
					%s
					frameborder="0" 
					allowfullscreen></iframe>', 
					$youtu_ID, '100%', ( ! empty( $video_height ) ) ? "height='{$video_height}'" : '' );
				break;

			default:
				# code...
				break;
		}

		return sprintf( '<div class="bears-video-wrap">%s</div>', $output );
	}
endif;

/**
 * tbbs_BearsCarouselCausesParams
 *
 */
if( ! function_exists( 'tbbs_BearsCarouselCausesParams' ) ) :
	function tbbs_BearsCarouselCausesParams()
	{
		return array(
			array(
				'name' => 'trims_description',
				'title' => __( 'Trims Description' ),
				'type' => 'text',
				'value' => 22,
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', 'bearsthemes' ),
						),
					array(
						'value' => 'urgent',
						'text' => __( 'Urgent', 'bearsthemes' ),
						),
					array(
						'value' => 'basic',
						'text' => __( 'Basic', 'bearsthemes' ),
						),
					)
				),
			array(
				'name' => 'color',
				'title' => __( 'Color', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'black',
				'description' => __( 'Opt use for layout item: Basic' ),
				'options' => array(
					array(
						'value' => 'white',
						'text' => __( 'White', 'bearsthemes' ),
						),
					array(
						'value' => 'black',
						'text' => __( 'Black', 'bearsthemes' ),
						),
					)
				)
			);
	}
endif;

/**
 * tbbs_BearsBlockDirectLinkParams
 *
 */
if( ! function_exists( 'tbbs_BearsBlockDirectLinkParams' ) ) :
	function tbbs_BearsBlockDirectLinkParams()
	{
		return array(
			array(
				'name' => 'title',
				'title' => __( 'Title', 'bearsthemes' ),
				'type' => 'text',
				'value' => '',
				),
			array(
				'name' => 'sub_title',
				'title' => __( 'Sub Title', 'bearsthemes' ),
				'type' => 'text',
				'value' => '',
				),
			array(
				'name' => 'link',
				'title' => __( 'Link', 'bearsthemes' ),
				'type' => 'link',
				'value' => array( 'text' => '', 'url' => '' ),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', 'bearsthemes' ),
						),
					array(
						'value' => 'title_vertical',
						'text' => __( 'Title vertical', 'bearsthemes' ),
						),
					)
				)
			);
	}
endif;

/**
 * tbbs_BearsBlockCouterParams
 *
 */
if( ! function_exists( 'tbbs_BearsBlockCouterParams' ) ) :
	function tbbs_BearsBlockCounterParams()
	{
		return array(
			array(
				'name' => 'title',
				'title' => __( 'Title', 'bearsthemes' ),
				'type' => 'text',
				'value' => '',
				),
			array(
				'name' => 'iconfont',
				'title' => __( 'Icon-Font', 'bearsthemes' ),
				'type' => 'text',
				'value' => '',
				),
			array(
				'name' => 'number',
				'title' => __( 'Number', 'bearsthemes' ),
				'type' => 'text',
				'value' => '210',
				),
			array(
				'name' => 'color',
				'title' => __( 'Color', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'light',
						'text' => __( 'Light', 'bearsthemes' ),
						),
					array(
						'value' => 'dark',
						'text' => __( 'Dark', 'bearsthemes' ),
						),
					)
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', 'bearsthemes' ),
						),
					)
				)
			);
	}
endif;

if( ! function_exists( 'bearsthemes_BearsBlockVideoParams' ) ) :
	function bearsthemes_BearsBlockVideoParams()
	{
		return array(
			array(
				'name' => 'title',
				'title' => __( 'Title', 'bearsthemes' ),
				'type' => 'text',
				'value' => '',
				),
			array(
				'name' => 'sub_title',
				'title' => __( 'Sub Title', 'bearsthemes' ),
				'type' => 'text',
				'value' => '',
				),
			array(
				'name' => 'iconfont',
				'title' => __( 'Icon-Font', 'bearsthemes' ),
				'type' => 'text',
				'value' => 'fa fa-play-circle',
				),
			array(
				'name' => 'video_url',
				'title' => __( 'Video Url', 'bearsthemes' ),
				'type' => 'text',
				'value' => '',
				),
			// array(
			// 	'name' => 'type',
			// 	'title' => __( 'Type', 'bearsthemes' ),
			// 	'type' => 'select',
			// 	'value' => 'popup',
			// 	'options' => array(
			// 		array(
			// 			'value' => 'popup',
			// 			'text' => __( 'Popup', 'bearsthemes' ),
			// 			),
			// 		array(
			// 			'value' => 'newtap',
			// 			'text' => __( 'New Tab', 'bearsthemes' ),
			// 			),
			// 		)
			// 	),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', 'bearsthemes' ),
						),
					)
				)
			);
	}
endif;

/**
 * tbbs_BearsCarouselGalleryParams
 *
 */
if( ! function_exists( 'tbbs_BearsCarouselGalleryParams' ) ) :
	function tbbs_BearsCarouselGalleryParams()
	{
		return array(
			array(
				'name' => 'height',
				'title' => __( 'Height', 'bearsthemes' ),
				'type' => 'text',
				'value' => '450px'
				),
			array(
				'name' => 'gallery_ids',
				'title' => __( 'Gallery Ids', 'bearsthemes' ),
				'type' => 'media',
				'multiple' => true,
				'data' => 'id',
				),
			array(
				'name' => 'image_size',
				'title' => __( 'Image Size', 'bearsthemes' ),
				'type' => 'imagesize',
				'value' => 'medium_large',
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', 'bearsthemes' ),
						)
					)
				)
			);
	}
endif;

/**
 * tbbs_BearsCarouselWelfareReviewsParams
 *
 */
if( ! function_exists( 'tbbs_BearsCarouselWelfareReviewsParams' ) ) : 
	function tbbs_BearsCarouselWelfareReviewsParams()
	{
		return array(
			array(
				'name' => 'count_items',
				'title' => __( 'Count Item(s)', 'bearsthemes' ),
				'type' => 'text',
				'value' => 3
				),
			array(
				'name' => 'trim_text',
				'title' => __( 'Trim Text', 'bearsthemes' ),
				'type' => 'text',
				'value' => 'full',
				'description' => __( 'Ex: 10, 20, full' ),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', 'bearsthemes' ),
						)
					)
				)
			);
	}
endif;


/** 
 * tbbs_BearsButtonCustomParams
 *
 */
if( ! function_exists( 'tbbs_BearsButtonCustomParams' ) ) :
	function tbbs_BearsButtonCustomParams()
	{
		return array(
			array(
				'name' => 'link',
				'title' => __( 'Link', 'bearsthemes' ),
				'type' => 'link',
				'value' => array( 'text' => '', 'url' => '' ),
				),
			array(
				'name' => 'align',
				'title' => __( 'Align', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'left',
				'options' => array(
						array( 'value' => 'left', 'text' => 'Left' ),
						array( 'value' => 'center', 'text' => 'Center' ),
						array( 'value' => 'right', 'text' => 'Right' ),
					),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'border_line',
						'text' => __( 'Border Line', 'bearsthemes' ),
						),
					array(
						'value' => 'background_color',
						'text' => __( 'Background Color (Flow presets)', 'bearsthemes' ),
						),
					array(
						'value' => 'border_line_shadow_effect',
						'text' => __( 'Border Line - Shadow effect', 'bearsthemes' ),
						),
					array(
						'value' => 'background_color_shadow_effect',
						'text' => __( 'Background Color - Shadow effect', 'bearsthemes' ),
						),
					)
				)
			);
	}
endif;

/**
 * tbbs_BearsBlogCousesParams
 *
 */
if( ! function_exists( 'tbbs_BearsBlogCousesParams' ) ) :
	function tbbs_BearsBlogCousesParams()
	{
		return array(
			array(
				'name' => 'show_pagination',
				'title' => __( 'Show Pagination', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'show',
				'options' => array(
						array( 'value' => 'show', 'text' => 'Show' ),
						array( 'value' => 'hide', 'text' => 'Hide' ),
					),
				),
			array(
				'name' => 'columns',
				'title' => __( 'Columns', 'bearsthemes' ),
				'type' => 'select',
				'value' => 3,
				'options' => array(
						array( 'value' => 1, 'text' => 'One' ),
						array( 'value' => 2, 'text' => 'Two' ),
						array( 'value' => 3, 'text' => 'Three' ),
						array( 'value' => 4, 'text' => 'Four' ),
					),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', 'bearsthemes' ),
						),
					)
				)
			);
	}
endif;

if( ! function_exists( 'tbbs_BearsBlogPostParams' ) ) :
	function tbbs_BearsBlogPostParams()
	{ 
		return array(
			array(
				'name' => 'show_pagination',
				'title' => __( 'Show Pagination', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'show',
				'options' => array(
						array( 'value' => 'show', 'text' => 'Show' ),
						array( 'value' => 'hide', 'text' => 'Hide' ),
					),
				),
			array(
				'name' => 'columns',
				'title' => __( 'Columns', 'bearsthemes' ),
				'type' => 'select',
				'value' => 3,
				'options' => array(
						array( 'value' => 2, 'text' => 'Two' ),
						array( 'value' => 3, 'text' => 'Three' ),
						array( 'value' => 4, 'text' => 'Four' ),
					),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'special_first_item',
				'options' => array(
					array(
						'value' => 'special_first_item',
						'text' => __( 'Special first item', 'bearsthemes' ),
						),
					)
				)
			);
	}
endif;

if( ! function_exists( 'bearsthemes_BearsBlogSpecialParams' ) ) :
	function bearsthemes_BearsBlogSpecialParams()
	{
		return array(
			array(
				'name' => 'columns',
				'title' => __( 'Columns', 'bearsthemes' ),
				'type' => 'select',
				'value' => 3,
				'options' => array(
						array( 'value' => 2, 'text' => '2 Colmns' ),
						array( 'value' => 3, 'text' => '3 Colmns' ),
						array( 'value' => 4, 'text' => '4 Colmns' ),
					),
				),
			array(
				'name' => 'trim_word',
				'title' => __( 'Trim Word', 'bearsthemes' ),
				'type' => 'text',
				'value' => 20,
				),
			array(
				'name' => 'readmore_text',
				'title' => __( 'Readmore Text', 'bearsthemes' ),
				'type' => 'text',
				'value' => __( 'Readmore...', 'bearsthemes' ),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'zigzag_inline',
				'options' => array(
					array(
						'value' => 'zigzag_inline',
						'text' => __( 'ZigZag inline', 'bearsthemes' ),
						),
					)
				)
			);
	}
endif;

/**
 * tbbs_BearsBlogEventsParams
 *
 */
if( ! function_exists( 'tbbs_BearsBlogEventsParams' ) ) :
	function tbbs_BearsBlogEventsParams()
	{
		return array(
			array(
				'name' => 'show_pagination',
				'title' => __( 'Show Pagination', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'show',
				'options' => array(
						array( 'value' => 'show', 'text' => 'Show' ),
						array( 'value' => 'hide', 'text' => 'Hide' ),
					),
				),
			array(
				'name' => 'columns',
				'title' => __( 'Columns', 'bearsthemes' ),
				'type' => 'select',
				'value' => 3,
				'options' => array(
						array( 'value' => 1, 'text' => 'One' ),
						array( 'value' => 2, 'text' => 'Two' ),
						array( 'value' => 3, 'text' => 'Three' ),
						array( 'value' => 4, 'text' => 'Four' ),
					),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', 'bearsthemes' ),
						),
					array(
						'value' => 'grid_basic',
						'text' => __( 'Grid Basic', 'bearsthemes' ),
						),
					array(
						'value' => 'listing',
						'text' => __( 'Listing', 'bearsthemes' ),
						),
					)
				)
			);
	}
endif;

if( ! function_exists( 'bearsthemes_BearsBlogEvents2Params' ) ) :
	function bearsthemes_BearsBlogEvents2Params()
	{
		return array(
			array(
				'name' => 'height',
				'title' => __( 'Height', 'bearsthemes' ),
				'type' => 'text',
				'value' => '260px',
				),
			array(
				'name' => 'show_pagination',
				'title' => __( 'Show Pagination', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'hide',
				'options' => array(
						array( 'value' => 'show', 'text' => 'Show' ),
						array( 'value' => 'hide', 'text' => 'Hide' ),
					),
				),
			array(
				'name' => 'columns',
				'title' => __( 'Columns', 'bearsthemes' ),
				'type' => 'select',
				'value' => 3,
				'options' => array(
						array( 'value' => 1, 'text' => '1 Column' ),
						array( 'value' => 2, 'text' => '2 Columns' ),
						array( 'value' => 3, 'text' => '3 Columns' ),
						array( 'value' => 4, 'text' => '4 Columns' ),
					),
				),
			array(
				'name' => 'trim_word',
				'title' => __( 'Trim Word', 'bearsthemes' ),
				'type' => 'text',
				'value' => 20,
				),
			array(
				'name' => 'readmore_text',
				'title' => __( 'Readmore Text', 'bearsthemes' ),
				'type' => 'text',
				'value' => __( 'Readmore...', 'bearsthemes' ),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'timelife',
						'text' => __( 'Time Life', 'bearsthemes' ),
						),
					array(
						'value' => 'grid_classic',
						'text' => __( 'Grid Classis', 'bearsthemes' ),
						),
					array(
						'value' => 'listing',
						'text' => __( 'Listing', 'bearsthemes' ),
						),
					)
				)
		);
	}
endif;

if( ! function_exists( 'bearsthemes_BearsBlogEvents3Params' ) ) :
	function bearsthemes_BearsBlogEvents3Params()
	{
		return array(
			array(
				'name' => 'show_pagination',
				'title' => __( 'Show Pagination', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'hide',
				'options' => array(
						array( 'value' => 'show', 'text' => 'Show' ),
						array( 'value' => 'hide', 'text' => 'Hide' ),
					),
				),
			array(
				'name' => 'columns',
				'title' => __( 'Columns', 'bearsthemes' ),
				'type' => 'select',
				'value' => 3,
				'options' => array(
						array( 'value' => 1, 'text' => '1 Column' ),
						array( 'value' => 2, 'text' => '2 Columns' ),
						array( 'value' => 3, 'text' => '3 Columns' ),
						array( 'value' => 4, 'text' => '4 Columns' ),
					),
				),
			array(
				'name' => 'trim_word',
				'title' => __( 'Trim Word', 'bearsthemes' ),
				'type' => 'text',
				'value' => 20,
				),
			array(
				'name' => 'readmore_text',
				'title' => __( 'Read more Text', 'bearsthemes' ),
				'type' => 'text',
				'value' => __( 'Read more...', 'bearsthemes' ),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'carousel',
				'options' => array(
					array(
						'value' => 'carousel',
						'text' => __( 'Carousel', 'bearsthemes' ),
						),
					array(
						'value' => 'grid',
						'text' => __( 'Grid', 'bearsthemes' ),
						),
					)
				)
		);
	}
endif;

/**
 * tbbs_BearsBlockCustomParams
 *
 */
if( ! function_exists( 'tbbs_BearsBlockCustomParams' ) ) :
	function tbbs_BearsBlockCustomParams()
	{
		return array(
			array(
				'name' => 'image',
				'title' => __( 'Image', 'bearsthemes' ),
				'type' => 'media',
				'multiple' => false,
				'data' => 'id',
				),
			array(
				'name' => 'icon',
				'title' => __( 'Icon Class', 'bearsthemes' ),
				'type' => 'text',
				'value' => ''
				),
			array(
				'name' => 'title',
				'title' => __( 'Title', 'bearsthemes' ),
				'type' => 'text',
				'value' => ''
				),
			array(
				'name' => 'sub_title',
				'title' => __( 'Sub Title', 'bearsthemes' ),
				'type' => 'text',
				'value' => ''
				),
			array(
				'name' => 'content',
				'title' => __( 'Content', 'bearsthemes' ),
				'type' => 'textarea',
				'value' => ''
				),
			array(
				'name' => 'link',
				'title' => __( 'Link', 'bearsthemes' ),
				'type' => 'link',
				'value' => array( 'text' => '', 'url' => '' ),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Image', 'bearsthemes' ),
						),
					array(
						'value' => 'icon',
						'text' => __( 'Icon', 'bearsthemes' ),
						),
					array(
						'value' => 'icon2',
						'text' => __( 'Icon 2', 'bearsthemes' ),
						),
					array(
						'value' => 'background_image',
						'text' => __( 'Background Image', 'bearsthemes' ),
						),
					)
				)
			);
	}
endif;

/**
 * get_tbdonations_payment
 * 
 * @param [string] $sort
 * @param [int] $limit
 */
if( ! function_exists( 'get_tbdonations_payment' ) ) :
	function bearsthemes_get_list_tbdonations_payment( $sort = 'DESC', $limit )
	{
		global $wpdb;
		$table_prefix = $wpdb->prefix;

		$result = $wpdb->get_results( 
			"SELECT p.* 
			FROM {$table_prefix}tbdonations_payment as p
			INNER JOIN {$table_prefix}users as u ON p.user_id = u.ID
			WHERE p.paid = 1 
			ORDER BY p.id {$sort} LIMIT {$limit}" );

		return $result;
	}
endif;

/**
 * bearsthemes_BearsBlogCharitableParams
 *
 */
if( ! function_exists( 'bearsthemes_BearsBlogCharitableParams' ) ) :
	function bearsthemes_BearsBlogCharitableParams()
	{
		return array(
			array(
				'name' => 'show_pagination',
				'title' => __( 'Show Pagination', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'hide',
				'options' => array(
						array( 'value' => 'show', 'text' => 'Show' ),
						array( 'value' => 'hide', 'text' => 'Hide' ),
					),
				),
			array(
				'name' => 'columns',
				'title' => __( 'Columns', 'bearsthemes' ),
				'type' => 'select',
				'value' => 3,
				'options' => array(
						array( 'value' => 1, 'text' => '1 Column' ),
						array( 'value' => 2, 'text' => '2 Columns' ),
						array( 'value' => 3, 'text' => '3 Columns' ),
						array( 'value' => 4, 'text' => '4 Columns' ),
					),
				),
			array(
				'name' => 'orderby',
				'title' => __( 'Order By', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'post_date',
				'options' => array(
					array(
						'value' => 'post_date',
						'text' => __( 'Post Date', 'bearsthemes' ),
						),
					array(
						'value' => 'popular',
						'text' => __( 'Popular', 'bearsthemes' ),
						),
					array(
						'value' => 'ending',
						'text' => __( 'Ending', 'bearsthemes' ),
						),
					)
				),
			array(
				'name' => 'trim_word',
				'title' => __( 'Trim Word', 'bearsthemes' ),
				'type' => 'text',
				'value' => 20,
				),
			array(
				'name' => 'readmore_text',
				'title' => __( 'Readmore Text', 'bearsthemes' ),
				'type' => 'text',
				'value' => __( 'Readmore', 'bearsthemes' ),
				),
			array(
				'name' => 'donate_text',
				'title' => __( 'Donate Text', 'bearsthemes' ),
				'type' => 'text',
				'value' => __( 'Donate Now', 'bearsthemes' ),
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', 'bearsthemes' ),
						),
					)
				),
		);
	}
endif;

if( ! function_exists( 'bearsthemes_BearsBlogCharitableCampaign2Params' ) ) :
	function bearsthemes_BearsBlogCharitableCampaign2Params()
	{
		return array(
			array(
				'name' => 'show_pagination',
				'title' => __( 'Show Pagination', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'hide',
				'options' => array(
						array( 'value' => 'show', 'text' => 'Show' ),
						array( 'value' => 'hide', 'text' => 'Hide' ),
					),
				),
			array(
				'name' => 'columns',
				'title' => __( 'Columns', 'bearsthemes' ),
				'type' => 'select',
				'value' => 3,
				'options' => array(
						array( 'value' => 1, 'text' => '1 Column' ),
						array( 'value' => 2, 'text' => '2 Columns' ),
						array( 'value' => 3, 'text' => '3 Columns' ),
						array( 'value' => 4, 'text' => '4 Columns' ),
					),
				),
			array(
				'name' => 'orderby',
				'title' => __( 'Order By', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'post_date',
				'options' => array(
					array(
						'value' => 'post_date',
						'text' => __( 'Post Date', 'bearsthemes' ),
						),
					array(
						'value' => 'popular',
						'text' => __( 'Popular', 'bearsthemes' ),
						),
					array(
						'value' => 'ending',
						'text' => __( 'Ending', 'bearsthemes' ),
						),
					)
				),
			array(
				'name' => 'trim_word',
				'title' => __( 'Trim Word', 'bearsthemes' ),
				'type' => 'text',
				'value' => 20,
				),
			array(
				'name' => 'readmore_text',
				'title' => __( 'Readmore Text', 'bearsthemes' ),
				'type' => 'text',
				'value' => __( 'Read more', 'bearsthemes' ),
				),
			array(
				'name' => 'donate_text',
				'title' => __( 'Donate Text', 'bearsthemes' ),
				'type' => 'text',
				'value' => __( 'Donate Now', 'bearsthemes' ),
				),
			array(
				'name' => 'image_size',
				'title' => __( 'Image Size', 'bearsthemes' ),
				'type' => 'imagesize',
				'value' => 'medium_large',
				),
			array(
				'name' => 'color',
				'title' => __( 'Color', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'dark',
				'options' => array(
					array(
						'value' => 'dark',
						'text' => __( 'Dark', 'bearsthemes' ),
						),
					array(
						'value' => 'white',
						'text' => __( 'White', 'bearsthemes' ),
						),
					)
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'carousel',
						'text' => __( 'Carousel', 'bearsthemes' ),
						),
					array(
						'value' => 'grid',
						'text' => __( 'Grid Classic', 'bearsthemes' ),
						),
					array(
						'value' => 'masonry',
						'text' => __( 'Grid Masonry', 'bearsthemes' ),
						),
					)
				),
			);
	}
endif;

if( ! function_exists( 'bearsthemes_BearsCarouselTeamParams' ) ) :
	function bearsthemes_BearsCarouselTeamParams()
	{
		return array(
			array(
				'name' => 'height',
				'title' => __( 'Height', 'bearsthemes' ),
				'type' => 'text',
				'value' => '400px',
				'description' => 'Ex: 400px'
				),
			array(
				'name' => 'image_size',
				'title' => __( 'Image Size', 'bearsthemes' ),
				'type' => 'imagesize',
				'value' => 'medium_large',
				),
			array(
				'name' => 'align',
				'title' => __( 'Align', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'left',
				'options' => array(
					array(
						'value' => 'left',
						'text' => __( 'Left', 'bearsthemes' ),
						),
					array(
						'value' => 'center',
						'text' => __( 'Center', 'bearsthemes' ),
						),
					array(
						'value' => 'right',
						'text' => __( 'Right', 'bearsthemes' ),
						),
					)
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'default',
						'text' => __( 'Default', 'bearsthemes' ),
						),
					)
				),
			);
	}
endif;

if( ! function_exists( 'bearsthemes_BearsBlog2PostParams' ) ) : 
	function bearsthemes_BearsBlog2PostParams()
	{
		return array(
			array(
				'name' => 'show_pagination',
				'title' => __( 'Show Pagination', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'hide',
				'options' => array(
						array( 'value' => 'show', 'text' => 'Show' ),
						array( 'value' => 'hide', 'text' => 'Hide' ),
					),
				),
			array(
				'name' => 'columns',
				'title' => __( 'Columns', 'bearsthemes' ),
				'type' => 'select',
				'value' => 3,
				'options' => array(
						array( 'value' => 1, 'text' => '1 Column' ),
						array( 'value' => 2, 'text' => '2 Columns' ),
						array( 'value' => 3, 'text' => '3 Columns' ),
						array( 'value' => 4, 'text' => '4 Columns' ),
					),
				),
			array(
				'name' => 'trim_word',
				'title' => __( 'Trim Word', 'bearsthemes' ),
				'type' => 'text',
				'value' => 18,
				),
			array(
				'name' => 'readmore_text',
				'title' => __( 'Readmore Text', 'bearsthemes' ),
				'type' => 'text',
				'value' => __( 'Readmore', 'bearsthemes' ),
				),
			array(
				'name' => 'image_size',
				'title' => __( 'Image Size', 'bearsthemes' ),
				'type' => 'imagesize',
				'value' => 'medium_large',
				),
			array(
				'name' => 'layout_item',
				'title' => __( 'Layout Item', 'bearsthemes' ),
				'type' => 'select',
				'value' => 'default',
				'options' => array(
					array(
						'value' => 'grid_classic',
						'text' => __( 'Grid Classic', 'bearsthemes' ),
						),
					)
				),
			);
	}
endif;

/**
 * bearsthemes_em_wp_query
 *
 * @param [array] $args_default
 * @return $query
 */
if( ! function_exists( 'bearsthemes_em_wp_query' ) ) :
	function bearsthemes_em_wp_query( $args_default ) 
	{
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;


		$args_default['paged'] = $paged;
		$args_default['post_type'] = 'event';
		$args_default['meta_query'] = array( 'key' => '_start_ts', 'value' => current_time('timestamp'), 'compare' => '>=', 'type'=>'numeric' );

		// The Query
		$query = new WP_Query( $args_default );
		return $query; 
	}
endif;

if( ! function_exists( 'bearstheme_eventManagerBook_form' ) ) :
	function bearstheme_eventManagerBook_form()
	{
		extract( $_POST );
		$EM_Event = new EM_Event( $event_id );
		$output = $EM_Event->output( '#_BOOKINGFORM' );

		echo json_encode( array( 'success' => true, 'data' => $output ) );exit();
	}
endif;
add_action( 'wp_ajax_bearstheme_eventManagerBook_form', 'bearstheme_eventManagerBook_form' );
add_action( 'wp_ajax_nopriv_bearstheme_eventManagerBook_form', 'bearstheme_eventManagerBook_form' );

/**
 * bearsthemes_infoteam_default
 *
 */
if( ! function_exists( 'tbbs_quickviewLayout_infoteam_default' ) ) : 
	function tbbs_quickviewLayout_infoteam_default( $post_id )
	{
		wp( 'p=' . $post_id . '&post_type=team' );
		ob_start();
		while ( have_posts() ) : the_post(); 
			global $post;

			# thumbnail
			$thumbnail = '';
			if( has_post_thumbnail() ):
	            $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	        	$thumbnail = $thumbnail_data[0];
	        endif;

	        # meta field
	        $team_position = get_post_meta( $post->ID, 'tb_team_position', true );
	        $team_contact = array(
				'phone' 	=> get_post_meta( $post->ID, 'tb_team_phone', true ),
				'twitter'	=> get_post_meta( $post->ID, 'tb_team_twitter', true ),
				'google' 	=> get_post_meta( $post->ID, 'tb_team_google', true ),
				'facebook' 	=> get_post_meta( $post->ID, 'tb_team_facebook', true ),
				'email' 	=> get_post_meta( $post->ID, 'tb_team_email', true ) );
	        ?>
	        <div class="bears-quickview-team">
				<div class="image-meta" style="background: url(<?php echo esc_attr( $thumbnail ) ?>) no-repeat center center / cover, #fafafa;">
					
				</div>
				<div class="info-meta">
					<h3 class='title'><?php the_title(); ?></h3>
					<div class='position'><?php echo "{$team_position}"; ?></div>
					<div class='extra-meta'>
						<a class='extra-item e-tw' href="<?php echo esc_attr( $team_contact['twitter'] ); ?>" target="_blank"><i class="fa fa-twitter-square"></i></a>
						<a class='extra-item e-g' href="<?php echo esc_attr( $team_contact['google'] ); ?>" target="_blank"><i class="fa fa-google-plus-square"></i></a>
						<a class='extra-item e-fb' href="<?php echo esc_attr( $team_contact['facebook'] ); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a>
						<a class='extra-item e-email' href="mailto:<?php echo esc_attr( $team_contact['email'] ); ?>"><i class="fa fa-envelope"></i></a>
						<a class='extra-item e-phone' href="#"><i class="fa fa-phone-square"></i> <?php echo "{$team_contact['phone']}"; ?></a>
					</div>
					<p class='des'><?php the_content(); ?></p>
				</div>
			</div>
	        <?php
		endwhile;
		$output = ob_get_clean();

		echo $output;
	}
endif;

/**
 * bearsthemes_blogCharitableCampaign2_default
 *
 */
if( ! function_exists( 'bearsthemes_blogCharitableCampaign2_default' ) ) :
	function bearsthemes_blogCharitableCampaign2_default( $atts, $__layout )
	{
		extract( $atts );

		# build loop
		$loop = Charitable_Campaigns_Shortcode::get_campaigns( $campaign_args );

		$owl_responsive = array(
			1 => array( 0 => array( 'items' => 1 ), 600 => array( 'items' => 1 ), 1000 => array( 'items' => 1 ) ),
			2 => array( 0 => array( 'items' => 1 ), 600 => array( 'items' => 2 ), 1000 => array( 'items' => 2 ) ),
			3 => array( 0 => array( 'items' => 1 ), 600 => array( 'items' => 2 ), 1000 => array( 'items' => 3 ) ),
			4 => array( 0 => array( 'items' => 1 ), 600 => array( 'items' => 2 ), 1000 => array( 'items' => 4 ) ),
			);

		$owl_opts = json_encode( array(
			'items' 				=> (int) $atts['template_params']['columns'],
			'margin' 				=> 20,
			'loop' 					=> true,
		    'nav' 					=> true,
		    'autoplay' 				=> true,
		    'autoplayHoverPause' 	=> true, 
		    'responsive' 			=> $owl_responsive[ (int) $atts['template_params']['columns'] ],
			) );

		$wrap_attr = array(
			'carousel' => array( 'class="layout-carousel owl-carousel"', 'data-bs-courousel-owl=\''. $owl_opts .'\'' ),
			'grid' => array( 'class="layout-grid row"' ),
			'masonry' => array( 'class="layout-masonry row-masonry bears-gridmasonry-col-'. $template_params['columns'] .'"', 'data-bears-masonry-elem=\'\'' ) );

		ob_start();
		echo sprintf( '<div %s>', implode( ' ', $wrap_attr[$__layout] ) );
		echo ( $__layout == 'masonry' ) ? '<div class="grid-sizer"></div><div class="gutter-sizer"></div>' : '';
		while( $loop->have_posts() ) : 
			$loop->the_post();
			global $post;

			/* thumbnail */
			$thumbnail = '';
			if( has_post_thumbnail() ):
                $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $atts['template_params']['image_size'] );
            	$thumbnail = $thumbnail_data[0];
            endif;

            /* title */
            $title = get_the_title();

            /* content */
            $content = wp_trim_words( get_post_meta( get_the_ID(), '_campaign_description', true ), (int) $atts['template_params']['trim_word'], '...' );

            $campaign = new Charitable_Campaign( $post );

            $data = array(
            	'id' 			=> get_the_ID(),
            	'thumbnail' 	=> $thumbnail,
            	'title' 		=> $title,
            	'content' 		=> $content,
            	'link' 			=> get_the_permalink(),
            	'author'   		=> get_the_author(),
            	'cat_list'		=> get_the_term_list( get_the_ID(), 'campaign_category', '', ', ' ),
            	'count_comments'		=> wp_count_comments( get_the_ID() ),
            	'percent_donated_raw' 	=> $campaign->get_percent_donated_raw(), 
				'time_left' 			=> $campaign->get_time_left(), 
				'donation_summary' 		=> $campaign->get_donation_summary(), 
            	);

           	echo call_user_func_array( 'bearsthemes_blogCharitableCampaign2_layout_' . $__layout, array( $atts, $data ) );
		endwhile;
		echo "</div>";

		if( 'show' == $atts['template_params']['show_pagination'] ) :
		echo "<div class='bt-pagination-style'>";
			$big = 999999999;
			$args = array(
				'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'             => '?paged=%#%',
				'total'              => $loop->max_num_pages,
				'current'            => max( 1, get_query_var('paged') ),
				'prev_next'          => true,
				'prev_text'          => __('<i class="ion-arrow-left-c"></i>'),
				'next_text'          => __('<i class="ion-arrow-right-c"></i>'),
				);
			echo paginate_links( $args );			
		echo "</div>";
		endif;

		wp_reset_postdata();
		echo ob_get_clean();
	}
endif;

if( ! function_exists( 'bearsthemes_blogCharitableCampaign2_layout_carousel' ) ) :
	function bearsthemes_blogCharitableCampaign2_layout_carousel( $atts, $data )
	{
		extract( $data );
		$template_params = $atts['template_params']; 
		$col = $template_params['columns'];

		$output = "
			<div class='item'>
				<div class='item-inner'>
					<div class='info-meta'>
						<a href='{$link}' data-smooth-link><h4 class='title' style='color: {$atts['color'][0]}'>{$title}</h4></a>
						<p class='des' style='color: {$atts['color'][1]}'>{$content}</p>
					</div>
					<div class='thumb' style='background: url({$thumbnail}) no-repeat center center / cover, #333'>
						<a 
						href='#' 
						class='donate-button charitable-donate-ajax-loadform' 
						data-campaign-id='{$id}' 
						data-campaign-title='{$title}' 
						data-campaign-img='{$thumbnail}'>{$template_params['donate_text']}</a>
					</div>
					<div class='charitable-meta'>
						<div class='meta-left'>
							{$time_left}
						</div>
						<div class='meta-right'>
							<div class='campaign-progress-bar'><span class='bar' style='width: {$percent_donated_raw}%;'></span></div>
							<div class='donation-summary' style='color: {$atts['color'][1]}'>{$donation_summary}</div>
						</div>
					</div>
				</div>
			</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_blogCharitableCampaign2_layout_grid' ) ) :
	function bearsthemes_blogCharitableCampaign2_layout_grid( $atts, $data )
	{
		extract( $data );
		$template_params = $atts['template_params']; 
		$col = 12 / (int) $template_params['columns'];

		$output = "
			<div class='item col-md-{$col}'>
				<div class='item-inner'>
					<div class='charitable-meta'>
						<div class='meta-left'>
							{$time_left}
						</div>
						<div class='meta-right'>
							<div class='campaign-progress-bar'><span class='bar' style='width: {$percent_donated_raw}%;'></span></div>
							<div class='donation-summary' style='color: {$atts['color'][1]}'>{$donation_summary}</div>
						</div>
					</div>

					<div class='thumb' style='background: url({$thumbnail}) no-repeat center center / cover, #333'>
						<a 
						href='#' 
						class='donate-button charitable-donate-ajax-loadform' 
						data-campaign-id='{$id}' 
						data-campaign-title='{$title}' 
						data-campaign-img='{$thumbnail}'>{$template_params['donate_text']}</a>
					</div>

					<div class='info-meta'>
						<a href='{$link}' data-smooth-link><h4 class='title' style='color: {$atts['color'][0]}'>{$title}</h4></a>
						<div class='cate'><i class='ion-bookmark'></i> {$cat_list}</div>
						<p class='des' style='color: {$atts['color'][1]}'>{$content}</p>
						<a href='{$link}' class='readmore_link' data-smooth-link><span style='color: {$atts['color'][1]}'>{$template_params['readmore_text']}</span></a>
					</div>
				</div>
			</div>";

		return $output;
	}
endif;

if( ! function_exists( 'bearsthemes_blogCharitableCampaign2_layout_masonry' ) ) :
	function bearsthemes_blogCharitableCampaign2_layout_masonry( $atts, $data )
	{
		extract( $data );
		$template_params = $atts['template_params']; 
		$col = 12 / (int) $template_params['columns'];

		$output = "<div class='item'>
				<div class='item-inner'>
					<div class='thumb' style='background: url({$thumbnail}) no-repeat center center / cover, #333'>
						<div class='charitable-meta'>
							<div class='campaign-progress-circle' data-svgcircle='{$percent_donated_raw}' data-size='120' data-thickness='4' data-text=''></div>
							<div class='timeleft'>{$time_left}</div>
							<div class='donation-summary'>{$donation_summary}</div>
						</div>
						
						<a 
						href='#' 
						class='donate-button charitable-donate-ajax-loadform' 
						data-campaign-id='{$id}' 
						data-campaign-title='{$title}' 
						data-campaign-img='{$thumbnail}'>{$template_params['donate_text']}</a>
					</div>

					<div class='charitable-meta'>
					</div>

					<div class='info-meta'>
						<a href='{$link}' data-smooth-link><h4 class='title' style='color: {$atts['color'][0]}'>{$title}</h4></a>
						<div class='cate'><i class='ion-bookmark'></i> {$cat_list}</div>
						<p class='des' style='color: {$atts['color'][1]}'>{$content}</p>
						<a href='{$link}' class='readmore_link' data-smooth-link><span style='color: {$atts['color'][1]}'>{$template_params['readmore_text']}</span></a>
					</div>
				</div>
			</div>";

		return $output;
	}
endif;