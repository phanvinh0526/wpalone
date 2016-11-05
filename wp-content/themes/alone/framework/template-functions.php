<?php
if ( ! isset( $content_width ) ) $content_width = 900;
if ( is_singular() ) wp_enqueue_script( "comment-reply" );

if ( ! function_exists( 'bearstheme_setup' ) ) {
	function bearstheme_setup() {
		global $bearstheme_options;
		
		load_theme_textdomain( 'bearsthemes', get_template_directory() . '/languages' );
		// Add Custom Header.
		add_theme_support('custom-header');
		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails, and declare sizes.
		add_theme_support( 'post-thumbnails' );
		
		//Enable support for Title Tag
		 add_theme_support( "title-tag" );
		
		// This theme uses wp_nav_menu() in locations.
		register_nav_menus( array(
			'main_navigation'   => __( 'Main Navigation','bearsthemes' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'video', 'audio', 'quote', 'link', 'gallery',
		) );

		// This theme allows users to set a custom background.
		add_theme_support( 'custom-background', apply_filters( 'bearstheme_custom_background_args', array(
			'default-color' => 'f5f5f5',
		) ) );

		// Add support for featured content.
		add_theme_support( 'featured-content', array(
			'featured_content_filter' => 'bearstheme_get_featured_posts',
			'max_posts' => 6,
		) );
		
		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );
		
		// Register a new image size
		add_image_size( 'bearstheme_custom_blog_archive_size', 770, 532, true );
		add_image_size( 'bearstheme_custom_blog_single_size', 870, 432, true );
	}
}
add_action( 'after_setup_theme', 'bearstheme_setup' );

/* Style Inline */
function bearstheme_add_style_inline() {
    global $bearstheme_options;
    $custom_style = null;
    if (isset($bearstheme_options['custom_css_code']) && $bearstheme_options['custom_css_code']) {
        $custom_style .= "{$bearstheme_options['custom_css_code']}";
    }
	
    wp_enqueue_style('wp_custom_style', URI_PATH . '/assets/css/wp_custom_style.css',array('style'));
    
	/* Body background */
    $tb_background_color =& $bearstheme_options['tb_background']['background-color'];
    $tb_background_image =& $bearstheme_options['tb_background']['background-image'];
    $tb_background_repeat =& $bearstheme_options['tb_background']['background-repeat'];
    $tb_background_position =& $bearstheme_options['tb_background']['background-position'];
    $tb_background_size =& $bearstheme_options['tb_background']['background-size'];
    $tb_background_attachment =& $bearstheme_options['tb_background']['background-attachment'];
	$custom_style .= "body{ background-color: $tb_background_color;}";
	if($tb_background_image){
		$custom_style .= "body{ background: url('$tb_background_image') $tb_background_repeat $tb_background_attachment $tb_background_position;background-size: $tb_background_size;}";
	}
	/* Title bar background */
    $tb_title_bar_bg_color =& $bearstheme_options['tb_title_bar_bg']['background-color'];
    $title_bar_bg_image =& $bearstheme_options['tb_title_bar_bg']['background-image'];
    $title_bar_bg_repeat =& $bearstheme_options['tb_title_bar_bg']['background-repeat'];
    $title_bar_bg_position =& $bearstheme_options['tb_title_bar_bg']['background-position'];
    $title_bar_bg_size =& $bearstheme_options['tb_title_bar_bg']['background-size'];
    $title_bar_bg_attachment =& $bearstheme_options['tb_title_bar_bg']['background-attachment'];
	$custom_style .= ".ro-blog-header { background-color: $tb_title_bar_bg_color;}";
	if($title_bar_bg_image){
		$custom_style .= ".ro-blog-header { background: url('$title_bar_bg_image') $title_bar_bg_repeat $title_bar_bg_attachment $title_bar_bg_position;background-size: $title_bar_bg_size;}";
	}
    wp_add_inline_style( 'wp_custom_style', $custom_style );
    /*End Font*/
}
add_action( 'wp_enqueue_scripts', 'bearstheme_add_style_inline' );

/* Header */
function bearstheme_Header() {
    global $bearstheme_options, $post;
    $header_layout = ( isset( $bearstheme_options["tb_header_layout"] ) && ! empty( $bearstheme_options["tb_header_layout"] ) ) ? $bearstheme_options["tb_header_layout"] : 'header-v1';
    
    if( $post ){
        $tb_header = get_post_meta( $post->ID, 'tb_header', true ) ? get_post_meta( $post->ID, 'tb_header', true ) : 'global';
        $header_layout = ( $tb_header == 'global' ) ? $header_layout : $tb_header;
    }

    require sprintf( __DIR__ . '/headers/%s.php', $header_layout );
}

if( ! function_exists( 'bearsthemes_Footer' ) ) :
	function bearsthemes_Footer()
	{
		global $bearstheme_options, $post;
	    $footer_layout = ( isset( $bearstheme_options["tb_footer_layout"] ) && ! empty( $bearstheme_options["tb_footer_layout"] ) ) ? $bearstheme_options["tb_footer_layout"] : 'footer-v1';
	    
	    # if( $post ){
	    #    $tb_footer = get_post_meta( $post->ID, 'tb_header', true ) ? get_post_meta( $post->ID, 'tb_footer', true ) : 'global';
	    #    $footer_layout = ( $tb_footer == 'global' ) ? $footer_layout : $tb_footer;
	    # }

	    require sprintf( __DIR__ . '/footers/%s.php', $footer_layout );
	}
endif;

/* Logo */
if (!function_exists('bearstheme_logo')) {
	function bearstheme_logo($lg) {
		global $bearstheme_options;
		if($lg == 'v1') $logo = isset($bearstheme_options['tb_logo_image_hv1']['url']) && $bearstheme_options['tb_logo_image_hv1']['url'] ? $bearstheme_options['tb_logo_image_hv1']['url'] : URI_PATH.'/assets/images/logo-dark.png';
		if($lg == 'v2') $logo = isset($bearstheme_options['tb_logo_image_hv2']['url']) && $bearstheme_options['tb_logo_image_hv2']['url'] ? $bearstheme_options['tb_logo_image_hv2']['url'] : URI_PATH.'/assets/images/logo-white.png';
		
		# style
		$style = array();

		# logo height
		if( isset( $bearstheme_options['tb_logo_height'] ) && ! empty( $bearstheme_options['tb_logo_height'] ) )
			array_push( $style , "height: {$bearstheme_options['tb_logo_height']}" );



		echo '<img style="'. implode( ';', $style ) .'" src="'.esc_url($logo).'" alt="Logo"/>';
	}
}

/* Page title */
if (!function_exists('bearstheme_page_title')) {
    function bearstheme_page_title() { 
            ob_start();
			if( is_home() ){
				_e('Home', 'bearsthemes');
			}elseif(is_search()){
                _e('Search Keyword: ', 'bearsthemes'). '<span class="keywork">'. get_search_query( false ). '</span>';
            }elseif(is_post_type_archive( 'tribe_events' )){
                _e('Events', 'bearsthemes');
            }elseif (!is_archive()) {
				if(is_singular( 'tribe_events' )) {
					_e('Event Detail', 'bearsthemes');
				} else {
					the_title();
				}
            } else {
                if (is_category()){
                    single_cat_title();
                }elseif(get_post_type() == 'tribe_events' || get_post_type() == 'tbdonations' || get_post_type() == 'team' || get_post_type() == 'testimonial' || get_post_type() == 'product'){
                    single_term_title();
                }elseif (is_tag()){
                    single_tag_title();
                }elseif (is_author()){
                    printf(__('Author: %s', 'bearsthemes'), '<span class="vcard">' . get_the_author() . '</span>');
                }elseif (is_day()){
                    printf(__('Day: %s', 'bearsthemes'), '<span>' . get_the_date() . '</span>');
                }elseif (is_month()){
                    printf(__('Month: %s', 'bearsthemes'), '<span>' . get_the_date() . '</span>');
                }elseif (is_year()){
                    printf(__('Year: %s', 'bearsthemes'), '<span>' . get_the_date() . '</span>');
                }elseif (is_tax('post_format', 'post-format-aside')){
                    _e('Asides', 'bearsthemes');
                }elseif (is_tax('post_format', 'post-format-gallery')){
                    _e('Galleries', 'bearsthemes');
                }elseif (is_tax('post_format', 'post-format-image')){
                    _e('Images', 'bearsthemes');
                }elseif (is_tax('post_format', 'post-format-video')){
                    _e('Videos', 'bearsthemes');
                }elseif (is_tax('post_format', 'post-format-quote')){
                    _e('Quotes', 'bearsthemes');
                }elseif (is_tax('post_format', 'post-format-link')){
                    _e('Links', 'bearsthemes');
                }elseif (is_tax('post_format', 'post-format-status')){
                    _e('Statuses', 'bearsthemes');
                }elseif (is_tax('post_format', 'post-format-audio')){
                    _e('Audios', 'bearsthemes');
                }elseif (is_tax('post_format', 'post-format-chat')){
                    _e('Chats', 'bearsthemes');
                }else{
                    _e('Archives', 'bearsthemes');
                }
            }
                
            return ob_get_clean();
    }
}

/* Page breadcrumb */
if (!function_exists('bearstheme_page_breadcrumb')) {
    function bearstheme_page_breadcrumb($delimiter) {
		ob_start();

		$home = __('Home', 'bearsthemes');

		global $post;
		$homeLink = home_url();
		if( is_home() ){
			_e('Home', 'bearsthemes');
		}else{
			echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
		}

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
			echo '<span class="current">' . __('Archive by category: ', 'bearsthemes') . single_cat_title('', false) . '</span>';

		} elseif ( is_search() ) {
			echo '<span class="current">' . __('Search results for: ', 'bearsthemes') . get_search_query() . '</span>';

		} elseif ( is_post_type_archive( 'tribe_events' ) ) {
			echo '<span class="current">' . __('Events', 'bearsthemes') . '</span>';

		} elseif ( is_day() ) {
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F').' '. get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<span class="current">' . get_the_time('d') . '</span>';

		} elseif ( is_month() ) {
			echo '<span class="current">' . get_the_time('F'). ' '. get_the_time('Y') . '</span>';

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				if(get_post_type() == 'portfolio'){
					$terms = get_the_terms(get_the_ID(), 'portfolio_category', '' , '' );
					if($terms) {
						the_terms(get_the_ID(), 'portfolio_category', '' , ', ' );
						echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
					}else{
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				}elseif(get_post_type() == 'tbdonations'){
					$terms = get_the_terms(get_the_ID(), 'recipe_category', '' , '' );
					if($terms) {
						the_terms(get_the_ID(), 'recipe_category', '' , ', ' );
						echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
					}else{
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				}elseif(get_post_type() == 'team'){
					$terms = get_the_terms(get_the_ID(), 'team_category', '' , '' );
					if($terms) {
						the_terms(get_the_ID(), 'team_category', '' , ', ' );
						echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
					}else{
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				}elseif(get_post_type() == 'testimonial'){
					$terms = get_the_terms(get_the_ID(), 'testimonial_category', '' , '' );
					if($terms) {
						the_terms(get_the_ID(), 'testimonial_category', '' , ', ' );
						echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
					}else{
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				}elseif(get_post_type() == 'product'){
					$terms = get_the_terms(get_the_ID(), 'product_cat', '' , '' );
					if($terms) {
						the_terms(get_the_ID(), 'product_cat', '' , ', ' );
						echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
					}else{
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				}else{
					if(is_singular( 'tribe_events' )) {
						_e('Event Detail', 'bearsthemes');
						
					} else {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;
						echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
						echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
					}
				}

			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo ''.$cats;
				echo '<span class="current">' . get_the_title() . '</span>';
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			if($post_type) echo '<span class="current">' . $post_type->labels->singular_name . '</span>';
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
		} elseif ( is_page() && !$post->post_parent ) {
			echo '<span class="current">' . get_the_title() . '</span>';

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo ''.$breadcrumbs[$i];
				if ($i != count($breadcrumbs) - 1)
					echo ' ' . $delimiter . ' ';
			}
			echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';

		} elseif ( is_tag() ) {
			echo '<span class="current">' . __('Posts tagged: ', 'bearsthemes') . single_tag_title('', false) . '</span>';
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo '<span class="current">' . __('Articles posted by ', 'bearsthemes') . $userdata->display_name . '</span>';
		} elseif ( is_404() ) {
			echo '<span class="current">' . __('Error 404', 'bearsthemes') . '</span>';
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo ' '.$delimiter.' '.__('Page', 'bearsthemes') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
			
		return ob_get_clean();
    }
}

/* Custom excerpt */
function bearstheme_custom_excerpt($limit, $more) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . $more;
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}
/* Display navigation to next/previous set of posts */
if ( ! function_exists( 'bearstheme_paging_nav' ) ) {
	function bearstheme_paging_nav() {
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
				'base'     => $pagenum_link,
				'format'   => $format,
				'total'    => $GLOBALS['wp_query']->max_num_pages,
				'current'  => $paged,
				'mid_size' => 1,
				'add_args' => array_map( 'urlencode', $query_args ),
				'prev_text' => __( '<i class="fa fa-angle-double-left"></i>', 'bearsthemes' ),
				'next_text' => __( '<i class="fa fa-angle-double-right"></i>', 'bearsthemes' ),
		) );

		if ( $links ) {
		?>
		<nav class="bt-pagination" role="navigation">
			<?php echo ''.$links; ?>
		</nav>
		<?php
		}
	}
}
/* Display navigation to next/previous post */
if ( ! function_exists( 'bearstheme_post_nav' ) ) {
	function bearstheme_post_nav() {
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="bt-blog-article-nav clearfix">
			<?php
				previous_post_link( '%link', __( 'NEWEST POSTS', 'bearsthemes' ) );
				next_post_link( '%link',     __( 'OLDER POSTS', 'bearsthemes' ) );
			?>
		</nav>
		<?php
	}
}
/* Title Bar */
if ( ! function_exists( 'bearstheme_title_bar' ) ) {
	function bearstheme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb) {
		global $bearstheme_options;
		$subtext = isset($bearstheme_options['title_bar_subtext']) ? $bearstheme_options['title_bar_subtext'] : '';
		$delimiter = isset($bearstheme_options['page_breadcrumb_delimiter']) ? $bearstheme_options['page_breadcrumb_delimiter'] : '/';
		?>
			<div class="bt-title-bar-wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="bt-title-bar">
							<?php if($tb_show_page_title){  ?>
								<?php if($subtext) echo '<h6>'.$subtext.'</h6>'; ?>
								<h2 class="bt-text-ellipsis"><?php echo bearstheme_page_title(); ?></h2>
							<?php } ?>
							<?php if($tb_show_page_breadcrumb){  ?>
								<div class="bt-path">
									<div class="bt-path-inner">
										<?php echo bearstheme_page_breadcrumb($delimiter); ?>
									</div>
								</div>
							<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php 
	}
}
