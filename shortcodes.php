<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
//Rate Shortcode. 
// [mr-mortgage-rate rate-position=""]
function loansifter_rate_short_code($atts = [], $content = null, $tag = ''){
	// Get the rates.
			$request = new WP_Http;
			$mr_mortgage_rates_url = esc_attr(get_option( 'loan_sifter_url' ));
			$result = $request->request( $mr_mortgage_rates_url );
			// Pull the data out. Keep the data variable in case we want to use Javascript.
			preg_match('/var data=\[.*\]/', $result['body'], $json_data);
			// Fix bad labels within the data. Without this fix we cannot conver the JSON to a PHP object.
			$json_data = str_replace('program:', '"program":', $json_data[0]);
			$json_data = str_replace('data:', '"data":', $json_data);
			// Extract the data out of the Javascript.
			preg_match('/\[.*\]/', $json_data, $data);
			$data = json_decode($data[0]);
	// normalize attribute keys, lowercase
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	// override default attributes with user attributes
	$mr_mortgage_rate = shortcode_atts([
	'rate-position' => '',
	'link' => '',
	'target' => '',
	], $atts, $tag);
	$o = '';
	if (empty($mr_mortgage_rate['link'])){
		$o .= $data[esc_html__($mr_mortgage_rate['rate-position'], 'mr-mortgage-wp')]->data[0][0];
	}else{
	$o .= '<a href="' . esc_html__($mr_mortgage_rate['link'], 'mr-mortgage-wp') . '" target="' . esc_html__($mr_mortgage_rate['target'], 'mr-mortgage-wp') . '">' . $data[esc_html__($mr_mortgage_rate['rate-position'], 'mr-mortgage-wp')]->data[0][0] . '</a>';
	// enclosing tags
	if (!is_null($content)) {
	// secure output by executing the_content filter hook on $content
	$o .= apply_filters('the_content', $content);
	// run shortcode parser recursively
	$o .= do_shortcode($content);
	}
	}
	// return output
	return $o;
}
function loansifter_rate_short_codes_one_init() {
	add_shortcode('mr-mortgage-rate', 'loansifter_rate_short_code');
}
	add_action('init', 'loansifter_rate_short_codes_one_init');
	//APR Shortcode. 
// [mr-mortgage-apr rate-position=""]
function loansifter_apr_short_code($atts = [], $content = null, $tag = ''){
	// Get the rates.
			$request = new WP_Http;
			$mr_mortgage_rates_url = esc_attr(get_option( 'loan_sifter_url' ));
			$result = $request->request( $mr_mortgage_rates_url );
			// Pull the data out. Keep the data variable in case we want to use Javascript.
			preg_match('/var data=\[.*\]/', $result['body'], $json_data);	
			// Fix bad labels within the data. Without this fix we cannot conver the JSON to a PHP object.
			$json_data = str_replace('program:', '"program":', $json_data[0]);
			$json_data = str_replace('data:', '"data":', $json_data);
			// Extract the data out of the Javascript.
			preg_match('/\[.*\]/', $json_data, $data);
			$data = json_decode($data[0]);
	// normalize attribute keys, lowercase
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	// override default attributes with user attributes
	$mr_mortgage_rate = shortcode_atts([
	'rate-position' => '',
	'link' => '',
	'target' => '',
	], $atts, $tag);
	$o = '';
	if (empty($mr_mortgage_rate['link'])){
		$o .= $data[esc_html__($mr_mortgage_rate['rate-position'], 'mr-mortgage-wp')]->data[0][1];
	}else{
	$o .= '<a href="' . esc_html__($mr_mortgage_rate['link'], 'mr-mortgage-wp') . '" target="' . esc_html__($mr_mortgage_rate['target'], 'mr-mortgage-wp') . '">' . $data[esc_html__($mr_mortgage_rate['rate-position'], 'mr-mortgage-wp')]->data[0][1] . '</a>';
	// enclosing tags
	if (!is_null($content)) {
	// secure output by executing the_content filter hook on $content
	$o .= apply_filters('the_content', $content);
	// run shortcode parser recursively
	$o .= do_shortcode($content);
	}
	}
	// return output
	return $o;
}
function loansifter_apr_short_codes_one_init() {
	add_shortcode('mr-mortgage-apr', 'loansifter_apr_short_code');
}
	add_action('init', 'loansifter_apr_short_codes_one_init');
	//Points Shortcode. 
// [mr-mortgage-points rate-position=""]
function loansifter_points_short_code($atts = [], $content = null, $tag = ''){
	// Get the rates.
			$request = new WP_Http;
			$mr_mortgage_rates_url = esc_attr(get_option( 'loan_sifter_url' ));
			$result = $request->request( $mr_mortgage_rates_url );
			// Pull the data out. Keep the data variable in case we want to use Javascript.
			preg_match('/var data=\[.*\]/', $result['body'], $json_data);
			// Fix bad labels within the data. Without this fix we cannot conver the JSON to a PHP object.
			$json_data = str_replace('program:', '"program":', $json_data[0]);
			$json_data = str_replace('data:', '"data":', $json_data);
			// Extract the data out of the Javascript.
			preg_match('/\[.*\]/', $json_data, $data);
			$data = json_decode($data[0]);
	// normalize attribute keys, lowercase
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	// override default attributes with user attributes
	$mr_mortgage_rate = shortcode_atts([
	'rate-position' => '',
	'link' => '',
	'target' => '',
	], $atts, $tag);
	$o = '';
	if (empty($mr_mortgage_rate['link'])){
		$o .= $data[esc_html__($mr_mortgage_rate['rate-position'], 'mr-mortgage-wp')]->data[0][2];
	}else{
	$o .= '<a href="' . esc_html__($mr_mortgage_rate['link'], 'mr-mortgage-wp') . '" target="' . esc_html__($mr_mortgage_rate['target'], 'mr-mortgage-wp') . '">' . $data[esc_html__($mr_mortgage_rate['rate-position'], 'mr-mortgage-wp')]->data[0][2] . '</a>';
	// enclosing tags
	if (!is_null($content)) {
	// secure output by executing the_content filter hook on $content
	$o .= apply_filters('the_content', $content);
	// run shortcode parser recursively
	$o .= do_shortcode($content);
	}
	}
	// return output
	return $o;
}
function loansifter_points_short_codes_one_init() {
	add_shortcode('mr-mortgage-points', 'loansifter_points_short_code');
}
	add_action('init', 'loansifter_points_short_codes_one_init');
	//Program Shortcode. 
// [mr-mortgage-program rate-position=""]
function loansifter_program_short_code($atts = [], $content = null, $tag = ''){
	// Get the rates.
			$request = new WP_Http;
			$mr_mortgage_rates_url = esc_attr(get_option( 'loan_sifter_url' ));
			$result = $request->request( $mr_mortgage_rates_url );	
			// Pull the data out. Keep the data variable in case we want to use Javascript.
			preg_match('/var data=\[.*\]/', $result['body'], $json_data);	
			// Fix bad labels within the data. Without this fix we cannot conver the JSON to a PHP object.
			$json_data = str_replace('program:', '"program":', $json_data[0]);
			$json_data = str_replace('data:', '"data":', $json_data);	
			// Extract the data out of the Javascript.
			preg_match('/\[.*\]/', $json_data, $data);
			$data = json_decode($data[0]);
	// normalize attribute keys, lowercase
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	// override default attributes with user attributes
	$mr_mortgage_rate = shortcode_atts([
	'rate-position' => '',
	'link' => '',
	'target' => '',
	], $atts, $tag);
	$o = '';
	if (empty($mr_mortgage_rate['link'])){
		$o .= $data[esc_html__($mr_mortgage_rate['rate-position'], 'mr-mortgage-wp')]->program;
	}else{
	$o .= '<a href="' . esc_html__($mr_mortgage_rate['link'], 'mr-mortgage-wp') . '" target="' . esc_html__($mr_mortgage_rate['target'], 'mr-mortgage-wp') . '">' . $data[esc_html__($mr_mortgage_rate['rate-position'], 'mr-mortgage-wp')]->program . '</a>';
	// enclosing tags
	if (!is_null($content)) {
	// secure output by executing the_content filter hook on $content
	$o .= apply_filters('the_content', $content);
	// run shortcode parser recursively
	$o .= do_shortcode($content);
	}
	}
	// return output
	return $o;
}
function loansifter_program_short_codes_one_init() {
	add_shortcode('mr-mortgage-program', 'loansifter_program_short_code');
}
	add_action('init', 'loansifter_program_short_codes_one_init');
?>