<?php
extract( $data );
$template_params = $atts['template_params'];
$col = 12 / (int) $template_params['columns'];
$create_date = sprintf( '<span class="d">%s</span><span class="m">%s</span>', get_the_date( 'd', $post->ID ), get_the_date( 'F', $post->ID ) );
$create_date2 = get_the_date( 'F m, Y', $post->ID );
$icon_posttype_html = ( ! empty( $icon ) ) ? "<div class='icon-posttype'><i class='{$icon}'></i></div>" : '';

# quote
$quote_data = get_post_meta( $post->ID, 'tb_post_quote', true );
$quote_author = get_post_meta( $post->ID, 'tb_post_author', true );
echo "
	<div class='item col-md-{$col}'>
		<div class='item-inner'>
			<div class='image-meta' style='background: url({$thumbnail}) no-repeat center center / cover, #fafafa;'>
				{$icon_posttype_html}
				<div class='quote-meta'>
					<blockquote>
						{$quote_data}
						<label>{$quote_author}</label>
					</blockquote>
				</div>
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