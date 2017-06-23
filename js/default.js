$(document).ready(function(){
    window.app = new AppSite();
    
    // initiate the application
    window.app.init();
});

var AppSite = function()
{
    /**
     * Initiate the entire app
     */
    this.init = function()
    {
        // Global variables
        window.genode = new Genode();
        window.body = $('body');
        window.processorPath = genode.hoster+'processors/';

        scrollDetect(); 

        // add all defaultStatus
        defaultFuns();

        // add specific function
        switch(genode.curl){
            // Planner
            case 'planner' : StartProject(); break;

            // Home Page
            case ''        : HomeFuns(); break;
        }
    }

    /**
     * The following function is responsible for adding all functionalities of all pages
     */
    function defaultFuns(){
        // Add functionality for sliders
        genode.slider(900);

        // Mobile menu
        genode.mobileMenu();

        // Insert a purchase
        purchase();

        // add scroll up button
        genode.addScrollButton('footer', 'up');
    }
    
    /**
     * This function allows the user to request a project they are looking for
     */
    function StartProject(){
        // Current form
        var form = '#start-project-form';

        // send form
        var start_project_onsuccess = function(response){
            if( response == 1){
                // response 
                response = 'Request received. We will be in touch with you shortly.';

                // Show response
                $(form).statize(response, 'green', 50);
            }else
                $(form).statize(response, 'red', 50);   
        }

        genode.SubmitForm(form, 'processors/insert-project.php', start_project_onsuccess);
    }

    /**
     * The following function is responsible for adding all functionalities of the home page
     */
    function HomeFuns(){
        // This allow the application to transform itself
        // as the user scrolls 
    }
        /**
         * This function detect the position of the page as the user scrolls
         */
        function scrollDetect(){
            $(window).scroll(function(event){
                // Get Current position
                var position = $(this).scrollTop();

                // Get treshold
                var treshold = (genode.device == 'desktop')? 130 : 350;

                if( position >= treshold )
                    $('#menu-section').addClass('fixed');
                else
                    $('#menu-section').removeClass('fixed');
            })
        }

    function purchase(){
        // Current form
        var form = '#purchase-form';

        // send form
        var onsuccess = function(response){
            if( response == 1){
                // response 
                response = 'Purchase order submitted. We will be in touch with you shortly.';
                // Show response
                $(form).statize(response, 'green', 50);

                setTimeout(function(){
                    window.location.href = 'index';
                }, 900);
            }else
                $(form).statize(response, 'red', 50);   
        }

        genode.SubmitForm(form, 'processors/insert-lead.php', onsuccess);
    }
}