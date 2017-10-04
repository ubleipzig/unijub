<html>
<head>
   
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
   <title>Index</title>
<link rel="stylesheet" href="stylesheet.css" type="text/css">
 
      </head>
<script language="JavaScript">
  <!--
   
 
   
   
   function getNotion(notion,indexnr,mod)
   {    
  
   
   var text =opener.document.forms["Formular"].elements[indexnr].value;

 
   if(mod == 1)
   {
   text=text+";"; 
   notion=text + notion; 
   } 
     opener.document.forms["Formular"].elements[indexnr].value=notion;
     opener.document.forms["Formular"].elements[indexnr].focus();
  
    
     
    
    self.close();
   };
   
 
 
 
 
 
 
 
  //-->
 
 
 </script>

<?php
include "config.php";

_connect (HOST,USER,PASSWORD,DATABASE)  ;

$id=_array_item_2 ($_GET,"id");
$mod=_array_item_2 ($_GET,"mod");
$sart=_array_item_2 ($_GET,"sart");
$page=_array_item_2 ($_GET,"page");
$var=_array_item_2 ($_GET,"var");

if(empty($page)){$offset=0;  $page=1;}
else $offset =($page-1) *50;





if((preg_match('/^K087/', $id))||(preg_match('/^K200/', $id))||(preg_match('/^K204/', $id)))$query = "SELECT K0i1,K900 FROM person where K900 LIKE '$var%' ORDER BY K900 ";
if(($id == "K240")||($id == "K630"))                                   $query = "SELECT K0i1,K800 FROM institution where K800 LIKE '$var%' ORDER BY K800 ";
if(preg_match('/^K441/', $id))                             $query = "SELECT K0i1,IFNULL(K640,K620) FROM periodica where (K640 LIKE '$var%'OR K620 LIKE '$var%') AND K003 = 'z' ORDER BY K640 ";

$result_count= mysql_query($query);

$count[0]= mysql_num_rows($result_count);


$result= mysql_query("$query"."LIMIT $offset,50");



print "<table><tr><td>Ergebnisse: $count[0]</td></tr>";







print"<tr><td><FORM  action='index.php' method='GET'  name='indexForm'>
<SELECT name='selindex' size='20'  onDblClick=getNotion(document.indexForm.selindex.options[document.indexForm.selindex.selectedIndex].value,'$id','$mod')>";


while($row=mysql_fetch_row ($result))
{
print"<option value='$row[0]'>".htmlspecialchars("$row[1] ($row[0])")."</option>";
}
print"</select></td></tr>";






print"<tr><td><input type=\"text\" name =\"var\" value=\"\">
      <input type = \"submit\" value=\"Suchen\" ></td></tr>
      <input type=\"hidden\" name=\"mod\" value=\"$mod\">
      <input type=\"hidden\" name=\"page\" value=\"$page\">
      <input type=\"hidden\" name=\"sart\" value=\"$sart\">
      <input type=\"hidden\" name=\"id\" value=\"$id\">
";

print"</FORM>";


print"<tr><td>";
if($offset !=0)print"<a href='index.php?page=".($page-1)."&id=$id&mod=$mod&sart=$sart'>[zurück]</a>";
if($offset+50 < $count[0])print"<a href='index.php?page=".($page+1)."&id=$id&mod=$mod&sart=$sart'>[vorwärts]</a>";
print"</tr></td>";


?>