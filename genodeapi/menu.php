<?php
	// Menu Array
	$this->menulists =  
	array(
		'trinity'   =>  array('api/trinity',
						// Loop
						array(
							// Head functions
							'head'  =>  array(
											'api/trinity/head',
										// Functions	
										array(
											'SetTitle' => 'api/trinity/head/SetTitle',
											'SetPage' => 'api/trinity/head/SetPage',
											'SetAurthor' => 'api/trinity/head/SetAurthor',
											'SetURL' => 'api/trinity/head/SetURL',
											'SetKeywords' => 'api/trinity/head/SetKeywords',
											'SetDescription' => 'api/trinity/head/SetDescription',
											'SetJS' => 'api/trinity/head/SetJS',
											'GetJS' => 'api/trinity/head/GetJS',
											'SetCSS' => 'api/trinity/head/SetCSS',
											'GetCSS' => 'api/trinity/head/GetCSS',
										)
							),

							// Body functions
							'body' =>   array(
											'api/trinity/body',

										// Functions
										array(
											'UI' => array(
													'api/trinity/body/UI',
													array('ui_mobile_menu' => 
														array('api/trinity/body/UI/ui_mobile_menu',
														array('ui_mobile_menu_row' => 'api/trinity/body/UI/ui_mobile_menu/ui_mobile_menu_row')
													),
													'ui_mobile_menu_button' => 'api/trinity/body/UI/ui_mobile_menu_button',
													'ui_social_networks' => 'api/trinity/body/UI/ui_social_networks',
													'ui_slider' => 'api/trinity/body/UI/ui_slider',
													'ui_splash' => 'api/trinity/body/UI/ui_splash',
													'ui_item_box' => 'api/trinity/body/UI/ui_item_box',
													'ui_label_box' => array('api/trinity/body/UI/ui_label_box',
													array(
													'ui_label_box_row' => 'api/trinity/body/UI/ui_label_box/ui_label_box_row'
													)
													),
													'ui_table' => array('api/trinity/body/UI/ui_table',
													array(
													'ui_table_full_row' => 'api/trinity/body/UI/ui_table_box/ui_table_full_row',
													'ui_table_row' => 'api/trinity/body/UI/ui_table_box/ui_table_row'
													)
													),
													'ui_dual_button' => 'api/trinity/body/UI/ui_dual_button',
													'ui_menu' => array('api/trinity/body/UI/ui_menu',
													array(
													'ui_loop_menu' => 'api/trinity/body/UI/ui_label_box/ui_loop_menu'
													)
													),
													'ui_browser' => 'api/trinity/body/UI/ui_browser',
													'ui_timeline' => array('api/trinity/body/UI/ui_timeline',
													array(
													'ui_timeline_node' => 'api/trinity/body/UI/ui_label_box/ui_timeline_node'
													)
													),
													'ui_h_form' => 'api/trinity/body/UI/ui_h_form',
													'ui_pointer_title' => 'api/trinity/body/UI/ui_pointer_title',
													'ui_pointer_title' => 'api/trinity/body/UI/ui_pointer_title',
													'ui_dual_label' => array('api/trinity/body/UI/ui_dual_label',
													array(
													'ui_dual_label_row' => 'api/trinity/body/UI/ui_label_box/ui_dual_label_row'
													)
													),
													'ui_subscribe_box' => 'api/trinity/body/UI/ui_subscribe_box',
													'ui_smart_form' => array('api/trinity/body/UI/ui_smart_form',
													array(
													'ui_smart_form_row_inline' => 'api/trinity/body/UI/ui_label_box/ui_smart_form_row_inline',
													'ui_inicon_row' => 'api/trinity/body/UI/ui_label_box/ui_inicon_row',
													'ui_smart_form_row' => 'api/trinity/body/UI/ui_label_box/ui_smart_form_row',
													)
													),
													'ui_inlabel' => 'api/trinity/body/UI/ui_inlabel',
													'ui_toggle_menu' => 'api/trinity/body/UI/ui_toggle_menu',
													)
											),
											'Logic' => array(
											'api/trinity/body/Logic',
											array(
												'HiddenInput' => 'api/trinity/body/Logic/HiddenInput',
												'GetDevice' => 'api/trinity/body/Logic/GetDevice',
												'EmulateDevice' => 'api/trinity/body/Logic/EmulateDevice',
												'GetCurrentURL' => 'api/trinity/body/Logic/GetCurrentURL',
												'BaseURL' => 'api/trinity/body/Logic/BaseURL',
												'timer' => 'api/trinity/body/Logic/timer',
												'word_wrap' => 'api/trinity/body/Logic/word_wrap',
												'close_tags' => 'api/trinity/body/Logic/close_tags',
												'SanitizeURL' => 'api/trinity/body/Logic/SanitizeURL',
												'addUnderscoreBetween' => 'api/trinity/body/Logic/addUnderscoreBetween',
												'addHyphenBetween' => 'api/trinity/body/Logic/addHyphenBetween',
												'ColorIntensify' => 'api/trinity/body/Logic/ColorIntensify',
												'ColorInvert' => 'api/trinity/body/Logic/ColorInvert',
												'non_dynamic_url' => 'api/trinity/body/Logic/non_dynamic_url',
												'SelectRace' => 'api/trinity/body/Logic/SelectRace',
												'shuffle' => 'api/trinity/body/Logic/shuffle',
												'RaceList' => 'api/trinity/body/Logic/RaceList',
												'SelectProvince' => 'api/trinity/body/Logic/SelectProvince',
												'ProvinceList' => 'api/trinity/body/Logic/ProvinceList',
												'SelectOccupation' => 'api/trinity/body/Logic/SelectOccupation',
												'OccupationList' => 'api/trinity/body/Logic/OccupationList',
												'SelectGender' => 'api/trinity/body/Logic/SelectGender',
												'SelectTagArray' => 'api/trinity/body/Logic/SelectTagArray',
												'SelectTagNumRange' => 'api/trinity/body/Logic/SelectTagArray',
												'SelectYear' => 'api/trinity/body/Logic/SelectYear',
												'SelectMonth' => 'api/trinity/body/Logic/SelectMonth',
												'MonthList' => 'api/trinity/body/Logic/MonthList',
												'SelectDay' => 'api/trinity/body/Logic/SelectDay',
												'SelectedIndex' => 'api/trinity/body/Logic/SelectedIndex',
												'options' => 'api/trinity/body/Logic/options',
												'SelectTagNumIncrement' => 'api/trinity/body/Logic/SelectTagNumIncrement',
												'isLeapYear' => 'api/trinity/body/Logic/isLeapYear',
												'GetModifiedDate' => 'api/trinity/body/Logic/GetModifiedDate',
												'arraylize' => array('api/trinity/body/Logic/arraylize',
											array(
											'arraylizeIndent' => 'api/trinity/body/Logic/arraylize/arraylizeIndent',
											)
											),
											'isAssoc' => 'api/trinity/body/Logic/isAssoc',
											'fix_m_time' => 'api/trinity/body/Logic/fix_m_time',
											'grid' => 'api/trinity/body/Logic/grid',
											)
											),

											'DB' => array(
											'api/trinity/body/DB',
											array(
											'config' => 'api/trinity/body/DB/config',
											'encode' => 'api/trinity/body/DB/encode',
											'decode' => 'api/trinity/body/DB/decode',
											'fetch' => 'api/trinity/body/DB/fetch',
											'update' => 'api/trinity/body/DB/update',
											'insert' => array('api/trinity/body/DB/insert',
											array(
											'insertRow' => 'api/trinity/body/DB/insert/insertRow',
											)
											),
											'stringifySQL' => 'api/trinity/body/DB/stringifySQL',
											'SQLCondition' => 'api/trinity/body/DB/SQLCondition',
											'm_config' => 'api/trinity/body/DB/m_config',
											'm_SendEmail' => 'api/trinity/body/DB/m_SendEmail',
											'm_SendBulkEmails' => 'api/trinity/body/DB/m_SendBulkEmails',
											'm_ChooseThemeEmail' => 'api/trinity/body/DB/m_ChooseThemeEmail',
											'm_EmailDeveloper' => 'api/trinity/body/DB/m_EmailDeveloper',
											'm_DefaultTheme' => 'api/trinity/body/DB/m_DefaultTheme',
											'm_signature' => 'api/trinity/body/DB/m_signature',
											'm_PromotionTheme' => 'api/trinity/body/DB/m_PromotionTheme',
											'm_PromotionThemeSecond' => 'api/trinity/body/DB/m_PromotionThemeSecond',
											'm_PromotionThemeThird' => 'api/trinity/body/DB/m_PromotionThemeThird',
											)
											)
										)
							),

						'footer' => array('api/trinity/footer',
						array('ListFooter' => 'api/trinity/footer/ListFooter',
						'TrinityFooter' => 'api/trinity/footer/TrinityFooter')
						)
		)
		));
		}else{
		// menu array
		$this->menulist = array('Basic'            => 'basic',
		'User Interface'   => 'user-interface',
		'Logic'            => 'logic',
		'Database'         => 'database');
	}
?>