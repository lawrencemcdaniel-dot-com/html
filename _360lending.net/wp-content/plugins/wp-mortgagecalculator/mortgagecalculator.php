<?php
/*
Plugin Name: WP-Mortgage Calculator Widget
Description: Adds A Mortgage Calculator Widget
Author: MortgageCalculator.org
Version: 1.0
Author URI: http://www.MortgageCalculator.org
*/

// This gets called at the plugins_loaded action
function widget_mortgage_calculator_init() {
	
	// Check for the required API functions
	if ( !function_exists('register_sidebar_widget') ||
       	     !function_exists('register_widget_control') )
		return;

	global $mc_linktext;
	$mc_linktext = get_option('mortgagecalculator_org');
	if(!$mc_linktext || $mc_linktext == ''){
		if(!ini_get('safe_mode') && function_exists('file_get_contents')){
			$mc_linktext = @file_get_contents(get_bloginfo('url') . '/wp-content/plugins/mc_linktext.php');
		} 
		if(!$mc_linktext || $mc_linktext != ""){
			$keywords = array(
				'www.MortgageCalculator.org',
				'MortgageCalculator.org'
				);

			$key = rand(0,count($keywords)-1);
			$mc_linktext = $keywords[$key];		
		}
		
		if(!$mc_linktext || $mc_linktext == '') $mc_linktext = 'MortgageCalculator.org';
		update_option('mortgagecalculator_org', $mc_linktext);
	}

	// This prints the widget
	function widget_mortgage_calculator($args) {	
		global $mc_linktext;
		extract($args);

		//If the user has not yet set the options or set them empty, take the defaults	
		$title = '';
		?>
		<?php echo $before_widget . $before_title . $title . $after_title; ?>
		<?php // Code here: ?>
<style type="text/css">
<!--
.mctable table { width: 160px; }
#mctable td { background-color: #f4f7f9; font-size: .8em; } 
#mcform #mcheader { background-color: #fff; text-align:center;}
#mcform #first-row { background-color: #000; border-bottom: 1px solid #fff; font-weight: 600; color: #fff; }
#mcform { margin: 0; padding: 0; }
#mctable input { border: 1px solid #000; background-color: #fff; padding-left: 5px; }
#btn { background-color: #155776; }
#mctable .hot { font-weight: bold; color: #155776; }
#mctable .key { font-weight: bold; color: #339900; }

-->
</style>
<script type="text/javascript">
function mc_httprequest(URL,ID,type,string){

	
	
	var browser = navigator.appName; //find the browser name
	if(browser == "Microsoft Internet Explorer"){
	/* Create the object using MSIE's method */
		http = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		http = new XMLHttpRequest();
	}
	http.open("GET",URL,false);
	http.send(null);
	var response = string.replace('%',http.responseText);
	if (type == 'input'){
		document.getElementById(ID).value = response;
	} else {
		document.getElementById(ID).innerHTML = response;
	}
	return response;

}

function mcCalcMortgage(){

	var principal = document.getElementById('mcPrincipal').value;
	var interest  = document.getElementById('mcInterest').value;
	var noy       = document.getElementById('mcNOY').value;
	
	if (principal == '') { principal = '0'; }
	if (interest == '')  { interest = '0'; }
	if (noy == '') 		 { noy = '0'; }
	
	if (principal == "0"){ 
		var display = 'Please fill "Loan Amount" field.'; 
		document.getElementById("mcStatusDisplay").innerHTML = display; 
		}
		
	if (interest == "0"){ 
		var display = 'Please fill "Interest Rate" field.'; 
		document.getElementById("mcStatusDisplay").innerHTML = display; 
		}
	
	if (noy == "0"){ 
		var display = 'Please fill "Length of Loan" field.'; 
		document.getElementById("mcStatusDisplay").innerHTML = display; 
		}	
	
	response = mc_httprequest('<?php echo bloginfo('url');?>/wp-content/plugins/mc_calculate.php?principal='+principal+'&interest='+interest+'&noy='+noy,'mcStatusResponse','input','%');
	document.getElementById('mcStatusResponse').value = response;
	document.getElementById("mcStatusDisplay").innerHTML = response; 
}
</script>

<form id="mcform" name="principal" method="post" action="">
  <table id="mctable" class="mctable" border="0" cellpadding="5" cellspacing="0">
    <tr>

      <td id="mcheader"><a href="http://www.mortgagecalculator.org"><img src="<?php echo bloginfo('url');?>/wp-content/plugins/mortgage-calculator-logo.gif" alt="<?php echo $mc_linktext; ?>" width="160" border="0" /></a></td>
    </tr>
    <tr>
      <td id="first-row">Input Information</td>
    </tr>
    <tr>
      <td width="40%"><div align="center"><strong>Loan Amount ($)<br />
          </strong>

              <input name="p" type="text" id="mcPrincipal" value="250,000" size="10" onchange="javascript:mcCalcMortgage();" />
      </div></td>
    </tr>
    <tr>
      <td width="40%"><div align="center"><strong>Interest Rate (%)<br />
          </strong>
              <input name="i" type="text" id="mcInterest" value="6.50" size="10" onchange="javascript:mcCalcMortgage();" />
      </div></td>

    </tr>
    <tr>
      <td width="40%"><div align="center"><strong>Length of Loan (Yrs)<br />
          </strong>
              <input name="noy" type="text" id="mcNOY" value="30" size="3" maxlength="3" onchange="javascript:mcCalcMortgage();" />
      </div></td>
    </tr>
    <tr>

      <td>
        <div align="center">
          <input type="button" name="button" id="btn" value="Calculate" onclick="javascript:mcCalcMortgage();" />
	  <input type="hidden" name="response" id="mcStatusResponse" /></div></td></tr>
    <tr>
      <td><div id="mcStatusDisplay"></div>
      </td>
    </tr>
  </table>
</form>
		<?php echo $after_widget; ?>
		<?php
	}

	// Tell Dynamic Sidebar about our new widget and its control
	register_sidebar_widget('Mortgage Calculator', 'widget_mortgage_calculator');

}

// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('plugins_loaded', 'widget_mortgage_calculator_init');
?>
