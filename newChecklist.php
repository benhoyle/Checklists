<?php

//Load template xml and save as new xml in "Checklists" directory (or copy file);
$templatefile = $_GET['t_file'];
$caseref = $_GET['caseref'];
#print_r($templatefile);
#print_r($caseref);
$xml = new DOMDocument();
$xml->load("./Templates/".$templatefile.".xml"); //t_file exclude file extension
#print_r($xml->saveXML());
//File name: date - caseref - checklist template name.
$checklist_filename = date("y-m-d");
$checklist_filename .= "-" . $caseref . "-" . $templatefile;
#print_r($checklist_filename);
$path_dir = "./Checklists/";
$path_dir .= $checklist_filename.".xml";
//print_r($path_dir);
#Possibly permission related - check permissions
$fp = fopen($path_dir,'w'); 
$write = fwrite($fp,$xml->saveXML()); 
fclose($fp);
//Run buildChecklists function with name of new file.
//print_r("finished")
?>