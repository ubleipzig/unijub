<HTML>
<HEAD>
<link rel="stylesheet" type="text/css" href="stylesheets.css">
<TITLE>Leipzig - Bibliographie</TITLE> 
</HEAD>

<body>

<?php 
include "config.php";
include "array_inc.php";
$sart=_array_item ($_GET,"sart");
?>

<form action ="maske_insert.php" method="GET" name="Formular2" onsubmit="return chkFormular()">


<p>Bitte wählen sie eine Werkart:</p> 

<select class="form" name="sart">
           <option value="m" <?php if($sart=="m")print"selected"; ?>>Monographien </option>
           <option value="u" <?php if($sart=="u")print"selected"; ?>>Aufs&auml;tze  </option>
           <option value="f" <?php if($sart=="f")print"selected"; ?>>Fortlaufende Werke</option>
           <option value="z" <?php if($sart=="z")print"selected"; ?>>Zeitschriften</option>
           <option value="i" <?php if($sart=="i")print"selected"; ?>>K&ouml;rperschaften  </option>
           <option value="p" <?php if($sart=="p")print"selected"; ?>>Personen</option>
           <option value="s" <?php if($sart=="s")print"selected"; ?>>Systematika </option>
           <option value="b" <?php if($sart=="b")print"selected"; ?>>bildliche Darstellungen </option>
</select>
<input type = "submit" value="Übernehmen" >
</form>






<table>
<form action ="insert.php" method="GET" name="Formular" onsubmit="return chkFormular()">
<?php
$connect=_connect (HOST,USER,PASSWORD,DATABASE)  ;

if ($sart == "m")$table ="monographie";
else if ($sart == "u")$table ="unselbststaendig";
else if (($sart == "f")||($sart == "z"))$table ="periodica";
else if ($sart == "i")$table ="institution";
else if ($sart == "p")$table ="person";
else if ($sart == "s")$table ="systematik";
else if ($sart == "b")$table ="monographie";
else die ();

$res =mysql_list_fields (DATABASE,"$table",$connect);



$i=2;

while ($var = @mysql_field_name($res,$i))
{
$i++;  
if (($sart == "f")&& (preg_match('/^K6/', $var))) continue;

print  "
       
            <tr >
            <td  align=\"left\" bgcolor=\"#D5D5D5\">$a[$var] ($var) </td>
            <td bgcolor=\"#D5D5D5\">&nbsp;</td>
            <td bgcolor=\"#D5D5D5\">";
   
     
     
     print  "<input type=\"text\" name=\"$var\" value=\"\" size=\"60\" maxlength=\"750\" >";
           
       
if ($var == "K900") print "<a href =\"javascript:open_window('K200',1)\" >[Index]</a>";  
if ($var == "K087") print "<a href =\"javascript:open_window('$var',1)\" >[Index]</a>";  
if ($var == "K200") print "<a href =\"javascript:open_window('$var',1)\" >[Index]</a>";  
if ($var == "K204") print "<a href =\"javascript:open_window('$var',1)\" >[Index]</a>";  
if ($var == "K240") print "<a href =\"javascript:open_window('$var',0)\" >[Index]</a>";  
if ($var == "K441") print "<a href =\"javascript:open_window('$var',1)\" >[Index]</a>"; 
if ($var == "K630") print "<a href =\"javascript:open_window('$var',0)\" >[Index]</a>"; 
     
        
        
        if ($var == K441)print"<table>
         <tr><td> Band</td><td><input type=\"text\" name=\"K521a\" value=\"\"  size=\"30\" ></td></tr>
         <tr><td> Jahr</td><td><input type=\"text\" name=\"K521b\" value=\"\"   size=\"30\"></td></tr>
         <tr><td> Auflage</td><td><input type=\"text\" name=\"K521c\" value=\"\"  size=\"30\" ></td></tr>
         <tr><td> Seitenangabe</td><td><input type=\"text\" name=\"K521d\" value=\"\"  size=\"30\" > </td></tr>
        <tr><td>  Erscheinungsort</td><td><input type=\"text\" name=\"zeort\" value=\"\"  size=\"30\" ></td></tr>
         </table>";


print"</td></tr>";
  

}

print"<input type = \"hidden\" name =\"sart\" value=\"$sart\">";
?>
<tr><td colspan = "3" ><input type = "submit" value="Speichern">

</table>
</form>


<SCRIPT LANGUAGE="JavaScript">
<!--
 function open_window (index,mod )
{
 
var winA = window.open("index.php?mod="+mod+"&id="+index+"", 'MyWindow', 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizeable=1,width=500,height=500');
     
}


//-->
</SCRIPT>
</body>
</html>