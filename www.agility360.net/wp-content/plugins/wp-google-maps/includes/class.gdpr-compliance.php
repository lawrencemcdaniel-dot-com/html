<?php

namespace WPGMZA;

class GDPRCompliance
{
	public function __construct()
	{
		add_filter('wpgmza_global_settings_tabs', array($this, 'onGlobalSettingsTabs'));
		add_filter('wpgmza_global_settings_tab_content', array($this, 'onGlobalSettingsTabContent'));
		
		add_filter('wpgmza_plugin_get_default_settings', array($this, 'onPluginGetDefaultSettings'));
		
		add_action('wp_ajax_wpgmza_gdpr_privacy_policy_notice_dismissed', array($this, 'onPrivacyPolicyNoticeDismissed'));
		
		$wpgmza_other_settings = get_option('WPGMZA_OTHER_SETTINGS');
		if(empty($wpgmza_other_settings['wpgmza_gdpr_notice']))
		{
			$wpgmza_other_settings = array_merge($wpgmza_other_settings, $this->onPluginGetDefaultSettings(array()));
			update_option('WPGMZA_OTHER_SETTINGS', $wpgmza_other_settings);
		}
	}
	
	public function onPluginGetDefaultSettings($settings)
	{
		return array_merge($settings, array(
			'wpgmza_gdpr_enabled'		=> 1,
			'wpgmza_gdpr_notice'		=> __('I agree for my personal data, provided via submission through \'User Generated Markers\' to be processed by {COMPANY_NAME}.
		
I agree for my personal data, provided via map API calls, to be processed by the API provider, for the purposes of geocoding (converting addresses to coordinates).

When using the User Generated Marker addon, data will be stored indefinitiely for the following purpose(s): {RETENTION_PURPOSE}'),
			
			'wpgmza_gdpr_retention_purpose' => 'presenting the data you have submitted on the map.'
		));
	}
	
	public function onPrivacyPolicyNoticeDismissed()
	{
		$wpgmza_other_settings = get_option('WPGMZA_OTHER_SETTINGS');
		$wpgmza_other_settings['privacy_policy_notice_dismissed'] = true;
		update_option('WPGMZA_OTHER_SETTINGS', $wpgmza_other_settings);
		
		wp_send_json(array(
			'success' => 1
		));
		exit;
	}
	
	protected function getSettingsTabContent()
	{
		$wpgmza_other_settings = get_option('WPGMZA_OTHER_SETTINGS');
		
		$document = new DOMDocument();
		$document->loadPHPFile(plugin_dir_path(__DIR__) . 'html/gdpr-compliance-settings.html.php');
		
		$document->populate($wpgmza_other_settings);
		
		return $document;
	}
	
	public function getNoticeHTML()
	{
		$wpgmza_other_settings = get_option('WPGMZA_OTHER_SETTINGS');
		
		if(!$wpgmza_other_settings || empty($wpgmza_other_settings['wpgmza_gdpr_notice']))
			return '';
		
		$html = $wpgmza_other_settings['wpgmza_gdpr_notice'];
		
		$html = preg_replace('/{COMPANY_NAME}/i', $wpgmza_other_settings['wpgmza_gdpr_company_name'], $html);
		$html = preg_replace('/{RETENTION_PURPOSE}/i', $wpgmza_other_settings['wpgmza_gdpr_retention_purpose'], $html);
		
		$html = '<div class="wpgmza-gdpr-notice"><input type="checkbox" name="wpgmza_ugm_gdpr_consent" required/> ' . $html . '</div>';
		
		$html = apply_filters('wpgmza_gdpr_notice_html', $html);
		
		return $html;
	}
	
	public function getPrivacyPolicyNoticeHTML()
	{
		global $wpgmza;
		
		if(!empty($wpgmza->settings->privacy_policy_notice_dismissed))
			return '';
		
		return "
			<div id='wpgmza-gdpr-privacy-policy-notice' class='notice notice-info is-dismissible'>
				<p>" . __('In light of recent EU GDPR regulation, we strongly recommend reviewing the <a target="_blank" href="https://www.wpgmaps.com/privacy-policy">WP Google Maps Privacy Policy</a>', 'wp-google-maps') . "</p>
			</div>
			";
	}
	
	public function onGlobalSettingsTabs()
	{
		return "<li><a href=\"#wpgmza-gdpr-compliance\">".__("GDPR Compliance","wp-google-maps")."</a></li>";
	}
	
	public function onGlobalSettingsTabContent()
	{
		$document = $this->getSettingsTabContent();
		return $document->saveInnerBody();
	}
	
	public function onPOST()
	{
		$document = $this->getSettingsTabContent();
		$document->populate($_POST);
		
		$wpgmza_other_settings = get_option('WPGMZA_OTHER_SETTINGS');
		
		if(!$wpgmza_other_settings)
			$wpgmza_other_settings = array();
		
		foreach($document->querySelectorAll('input, select') as $input)
		{
			
			$name = $input->getAttribute('name');
			
			if(!$name)
				continue;
			
			switch($input->getAttribute('type'))
			{
				
				case 'checkbox':
					if(isset($wpgmza_other_settings[$name]))
						unset($wpgmza_other_settings[$name]);
					else
						$wpgmza_other_settings[$name] = 1;
					break;
				
				default:
					$wpgmza_other_settings[$name] = stripslashes( $input->getValue() );
					break;
				
			}
			
		}
		
		update_option('WPGMZA_OTHER_SETTINGS', $wpgmza_other_settings);
	}
}

$wpgmzaGDPRCompliance = new GDPRCompliance();
