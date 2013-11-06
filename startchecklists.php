<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Checklists</title>
<link rel="stylesheet" href="checklist.css" type="text/css" />
<script src="buildchecklist.js"></script>
</head>

<body>
<div class="menubar" id="upper">
<ul>
	<!--Need to get rid of first form to keep elememts horizontally aligned-->
	<li><input type="textbox" name="caseref_main" value="Enter Case Ref." onkeyup="fnUpdate()"/></li>
	<li><a href="">Checklists</a></li>
	<li><a href="">Templates</a></li>
	<li><script>document.write(Date())</script></li>
</ul>
</div>
<div class="menubar" id="lower">
<ul>
	<li><a href="">New</a></li>
	<li><a href="">Edit</a></li>
</ul>
</div>
<div id="c_f_template" class="selection">
	<form method="get" action="checklists.php" id="frmCF">
	<!--To pass caseref use hidden field that mirrors above caseref - Want to keep divs independent-->
	<input type="textbox" name="caseref" value="" style="display:none"/>
	<script>
	function fnUpdate(){
		document.forms.frmCF.caseref.value = document.getElementsByName("caseref_main")[0].value;
	}
	</script>
	<!--Need to use PHP to populate this -->
	
	<?php
	#PHP script to populate listbox with names of all xml files in Templates directory
	$dir    = './Templates';
	#Get list of files in directory
	$files1 = scandir($dir);
	print_r($files);
	#Start building list box - ipad only shows dropdown - to list all items you need to create function to drop div and ul items and then use onclick
	echo("<select name='t_file'>");
	#Loop for each located file
	foreach ($files1 as $currentfile) {
		#echo("<option>$currentfile</option>");
		if($currentfile != '.' && $currentfile != '..')
		{
			#Check extension for xml
			if (substr($currentfile, -3)=="xml") {
				#Extract filename minus the .xml
				$filename_toadd = substr($currentfile, 0, -4);
				echo ("<option>$filename_toadd</option>");
			}
		}
	}
	echo ("</select>");
	?>
	<input type="submit" value="Generate Checklist" />
	</form>
</div>
<div id="l_checklist" class="selection">
	<form method="get" action="checklists.html">
	<?php
	#PHP script to populate listbox with names of all xml files in Templates directory
	$dir    = './Checklists';
	#Get list of files in directory
	$files1 = scandir($dir);
	#Start building list box
	echo("<select name='filename'>");
	#Loop for each located file
	foreach ($files1 as $currentfile) {
		if($currentfile != '.' || $currentfile != '..')
		{
			#Check extension for xml
			if (substr($currentfile, -3)=="xml") {
				#Extract filename minus the .xml
				$filename_toadd = substr($currentfile, 0, -4);
				echo ("<option>$filename_toadd</option>");
			}
		}
	}
	echo ("</select>");
	?>
	<input type="submit" value="Load Checklist" />
	</form>
</div>


</body>
</html>