//funcions.php snippet to load GenerateBlocks CSS together with the Advanced Ads ad injection
//based on https://docs.generateblocks.com/article/adding-content-sources-for-dynamic-css-generation/
//
//Note: the generated CSS file from GenerateBlocks will contain the CSS of all ads, even if they are displayed or not.
//

add_filter( 'generateblocks_do_content', function( $content ) {
	$ads = get_posts( array( 'post_type' => \Advanced_Ads::POST_TYPE_SLUG, 'numberposts' => -1 ) );
	foreach ( $ads as $ad ) {
		if ( has_blocks( $ad->ID ) ) {
			$ad = get_post( $ad->ID );

			if ( ! $ad || \Advanced_Ads::POST_TYPE_SLUG !== $ad->post_type ) {
				continue;
			}

			if ( $ad->post_status !== 'publish' ) {
				continue;
			}

			$content .= $ad->post_content;
		}
	}

	return $content;
} );
