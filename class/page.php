<?php
  /**
	* @author         Praise Khumalo <praise@focalsoft.co.za>
	*
	* @date           01/05/16
	*
	* @project        Focalsoft Main Website
	*
	* @license        Copyright (c) 2016 Focalsoft [SA] All right reserved. (http://www.focalsoft.co.za). Using
	*                 this code without a granted permission from Focalsoft will be breach of Law.
    */

  # include the Genode API
  include_once(dirname(dirname(__FILE__)).'/genode/php/genode.php');
  
  class Page extends Genode
  {     
		/**
		  * Current node being selected
		  */
		public $cdescription,
			   $ctitle = '';

		/**
		  * Constructor
		  */
		public function __construct()
		{	 
			// Set the domain of this project
			$this->domain = 'focalsoft.co.za';
			// Name of the project
			$this->client = 'Focalsoft';
		
			// Set description of our application
			$this->SetDescription('We build digital products including websites, mobile applications to social media');

			// Set keywords
			$this->SetKeywords('web development, websites, logo design, social media, business, durban, SEO, ecommerce, strategy, praise khumalo, startup, app development,
								branding, graphic design, brand development, system entergration, system, software, email marketing, survey, business cards,
								games, Saas, invoice template, product development, search engine optomisation, business profile, data science, business listing, 
								programmers, coders, designers, data analysis, smme, south africa, ethekwini');

			// Set facebook pixel
			/*$this->gb_fb_pixel = '
			<!-- Facebook Pixel Code -->
			<script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version=\'2.0\';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
			document,\'script\',\'https://connect.facebook.net/en_US/fbevents.js\');
			fbq(\'init\', \'1569450463358578\', {
			em: \'insert_email_variable\'
			});
			fbq(\'track\', \'PageView\');
			</script>
			<noscript><img height="1" width="1" style="display:none"
			src="https://www.facebook.com/tr?id=1569450463358578&ev=PageView&noscript=1"
			/></noscript>
			<!-- DO NOT MODIFY -->
			<!-- End Facebook Pixel Code -->';


			// Set Facebook App
			$this->gb_fb_app = '
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=448144958596176";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, \'script\', \'facebook-jssdk\'));</script>';*/

			// Construct the parent's constructor
			parent::__construct();
			
			// Current URL with extension e.g index.php
			$this->curl    = $this->getCurrentURL(true);
			// Current Device Used              
			$this->device  = $this->getDevice();

			// Solutions / Services
			// Focal Brand
			$this->focalbrand_arr = array(	
										'Branding' => 'product/focalbrand/branding',
			     						'Logo Design' => 'product/focalbrand/logo-design',
			     						'Portfolio Design' => 'product/focalbrand/portfolio-design',
			     						'Marketing' => 'product/focalbrand/marketing',
			);
			$this->focalbrand = $this->build_detail_solution($this->focalbrand_arr);

			// Focal Studios
			$this->focalstudios_arr = array(	
			     						'Photography' => 'product/focalstudios/photography',
			     						'Videography' => 'product/focalstudios/videography',
			);
			$this->focalstudios = $this->build_detail_solution($this->focalstudios_arr);

			// Focal Host
			$this->focalhost_arr = array(	
			     						'Personalised Emails' => 'product/focalhost/email-hosting',
			     						'Web Hosting' => 'product/focalhost/web-hosting',
			     						'Cloud Computing' => 'product/focalhost/cloud-computing'
			);
			$this->focalhost = $this->build_detail_solution($this->focalhost_arr);

			// Focal Dev
			$this->focaldev_arr = array(	
			     						'Web Development' => 'product/focaldev/web-development',
			     						'Cloud System Development' => 'product/focaldev/cloud-system-development',
			     						'App Development' => 'product/focaldev/app-development',
			);
			$this->focaldev = $this->build_detail_solution($this->focaldev_arr);

			// Registrations
			$this->registrations = array(	
			     						'Pty LTD Registration' => 'product/focalbrand/registrations',
			     						'CSD: Central Supplier Database' => 'product/focalbrand/csd',
			     						'Google Business Listing' => 'product/focalbrand/google-listing',
			);
			$this->registrations = $this->build_detail_solution($this->registrations);

			// Amendments
			$this->amendments = array(	
			     						'Add Director' => '#',
			     						'Remove Director' => '#',
			     						'COMBO: Add / Remove' => '#',
			     						'Name Extension' => '#',
			);
			$this->amendments = $this->build_detail_solution($this->amendments);

			// Compliance
			$this->compliance = array(	
			     						'Annual Returns' => 'product/focalbrand/annual-returns',
			     						'Tax Returns' => '#',
			     						'Tax Clearance' => '#',
			);
			$this->compliance = $this->build_detail_solution($this->compliance);

			// Certificates
			$this->certificates = array(	
			     						'BEE Certificates' => '#',
			     						'Share Certificates' => '#',
			     						'Original Company Documents' => '#',
			);
			$this->certificates = $this->build_detail_solution($this->certificates);

			// Office Solutions
			$this->office_solutions = array(
					 'COMPLIANCE'.$this->compliance => '#',
				     'REGISTRATIONS'.$this->registrations => '#',
				     'AMENDMENTS'.$this->amendments => '#',
				     'CERTIFICATES'.$this->certificates => '#',
			);

			// Brand Solutions
			$this->brand_solutions = array(
				     'FOCAL BRAND '.$this->focalbrand => 'division/focalbrand',
				     'FOCAL DEV'.$this->focaldev => '#',
				     'FOCAL HOST'.$this->focalhost => '#',
				     'FOCAL STUDIOS'.$this->focalstudios => '#'
			);

			$this->sitemap = array(
				      'EMAIL & OFFICE'  => 'our-work/all',
				      'PROMOS'  => 'promos',
			);

			// Set menulist
			$this->menulist = array(
					'PAPERWORK' => $this->brand_solutions,
					'BRANDING' => '#',
					'WEBSITES' => 'product/focaldev/web-development',
					'MARKETING' => '#',
			);
			$this->menulist = array_merge($this->menulist, $this->sitemap);

			// Set social links
			$this->socialinks = array(
						'Facebook' => 'https://www.facebook.com/FocalsoftCompany/',
						'Instagram' => 'https://www.instagram.com/focalsoft',
						'Linkedin' => 'https://www.linkedin.com/company/17891556',
						'Google+' => 'https://plus.google.com/101697472394701646965');

			// Set strategic partners
			$this->partners = array(
						'Uvolwethu Communications' => 'http://www.uvolwethucomm.co.za',
						'JUSTG Services' => 'http://www.justg.co.za');

			// Find the appropiate image for Focal Product
			if(isset($_GET['p'])){
				// Let customise the splash accordingly
				$page = $_GET['p'];

				// Compose the appropiate image
				$s_product_image = strtolower($page).'-slide.jpg';
			}else{
				$page = false;
				$s_product_image = false;
			}

			// Then start setting images for the splash with an array called "splashlist"
			$this->splashlist = array(
				'index.php' => array(false, $this->HomeSplash(), 'home' ),
				'focalproduct.php' => array($s_product_image, $this->ProductSplash($page), 'product' ),
				'promos.php' => array('promos-slide.jpg', $this->ProductSplash('promos'), 'promos' ),
				'company.php' => array(false, $this->CompanySplash(), 'company' ),
				'focalbase.php' => array(false, $this->CompanySplash(), 'company' )
			);

			// Set CSS files
			$this->SetCSS('css/default.css');
			$this->SetCSS('css/desktop.css');
			
			// Set Javascript files
			$this->SetJS('js/default.js');
 		}

 		public function build_detail_solution($menu)
 		{
 			$html = '
 			<ul id="detail-solution">';

	 			foreach($menu as $label => $link)
	 				$html .= $this->ui_lia($label, $link);

	 		$html .= '
	 		</ul>';

	 		return $html;
 		}

		/** 
		  * ---------------------------------- Genode API Overrides -------------------------------------- 
		  *
		  * The following functions, overrides functions determined in our API Genode 
		  *
		  */
		public function ui_ctru_custom_btn($title, $link='#', $id='default')
		{
			// Get the appropiate class and image
			$img = 'pointer.png';
			$class = false;

			if($this->curl == 'planner.php'){
				$img = 'd-pointer.png';
				$class = 'active';
			}

			return '
			<a href="'.$link.'">
				<div id="'.$id.'-ctru-box" class="ui-ctru-box '.$class.' cf">
					<div class="label">
						'.$title.'
					</div>
					<div class="right">
						<div class="circle-rounding cf">
							<img src="images/ui/'.$img.'" alt="start a new project" />
						</div>
					</div>
				</div>
			</a>';
		}

		/** 
		  * ---------------------------------- Header Part -------------------------------------- 
		  *
		  * Builds us the top banner of the website. 
		  *
		  */		
		public function GetBanner()
		{
			$html =  '
			<div id="banner" class="cf bck-cover">
				'.$this->topContacts()
				 .$this->MenuSection();

				if( $this->curl == 'index.php')
				{
					// ** [+1] Prepare Slider **
					$slide_one = '
					<h1>Hi there this is slide one</h1>';

					// Slide two
					$slide_two = '
					<h1>Hi there this is slide two</h1>';

					// Slide three
					$slide_three = '
					<h1>Hi there this is slide three</h1>';

					$slides = array($slide_one, $slide_two, $slide_three);

					//$html .= $this->ui_slider($slides);

					// ** [+2] Prepare Content Box (contbox) **
					$title = '
					Get your <span id="hilight">paperwork</span> in order with cheap prize';
					$content = '
					<p>
						Stress-less about the paperwork and let us do the work and make sure your company 
						is running smooth and compliant.
					<div class="button">
						<button>Start Now</button>
					</div>';

					$html .= '
					<div class="slide">
						<div class="content dmsn">
							'.$this->contbox($title, $content, 'left').'
							<div class="right paperwork-cell">
								<img src="images/slider/paperwork-cell.png" alt="paperwork" />
							</div>
						</div>
					</div>';
				}else{
					$html .= $this->ui_splash();
				}

			$html .= '
			</div>';

			if( $this->curl == 'index.php')
				$html .= $this->ActionBar();

			return $html;
		}
			public function contbox($title, $content, $layout='center')
			{
				return '
				<div id="contbox" class="'.$layout.'">
					<div class="headline">'.$title.'</div>
					<div class="ui-line"></div>
					'.$content.'
				</div>';

				return $html;
			}

			public function topContacts()
			{
				return '
				<div class="contacts">
					<div class="dmsn cf">
						<div class="dtls cf">
							<div class="dtl bold">
								CONTACT NUMBER: <span id="number">076 011 4359</span>
							</div>
							<div class="dtl bold">
								EMAIL: <span id="number">info@focalsoft.co.za</span>
							</div>
						</div>
					</div>
				</div>';
			}

			/**
			 * This function returns the 'Main menu' of our application
			 */	
			public function MenuSection()
			{
				// Logo
				$logo = 'images/ui/logo.png';

				// Active 'starup package'
				$startup = ($this->curl == 'startup-package.php')? 'active' : false;

				$html = '
				<div id="menu-section" class="cf">
					<div class="dmsn cf">
						<div class="logo">
							<img src="images/ui/logo.png" /> 
						</div>
						'.$this->ui_menu()
						 .$this->mobileLabel()
						 .$this->ui_mobile_menu_button()
						 .$this->ui_icon('pro.png', 44, 49).'
					</div>
				</div>'.$this->ui_mobile_menu();

				return $html;
			}
				public function mobileLabel()
				{
					// Label
					$label = $this->GetCurrentURL();
					$label = str_replace('-', ' ', $label);
					$label = ($label == 'index')? 'focalsoft' : $label;

					return '
					<div class="mobile-label cf">
						'.strtoupper($label).'
					</div>';
				}	

			public function ActionBar()
			{
				// [+1] Box One
				$title = 'Compliant Paperwork';
				$text = '
				As little as R 259 / month, you will get your business’s paperwork in order.';
				$url = '#';
				$box1 = $this->ActionBarBox($title, $text, $url);

				// [+2] Box Two
				$title = 'Worldclass Branding';
				$text = '
				As little as R 259 / month, you will get your business’s paperwork in order.';
				$url = '#';
				$box2 = $this->ActionBarBox($title, $text, $url);

				// [+3] Box Three
				$title = 'Professional Emails';
				$text = '
				As little as R 259 / month, you will get your business’s paperwork in order.';
				$url = '#';
				$box3 = $this->ActionBarBox($title, $text, $url);

				return '
				<div id="action-bar" class="cf">
					<div class="dmsn">
						'.$this->grid(array($box1, $box2, $box3)).'
					</div>
				</div>';
			}
				public function ActionBarBox($title, $text, $url)
				{
					return '
					<div class="title"> '.$title.' </div>
					<p>
					'.$text.'
					<div>  <button url="'.$url.'">Start Now</button>  </div>';
				}

		/** 
		  * ---------------------------------- Body -------------------------------------- 
		  *
		  * Build Body content for our application
		  */	
		public function body()
		{
			// Initialise 'body'
			$body = '';

			// Start building the appropiate page
			switch($this->curl)
			{
				case 'promos.php': 
					$body .= $this->PromoPage(); break;

				case 'startup-package.php':
					$body .= $this->StartupPage(); break;

				case 'planner.php':
					$body .= $this->PlannerPage(); break;

				case 'pricing.php':
					$body .= $this->PricingPage(); break;

				case 'company.php':
					$body .= $this->CompanyPage(); break;

				case 'blog.php':
					$body .= $this->BlogPage(); break;

				case 'our-work.php':
					$body .= $this->WorkPage(); break;

				case 'services.php':
					$body .= $this->ServicesPage(); break;

				case 'project.php':
					$body .= $this->ProjectPage(); break;

				case 'focalbase.php':
					$body .= $this->FocalPage(); break;

				case 'focalproduct.php':
					$body .= $this->FocalProductPage(); break;

				case 'purchase.php':
					$body .= $this->PurchasePage(); break;

				case 'division.php': 
					$body .= $this->DivisionPage(); break;

				default: 
					$body .= $this->HomePage(); break;
			}

			return $body;
		}
			public function PromoPage()
			{
				// [+1] Page id
				$page = 'promos';

				// [+2] Box 1
				$title = 'One-Pager Website';
				$_price = '1799';
				$price = array(43 => array($_price, 'R', 'min'));
				$list = array(
					'Free <span class="bold">.co.za</span> domain',
					'5 email accounts',
					'250 Mb Disk space',
					'Mobile optimization',
					'Social Media page designs',
					'Google Business Listing',
					'15% Off on '.$this->gb());
				$link = 'purchase/'.$_price.'/one-pager-website';
				$boxOne = array($title, $price, $list, $link);

				// [+3] Box 2
				$title = 'Portfolio Website';
				$_price = '3499';
				$price = array(10 => array($_price, 'R', 'min'));
				$list = array(
					'Free <span class="bold">.co.za</span> domain',
					'10 email accounts',
					'250 Mb Disk space',
					'10 page website',
					'Mobile optimization',
					'Social Media page designs',
					'35% Off on <span id="hilight" class="gb">Green Books</span>');
				$link = 'purchase/'.$_price.'/portfolio-website';
				$boxTwo = array($title, $price, $list, $link);

				// [+4] Box 3
				$title = 'eCommerce Website';
				$_price = '5499';
				$price = array(34 => array($_price, 'R', 'min'));
				$list = array(
					'Free <span class="bold">.co.za</span> domain',
					'20 email accounts',
					'500 Mb Disk space',
					'unlimited website',
					'Mobile optimization',
					'Weekly Database backup',
					'50% Off on '.$this->gb());
				$link = 'purchase/'.$_price.'/ecommerce-website';
				$boxThree = array($title, $price, $list, $link);

				// [+5] Box 4
				$title = 'Standard Online Shop';
				$_price = '5499';
				$price = array(56 => array($_price, 'R', 'min'));
				$list = array(
					'Free <span class="bold">.co.za</span> domain',
					'20 email accounts',
					'500 Mb Disk space',
					'unlimited website',
					'Mobile optimization',
					'Weekly Database backup',
					'50% Off on '.$this->gb());
				$link = 'purchase/'.$_price.'/ecommerce-website';
				$boxFour = array($title, $price, $list, $link);

				$pricing = array($boxOne, $boxTwo, $boxThree, $boxFour);

				return $this->plain_product_template($page, $pricing);
			} 

			/**
			 *   Product Section
			 */
			public function ProductSplash($page)
			{
				$html = '
				<div id="product-splash" class="inner-page-splash bck-cover">';

					switch($page)
					{
						case 'promos':
							// Prepare Content Box (contbox)
							$title = '
							<img src="images/ui/fly-paper-kite.png" /><br /><br />
							Promotions';
							$content = '
							<p>Stress-less about the paperwork and let us do the work and make sure 
							your company is running smooth and compliant.';

							$html .= $this->contbox($title, $content);
							break;

						case 'web-development':
							// Prepare Content Box (contbox)
							$title = '
							<img src="images/ui/laptop.png" /><br /><br />
							Professional Websites';
							$content = '
							<p>Stress-less about the paperwork and let us do the work and make sure 
							your company is running smooth and compliant.';

							$html .= $this->contbox($title, $content);
							break;
						
						default:
							$html .= 'Default Page';
							break;
					}

				$html .= '
				</div>';

				// Return to the caller
				return $html;
			}

			public function StartupPage()
			{
				// [+1] Page id
				$page = 'logo';

				// [+2] Text details
				$title = 'Start your business';
				$text  = '
				Starting a business can be daunting when you have no idea where to start. There is a couple of things that needs to be in place. Most entrepreneurs overlook them because they want to focus solely on the business. You can\'t blame them, that what they are good at, focusing on their businesses not other stuff.';

				$contentOne = array($title, $text);

				// [+3] Prizing
				// Text
				$text = '
				An upfront payment of 50% is required to start with the work. Refunds are ONLY available if no work was delivered to you as a client.';

				// [+4] Box 1
				$title = 'Starter';
				$price = '399';
				$list = array(
					'2 design concepts',
					'1 revision to the concept',
					'jpeg format',
					'png format',
					'24 hr turnaround');
				$link = 'purchase/'.$price.'/basic-branding';
				$boxOne = array($title, $price, $list, $link);

				// [+5] Box 2
				$title = 'Starter';
				$price = '899';
				$list = array(
					'Logo design (<small style="font-size:70%"><b>2 design concepts</b></small>)',
					'Business Registration',
					'Google Business Listing',
					'Social Media Page Setup + Branding',
					'** Business Reg CIPC approved');
				$link = 'purchase/'.$price.'/startup-starter';
				$boxTwo = array($title, $price, $list, $link);

				// [+6] Box 3
				$title = 'Business';
				$price = '1899';
				$list = array(
					'One Page Portfolio Website',
					'Personalised Emails (<small style="font-size:70%"><b>5 accounts max</b></small>)',
					'Logo design',
					'Business Registration',
					'Google Business Listing',
					'Social Media Page Setup + Branding',
					'** R299 recurring annual for Personalised Emails',);
				$link = 'purchase/'.$price.'/startup-business';
				$boxThree = array($title, $price, $list, $link);

				$pricing = array($text, $boxOne, $boxTwo, $boxThree);

				// [+7] Text details
				$title = 'what we offer';
				$text  = '
				Things like registering your business with <a href="http://www.cipc.co.za" target="_blank">CIPC</a> and coming up with a proper logo or branding for your business, might be little bit too much for a start. It becomes overwhelming. You might end up not starting at all because your focus is on other stuff you might not be so good at. We take care of those nitty-gritty details so you focus on the bigger picture, which is building your business. We cover all the necessary basics to get your business up and running.'; 
				$contentTwo = array($title, $text);

				// return to the caller
				return $this->product_template($page, $contentOne, $pricing, $contentTwo);
			} 

			public function PricingPage()
			{
				// Return to the caller
				return '
				<div id="pricing-page" class="page">
					'.$this->PricingSplash().'
					<div class="odd">
						<div class="dmsn cf">
							'.$this->title('branding')
							 .$this->BrandingPrizing().'
						</div>
					</div>
					<div class="even">
						<div class="dmsn cf">
							'.$this->title('development')
							 .$this->DevPrizing().'
						</div>
					</div>
					<div class="odd">
						<div class="dmsn cf">
							'.$this->title('Marketing')
							 .$this->MarketingPrizing().'
						</div>
					</div>
					'.$this->moreServices().'
				</div>';
			}
				public function BrandingPrizing($id='branding')
				{
					// Box 1
					$title = 'Basic Branding';
					$price = '699';
					$list = array(
						'Logo Design',
						'Quotation Design',
						'Invoice Design',
						'Letter Head Design',
						'15% Off on Green Books');
					$link = 'purchase/'.$price.'/basic-branding';
					$boxOne = $this->ui_pricing_box($title, $price, $list, $link);

					// Box 2
					$title = 'Intermediate Branding';
					$price = '1299';
					$list = array(
						'Logo Design',
						'Signature Design',
						'Quotation Design',
						'10 Custom Emails',
						'Invoice Design',
						'Letter Head Design',
						'35% Off on Green Books');
					$link = 'purchase/'.$price.'/intermediate-branding';
					$boxTwo = $this->ui_pricing_box($title, $price, $list, $link, 'active');

					// Box 3
					$title = 'Corporate Branding';
					$price = '1699';
					$list = array(
						'Logo Design',
						'Signature Design',
						'10 Custom Emails',
						'Business Card Design',
						'100 Printed Business Cards',
						'Stationary Design',
						'50% Off on Green Books');
					$link = 'purchase/'.$price.'/corporate-branding';
					$boxThree = $this->ui_pricing_box($title, $price, $list, $link);

					$boxes = array($boxOne, $boxTwo, $boxThree);

					return $this->grid($boxes, $id);
				}

				public function DevPrizing($id='websites')
				{
					// Box 1
					$title = 'One-Pager Website';
					$price = array('1799', 'R', 'min');
					$list = array(
						'Free <span class="bold">.co.za</span> domain',
						'5 email accounts',
						'250 Mb Disk space',
						'Mobile optimization',
						'Social Media page designs',
						'15% Off on Green Books');
					$link = 'purchase/'.$price.'/one-pager-website';
					$boxOne = $this->ui_pricing_box($title, $price, $list, $link);

					// Box 2
					$title = 'Portfolio Website';
					$price = array('3499', 'R', 'min');
					$list = array(
						'Free <span class="bold">.co.za</span> domain',
						'10 email accounts',
						'250 Mb Disk space',
						'10 page website',
						'Mobile optimization',
						'Social Media page designs',
						'35% Off on Green Books');
					$link = 'purchase/'.$price.'/portfolio-website';
					$boxTwo = $this->ui_pricing_box($title, $price, $list, $link, 'active');

					// Box 3
					$title = 'eCommerce Website';
					$price = array('5499', 'R', 'min');
					$list = array(
						'Free <span class="bold">.co.za</span> domain',
						'20 email accounts',
						'500 Mb Disk space',
						'unlimited website',
						'Mobile optimization',
						'Weekly Database backup',
						'50% Off on Green Books');
					$link = 'purchase/'.$price.'/ecommerce-website';
					$boxThree = $this->ui_pricing_box($title, $price, $list, $link);

					$boxes = array($boxOne, $boxTwo, $boxThree);

					return $this->grid($boxes, $id);
				}

				public function MarketingPrizing($id='marketing')
				{
					// Box 1
					$title = 'Entrance Marketing';
					$price = array('799', 'R', '/pm');
					$list = array(
						'4 graphic designs <span class="bold">/pm</span> ',
						'Banner + Avatar designs',
						'2 weekly user-engagement',
						'Google Business Profile',
						'1 x monthly-report');
					$link = 'purchase/'.$price.'/entrance-marketing';
					$boxOne = $this->ui_pricing_box($title, $price, $list, $link);

					// Box 2
					$title = 'Intermediate Marketing';
					$price = array('1199', 'R', '/pm');
					$list = array(
						'6 graphic designs <span class="bold">/pm</span> ',
						'Banner + Avatar designs',
						'2 weekly user-engagement',
						'R 199 for paid-advertising',
						'Google Business Profile',
						'1 x monthly-report');
					$link = 'purchase/'.$price.'/intermediate-marketing';
					$boxTwo = $this->ui_pricing_box($title, $price, $list, $link, 'active');

					// Box 3
					$title = 'Corporate Marketing';
					$price = array('2399', 'R', '/pm');
					$list = array(
						'10 graphic designs <span class="bold">/pm</span> ',
						'Banner + Avatar designs',
						'Daily user-engagement',
						'R 399 for paid-advertising',
						'Google Business Profile',
						'1 x monthly-report');
					$link = 'purchase/'.$price.'/corporate-marketing';
					$boxThree = $this->ui_pricing_box($title, $price, $list, $link);

					$boxes = array($boxOne, $boxTwo, $boxThree);

					return $this->grid($boxes, $id);
				}

				public function moreServices()
				{
					return '
					<div class="more-services cf">
						<div class="dmsn">
							<div class="left bold">
								NEED A CUSTOMISED SERVICE?
							</div>
							<div class="right">
								<a href="planner">
									<button class="pill-rounding bold">
										REQUEST SERVICE 
									</button>
								</a>
							</div>
						</div>
					</div>';
				}

				public function title($text)
				{
					return '
					<div class="title bold">
						'.strtoupper($text).'
						<div class="ui-line"></div>
					</div>';
				}

				public function PricingSplash()
				{
					return '
					<div id="pricing-splash" class="inner-page-splash bck-cover">
						'.$this->ui_ctru_title('PRICING').'
						<div class="description">
							We are all about transparency and honesty. Get an idea how much we charge for the services we provide. 
						</div>
					</div>';
				}

			/**
			 * This function a planner page, this is where users request projects
			 */
			public function PlannerPage()
			{
				// [1] Form
				$formId = 'start-project';
				$form = array(
					array('Fullname', 'text', 'fullname'), 
					array('Email', 'text', 'email'), 
					array('Cell', 'text', 'cell'), 
					array('Company', 'text', 'company'),
				); 

				// Compose the appropiate message
				$message = '
				Thank you for your interest in working with Focalsoft.';

				if(isset($_GET['service']))
				{
					$service = $_GET['service'];

					// Sanitized
					$_service = str_replace('-', ' ', $service);

					$message .= '
					Please complete the below form to enquire about the <span id="hilight">'.ucwords($_service).'</span> service. We will be in touch 
                    with you shortly';

                    $form[] = array('service_type', 'hidden', $service);
				}else{
					// Message
					$message .= '
					Thank you for your interest in working with Focalsoft. Below is the form you will
					have to fill so we will get back to you.';

					// Add the service dropdown
					$projectType = array('Type of Service...', 
										 'Company Registrations', 
										 'Website Development', 
										 'Logo Design', 
										 'App Development',
										 'Branding', 
										 'Other');

					$form[] = array('Service Type', $projectType, 'service_type');
				}

				return '
				<div id="planner-page" class="dmsn page cf">
					'.$this->ui_highlight('SERVICE ENQUIRY.').'
					<div class="texty">
						'.$message.'
					</div>
					'.$this->ui_smart_form($formId, $form, 'one-in').'
				</div>';
			}

			public function WorkPage()
			{
				// [1] Form
				$formId = 'start-project';
				$projectType = array('Type of Service...', 'Website', 'Logo', 'Marketing', 'Other');
				$form = array(
					array('Fullname', 'text', 'fullname'), 
					array('Email', 'text', 'email'), 
					array('Cell', 'text', 'cell'), 
					array('Company / organization', 'text', 'company'),
					array('Service Type', $projectType, 'service_type'),
				); 

				// Get the current page
				if(isset($_GET['q']))
					$cpage = $_GET['q'];
				else
					$cpage = 'all';

				// Active id
				$aid = 0;

				// Activation for ALL type
				$active = ($cpage == 'all')? 'active' : false;

				$html = '
				<div id="work-page" class="dmsn page cf">
					<div class="bold-title">
						We have worked with a number of clients.
					</div>
					<div class="ui-line"></div>
					<div class="texty">
						We love what we do, so we make sure we craft amazing products and services for our clients. 
						Listed below is some of the projects we\'ve had a pleasure of working on.
					</div>
					<div class="work-menu cf">
						<a href="our-work/all">
							<div class="filter '.$active.' cf">All</div>
						</a>';

						// Fetch All services
						$services = $this->fetch('work_type', array(1 => 1));

						// Start looping all available services / filters
						for($i=0; $i<count($services); $i++)
						{
							// Current Service
							$cid      = $services[$i]['id'];
							$cservice = strtolower($services[$i]['name']);

							// Let dertmine class
							if($cpage == $cservice)
							{
								$active = 'active';
								$aid = $cid;
							}else
								$active = false;

							// Add each filter
							$html .= '
							<a href="our-work/'.$cservice.'">
								<div class="filter '.$active.' cf">
									'.ucwords($cservice).'
								</div>
							</a>';
						}


				$html .= '
					</div>
					'.$this->grid($this->loopWork(50, $aid), 'work').'
				</div>'.$this->moreServices();

				return $html;
			}
				public function loopWork($limit=50, $type=0)
				{

					// Initiate the array
					$project = array();
					$i = 0;

					// Fetch all projects
					if($type != 0)
						$work = $this->fetch('work', array('type' => $type));
					else
						$work = $this->fetch('work', array(1 => 1));

					foreach($work as $data)
					{
						// Find information
						$id     = $data['id'];
						$image  = $data['image'];
						$type   = $data['type'];
						$name   = $data['name'];

						// Default Filter
						$filter = 'black';

						// URL
						$url    = 'project/'.$id;

						// Compose Title
						$title  = ucwords($name.' \'s ');

						// Get the type
						$_data  = $this->fetch('work_type', array('id' => $type) );
						$type   = $_data[0]['name'];

						// Add project
						$project[] = $this->WorkFilter($title, $image, $type, $url, $filter);

						// Increment
						$i++;

						// Terminate loop if we have reached the limit
						if( $i >= $limit) break;
					}

					return $project;
				}
					public function WorkFilter($title, $img, $type, $url, $bck='blue')
					{
						// Display title
						$DisplayTitle = strtoupper($title).'<div class="type">'.strtoupper($type).'</div>';

						return '
						<a href="'.$url.'">
							<div class="work-filter cf">
								<img src="images/work/'.$img.'" alt="'.strlen($title.' '.$type).'">
								<div class="filter bck-cover" style="background: url(images/filters/'.$bck.'-ctru.png)">
									<div class="label">
										'.$DisplayTitle.'
									</div>
								</div>
							</div>
						</a>';
					}

			/**
			 * This function returns the 'company' page, with all information about the company
			 */
			public function CompanyPage()
			{
				// [1] Sumdiv
				$img = '
				<div class="image">
					<img src="images/ui/tablet-pc.png" alt="Tablet" />
				</div>';

				$text_one = '
				<div class="text">
					Focalsoft is an internet company that focuses on developing internet-based solutions for businesses. These services can range from branding to sophisticated software development. Focalsoft is driven by three values, namely, innovation, efficiency, and reliability. These are core values that make the company uses whenever it is working with clients.
				</div>';

				$sumdivOne = array($img, $text_one);

				// [2] Sumdiv
				$img = '
				<div class="image">
					<img src="images/ui/mac.png" alt="Apple iMac" />
				</div>';

				$text_two = '
				<div class="text">
					What makes Focalsoft different from other average companies is the relationship we build with our clients. It not just about cutting a deal but it about genuinely helping our client reach their goals. Our three core values (innovation, effeciency and reliability) guide us in making sure all our clients get the best service. 
				</div>';

				$sumdivTwo = array($text_two, $img);

				// [3] Sumdiv
				$img = '
				<div class="image">
					<img src="images/ui/laptop-code.png" alt="coding on an apple laptop" />
				</div>';

				$text_three = '
				<div class="text">
					Our business falls under Branding Development. Our main aim is to build strong relationships with our 
					clients making sure that our software is efficient and can help our clients reach what they might be aiming for in
					their businesses. We want to make it affordable to acquire solid and professional software that would help
					businesses grow and minimize unnecessary costs.
				</div>';

				$sumdivThree = array($img, $text_three);

				// [4] Sumdiv
				$img = '
				<div class="image">
					<img src="images/ui/apple-laptop.png" alt="Apple Laptop on top of the table" />
				</div>';

				$text_four = '
				<div class="text">
					Our target main market is SMEs, medium businesses, big corporate businesses and government institutions. Our targeted 
					percentage is a minimum of 15% since there are very few companies that provide satisfactory services when it comes to brand development which makes most 
					companies outsource to other countries like India. We want to be the leaders in the industry.
				</div>';

				$sumdivFour = array($text_four, $img);

				return 
				$this->CompanySplash().'
				<div id="company-page" class="page cf">
					<div class="row dmsn">
						'.$this->title('focalsoft')
						 .$this->grid($sumdivOne).'
					</div>

					<div class="row dmsn">
						'.$this->title('Differentiation')
						 .$this->grid($sumdivTwo).'
					</div>

					<div class="row dmsn">
						'.$this->title('sector')
						 .$this->grid($sumdivThree).'
					</div>

					<div class="row dmsn">
						'.$this->title('Market')
						 .$this->grid($sumdivFour).'
					</div>
					'.$this->moreServices().'
				</div>';
			}
				public function CompanySplash()
				{
					return '
					<div id="company-splash" class="inner-page-splash bck-cover">
						'.$this->ui_ctru_title('COMPANY').'
						<div class="description">
							There is a story behind every successful company we are no exception.
						</div>
					</div>';
				}

			/**
			 * This function construct a service page based on the type of services selected
			 */
			public function ServicesPage()
			{
				$path  = 'sumdiv/';

				// [+1] Sumdiv One
				$text = '
				We craft experiences for businesses, helping them reach their clients in a very refreshing yet 
				professional manner. We conceptualise and design content that engages your target audience whilst 
				communicating your message to them at the same time. Here are the services we offer under branding:';

				$list = array('Logo design', 'Business profile design', 'Invoice template design', 
							  'Advertisement banners and GIFs', 'Annual Report template design');
				$list = $this->ui_listfy($list);

				$title  = $this->title('CORPORATE <span class="bold">BRANDING</span>');
				
				// Left Side
				$left = $this->description_section($text, $list);

				// Right Side
				$right = $this->ui_circle_image('ui/corporate-branding.png', 'CORPORATE');
				$sumdivOne = array($title => array($left, $right) );

				// [+2] Sumdiv Two 
				$left = '
				We have built professional websites and complex online systems for many businesses that we have had the pleasure
				to work with over the years that we have been in business. We start by designing every detail of the project
				to make sure that the client visually sees what we can do for them before we even start with the code.';
				$list = array('Web Development', 'eCommerce Store', 'Saas (Software as a Service)');
				$list = $this->ui_listfy($list);

				$right = ' 
				All our systems are developed from scretch using very few external technologies. We employ this tactic to ensure
				that we develop reliable and efficient systems that we understand and can quickly modify to suit your needs at 
				a moment\'s call. Here\'s a breakdown of what we do under software development:';
				$left = $this->description_section($left, $list);

				$right = $this->description_section('', $text);
				$title  = $this->title('DEVELOPMENT');
				$sumdivTwo = array($title => array($left, $right) );

				// [+3] Sumdiv One
				$text = '
				We have a dedicated team that specialises in all things social. Let our fun loving, creative team come up with award
				winning social campaigns for you. Apart from bringing to life blockbuster campaigns, we also provide monthly
				content creation services to keep your brand relevant to it\'s customers.';

				$list = array('Social Media', 'Graphic Design', 'Online Profile', 'Photography');
				$list = $this->ui_listfy($list);

				$title  = $this->title('DIGITAL MARKETING');
				
				// Left Side
				$left = $this->description_section($text, $list);

				// Right Side
				$right = $this->ui_circle_image('ui/digital-marketing.png', 'CORPORATE');
				$sumdivThree = array($title => array($left, $right) );

				// Return to the caller
				return '
				<div id="services-page" class="page">
					'.$this->ServiceSplash()
					 .$this->ui_sumdiv($sumdivOne, 'plain')
					 .$this->ui_sumdiv($sumdivTwo, 'plain', 0)
					 .$this->ui_sumdiv($sumdivThree, 'plain')
					 .$this->moreServices().'
				</div>';
			}
				public function ServiceSplash()
				{
					return '
					<div id="services-splash" class="inner-page-splash bck-cover">
						'.$this->ui_ctru_title('SERVICES').'
						<div class="description">
						Get to understand what we offer as a company from image branding to ICT.
						</div>
					</div>';
				}

				public function description_section($text, $texty)
				{
					return '
					<div class="description-section cf">
						<p>
						  '.$text
						   .$texty.'
					</div>';
				}
				
			public function ProjectPage()
			{
				// Check if id is set or not
				if( isset($_GET['id']) )
				{
					$id = $_GET['id'];

					// Let retrieve all the details
					$data   = $this->fetch('work', array('id' => $id));
					$name   = $data[0]['name'];
					$typeId = $data[0]['type'];
					$image  = $data[0]['image'];
					$description = $data[0]['description'];
					$sdate  = $data[0]['start_date'];
					$edate  = $data[0]['end_date'];
					$cid    = $data[0]['client'];

					// Now let find the type
					$data = $this->fetch('work_type', array('id' => $typeId));
					$type = $data[0]['name'];


					// Add website if, client has one
					$data    = $this->fetch('clients', array('id' => $cid));
					$cname   = $data[0]['name'];
					$website = @$data[0]['website'];

					$content = array(
									array('Client Name:', ucwords($cname)),
									array('Project Type:', ucwords($type)),
									array('Project Description:', $description),);

					if( strlen($website) & $website != null)
						$content[] = array('Client Website:', '<a href="http://www.'.$website.'" target="blank">'.$website.'</a>');

					$content[] = array('Start Date:', $sdate);
					$content[] = array('End Date:', $edate);

					return '
					<div id="project-page" class="page">
						<div class="content cf dmsn">
							<div class="left">
								<img src="images/work/'.$image.'" />
							</div>
							'.$this->ui_label_box('PROJECT DETAILS', $this->ui_table($content) ).'
						</div>
						<div class="related-projects dmsn cf">
							 '.$this->title('RELATED PROJECTS')
							  .$this->grid( $this->loopWork(6, $typeId), 'work')
							  .$this->ui_ctru_btn('More', 'our-work', 'bck').'
						</div>
					</div>';
				}else
					header('location: our-work');
			}

			public function FocalProductPage()
			{
				// If the product is set
				if( isset($_GET['p']) ) 
				{
					// Division
					$product = $_GET['p'];

					// Choose the appropiate product page
					switch ($product) 
					{
						// Google
						case 'google-listing':
							$title = 'Google Listing';
							$content = $this->GooglePage(); break;

						// CSD
						case 'csd':
							$title = 'Central Supplier Database ';
							$content = $this->CSDPage(); break;

						// Registration
						case 'registrations':
							$title = 'COMPANY REGISTRATIONS';
							$content = $this->RegistrationPage(); break;

						// Anual Returns
						case 'annual-returns':
							$title = 'ANNUAL RETURNS';
							$content = $this->AnnualReturnsPage(); break;

						// Videography
						case 'videography':
							$title = 'VIDEOGRAPHY';
							$content = $this->VideographyPage(); break;

						// Photography
						case 'photography':
							$title = 'PHOTOGRAPHY';
							$content = $this->PhotographyPage(); break;

						// Cloud
						case 'cloud-computing':
							$title = 'CLOUD COMPUTING';
							$content = $this->CloudComputingPage(); break;

						// Web Hosting
						case 'web-hosting':
							$title = 'WEB HOSTING';
							$content = $this->WebHostingPage(); break;

						// Personalised Emails
						case 'email-hosting':
							$title = 'Personalised Emails';
							$content = $this->EmailHostingPage(); break;

						// Mobile App
						case 'app-development':
							$title = 'MOBILE APP DEV';
							$content = $this->MobileAppPage(); break;

						// Cloud
						case 'cloud-system-development':
							$title = 'SYSTEM DEV';
							$content = $this->CloudSystemPage(); break;

						// Web Development 
						case 'web-development':
							$title = 'WEB DEVELOPMENT';
							$content = $this->WebDevPage(); break;

						// Branding
						case 'branding':
							$title = 'BRANDING';
							$content = $this->BrandingPage(); break;

						case 'marketing':
							$title = 'MARKETING';
							$content = $this->MarketingPage(); break;

						case 'portfolio-design':
							$title = 'PORTFOLIO DESIGN';
							$content = $this->PortfolioDesignPage(); break;

						case 'logo-design':
							$title = 'LOGO DESIGN';
							$content = $this->LogoDesignPage(); break;

						default:
							$title = 'DEFAULT PAGE';
							$content = 'Default Stuff. No love for custom.'; break;
					}

					// Return to the caller
					return $content;

				}else
					header('location: ');
			}
				/**
				 *    OFFICE DIVISION
				 */
				public function GooglePage()
				{
					$html = '
					<div id="registration-page" class="content focal-product-page">';

						$title = 'GOOGLE BUSINESS';
						$text = '
						This is a platform provided by google to help business to be found or identified easily.';

					$html .= 
						$this->text_block($title, $text);

						// Boxes
						$box = 
						$this->montitle('Why is it important').'
						<p>
						Google listing will give your customers: your number, address and even your website if you have one. This is all critical information needed by your customers to find your business ';

						$box1 = '
						<div class="image">
							<img src="images/ui/logos.png" alt="Logos"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
					</div>';

					return $html;
				}

				public function CSDPage()
				{
					$html = '
					<div id="registration-page" class="content focal-product-page">';

						$title = 'CENTRAL SUPPLIER DATABASE';
						$text = '
						The central supplier database maintains a database of organisations, institutes and individuals who can provide goods and services to the government. The CSD puts you in the map.';

					$html .= 
						$this->text_block($title, $text);

						// Boxes
						$box = 
						$this->montitle('Why is it important').'
						<p>
						Central Supplier Database allows you company to trade with the government institutions';

						$box1 = '
						<div class="image">
							<img src="images/ui/logos.png" alt="Logos"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
					</div>';

					return $html;
				}

				public function RegistrationPage()
				{
					$html = '
					<div id="registration-page" class="content focal-product-page">';

						$title = 'Company Registrations';
						$text = '
						In terms of the companies act of 2008 a company may be registered with or without a name, when a company is registered without a name its registration number becomes the companies name automatically ';

					$html .= 
						$this->text_block($title, $text);

						// Boxes
						$box = 
						$this->montitle('Why is it important').'
						<p>
						Having a registered company allows your company to trade professional and legally. It allows you to have a bank account and it gives you the “limited liability” rule which then deems the company a separate legal entity to you. This means you cannot be held liable for the company’s debts or liabilities.';

						$box1 = '
						<div class="image">
							<img src="images/ui/logos.png" alt="Logos"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
					</div>';

					return $html;
				}

				public function AnnualReturnsPage()
				{
					// [+1] Page id
					$page = 'email-hosting';

					// [+2] Text details
					$title = 'What are Annual Returns?';
					$text  = '
					Every company registered under the <a href="http://www.cipc.co.za">Companies and Intellectual Property Commission</a> <b>CIPC</b>, is obligated by Law to return its annual returns. This makes sure that CIPC is informed that your company is still up and running, still abiding by the stipulated regulations of the country.';

					$contentOne = array($title, $text);

					// [+3] Prizing
					// Text
					$text = '
					All listed prices below are charged per Annual Return done for each client. And upfront payment is required to start with the service.';

					// [+4] Box 1
					$title = '1 Year';
					$price = '280';
					$list = array(
						'1 year Annual returns',
						'Check Amount Overdue: <b>FREE</b>',
						'Notification on Submission',
						'Online Support',
						'Refund upon failer',
						'15% Off on Green Books');
					$link = 'purchase/'.$price.'/1st-year-annual-return';
					$boxOne = array($title, $price, $list, $link);

					// [+5] Box 2
					$title = '2 Years';
					$price = '560';
					$list = array(
						'2 Years Annual returns',
						'Check Amount Overdue: <b>FREE</b>',
						'Notification on Submission',
						'Online Support',
						'Refund upon failer',
						'15% Off on Green Books');
					$link = 'purchase/'.$price.'/2nd-year-annual-return';
					$boxTwo = array($title, $price, $list, $link);

					// [+6] Box 3
					$title = '3 Years';
					$price = '840';
					$list = array(
						'3 Years Annual returns',
						'Check Amount Overdue: <b>FREE</b>',
						'Notification on Submission',
						'Online Support',
						'Refund upon failer',
						'15% Off on Green Books');
					$link = 'purchase/'.$price.'/3rd-year-annual-return';
					$boxThree = array($title, $price, $list, $link);

					$pricing = array($text, $boxOne, $boxTwo, $boxThree);

					// [+7] Text details
					$title = 'When are YOU Required to Submit Annual Returns?';
					$text  = '
					Companies have 30 business days from the date the entity becomes due to lodge 
						annual returns, thereafter penalties are due. And non compliance may lead to 
						company  de registration. Find out how much you owe, for free at focalsoft.'; 
					$contentTwo = array($title, $text);

					// return to the caller
					return $this->product_template($page, $contentOne, $pricing, $contentTwo);
				}

				/**
				 *    BRAND DIVISION
				 */
				public function VideographyPage()
				{
					$html = '
					<div id="videography-page" class="content focal-product-page">';

						$title = 'Why do you need a professional videography?';
						$text = '
						Capturing a moment in time is not so easy as many would think. We capture your moments as it happens and use our skills to edit and tell a story that would make your audience connect with your event as if they were <span id="hilight">personally</span> there.';

					$html .= 
						$this->text_block($title, $text);

						// Boxes
						$box = 
						$this->montitle('Importantance of professional photography.').'
						<p>
						Professional videography allows you to showcase your business or gala dinner event in a professional manner. Each frame tells a unique story that could not be captured by any average videographer. Our services range from music videos, commercials, wedding videos, gala events to movies.';

						$box1 = '
						<div class="image">
							<img src="images/ui/logos.png" alt="Logos"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
					</div>';

					return $html;
				}

				public function PhotographyPage()
				{
					$html = '
					<div id="photography-page" class="content focal-product-page">';

						$title = 'Why do you need a professional photography?';
						$text = '
						Pictures are easy to remember compared to words. We capture the moments in time with our <b>in-house</b> photography team. Our photography services can range from business photography to modeling photography.';

					$html .= 
						$this->text_block($title, $text);

						// Boxes
						$box = 
						$this->montitle('Importantance of professional photography.').'
						<p>
						Professional photography allows you to showcase your business or gala dinner event in a professional manner. Each photo tells a story that could not be captured by an average photographer using a cellphone. Our photography team makes sure you get the best service possible.';

						$box1 = '
						<div class="image">
							<img src="images/ui/logos.png" alt="Logos"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
					</div>';

					return $html;
				}

				public function CloudComputingPage()
				{
					$html = '
					<div id="cloud-page" class="content focal-product-page">';

						$title = 'What is cloud computing?';
						$text = '
						Cloud computing is a form of computing that relies on sharing of computer resources to make sure the organization runs smoothly. The entire computing is based on the internet which makes it easy to maintain and automate any mundane processes.';

					$html .= 
						$this->text_block($title, $text);

						// Boxes
						$box = 
						$this->montitle('Why it is cloud computing important for your business.').'
						<p>
						Cloud computing plays a vital role in many organization. It allows your organization to optimize its workflow in form of integrated systems that communicate to each other over the internet. Cloud computing also allows us to store all of the organization data to prevent any data loss or theft.';

						$box1 = '
						<div class="image">
							<img src="images/ui/logos.png" alt="Logos"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
					</div>';

					return $html;
				}

				public function WebHostingPage()
				{
					// [+1] Page id
					$page = 'email-hosting';

					// [+2] Text details
					$title = 'What is web hosting?';
					$text  = '
					Web hosting is simply the storage of your website files in a certain super computer that is not supposed to shut down. This allows all the users to connect to your company\'s website at any given time.';

					$contentOne = array($title, $text);

					// [+3] Prizing
					// Text
					$text = '
						All listed prices below are charged annually.';

					// [+4] Box 1
					$title = 'Starter';
					$price = '499';
					$list = array(
						'Free <b>.co.za</b> address',
						'10 email accounts',
						'250 MB diskspace',
						'Wordpress and Joomla',
						'Online Support');
					$link = 'purchase/'.$price.'/starter-web-hosting';
					$boxOne = array($title, $price, $list, $link);

					// [+5] Box 2
					$title = 'Economy';
					$price = '699';
					$list = array(
						'Free <b>.co.za</b> address',
						'15 email accounts',
						'500 MB diskspace',
						'Wordpress and Joomla',
						'Online Support');
					$link = 'purchase/'.$price.'/economy-web-hosting';
					$boxTwo = array($title, $price, $list, $link);

					// [+6] Box 3
					$title = 'Business';
					$price = '899';
					$list = array(
						'Free <b>.co.za</b> address',
						'20 email accounts',
						'750 MB diskspace',
						'Wordpress and Joomla',
						'Online Support');
					$link = 'purchase/'.$price.'/business-web-hosting';
					$boxThree = array($title, $price, $list, $link);

					$pricing = array($text, $boxOne, $boxTwo, $boxThree);

					// [+7] Text details
					$title = 'Why it is important to have web hosting for your business?';
					$text  = '
					Web hosting makes sure your website or application files are always reachable to all of your users. Focal Host uses servers that are not likely to go down and leave you with an "unreachable" website or application.'; 
					$contentTwo = array($title, $text);

					// return to the caller
					return $this->product_template($page, $contentOne, $pricing, $contentTwo);
				}

   				public function EmailHostingPage()
				{
					// [+1] Page id
					$page = 'email-hosting';

					// [+2] Text details
					$title = 'Why should you need a custom email?';
					$text  = '
					Many small businesses undermine the importance of having a professional email. If you send an email and it still ends with a "<b>gmail</b>" or a "<b>yahoo</b>", you might be in danger of losing potential clients. It all about presentation and perception.';

					$contentOne = array($title, $text);

					// [+3] Prizing
					// Text
					$text = '
						All listed prices below are charged annually.';

					// [+4] Box 1
					$title = 'Starter';
					$price = '399';
					$list = array(
						'Free <b>.co.za</b> address',
						'5 email accounts',
						'100 MB Diskspace',
						'Signature Design',
						'Gmail / Outlook Synchronization ',
						'Monthly data backup',
						'Applicable for 12 months',
						'Online & Telephonically Support');
					$link = 'purchase/'.$price.'/starter-hosting';
					$boxOne = array($title, $price, $list, $link);

					// [+5] Box 2
					$title = 'Economy';
					$price = '499';
					$list = array(
						'Free <b>.co.za</b> address',
						'10 email accounts',
						'250 MB Diskspace',
						'Signature Design',
						'Gmail / Outlook Synchronization ',
						'Monthly data backup',
						'Applicable for 12 months',
						'Online & Telephonically Support');
					$link = 'purchase/'.$price.'/economy-hosting';
					$boxTwo = array($title, $price, $list, $link);

					// [+6] Box 3
					$title = 'Business';
					$price = '699';
					$list = array(
						'Free <b>.co.za</b> address',
						'25 email accounts',
						'500 MB Diskspace',
						'Signature Design',
						'Gmail / Outlook Synchronization ',
						'Monthly data backup',
						'Applicable for 12 months',
						'Online & Telephonically Support');
					$link = 'purchase/'.$price.'/business-hosting';
					$boxThree = array($title, $price, $list, $link);

					$pricing = array($text, $boxOne, $boxTwo, $boxThree);

					// [+7] Text details
					$title = 'importantance of a professional email';
					$text  = '
					They say <i>"first impression lasts"</i>. Impress your clients by representing your business as professional as possible. Using <b>free-of-charge</b> emails providers can save you a couple of bucks a year but lose hundreds of thousands of rands from potential clients who couldn\'t take your business serious due to the way you sold your business to them.'; 
					$contentTwo = array($title, $text);

					// return to the caller
					return $this->product_template($page, $contentOne, $pricing, $contentTwo);
				} 

				public function MobileAppPage()
				{
					$html = '
					<div class="content focal-product-page">';

						$title = 'Why do you need a mobile app?';
						$text = '
						With the ever increasing number of smartphone uses, it makes sense that there would be more demand of easy excess to information. We design, develop and market mobile apps that helps organizations run smoothly.';

					$html .= 
						$this->text_block($title, $text);

						// Boxes
						$box = 
						$this->montitle('Why it is important to have a Mobile App?').'
						<p>
						Mobile applications give your organization an advantage of understanding your clients better since you can study their behavior with the app and get to customize their service based on their behavior. It becomes our duty to make sure that we design and develop these mobile apps according to your specifications to make sure you get to achieve your business goals.';

						$box1 = '
						<div class="image">
							<img src="images/ui/gold-phone.png" alt="phone"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>';

						$title = 'OUR PRICING';
						$text = '
						Since developing a mobile app requires understanding each organization\'s needs, we do not have set or fixed prices other than the base price of <span id="hilight">R10 500</span> going upwards.';

						$html .=
							$this->text_block($title, $text, 'blue').'
					</div>';

					return $html;
				}

				public function CloudSystemPage()
				{
					$html = '
					<div class="content focal-product-page">';

						$title = 'Why do you need a cloud system?';
						$text = '
						As companies grow, many components become hard to maintain and keep track of, unless there is a form of computerized support solutions. Our company strategize, design and develop systems that help many big organizations run smoothly and focus on what they are good at.';

					$html .= 
						$this->text_block($title, $text);

						// Boxes
						$box = 
						$this->montitle('Why it is important to have a Custom Cloud System?').'
						<p>
						Most organizations need some sort of system to make sure everything runs according to plan mostly if it is a big organization. We provide custom software development for such organizations, making sure they get to achieve whatever set of goals they are aiming for.';

						$box1 = '
						<div class="image">
							<img src="images/ui/gold-phone.png" alt="phone"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>';

						$title = 'OUR PRICING';
						$text = '
						Since developing a customized system or software requires studying and understanding each organization\'s needs, we do not have set prices other than the base price of <span id="hilight">R15 500</span>. An upfront deposit of 25% is required to begin the work. Most of the time, such projects have different payment stages allowing you as a client to budget in advance.';

						$html .=
							$this->text_block($title, $text, 'blue').'
					</div>'.$this->moreServices();

					return $html;
				}

				public function WebDevPage()
				{
					// [+1] Page id
					$page = 'development';

					// [+2] Box 1
					$title = 'One-Pager Website';
					$price = array('1799', 'R', 'min');
					$list = array(
						'Free <span class="bold">.co.za</span> domain',
						'5 email accounts',
						'250 Mb Disk space',
						'Mobile optimization',
						'Social Media page designs',
						'Google Business Listing',
						'15% Off on '.$this->gb());
					$link = 'purchase/'.$price[0].'/one-pager-website';
					$boxOne = array($title, $price, $list, $link);

					// [+3] Box 2
					$title = 'Portfolio Website';
					$price = array('3499', 'R', 'min');
					$list = array(
						'Free <span class="bold">.co.za</span> domain',
						'10 email accounts',
						'250 Mb Disk space',
						'10 page website',
						'Mobile optimization',
						'Social Media page designs',
						'35% Off on '.$this->gb());
					$link = 'purchase/'.$price[0].'/portfolio-website';
					$boxTwo = array($title, $price, $list, $link);

					// [+4] Box 3
					$title = 'eCommerce Website';
					$price = array('5499', 'R', 'min');
					$list = array(
						'Free <span class="bold">.co.za</span> domain',
						'20 email accounts',
						'500 Mb Disk space',
						'unlimited website',
						'Mobile optimization',
						'Weekly Database backup',
						'50% Off on '.$this->gb());
					$link = 'purchase/'.$price[0].'/ecommerce-website';
					$boxThree = array($title, $price, $list, $link);

					// [+5] Box 4
					$title = 'Standard Online Shop';
					$price = array('5499', 'R', 'min');
					$list = array(
						'Free <span class="bold">.co.za</span> domain',
						'20 email accounts',
						'500 Mb Disk space',
						'unlimited website',
						'Mobile optimization',
						'Weekly Database backup',
						'50% Off on '.$this->gb());
					$link = 'purchase/'.$price[0].'/ecommerce-website';
					$boxFour = array($title, $price, $list, $link);

					$pricing = array($boxOne, $boxTwo, $boxThree, $boxFour);

					return $this->plain_product_template($page, $pricing);
				} 


				public function gb()
				{
					return '<span id="hilight" class="gb">Green Books</span>';
				}

				public function MarketingPage()
				{
					// [+1] Page id
					$page = 'marketing';

					// [+2] Text details
					$title = 'Why should you even care about marketing?';
					$text  = '
					Ever wondered why other brands are more famous than others? Well, there is a simple answer to that, <b>proactive marketing</b>. Successful organizations spend alot of time in marketing their products or services to their customers and potential customers. You probably landed on this page because we did some form of marketing to bring our brand to your awerness.';

					$contentOne = array($title, $text);

					// [+3] Prizing
					// Text
					$text = '
					Ofcourse we can’t just ramble about marketing without providing a solution. Below are ALL of our marketing packages.';

					// [+4] Box 1
					$title = 'Entrance Marketing';
					$price = array('799', 'R', '/pm');
					$list = array(
						'4 graphic designs <span class="bold">/pm</span> ',
						'Banner + Avatar designs',
						'2 weekly user-engagement',
						'Google Business Profile',
						'1 x monthly-report');
					$link = 'purchase/'.$price[0].'/entrance-marketing';
					$boxOne = array($title, $price, $list, $link);

					// [+5] Box 2
					$title = 'Intermediate Marketing';
					$price = array('1199', 'R', '/pm');
					$list = array(
						'6 graphic designs <span class="bold">/pm</span> ',
						'Banner + Avatar designs',
						'2 weekly user-engagement',
						'R 199 for paid-advertising',
						'Google Business Profile',
						'1 x monthly-report');
					$link = 'purchase/'.$price[0].'/intermediate-marketing';
					$boxTwo = array($title, $price, $list, $link);

					// [+6] Box 3
					$title = 'Corporate Marketing';
					$price = array('2399', 'R', '/pm');
					$list = array(
						'10 graphic designs <span class="bold">/pm</span> ',
						'Banner + Avatar designs',
						'Daily user-engagement',
						'R 399 for paid-advertising',
						'Google Business Profile',
						'1 x monthly-report');
					$boxThree = array($title, $price, $list, $link);

					$pricing = array($text, $boxOne, $boxTwo, $boxThree);

					// [+7] Text details
					$title = 'Why it is important to have Marketing in your organization?';
					$text  = '
					<i>Out of sight, out of mind</i>". If people do not see your brand or organization, they don\'t get to buy from it. We use different methods to market your brand to your potential customers, <b>social media</b> being one of them. We come up with marketing strategies that would allow your business to grow much more further.'; 
					$contentTwo = array($title, $text);

					// return to the caller
					return $this->product_template($page, $contentOne, $pricing, $contentTwo);
				} 

				public function PortfolioDesignPage()
				{
					// [+1] Page id
					$page = 'portfolio';

					// [+2] Text details
					$title = 'why do you need a Portfolio Design.';
					$text  = '
					You will always be misunderstod if you dont get to explain yourself in your own terms and you can\'t afford to let your organization be misunderstood for what it represent. Professionally designed business portfolios then become your mouthpiece when you are not around to explain your business to potential clients or investors.';

					$contentOne = array($title, $text);

					// [+3] Prizing
					// Text
					$text = '
					An upfront payment of 50% is required to start with the work. Design concepts should be ready in no less than 72 hours max.';

					// [+4] Box 1
					$title = 'Starter';
					$price = '699';
					$list = array(
						'2 design concepts',
						'1 design revision',
						'Cover Page Design',
						'Content Page Design',
						'Back Page Design',
						'Content alignment',);
					$link = 'purchase/'.$price.'/portfolio-starter';
					$boxOne = array($title, $price, $list, $link);

					// [+5] Box 2
					$title = 'Economy';
					$price = '899';
					$list = array(
						'3 design concepts',
						'1 design revision',
						'Professional Photography',
						'Cover Page Design',
						'Content Page Design',
						'Back Page Design',
						'Content alignment',);
					$link = 'purchase/'.$price.'/portfolio-economy';
					$boxTwo = array($title, $price, $list, $link);

					// [+6] Box 3
					$title = 'Business';
					$price = '1399';
					$list = array(
						'3 design concepts',
						'2 design revisions',
						'**Content drafted in-house',
						'Professional Photography',
						'Cover Page Design',
						'Content Page Design',
						'Back Page Design',
						'Content alignment',);
					$link = 'purchase/'.$price.'/portfolio-business';
					$boxThree = array($title, $price, $list, $link);

					$pricing = array($text, $boxOne, $boxTwo, $boxThree);

					// [+7] Text details
					$title = 'what is the importance of a professional business portfolio?';
					$text  = '
					Well, that is simple, to tell a story behind your organization. Professional portfolios play a huge role in painting a bright picture of where your company or organization might have started from, where it is and what is its main ambition. We design compelling designs and take professional images that would sell a professional look to your potential clients or investors.'; 
					$contentTwo = array($title, $text);

					// return to the caller
					return $this->product_template($page, $contentOne, $pricing, $contentTwo);
				} 

				public function LogoDesignPage()
				{
					// [+1] Page id
					$page = 'logo';

					// [+2] Text details
					$title = 'Why do you need a logo?';
					$text  = '
					Business is all about keeping your customers buying from you not your competitor. Many elements influence how people constantly use your brand and a logo is one of them. A logo is the face of your organization, it tells a story about your organization.';

					$contentOne = array($title, $text);

					// [+3] Prizing
					// Text
					$text = '
					An upfront payment of 50% is required to start with the work. Design concepts should be ready in no less than 72 hours max.';

					// [+4] Box 1
					$title = 'Starter';
					$price = '399';
					$list = array(
						'1 design concepts',
						'1 revision to the concept',
						'jpeg format',
						'png format',
						'24 hr turnaround');
					$link = 'purchase/'.$price.'/basic-logo';
					$boxOne = array($title, $price, $list, $link);

					// [+5] Box 2
					$title = 'Economy';
					$price = '699';
					$list = array(
						'2 design concepts',
						'2 revisions to the concept',
						'jpeg format',
						'png format',
						'48 hr turnaround');
					$link = 'purchase/'.$price.'/intermediate-logo';
					$boxTwo = array($title, $price, $list, $link);

					// [+6] Box 3
					$title = 'Business';
					$price = '799';
					$list = array(
						'3 design concepts',
						'3 revisions to the concept',
						'jpeg format',
						'png format',
						'72 hr turnaround');
					$link = 'purchase/'.$price.'/corporate-logo';
					$boxThree = array($title, $price, $list, $link);

					$pricing = array($text, $boxOne, $boxTwo, $boxThree);

					// [+7] Text details
					$title = 'importance of a professional logo?';
					$text  = '
					Every successful organization understands the very simple rule, "<i>you need to be always in your potential client\'s minds over your competitor</i>". A well-designed logo helps your clients and targeted clients easily remember what you have to offer as an organization.'; 
					$contentTwo = array($title, $text);

					// return to the caller
					return $this->product_template($page, $contentOne, $pricing, $contentTwo);
				} 

				public function BrandingPage()
				{
					// [+1] Page id
					$page = 'branding';

					// [+2] Text details
					$title = 'What is branding?';
					$text  = '
					Branding is the magic that makes the same coffee cup retail at different prices. It is the magic that makes consumers prefer one item over another. Branding is what keeps the consumer loyal to the product or service. We help organizations build <b>brand equity</b> that sets them apart from their competition. Our branding ranges from startup branding, car branding to product branding.';

					$contentOne = array($title, $text);

					// [+3] Prizing
					// Text
					$text = '
					An upfront payment of 50% is required to start with the work. Design concepts should be ready in no less than 72 hours max.';

					// [+4] Box 1
					$title = 'Basic Branding';
					$price = '699';
					$list = array(
						'Logo Design',
						'Quotation Design',
						'Invoice Design',
						'Letter Head Design',
						'15% Off on Green Books');
					$link = 'purchase/'.$price.'/basic-branding';
					$boxOne = array($title, $price, $list, $link);

					// [+5] Box 2
					$title = 'Intermediate Branding';
					$price = '1299';
					$list = array(
						'Logo Design',
						'Signature Design',
						'Quotation Design',
						'10 Custom Emails',
						'Invoice Design',
						'Letter Head Design',
						'35% Off on Green Books');
					$link = 'purchase/'.$price.'/intermediate-branding';
					$boxTwo = array($title, $price, $list, $link);

					// [+6] Box 3
					$title = 'Corporate Branding';
					$price = '1699';
					$list = array(
						'Logo Design',
						'Signature Design',
						'10 Custom Emails',
						'Business Card Design',
						'100 Printed Business Cards',
						'Stationary Design',
						'50% Off on Green Books');
					$link = 'purchase/'.$price.'/corporate-branding';
					$boxThree = array($title, $price, $list, $link);

					$pricing = array($text, $boxOne, $boxTwo, $boxThree);

					// [+7] Text details
					$title = 'Why it is important to brand your company fleet?';
					$text  = '
					Branding is a very broad topic which involves marketing, repackaging and business image development. Branding is an unspoken word that tells a story about your organization. It makes people care or not about your organization and your can’t afford to leave that to chance. If your company is well-branded you get to make potential customers become aware of your organization.'; 
					$contentTwo = array($title, $text);

					// return to the caller
					return $this->product_template($page, $contentOne, $pricing, $contentTwo);
				} 


				public function plain_product_template($id, $pricing)
				{
 
					$html = '
					<div id="'.$id.'-page" class="content focal-product-page">
						<div id="pricing-div" class="pricing-div color-div cf">
							<div class="dmsn">
							'.$this->montitle('Choose your plan');

							// Initialise discount
							$discount = false;

							// Add all boxes
							for($i=0; $i<count($pricing); $i++)
							{
								$boxes[] = $this->ui_pricing_box($pricing[$i][0], $pricing[$i][1], $pricing[$i][2], $pricing[$i][3]);
							}

						$html .= 
							$this->grid($boxes, 'pricing').'
							</div>
							<div class="custom-request">
								'.$this->ui_icon('chatbox.png', 120, 121)
								 .$this->montitle('Something more custom?').'
								<p>
								Looking for something beyond or more customised to what is listed above? Let us know and we will work something out!
								<div>
									<a href="planner"> <button class="green">Talk to us</button> </a>
								</div>
							</div>
						</div>
					</div>';

					// return to the caller
					return $html;
				}

				public function product_template($id, $contentOne, $pricing, $contentTwo)
				{
 
					$html = '
					<div id="'.$id.'-page" class="content focal-product-page">
						'.$this->text_block($contentOne[0], $contentOne[1]);

						// Compose pricing
						$html .= '
						<div id="pricing-div" class="pricing-div color-div cf">
							<div class="dmsn">
							'.$this->montitle('OUR PRICING').'
							<p>
								'.$pricing[0];

							// Box 1
							$boxOne = $this->ui_pricing_box($pricing[1][0], $pricing[1][1], $pricing[1][2], $pricing[1][3]);

							// Box 2
							$boxTwo = $this->ui_pricing_box($pricing[2][0], $pricing[2][1], $pricing[2][2], $pricing[2][3], 'active');

							// Box 3
							$boxThree = $this->ui_pricing_box($pricing[3][0], $pricing[3][1], $pricing[3][2], $pricing[3][3]);

						$html .= 
							$this->grid(array($boxOne, $boxTwo, $boxThree), 'pricing').'
							</div>
						</div>';

					$html .= 
						$this->text_block($contentTwo[0], $contentTwo[1], 'blue').'
					</div>';

					// return to the caller
					return $html;
				}
					public function text_block($title, $text, $color='orange')
					{
						return '
						<div class="introduction cf">
							'.$this->ui_highlight(strtoupper($title), $color).'
							<p>
								'.$text.'
						</div>';
					}

			/**
			 * This function builds focal division page
			 */
			public function FocalPage()
			{
				if( isset($_GET['d']) ) 
				{
					// Division
					$division = $_GET['d'];

					// Choose the appropiate page
					switch ($division) 
					{
						case 'focalbrand':
							$html = $this->FocalBrandPage(); break;
						
						default:
							header('location: '); break;
					}

					// Return to the caller
					return '
					<div id="'.$division.'" class="focal-page">
						'.$html.'
					</div>';

				}else
					header('location: ');
			}	
				public function FocalBrandPage()
				{
					$html = 
					$this->CategorySplash().'
					<div class="content">
						<div class="introduction dmsn">
							'.$this->montitle('why should you care about branding.').'
							<p>
								Branding is the magic that makes the same coffee cup retail at different prices. It the magic that makes consumers prefer one item over another. We help organizations build brand equity that set them apart from the competition.
						</div>';

						// Boxes
						$box = 
						$this->montitle('what is the importance of branding?').'
						<p>
						Branding is a very broad topic which involves marketing, repackaging and business image development.  Branding is an unspoken word that tells a story about your organization. It makes people care or not about your organization and your can’t afford to leave that to chance.';

						$box1 = '
						<div class="image">
							<img src="images/ui/gold-phone.png" alt="Gold Phone"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
						<div class="solutions-div dmsn cf">
							'.$this->montitle('what we offer?').'
							<p>
							Ofcourse we can’t just ramble about branding without providing a solution. Below are ALL of our branding solutions.';

							// Division 
							$division = $_GET['d'];

							// Loop
							$focalbrand = array(
								'Branding' => array('branding', 'branding.png'),
								'Logo Design' => array('logo-design', 'logo-design.png'),
								'Portfolio Design' => array('portfolio-design', 'portfolio.png'),
								'Marketing' => array('marketing', 'marketing.png'),
							);

							$services = array();
							while(list($label, $data) = each($focalbrand))
							{
								// Retrieve
								$link = $data[0];
								$image = $data[1];

								// Link
								$link = 'product/'.$division.'/'.$link;
								$box  = $this->solutionBox($label, $image, $link);

								// Add 
								$services[] = $box;
							}

					$html .= 
							$this->grid($services, 'solutions').'
						</div>
					</div>';

					return $html;
				}
					public function solutionBox($title, $img, $link='#')
					{
						return '
						<div class="image cf">
							<img src="images/ui/'.$img.'" alt="'.$title.'" />
						</div>
						<div class="label">
							'.$title.'
						</div>'.
						$this->ui_ctru_btn('READ MORE', $link, 'bck');
					}

				public function montitle($title, $line=false)
				{
					$html = '
					<div class="montitle">
						'.strtoupper($title);

						if($line == true)
							$html .= '
							<div class="ui-line"></div>';

					$html .= '
					</div>';

					return $html;
				}

				public function CategorySplash($background='keyboard-splash.png')
				{
					return '
					<div id="focal-splash" class="inner-page-splash bck-cover"
						style="background: url(images/ui/'.$background.')">
						'.$this->ui_ctru_title('FOCAL BRAND').'
						<div class="description">
							Focal Brand focuses mainly in brand development for all of our clients. It might be starting afresh or revamping the brand already existing.
						</div>
					</div>';
				}

			public function PurchasePage()
			{
				if(isset($_GET['package']))
				{
					// Package
					$price    = $_GET['price'];
					$packageR = $_GET['package'];
					$package  = str_replace('-', ' ', $packageR);

					// Form
					$formId = 'purchase';
					$form = array(
						array('Fullname', 'text', 'fullname'), 
						array('Email', 'text', 'email'), 
						array('Cell', 'text', 'cell'), 
						array('package', 'hidden', $package),
					); 

					return '
					<script>
						fbq(\'track\', \'AddToCart\', {
							content_ids: ['.$packageR.'],
							content_type: \'product\',
							value: '.$price.',
							currency: \'ZAR\'
						});
					</script>

					<div id="planner-page" class="dmsn page cf">
						<div class="image">
							<img src="images/ui/rocket.png" alt="Rocket" />
						</div>
						<div class="ui-line"></div>
						<div class="texty">
							Hi there, thanks for purchasing a <span id="hilight">'.ucwords($package).'</span> package with us. Please fill in the below form so we will get back to you as soon as possible.
						</div>
						'.$this->ui_smart_form($formId, $form, 'one-in').'
					</div>';
				}else
					header('location: ');
			}

			public function DivisionPage()
			{
				// Office Solutions
				$text = '
				Behind every successful organization there is an active branding team sweating. We give your organization the professional image it deserves to grow much further.';

				$text_1 = '
				We design and develop digital platforms that improve your business. 
				It could be a simple website, ecommerce site, mobile app to system integration. ';

				$text_2 = '
				At heart we are very geeky, we love fiddling with machines. Let us take care of your entire ICT, from hosting, cloud computing to networking. Let us keep your IT up to standard.';

				$text_3 = '
				Anything that has to do with Photography, Videography and event management get us excited. It becomes our duty to get you the best possible presentation / image that will last.';

				$office = array(
							$this->wdo_text('certificates.png', 'CERTIFICATES', $text),
							$this->wdo_text('registrations.png', 'REGISTRATIONS', $text_1),
							$this->wdo_text('compliance.png', 'COMPLIANCE', $text_2),
							$this->wdo_text('amendments.png', 'AMENDMENTS', $text_3)
						);

				// Brand Solutions
				$text = '
				Behind every successful organization there is an active branding team sweating. We give your organization the professional image it deserves to grow much further.';

				$text_1 = '
				We design and develop digital platforms that improve your business. 
				It could be a simple website, ecommerce site, mobile app to system integration. ';

				$text_2 = '
				At heart we are very geeky, we love fiddling with machines. Let us take care of your entire ICT, from hosting, cloud computing to networking. Let us keep your IT up to standard.';

				$text_3 = '
				Anything that has to do with Photography, Videography and event management get us excited. It becomes our duty to get you the best possible presentation / image that will last.';

				$brand = array(
							$this->wdo_text('branding.png', 'BRANDING', $text),
							$this->wdo_text('development.png', 'CODING', $text_1),
							$this->wdo_text('hosting.png', 'CLOUD HOSTING', $text_2),
							$this->wdo_text('production.png', 'PRODUCTION', $text_3)
						);

				// Compose the appropiate page
				if(isset($_GET['div']) && $_GET['div'] == 'office'){
					// Title
					$data_title = 'OFFICE';
					
					// data
					$data = $office;
				}else{
					// Title
					$data_title = 'BRAND';

					// data
					$data = $brand;
				}

				return '
				<div id="division-page" class="page">
					<div class="what-we-do dmsn">
						'.$this->ui_highlight($data_title.' DIVISION').'
						<div class="content">
							'.$this->grid($data).'
						</div>
					</div>
				</div>'.
				$this->moreServices();
			}

			/**
			 * This function builds the homepage for our application
			 */
			public function HomePage()
			{
				$html = '
				<div id="home-page" class="cf">
					<div class="service-section cf"> 
						<div class="dmsn cf">';

							// Left Side
							$title = 'It all starts with proper paperwork.';
							$text= '
							Let us take care of all of your paperwork so you can fiocus on the bigger picture - making your company profitable';
							$url = '#';

							$left = $this->ActionBarBox($title, $text, $url);

							// Right side
							$right = '<img src="images/ui/paperwork.png" />';

							$html .= $this->grid(array($left, $right)).'
						</div>
					</div>
					<div class="why-us-section">
						<div class="dmsn">
							<div class="title">
								Why Choose Us
								<div class="ui-line"></div>
							</div>';

								// Box 1
								$img = 'ui/paper-kite.png';
								$text = '
								<div class="title">Efficient</div>
								<p>
									Let us take care of all of your paperwork so you can fiocus on the bigger picture - making your company profitable';
								$box1 = $this->ui_image_text($img, $text);

								// Box 2
								$img = 'ui/rocket.png';
								$text = '
								<div class="title">Innovative</div>
								<p>
									Let us take care of all of your paperwork so you can fiocus on the bigger picture - making your company profitable';
								$box2 = $this->ui_image_text($img, $text);

								// Box 2
								$img = 'ui/trophy.png';
								$text = '
								<div class="title">Reliable</div>
								<p>
									Let us take care of all of your paperwork so you can fiocus on the bigger picture - making your company profitable';
								$box3 = $this->ui_image_text($img, $text);

						$html .= 
							$this->grid(array($box1, $box2, $box3)).'
						</div>
					</div>
					'.$this->moreServices().'
				</div>';

				return $html;
			}
				public function gb_fb_page_plugin()
				{
					$dimensions = ($this->device != 'mobile')? 'data-width="400" data-height="280"' : false;

					return '
					<div class="fb-page" data-href="https://www.facebook.com/FocalsoftCompany/" data-tabs="timeline" '.$dimensions.' data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
						<blockquote cite="https://www.facebook.com/FocalsoftCompany/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/FocalsoftCompany/">Focalsoft</a></blockquote>
					</div>';
				}

				public function wdo_text($image, $title, $text, $link='#')
				{
					return '
					<div class="wdo-text">
						<div class="image">
							<img src="images/icons/'.$image.'" alt="'.ucwords($title).'" />
						</div>
						<div class="title">
							'.ucwords($title).'
						</div>
						<div class="ui-line"></div>
						<p>
							'.$text
						.$this->ui_ctru_btn('READ MORE', $link, 'bck').'
					</div>';
				}

				public function HomeSplash()
				{
					// Title
					$title = 'What We Do';

					$text = '
					We focus on the finer details, so you focus on the bigger picture. We help all kind of businesses with essential tools they need to get started, stay sustainable &amp be profitable.';
					$text = $this->ui_highlight(strtoupper($text));

					return '
					<div class="cf main-image">
						<img src="images/ui/business-solutions.png" alt="Business Solutions" />
					</div>
					<div class="ui-line"></div>
					<div class="text">
						'.$text.'
					</div>';
				}

				public function DefaultSplash($title, $img, $description, $type="normal")
				{
					return '
					<div id="default-splash" class="inner-page-splash '.$type.' bck-cover"
						style="background: url(images/ui/'.$img.')">
						'.$this->ui_ctru_title($title).'
						<div class="description">
							'.$description.'
						</div>
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
			
		/**
		  * ---------------------------------- Footer -------------------------------------- 
		  *
		  * This function is just responsible for building us the footer for the website. 
		  */
		public function footer($isPlain=false)
		{
			return '
					<div id="footer">
						<div class="dmsn cf">
							'.$this->listFooter( array_merge($this->sitemap, array('STARTUP PACKAGE'   => 'startup-package')),'list', 'SITEMAP')
							.$this->listFooter($this->brand_solutions, 'list', 'SOLUTIONS')
							 .$this->listFooter($this->socialinks, 'list', 'SOCIAL MEDIA')
							 .$this->listFooter($this->partners, 'list', 'STRATEGIC PARTNERS')
							 .$this->ui_focalsoft_small_logo().'
						</div>
					</div> 
					<div id="fs-link">
						Crafted with passion by <a href="http://www.focalsoft.co.za" target="_blank">FOCALSOFT</a>
					</div>   
					'.$this->GetJS().'	
					<!--Start of Tawk.to Script-->
					<script type="text/javascript">
						var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
						(function(){
						var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
						s1.async=true;
						s1.src=\'https://embed.tawk.to/5915a12b64f23d19a89b1dbd/default\';
						s1.charset=\'UTF-8\';
						s1.setAttribute(\'crossorigin\',\'*\');
						s0.parentNode.insertBefore(s1,s0);
						})();
					</script>
					<!--End of Tawk.to Script-->

					<!-- Google Analytics Script-->
					<script>
						(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
						(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
						m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
						})(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');

						ga(\'create\', \'UA-78374632-1\', \'auto\');
						ga(\'send\', \'pageview\');
					</script>
					</div>
				</body>
			</html>';
		}
  }
?>