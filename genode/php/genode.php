<?php
  /**
	* @author         Praise Khumalo <praise@focalsoft.co.za>
	*
	* @project        Genode (Gene Code)
	*
	* @license        Copyright (c) 2015 - 2016 Genode [SA].Using this code without a granted permission from Focalsoft 
	*                  will be breach of Law.
	*
	* @description    This is an SDK which includes all PHP useful public functions we have written before
	*                 All public functions written below have been tested in various projects and they are
	*                 still open for adui_smart_form_row_inlinejustments. Genode is a still growing API that is meant to make development
	*                 far more easier and enjoyable. :) :)
	*
	* @why-genode     Genode is just the combination of Gene Code. Which says a lot about the alogorithms
	*                 within our API
	* 
	* @dependencies   Genode uses an external library called <mobileDetect> by Serban Ghita, Nick Ilyin and Victor Stanciu
	*                 Mobile Detect makes it easy for Genode to make mobile, tablet and desktop detection for us, which 
	*                 is very important for highly responsive web applications
	*
	* @version        2.0.0
    */

  # Device detection class
  include_once('mobileDetect.php');
  
  # include the db class
  include_once('db.php');
  
  class Genode extends DB
  { 
		/**
		  * @description:   Class constructor, it initiates all important functions and
		  *                 variables required for the smooth flow of our code execution
		  */
		public $modified,
			   $footertype,
			   $hoster,
			   $socialinks;
		
		private $detector;
		
		/**
		  * Author of the current application, this is found in the head metatags
		  */
		public $author = 'Praise Khumalo';

		/**
		  * CSS script
		  */
		public $CSSScript;

		/**
		  * Current url
		  */
		public $curl;

		/**
		  * Client's name
		  */
		public $client;

		/**
		  * Device being currently used to access this application
		  */
		public $device;

		/**
		  * Description of the current application, found in the head tag
		  */
		public $description = 'Website description here...';

		/**
		  * Footer list for footer 
		  */
		public $footerlist;

		/**
		  * Keywords describing the current application
		  */
		public $keywords = 'Put keywords here...';

		/**
		  * JS script
		  */
		public $JScript;

		/**
		  * Menu list for menu created with <ui_menu> function
		  */
		public $menulist;


		/**
		  * This array list pages that could be paginated by our page navigator
		  */
		public $pagenav;

		/**
		  * Current page being used
		  */
		public $page;

		/**
		  * Current version of Genode API
		  */
		public $version = '1.0.0';

		/**
		  * Makes sure facebook info is added when allowed by the developer
		  */
		public $FB_PARAM = false;

		public $fb_url;

		// Custom facebook pixel
		public $gb_fb_pixel = '';

		// Custom facebook app
		public $gb_fb_app = '';

		/**
		  * This is the default facebook image shown when sharing
		  */
		public $fb_image = 'images/ui/default-facebook.jpg';

		/**
		  * Date when Genode was first developed
		  */
		public $creation = '2015-05-21';

		public function __construct()
		{	 
			// construct the parent's constructor
			parent::__construct();
			
			// create a mobile detector class
			$this->detector =  new Mobile_Detect();
 			
			// get the last date the SDK was modified
			$this->modified = $this->GetModifiedDate();
			
			// get the current url
			$this->curl = $this->GetCurrentURL();
			
			// set base 
			$this->hoster = $this->GetBaseURL();
			
			// Set Facebook URL
			$this->fb_url = $this->getCurrentURL();

			// get the device used currently
			$this->device = $this->GetDevice();
			
			// set CSS files
			$this->dynamic_setter('SetCSS', 'genode/css/genode.css');
			$this->dynamic_setter('SetCSS', 'genode/css/jquery-ui.css');
			$this->dynamic_setter('SetCSS', 'genode/css/flipclock.css');

			// set javascript files
			$this->dynamic_setter('SetJS', 'genode/js/jquery.js');
			$this->dynamic_setter('SetJS', 'genode/js/jquery.form.js');
			$this->dynamic_setter('SetJS', 'genode/js/jquery-ui.js');
			$this->dynamic_setter('SetJS', 'genode/js/genode.js');
			$this->dynamic_setter('SetJS', 'genode/js/flipclock.js');
		}

		public function __call($method, $args)
		{
			$this->detector->$method($args);
		}

		/** 
		  * ---------------------------------- Central Section -------------------------------------- 
		  *
		  * @description        The following functions are responsible for basic structures of the
		  *                     the website namely, head, body, footer
		  */
		public function trinity()
		{				
			echo $this->head().
				 $this->body().
				 $this->footer();
		}
		
		/**
		  * ---------------------------------- Head Section -------------------------------------- 
		  *
		  * @description    This function builds the head section of our application, it includes all
		  *                 important information concerning the application.
		  */ 
		public function head($isBanner=true, $isNavigation=true)
		{
			// Set Image
			$this->title = str_replace('-', ' ', $this->title);

			$html = '
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="UTF-8" />
					<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

					<meta http-equiv="X-UA-Compatible" content="IE=9">
					<meta http-equiv ="content-type" content="text/html; charset=windows-1250"/>

					<meta name="keywords" content="'.$this->keywords.'">

					<meta name="description" content="'.$this->description.'">

					<meta name="author" content="'.$this->author.'" />

					<base href="'.$this->hoster.'" />
					
					<title>'. ucwords($this->title) .' - '.$this->client.'</title>
					
					<link rel="shortcut icon" href="images/ui/favicon.png" alt="logo" />
					
					'.$this->FB_META()
					 .$this->GetCSS()
					 .$this->gb_fb_pixel.'
				</head>
			<body>
				<div id="'.$this->device.'" class="device-used"></div>';

				// Add facebook app code if set
				if( strlen($this->gb_fb_app) && $this->gb_fb_app != '')
					$html .= $this->gb_fb_app;

				// Add Banner if required
				if( $isBanner ) $html .= $this->GetBanner();

			return $html;
		}
			/**
			  * This function returns the facebook important data if page is set
			  * for facebook
			  */
			public function FB_META()
			{
				// Check if facebook parameters are needed for the current page
				if( $this->FB_PARAM == true ){
					return '
					<!-- Open Graph meta tags -->
					<meta property="og:site_name" content="'.$this->client.'" />
					<meta property="og:url" content="'.$this->hoster.$this->fb_url.'" />
					<meta property="og:image" content="'.$this->hoster.$this->fb_image.'" />
					<meta property="og:title" content="'.ucwords($this->client.' - '.$this->title).'" />
					<meta property="og:description" content="'.$this->description.'" />';
				}
			}

			/**
			  * <description>  This function returns a sexy button that is devided into two. 
			  *                The first part is the icon and then the second part is the 
			  *                 button label
			  */
			public function GetBanner()
			{
				return '
				<div id="_g_banner_menu">
					<div class="dmsn cf">
						'.$this->ui_logo()
						 .$this->ui_menu().'
					</div>
				</div>'				
				.$this->ui_mobile_menu_button()
				.@$this->ui_mobile_menu();
			}
				/**
				  * <description>  This function returns a default logo
				  */
				public function ui_logo()
				{
					// Build logo 
					$html = '
					<div class="logo">
						<a href="./">';

							// Add the appropiate logo
							if($this->device == 'mobile')
								$html .= $this->client;
							else
								$html .= '
								<img src="images/ui/logo.png" alt="'.$this->client.' \'s logo" />';

					$html .= '
						</a>
					</div>';

					// Return to caller
					return $html;
				}

			/** 
			  * ---------------------------------- Head Mutator Functions -------------------------------------- 
			  *
			  * @ description       The following functions specialise in making settings in our predefined head modules / functions. 
			  */
			public function SetTitle($newtitle)
			{
				$this->title = $newtitle;
			}

			public function SetPage($newpage)
			{
				$this->page = $newpage;
			}

			public function SetAuthor($newAuthor)
			{
				$this->author = $newAuthor;
			}

			public function SetURL($newurl)
			{
				$this->url = $newurl;
			}
			
			public function SetKeywords($keywords)
			{
				$this->keywords = $keywords;
			}

			public function SetDescription($description)
			{
				$this->description = $description;
			}
			
			public function SetJS($file)
			{
				$this->JScript .= '<script type="text/javascript" src="'.$file.'"></script>';
			}
			
			public function GetJS()
			{					
				return $this->JScript;
			}
			
		    public function SetCSS($file)
			{
				$this->CSSScript .= '<link href="'.$file.'" rel="stylesheet" type="text/css" />';
			}
			
			public function GetCSS()
			{					
				return $this->CSSScript;
			}

			public function dynamic_setter($func, $url)
			{
				// find request url
				$REQUEST_URI = $_SERVER['REQUEST_URI'];

				// find the base url
				$BASE = explode('/', $REQUEST_URI);

				if( $this->isCMS() )
					$this->$func('../'.$BASE[1].'/../'.$url);
				else
					$this->$func($url);
			}

		/**
		  * ---------------------------------- Body Section -------------------------------------- 
		  *
		  * This function builds the body section of our application. This is where 
		  *  we add what is usually seen by the user. This function is very important
		  * for our application to run. We overrid the default function, in other to create a custom
		  * application for each project.
		  */
		public function body()
		{
			return 'Body Section';
		}			
			/** 
			  * ---------------------------------- UI Functions -------------------------------------- 
			  *
			  * This is a section within our API where all functions 
			  * contributing to the development of the user interface(UI) are located.
			  */

			public function ui_pricing_box($title, $price, $list, $link, $state=false, $label='Buy', $style='none')
			{
				// Put the appropiate link
				if($link == '' || $link == '#')
					$link = 'javascript:void(0)';

				$html = '
				<div class="ui-pricing-box '.$style.' '.$state.'">
					<div class="package-name">
						'.$title.'
					</div>';

					// Get the pure price without any string
					if(is_array($price))
					{
						// Find discount
						if($this->isAssoc($price))
						{
							list($discount, $price) = each($price);

							// Add discount 
							$html .= '<div class="discount">'.$discount.'% OFF</div>';
						}
						
						$html .= $this->ui_camel_prize($price[0], $price[1], $price[2]);

						$priceString = $price[0];
					}else{
						$html .= $this->ui_camel_prize($price, 'R', false);
						$priceString = $price;
					}

				$html .= '
					<div class="ui-line"></div>
					'.$this->ui_listfy($list).'
					<a href="'.$link.'">
						<button class="pill-rounding">
							'.$label.'
						</button>
					</a>
					<script>
						fbq(\'track\', \'ViewContent\', {
							value: '.$priceString.',
							currency: \'ZAR\'
						});
					</script>
				</div>';

				return $html;
			}

			/**
			  * This function builds the mobile menu which is passed as an associative array.
			  * If the menu array has not been passed, it then looks for the default menu, which 
			  * is stored in an array called <menulist>. <menulist> is heavily when setting a menu
			  * , usually in a desktop version, used by <ui_menu>. This function is usually shown when 
			  * <ui_mobile_menu_button> has been clicked by the user
			  */
			public function ui_mobile_menu($menu=array(), $visibility='hide')
			{
				// use default menu if it is not passed
				if(count($menu) <= 0) $menu = $this->menulist;
				
				$html = '
				<div class="ui-mobile-menu '.$visibility.' cf">';
					
					// loop all tabs
					while(list($label, $link) = each($menu))
						$html .= $this->ui_mobile_menu_row($label, $link);
					
				$html .= '
				</div>';
				
				return $html;
			}
				/**
				  * This function is each row of the mobile menu. It simple takes the label and the 
				  * url and return to the caller. It makes a row clickable
				  */
				public function ui_mobile_menu_row($label, $link)
				{
					if(is_array($link))
					{
						// randomise id
						$id = rand(1, rand(1, rand(1, 60))).'2p'.rand(5, 10);

						$html = '
						<li id="'.$id.'" class="ui-parent-menu">
							<a href="javascript:void(0)">'.$label.'</a>
						</li>
						<div id="'.$id.'-list" class="ui-parent-menu-list hide">
							'.$this->ui_mobile_menu($link, 'hide').'
						</div>';
					}else 
						$html = '
						<li id="'.$this->addHyphenBetween($label).'-tab">
							<a href="'.$link.'">'.$label.'</a>
						</li>';

					return $html;
				}
			
			/**
			  * This function returns a three lined menu button, usually used in mobile phones
			  * to represnt the menu, instead of the usually long horizontal menu. It is usually used with 
			  * <ui_mobile_menu> which list the menu.
			  */
			public function ui_mobile_menu_button()
			{
				return '
				<div class="ui-mobile-menu-button cf">
					<div></div>
					<div></div>
					<div></div>
				</div>';
			}

			/**
			  * This function create each passed social network icon for us, from Facebook to
			  * Linkedin. It makes it much more quicker and easier to add social buttons to the
			  * application that is being developed.
			  *
			  * $param $type {optional}
			  */
			public function ui_social_networks($rounding=false)
			{
				// show logo if it is not a mobile phone
				if($this->device != 'mobile')
				{
					$html = '
					<div class="ui-social-networks cf">';
						
							// loop all set social networks
							while(list($label, $url) = each($this->socialinks))
							{
								// customise the button based on the given link
								switch($label)
								{
									case 'Facebook': 
										 $class = 'facebook';
										 $content = 'f';
										 break;

									case 'Twitter': 
										 $class = 'twitter';
										 $content = 't';
										 break;

									case 'Instagram': 
										 $class = 'instagram';
										 $content = '<img src="genode/images/ui/instagram.ico" width="25px" />';	
										 break;

									case 'Google+'  : 
									case 'G+'       :
									case 'Google'   :
										 $class = 'googleplus';
										 $content = 'g+';
										 break;									 

									case 'Linkedin': 
										 $class = 'linkedin';
										 $content = 'in';
										 break;
										 
									default : continue;
								}
								
								// add button
								$html .= '
								<div class="'.$class.' '.$rounding.'">
									<a href="'.$url.'" target="_blank">
										'.$content.'
									</a>
								</div>';
							}
							
					$html .= '
					</div>';
					
					// return to the caller
					return $html;
				}
			}

			/** 
			  * This function creates a wing-shaped title. Title inbetween and lines on the
			  * on both sides, thus named 'Wing' title
			  *
			  * @param $dir, $list
			  */
			public function ui_wing_title($title, $id="default")
			{
				return '
				<div id="'.$id.'-wt" class="ui-wing-title cf">
					<div class="ui-line"></div>
					<div class="text">'.$title.'</div>
					<div class="ui-line"></div>
				</div>';
			}
			
			/** 
			  * This function builds us a slider which is linked with the javascript code. It is used for
			  * sliding images. It a very lightweight code
			  *
			  * @param $dir, $list
			  */

			public function ui_slider($list, $type='background')
			{
				$html = '
				<div class="ui-slider '.$type.' cf">
					<div class="wrapper cf">';
					
						// loop all images set 
						foreach($list as $slide){
							$html .= '
							<div class="slide cf">
								'.$slide.'
							</div>';
						}

					$html .= '
					</div>
				</div>';
				
				return $html;
			}

			public function ui_sliders($dir, $list)
			{
				// set a default directory if not set
				if(!isset($dir) && strlen($dir) <= 0){
					$dir = 'images/slider/';
				}
				
				$html = '
				<div class="ui-slider cf">';
					
					// loop all images set 
					foreach($list as $image){
						// add each image
						$html .= '<img src="'.$this->hoster.$dir.$image.'" />';
					}
					
				$html .= '
				</div>';
				
				return $html;
			}
			
			/**
			  * This function sets the content given as background instead
			  * of making it lay on the top as normal entity. This is very useful when you
			  * what to make sure that the image or background always fit, when being resized.
			  * We use {splashlist} array to set which background image appears at what page
			  */		
			public function ui_splash()
			{
				// initiations
				$screen = $content = $id = '';
				
				// build the appropiate screen
				while( list($url, $other) = each($this->splashlist) )
				{
					// it the current page matches then we start
					// building the screen
					if( $this->curl == $url )
					{
						// retrieve content of the splash 
						$img     = $other[0];
						$content = $other[1];

						// Get the id of the splash if set
						$id = (isset($other[2]))? $other[2] : 'default';
						
						// only but background image if it is available
						$screen = false;
						if( strlen($img) && $img != false )
							$screen = 'style="background:url(images/splash/'.$img.')"';
						
						// stop iteration, we have found what we are looking for
						break;
					}
				}
				
				// return to the caller
				return '
				<div id="'.$id.'-splash" class="ui-splash bck-cover cf" '.$screen.'>
					<div class="content dmsn cf">
						'.$content.'
					</div>
				</div>';
			}

			public function ui_splash_action_bar()
			{
				return '
				<div class="ui-splash-action-bar">
					<a href="auth">
						<button>
							MAKE A BOOKING
						</button>
					</a>
				</div>';	
			}

			/**
			  * This function is responsible contains the product or item being sold or exhibited.
			  * This is usually utilized when working with ecommerce websites and portfolio websites.
			  *
			  */
			public function ui_item_box($id, $title, $img, $link)
			{
				/* item type is the same as the title */ 
				$type = $title;
				
				/* check if the current item has been already selected or not */
				$class = false;
				$icon = 'like';
				if(isset($_SESSION['wishlist']))
				{
					$wishlist = $_SESSION['wishlist'];
				
					for($i = 1; $i < count($wishlist); $i++)
					{
						if($id == $wishlist[$i]){
							$class = 'active';
							$icon = 'liked';
							break;
						}
					}
				}
				
				return '
				<div class="ui-item-box cf">
					<a href="'.$this->hoster.$link.'">
						<div class="product cf">
							<img src="'.$img.'" alt="'.$title.'" />
						</div>
					</a>
					<div class="options cf">
						<div class="left">
							'.$this->word_wrap($title, 30).'
						</div>
						<div class="right">
							<button id="'.$id.'" class="'.$class.' one-rounding">
								ADD TO CART
							</button>
						</div>
					</div>
				</div>';
			}
			
			/**
			  *  This function builds us a very sexy "labelBox" which have many uses. 
			  *  You can set the title to be above the content or below, it up to you
			  *  as a developer. It respects the "black-box" approach, since it just 
			  *  show whatever you throw to it without any complains or refusals as long
			  *  you abide by its rules. 
			  */
			public function ui_label_box($title, $content, $type='', $style=array('top'), $id='label')
			{
				// position of the label or menu
				if(is_array($style))
					$position = $style[0];
				else
					$position = $style;

				// formulate id of this box 
				$boxId = (strlen($id) == 0)? $this->addHyphenBetween(strtolower($title)) : $id;

				// define title
				$titleHtml = '';
				if( $title != false ){
					$titleHtml = '
					<div class="title">
						<div>'
							.$title;

							// add arrow if it an accordion
							if($type == 'accordion')
								$titleHtml .= '<div id="'.$boxId.'" class="arrow up-arrow"></div>';

					$titleHtml .= '
						</div>
					</div>';
			    }
				
				// define content
				// first check if content is not an array
				if(is_array($content)){
					$_content = '';

					while(list($label, $url) = each($content))
						$_content .= $this->ui_label_box_row($url, $label);

					// copy new formatted content to the correct variable
					$content = $_content;
				}

				// finally add the appropiate content
				$contentHtml = '
				<div class="content cf">
					'.$content.'
				</div>';
				
				$labelBox = '
				<div id="'.$boxId.'-box" class="ui-label-box cf">';
					
					if($position == 'top'){
						$labelBox .= $titleHtml.$contentHtml;
					}else{
						$labelBox .= $contentHtml.$titleHtml;
					}

				$labelBox .= '
				</div>';
				
				return $labelBox;
			}
				/**
				  *  This function builds a row for the content supplied to <ui_label_box>. It 
				  *  uses <word_wrap> to restrict long words or titles.
				  */
				public function ui_label_box_row($link, $title, $active="", $jump="", $limit=40)
				{
					return '
					<a href="'.$this->hoster.$link.'" '.$jump.'>
						<div class="row '.$active.' cf">
							<div>
								<img src="genode/images/r-pointer.png" alt="right pointer">
								'.$this->word_wrap($title, $limit).'
							</div>
						</div>
					</a>';
				}
			
			/**
			 * This function is a lighweight version of the <grid>. It basically builds a table
			 * of rows and columns based on the amount of data we send to it. The data to be
			 * populated amongst the table, is sent as an array of arrays. Table (array) of
			 * rows (arrays). We can also add a title to the table we wish so
			 */
			public function ui_table($table, $block='2', $_content=array(), $id='ui-table', $rounding=false)
			{
				$html = '
				<div id="'.$id.'" class="ui-table '.$rounding.'">';
					
					// let check if extra content have been set or not
					$_is_contented = $content = false;
					$_content_pos = 'top';

					if( count($_content) > 0 ){
						$_is_contented = true;

						// get the position of the content
						$_content_pos = $_content[0];
						$content = $_content[1];
					}

					if($_is_contented && $_content_pos == 'top'){
						$html .= $this->ui_table_full_row($content, $_content_pos);
					}

					// loop all available rows
					foreach($table as $row){
						$id = rand(10, 25)-rand(0, 9).''.rand(1, 30).''.rand(0, 9).'-row';

						// Check if array is associative
						if( $this->isAssoc($row) ){
							list($id, $row) = each($row);
						}

						$html .= $this->ui_table_row($id, $row, $block);
					}

					if($_is_contented && $_content_pos == 'bottom'){
						$html .= $this->ui_table_full_row($content, $_content_pos);
					}
				
				$html .= '
				</div>';

				return $html;
			}	
				/**
				 * This function returns the undivided row with no columns for anything that might
				 * have been passed. It can vary from a simple label into a complex widget
				 */
				public function ui_table_full_row($content, $pos)
				{
					return '
					<div class="full '.$pos.' row">
						'.$content.'
					</div>';
				}

				/**
				 * This function builds a row for <ui_table>. Its is responsible to compose 
				 * number of columns given by the caller
				 */
				public function ui_table_row($id, $row, $block)
				{		
					$html = '
					<div id="'.$id.'" class="row block-'.$block.' cf">';
						
						// loop  through each cell
						foreach($row as $cell){
							// Initiate 'CellId'
							$CellId = rand(7, 15)-rand(1, 6).''.rand(1, 50).''.rand(0, 9).'-block';

							// check there is any settings given
							if( is_array($cell)){
								// Retrieve
								$CellId = $cell[0];
								$cell   = $cell[1];
							}

							// Build block
							$html .= '
							<div id="'.$CellId.'" class="block">
								<div>
									'.$cell.'
								</div>
							</div>';
						}
						
					$html .= '
					</div>';
					
					// return to the caller
					return $html;
				}

			/**
			  * This function returns a sexy button that is devided into two. 
			  * The first part is the icon and then the second part is the button label
			  */
			public function ui_dual_button($label, $link='#')
			{
				return '
				<a href="'.$link.'" class="ui-dual-button cf">
					<div class="icon">
						<img src="genode/images/r-full-pointer.png" alt="pointer" />
					</div>
					<div class="label">
						'.$label.'
					</div>
				</a>';
			}

			/**
			  * This function is amongst the CNS(Cornerstone) Functions, it is very important,
			  * because of its high usage amongst applications being developed with Genode.
			  * This function returns an already-set up menu. It can have dropdown menus. 
			  * Before calling the function, you make sure to set up the menu through an 
			  * array "menulist"
			  *
			  * <update: 31/10/16> The mobile menu button and mobile menu now incroporated on the 
			  *                    ui_menu
			  */
			public function ui_menu($menu=array())
			{
				$menu = (count($menu) > 0)? $menu : $this->menulist;

				return '
				<div class="ui-menu cf">
					'.$this->ui_loop_menu($menu).'
				</div>';
			}
				/**
				  * This function is the engine and the brains of <ui_menu>. All the entelligence of the menu 
				  * is located in this function. It decides when to build  proper menu or a dropdown.
				  */
				public function ui_loop_menu($menu=array(), $type=false)
				{
					// initiate
					$html = $drop_down = '';

					// loop all elements
					while(list($label, $url) = each($menu)) {	
						// form each element
						if(is_array($url))
						{
							// [1] -> Find out if we have to activate parent
							// [2] -> Find out if this is a group menu or not
							$class = $drop_down_type = '';
							while(list($label1, $url1) = each($url))
							{
								// Check if it is a group menu   
								if( is_array($url1)){
									$drop_down_type = 'group';

									// Activation Issue Solve Now!!
								}else{
									if($this->curl == $url1.'.php')
										$class = 'class="active-tab"';
								}
							}

							// Form Dropdown 
							if( $drop_down_type == 'group'){
								$html .= $this->ui_loop_group_menu($label, $url);

							}else{
								$drop_down = '
								<ul class="cf dropdown">
									'.$this->ui_loop_menu($url, 'dropdown').'
								</ul>';		

								$html .= $this->ui_menu_parent_tab($class, $label, $drop_down);
							}
							
						}else{					
							// find static url only
							$staticURL = $this->non_dynamic_url($url);   
							
							// Fix home
							if( strtolower($label) == 'home')
								$staticURL = 'index';

							// compose class based on the current url
							if($staticURL.'.php' == $this->curl || strtolower($this->page) == $this->addHyphenBetween(strtolower($label))){
								$class = 'active-tab';
								$pointer = '<div class="pointer"></div>';
								
							}else
								$class = $pointer = false;
							
							if( $url == '#' ){ 
								$url = 'Javascript:void(0)';

							}else{
								// check if the url is not an http
								if(strpos($url, 'http') === FALSE) $url = $this->hoster.$url;
							}

						    // add sexy letter boxes if it is a 'dropdown'
						    if( $type == 'dropdown' )
						    {
						    	// Get the first letter of the label
						    	$label = ucwords($label);
						    	$first_letter = $label[0];

								$html .= '
								<li class="'.$class.' cf" >
									<a href="'.$url.'"> 
										<div class="letter-box">
											'.$first_letter.'
										</div>
										<div class="label cf">
											'.$label.' 
										</div>
									</a>
								</li>';

						    }else{
						    	$id = $this->addHyphenBetween($label);

						    	// Build the appropiate shopping button
						    	if( $label == 'cart' && $this->store_cart_counter > 0)
						    		$label = 'checkout'.$this->ui_store_cart_counter();

						    	else if( $label == 'cart' )
						    		$label = $label.$this->ui_store_cart_counter();

								$html .= $this->ui_lia($pointer.$label, $url, $class, $id);
						    }
						}
					}

					// return to the caller
					return $html;
				}
					public function ui_lia($label, $url, $class="default", $id='default')
					{
						return '
						<li id="'.$id.'-tab" class="'.$class.' cf" >
							<a href="'.$url.'">
								'.$label.'
							 </a>
						</li>';
					}

					/**
					  * This function builds a grouped menu 
					  */
					public function ui_loop_group_menu($label, $menu)
					{
						// initiate
						$dropdown = array();
						$class = '';

						// Loop groups
						while(list($GroupLabel, $data) = each($menu)) 
						{
							// Let form groups
							$dropdown[] = '
							<ul class="cf">	
								<div class="title">
									'.ucwords($GroupLabel).'
								</div>
								<div class="list">
									'.$this->ui_loop_menu($data, 'dropdown').'
								</div>
							</ul>';	

							// find out if we have to activate parent
							if(strlen($class) == 0)
							{
								while(list($label1, $url1) = each($data))
								{
									if($this->curl == $url1.'.php')
										$class = 'class="active-tab"';
								}
							}
						}

						// Dropdown
						$dropdown_html = '
						<div class="dropdown-list">
							'.$this->grid($dropdown).'
						</div>';

						// return to the caller
						return $this->ui_menu_parent_tab($class, $label, $dropdown_html);
					}

					/**
					  * This function returns the parent tab 
					  */
					public function ui_menu_parent_tab($class, $label, $dropdown)
					{
						// Formulate id
						$id = strtolower( $this->addHyphenBetween($label) ).'-tab';

						return '
						<li id="'.$id.'" '.$class.'>
							'.$label.' 
							<div class="ui-dropdown-icon"></div>
							'.$dropdown.'
						</li>';
					}
			
			/**
			  *	The function returns a browser-like component to properly present
			  * what has been passed to the function
			  */
			public function ui_browser($url, $img)
			{
				// form full link
				$link = 'http://www.'.$url;
				
				return '			
				<div class="ui-browser five-half-top-rounding cf">
					<div class="operation-bar cf">
						<div class="circle-buttons">
							<div class="circle-rounding"></div>
							<div class="circle-rounding"></div>
							<div class="circle-rounding"></div>
						</div>
						<div class="address-bar four-rounding">
							<a href="'.$link.'" target="_blank">
								'.$link.'
							</a>
						</div>
					</div>
					<div class="project">
						<a href="'.$link.'" target="_blank">
							<img src="'.$img.'" />
						</a>
					</div>
				</div>';
			}
			
			/* Title */
			public function ui_title($title)
			{
				return '<div class="ui-title cf">'.ucwords($title).'</div>';
			}

			/**
			  *	The function returns a timeline presented in a sexy and more professional manner.
			  * Each row in an array passed, represent a node in a timeline
			  */
			public function ui_timeline($data)
			{
				$html = '
				<div class="ui-timeline">';
				
					while(list($year, $content) = each($data))
					{
						$html .= $this->ui_timeline_node($year, $content);
					}
					
				$html .= '
				</div>';
				
				return $html;
			}
				/**
				  *	The function returns each node of the timeline. That will be the circle (or any shape) on the left
				  * With a pointer and the details on the right
				  */
				public function ui_timeline_node($year, $content)
				{
					if(is_array($content))
						$content = $this->grid($content);
					
					return '
					<div class="ui-timeline-node cf">
						<div class="ui-timeline-left cf">
							<div class="time-period circle-rounding">
								'.$year.'
							</div>

							<div class="skeleton cf"></div>
							<div class="node circle-rounding"></div>
						</div>
						<div class="ui-timeline-right">
							<div class="ui-timeline-content cf">
								'.$content.'
							</div>
						</div>
					</div>';
				}
			
			/**
			  *	This function returns a horizontal form for us
			  */
			public function ui_h_form($formId, $array, $btnLabel="Submit", $rounding="three-rounding")
			{
				// get number of items
				$blockCount = count($array);
				$blocks     = array();
				
				// make sure the array are in same structure lin
				$array = array_merge($array);
				
				for($i = 0; $i < $blockCount; $i++){
					// get each block details
					$label = $array[$i][0];
					$type  = $array[$i][1];
					$name  = $array[$i][2];
					
					if(is_array($type)){
						$type = $this->SelectTagArray($name, $type);
					}elseif($type == 'textarea'){
						$type = '<textarea class="'.$rounding.'" name="'.$name.'" id="'.$name.'" ></textarea>';
					}else{
						$type = '<input type="'.$type.'" value="'.$label.'" name="'.$name.'" id="'.$name.'" class="'.$rounding.'"/>';
					}
					
					$blocks[] = '
					<div class="ui-form-input">
						'.$type.'
					</div>';
				}
				
				// add submit button
				$blocks[] = '
				<button class="three-rounding">
					'.$btnLabel.'
				</button>';
				
				return '
				<form id="'.$formId.'-form" class="ui-h-form four-rounding">
					<div class="ui-form-row cf">
						'.$this->grid($blocks).'
					</div>
				</form>';
			}
			
			/**
			  * This functions returns a pointer title that can used anywhere within
			  * our application. The pointed part is an image therefore when replacing
			  * color it must also be updated to look the same.
			  *
			  * @param $title
			  *
			  * @future  It must have position for pointers, top, left, right, bottom
			  */
			public function ui_pointer_title($title, $rounding=false)
			{
				return '
				<div class="ui-pointer-title '.$rounding.' cf">
					'.$title.'
					<div class="pointer"></div>
				</div>';
			}
			
			/** 
			  * This function build a very useful dual label box, that makes
			  * it possible for users to view different types of content in
			  * on box
			  */	
			public function ui_dual_label($firstLabel, $secondLabel, $text)
			{
				$html = '
				<div class="ui-dual-label-box">
					<div class="header cf">
						<div class="option active">
							'.$firstLabel.'
						</div>
						<div class="option">
							'.$secondLabel.'
						</div>
					</div>
					<div class="content">';
				
						// loop all rows
						$i = 1;
						while(list($title, $link) = each($text))
						{
							$html .= $this->ui_dual_label_row($i, $title, $link);
							$i++;
						}
					
				$html .= '
					</div>
				</div>';
				
				// return to the caller
				return $html;
			}
				/** 
				  * This is the row for < ui_dual_label>
				  */	
				public function ui_dual_label_row($num, $title, $link)
				{
					return '
					<a href="'.$link.'">
						<div class="row cf">
							<div class="number circle-rounding cf">
								'.$num.'
							</div>	
							<div class="title">
								'.$title.'
							</div>
						</div>
					</a>';
				}
			
			/** 
			  * This function returns a subscription box
			  */	
			public function ui_subscribe_box($form=array(), $title=false, $label='Subscribe')
			{
				/* prepare form content */
				$rounding = 'three-rounding';

				if(count($form) <= 0)
					$form = array(
						array('Email Address', 'text', 'email'),
					);
				
				$html = '
				<div class="ui-subscribe-box">';

					// Add title if needed
					if($title)
						$html .= '<div class="title">'.ucwords($title).'</div>';

				$html = $this->ui_smart_form('subscription', $form, 'one-in', $rounding, $label).'
				</div>';

				return $html;
			}
			
			/** 
			  * This function returns a form us with all the data that we instructed it to use.
			  * It allows us to build forms in different styles
			  *
			  * @param $formId, $form, $rowType, $rounding, $btnLabel
			  */
			public function ui_smart_form($formId, $form, $rowType, $rounding='', $btnLabel="Submit", $formType="default")
			{
				// Build the appropiate form
				if( is_array($formType)){
					$file = $formType[0];

					$html = '
					<form id="'.$formId.'-form" class="ui-form upload-file" action="'.$this->hoster.'processors/'.$file.'" method="post" enctype="multipart/form-data">';
				}else
					$html = '
					<form id="'.$formId.'-form" class="ui-form">';

					// loop all form rows
					foreach($form as $row) {
						// retrieve form values for each row
						$label = $row[0];
						
						if(is_array($label)){
							// loop all elements
							$elementCount = count($row);
							$elements     = array();
							
							foreach($row as $element)
							{
								// retrieve form values for each row
								$label = $element[0];
								$type  = $element[1];
								$name  = $element[2];

								// find the state
								$state = 'strict';
								if( isset( $element[3] ) ) $state = $element[3];

								// Small label
								$smallabel = false;
								if( isset( $element[4] ) ) $smallabel = $element[4];

								// Choose appropiate input
								if($rowType == 'inicon')
									$elements[] = $this->ui_inicon_row($label, $type, $name, $state, $element[5]);

								elseif($rowType == 'inline')
									$elements[] = $this->ui_smart_form_row_inline($label, $type, $name, $state,	$rounding);

								elseif($rowType == 'blob')
									$elements[] = $name;

								else
									$elements[] = $this->ui_smart_form_row($label, $type, $name, $state, $smallabel, $rounding);
							}
							
							$grid_name = (is_array($elements[0]))? 'grid' : $element[0];

							// Replace the following
							$key = array('<small>', '(', ')', '</small>', '/', '*', '-');

							for($i=0; $i<count($key); $i++)
								$grid_name = str_replace($key[$i], '', $grid_name);

							$grid_name = $this->addHyphenBetween(strtolower($grid_name));

							$html .= $this->grid($elements, $grid_name);
						}else{
							$type  = $row[1];
							$name  = $row[2];

							// find the state
							$state = 'strict';
							if( isset( $row[3] ) ) $state = $row[3];

							// Small label
							$smallabel = false;
							if( isset( $row[4] ) ) $row = $row[4];

							// Choose appropiate input
							if($rowType == 'inicon')
								$html .= $this->ui_inicon_row($label, $type, $name, $state, @$row[5]);

							else if($rowType == 'one-in' && $type != 'textarea') 
								$html .= $this->ui_smart_form_row_inline($label, $type, $name, $state, $rounding);

							else if($rowType == 'blob')
									$html .= $name;
							
							else
								$html .= $this->ui_smart_form_row($label, $type, $name, $state, $smallabel, $rounding);
						}
					}
					
				$html .= '
					<div class="ui-form-submit">
						<button class="'.$rounding.'">
							'.$btnLabel.'
						</button>
					</div>
				</form>';
				
				return $html;
			}		
				/** 
				  * This function builds a normal row which is called directly by < ui_smart_form >. It has 
				  * label and input or textarea below
				  */
				public function ui_smart_form_row($label, $type, $_name, $state, $smallabel, $rounding=false)
				{
					// Let check if the value is set or not
					if(is_array($_name)){
						$name  = $_name[0];
						$value = $_name[1];
					}else{
						$name  = $_name;
						$value = false;
					}
					
					// Prepare input
					if(is_array($type))
						$input = $this->SelectTagArray($name, $type, '', false, $state);

					elseif($type == 'select')
						$input = $name;

					elseif($type == 'button')
						$input = '
						<button class="'.$this->addHyphenBetween(strtolower($name)).'">'.$name.'</button>';

					elseif($type == 'blob')
						$input = $name;

					elseif($type == 'textarea')
						$input = '<div contentEditable="true" name="'.$name.'" id="'.$name.'" state="'.$state.'" class="'.$rounding.' textarea cf" >'.$value.'</div>';

					elseif($type == 'tcs')
						$input = $this->ui_tcs($name);

					elseif($type == 'hidden')
						$input = $this->HiddenInput($label, $name);

					else
						$input = '<input type="'.$type.'" name="'.$name.'" id="'.$name.'" state="'.$state.'" step="0.01" class="'.$rounding.'" value="'.$value.'" />';

					// Show small label
					if( strlen($smallabel) && $smallabel != false)
						$label .= '<small> ('.$smallabel.') </small>';

					// Hide div if it set
					$visibility = ($type == 'hidden')? 'hide' : 'show';

					$html = '
					<div id="'.$this->addHyphenBetween(strtolower($label)).'-row" class="ui-form-row '.$visibility.' cf">';

						// Only show if it is not hidden
						if($label != 'hidden'){
							$html .= '
							<div class="ui-form-label">
								'.$label.'
							</div>';
						}

					$html .= '
						<div class="ui-form-input">
							'.$input.'
						</div>
					</div>';

					return $html;
				}
					public function ui_tcs($text)
					{
						return '
						<div class="ui-tcs">
							<div class="content cf">
								'.$text.'
							</div>
							<div class="accept-block cf">
								<div> <input type="checkbox" id="accept-terms" /> </div>
								<div class="label"> Accept Terms and Conditions </div>
							</div>
						</div>';
					}

				/** 
				  * This function builds a very sexy row with an andriod-like look. It gives the developer
				  * an option to add an icon or not on the right side.
				  */
				public function ui_inicon_row($label, $type, $name, $state, $icon=false)
				{
					// Prepare input
					if(is_array($type))
						$input = $this->SelectTagArray($name, $type, '', false, $state);

					elseif($type == 'textarea')
						$input = '<textarea name="'.$name.'" id="'.$name.'" placeholder="'.ucwords($label).'" state="'.$state.'"></textarea>';

					elseif($type == 'tcs')
						$input = $this->ui_tcs($name);

					elseif($type == 'hidden')
						$input = '<input type="'.$type.'" name="'.$name.'" value="'.ucwords($label).'"  id="'.$name.'" state="'.$state.'"/>';

					else
						$input = '<input type="'.$type.'" name="'.$name.'" placeholder="'.ucwords($label).'" id="'.$name.'" state="'.$state.'"/>';

					// Compose id
					$id = $this->addHyphenBetween( strtolower($name) );

					$html = '
					<div class="ui-inicon-row cf">
						<div class="left">
							'.$input.'
						</div>';

						if( $icon != false ){
							// Find values of the icon
							$image  = $icon[0];
							$width  = $icon[1];
							$height = $icon[2];

							// Find the directory if set
							$dir = ( isset($icon[3]) )? $icon[3] : 'images/ui/';

							// Add icon
							$html .= '
							<div class="right">
								'.$this->ui_icon($image, $width, $height, $dir).'
							</div>';
						} 

					$html .= '
					</div>';

					return $html;
				}

				/** 
				  * This function is called directly by < ui_smart_form > to build an row with a label within the input or textarea.
				  * So to use this function you basiclly set, $rowType to be "one-in" when calling the < ui_smart_form >
				  */
				public function ui_smart_form_row_inline($label, $type, $name, $state, $rounding='')
				{
					if(is_array($type))
						$type = $this->SelectTagArray($name, $type, '', false, $state);

					elseif($type == 'textarea')
						$type = '<textarea placeholder="'.$label.'" name="'.$name.'" id="'.$name.'" state="'.$state.'" class="'.$rounding.'" ></textarea>';
					
					elseif($type == 'hidden')
						$type = $this->HiddenInput($label, $name);

					else
						$type = '<input type="'.$type.'" placeholder="'.$label.'" name="'.$name.'" id="'.$name.'"  state="'.$state.'" class="'.$rounding.'" autocorrect="off" autocapitalize="off" />';
					
					return '
					<div class="ui-form-row cf">
						<div class="ui-form-input '.$rounding.'">
							'.$type.'
						</div>
					</div>';
				}	
			
			/**
			  * This function returns input or textarea inlabel
			  */
			public function ui_inlabel($label, $type="text", $rounding='')
			{
				// formulate the appropiate tool-type
				if(is_array($type))
					$tool = $this->SelectTagArray($label, $type);
				elseif($type == "textarea")
					$tool = '<textarea id="ui-inlabel-'.strtolower($label).'"></textarea>';
				else
					$tool = '<input type="'.$type.'" id="ui-inlabel-'.strtolower($label).'" name="ui-inlabel-'.strtolower($label).'" />';
				
				// return to the caller
				return '
				<div class="ui-inlabel cf '.$rounding.'">
					<div class="label '.$rounding.'">
						'.$label.'
					</div>
					<div class="tool-type cf">
						'.$tool.'
						<div class="tag three-rounding">
							
						</div>
					</div>
				</div>';
			}
			
			/**
			  *	This function returns a toggle menu which changes content based at which
			  * tab we selected.
			  */
			public function ui_toggle_menu($label1, $label2, $rounding=false)
			{
				return '
				<div class="ui-toggle-menu three-rounding cf">
					<div id="'.$this->addHyphenBetween(strtolower($label1)).'" class="button '.$rounding.' ui-toggle-menu-active">
						'.$label1.'
					</div>
					<div id="'.$this->addHyphenBetween(strtolower($label2)).'" class="button '.$rounding.'">
						'.$label2.'
					</div>
				</div>
				<div class="toggle-menu-content cf">

				</div>';
			}

			/**
			  * This function returns a very 'sexy' frame label, with a transparent background
			  */
			public function ui_frame_label($label, $rounding="five-rounding")
			{
				return '
				<div class="ui-frame-label '.$rounding.'">
					'.ucwords($label).'
				</div>';
			}

			/**
			  *	This function is a layout for all prompt pages
			  */
			public function ui_prompt_page($content, $id='prompt-page')
			{
				return '
				<div id="'.$id.'-prompter" class="ui-prompt-page page">
					<div class="dmsn">
						<div class="jsponse"></div>	
						'.$content.'
					</div>
				</div>';
			}

			/**
			  * This function navigates all listed pages
			  */
			public function ui_page_navigator()
			{
				/* add navigation if set */
				if( (isset( $this->pagenav ) || count( $this->pagenav )))
				{
					/**
					 * [1] - Let convert an associative array into the ordinary array.
					 *       This is to make sure that we can index the array in numbers
					 */
					$i = 0;

					// initiate numberedArray 
					$numberedArray = array();
					while( list($label, $url) = each($this->pagenav) ){
						// add page details to the array
						$numberedArray[$i] = array($url, $label);

						// increment 'i'
						$i++;
					}

					/**
					 * [2] - Find 'next' page and the 'prev' page
					 */
					$pagecount = count( $numberedArray );

					// find next and the prev url
					$prev = $next = false;
					for($i = 0; $i < $pagecount; $i++)
					{
						// Retrieve each detail of the page, url and label
						$c_url   = $numberedArray[$i][0];
						$c_label = $numberedArray[$i][1];

						// If the current url matches the current 
						// iterated url
						if($c_url == "") $c_url = "index";

						//if( $this->curl == $c_url.'.php' ){
							// find the 'next' and 'prev' index
							$nextIndex = $i + 1;
							$prevIndex = $i - 1;

							// correct the indexing
							if( $prevIndex == -1 ) $prevIndex = $pagecount - 1;

							if( $nextIndex > $pagecount - 1 ) $nextIndex = 0;

							// find 'next' item and the 'prev' item
							$next = $numberedArray[ $nextIndex ];
							$prev = $numberedArray[ $prevIndex ];
						//}
					}

					// next page
					$nexturl = $next[0];
					$nextlabel = ucwords( $next[1] );

					// previous page
					$prevurl = $prev[0];
					$prevlabel = ucwords( $prev[1] );

					/**
					 * [3] - Return the 'html' will the 'next' button and 'prev'
					 *       button
					 */
					return '
					<div id="normal-ui-nav " class="ui-page-navigator cf">
						<a href="'.$prevurl.'" title="'.$prevlabel.'">
							<div class="left-button">
								'.strtoupper($prevlabel).'
							</div>
						</a>
						<a href="'.$nexturl.'" title="'.$nextlabel.'">
							<div class="right-button">
								'.strtoupper($nextlabel).'
							</div>
						</a>
					</div>';
				}
			}
				public function ui_button_nav($prevurl, $prevlabel, $nexturl, $nextlabel)
				{
					return '
					<div class="ui-page-button-navigator button-type">
						<a href="'.$prevurl.'" title="'.$prevlabel.' Page">
							<div class="left-button">
								<img src="genode/images/ui/l-stick-pointer.png" />
							</div>
						</a>
						<a href="'.$nexturl.'" title="'.$nextlabel.' Page">
							<div class="right-button">
								<img src="genode/images/ui/r-stick-pointer.png" />
							</div>
						</a>
					</div>';
				}

			/**
			 * ---------------------------------- Lightwindow Functions -------------------------------------- 
			 *	This function returns a lightwindow that can be used for notifications or
			 *  even taking emails from users.
			 */
			public function ui_lightwindow($content, $title=false, $id="default", $visibility='hide', $rounding=false)
			{
				$html = '
				<div id="'.$id.'-lightwindow" class="ui-lightwindow cf pc-ui-lightwindow '.$visibility.'">
					<div class="foreground '.$rounding.'">';

						// add title if set
						if( $title != false ){
							$html .= '
							<div class="title three-rounding">
								'.$title.'
								<div class="lightwindow-close circle-rounding">
									X
								</div>
							</div>';
						}

				$html .= '
						<div class="content">
							'.$content.'
						</div>
					</div>
					<div class="background"></div>
				</div>';

				return $html;
			}

			public function ui_page_lightwindow($content, $title=false, $id="default", $visibility='hide', $rounding='three-rounding')
			{
				$html = '
				<div id="page-lightwindow" class="ui-lightwindow cf '.$visibility.'">
					<div class="foreground '.$rounding.'">';

						// add title if set
						if( $title != false ){
							$html .= '
							<div class="title three-rounding">
								'.$title.'
							</div>';
						}

				$html .= '
						<div class="content">
							'.$content.'
						</div>
					</div>
					<div class="back-button">';

						// previous page
						$prev = $_SERVER["HTTP_REFERER"];
						
				$html .= '
						<a href="'.$prev.'">
							<button>
								<< &nbsp Back
							</button>
						</a>
					</div>
				</div>';

				return $html;
			}

			/**
			 *  This function  returns an icon 
			 */
			public function ui_icon($icon, $width, $height, $dir='images/ui/', $id="ui-icon")
			{
				// Construct an instyle
				$instyle = 'style="width:'.$width.'px; height:'.$height.'px; background:url('.$dir.$icon.')"';

				// return to the caller
				return '<div id="'.$id.'" class="ui-icon" '.$instyle.'></div>';
			}	

			/**
			 *  This function builds a title box that has no background, very stylish
			 */
			public function ui_ctru_title($title, $id="default")
			{
				return '
				<div id="'.$id.'-ctru-box" class="ui-ctru-box cf">
					'.$title.'
				</div>';
			}

			public function ui_ctru_btn($title, $link='#', $id='default')
			{
				return '
				<a href="'.$link.'">
					<div id="'.$id.'-ctru-box" class="ui-ctru-box cf">
						'.$title.'
					</div>
				</a>';
			}

			/**
			 *  <ui-focalsoft-logo> compose our company logo
			 */
			public function ui_focalsoft_logo($img='genode/images/ui/logo.png')
			{
				return '
				<a href="'.$this->hoster.'">
					<div class="ui-focalsoft-logo cf">
						<div class="left">
							<img src="'.$img.'" alt="focalsoft logo" />
						</div>
						<div class="right">
							<div class="brand-name">
								<span class="bold">FOCAL</span>SOFT
							</div>
							<div class="tag">
								BUSINESS <span class="orange">SOLUTIONS</span>
							</div>
						</div>
					</div>
				</a>';
			}

			/**
			 *  <ui-focalsoft-small-logo> compose our company logo
			 */
			public function ui_focalsoft_small_logo()
			{
				return '
				<a href="'.$this->hoster.'">
					<div class="ui-focalsoft-small-logo cf">
						FS
					</div>
				</a>';
			}

			/**
			 *  Focalsoft Made trademark
			 */
			public function ui_focalsoft_made()
			{
				return '
				<a href="http://focalsoft.co.za">
					<div class="ui-focalsoft-made cf">
						<span class="bold">Focalsoft</span> Made
					</div>
				</a>';
			}

			/**
			 *  This function returns an image encircled
			 */
			public function ui_circle_image($image, $title)
			{
				return '
				<div class="ui-circle-image circle-rounding cf">
					<div class="image cf">
						<img src="images/'.$image.'" alt="'.$title.'" />
					</div>
				</div>';
			}

			/**
			 *  This function returns a closing cross
			 */
			public function ui_close_cross()
			{
				return '<div class="ui-close-cross circle-rounding"> X </div>';
			}

			/**
			 *  This function returns a Roboto Slab
			 */
			public function ui_rs_title($title, $liner=false)
			{
				$html = '
				<div class="ui-rs-title">
					'.$title;

					// Add liner if allowed
					if($liner)
						$html.= '
						<div class="double-liner"></div>';

				$html .= '
				</div>';

				return $html;
			}

			/**
			 *  This function returns a numbered list
			 */
			public function ui_numbered_list($array)
			{
				$html = ' 							
				<div class="ui-numbered-list">';

					// Loop All Benefits
					for($i = 0; $i < count($array); $i++)
						$html .= $this->numberRow( $i+1, $array[$i] );

				$html .= '
				</div>';

				return $html;
			}
				public function ui_number_row($num, $text)
				{
					return '
					<li class="cf">
						<div class="circle-rounding number">
							'.$num.'
						</div>
						<div class="label">
							'.$text.'
						</div>
					</li>';
				}

			/**
			 *  This function returns a cameled styled prize, small currencty letter(s) and prize big
			 */
			public function ui_camel_prize($prize, $currency='R', $ending='P/M'){
				return '
				<div class="ui-camel-prize cf">
					<small>'.$currency.' </small>'.$prize.'<small> '.$ending.'</small>
				</div>';
			}

			/**
			 * This function lists all given list
			 */
			public function ui_listfy($list, $type='ul')
			{
				$html = '
				<'.$type.' class="ui-custom-list">';
				
					// List all available lists
					for($i = 0; $i < count($list); $i++)
						$html .= '<li>'.$list[$i].'</li>';

				$html .= '
				</'.$type.'>';

				return $html;
			}

			/**
			 * This function returns information strip
			 */
			public function ui_infostrip($title)
			{
				return '
				<div class="ui-info-strip">
					<div class="dmsn">
						'.ucwords($title).'
					</div>
				</div>';
			}

			/**
			 * This function highlight the text given
			 */
			public function ui_highlight($text, $id="default")
			{
				return '
				<div id="'.$id.'-hl" class="ui-highlight cf">
					<span>'.$text.'</span>
				</div>';
			}

			/**
			 * This function builds summary div aka sumdiv
			 */
			public function ui_sumdiv($sumdiv, $type="plain", $i=1)
			{
				$html = '
				<div class="sumdiv cf">';

					// Check the layout style of the sumdiv
					if( $this->isAssoc($sumdiv) )
					{
						foreach($sumdiv as $title => $data){
							// Find the state of 'alt'
							$state = ($i % 2 == 0)? 'alt' : false;

							// Add row
							$html .= $this->sumdiv_engine($data, $state, $type, $title);

							// Increment
							$i++;
						}

					}else{
						foreach($sumdiv as $data){
							// Find the state of 'alt'
							$state = ($i % 2 == 0)? 'alt' : false;

							// Add row
							$html .= $this->sumdiv_engine($data, $state, $type);

							// Increment
							$i++;
						}
					}

				$html .= '
				</div>';

				return $html;
			}

			public function sumdiv_engine($data, $state, $type, $title='')
			{
				// Retrieve data from array
				$left  = $data[0];
				$right = $data[1];

				// Add the appropiate row
				if($type == 'bck'){
					// Retrieve image
					$img   = $data[2];
					return  $this->ui_sumdiv_bck_row($left, $right, $img, $state, $title);

				}else{
					return $this->ui_sumdiv_row($left, $right, $state, $title);
				}
			}
				public function ui_sumdiv_row($left, $right, $state, $title="")
				{
					$alt = false;
					if($state == 'alt'){
						// Swap
						$temp  = $right;
						$right = $left;
						$left  = $temp;

						$alt = 'alt';
					}

					$html = '
					<div class="row '.$alt.' cf">';

						if(strlen($title) > 0)
						{
							$html .= '
							<div class="title cf">
								'.ucwords($title).'
							</div>';
						}

					$html .= '
						<div class="content cf">
							<div class="left">
								<div class="content-box">
									'.$left.'
								</div>
							</div>
							<div class="right">
								<div class="content-box">
									'.$right.'
								</div>
							</div>
						</div>
					</div>';

					return $html;
				}

				public function ui_sumdiv_bck_row($left, $right, $img, $state)
				{
					if($state != 'alt')
						$html = '
						<div class="row cf">
							<div class="content cf">
								<div class="left bck-cover" style="background:url(images/'.$img.')">
									<div class="content-box">
										'.$left.'
									</div>
								</div>
								<div class="right">
									<div class="content-box">
										'.$right.'
									</div>
								</div>
							</div>
						</div>';
					else
						$html = '
						<div class="row cf">
							<div class="content cf">
								<div class="left">
									<div class="content-box">
										'.$right.'
									</div>
								</div>
								<div class="right bck-cover" style="background:url(images/'.$img.')">
									<div class="content-box">
										'.$left.'
									</div>
								</div>
							</div>
						</div>';

					return $html;
				}

				public function ui_image_text($img, $text, $pos='top')
				{
					// Prepare image and text
					$image = '
					<div class="image">
						<img src="images/'.$img.'" />
					</div>';

					$text = '
					<div class="text">
						'.$text.'
					</div>';

					// Start building html
					$html = '
					<div id="_g_image_text" class="ui-image-text">';

						if($pos == 'top')
							$html .= $image.$text;
						else
							$html .= $text.$image;
					$html .= '
					</div>';

					return $html;
				}

			/** 
			  * ---------------------------------- Logic Functions -------------------------------------- 
			  *
			  * This section of our API, is what is considered to be the brains of any application
			  * that we build with our beloved Genode. They do intensive calaculations making our
			  * applications a little bit more intuitive and smart.
			  */

			/**
			  *
			  * This function builds a progress line that track the progress of the
			  * user as they fill a form or play a game.
			  *
			  * @param $steps
			  */
			public function BuildProgressLine($steps)
			{
				// Initiate
				$html = '';
				$state = array('active');
				$marker = 0;

				// Loop
				for($i = 1; $i < count($steps); $i++)
				{
					// Get the current step as a label
					$label = $steps[$i];

					// Check if the GET header for steps is set
					if( isset($_GET['p']) ){
						// Current step
						$step = strtolower($_GET['p']);

						// Current label
						$c_label = $this->addHyphenBetween( strtolower($label) );
						
						if($step == $c_label){
							$state[] = 'active';
							$marker = $i;

							// Break 'for loop'
							break;
						}else
							$state[] = 0;
					}
				}

				// Highlight the previous steps
				for($i = 0; $i < $marker; $i++)
					$state[$i] = 'active';

				// fill the rest with nothing
				for($i = $marker+1; $i < count($steps); $i++)
					$state[$i] = false;

				for($i = 0; $i < count($steps); $i++){
					// Current Label
					$label = $steps[$i];

					// Add each step
					$html .= $this->_ProgressLineStep($i+1, $label, $state[$i]);
				}

				// Return to the caller
				return '
				<div class="ui-step-menu">
					'.$html.'
				</div>';
			}
				/**
				  *
				  * This function is the child of a progress line that tracks the progress of the
				  * user as they fill a form or play a game.
				  *
				  * @param $num, $label, $state
				  */
				public function _ProgressLineStep($num, $label, $state=false)
				{
					return '
					<div class="step '.$state.'">
				 		<div class="num circle-rounding">
				 			'.$num.'
				 		</div>
				 		<div class="label">
				 			'.ucwords($label).'
				 		</div>
				 	</div>';
				}

			/**
			  *
			  * This function helps us hide any kind of information by simple passing the
			  * the "name" and the "value" to read later.
			  *
			  * @param $name, $value
			  */
			public function HiddenInput($name, $value) 
			{
				return '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$value.'" />';
			}
			
			/**
			  * This function is heavily used when checking what kind of device is currently
			  * used by the user. Knowing what kind of device is important since we can then
			  * add or remove certain features based on the capabilities of that device
			  *
			  */
			public function GetDevice()
			{
				if(isset($_SESSION['device'])){
					return $_SESSION['device'];
				}else{
					// get mobile dect object
					$device  = new Mobile_Detect();
					
					if($device->isMobile())
						return 'mobile';
					else if($device->isTablet())
						return 'tablet';
					else
						return 'desktop';
				}
			}

			/**
			  * This function allows us to emulate a device. This is used in development
			  * than in production
			  *
			  */
			public function EmulateDevice($device)
			{
				$this->device = $device;
			}
			
			/**
			  * This function returns the current URL of the application.
			  */
			public function GetCurrentURL($ext = false)
			{
				$URL      = $_SERVER['SCRIPT_NAME'];
				$URLArr   = explode('/', $URL);

				$lastIndex = count($URLArr) - 1;
				$scriptURL = $URLArr[$lastIndex];

				$scriptURLArray  = explode('.', $scriptURL);
				
				return ($ext)? $scriptURL : $scriptURLArray[0];
			}
			
			/**
			  * This function returns the appropiate base URL, it checks if there is a custom
			  * base given by the developer if not, it returns the appropiate base url from <BaseURL>
			  */
			public function GetBaseURL()
			{
				if(isset($this->hoster) && strlen($this->hoster) > 0)
					return $this->hoster;
				else
					return $this->BaseURL();
			}

			/**
			  * This function return the base URL whether we are local or online
			  */
			public function BaseURL($child=false)
			{
				if( $this->isLocal() )
				{
					// find request url
					$REQUEST_URI = $_SERVER['REQUEST_URI'];

					// find the base url
					$BASE = explode('/', $REQUEST_URI);

					// form base ur;
					$BASE_URI = 'http://127.0.0.1/'.$BASE[1].'/';

					// now see if we opening a CMS page
					if( $this->isCMS() == TRUE && !$child )
						$BASE_URI .= 'base/';

					// return to the caller
					return $BASE_URI;

				}else
					return 'http://www.'.$this->domain.'/';
			}

			/**
			  * This function checks if our webpage or application is hosted locally
			  * or on the live cloud server
			  */
			public function isLocal()
			{
				// array of our nameserves
				$whitelist = array('localhost', '127.0.0.1');
				
				// return to the caller
				return ( in_array($_SERVER['HTTP_HOST'], $whitelist) )? true : false;
			}

			/**
			  * This function checks if the current page is part of the CMS given by the 
			  * developer, by default our CMS 
			  */
			public function isCMS($cms='')
			{
				// by default our CMS 
				$cms = ( strlen($cms) > 0 )? $cms : 'base';

				return strpos($_SERVER['REQUEST_URI'], $cms);
			}

			/**
			  * This function return the base URL whether we are local or online
			  */
			public function SetBaseURL($new_base)
			{
				$this->hoster = $new_base;
			}

			/**
			  * The following function get the base url with no extention. This function
			  * still need development. It is too basic and unreliable
			  */
			public function BaseScript($url)
			{
				$url = explode('.', $url);
				return $url[0];
			}

			/**
			  * This function help us get time elapsed in seconds, minutes, hours, days, months to years between the given times
			  * It a very powerful function
			  *
			  * @param $time1, $time2
			  */
			public function timer($time1, $time2='')
			{
				$time2 = (strlen($time2))? $time2 : time();         // set the second timestap, by default it time()
				$time  = $time2 - $time1;                           // get the time elapsed inbetween
			   
			   // set tokens
				$tokens = array(
					31536000     => 'year',
					2592000      => 'month',
					604800       => 'week',
					86400        => 'day',
					3600         => 'hr',
					60           => 'min',
					1            => 'second'
				);
			   
				foreach($tokens as $unit => $text)
				{
					if($time < $unit) continue;
					$numberOfUnits = floor($time / $unit);
					
					// return to the caller
					return $numberOfUnits.' '.$text.(($numberOfUnits > 1)? 's' : '');
				}
			}
			
			/**
			  * This wraps any sentence and put ellipses if the length of the passed
			  * sentence is greater than the given "limit" [default: 40]
			  */
			public function word_wrap($txt, $limit=40, $marker=false)
			{
				// convert this text into a string
				$txt        = (string)$txt;
				$txt_length = strlen($txt);
				
				if($txt_length > $limit)
				{
					// new empty sanitized sentence
					$sanitized = '';
					
					for($i = 0; $i < $limit; $i++){
						$sanitized .= $txt[$i];
					}
					
					// wrap
					$sanitized = $sanitized.'...';

					// form a string
					$str = strip_tags($sanitized).$marker;
					
					return $str;
				}else{
					return $txt;
				}
			}
			
			/**
			  * This functions wrap all unclosed tags. 
			  */
			public function close_tags($html)
			{
				#put all opened tags into an array
				preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
				$openedtags = $result[1];
				
				#put all closed tags into an array
				preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
				$closedtags = $result[1];
				$len_opened = count ( $openedtags );
				
				# all tags are closed
				if( count ( $closedtags ) == $len_opened )
				{
				return $html;
				}
				$openedtags = array_reverse ( $openedtags );
				
				# close tags
				for( $i = 0; $i < $len_opened; $i++ )
				{
					if ( !in_array ( $openedtags[$i], $closedtags ) )
					{
					$html .= "</" . $openedtags[$i] . ">";
					}
					else
					{
					unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
					}
				}
				return $html;
			}
			
			/**
			  * This function cleans the url and make it seo friendly
			  */
			public function SanitizeURL($url)
			{
				// make sure every letter is lower case
				// start by removing all weird characters
				$url = strtolower(preg_replace("/[^a-zA-Z0-9 ]/", "", $url));
				
				// then add hyphens in between
				$url = $this->addHyphenBetween($url);
				$url = str_replace('--', '-', $url);     /* lil bit redundant but important */
				
				// return to the caller
				return $url;
			}

			/**
			  * Add underscore in between the word passed. Spaces are replaced by underscores
			  */
			public function addUnderscoreBetween($phrase)
			{
				// let explode the phrase by [ space ] inbetween
				$phrase_array = explode(' ', $phrase);
				$new_phrase   = $phrase_array[0];

				for($i = 1; $i < count($phrase_array); $i++)
					$new_phrase .= '_'.$phrase_array[$i];

				return $new_phrase;
			}
			
			/**
			  * Add hyphen in between the word passed. Spaces are replaced by hyphen
			  */
			public function addHyphenBetween($phrase)
			{
				// let explode the phrase by [ space ] inbetween
				$phrase_array = explode(' ',$phrase);
				$new_phrase = $phrase_array[0];

				for($i = 1; $i < count($phrase_array); $i++):
					$new_phrase .= '-'.$phrase_array[$i];
				endfor;

				return $new_phrase;
			} 
			
			/** 		  
			  * This function is responsible for intensifying color passed.
			  * To make color darker use negative number 
			  */
			public function ColorIntensify($color, $level=0)
			{
				// find the position where # exist in the given color
				$position = strpos($color, '#');
				
				// initiate new color
				$newColor = ($position !== false)? explode('#', $color)[1] : $color;

				// double the color if it triples
				if(strlen($newColor) == 3){ $newColor .= $newColor; }
				
				$tempColor = '';
				
				for($i = 0; $i < 6; $i++)
				{
					// get the decimal number of each letter or number
					$digicolor = hexdec($newColor[$i]);
					
					// intensify by the given "level"
					$digicolor += $level;
					
					// convert digicolor back to hexidecimals
					// if less than 0, then it becomes o
					if($digicolor > -1 && $digicolor < 16)
						$digicolor = dechex($digicolor);
					elseif($digicolor > 15)                       // code does not convert to hexidecimal F, appropiately <dechex>
						$digicolor = 'f';
					else
						$digicolor = '0';
					
					$tempColor .= strtolower($digicolor);
				}
				
				return '#'.$tempColor;
			}
			
			/** 		  
			  * This function is responsible for inverting each color given.
			  *	It gives the opposite of the given color
			  *
			  */
			public function ColorInvert($color)
			{
				// find the position where # exist in the given color
				$position = strpos($color, '#');
				
				// initiate new color
				$newColor = ($position !== false)? explode('#', $color)[1] : $color;

				// double the color if it triples
				if(strlen($newColor) == 3){ $newColor .= $newColor; }
				
				$tempColor = '';
				
				for($i = 0; $i < 6; $i++)
				{
					// get the decimal number of each letter or number
					$digicolor = hexdec($newColor[$i]);
					
					// invert and convert to hexidecimals
					$digicolor = dechex(15 - $digicolor);
					
					// make sure it lower case (self-preference)
					$tempColor .= strtolower($digicolor);
				}
				
				return '#'.$tempColor;
			}	
			
			/**
			  * This function returns the root url leaving away the dynamic part
			  */
			public function non_dynamic_url($url)
			{
				return explode('?', $url)[0];
			}

			public function stringify_url($url)
			{
				$data = explode('/', $url);
				$last = @$data[1];

				// Check if it has a number
				if($last != NULL)
				{
					$last = (int)$last;

					if( is_int($last) ) $url = $data[0];
				}

				// Return to the caller
				return $url;
			}
			
			/**
			  * This function shuffles elements in random positions
			  */
			public function shuffle($array) 
			{
				$i = count($array);
				while(--$i) {
					$j = mt_rand(0, $i);

					if ($i != $j) {
						// swap elements
						$tmp = $array[$j];
						$array[$j] = $array[$i];
						$array[$i] = $tmp;
					}
				}

				return $array;
			}

			/**
			  * @description:   The following functions are all <selector> functions. They are simple
			  *                 to understand. -> selectRace()
			  *                                -> selectJob()
			  *                                -> SelectProvince()
			  *                                -> SelectOccupation()
			  *                                -> SelectGender()
			  *
			  * @dependancies   The following functions all depend intensely in <SelectTagArray>
			  */

			/**
			 * This function returns a selector for the available races
			 */
			public function SelectRace()
			{
				return $this->SelectTagArray('race', $this->RaceList());
			}

			/**
			 * This function returns a list of human races
			 */
			public function RaceList()
			{
				return array('african', 'chinese', 'coloured', 'indian', 'white');
			}

			/**
			 * This function returns a selector of all available provinces in South Africa
			 *
			 * @param $name
			 */
			public function SelectProvince($name='province')
			{
				return $this->SelectTagArray($name, $this->ProvinceList());
			}	

		    /**
			 * This function returns a list of all provinces
			 */
			public function ProvinceList()
			{
				return array('Province', 'Eastern Cape', 'KZN', 'Gauteng', 'Western Cape', 'Mpumalanga',
				             'Limpompo', 'North West', 'Free State', 'Northen Cape');
			}
			
			/**
			 * This function returns a selector of occupations 
			 *
			 * @param $name
			 */
			public function SelectOccupation($name='occupation')
			{
				return $this->SelectTagArray($name,  $this->OccupationList());
			}
			
			/**
			 * This function returns a list of occupations 
			 */
			public function OccupationList(){
				return  array('occupation', 'employed', 'unemployed', 'student', 'graduate');
			}
			
			/**
			 * This function returns a selector of gender 
			 */
			public function SelectGender()
			{
				return $this->SelectTagArray('gender', array('gender', 'female', 'male'));
			}
			
			/**
			  * Most functions relies on this function very much. It is powerful
			  * because it checks for a Get[] header to see if it matches one of the children
			  * in the list. If it does, then it selects it for us.
			  *
			  * @param $name, $array, $selected='', $class
			  */
			public function SelectTagArray($name, $array, $selected='', $class=false, $state='strict')
			{
				$selected = (strlen($selected))? $selected : $this->SelectedIndex($name, $array);
				$selected = strtolower($this->addHyphenBetween($selected));
				
				// make sure "$name" is lower case
				$name = strtolower($name);
				
				// form the html
				$html = '
				<select id="'.$name.'" name="'.$name.'" class="'.$class.'" state="'.$state.'" >';

					// Let check if the array is associative
					if( $this->isAssoc($array) )
					{
						foreach($array as $valueOption => $value){
							$selectedMark = (strtolower($this->addHyphenBetween($value)) == $selected)? 'selected' : false;
							
							$html .= '<option value="'.$valueOption.'" '.$selectedMark.' >'.ucwords($value).'</option>';
						}

					}else{
						foreach($array as $value){
							if(is_array($value)){
								$selectedMark = 'selected';
								$value = $value[0];
							}else
								$selectedMark = (strtolower($this->addHyphenBetween($value)) == $selected)? 'selected' : false;
							
							// add hyphens and make sure "value" is lowercase
							$valueOption = strtolower($this->addHyphenBetween($value));
							
							$html .= '<option value="'.$valueOption.'" '.$selectedMark.' >'.ucwords($value).'</option>';
						}
					}
				$html .= '
				</select>';
				
				return $html;
			}
			
			/**
			  * This function helps iterate over numbers. If you want to build a dropdown 
			  * for numericals, this is a good function to use.
			  *
			  * @param $name, $start, $end, $selected
			  */
			public function SelectTagNumRange($name, $start, $end, $selected=-1)
			{
				$html = '
				<select id="'.$name.'" name="'.$name.'" class="three-rounding">';
					if($start <= $end)
					{
						// increment within the given range
						for($z = $start; $z <= $end; $z++)
						{
						   $selectedMark = ($z == $selected)? 'selected' : false;
						   $html .= $this->options($z, $selectedMark);
						}
					}else{
						// decrement within the given range
						for($z = $start; $z >= $end; $z--)
						{
						   $selectedMark = ($z == $selected)? 'selected' : false;
						   $html .= $this->options($z, $selectedMark);
						}
					} 
				$html .= '
				</select>';
				
				return $html;
			}

			/**
			  * This function is responsible for listing number of years starting or ending
			  * with the current year
			  *
			  * @param $name, $n, $order
			  */
			public function SelectYear($name, $n, $order='ASC')
			{
				$year = date('Y');
				return $this->SelectTagNumIncrement($name, $year, $n, $order);
			}
			
			/**
			  * This function list all twelve months of the year. You can include the 
			  * first label of the <select> e.g "Select Year"
			  *
			  * @param $name, $label, $selected
			  */
			public function SelectMonth($name, $label=false, $selected='')
			{
				$month = array();
				
				if($label){
					$month[] = $label;
					$month   = array_merge($month, $this->MonthList());
				}else{
					$month = $this->MonthList(); 
	            }			

				// get selected month
				if($selected == 'auto')
					$selected = date('m');
				else if($selected > 0)
					$selected = $selected;
				else
					$selected = $this->SelectedIndex($name, $month);
				
				$html = '<select id="select-'.$name.'" name="'.$name.'" class="three-rounding">';
							$i = 0;
							foreach($month as $value)
							{
								$selectedMark = ($i == $selected)? 'selected' : false;
								$html .= '<option value="'.($i + 1).'" '.$selectedMark.' >'.ucwords($value).'</option>';
								$i++;
							}
				$html .= '</select>';				
				
				// show select tag...
				return $html;
			}
			
			/**
			 * This function returns of all months in lowercase 
			 */
			public function MonthList()
			{
				return array('january', 'february', 'march', 'april', 'may', 'june', 
							 'july', 'august', 'september', 'october', 'november', 'december'); 
			}

			public function ShortMonthList()
			{
				return array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
							 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'); 
			}
			
			/**
			  * This function let us select a day from the current month
			  * or specified month if given
			  *
			  * @param $name, $month, $year
			  */
			public function SelectDay($name, $month=false, $year=false)
			{  
				// find current month and year
				$month = (!$month)? date('m') : $month;  
				$year  = (!$year)? date('Y') : $year;  

				// last days of the months of the year...
				$month_last_day = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

				// let check if current year is a leap year...
				$c_month_last_day = ($this->isLeapYear($year) && $month == 2)? 29  : $month_last_day[$month - 1]; 

				return $this->SelectTagNumRange($name, 1, $c_month_last_day);
			}
			
			/**
			  * Find a selected option from <select> function
			  *
			  * @param $name, $array
			  */
			public function SelectedIndex($name, $array)
			{
				$index = -1;
				if(strlen($name))
				{
					if(isset($_GET[$name]))
					{
						$currentItem = strtolower($_GET[$name]);
						
						for($i = 0; $i < count($array); $i++)
						{
							$eachItem = strtolower($array[$i]);
							
							if($eachItem == $currentItem) $index = $i;
						}
						return ($index > -1)? $index : -1;
						
					}
				}
				return $index;
			}
			
			/**
			  * Simple function to build each <select> option using a trailing "0"
			  * or not, nothing much
			  *
			  * @param $z, $selectedMark
			  */
			public function options($z, $selectedMark=false)
			{
				if($z  <  10 & $z != 0) $z = "0".$z;                  // add trailing zero

				return '<option value="'.$z.'" '.$selectedMark.' >'.$z.'</option>';
			}

			/**
			  * This function is very related to <SelectTagNumRange> except it does 
			  * not require the end value. Instead it requires number of numerals to iterate.
			  * By default it increments from the start number till the end of the iteration.
			  * It can decrement if the order given is not "ASC"
			  */
			public function SelectTagNumIncrement($name, $num, $n, $order='ASC', $selected='', $class='two-rounding')
			{
				// form array just for finding selected index
				$array = array();
				for($j = 0; $j <= $n; $j++){$array[] = $j+1;}
				$selected = (strlen($selected))? $selected : $this->SelectedIndex($name, $array);
				
				$html = '
				<select id="select-'.$name.'" name="'.$name.'" class="'.$class.'">';

					for($z = 0; $z <= $n; $z++)
					{
						$selectedMark = ($z == $selected)? 'selected' : false;
						$html .= $this->options($num, $selectedMark);
						
						if($order == 'ASC')
							$num += 1;
						else
							$num -= 1;
					}

				$html .='
				</select>';
				
				return $html;
			}
			
			/**
			  * Check if the year given or current year is a leap year or not
			  *
			  * @param $year
			  */
			public function isLeapYear($year='')
			{
			  $year = (strlen($year))? $year : date('Y');
			  return ((($year % 4 == 0) &&($year % 100 != 0)) || ($year % 400 == 0))? true : false;		
			}

			/**
			  * This function returns the date the passed script was last modified
			  *
			  * @param $url
			  */
			public function GetModifiedDate($url='genode/php/genode.php')
			{
				return @date("Y-m-d", $this->fix_m_time($url));
			}
			
			/**
			  * This function basicaly dump any passed array as a text, also  giving you a 
			  * choice to set the amount of indetation within the array. It is heavily used
			  * when in demonstration of the code
			  *
			  * @param $name, $array, $indentation
			  */
			public function arraylize($name, $array, $indentation=4)
			{
				$html = ' 
				$'.$name.' = array(<br />';

					// check if array is associative
					if($this->isAssoc($array))
					{
						// loop all elements to the html
						while(list($label, $url) = each($array))
						{
							// add indetion
							$html .= $this->arraylizeIndent($indentation);

							// add the usually input of the array
							$html .= '\''.$label.'\' => \''.$url.'\'; <br />';
						}

					}else{
						// loop sequential
						for($i = 0; $i < count($array); $i++)
						{
							// add indetion
							$html .= $this->arraylizeIndent($indentation);


							// check if its the array of arrays
							if(is_array($array[0]))
							{
								$html .= $this->arrayDeep($array, $indentation);
							}else{
								$html .= $array[$i].', <br />';
							}
						}
					}
					
				$html .= '
				); <br />';

				return $html;
			}
				public function arrayDeep($array, $indentation)
				{
					// loop all elements
					$html = 
					$this->arraylizeIndent($indentation).'
					array(';

						for($j = 0; $j < count($array); $j++)
						{
							// current chunk
							$chunk = $array[$j];

							if( is_array($chunk))
								$html .= $this->arrayDeep($chunk, $indentation);
							else
								$html .= '\''.$chunk.'\'';

							// add comma where neccessary
							if($j < count($array) - 1) $html .= ', ';
						}

					$html .= '), <br />';

					return $html;
				}

				/**
				 * This function indent arrays within <arraylize>. Remember this function
				 * is directly called by <arraylize>.
				 *
				 * @param $indentation
				 */
				public function arraylizeIndent($indentation)
				{
					// add spacing for proper presentation
					$html = '';
					for($i = 0; $i < $indentation; $i++)
					{
						$html .= '&nbsp';
					}
					return $html;
				}

			/**
			 * This function is a boolean function that checks if the passed array is an associative
			 * array or not. If associative it will return true otherwise
			 * will return false;
			 *
			 * @param $arr
			 */
			public function isAssoc($arr)
			{
			    return array_keys($arr) !== range(0, count($arr) - 1);
			}

			/**
			  *  This function fix the very annoying error that windows yield
			  *  when working with php native <filemtime>
			  *
			  * @param $filePath
			  */ 
			public function fix_m_time($filePath)
			{
				$time = @filemtime($filePath); 

				$isDST = (@date('I', $time) == 1); 
				$systemDST = (@date('I') == 1); 

				$adjustment = 0; 

				if($isDST == false && $systemDST == true) 
					$adjustment = 3600;
				else if($isDST == true && $systemDST == false) 
					$adjustment = -3600;
				else 
					$adjustment = 0; 

				return ($time + $adjustment); 
			} 

			/**
			 * This function makes sure that it return the an unduplicated array
			 */
			public function unduplicate($array)
			{
				// Create a temporal array
				$temp = array();

				// Loop all content in the array
				for($i = 0; $i < count($array); $i++){
					// Assume current item is set
					$isset = false;

					// Loop to check current item against the entire array
					for($j = $i; $j < count($array); $j++ ){
						// If this has been set before, specify
						if( ($array[$j] == $array[$i]) && $i != $j ){
							$isset = true;
							break;
						}
					}

					// If the current item has no been set before
					// then set, it unique
					if(!$isset) $temp[] = $array[$i];
				}

				// Copy unique items from 'temp'
				$array = $temp;

				// Empty temp array
				unset($temp);

				// Return to the caller
				return $array;
			}

			/**
			  * This function is responsible for responsiveness and
			  * layout for the website. This function is very powerful
			  *
			  * @param $boxes, $deviceSet, $style, $id
			  *
			  * @bug            The grid still need to be verified on visibility and 
			  *                 settings and square, alternate
			  */
			public function grid($boxes, $gridId="grid")
			{	
				// prepare "HTML" 
				$html = '
				<div id="'.$gridId.'-grid" class="grid cf">';

					// start looping each box
					for($i = 0; $i < count($boxes); $i++)
					{	
						// get the content for the box
						$boxContent = $boxes[$i];
						
						// display each box
						$html .= '
						<div class="box">
							<div class="inner-box">
								'.$boxContent.' 
							</div>
						</div>';
					}

				$html .= '
				</div>';
				
				return $html;
			}

			/**
			  *  This function creates the appropiate path to the file based on what vesrion of 
			  *  device we are currently using. This is to make sure that we supply files
			  *  that could be easily handled by any device. For example it not ideal to supply
			  *  large images to a mobile device since most of them have small screens.
			  *
			  * @param $dir
			  */ 
			public function device_path($dir)
			{
				// compose the appropiate path based on the current device used
				if($this->device == 'mobile')
					$path = $dir.'/mobile/';
				else
					$path = $dir.'/pc/';

				return $path;
			}
		/** 
		  * ---------------------------------- Footer -------------------------------------- 
		  *
		  * This function is just responsible for building us the footer for the website. 
		  */
		public function footer($isPlain=false)
		{
			// Initiate
			$html = '';

			// Customise Footer only if it is not plain
			if( !$isPlain ){
				// Customise footer
				if($this->footertype == 'trinity')
					$footer = $this->trinityFooter($this->footerlist);
					
				elseif($this->footertype == 'list')
					$footer = 
					$this->listFooter($this->footerlist);
					
				else
					$footer = '';
									 
				if($this->device != 'mobile'){
					$html .= '
					<div id="footer" class="cf">
						<div class="dmsn cf">
							'.$footer.'
						</div>
						<div class="trademark cf">
							&#169; '.$this->client.' '.date('Y').'. Trademarks and brands are the property of their respective owners.
						</div>
					</div>';
				}
			}
			
			$html .=
				       $this->GetJS().'			
					</div>
				</body>
			</html>';

			return $html;
		}
			/**
			  * This function makes our is a layout function for the footer. It lists each column with 
			  * top label and the list below
			  *
			  * @param $list
			  */
			public function ListFooter($list, $type="list", $title="default")
			{	
				// loop all elements
				$html = '
				<div class="ui-list-footer cf">';

					// Add title if given
					if( $title != "default"){
						$html .= '
						<div class="title">
							'.ucwords($title).'
						</div>';
					}
			
					// loop each column
					while(list($parent, $children) = each($list))
					{
						if( $type == "parent"){
							$html .= '
							<ul>
								'.$this->eachListFooter($parent, $children).'
							</ul>';
						}else{
							$html .= $this->eachListFooter($parent, $children);
						}
					}

				$html .= '
				</div>';
				
				return $html;
			}
				public function eachListFooter($parent, $children)
				{
					// initiate "html"
					$html = "";

					if( is_array($children) ){
						// Add parent
						$html .= '
						<li class="parent"> '.ucwords($parent).'</li>';

						//  loop each children list
						$i = 0;
						while(list($label, $url) = each($children))
						{				
							// form each element
							if(!is_array($url))
							{
								// check if the url is not an http
								if(strpos($url, 'http') === FALSE){ $url = $this->hoster.$url;}
								
								$html .= '
								<li>
									<a href="'.$url.'"> '.ucwords( strtolower($label) ).' </a>
								</li>';
							}
							
							// increment
							$i++;
						}
					}else{
						$parent = $this->word_wrap($parent, 35);
						$html .= '
						<li> 
							<a href="'.$children.'">'.ucwords(strtolower($parent)).'</a>
						</li>';
					}

					// Return to the caller
					return $html;
				}
			
			/** 
			  * This function makes our is a layout function for the footer. It creates a footer 
			  * that is centered to the footer 
			  */
			public function TrinityFooter()
			{
				// first let find if the given menu is odd or even
				$menuCount = 0;
				while(list($label, $url) = each($this->menulist)){	
					if(!is_array($url)){
						$menuCount++;
					}
				}

				// calculate width for each tab
				$widthRatio = 100 / $menuCount;
				$eachWidth = $widthRatio * 10;
				
				// calculate the width for the entire footer
				$footerWidth = $eachWidth * $menuCount;
				
				// loop all elements
				$html = '
				<div class="ui-trinity-footer cf" style="width:'.$footerWidth.'px; margin: 0 auto;">';
				
					$i = 0;
					reset($this->menulist); /* have no idea y have to reset */
					
					while(list($label, $url) = each($this->menulist))
					{				
						// form each element
						if(!is_array($url)){
							// check if the url is not an http
							if(strpos($url, 'http') === FALSE){ $url = $this->hoster.$url;}
							
							$html .= '
							<li style="width:'.$eachWidth.'px">
								<a href="'.$url.'"> '.$label.' </a>
							</li>';
						}
						
						// increment
						$i++;
					}
				$html .= '
				</div>';
				
				return $html;
			}
  }
?>