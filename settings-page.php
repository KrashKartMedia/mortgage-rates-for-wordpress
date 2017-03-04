<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
// create custom plugin settings menu
add_action('admin_menu', 'loan_sifter_rates_shortcode_create_menu');
function loan_sifter_rates_shortcode_create_menu() {
	//create new top-level menu
	add_options_page( 'Mr. Mortgage', 'Mr. Mortgage', 'manage_options', 'mortgage-rates-for-wordpress', 'loan_sifter_rates_shortcode_settings_page');
	//call register settings function
	add_action( 'admin_init', 'loan_sifter_rates_shortcode_plugin_settings' );
}
function loan_sifter_rates_shortcode_plugin_settings() {
	//register our settings
	register_setting( 'mr-mortgage-wp-chortcode-settings-group', 'loan_sifter_url' );
	register_setting( 'mr-mortgage-wp-chortcode-settings-group', 'ls_iframe_height' );
	register_setting( 'mr-mortgage-wp-chortcode-settings-group', 'ls_iframe_width' );
}
function loan_sifter_rates_shortcode_settings_page() {
?>
		<div class="wrap">
		<h2><?php echo __( 'Mr. Mortgage Rates For WordPress.', 'mr-mortgage-wp' ); ?> 	</h2>
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<!-- main content -->
				<div id="post-body-content">
					<div class="meta-box-sortables ui-sortable">
					<div class="postbox">
							<div style="background-color:#0073aa;width:100%;display:inline-block;vertical-align:middle;"><h2 style="color:#fff;"><span>
								<?php echo __( 'Loan Sifter Settings', 'mr-mortgage-wp' ); ?>
							</span></h2></div>
							<div class="inside">
								<form method="POST" action="options.php">
		    <?php settings_fields( 'mr-mortgage-wp-chortcode-settings-group' ); ?>
		    <?php do_settings_sections( 'mr-mortgage-wp-chortcode-settings-group' ); ?>
		    <?php add_thickbox(); ?>
				<p><div id="my-content-id" style="display:none;">
				<h3>Loan Sifter Iframe Code Snippet</h3>
				<p>
				The code snippet below is located on the <a href="https://www.loansifter.com/home" target="_blank">Loansifter</a> Website. Once logged in, Go to Marketing > Consumer Facing / Website > Rate Table > Publish.
				</p>

				<p>
				In the Publish Tab, you should see two Loan Sifter Code snippets. Find the iFrame code Snippet. Here is an example of what it should ook like.
				</p>

				<p>
				&lt;iframe src='<strong>https://www.loansifter.com/rates2v2.aspx?uid=#####</strong>' allowtransparency='true' style='background:transparent' frameborder='0' marginheight='0' marginwidth='0' width='190' height='118'>&lt;/iframe&gt; 
				</p>
				<p>
				Here is an example of the code Loansifter gives you. Copy the text inside of the src="", from the second box.
				<?php echo '<p><img src="' . plugin_dir_url( __FILE__) . '/img/iframe-image.png" width="100%" height="100%">';?>
				</p>
				</div>
				Log into your <a hre="https://www.loansifter.com/home" target="_blank">Loansifter.com</a> account. You should be given a Iframe code snippet (<a href="#TB_inline?width=600&height=550&inlineId=my-content-id" class="thickbox">see example</a>) to put on your site. copy the text between src="" and paste here.
				</p>
		        	<input type="text" name="loan_sifter_url" size="40" value="<?php echo esc_attr( get_option('loan_sifter_url') ); ?>" />
		        	</p>
		        	<p>
		        	Adjust the current iframe display height, by putting in a number. Do not include "px" or "%"" after the number.<br>
		        	<input type="text" name="ls_iframe_height" size="" value="<?php echo esc_attr( get_option('ls_iframe_height') ); ?>" />
		        	</p>
		        	<p>
		        	Adjust the current iframe display height, by putting in a number. Do not include "px" or "%"" after the number.<br>
		        	<input type="text" name="ls_iframe_width" size="" value="<?php echo esc_attr( get_option('ls_iframe_width') ); ?>" />
		       		</p>
		    <?php submit_button(); ?>
		</form>
<?php 
//get the settings stuff
$loan_sifter_rates_url = esc_attr(get_option( 'loan_sifter_url' )); 
$lsheight = esc_attr(get_option( 'ls_iframe_height' )); 
$lswidth = esc_attr(get_option( 'ls_iframe_width' ));
// Get the rates.
$request = new WP_Http;
$loan_sifter_rates_url = esc_attr(get_option( 'loan_sifter_url' ));
$result = $request->request( $loan_sifter_rates_url );
// Pull the data out. Keep the data variable in case we want to use Javascript.
preg_match('/var data=\[.*\]/', $result['body'], $json_data);
// Fix bad labels within the data. Without this fix we cannot convert the JSON to a PHP object.
$json_data = str_replace('program:', '"program":', $json_data[0]);
$json_data = str_replace('data:', '"data":', $json_data);
// Extract the data out of the Javascript.
preg_match('/\[.*\]/', $json_data, $data);
$data = json_decode($data[0]);
?>
</div>
<!-- .inside -->
</div>
<!-- .postbox -->
					<div class="postbox">
							<div style="background-color:#0073aa;width:100%;display:inline-block;vertical-align:middle;"><h2 style="color:#fff;"><span>
								<?php echo __( 'Individual Shortcodes', 'mr-mortgage-wp' ); ?>
							</span></h2></div>
							<div class="inside">
								<table class="widefat" cellspacing="0">
									<tbody>
									<tr>
										<td class="row-title">
										<?php echo __( 'Get Program: ', 'mr-mortgage-wp' ); ?><code><?php echo '[mr-mortgage-program rate-position="" link="" target=""]';?></code> | <?php echo __( 'Example : ', 'mr-mortgage-wp' ); ?><?php echo $data[0]->program; ?>
										</td>
									</tr>
									<tr class="alternate">
										<td class="row-title">
										<?php echo __( 'Get Rate: ', 'mr-mortgage-wp' ); ?><code><?php echo '[mr-mortgage-rate rate-position="" link="" target=""]';?></code> | <?php echo __( 'Example : ', 'mr-mortgage-wp' ); ?><?php echo $data[0]->data[0][0]; ?>
										</td>
									</tr>
									<tr>
										<td class="row-title">
										<?php echo __( 'Get APR: ', 'mr-mortgage-wp' ); ?><code><?php echo '[mr-mortgage-apr rate-position="" link="" target=""]';?></code> | <?php echo __( 'Example : ', 'mr-mortgage-wp' ); ?><?php echo $data[0]->data[0][1]; ?>
										</td>
									</tr>
									<tr class="alternate">
										<td class="row-title">
										<?php echo __( 'Get Points: ', 'mr-mortgage-wp' ); ?><code><?php echo '[mr-mortgage-points rate-position="" link="" target=""]';?></code> | <?php echo __( 'Example : ', 'mr-mortgage-wp' ); ?><?php echo $data[0]->data[0][2]; ?>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
							<!-- .inside -->
						</div>
						<!-- .postbox -->
						<div class="postbox">
							<div style="background-color:#0073aa;width:100%;display:inline-block;vertical-align:middle;"><h2 style="color:#fff;"><span>
								<?php echo __( 'Current Iframe Display', 'mr-mortgage-wp' ); ?>
							</span></h2></div>
							<div class="inside">
								<table class="widefat" cellspacing="0">
									<tbody>
									<tr class="alternate">
									</tr>
									<tr>
										<td class="">
										<iframe src='<?php echo $loan_sifter_rates_url ?>' width='<?php echo $lswidth ?>' height='<?php echo $lsheight ?>'></iframe>
										</td>
									</tr>
									<tr class="alternate">
										<td class="row-title">
										Count the number of rows, starting with the number 0. Count 0, 1, 2, 3, etc.
										</td>
									</tr>
									</tbody>
								</table>
							</div>
							<!-- .inside -->
						</div>
						<!-- .postbox -->
						<div class="postbox">
							<div style="background-color:#0073aa;width:100%;display:inline-block;vertical-align:middle;"><h2 style="color:#fff;"><span>
								<?php echo __( 'Shortcode Example', 'mr-mortgage-wp' ); ?>
							</span></h2></div>
							<div class="inside">
								<table class="widefat" cellspacing="0">
									<tbody>
									<tr class="alternate">
										<td class="row-title">Position</td>
										<td>Term (Program)</td>
										<td>Rate</td>
						  				<td>APR</td> 
										<td>Points</td>
										<td>Example Shortcode</td>
									</tr>			
									</tbody>
									<tr class="">
										<td class="row-title">0</td>
										<td><?php echo $data[0]->program; ?></td>
										<td>Rate <?php echo $data[0]->data[0][0]; ?></td>
						  				<td>APR  <?php echo $data[0]->data[0][1]; ?></td> 
										<td>Points <?php echo $data[0]->data[0][2]; ?></td>
										<td>[mr-mortgage-program rate-position="0" link="" target=""]</td>
									</tr>		
									</tbody>
								</table>
							</div>
							<!-- .inside -->
						</div>
						<!-- .postbox -->
					</div>
					<!-- .meta-box-sortables .ui-sortable -->
				</div>
				<!-- post-body-content -->
				<!-- sidebar -->
				<div id="postbox-container-1" class="postbox-container">
					<div class="meta-box-sortables">
						<div class="postbox">
							<div style="background-color:#0073aa;width:100%;display:inline-block;vertical-align:middle;"><h2 style="color:#fff;"><span>
							<?php echo __( 'About The Plugin', 'mr-mortgage-wp' ); ?>
							</span></h2></div>
							<div class="inside">
							<p>
							<?php echo __( 'A simple way to display mortgage rates on your WordPress site in real time.', 'mr-mortgage-wp' ); ?>
							</p>
							<p>
								<?php echo __( 'Copy a shortcode and add a position number. The shortcode will display the Rate, APR, Points, or Program.', 'mr-mortgage-wp' ); ?>
							</p>
							<p>
							<?php echo __( 'Version', 'mr-mortgage-wp' ) . ' 1.0' ; ?>
							</p>
							</div>
						</div>
						<!-- .postbox -->
					</div>
					<!-- .meta-box-sortables -->
				</div>
				<!-- #postbox-container-1 .postbox-container -->
			</div>
			<br class="clear">
		</div>
<?php 
}