<?php

//Get ID of checkbox from URL
$checkbox = $_GET['checkbox'];

//Plus we need the name of the checklist
$c_file = $_GET['c_file'];

//Plus we need the checkbox value (true or false)
$c_value = $_GET['c_value'];

$xml = new DOMDocument();
$xml->load("./Checklists/".$c_file.".xml");
//Use xpath as getbyelementid didnt work - something about validation
$x = new DOMXPath($xml);
$getbyid = $x->query("//*[@id='$checkbox']")->item(0); //Look for id=title
//Capitalise first letter of true or false
$getbyid->setAttribute("checked", ucfirst(strval($c_value)));
//print_r("New value: " . $getbyid->getAttribute("checked"));
$xml->save("./Checklists/".$c_file.".xml");

?>
