var _continue = true;

// Response from PHP
var _response;

var Genode = function(){
	// declarations
	this.device = this.getDevice();
	this.curl = this.getCurrentURL();

	// get website domain
	this.hoster = this.getHoster();
	
	// closable lightwindow
	lightwindow_close();

	// Allow user to pick date
	$("#e_date").datepicker({
		dateFormat: "yy M dd D"
	});

	// Check if current requester is a CMS or not
	window.isCMS = ( window.location.href.search('base') != -1 );

	// get the definate path
	if( !isCMS )
		window.processorPath = this.hoster+'base/processors/';
	else
		window.processorPath = this.hoster+'processors/';
}

function lightwindow_close()
{
	$('.lightwindow-close').click(function(){
		$('.ui-lightwindow').hide();
	});
}

/**
  * @description   : <equalHeights> is  responsible for making equal
  *                  heighs.
  */
$.fn.equalizeheight = function(){
	// number of children
	var children = this.children(),
		childCount = children.length,
		maxHeight = 0;

	// get the tallest div
	children.each(function(){
		var height = $(this).height();

		if(height > maxHeight){
			maxHeight = height;
		}
	});

	// set the maximum height
	children.each(function(){
		var child = $(this).children();
		
		child.css({'height' : maxHeight+'px'});
	});
}

/**
  * @description   : <drawEqualBlocks> is  responsible for making equal
  *                  blocks.
  */
Genode.prototype.drawEqualBlocks = function(div){
	// create an object of the targeted div
	var target = $(div);

	// number of children
	var children = target.children(),
		childCount = (children).length;
	
	// now find equal width for each 
	var equalWidth = 100 / childCount;
	
	// start setting the width
	children.css({'width' : equalWidth+'%'});
}

/**
  * @description   : This function is get the width of the browser and assume
  *                  what might be the device being used. So, it is not accurate
  *                  since the diagnosis depends only on the width of the browser
  */
Genode.prototype.getHoster = function(){
	// find the entire url
	var url = window.location.href;
	
	// now let check if the site is live or localName
	var hostname = window.location.hostname;
	
	if(hostname == 'localhost' || hostname == '127.0.0.1'){
		// now let get the site folder
		var folder = url.split('/');
		
		return 'http://'+hostname+'/'+folder[3]+'/';
	}
	
	return 'http://'+hostname+'/';
}

/**
  * @description   : This function is get the width of the browser and assume
  *                  what might be the device being used. So, it is not accurate
  *                  since the diagnosis depends only on the width of the browser
  */
Genode.prototype.getDevice = function()
{
   var width = $(document).width();
   
   if(width <= 516)
		return 'mobile';
	else if(width >= 517 && width <= 768)
		return 'tablet';
	else
		return 'desktop';
}
 
 
/**
  *	@description	The following function is responsible for the mobile menu
  */
Genode.prototype.mobileMenu = function()
{
	// initiation
	var menu = $('.ui-mobile-menu'),
		toggle = self = false;
	
	$('.ui-mobile-menu-button').click(function(){
		// store current object to self
		self = $(this);
		
		$('body').scrollUp();

		// open the menu if closed
		if(toggle)
		{
			menu.addClass('hide');
			self.removeClass('active');
			
		}else{
			menu.removeClass('hide');
			self.addClass('active');
		}
		
		toggle = !toggle;
	});	

	// Submenu toggling
	var _toggle = true;
	$('.ui-parent-menu').click(function(){
		var self = $(this),
			id = self.attr('id'),
			list = $('#'+id+'-list');

		// Open menu
		if(_toggle)
			list.show();
		else
			list.hide();

		// Toggle
		_toggle = !_toggle;
	});

	// Clickable
	$('.ui-mobile-menu li').clickable();
}

/**
  * This makes the ui-label-box,  a fully functional accordion box
  */
Genode.prototype.accordion = function()
{
	var open = false;
	$('.ui-label-box .arrow').click(function(){
		// current object
		var self = $(this);

		// get id of the current box
		var boxId = self.attr('id');

		// content box
		var contentBox = $('#'+boxId+'-box .content');

		if(open)
		{
			// open content box
			contentBox.show();

			// first, remove down arrow 
			self.removeClass('down-arrow');

			// add up arrow
			self.addClass('up-arrow');

		}else
		{
			// close content box
			contentBox.hide();

			// first, remove up arrow 
			self.removeClass('up-arrow');

			// add down arrow
			self.addClass('down-arrow');
		}

		// flip state
		open = !open;
	});
}

/**
  * @description   : The folowing function is responsible for sliders
  */
Genode.prototype.slider = function(duration)
{
	// find how many images are given...
	var imgCount = 0

	// count images 
	$('.ui-slider.background .slide').each(function(){
		imgCount++;
	});

	// show the first image
	$('.ui-slider.background .slide:first-child').show();

	//alert(imgCount);

	// only allow controls and sliding if we have more than
	// one images
	if( imgCount > 1 )
	{
		setInterval(function(){
			$('.ui-slider.background .slide:first-child').hide()
									 .next('.slide').fadeIn(duration)
									 .end().appendTo('.ui-slider .wrapper');
		},duration*10);
	}		
}

Genode.prototype.image_slider = function(duration)
{
	// find how many images are given...
	var imgCount = 0;

	// count images 
	$('.ui-slider .slide img').each(function(){
		imgCount++;
	});

	// show the first image
	$('.ui-slider .slide:first-child img').show();

	// only allow controls and sliding if we have more than
	// one images
	if( imgCount > 1 )
	{
		setInterval(function(){
			$('.ui-slider .slide:first-child').hide()
									 .next('.slide').fadeIn(duration)
									 .end().appendTo('.ui-slider .wrapper');
		},duration*10);
	}		
}

/**
  * @description   : Focalsoft brand
  */
Genode.prototype.addFocalbrand = function(){
	if(this.device != 'mobile'){
		$('body').append('<div class="ui-focalsoft-brand four-rounding"><a href="http://www.focalsoft.co.za"> Focalsoft Made </a></div>');
	}
} 

Genode.prototype.addLoader = function(div){
	var html  = '<div class="ui-loader">';
		html += '	<img src="../genode/images/dot-loader.gif" />'
		html += '</div>';
		
	$(div).html(html);
}

/**
  * @description   : This function allows us to close the parent
  */
Genode.prototype.closeCross = function(div){
	$('.ui-close-cross').click(function(){
		$(this).parent().hide();
	});
}

/**
  * @description   : The following function adds hyphen inbetween
  *                  any string being passed
  */
Genode.prototype.addHyphenBetween = function(string){
	// split the string by empy spaces
	var stringArray = string.split(' ');
	
	// loop through each word and add hyphen
	var newString = stringArray[0];
	for(var i = 1; i < stringArray.length; i++){
		newString += '-'+stringArray[i];
	}
	
	// return to the caller
	return newString;
}

/**
  * @description   : Check if object passed is an array or not
  */
Genode.prototype.isArray = function(){
	return (obj.constructor.toString().indexOf('Array') == -1)? false : true;
}
	
/**
  * @description   : Detect if the current browser is the "notorious"
  *                  Opera Mini or not
  */
$.fn.isOperaMini = function(){
	return (navigator.userAgent.indexOf('Opera Mini') > -1);
}

/**
  * @description   : Check if the client is connected to the internet
  */
Genode.prototype.isConnected = function(){
	return navigator.onLine;
}

/**
  * @description   : This function checks if the given url is a live link or local
  */
Genode.prototype.isLive = function(url){
	// store all possible protocols
	var protocols = ['http://', 'https://', 'ftp://', 'ftps://', 'file://'];
	
	for(var i = 0; i < protocols.length; i++)
	{
		var protocol = protocols[i];
		
		if(url.search(protocol) != -1){
			return true;
		}
	}
	return false;
}

/**
  * @description   : The following allows a user to click "toggle menu" buttons
  */
Genode.prototype.toggleMenu = function(url){
	// when user clicks a button
	$('.ui-toggle-menu .button').click(function()
	{
		var self = $(this)
			type = self.attr('id');
		
		// check if it is active or not
		if(!self.hasClass('ui-toggle-menu-active')){
			// remove 'from' all button
			$('.ui-toggle-menu .button').removeClass('ui-toggle-menu-active');
			
			// now add to the newly 'pressed' button
			self.addClass('ui-toggle-menu-active');
		}
		
		// add new content
		$('.toggle-menu-content').load('processors/'+url+'?type='+type);
	});
}

/**
  * @description   : Add scrolling button when it appropiate
  */
Genode.prototype.addScrollButton = function(id, dir){
	if(this.device != 'mobile'){
		$('#'+id).ScrollButton(dir, this);
	}
}

/**
  * @description   : This function makes the given element be clickable
  */
$.fn.clickable = function(){
	// store the targeted object in a variable
	var target = $(this);

	target.click(function(){
		
		// find link from each iteration
		var self = $(this),
			link = self.find('a').attr('href');
		
		// redirect to the given link
		window.location.href = link;
	});
}

// jQuery extension.....
$.fn.ScrollButton = function(dir, obj){
	var self = $(this),
		id = self.attr('id');

	// find the appropiate name of the image
	if( dir == 'up' )
		var arrow = 'u-stick-pointer';
	else
		var arrow = 'd-stick-pointer';

	// let append the scroll button to our page
	$('#'+id).append('<div class="ui-scroll-btn three-rounding"><img src="'+ obj.hoster + 'genode/images/ui/' + arrow + '.png" /></div>');

	// [UT - User Interaction] scroll up if user clicks on the button
	$('#'+id+' .ui-scroll-btn').click(function()
	 {
		// scroll the page to the direction given
		if(dir == 'down')
			self.scrollDown('#'+id);
		else
			self.scrollUp('#'+id);
	});

	// initial visibility
	if (dir == 'down'){
		$('#'+id+' .ui-scroll-btn').show();

	}else{
		$('#'+id+' .ui-scroll-btn').hide();
	}

	// visibility once scrolled
	$(window).scroll(function()
	{
		if (dir == 'down'){
			$('#'+id+' .ui-scroll-btn').show();

		}else{
			if ($(window).scrollTop() > 0){
				$('#'+id+' .ui-scroll-btn').show();
			}else{
				$('#'+id+' .ui-scroll-btn').hide();
			}
		}
	});
}

$.fn.scrollUp = function()
{
	if(!this.isOperaMini())
	{
		//$('html,body').animate({scrollTop: 0}, 800);

		// Scroll to a specific div CONTINUE HERE
		$('html,body').animate({
        	scrollTop: $(this).offset().top-250},
        'slow');

		return false;
	}
}

$.fn.scrollDown = function()
{
	if(!this.isOperaMini())
	{
		var n = $(document).height();

		$('html,body').animate({scrollTop: n}, 800);
		return false;
	}
}

Genode.prototype.getCurrentURL = function()
{
	// find the current page....
	var curURL = window.location.href.split('/'),
		arrayURL = curURL,
		urlDir = curURL[curURL.length - 2],
		curPage = curURL[curURL.length - 1];
	
	// check if we have # or &
	var keys = ['#', '&'];
	for($i = 0; $i < keys.length; $i++){
		// Current key
		var current_key = keys[$i];

		if(curPage.search(current_key) != -1 ){
			safeURI = curPage.split(current_key);
			curPage = safeURI[0];
		}
	}

	// Check if the return url is a number
	if(!isNaN(curPage)){
		curPage = arrayURL[curURL.length - 2];
	}

	return curPage;
}

$.fn.statize = function(value, status, close){
	// set the proper color for the status bar
	var states = ['green', 'gray', 'orange', 'blue', 'black'];

	var isFound = false;
	for(var i = 0; i < states.length - 1; i++){
		if( status == states[i] ){
			status = states[i];
			// state found
			isFound = true;
			break;
		}
	}

	// Default color
	if(isFound == false) status = 'red';

	// check if the status bar does not already exist
	var statusLabel = $('body').find('.ui-status-bar').text();

	// if it exist remove and add a new one
	if(statusLabel.length > 0)
		$('.ui-status-bar').remove();

	// if close is set, then close the status after time stipulated
	if( close == 'auto' )
		genode.statusClose(1200);

	else if( close > 0 )
		genode.TimedStatusClose(close);

	// Add html
	var html = genode.statusBar(value, status);
	$(this).prepend(html);

	// Scroll up
	$('.ui-status-bar').scrollUp();
}
	Genode.prototype.statusBar = function(value, status){
		// status htm
		var html  = '<div class="ui-status-bar '+status+' three-rounding">';
			html += 	value;
			html += '</div>';

		// Return to the caller
		return html;
	}

	Genode.prototype.statusClose = function(time){
		setTimeout(function(){
			$('.ui-status-bar, .ui-green-bar').empty().hide(); 
		}, time);
	}

	Genode.prototype.TimedStatusClose = function(time){
		var input = $('input, select, .textarea');
		
		input.bind("keypress click", function(){ 
			genode.statusClose(time); 
		});
	}

/**
 * This function checks if n is a float
 */
Genode.prototype.isFloat = function(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

/**
 * This function checks if n is a number
 */
Genode.prototype.isNumber = function(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

/**
 * This function checks the given 'label' is a standardized label
 */
Genode.prototype.islabel = function(label){
	// List of commonly used 'inlabels'
	var inlabel = ['fullname', 'email', 'password', 'select..', 'select business category..', 'confirm password', 
				   'cell', 'filename'];

	// Check against all 'inlabels'
	for(var i = 0; i < inlabel.length; i++){
		if( label.toLowerCase() == inlabel[i] )
			return true;
	}
	return false;
}

/**
 * This function checks the given 'email' is valid or not
 */
Genode.prototype.isEmailValid = function(email){
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

/**
 * This function checks the given south african 'cell number' is valid or not
 */
Genode.prototype.isCellValid = function(number)
{
	var trimmed = number.replace(/\s/g, ''),
		regex = /^0(6|7|8){1}[0-9]{1}[0-9]{7}$/;

	return (regex.test(trimmed) === true)? true : false;
}

Genode.prototype.inputHighlight = function()
{
	var row;
	$('input, select, .textarea').focus(function(){
		// Find the row object
		row = $(this).parent().parent();
		
		$(this).addClass('active-input');
		row.addClass('active-input');
	}).blur(function(){
		$(this).removeClass('active-input');
		row.removeClass('active-input');
	});
}

Genode.prototype.inputAutoClear = function()
{
	var input = $('input, .textarea'),
		self, originalValue, defaultValue = '';

	input.focus(function()
	{
		// retrieve the default value
		self = $(this);
		
		//  get the orginal value
		originalValue = self.val();
		
		defaultValue = originalValue.toLowerCase();
		
		// remove the intext
		self.removeClass('intext');
		
		if(defaultValue == 'password' || defaultValue == 'confirm password' 
		   || defaultValue == 'new password' || defaultValue == 'repeat password'){
			//change type to password
			self.attr('type', 'password');
		}
		
		// remove current value
		self.val('');
		
	}).blur(function(){
		self.addClass('intext');
		
		if((defaultValue == 'password..' || defaultValue == 'confirm password..') && self.val() == ''){
			self.attr('type', 'text');
		}

		if(self.val() == '')
			self.val(originalValue);
	});
}

/**
  * @description   : Get all the data in the form
  */
Genode.prototype.getFormData = function(formId)
{
	var data = '';
	
	$(formId+' input, '+formId+' .textarea, '+formId+' select').each(function(){
		var self = $(this);
		data += self.attr('id')+'='+self.val()+'&';
	});
	return data;
}

/**
  * @description   : <uploadFile> is responsible for uploading files using jquery form
  */
Genode.prototype.uploadFile = function(div, event, func)
{
	// submiting a file to a php processor
	$(div).on(event, function(e) { 
		e.preventDefault();

		// find the filename
		var self = $(this);

		// send to php for physical uploading
		$('.upload-file').ajaxForm({
			success: function(responseData){
				// delay For good UX
				setTimeout(function(){
					// Parse data
					responseData = JSON.parse(responseData);

					// respond accordingly
					if( (responseData == 1 || $.isArray(responseData)) && typeof func == 'function' ) 	
						func(responseData);
					else
						onfail(responseData, div);
					
				}, 500);
			}
		}).submit(); 
	});

	function onfail(response, div)
	{
		$('form').statize(response, 'red', 100);
	}
}

Genode.prototype.SubmitForm = function(FormDiv, url, func){
	// Get the button of the form
	var button = $(FormDiv + ' button');

	// Submit form
	$(FormDiv).on("submit", function(e){
		// Prevent default 'form-submission' behaviour
		e.preventDefault();

		// Allow the processing
		_continue = true;

		// Get all values in the form
		var data = $(FormDiv).scrapeValues();
		
		// Get the original button text
		var originalButton = button.text();
		
		// If no IMPORTANT field was missed, continue
		// sending form
		if( _continue ){
			// Add a loading GIF, (UX)
			var prefix = (isCMS)? '../' : '';
			button.html('<img src="'+prefix+'genode/images/dot-loader.GIF" />');
			
			// Actual, send data to the given PHP script
			$.post(url, data, function(response){ 
				// Delay response, (UX)
				setTimeout(function(){
					// Trim / Sanitize data
					_response = $.trim(response);

					// show original button
					button.html(originalButton);

					// choose appropiate response
					if(typeof func == 'function')
						func(response);
					else
						default_form_ux( FormDiv );
				}, 3000);
				
				//$('body').scrollUp();
				$(FormDiv).scrollUp()
			});

		}else{
			$(FormDiv).statize(_response, 'red', 100);
		}

	});
}
	Genode.prototype.input = function(name, type)
	{
		return '<input placeholder="'+name+'" type="'+type+'" name="'+name+'" id="'+name+'" />';
	}

	Genode.prototype.hiddenInput = function(name, value)
	{
		return '<input type="hidden" name="'+name+'" id="'+name+'" value="'+value+'" />';
	}

	function default_form_ux(FormDiv){
		// Give the appropiate response
		if( _response == 1) 
			default_onsuccess( FormDiv );
		else
			default_onfail( FormDiv );
	}
		/**
		  *	This function gives the default message to the user if 
		  * sent query was successful
		  */
		function default_onsuccess(FormDiv){
			// Give the appropiate message to the user
			if(genode.curl == 'login')
				var message = 'Logged in successfuly';
			else	
				var message = 'Your query was processed successfuly';

			var parent = $(FormDiv).parent();
			parent.statize(message, 'green', 50);
		}

		/**
		  *	This function gives the default message to the user if 
		  * sent query was unsuccessful
		  */
		function default_onfail(FormDiv){
			// check if response is 0
			if(_response == 0){
				// Give the appropiate message to the user
				if(genode.curl == 'login')
					var message = 'You have entered invalid logins!';
				else	
					var message = 'Your request was not processed. Try again.';

			}else{
				// Parse data if returned object is an array
				if($.isArray(_response))
					_response = JSON.parse(response);
				
				var message = _response;
			}

			// Show message
			var parent = $(FormDiv).parent();
			parent.statize(message, 'red', 50);
		}

/**
 *                                   -- Extensions --
 *
 * The following functions are jQuery Extensions, that could be used anywere within our
 * application. 
 */
$.fn.scrapeValues = function(){
	// Current object
	var self = $(this);

	// get the id of the current object
	var FormDiv = self.attr('id'),
		FormDiv = '#'+FormDiv;

	// date to be scraped
	var data = '';

	$(FormDiv+' input, '+FormDiv+' .textarea, '+FormDiv+' select').each(function(){
		// current obj
		var self = $(this);

		// scrape data
		var name = self.attr('id');
	
		// Value
		var value = (name == 'word-editor')? self.html() : self.val();	

		// find the state 
		var state = self.attr('state');

		// if the value form is empty let not process
		if( (state == 'strict' && genode.islabel(value)) || (state == 'strict' && value.length == 0) ){
			_response = 'Enter all required fields.';
			_continue = false; 

			return;
		}

		// Let check if the current input is email
		if(name.toLowerCase() == 'email'){
			//Now let check if email is valid
			if(!genode.isEmailValid(value)){
				_response = 'Invalid email address.';
				_continue = false; 

				return;
			}
		}

		// Let check if the current input is cell
		if(name.toLowerCase() == 'cell'){
			if(!genode.isCellValid(value)){
				_response = 'Invalid cellphone number.';
				_continue = false; 

				return;
			}
		}

		// If we have to compare passwords
		if( name == 'password-repeat'){
			// Get password
			var password = $('#password').val();

			// Let check if passwords are the same
			if( value != password ){
				_response = 'Passwords do not match.';
				_continue = false;

				return;
			}
		}

		// add to the data to be sent
		data += name+ '=' + value+'&';
	});

	return data;
}

$.fn.scrollTo = function(){
	// Current object
	var self = $(this);
      // Scroll
    $('html,body').animate({
        scrollTop: $(self).offset().top-80}, 
    'slow');
}

/**
 * Let create the Genode instance, so it might be excessed in 
 * all scripts that follows thereafter
 */
window.genode = new Genode();

// Form processor path
window.processorPath = genode.hoster+'processors/';

// Input highlight
genode.inputHighlight() 

// Closable div functionality
genode.closeCross();