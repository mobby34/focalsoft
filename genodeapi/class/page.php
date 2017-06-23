<?php
  /**
	* @author         Praise Khumalo <creaminks@gmail.com>
	*                                <praise@focalsoft.co.za>
	*
	* @date           04 October 2015
	*
	* @project        Genode API
	*
	* @license        Copyright (c) 2015 Focalsoft [SA] All right reserved. (http://www.focalsoft.co.za). Using
	*                 this code without a granted permission from Focalsoft will be breach of Law.
	*
	* @description    This is an SDK which includes all PHP useful public functions we have written before
	*                 All public functions written below have been tested in various projects and they are
	*                 still open for adjustments all tailored for our beautiful Focalsoft website 
    */

  # include the Genode API
  include_once(dirname(dirname(__FILE__)).'/genode/php/genode.php');
  
  class Page extends Genode
  {     
		/**
		  * Current node being selected
		  */
		public $cnode;

		/**
		  * Constructor
		  */
		public function __construct()
		{	 
			// set the domain of this project
			$this->domain = 'focalsoft.co.za/genodeapi';
			$this->client = 'Genode API';
		
			// set description of our application
			$this->SetDescription('This is an SDK which includes all PHP useful public functions we have written before
								   All public functions written below have been tested in various projects and they are
	                               still open for adjustments all tailored for our beautiful Focalsoft websites');

			// set keywords
			$this->SetKeywords('genode, development, focalsoft, grid, interface, object oriented');

			// construct the parent's constructor
			parent::__construct();
			
			$this->curl    = $this->getCurrentURL(true);                // current url
			$this->device  = $this->getDevice();                        // device used

			$this->children = array();

			// Set CSS files
			$this->SetCSS('css/default.css');
			$this->SetCSS('css/desktop.css');
			
			// Set Javascript files
			$this->SetJS('js/default.js');
			$this->SetJS('js/iscroll.js');

			// set hierachy
			$this->nodesLength = 7;
			$nodeArray = array();
			for($i = $this->nodesLength; $i > 0; $i--) $nodeArray[] = 'c'.$i;

			$this->hierachy = $nodeArray;

			// build mobile menu and deskop menu
			if($this->device != 'mobile')
			{
				$id = 1;
				$smt = $this->pdo->prepare("SELECT * FROM `api_fn` WHERE id=:ID");
				$smt->bindParam(':ID', $id);

				if( $smt->execute() )
				{
					while($row = $smt->fetch()){
						// Retrieve row details
						$id = $row['id'];
						$fn = $row['fn'];

						// Form url
						$baseURL = 'api/'.$fn;

						$this->menulist[$fn] = array($baseURL, $this->findChildren($id, $baseURL));
					}
				}
			}
 		}
			
		// [+1] Header function		
		public function GetBanner()
		{
			return '';
		}

		// [+2] Build body 
		public function body()
		{
			switch($this->curl){
				// Homepage
				case 'index.php': 
					$body = $this->full_layout(); break;

				// default
				default: 
					$body = $this->trinity_layout(); break;
			}

			// return to the caller
			return $body;
		}

		// Returns a full display layout
		public function full_layout()
		{
			return '
			<div id="full-page">
				<div class="top-banner">
					<div class="dmsn cf">
						<div class="logo cf">
							<div class="label">
								Genode API 
							</div>
							<div class="version">
								<div class="text">
									version
								</div>
								<div class="number">
									2.0.0.1
								</div>
							</div>
						</div>
						<div class="menu cf">

						</div>
					</div>
				</div>
				<div class="content">
					<div class="left">
						Left
					</div>
				</div>
			</div>';
		}

		public function trinity_layout()
		{
			$html = '
			<div id="page" class="cf">
				<div id="side-menu-section">
					<div class="title">
						Search
					</div>
					<div class="list cf">
						'.$this->ui_menu().'
					</div>
				</div>
				<div id="main-section" class="cf">
					<div class="top-bar cf">
						'.$this->mobileLabel()
						.$this->ui_mobile_menu_button().'
					</div>
					<div id="content" class="content cf">
					'.$this->ui_mobile_menu();

						// Find the appropiate key
						$key = $_GET['c1'];
						for($i=2; $i <= 7; $i++)
						{
							if( isset($_GET['c'.$i]) ){
								$key = $_GET['c'.$i];
								continue;
							}else
								break;
						}

						$html .=
							$this->ContentKanvas($key).'
					</div>
				</div>
			</div>';

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

			public function ContentKanvas($key)
			{
				$html = 
				$this->loadingGIF('kanvas').'
				<div id="text-div" class="cf">';

					// Loop the specific content
					$data = $this->fetch('api_fn', array('fn' => $key), 'all');

					// Retrieve
					$id = $data[0]['id'];
					$description = $data[0]['description'];
					$phpCode = stripslashes($data[0]['php_code'] );
					$jsCode = $data[0]['js_code'];
					$cssCode = $data[0]['css_code'];
					$xcode = $data[0]['xcode'];

					$html .= '
						'.$this->title('DESCRIPTION').'<br /><br />
						<div class="description">
							'.$description.'
						</div>
						<div class="notes cf">
							
						</div>
					</div>';

					// Add Examplary code
					if(strlen($xcode))
						$html .= '
						<div id="example-div">
							'.$this->title('EXAMPLE').'
							<div class="xcode">
								'.$xcode.'
							</div>
						</div>';

				$html .= 
					$this->CodeConsole($id, $phpCode, $cssCode, $jsCode).'
				</div>';

				return $html;
			}

			public function loadingGIF($name)
			{
				return '
				<div id="'.$name.'-gif" class="loading-div hide cf">
					<div class="gif"> 
						<img src="images/ui/ajax-loader.gif">
					</div>
				</div>';
			}

			public function title($title)
			{
				return '<span id="title">'.$title.'</span>';
			}

			// code console //
			public function CodeConsole($id, $phpCode, $cssCode=false, $jsCode=false)
			{
				$html = '
				<div id="code-div" class="cf">
					<div class="lan-tabs cf">
						<div id="php" class="lan php active">PHP</div>';

						if(strlen($cssCode) > 0 && $cssCode != false)
							$html .= '<div id="css" class="lan css">CSS</div>';

						if(strlen($jsCode) > 0 && $jsCode != false)
							$html .= '<div id="js" class="lan js">JS</div>';

					$html .= '
					</div>
					<div id="console-div" class="cf">
						'.$this->loadingGIF('console').'
						<div id="'.$id.'" class="edit-icon">
							<img src="images/ui/settings.png" alt="Settings" />
						</div>';

							// Add PHP code
							$php = $this->php_code($phpCode);
							$console = '
							<div id="'.$id.'-php" class="php-code active console">'.$php.'</div>';

							// Add CSS code if aplicable
							if(strlen($cssCode) > 0 && $cssCode != false){
								$css = $this->php_code($cssCode);
								$console .= '<div id="'.$id.'-css" class="css-code hide console">'.$css.'</div>';
							}

							// Add JS code if aplicable
							if(strlen($jsCode) > 0 && $jsCode != false){
								$js = $this->php_code($jsCode);
								$console .= '<div id="'.$id.'-js" class="js-code hide console">'.$js.'</div>';
							}

				$html .= 
						$console.'
					</div>	
				</div>';

				return $html;
			}
		
			public function cmt($comment)
			{
				return '
				<div class="comment">
					// '.$comment.'
				</div>';
			}

			/**
			  * Build a link to the function passed
			  */
			public function code_fn($fn, $url)
			{
				return '
				<a href="'.$url.'">
					<span id="code-fn">
						'.htmlentities('<'.$fn.'>').'
					</span>
				</a>';
			}

			/**
			  * This function wraps any passed code for proper presentation
			  * of PHP code
			  */
			public function php_code($code, $visibility='show')
			{
				return '
				<div id="php-code" class="cf code-wrapper '.$visibility.'">
					'.trim($code).'
				</div>';
			}

			/**
			  * This function wraps any passed code for proper presentation
			  * of JavaScript code
			  */
			public function js_code($code, $visibility='show')
			{
				return '
				<div id="js-code" class="cf code-wrapper '.$visibility.'">
					'.$code.'
				</div>';
			}

			/**
			  * This function wraps any passed code for proper presentation
			  * of CSS code
			  */
			public function css_code($code, $visibility='show')
			{
				return '
				<div id="css-code" class="cf code-wrapper '.$visibility.'">
					'.$code.'
				</div>';
			}

			/**
			  * This function wraps any passed code for proper presentation
			  * of HTML code
			  */
			public function html_code($code, $visibility='show')
			{
				return '
				<div id="html-code" class="cf code-wrapper '.$visibility.'">
					'.$code.'
				</div>';
			}

		/** 
		  * @description:	<ui_loop_menu> we are customising the original function from Genode
		  */
		public function ui_loop_menu($menu=array(), $mark=false)
		{
			// initiate
			$html = $drop_down = '';
				
			// loop all elements
			while(list($label, $url) = each($menu))
			{	
				// form each element
				if(is_array($url))
				{
					// url of the parent
					$purl = $url[0];

					// list
					$list = $url[1];

					// child marker
					$marker = '
					<div class="marker cf">
						<div class="circle circle-rounding"></div>
						<div class="line"></div>
					</div>';

					// find out if we have to activate parent
					$class = ($label == $this->cnode)? 'active-parent' : false;

					// set fparent if not set
					$fparent = (strtolower($label) == 'trinity')? 'fparent' : false;	

					// Find the current OC state of the tab
					$data = $this->fetch('api_fn', array('fn' => $label), 'all');

					// Current OC
					/*$id  = $data[0]['id'];
					$coc = $data[0]['oc'];*/

					$id  = rand(1, 300);
					$coc = 1;

					if($coc == 1){
						$oc = '-';
						$display = 'style="display:block"';
						$active = 'active';
					}else{
						$oc = '+';
						$display = 'style="display:none"';
						$active = false;
					}

					// compose id
					$id = $this->addHyphenBetween(strtolower($label)).'-'.$id;

					$html .= '
					<li class="node cf '.$class.'">
						<div id="'.$id.'" class="parent '.$fparent.' '.$active.'">
							'.$oc.'
						</div>
						<div class="label">
							<span id="'.$purl.'" class="node-child">'.$label.'</span> 
						</div>
						<ul id="'.$id.'-dropdown" class="side-dropdown" '.$display.'>
							'.$this->ui_loop_menu($list, $marker).'
						</ul>
						<br />
					</li>';

				}else{					
					// find static url only
					$staticURL = $this->non_dynamic_url($url);   
					
					// compose class based on the current url
					$class     = ($staticURL.'.php' == $this->curl || strtolower($this->page) == strtolower($label) || $label == $this->cnode )? 'class="active-tab"' : false;
					
					// check if the url is not an http
				    if(strpos($url, 'http') === FALSE){ $url = $this->hoster.$url;}
					
					$html .= '
					<li '.$class.'> 
						'.$mark.'
						<span id="'.$url.'" class="node-child">
							'.$label.'
						</span>
					</li>';
				}
			}

			// return to the caller
			return $html;
		}
		
		// Find all children of the current functions
		public function findChildren($parentId, $baseURL)
		{	
			$children = array();

			// Table
			$table = 'api_fn';

			// Fetch
		    $data = $this->fetch($table, array('parent' => $parentId), 'all');

		    // Loop
		    for($i=0; $i<count($data); $i++)
		    {
		    	// Retrieve
		    	$id = $data[$i]['id'];
		    	$fn = $data[$i]['fn'];

		    	// Recompose URL
		    	$baseURL .= '/'.$fn;

		    	// Check if the current children has any children
		    	$count = $this->fetch($table, array('parent' => $id), 'count');

		    	// Add children
		    	if($count > 0){
		    		$children[$fn] = array($baseURL, $this->findChildren($id, strtolower($baseURL) ));
		    	}else{
		    		if($i > 0){
		    			// Remove the last child and reset it
		    			$array = explode('/', $baseURL);
		    			$length = count($array);
		    			$secondLast = $array[$length-2];

		    			// replace the last one
		    			$baseURL = str_replace($secondLast.'/', '', $baseURL);
		    		}

		    		$children[$fn] = strtolower($baseURL);
		    	} 
		    }

		    return $children;
		}

		/** 
		  * ---------------------------------- Footer -------------------------------------- 
		  *
		  * @description:	<footer> this function is just responsible for building us the 
		  *                 footer for the website. 
		  */
		public function footer($isPlain=false)
		{
			return '    
					'.$this->GetJS().'	
					</div>
				</body>
			</html>';
		}
  }
?>