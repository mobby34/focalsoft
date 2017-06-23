$(document).ready(function(){
	window.app = new AppSite();
	
	// initiate the application
	window.app.init();
});

var AppSite = function()
{
	// initiate the app
	this.init = function()
	{
		// Global variables
		window.genode = new Genode();
		window.body = $('body');
		window.dropdown = $('.dropdown');
		window.processorPath = genode.hoster+'processors/';
		window.client = 'Genode API';
		window.onpopstate = function(e){
			if(e.state){
				document.getElementById("content").innerHTML = e.state.html;
				document.title = e.state.pageTitle;
			}
		};

		// add all defaultStatus
		defaultFuns();

		// add specific function
		switch(genode.curl){
			case 'home'   : homeFuns(); break;
		}
	}

	function defaultFuns()
	{
		// select language
		selectLang();

		// Load new page
		ux_load_new_page();

		itemCartBtnClick();

		// slider
		genode.slider(900);

		// toggle menu
		genode.toggleMenu('new-content.php');

		// this allow a dropdown functionality
		//dropdownFun();

		dropdown_fn();

		// mobile menu
		genode.mobileMenu();

		// add scroll up button
		genode.addScrollButton('footer', 'up');

		// Edit code
		$('.edit-icon').click(function(){
			// Object
			var self = $(this),
			// Find id
				id = self.attr('id'),
			// Copy icon
			    icon = self.html(),
			    lan = $('.lan.active').attr('id');

			// Add SAVE button
			self.html('<button id="save-btn">SAVE</button>');

			// Make console editable
			$('.console > div').attr('contenteditable', 'true')
			                   .addClass('textarea');

			$('#save-btn').click(function(){
				// Loading GIF
				$('#console-gif').show();

				// Find code
				var code = $.trim( $('#'+id+'-'+lan).text() ),
					data = 'id='+id+'&'+lan+'_code='+code;

				// Save on the database
				$.post(processorPath+'update-code', data, function(response){ 
					// remove or hide the loading gif
					$('#console-gif').hide();

					// Make console editable
					$('.console > div').attr('contenteditable', 'false')
					                   .removeClass('textarea');

					// Add icon
					self.html(icon);
				});
			});
		});

		// Language Select
		$('.lan').click(function(){
			// Find ID
			var self = $(this),
				id = self.attr('id');

			// Hide all consoles
			$('.console').hide();

			// Show the appropiate console
			$('.'+id+'-code').show();

			// Choose appropiate border color
			if(id == 'php')
				color = '2352b3';
			else if(id == 'css')
				color = 'dc4040';
			else
				color = 'b13e93';

			// Deactivate all
			$('.lan').removeClass('active');

			// Activate
			$('#console-div').css({'border-left' : '6px solid #'+color});
			self.addClass('active');
		})
	}

	// Load new page without refreshing
	function ux_load_new_page()
	{
		$('.node-child').click(function(){
			// Show loading gif
			$('#kanvas-gif').show();

			// Self
			var self = $(this),

			// Get Id which is a link
				url = self.attr('id'),

			// Get the last part of the URL
				data = url.split('/'),
				length = data.length,
				fn = data[length-1],

			// Formulate title
				title = fn+' - '+client;

			// Deactivate all tabs first
			$('.node-child').parent().removeClass('active-tab');

			// Active current tab
			self.parent().addClass('active-tab');

			response = {'pageTitle' : title, 'fn' : fn, 'html' : ''};

			processAjaxData(response, url);
		});

		function processAjaxData(response, urlPath){

			// Load Page
			$('#content').load('content.php?p='+response.fn);

			document.title = response.pageTitle;
			window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);

			// Show loading gif
			//$('loading-div').hide();
		}
	}

	function dropdown_fn()
	{
		$('.parent').click(function(){
			var self = $(this),
				id = self.attr('id'),

				// Get current function name
				fn = id.split('-')[0],

				// Find the current sign
				signDiv = $('#'+id),
				sign = signDiv.html(),

				// Current dropdown
				cdropdown = $('#'+id+'-dropdown'),  

				// All dropdowns           
				dropdown = $('.side-dropdown');

				// hide dropdown
				if(sign == '+')
				{
					// Show current dropdown
					cdropdown.hide();

					// Change Sign
					sign = '+';

					// Deactivate
					self.removeClass('active');
				}else{
					// Show current dropdown
					cdropdown.show();

					// Change Sign
					sign = '-';

					// Activate
					self.addClass('active');
				}

				// Update database
				$.post(processorPath+'parent-oc.php', 'id='+fn, function(result){
					console.log(result);
				});

				// add appropiate sign
				signDiv.html(sign);
		});
	}

	function itemCartBtnClick()
	{
		var itemCount = 1;
		$('.ui-item-box button').click(function(){
			// current object
			var self = $(this);

			// get the id of the current object
			var id = self.attr('id');

			// add label and count of the item
			var btn = itemCartBtnStat(itemCount++);

			// add button
			self.html(btn);
		});
	}
		function itemCartBtnStat(itemCount)
		{
			var html  = '<div class="label">';
				html +=  	'ADD TO CART';
				html += '</div>';
				html += '<div class="item-count circle-rounding">';
				html +=      itemCount;
				html += '</div>';

			return html;
		}

	function selectLang()
	{
		$('.languages > .each').click(function(){
			// current object pointer
			var self = $(this);

			// find id of the current object
			var lang = self.attr('id');

			// first hide all codes
			$('.text-code > div').hide();

			// and deactivate any activated
			$('.languages > .each').removeClass('active');

			// show the appropiate snippet of code
			$('#'+lang+'-code').show();

			// highlight the selected language
			$('#'+lang).addClass('active');
		});
	}

	/**
	  *	@description	The following function host all of home functions
	  */
	function homeFuns()
	{

	}	

	/**
	  *	@description	The dropdown function
	  */
	function dropdownFun()
	{
		var toggle = true;
		
		// onclick event
		dropdown.click(function(){
			// get the current obj
			var obj = $(this),
				panel = $('.dropdown-panel');
			
			if(toggle){
				panel.show();
				obj.addClass('active');
				
				// check after some time if still open close
				setTimeout(function(){
					if(!toggle){
						panel.hide();
						obj.removeClass('active');
					
						// toggle
						toggle = !toggle;
					}
				}, 10500);
				
			}else{
				panel.hide();
				obj.removeClass('active');
			}
			
			// toggle
			toggle = !toggle;
		});
	}
}