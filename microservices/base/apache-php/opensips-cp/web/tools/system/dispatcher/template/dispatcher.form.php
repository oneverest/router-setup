<?php
/*
* Copyright (C) 2017 OpenSIPS Project
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

require("../../../common/forms.php");

if (isset($config->dispatcher_groups)) {
	$set_keys = array();
	$set_values = array();
	switch ($config->dispatcher_groups['type']) {
	case "database":
		$query = "SELECT " .
			$config->dispatcher_groups['id'] . " AS id, " .
			$config->dispatcher_groups['name'] . " AS name " .
			"FROM " . $config->dispatcher_groups['table'];

		$stm = $link->prepare($query);
		if ($stm===FALSE) {
			die('Failed to issue query [' . $query . '], error message : ' . $link->errorInfo()[2]);
		}
		$stm->execute();
		$results = $stm->fetchAll();
		foreach ($results as $key => $value) {
			array_push($set_keys, $value['id']);
			array_push($set_values, $value['name']);
		}
		break;

	case "array":
		$set_keys = array_keys($config->dispatcher_groups['array']);
		$set_values = array_values($config->dispatcher_groups['array']);
		break;
	}
	form_generate_select("Set ID", "The numerical ID of the dispatcher set/group for the new destination",
		"setid", "y", $ds_form['setid'], $set_keys, $set_values);
} else {
	form_generate_input_text("Set ID", "The numerical ID of the dispatcher set/group for the new destination",
		"setid", "n", $ds_form['setid'], 128, "^[0-9]+$");
}

form_generate_input_text("Destination", "SIP URI pointing to the destination",
	"destination", "n", $ds_form['destination'], 192, "^sip:([^@]+@)?[^:]+(:[0-9]+)?$");

form_generate_input_text("Socket", "The OpenSIPS network listener (as proto:ip:port) to be used for reaching this destination (leave empty if not needed)",
	"socket", "y", $ds_form['socket'], 128, "^([a-zA-Z]+:)?([0-9]{1,3}\\\.[0-9]{1,3}\\\.[0-9]{1,3}\\\.[0-9]{1,3})(:[0-9]+)?$");

form_generate_select("State", "The intial state (active or inactive) of the destination",
	"state", 200, $ds_form['state'], array("0","1"),array("Active","Inactive"));

form_generate_input_text("Weight", "The weight of the destination inside the set - it can be a number or a FreeSWITCH URL (fs://[username]:password@host[:port])",
	"weight", "n", $ds_form['weight'], 128, "^([0-9]+)|(fs://[a-zA-Z0-9]*:[^@]+@[^:]+(:[0-9]+)?)$");

form_generate_input_text("Attributes", "An opaque attributes string to be provided in OpenSIPS script when the destination is selected",
	"attrs", "y", $ds_form['attrs'], 128, null);

form_generate_input_text("Description", "Description in DB, not used by OpenSIPS",
	"description", "y", $ds_form['description'], 128, null);
?>
