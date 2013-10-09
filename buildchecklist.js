xmlhttp=new XMLHttpRequest();

//Note: both the web page and the XML file it tries to load, must be located on the same server.

//Get name of file from checkbox - if it doesn't exist create a new xml document
xmlhttp.open("GET","checklist_test1.xml",false);
xmlhttp.send();
xmlDoc=xmlhttp.responseXML;

document.write("<table>");
var x=xmlDoc.getElementsByTagName("checkentry");
for (i=0;i<x.length;i++)
{ 
  document.write("<tr><td><span class='titletext'>");
  document.write(x[i].getElementsByTagName("titletext")[0].childNodes[0].nodeValue);
  document.write("</span></br><span class='desctext'>");
  document.write(x[i].getElementsByTagName("desctext")[0].childNodes[0].nodeValue);
  document.write("</span></td><td>");
  var id = x[i].getAttribute("id");
  var checked = x[i].getAttribute("checked");
  var checkboxname = "'checkbox[" + id + "]'";
  (checked=='True')?a="checked":a="";
  var b = "<input type='checkbox' name='checked' value=" + checkboxname + a +"/>";
  document.write(b);
  document.write("</td></tr>");
}
document.write("</table>");
