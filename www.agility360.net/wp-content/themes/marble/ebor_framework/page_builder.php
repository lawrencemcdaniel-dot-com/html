<?php 

if(class_exists('AQ_Page_Builder')) {
	
	//UNREGISTER DEFAULT TABS
	aq_unregister_block('AQ_Text_Block');
	
	//UNREGISTER DEFAULT TABS
	aq_unregister_block('AQ_Tabs_Block');
	
	//UNREGISTER ALERT BLOCK
	aq_unregister_block('AQ_Alert_Block');
	
	//UNREGISTER RICH TEXT BLOCK
	aq_unregister_block('AQ_Richtext_Block');
	
	//UNREGISTER CLEAR BLOCK
	aq_unregister_block('AQ_Clear_Block');
	
	//REGISTER TABS
	if(!( class_exists('AQ_Ebor_Tabs_Block') )){
	require_once ( "page_builder_blocks/tabs_block.php" );
	aq_register_block('AQ_Ebor_Tabs_Block');
	}
	
	//REGISTER TEXT
	if(!( class_exists('AQ_Ebor_Text_Block') )){
	require_once ( "page_builder_blocks/text_block.php" );
	aq_register_block('AQ_Ebor_Text_Block');
	}
	
	//REGISTER ALERTS
	if(!( class_exists('AQ_Ebor_Alert_Block') )){
	require_once ( "page_builder_blocks/alert_block.php" );
	aq_register_block('AQ_Ebor_Alert_Block');
	}
	
	//REGISTER IMAGE
	if(!( class_exists('AQ_Ebor_Image_Block') )){
	require_once ( "page_builder_blocks/image_block.php" );
	aq_register_block('AQ_Ebor_Image_Block');
	}
	
	//PRICING TABLES
	if(!( class_exists('AQ_Pricing_Table_Block') )){
	require_once ( "page_builder_blocks/pricing_table_block.php" );
	aq_register_block('AQ_Pricing_Table_Block');
	}
	
	//TEAM
	if(!( class_exists('AQ_Team_Block') )){
	require_once ( "page_builder_blocks/team_block.php" );
	aq_register_block('AQ_Team_Block');
	}
	
	//SKILL BARS
	if(!( class_exists('AQ_Skills_Block') )){
	require_once ( "page_builder_blocks/skills_block.php" );
	aq_register_block('AQ_Skills_Block');
	}
	
	//Icon Columns
	if(!( class_exists('AQ_Icon_Column_Block') )){
	require_once ( "page_builder_blocks/icon_block.php" );
	aq_register_block('AQ_Icon_Column_Block');
	}
	
	//PORTFOLIO BLOCK
	if(!( class_exists('AQ_Portfolio_Block') )){
	require_once ( "page_builder_blocks/portfolio_block.php" );
	aq_register_block('AQ_Portfolio_Block');
	}
	
	//CLEARBLOCK
	if(!( class_exists('AQ_Ebor_Clear_Block') )){
	require_once ( "page_builder_blocks/clear_block.php" );
	aq_register_block('AQ_Ebor_Clear_Block');
	}
	
	//CLIENTS BLOCK
	if(!( class_exists('AQ_Clients_Block') )){
	require_once ( "page_builder_blocks/clients_block.php" );
	aq_register_block('AQ_Clients_Block');
	}
	
	//CAROUSEL BLOCK
	if(!( class_exists('AQ_Carousel_Block') )){
	require_once ( "page_builder_blocks/carousel_block.php" );
	aq_register_block('AQ_Carousel_Block');
	}
	
	//ONE PAGER - SECTION TITLE
	if(!( class_exists('AQ_Section_Title_Block') )){
	require_once ( "page_builder_blocks/section_title_block.php" );
	aq_register_block('AQ_Section_Title_Block');
	}
	
	//ONE PAGER - PARALLAX
	if(!( class_exists('AQ_Parallax_Block') )){
	require_once ( "page_builder_blocks/parallax_block.php" );
	aq_register_block('AQ_Parallax_Block');
	}
	
	//MAP
	if(!( class_exists('AQ_Map_Block') )){
	require_once ( "page_builder_blocks/map_block.php" );
	aq_register_block('AQ_Map_Block');
	}
	
	//BLOG
	if(!( class_exists('AQ_Blog_Block') )){
	require_once ( "page_builder_blocks/blog_block.php" );
	aq_register_block('AQ_Blog_Block');
	}
	
}