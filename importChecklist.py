#Routine for Importing Checklist in Text File
import os
import sys
import elementtree.ElementTree as ET

def iterateDir():
	#Place this script in directory with text files to import
	os.chdir("/home/ben/importChecklists")
	for files in os.listdir("."):
		if files.endswith(".txt"):
			print "Processing ", files
			importChecklist(files)



def importChecklist(filename):
	#Initialise checkentry id
	check_id = 0
	#Create new checklist template xml file with same filename.
	checklist = ET.Element("checklist")
	with open(filename, 'r') as openfileobject:
		#Get line.
		for line in openfileobject:
			#print line
			#If line begins (and ends) with '---':
			if "---" in line:
				#Extract text between these characters as sectiontitle.
				titlestart = line.find("--- ")+3
				titleend = line.find(" ---")
				sectiontitletext = line[titlestart:titleend].strip()
				
				#Create a new SECTION node.
				section = ET.SubElement(checklist, "section")
				
				#Create a new SECTIONTITLE node with inner node value of sectiontitle.
				sectiontitle = ET.SubElement(section, "sectiontitle")
				sectiontitle.text = sectiontitletext
				
				#Set currentsection node variable as newly created SECTION node.
				#If line begins with '[ ]':
			else:
				if "[ ]" in line:
					#Extract text after these characters as titletext.
					titletexttext = line[4:]
					#Create a new CHECKENTRY node.
					checkentry = ET.SubElement(section, "checkentry")
				
					#Set id attribute as check_id.
					checkentry.attrib["id"] = str(check_id)
					check_id = check_id + 1
					#Set checked attribute as 'False'.
					checkentry.attrib["checked"] = "False"
					
					#This is causing a serialize error
					#Create a new TITLETEXT node with inner node value of titletext.
					titletext = ET.SubElement(checkentry, "titletext")
					titletext.text = titletexttext.strip()
				else:
					desctext = ET.SubElement(checkentry, "desctext")
					#Extract text on line as desctext and Create a new DESCTEXT node
					desctext.text = line.strip()
	xml_fn = filename[0:-4] + ".xml"
	tree = ET.ElementTree(checklist)
	tree.write(xml_fn)

iterateDir()
