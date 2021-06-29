/**
 * Remove Extra Scripts From Home Page
 */
function wp_dequeue_scripts() {
	if (is_front_page() && !is_admin()) {
                
                wp_dequeue_script('woocommerce');
		wp_deregister_script('woocommerce');

	}
}
add_action('wp_print_scripts', 'wp_dequeue_scripts', 100);

/**
 * Remove Extra Style Sheet From Home Page
 */
function wp_dequeue_styles() {
	if (is_front_page() && !is_admin()) {

		wp_dequeue_style('wc-block-style');
		wp_deregister_style('wc-block-style');

	}
}

add_action('wp_print_styles', 'wp_dequeue_styles', 100);

/**
 * Print scripts and styles with handles and view them in page source
*/

function as_print_scripts() {
	// all loaded scripts
	global $wp_scripts;
	echo '<!-- Scripts',"\n";
	foreach( $wp_scripts->queue as $script ) :
	echo $script . '  ::  src= '.$wp_scripts->registered[$script]->src."\n";
	endforeach;
	// all loaded css
	global $wp_styles;
	echo '<!-- Styles',"\n";
	foreach( $wp_styles->queue as $style ) :
	echo $style . '  ::  src= '.$wp_styles->registered[$style]->src."\n";
	endforeach;
	echo '-->';
}

add_action( 'wp_print_scripts', 'as_print_scripts' );

/**
 * Remove Recaptcha Style Sheet and Scripts
 */

function add_id_to_script($tag, $handle, $src) {
    if($handle === 'gform_recaptcha'){
        return ;
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'add_id_to_script', 10, 3 );

/**
 * Print scripts and styles with handles
*/

function add_id_to_scripts( $tag, $handle, $src ) {
    echo '<pre><strong>'.$handle. '</strong> ->'.$src.'</pre>';
    return $tag;
}
add_filter( 'script_loader_tag', 'add_id_to_scripts', 10, 3 );
