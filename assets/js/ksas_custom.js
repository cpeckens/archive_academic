//Suckerfish dropdown

 sfHover = function() {
	var sfEls = document.getElementById("nav").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
 

//PDF open in new window
var $j = jQuery.noConflict();
$j(document).ready(function(){
  $j("a[href$='pdf']").attr('target','_blank');
});

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

$j(".acc_expandall").toggle(function() {
					$j(this).text("[Collapse All]").stop();
					$j(".acc_container").show();
				}, function() {
					$j(this).text("[Expand All]").stop();
					$j(".acc_container").hide();
				});

});

$j(document).ready(function() {
					$j(".wysiwyg-read-more-link").toggle(function() {
					$j(this).text("Read Less").stop();
					$j(this).css({'background-position' : '0px 0px'});
					$j(this).parents(".wysiwyg-more-less").find(".wysiwyg-more-less-toggle").show();
				}, function() {
					$j(this).text("Read More").stop();
					$j(this).css({'background-position' : '0px -25px'});
					$j(this).parents(".wysiwyg-more-less").find(".wysiwyg-more-less-toggle").hide();
				});

});

$j(document).ready(function() {

	/* Tabs Activiation
	================================================== */

	var tabs = $j('ul.tabs');

	tabs.each(function(i) {

		//Get all tabs
		var tab = $j(this).find('> li > a');
		tab.click(function(e) {

			//Get Location of tab's content
			var contentLocation = $j(this).attr('href');

			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {

				e.preventDefault();

				//Make Tab Active
				tab.removeClass('active');
				$j(this).addClass('active');

				//Show Tab Content & add active class
				$j(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

			}
		});
	});
});