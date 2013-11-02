function buildChecklist(doctoopen) {
	xmlhttp=new XMLHttpRequest();

	//Get checklist to open
	var doc = "./Checklists/" + doctoopen + ".xml";
	//document.write(doc);
	
	xmlhttp.open("GET", doc, false);
	xmlhttp.send();
	xmlDoc=xmlhttp.responseXML;
	
	//Set Title as document name - actually this will need to be generated based pn a caseref and a date
	headertitle = document.createElement("h1");
	headertitle.textContent = doctoopen;
	document.body.appendChild(headertitle);
	
	//document.getElementById("checklistname").innerHTML = doctoopen.capitalise;
	
	//Need to get Section elements as list - then iterate through and select checkentries within iteration
	var s=xmlDoc.getElementsByTagName("section");
	//document.write(x);
	var countouter= s.length;
	
	for (var i = 0; i < countouter; i++) 
	{
		var z = s[i].getElementsByTagName("sectiontitle");
		
		sectiontitle = document.createElement("h2");
		sectiontitle.textContent = z[0].childNodes[0].nodeValue;
		document.body.appendChild(sectiontitle);
		
		//Generate checklist table from xml template
		table = document.createElement("table");
		
		var x=s[i].getElementsByTagName("checkentry");
		var countinner = x.length;
		for (j=0;j<countinner;j++)
		{ 
		  tr = document.createElement("tr");
		  td = document.createElement("td");
		  spantitle = document.createElement("span");
		  spantitle.setAttribute("class", "titletext");
		  spantitle.textContent = x[j].getElementsByTagName("titletext")[0].childNodes[0].nodeValue;
		  td.appendChild(spantitle);
		  td.appendChild(document.createElement("br"));
		  
		  spandesc = document.createElement("span");
		  spandesc.setAttribute("class", "desctext");
		  nodes = x[j].getElementsByTagName("desctext")[0].childNodes;
		  if (nodes.length > 0) {
		  	spandesc.textContent = nodes[0].nodeValue;
		  }
		  td.appendChild(spandesc);
		  tr.appendChild(td);
		  tdcheck = document.createElement("td");
		  var id = x[j].getAttribute("id");
		  var checked = x[j].getAttribute("checked");
		  var checkboxname = "checkbox[" + id + "]";
		  (checked=='True')?a="checked":a="";
		  
		  checkbox = document.createElement("input");
		  checkbox.setAttribute("type", "checkbox");
		  checkbox.setAttribute("name", "checked");
		  checkbox.setAttribute("value", checkboxname);
		  checkbox.checked = a;
		  tdcheck.appendChild(checkbox);
		  tr.appendChild(tdcheck);
		  table.appendChild(tr);
		}
		document.body.appendChild(table);
	}


}
