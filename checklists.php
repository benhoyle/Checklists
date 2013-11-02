<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Checklists</title>
<link rel="stylesheet" href="checklist.css" type="text/css" />
<script src="buildchecklist.js"></script>
</head>
<body>

<?php 
include "newChecklist.php";
echo("
<script>buildChecklist('$checklist_filename');
</script>");
?>
</body>
</html>