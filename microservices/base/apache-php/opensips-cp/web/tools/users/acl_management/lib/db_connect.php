<?php
/*
 * Copyright (C) 2011 OpenSIPS Project
 *
 * This file is part of opensips-cp, a free Web Control Panel Application for 
 * OpenSIPS SIP server.
 *
 * opensips-cp is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * opensips-cp is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

require_once __DIR__ . "/../../../../../config/tools/users/acl_management/db.inc.php";
require_once __DIR__ . "/../../../../../config/db.inc.php";

        global $config;
        if (isset($config->db_host_acl_management) && isset($config->db_user_acl_management) && isset($config->db_name_acl_management) ) {
                $config->db_host = $config->db_host_acl_management;
                $config->db_port = $config->db_port_acl_management;
                $config->db_user = $config->db_user_acl_management;
                $config->db_pass = $config->db_pass_acl_management;
                $config->db_name = $config->db_name_acl_management;
        }
	$dsn = $config->db_driver . ':host=' . $config->db_host . ';dbname='. $config->db_name;
	try {
		$link = new PDO($dsn, $config->db_user, $config->db_pass);
	} catch (PDOException $e) {
		error_log(print_r("Failed to connect to: ".$dsn, true));
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>
