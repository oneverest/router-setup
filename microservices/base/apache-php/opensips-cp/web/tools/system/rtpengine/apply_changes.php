<?php
/*
* Copyright (C) 2018 OpenSIPS Project
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
?>

<?php

require_once __DIR__ . "/../../../../config/db.inc.php";
require_once("../../../../config/session.inc.php");
require("../../../common/mi_comm.php");
require("../../../common/cfg_comm.php");
require("../../../../config/tools/system/rtpengine/local.inc.php");

$command="rtpengine_reload";

?>
<fieldset><legend>Sending MI command: <?=$command?></legend>
<br>
<?php

$mi_connectors=get_proxys_by_assoc_id($talk_to_this_assoc_id);
for ($i=0;$i<count($mi_connectors);$i++){
	echo "Sending to <b>".$mi_connectors[$i]."</b> : ";

	$message=mi_command($command, $mi_connectors[$i], $errors, $status);

	if (!$errors) {
		echo "<font color='green'><b>Success</b></font>";
	}
	echo "<br>";
}

?>

</fieldset>
