<?php defined('ABSPATH') or die('Cannot access pages directly.');?>

<div class="wrap">

<h2>Already Existing Tags</h2>

<?php settings_errors();?>

<form action="options.php" method="post">

<?php
settings_fields('aet-settings-group');
if ((get_option('aet_automatic_tagging') == 1) && !(get_option('aet_automatic_tagging_included_categories'))) {
  echo '<h3>Automatic tagging is enabled... but no category is selected</h3>';
}
elseif (get_option('aet_automatic_tagging') == 1) {
  echo '<h3>Automatic tagging is enabled</h3>';
}
else {
  echo '<h3>Automatic tagging is disabled</h3>';
}
?>

<table class="form-table" width="100%" cellpadding="10">

<tbody>

<tr>
<td scope="row" align="left">
<input type="checkbox" id="aet_automatic_tagging" name="aet_automatic_tagging" value="1" <?php checked(get_option('aet_automatic_tagging'));?> />
<label>Automatic tagging.</label>
</td>
</tr>

</tbody>

</table>

<h3>Automatic tagging, included categories</h3>

<div id="categories_container">

<?php
$categories_arg = array('hide_empty' => 0);
$categories = get_categories($categories_arg);
foreach ($categories as $key => $value) {
  ?>

<div class="categories_block">

<input type="checkbox" id="aet_automatic_tagging_included_categories" name="aet_automatic_tagging_included_categories[]" value="<?php echo $value->term_id;?>"

    <?php
    if (is_array(get_option('aet_automatic_tagging_included_categories')) && in_array($value->term_id, get_option('aet_automatic_tagging_included_categories'))) {
      echo 'checked="checked"';
    }
    ?>

/>

<label><?php echo $value->name;?></label>

</div>

    <?php
  }
  ?>

</div>

<h3>Clean uninstall</h3>

<table class="form-table" width="100%" cellpadding="10">

<tbody>

<tr>
<td scope="row" align="left">
<input type="checkbox" id="aet_clean_uninstall" name="aet_clean_uninstall" value="1" <?php checked(get_option('aet_clean_uninstall'));?> />
<label>Delete all options from database when you delete this plugin (if you only deactivate the plugin, the options won't be deleted).</label>
</td>
</tr>

</tbody>

</table>

<?php submit_button();?>

</form>
    
<h3>Do you like this plugin?</h3>
    
    <ul>
        
    <li><a href="http://wordpress.org/support/view/plugin-reviews/already-existing-tags" target="_blank">Please, rate it on the repository</a></li>
    
    </ul>

</div>