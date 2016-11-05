<?php
extract( $data );
$template_params = $atts['template_params'];
$col = 12 / (int) $template_params['columns'];
$create_date = sprintf( '<span class="d">%s</span><span class="m">%s</span>', get_the_date( 'd', $post->ID ), get_the_date( 'F', $post->ID ) );
$create_date2 = get_the_date( 'F m, Y', $post->ID );

# gallery
$gallery_ids = explode( ',', get_post_meta( $post->ID, 'bt_post_gallery', true ) );
if( has_post_thumbnail( $post->ID ) ) array_push( $gallery_ids, get_post_thumbnail_id( $post->ID ) );

# gallery Html
$gallery_html = bearsthemes_renderCarouselByAttachmentId( $gallery_ids, $atts['template_params']['image_size'] );

echo "
	<div class='item col-md-{$col}'>
		<div class='item-inner'>
			<div class='image-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #fafafa;'>
				<div class='icon-posttype'><i class='{$icon}'></i></div>
				{$gallery_html}
			</div>
			<div class='info-meta'>
				<a href='{$link}' title='{$title}' data-smooth-link><h4 class='title'>{$title}</h4></a>
				<div class='extra-meta'>
					<div class='post-date'><i class='ion-clock'></i> {$create_date2}</div>
					<div class='post-cate'><i class='ion-android-folder'></i> ". get_the_category_list( ', ' ) ."</div>
					<div class='post-comment'><i class='ion-chatbubble'></i> {$count_comment->total_comments}</div>
				</div>
			</div>
		</div>
	</div>";
?>