<?php
# MantisBT - a php based bugtracking system

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

	/**
	 * @package MantisBT
	 * @copyright Copyright (C) 2000 - 2002  Kenzaburo Ito - kenito@300baud.org
	 * @copyright Project Submited By Rahul Iyer and Zubin Kadva,  II - Year MCA, NMITD. 2013-2014.
	 * @link http://www.mantisbt.org
	 */
	 /**
	  * MantisBT Core API's
	  */
	require_once( 'core.php' );

	form_security_validate('manage_user_proj_add');

	auth_reauthenticate();

	$f_user_id		= gpc_get_int( 'user_id' );
	$f_access_level	= gpc_get_int( 'access_level' );
	$f_project_id	= gpc_get_int_array( 'project_id', array() );
	$t_manage_user_threshold = config_get( 'manage_user_threshold' );

	user_ensure_exists( $f_user_id );

	foreach ( $f_project_id as $t_proj_id ) {
		if ( access_has_project_level( $t_manage_user_threshold, $t_proj_id ) &&
		access_has_project_level( $f_access_level, $t_proj_id ) ) {
			project_add_user( $t_proj_id, $f_user_id, $f_access_level );
		}
	}

	form_security_purge('manage_user_proj_add');

	print_header_redirect( 'manage_user_edit_page.php?user_id=' . $f_user_id );