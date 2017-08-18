<?php
# MantisBT - a php based bugtracking system
# Copyright (C) 2002 - 2011  MantisBT Team - mantisbt-dev@lists.sourceforge.net
# MantisBT is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 2 of the License, or
# (at your option) any later version.
#
# MantisBT is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MantisBT.  If not, see <http://www.gnu.org/licenses/>.

require_once( 'core.php' );
require_once( 'custom_field_api.php' );

auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

html_page_top( plugin_lang_get( 'title' ) );

print_manage_menu( );
?>

<br />
<form action="<?php echo plugin_page( 'config_edit' )?>" method="post">
<?php echo form_security_field( 'plugin_gantt_chart_config_edit' ) ?>
  <table align="center" class="width75" cellspacing="1">
  
    <tr>
      <td class="form-title" colspan="3"><?php echo plugin_lang_get( 'title' ) . ': ' . plugin_lang_get( 'config' )?></td>
    </tr>
    
    <tr <?php echo helper_alternate_class( )?>>
      <td class="category"><?php echo plugin_lang_get( 'show_gantt_roadmap_link' )?></td>
      <td class="center">
        <label><input type="radio" name="show_gantt_roadmap_link" value="1" <?php echo( ON == plugin_config_get( 'show_gantt_roadmap_link' ) ) ? 'checked="checked" ' : ''?>/><?php echo plugin_lang_get('enabled')?></label>
      </td>
      <td class="center">
        <label><input type="radio" name="show_gantt_roadmap_link" value="0" <?php echo( OFF == plugin_config_get( 'show_gantt_roadmap_link' ) ) ? 'checked="checked" ' : ''?>/><?php echo plugin_lang_get('disabled')?></label>
      </td>
    </tr>
    
    <tr class="spacer"><td></td></tr>
    
    <tr <?php echo helper_alternate_class( )?>>
      <td class="category"><?php echo plugin_lang_get( 'field_to_use' )?></td>
      <td class="center">
        <label><input type="radio" name="use_due_date_field" value="1" <?php echo( ON == plugin_config_get( 'use_due_date_field' ) ) ? 'checked="checked" ' : ''?>/><?php echo lang_get('due_date')?></label>
      </td>
      <td class="center">
        <label><input type="radio" name="use_due_date_field" value="0" <?php echo( OFF == plugin_config_get( 'use_due_date_field' ) ) ? 'checked="checked" ' : ''?>/><?php echo plugin_lang_get('custom_field')?></label>
      </td>
    </tr>
    
    <tr class="spacer"><td></td></tr>
    <tr <?php echo helper_alternate_class( )?>>
      <td class="category"><?php echo plugin_lang_get( 'custom_field' )?></td>
      <td class="center" colspan="2">
        <select name="custom_field_id_for_duration">
          <option value="-1"></option>
<?php
# You need either global permissions or project-specific permissions to link
#  custom fields
if ( count( custom_field_get_ids() ) > 0 ) {
  $t_custom_fields = custom_field_get_ids();

  foreach( $t_custom_fields as $t_field_id )
  {
    $t_desc = custom_field_get_definition( $t_field_id );
    if ( plugin_config_get( 'custom_field_id_for_duration' ) == $t_field_id ) {
      $t_selected = 'selected';
    } else {
      $t_selected = '';
    }
    echo "          <option value=\"$t_field_id\" $t_selected>" . string_attribute( $t_desc['name'] ) . '</option>' ;
  }
}
?>
        </select>
      </td>
    </tr>
    
    <tr class="spacer"><td></td></tr>
    
    <tr <?php echo helper_alternate_class( )?>>
      <td class="category"><?php echo plugin_lang_get( 'use_start_date_field' )?></td>
      <td class="center">
        <label><input type="radio" name="use_start_date_field" value="1" <?php echo( ON == plugin_config_get( 'use_start_date_field' ) ) ? 'checked="checked" ' : ''?>/><?php echo plugin_lang_get('enabled')?></label>
      </td>
      <td class="center">
        <label><input type="radio" name="use_start_date_field" value="0" <?php echo( OFF == plugin_config_get( 'use_start_date_field' ) ) ? 'checked="checked" ' : ''?>/><?php echo plugin_lang_get('disabled')?></label>
      </td>
    </tr>
    
    <tr class="spacer"><td></td></tr>
    <tr <?php echo helper_alternate_class( )?>>
      <td class="category"><?php echo plugin_lang_get( 'start_date_custom_field' )?></td>
      <td class="center" colspan="2">
        <select name="custom_field_id_for_start_date">
          <option value="-1"></option>
<?php
# You need either global permissions or project-specific permissions to link
#  custom fields
if ( count( custom_field_get_ids() ) > 0 ) {
  $t_custom_fields = custom_field_get_ids();

  foreach( $t_custom_fields as $t_field_id )
  {
    $t_desc = custom_field_get_definition( $t_field_id );
    $t_type = custom_field_type( $t_field_id );
    if ( CUSTOM_FIELD_TYPE_DATE == $t_type ){
      if ( plugin_config_get( 'custom_field_id_for_start_date' ) == $t_field_id ) {
        $t_selected = 'selected';
      } else {
        $t_selected = '';
      }
      echo "          <option value=\"$t_field_id\" $t_selected>" . string_attribute( $t_desc['name'] ) . '</option>' ;
    }
  }
}
?>
        </select>
      </td>
    </tr>
    
    <tr>
      <td class="center" colspan="3">
        <input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' )?>" />
      </td>
    </tr>
  
  </table>
</form>

<?php
html_page_bottom();
?>