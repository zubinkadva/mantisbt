<html>
  <head>
    <title>Company Mantis Bug Tracking</title>
  <style type="text/css">
  .myclass {
	font-size: 16px;
	color: #3FF;
	font-weight: bold;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
  </style>
  </head>

<body>

<table width="50%" align="center" cellspacing="10" cellpadding="10">
  <tr> 
    <th colspan="2" align="center" nowrap="nowrap"> <img align="center" src="images/nmitd.png" height="86">
    <img align="center" src="images/mantis_logo.png"></th>	
  </tr>

	<tr>
	<td width="5%">
      <img src="images/NEW.gif" alt="" width="70" height="61"></td>
	<td width="84%" align="center"><?php
            require_once( 'core.php' );

	require_once( 'bug_api.php' );
        $BUG_TEXT = new BugData();
        $latest_bug = $BUG_TEXT->bugtext_get_latest_all();
        //print_r($latest_bug);
            ?>
      <marquee height="30" align="middle" bgcolor="#000080" style="color: #FFFFFF;  font-family: Arial" behavior="alternate" direction="right" scrollamount="5" border="2">
      <?php echo '<blink><span class="myclass"> Latest Bug : '.$latest_bug['description'].'</span></blink>'; ?>
      </marquee></td>
	</tr>
	
</table>
</body>
</html>