<?php
/**
* Plugin Name: Simple Mortgage Calculator
* Plugin URI: http://happycatplugins.com/plugins/mortgage-calculator/
* Version: 1.0
* Author: Sophia & Tyler Zey
* Author URI: http://happycatplugins.com
* Description: This plugin allows you to put a mortgage calculator anywhere on your site. You can add it via that widget areas or on a blog/post/page with a shortcode.  There are also various colored templates.
* License: GPL2
*/

/*  Copyright 2017 Happy Cat Plugins

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

//add javascript
function add_happy_cat_mort_scripts() {
    wp_enqueue_script('main_mort_calc_jquery_convert_files',plugins_url( 'js/jquery.formatCurrency-1.4.0.min.js', __FILE__ ), array('jquery'));
    wp_enqueue_script('main_mort_calc_js_files',plugins_url( 'js/front-main.js', __FILE__ ), array('jquery'));
    wp_enqueue_script('main_mort_calc__converter_files',plugins_url( 'js/type-convert.js', __FILE__ ), array('jquery'));
    wp_enqueue_style('main_mort_calc_css_files',plugins_url( 'css/front-main.css', __FILE__ ), false);
  }
  add_action('wp_enqueue_scripts', 'add_happy_cat_mort_scripts');

  
//include class file for mortgage widget area
include('class.mortgage.php');

//register widget
function register_happy_cats_mortgage_calc(){
    register_widget('HappyCat_Plugins_Mortgage_Calc_Widget');
   }
add_action('widgets_init','register_happy_cats_mortgage_calc');


// Add Deep Link To Plugin Page
function hc_mort_calc_plugin_add_settings_link( $links ) {
    $settings_link = '<a href="admin.php?page=happy-cat-mort-calc">' . __( 'Setup Here' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'hc_mort_calc_plugin_add_settings_link', 1 );


// create custom plugin settings menu
add_action('admin_menu', 'hc_mort_calc_create_menu');
function hc_mort_calc_create_menu() {
    //create new top-level menu
    global $mort_calc_add_page;
    $mort_calc_add_page = add_menu_page('Mortgage Calculator', 'Mortgage Calc', 'administrator', 'happy-cat-mort-calc', 'hc_mort_calc_settings_page' , 'dashicons-welcome-widgets-menus',26);
}

function hc_mort_calc_load_styles_scripts($hook) {
    global $mort_calc_add_page;
    if( $hook != $mort_calc_add_page )
            return;
        wp_enqueue_style( 'mort-calc-main-style',plugins_url( '/css/bootstrap.min.css', __FILE__ ) );
        wp_enqueue_style( 'back-mort-calc-main-style',plugins_url( '/css/back-main.css', __FILE__ ) );
        wp_enqueue_script( 'mort-calc-main-bt-js',plugins_url( '/js/bootstrap.min.js', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'hc_mort_calc_load_styles_scripts' );


function hc_mort_calc_settings_page() {
?>
<div class="wrap">
    <div class="happyCatPluginsMortCalcBack container">
        <div class="jumbotron">
            <h1>Mortgage Calculator</h1>
            <p>Ready to get your Mortgage Calculator on the front of your site? Here's how you do it:</p>
       
        
            <div class="panel">
                <div class="panel-heading">
                    <label>Option #1</label>
                    <h3 class="panel-title">Adding Through Widgets</h3>
                </div>
                <div class="panel-body">
                    <p>One of the easiest ways to get your Mortgage calculator on EVERY page of your site, is to add it to a Widget. You can <a href="widgets.php">do that here.</a><br>Simply drag the Mortgage Calculator to the Widget area where you'd like it to display. Then, select a color. And click save. You'll now see it on the front of your site. </p>
                <br><a href="widgets.php" class="btn btn-primary">Add Widget</a>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <label>Option #2</label>
                    <h3 class="panel-title">Adding Through ShortCodes</h3>
                </div>
                <div class="panel-body">
                    <p>You can also copy/paste this shortcode onto any page. This will add the Mortgage Calculator to that specific page.</p> 
                        <form class="form-horizontal">
                            <fieldset>
                                    <div class="form-group col-lg-6">
                                        <input class="form-control" id="focusedInput" type="text" value="[mortgage-calculator]">
                                    </div>
                            </fieldset>
                        </form>
                </div>
            </div>
            <div class="happycat-bottom-byline grow">
            <?php
                  echo '<a href="http://happycatplugins.com/" target="_blank"><p>created by <img src="' . plugins_url( '/happycatlogo.png', __FILE__ ) . '" alt="happy cat logo" style="width:50px"> Happy Cat Plugins
                  </p></a>'; ?>
            </div>
</div>
    </div>
</div>
<?php }




###### START SHORTCODE ######

add_shortcode( 'mortgage-calculator', 'happy_cat_mortgage_cal_shortcode' );
function happy_cat_mortgage_cal_shortcode() {
	ob_start();
	?> 
<div class="happyCatMortCalcDiv happyCatMortTheme03">
    <form id="happyCatMortCalc">
        <div class="happyCatMortCalc_price">
            <label for="price">Home Price</label>
            <input id="happyCalcPriceInput" value="$300,000" class="happyCatMortCalc_price_input">
        </div>
        <div class="happyCatMortCalc_down">
            <label for="downPayment">Down payment</label>
            <input id="happyCalcDownInput" value="$60,000" class="happyCatMortCalc_down_input">
            <input id="happyCalcDownPerInput" value="20" class="happyCatMortCalc_downPer_input">
            <i>%</i>
        </div>
        <div class="happyCatMortCalc_loan">
            <label for="loanProgram">Loan Program</label>
            <select id="happyCalcLoanInput" class="happyCatMortCalc_loan_input">
                <option selected="selected" value="30">30 Year Fixed</option>
                <option value="15">15 Year Fixed</option>
            </select>
        </div>
        <div class="happyCatMortCalc_interestRate">
            <label for="interestRate">Interest Rate</label>
            <input id="happyCalcIntRate" value="3.49" class="happyCatMortCalc_intRate_input"><i>%</i>
        </div>
        <div class="happyCatMortCalc_AdvancedSettings" id="happyCatshowAdvanced">
            <h4 class="happyCatMortCalc_adText">ADVANCED</h4>
        </div>
        <!--HIDDEN SETTINGS-->
        <div id="happyCatAdvancedDiv" class="happyCatMortCalc_advSettings happyCatMortCalcHidden">
            <div class="happycatMorgCalcLine"></div>
            <div class="happyCatMortCalc_tax">
                <label for="tax">Property Tax</label>
                <input id="happyCalcTax" value="$1,740" class="happyCatMortCalc_tax_input">
            </div>
            <div class="happyCatMortCalc_ins">
                <label for="tax">Home Insurance</label>
                <input id="happyCalcIns" value="$800" class="happyCatMortCalc_ins_input">
            </div>
            <div class="happyCatMortCalc_hoa">
                <label for="hoa">Home Owner Association Fees</label>
                <input id="happyCalcHoa" value="$0" class="happyCatMortCalc_hoa_input">
            </div>
            <div class="happyCatMortCalc_SimpleSettings" id="happyCatshowSimple">
                <h4 class="happyCatMortCalc_simpleText">HIDE ADVANCED</h4>
            </div>
        </div>
        <div class="happyCatMortCalcResults">
            <div class="happyCatMortCalc_Total">
                <h3 class="happyCatMortCalc_TotalText">Your Monthly Total</h3>$<span id="hcreplaceTotal" class="happyCatMorcCalc_TotalNo">1374</span>
            </div>
            <div class="happyCatMortCalc_Total_bottom">
                <div class="happyCatMortCalc_PI">
                    <h4 class="happyCatMortCalc_PIText">P&I</h4>$<span id="hcreplacePI">1,105</span>
                </div>
                <div class="happyCatMortCalc_Tax">
                    <h4 class="happyCatMortCalc_TaxText">TAXES & INS</h4>$<span id="hcreplaceTax">287</span>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
	return ob_get_clean();
}

