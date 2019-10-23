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
?>

<form id="addnewacl" action="<?=$page_name?>?action=add_verified&id=<?=$_GET['id']?>" method="post">
<table width="400" cellspacing="2" cellpadding="2" border="0">
 <tr align="center">
  <td colspan="2" class="mainTitle">Add New ACL</td>
 </tr>
 <tr>
  <td class="dataRecord"><b>Username</b></td>
  <td class="dataRecord" width="275"><input  type="text" name="username" value="<?php if ($_SESSION['fromusrmgmt'])
		echo $_SESSION['acl_username'];?>" maxlength="128" class="dataInput" >
  </td>
 </tr>

 <tr>
  <td class="dataRecord"><b>Domain</b></td>
  <td class="dataRecord" width="275"><?php 
  	if ($_SESSION['fromusrmgmt'])
  		print_domains("domain",$_SESSION['acl_domain']);
	else 
		print_domains("domain",'');
	?></td>
 </tr>

 <tr>
  <td class="dataRecord"><b>Group</b></td>
  <td class="dataRecord" width="275"><?php print_groups("acl_grp",$acl_grp,FALSE)?></td>
  </tr>

  
 <tr>
  <td colspan="2">
    <table cellspacing=20>
      <tr>
        <td class="dataRecord" align="right" width="50%"><input type="submit" name="add" value="Add" class="formButton"  onClick ="return Form_Validator();"></td>
        <td class="dataRecord" align="left" width="50%"><?php print_back_input(); ?></td>
      </tr>
    </table>
 </tr>

</table>
</form>
