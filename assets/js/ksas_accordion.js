var $j = jQuery.noConflict();

$j(document).ready(function() {
	
	//Set default open/close settings
$j('.acc_container').hide(); //Hide/close all containers
/* $j('.acc_trigger:first').addClass('active').next().show(); //Add "active" class to first trigger, then show/open the immediate next container */

//On Click
$j('.acc_trigger').click(function(){
	if( $j(this).next().is(':hidden') ) { //If immediate next container is closed...
		$j('.acc_trigger').removeClass('active').next().slideUp(); //Remove all "active" state and slide up the immediate next container
		$j(this).toggleClass('active').next().slideDown(); //Add "active" state to clicked trigger and slide down the immediate next container
	}
	return false; //Prevent the browser jump to the link anchor
});


});