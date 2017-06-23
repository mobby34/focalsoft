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
			     						'Email Hosting' => 'product/focalhost/email-hosting',
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
			     						'Pty LTD Registration' => '#',
			     						'CSD: Central Supplier Database' => '#',
			     						'Google Business Listing' => '#',
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
				     'REGISTRATIONS'.$this->registrations => '#',
				     'AMENDMENTS'.$this->amendments => '#',
				     'COMPLIANCE'.$this->compliance => '#',
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
				      'OUR WORK'  => 'our-work/all',
				      'ABOUT US'   => 'company', 
			);

			// Set menulist
			$this->menulist = array(
					  'HOME' => '',
					  'OFFICE' => $this->office_solutions,
					  'BRAND' => $this->brand_solutions,
			);
			$this->menulist = array_merge($this->menulist, $this->sitemap);

			// Set social links
			$this->socialinks = array(
						'Facebook' => 'https://www.facebook.com/Focalsoft-385333131656672',
						'Linkedin' => 'https://www.linkedin.com/company/17891556',
						'Google+' => 'https://plus.google.com/101697472394701646965');

			// Set strategic partners
			$this->partners = array(
						'JUSTG Services' => 'http://www.justg.co.za',
						'Uvolwethu Communications' => 'http://www.uvolwethu.com');

			// Then start setting images for the splash with an array called "splashlist"
			$this->splashlist = array(
				'index.php' => array(false, $this->HomeSplash(), 'home' ),
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
			// Get the appropiate style
			$style = ($this->curl == 'index.php')? 'style="background: url(images/ui/splash.jpg)"' : false;

			$html =  '
			<div id="banner" class="cf bck-cover" '.$style.'>
				'.$this->topContacts()
				 .$this->MenuSection();

				if( $this->curl == 'index.php')
					$html .= $this->ui_splash();
			$html .= '
			</div>';

			if( $this->curl == 'index.php')
				$html .= $this->ActionBar();

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
							'.$this->ui_focalsoft_logo($logo).'
						</div>
						'.$this->ui_menu()
						 .$this->mobileLabel()
						 .$this->ui_mobile_menu_button().'
						 <div class="planner '.$startup.' cf">
						 	'.$this->ui_ctru_btn('STARTUP PACKAGE', 'startup-package', 'bck').'
						 </div>
						 <div class="social-media hide cf">';

						 	while(list($label, $url) = each($this->socialinks)){

						 		// If it google+, rewrite it
						 		if($label == 'Google+') $label = "gplus";

						 		$html .= '
							 	<a href="'.$url.'" target="_blank">
							 		<div class="icon '.strtolower($label).'"></div>
							 	</a>';
						 	}

				$html .= '
						 </div>
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
				return '
				<div id="action-bar" class="cf">
					<a href="#">
						<div class="office">
							<div class="title cf">OFFICE</div>
							<p>
								Paperwork can be stressfull. We help businesses sort out their paper work to make sure they run smoothly and abide by all stipulated regulations. 
						</div>
					</a>
					<a href="#">
						<div class="brand">
							<div class="title cf">BRAND</div>
							<p>
								From idealisation to conceptualisation we help our clients build successful brands that speak a human language. We become your silent partners.
						</div>
					</a>
				</div>';
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

				default: 
					$body .= $this->HomePage(); break;
			}

			return $body;
		}
			public function StartupPage()
			{
				$html = '
				<div id="startup-page" class="focal-product-page">
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('Starting Your Business', true).'
							<p>
								Starting a business can be daunting when you have no idea where to start. There is a couple of things that needs to be in place. Most entrepreneurs overlook them because they want to focus solely on the business. You can\'t blame them, that what they are good at, focusing on their businesses not other stuff.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('what we offer').'
						<p>
						Things like registering your business with <a href="http://www.cipc.co.za" target="_blank">CIPC</a> and coming up with a proper logo or branding for your business, might be little bit too much for a start. It becomes overwhelming. You might end up not starting at all because your focus is on other stuff you might not be so good at. We take care of those nitty-gritty details so you focus on the bigger picture, which is building your business. We cover all the necessary basics to get your business up and running.';

						$box1 = '
						<div class="image">
							<img src="images/ui/work-coffee.jpg" alt="Work"/>
						</div>';
					
					$html .= '
						<div class="color-div green cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING').'
							<p>
							An upfront payment is required to start with the work. Refunds are ONLY available if no work was delivered to you as a client.';

						// Box 1
						$title = 'Starter';
						$price = '899';
						$list = array(
							'Logo design (<small style="font-size:70%"><b>2 design concepts</b></small>)',
							'Business Registration',
							'Google Business Listing',
							'Social Media Page Setup + Branding',
							'** Business Reg CIPC approved');
						$link = 'purchase/startup-starter';
						$boxOne = $this->ui_pricing_box($title, $price, $list, $link);

						// Box 2
						$title = 'Economy';
						$price = '1199';
						$list = array(
							'Email Hosting (<small style="font-size:70%"><b>5 accounts max</b></small>)',
							'FREE <small><b>.CO.ZA</b></small> address',
							'Logo design (<small style="font-size:70%"><b>2 design concepts</b></small>)',
							'Business Registration',
							'Google Business Listing',
							'Social Media Page Setup + Branding',
							'** Business Reg CIPC approved',
							'** R299 recurring annual for email hosting',);
						$link = 'purchase/startup-economy';
						$boxTwo = $this->ui_pricing_box($title, $price, $list, $link, 'active');

						// Box 3
						$title = 'Business';
						$price = '1599';
						$list = array(
							'One Page Portfolio Website',
							'Email Hosting (<small style="font-size:70%"><b>5 accounts max</b></small>)',
							'Logo design',
							'Business Registration',
							'Google Business Listing',
							'Social Media Page Setup + Branding',
							'** R299 recurring annual for email hosting',);
						$link = 'purchase/startup-business';
						$boxThree = $this->ui_pricing_box($title, $price, $list, $link);

					$html .= 
							$this->grid(array($boxOne, $boxTwo, $boxThree), 'pricing').'
						</div>
					</div>
				</div>';

				return $html;
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
					$link = 'purchase/basic-branding';
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
					$link = 'purchase/intermediate-branding';
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
					$link = 'purchase/corporate-branding';
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
					$link = 'purchase/one-pager-website';
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
					$link = 'purchase/portfolio-website';
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
					$link = 'purchase/ecommerce-website';
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
					$link = 'purchase/entrance-marketing';
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
					$link = 'purchase/intermediate-marketing';
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
					$link = 'purchase/corporate-marketing';
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
				$projectType = array('Type of Service...', 'Website', 'Logo', 'Marketing', 'Other');
				$form = array(
					array('Fullname', 'text', 'fullname'), 
					array('Email', 'text', 'email'), 
					array('Cell', 'text', 'cell'), 
					array('Company / organization', 'text', 'company'),
					array('Service Type', $projectType, 'service_type'),
				); 

				return '
				<div id="planner-page" class="dmsn page cf">
					<div class="bold-title">
						Let\'s build something <span class="italic">amazing</span> together.
					</div>
					<div class="ui-line"></div>
					<div class="texty">
						Thank you for your interest in working with Focalsoft. Below is the form you will
						have to fill so we will get back to you.
					</div>
					<div class="or circle-rounding">OR</div>
					<div class="texty">
						Send us a direct email to sales@focalsoft.co.za
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
				$cpage = $_GET['q'];

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
						// Videography
						case 'annual-returns':
							$title = 'ANNUAL RETURNS';
							$img = 'returns-splash.jpg';
							$description = '
							We help businesses submit their annual tax returns to make sure they don\'t stand a chance of being deregistered.';
							$content = $this->AnnualReturnsPage(); break;

						// Videography
						case 'videography':
							$title = 'VIDEOGRAPHY';
							$img = 'phone-splash.jpg';
							$description = '
							We tell stories through moving pictures. We capture the true essence of your event or wedding.';
							$content = $this->VideographyPage(); break;

						// Photography
						case 'photography':
							$title = 'PHOTOGRAPHY';
							$img = 'phone-splash.jpg';
							$description = '
							We capture professional images for business events, weddings, product showcase and many more.';
							$content = $this->PhotographyPage(); break;

						// Cloud
						case 'cloud-computing':
							$title = 'CLOUD COMPUTING';
							$img = 'machine-splash.jpg';
							$description = '
							We provide cloud computing for best process automation.';
							$content = $this->CloudComputingPage(); break;

						// Web Hosting
						case 'web-hosting':
							$title = 'WEB HOSTING';
							$img = 'phone-splash.jpg';
							$description = '
							We provide web hosting for startups. medium business to large organizations.';
							$content = $this->WebHostingPage(); break;

						// Email Hosting
						case 'email-hosting':
							$title = 'EMAIL HOSTING';
							$img = 'press-splash.jpg';
							$description = '
							We provide email hosting for our clients from startups, medium businesses to big corporations.';
							$content = $this->EmailHostingPage(); break;

						// Mobile App
						case 'app-development':
							$title = 'MOBILE APP DEV';
							$img = 'phone-splash.jpg';
							$description = '
							Mobile devices are amongst the most used devices in the world with over 1.5 billion people in Africa alone. We develop mobile customized applications for organizations.';
							$content = $this->MobileAppPage(); break;

						// Cloud
						case 'cloud-system-development':
							$title = 'SYSTEM DEV';
							$img = 'code-splash.jpg';
							$description = '
							Software development is one of our strongest capabilities as a company. We develop customized cloud-based systems for organizations.';
							$content = $this->CloudSystemPage(); break;

						// Web Development 
						case 'web-development':
							$title = 'WEB DEVELOPMENT';
							$img = 'phone-splash.jpg';
							$description = '
							We design and develop professional websites that helps your business communicate a message to your clients. All of our websites are mobile-optimized to reach more audience with convenience.';
							$content = $this->WebDevPage(); break;

						// Branding
						case 'branding':
							$title = 'BRANDING';
							$img = 'phone-splash.jpg';
							$description = '
							Focal Brand focuses mainly in brand development for all of our clients. It might be starting afresh or revamping the brand already existing.';
							$content = $this->BrandingPage(); break;

						case 'marketing':
							$title = 'MARKETING';
							$img = 'phone-splash.jpg';
							$description = '
							Brands survive longer because they invest in their marketing departments. We provide outsourced marketing for organization ranging from startups to big corporations.';
							$content = $this->MarketingPage(); break;

						case 'portfolio-design':
							$title = 'PORTFOLIO DESIGN';
							$img = 'papers-splash.jpg';
							$description = '
							We design and draft professional business portfolios that represent you as a professional organization over your competitors.';
							$content = $this->PortfolioDesignPage(); break;

						case 'logo-design':
							$title = 'LOGO DESIGN';
							$img = 'design-splash.jpg';
							$description = '
							We design professional logos that set your organization apart from its competitors. We tell a story through graphics.';
							$content = $this->LogoDesignPage(); break;

						default:
							$title = 'DEFAULT PAGE';
							$img = 'keyboard-splash.png';
							$description = '
							Default stuff here, no custom snitches.';
							$content = 'Default Stuff. No love for custom.'; break;
					}

					// Return to the caller
					return 
					$this->DefaultSplash($title, $img, $description).'
					<div id="'.$product.'-page" class="focal-product-page">
						'.$content.'
					</div>';

				}else
					header('location: ');
			}
				public function AnnualReturnsPage()
				{
					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('What are Annual Returns?').'
							<p>
								Every company registered under the <a href="http://www.cipc.co.za">Companies and Intellectual Property Commission</a> <b>CIPC</b>, is obligated by Law to return its annual returns. This makes sure that CIPC is informed that your company is still up and running, still abiding by the stipulated regulations of the country.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('When are YOU Required to Submit Annual Returns?').'
						<p>
						Companies have 30 business days from the date the entity becomes due to lodge 
						annual returns, thereafter penalties are due. And non compliance may lead to 
						company  de registration. Find out how much you owe, for free at focalsoft.  ';

						$box1 = '
						<div class="image">
							<img src="images/ui/annual-returns.png" alt="Annual Returns"/>
						</div>';

					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING').'
							<p>
							All listed prices below are charged per Annual Return done for each client. And upfront payment is required to start with the service.';

						// Box 1
						$title = '1 Year';
						$price = '280';
						$list = array(
							'1 year Annual returns',
							'Check Amount Overdue: <b>FREE</b>',
							'Notification on Submission',
							'Online Support',
							'Refund upon failer',
							'15% Off on Green Books');
						$link = 'purchase/1st-year-annual-return';
						$boxOne = $this->ui_pricing_box($title, $price, $list, $link);

						// Box 2
						$title = '2 Years';
						$price = '560';
						$list = array(
							'2 Years Annual returns',
							'Check Amount Overdue: <b>FREE</b>',
							'Notification on Submission',
							'Online Support',
							'Refund upon failer',
							'15% Off on Green Books');
						$link = 'purchase/2nd-year-annual-return';
						$boxTwo = $this->ui_pricing_box($title, $price, $list, $link, 'active');

						// Box 3
						$title = '3 Years';
						$price = '840';
						$list = array(
							'3 Years Annual returns',
							'Check Amount Overdue: <b>FREE</b>',
							'Notification on Submission',
							'Online Support',
							'Refund upon failer',
							'15% Off on Green Books');
						$link = 'purchase/3rd-year-annual-return';
						$boxThree = $this->ui_pricing_box($title, $price, $list, $link);

					$html .= 
							$this->grid(array($boxOne, $boxTwo, $boxThree), 'pricing').'
						</div>
					</div>';

					return $html;
				}

				public function VideographyPage()
				{
					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('Why do you need a professional videography?').'
							<p>
								Capturing a moment in time is not so easy as many would think. We capture your moments as it happens and use our skills to edit and tell a story that would make your audience connect with your event as if they were <span id="hilight">personally</span> there.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('Why it is important to have a professional videography?').'
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
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('Why do you need a professional photography?').'
							<p>
								Pictures are easy to remember compared to words. We capture the moments in time with our <b>in-house</b> photography team. Our photography services can range from business photography to modeling photography.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('Why it is important to have professional photography for your business / event?.').'
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
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('What is cloud computing?').'
							<p>
								Cloud computing is a form of computing that relies on sharing of computer resources to make sure the organization runs smoothly. The entire computing is based on the internet which makes it easy to maintain and automate any mundane processes.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('Why it is cloud computing important for your business.').'
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
					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('What is web hosting?').'
							<p>
								Web hosting is simply the storage of your website files in a certain super computer that is not supposed to shut down. This allows all the users to connect to your organoisation website at any given time.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('Why it is important to have web hosting for your business?').'
						<p>
						Web hosting makes sure your website or application files are always reachable to all of your users. Focal Host uses servers that are not likely to go down and leave you with an "unreachable" website or application.';

						$box1 = '
						<div class="image">
							<img src="images/ui/gold-phone.png" alt="phone"/>
						</div>';

					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING').'
							<p>
							All listed prices below are charged annually.';

						// Box 1
						$title = 'Starter';
						$price = '499';
						$list = array(
							'Free <b>.co.za</b> address',
							'10 email accounts',
							'250 MB diskspace',
							'Wordpress and Joomla',
							'Online Support');
						$link = 'purchase/starter-web-hosting';
						$boxOne = $this->ui_pricing_box($title, $price, $list, $link);

						// Box 2
						$title = 'Economy';
						$price = '699';
						$list = array(
							'Free <b>.co.za</b> address',
							'15 email accounts',
							'500 MB diskspace',
							'Wordpress and Joomla',
							'Online Support');
						$link = 'purchase/economy-web-hosting';
						$boxTwo = $this->ui_pricing_box($title, $price, $list, $link, 'active');

						// Box 3
						$title = 'Business';
						$price = '899';
						$list = array(
							'Free <b>.co.za</b> address',
							'20 email accounts',
							'750 MB diskspace',
							'Wordpress and Joomla',
							'Online Support');
						$link = 'purchase/business-web-hosting';
						$boxThree = $this->ui_pricing_box($title, $price, $list, $link);

					$html .= 
							$this->grid(array($boxOne, $boxTwo, $boxThree), 'pricing').'
						</div>
					</div>';

					return $html;
				}

				public function EmailHostingPage()
				{
					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('Why should you need a custom email?').'
							<p>
								Many small companies undermine the importance of having a professional email for your business. If you send an email it still ends with "<b>gmail</b>" or "<b>yahoo</b>", you might be in danger of losing potential clients. It all about presentation and perception.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('Why it is important to have a professional email for your business?').'
						<p>
						They say <i>"first impression lasts"</i>. You can make it a good one, by representing your business as professional as possible. Using <b>free-of-charge</b> email hosting providers can save you a couple of bucks a year but lose hundreds of thousands of rands from potential clients who couldn\'t take your business serious.';

						$box1 = '
						<div class="image">
							<img src="images/ui/gold-phone.png" alt="phone"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING').'
							<p>
							All listed prices below are charged annually.';

						// Box 1
						$title = 'Starter';
						$price = '249';
						$list = array(
							'Free <b>.co.za</b> address',
							'5 email accounts',
							'100 MB Diskspace',
							'Signature Design',
							'Gmail / Outlook Synchronization ',
							'Monthly data backup',
							'Applicable for 12 months',
							'Online & Telephonically Support');
						$link = 'purchase/starter-hosting';
						$boxOne = $this->ui_pricing_box($title, $price, $list, $link);

						// Box 2
						$title = 'Economy';
						$price = '299';
						$list = array(
							'Free <b>.co.za</b> address',
							'10 email accounts',
							'250 MB Diskspace',
							'Signature Design',
							'Gmail / Outlook Synchronization ',
							'Monthly data backup',
							'Applicable for 12 months',
							'Online & Telephonically Support');
						$link = 'purchase/economy-hosting';
						$boxTwo = $this->ui_pricing_box($title, $price, $list, $link, 'active');

						// Box 3
						$title = 'Business';
						$price = '499';
						$list = array(
							'Free <b>.co.za</b> address',
							'25 email accounts',
							'500 MB Diskspace',
							'Signature Design',
							'Gmail / Outlook Synchronization ',
							'Monthly data backup',
							'Applicable for 12 months',
							'Online & Telephonically Support');
						$link = 'purchase/business-hosting';
						$boxThree = $this->ui_pricing_box($title, $price, $list, $link);

					$html .= 
							$this->grid(array($boxOne, $boxTwo, $boxThree), 'pricing').'
						</div>
					</div>';

					return $html;
				}

				public function MobileAppPage()
				{
					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('Why do you need a mobile app?').'
							<p>
								 With the ever increasing number of smartphone uses, it makes sense that there would be more demand of easy excess to information. We design, develop and market mobile apps that helps organizations run smoothly.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('Why it is important to have a Mobile App?').'
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
						</div>
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING').'
							<p>
								Since developing a mobile app requires understanding each organization\'s needs, we do not have set or fixed prices other than the base price of <span id="hilight">R10 500</span> going upwards.
						</div>
					</div>';

					return $html;
				}

				public function CloudSystemPage()
				{
					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('Why do you need a cloud system?').'
							<p>
								As companies grow, many components become hard to maintain and keep track of, unless there is a form of computerized support solutions. Our company strategize, design and develop systems that help many big organizations run smoothly and focus on what they are good in.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('Why it is important to have a Custom Cloud System?').'
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
						</div>
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING').'
							<p>
								Since developing a customized system or software requires studying and understanding each organization\'s needs, we do not have set prices other than the base price of <span id="hilight">R15 500</span>. An upfront deposit of 25% is required to begin the work. Most of the time, such projects have different payment stages allowing you as a client to budget in advance.
						</div>
					</div>';

					return $html;
				}

				public function WebDevPage()
				{
					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('Why do you need a website?').'
							<p>
								In a very digital world where more than 2 billion people are using the internet, it would not be such a bad idea to make sure you have a website to properly present your business online. We design and develop customized website for our clients ranging from startups, musicians, to big corporations.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('Why it is important to have a professional website?').'
						<p>
						Just like a business portfolio, a website to tell a story about your organization even when you are not around to do so. A <b>professionally-designed</b> website makes sure that your organization gets publicized and assist your potential clients to make online purchases or business queries without any human effort required.';

						$box1 = '
						<div class="image">
							<img src="images/ui/gold-phone.png" alt="phone"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING').'
							<p>
								An upfront payment of 35% is required to start with the work. First design concepts for the website should be ready in no less than 48 hours max less specified.
							'.$this->DevPrizing('pricing').'
						</div>
					</div>';

					return $html;
				}

				public function BrandingPage()
				{
					$box = 
					$this->frankTitle('What is branding?', true).'
					<p>
						Branding is the magic that makes the same coffee cup retail at different prices. It is the magic that makes consumers prefer one item over another. Branding is what keeps the consumer loyal to the product or service. We help organizations build <b>brand equity</b> that set them apart from their competition. Our branding range from startup branding, car branding to product branding.';

					$box1 = '<img src="images/ui/branding.jpg" alt="branding" />';

					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->grid(array($box1, $box)).'
						</div>';


						// Boxes
						$box = 
						$this->frankTitle('Why it is important to brand your company fleet?').'
						<p>
						Branding is a very broad topic which involves marketing, repackaging and business image development. Branding is an unspoken word that tells a story about your organization. It makes people care or not about your organization and your can’t afford to leave that to chance. If your company is well-branded you get to make potential customers become aware of your organization.';

						$box1 = '
						<div class="image">
							<img src="images/ui/gold-phone.png" alt="phone"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING')
							 .$this->BrandingPrizing('pricing').'
						</div>
					</div>';

					return $html;
				}

				public function MarketingPage()
				{
					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('Why should you even care about marketing?').'
							<p>
								Ever wondered why other brands are more famous than other? Well, there is a simple answer to that, <b>proactive marketing</b>. Successful organizations spend alot of time in marketing their products or services to their customers and potential customers. You probably landed on this page because we did some form of marketing to bring our brand to your awerness.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('Why it is important to have Marketing in your organization?').'
						<p>
						"<i>Out of sight, out of mind</i>". If people do not see your brand or organization, they don\'t get to buy from it. We use different methods to market your brand to your potential customers, <b>social media</b> being one of them. We come up with marketing strategies that would allow your business to grow much more further.';

						$box1 = '
						<div class="image">
							<img src="images/ui/gold-phone.png" alt="phone"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING').'
							<p>
							Ofcourse we can’t just ramble about marketing without providing a solution. Below are ALL of our marketing packages.
							'.$this->MarketingPrizing('pricing').'
						</div>
					</div>';

					return $html;
				}

				public function PortfolioDesignPage()
				{
					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('why do you need a Portfolio Design.').'
							<p>
								You will always be misunderstod if you dont get to explain yourself in your own terms and you can\'t afford to let your organization be misunderstood for what it represent. Professionally designed business portfolios then become your mouthpiece when you are not around to explain your business to potential clients or investors.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('what is the importance of a professional business portfolio?').'
						<p>
						Well, that is simple, to tell a story behind your organization. Professional portfolios play a huge role in painting a bright picture of where your company or organization might have started from, where it is and what is its main ambition. We design compelling designs and take professional images that would sell a professional look to your potential clients or investors.';

						$box1 = '
						<div class="image">
							<img src="images/ui/gold-phone.png" alt="phone"/>
						</div>';
					
					$html .= '
						<div class="color-div cf">
							<div class="dmsn cf">
								'.$this->grid(array($box, $box1), 'color').'
							</div>
						</div>
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING').'
							<p>
							An upfront payment of 50% is required to start with the work. Design concepts should be ready in no less than 72 hours max.';

						// Box 1
						$title = 'Starter';
						$price = '699';
						$list = array(
							'2 design concepts',
							'1 design revision',
							'Cover Page Design',
							'Content Page Design',
							'Back Page Design',
							'Content alignment',);
						$link = 'purchase/portfolio-starter';
						$boxOne = $this->ui_pricing_box($title, $price, $list, $link);

						// Box 2
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
						$link = 'purchase/portfolio-economy';
						$boxTwo = $this->ui_pricing_box($title, $price, $list, $link, 'active');

						// Box 3
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
						$link = 'purchase/portfolio-business';
						$boxThree = $this->ui_pricing_box($title, $price, $list, $link);

					$html .= 
							$this->grid(array($boxOne, $boxTwo, $boxThree), 'pricing').'
						</div>
					</div>';

					return $html;
				}

				public function LogoDesignPage()
				{
					$html = '
					<div class="content">
						<div class="introduction dmsn">
							'.$this->frankTitle('why do you need a logo?', true).'
							<p>
								Business is all about keeping your customers buying from you not your competitor. Many elements influence how people constantly use your brand and a logo is one of them. A logo is the face of your organization, it tells a story about your organization.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('what is the importance of a professional logo?').'
						<p>
						Every successful organization understands the very simple rule, "<i>you need to be always in your potential client\'s minds over your competitor</i>". A well-designed logo helps your clients and targeted clients easily remember what you have to offer as an organization.';

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
						<div id="pricing-div" class="pricing-div dmsn cf">
							'.$this->frankTitle('OUR PRICING').'
							<p>
							An upfront payment of 50% is required to start with the work. Design concepts should be ready in no less than 72 hours max.';

						// Box 1
						$title = 'Starter';
						$price = '399';
						$list = array(
							'2 design concepts',
							'1 revision to the concept',
							'jpeg format',
							'png format',
							'24 hr turnaround');
						$link = 'purchase/basic-branding';
						$boxOne = $this->ui_pricing_box($title, $price, $list, $link);

						// Box 2
						$title = 'Economy';
						$price = '599';
						$list = array(
							'3 design concepts',
							'2 revisions to the concept',
							'jpeg format',
							'png format',
							'48 hr turnaround');
						$link = 'purchase/intermediate-branding';
						$boxTwo = $this->ui_pricing_box($title, $price, $list, $link, 'active');

						// Box 3
						$title = 'Business';
						$price = '799';
						$list = array(
							'5 design concepts',
							'3 revisions to the concept',
							'jpeg format',
							'png format',
							'72 hr turnaround');
						$link = 'purchase/corporate-branding';
						$boxThree = $this->ui_pricing_box($title, $price, $list, $link);

					$html .= 
							$this->grid(array($boxOne, $boxTwo, $boxThree), 'pricing').'
						</div>
					</div>';

					return $html;
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
							'.$this->frankTitle('why should you care about branding.').'
							<p>
								Branding is the magic that makes the same coffee cup retail at different prices. It the magic that makes consumers prefer one item over another. We help organizations build brand equity that set them apart from the competition.
						</div>';

						// Boxes
						$box = 
						$this->frankTitle('what is the importance of branding?').'
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
							'.$this->frankTitle('what we offer?').'
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

				public function frankTitle($title, $line=false)
				{
					$html = '
					<div class="frank-title">
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
				if(isset($_GET['package'])){
					// Package
					$package = $_GET['package'];
					$package = str_replace('-', ' ', $package);

					// Form
					$formId = 'purchase';
					$form = array(
						array('Fullname', 'text', 'fullname'), 
						array('Email', 'text', 'email'), 
						array('Cell', 'text', 'cell'), 
						array('package', 'hidden', $package),
					); 

					return '
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

			/**
			 * This function builds the homepage for our application
			 */
			public function HomePage()
			{
				// What-We-Do section
				$text = '
				Behind every successful organization there is an active branding team sweating. We give your organization the professional image it deserves to grow much further.';

				$text_1 = '
				We design and develop digital platforms that improve your business. 
				It could be a simple website, ecommerce site, mobile app to system integration. ';

				$text_2 = '
				At heart we are very geeky, we love fiddling with machines. Let us take care of your entire ICT, from hosting, cloud computing to networking. Let us keep your IT up to standard.';

				$text_3 = '
				Anything that has to do with Photography, Videography and event management get us excited. It becomes our duty to get you the best possible presentation / image that will last.';

				$what_we_do = array(
							$this->wdo_text('focal-brand.png', 'FOCAL BRAND', $text),
							$this->wdo_text('focal-dev.png', 'FOCAL DEV', $text_1),
							$this->wdo_text('focal-host.png', 'FOCAL HOST', $text_2),
							$this->wdo_text('focal-studios.png', 'FOCAL STUDIOS', $text_3)
						);

				return '
				<div id="home-page" class="page">
					<div class="introduction"> 
						<div class="dmsn cf">
							'.$this->title('A SUCCESSFUL organization Starts Here', false).'
							<div class="text">
								We provide all key business solutions for our clients to get started, survive and be profitable. We focus on solving detailed problems while you get to grow your business.
							</div>
						</div>
					</div>
					<div class="what-we-do dmsn">
						'.$this->title('Solutions').'
						<div class="content">
							'.$this->grid($what_we_do).'
						</div>
					</div>
					<div id="video-section">
						'.$this->title('what is focalsoft?').'
						<p>
							Get an idea of what Focalsoft does and what it stands for as a company.
						<div class="video">
							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/okKwJbKyjUU?rel=0&controls=0&amp;modestbranding=0&amp;showinfo=0" frameborder="0"></iframe>
						</div>
					</div>
					<div class="our-work">
						'.$this->title('recent work').'
						<div class="work-table dmsn">
							'.$this->grid($this->loopWork(6), 'work')
							 .$this->ui_ctru_btn('More', 'our-work', 'bck').'
						</div>
					</div>
					'.$this->moreServices().'
				</div>';
			}
				public function wdo_text($image, $title, $text, $link='#')
				{
					return '
					<div class="wdo-text">
						<div class="image">
							<img src="images/ui/'.$image.'" alt="'.ucwords($title).'" />
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

					return '
					<div class="cf main-image">
						<img src="images/ui/business-solutions.png" alt="Business Solutions" />
					</div>
					<div class="ui-line"></div>
					<div class="text">
						We focus on the finer details, so you focus on the bigger picture. We help businesses get started, stay sustainable and be profitable. Our services range from office paper work to brand development.
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
					</div>
				</body>
			</html>';
		}
  }
?>