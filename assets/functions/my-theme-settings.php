<?php
$themename = "Academic Template";
$shortname = "ksasaca";
$options = array (
    array( "type" => "open"),
    array( "name" => "Color Scheme",
           "desc" => "Select the color scheme for the theme",
           "id" => $shortname."_color_scheme",
           "type" => "select",
           "options" => array("blue", "red", "green"),
           "std" => "blue"),
    array( "type" => "close"));
    
function mytheme_add_admin() {
	global $themename, $shortname, $options;
		if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
	
	foreach ($options as $value) {
	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
	
	foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ] &nbsp;); } else { delete_option( $value['id'] ); } }
	
	header("Location: themes.php?page=functions.php&saved=true");
		die;
	} else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
	delete_option( $value['id'] ); }
	
	header("Location: themes.php?page=functions.php&reset=true");
		die;
	}
	}

add_menu_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
global $themename, $shortname, $options;
if ( $_REQUEST['saved'] ) echo '<div id="message"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>
<div class="wrap">
<h2><?php echo $themename; ?> Settings</h2>

<form method="post">

<?php foreach ($options as $value) {
switch ( $value['type'] ) {

case "open":
?>
<table width="100%" border="0" style="background-color:#cdcdcd; padding:10px;">

<?php break;

case "close":
?>

</table><br />

<?php break;

case 'select':
?>
<tr>
<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
</tr>

<tr>
<td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
<?php break;

	}
	}
?>

<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
</div>

<?php
}
add_action('admin_menu', 'mytheme_add_admin');
?>
