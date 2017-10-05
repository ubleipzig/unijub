<HTML>
<HEAD>
<link rel="stylesheet" type="text/css" href="stylesheets.css">
<TITLE>Leipzig - Bibliographie</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>

<body>





<?php
include "config.php";
include "array_inc.php";
$sart=_array_item ($_GET,"sart");

$offset=_array_item ($_GET,"offset");

$delete_id=_array_item ($_GET,"delete_id");
$delete_mod=_array_item ($_GET,"delete_mod");
$delete_table=_array_item ($_GET,"delete_table");

?>









<table>
<form action ="update_2.php" method="GET" name="Formular" onsubmit="return chkFormular()">


<?php
$connect=_connect (HOST,USER,PASSWORD,DATABASE)  ;

if ($sart == "m")$table ="monographie ";
else if ($sart == "u")$table ="unselbststaendig ";
else if (($sart == "f")||($sart == "z"))$table ="periodica ";
else if ($sart == "i")$table ="institution ";
else if ($sart == "p")$table ="person ";
else if ($sart == "s")$table ="systematik ";
else if ($sart == "b")$table ="monographie ";
else die ();

if (empty($offset))$offset=1;

if ($sart == "b")$condi="where K003 = 'b'";
else $condi ="";
$query="Select K0i1 From $table $condi Order by K0i1 Limit ".($offset-1).",1";

$result= mysql_query($query);
$id_row=mysql_fetch_row($result);

$result_count= mysql_query("Select K0i1 From $table $condi");
$count[0]= mysql_num_rows($result_count);


if ($delete_mod == 2)// table
{
$query="DELETE FROM $table where K0i1 = '$id_row[0]' ";
$result= mysql_query($query);

$query="DELETE FROM k087_p where id = '$id_row[0]' ";
$result= mysql_query($query);


$query="DELETE FROM k200_p where id= '$id_row[0]' ";
$result= mysql_query($query);

$query="DELETE FROM k204_p where id= '$id_row[0]' ";
$result= mysql_query($query);



$query="DELETE FROM k441_z where id = '$id_row[0]' ";
$result= mysql_query($query);

if($count[0] > $offset) $offset++;
else $offset = 1;

$query="Select K0i1 From $table $condi Order by K0i1 Limit ".($offset-1).",1";
$result= mysql_query($query);
$id_row=mysql_fetch_row($result);


}
else if ($delete_mod == 1)//spalte
{


switch ($delete_table)
{
case "K087":
$query="DELETE FROM k087_p where K0i1 = '$delete_id' ";
$result= mysql_query($query);
break;
case "K200":
$query="DELETE FROM k200_p where K0i1= '$delete_id' ";
$result= mysql_query($query);
break;
case "K204":
$query="DELETE FROM k204_p where K0i1 = '$delete_id' ";
$result= mysql_query($query);
break;
case "K441":
$query="DELETE FROM k441_z where K0i1 = '$delete_id' ";
$result= mysql_query($query);
break;


}


}


$res =mysql_list_fields (DATABASE,"$table",$connect);

while ($var = @mysql_field_name($res,$i)){$$var=_array_item ($_GET,"$var");$i++;$str_rows=$str_rows."H.".$var.",";  $str2_rows=$str2_rows."'H.".$$var."',";}
$str_rows=substr ($str_rows,0,strlen($str_rows)-1);
$str2_rows=substr ($str2_rows,0,strlen($str2_rows)-1);



if (($sart == "z")||($sart == "f"))
$query_join[0]=     "LEFT JOIN  institution I ON H.K240= I .K0i1
                     LEFT JOIN  institution I2 ON H.K630= I2 .K0i1";

if (($sart == "m")||($sart == "u")||($sart == "z")||($sart == "f"))
$query_join[1]=     "LEFT JOIN  institution I ON H.k240 = I .K0i1";


if ($sart == "u")
$query_join[2] =     "LEFT JOIN  periodica F ON  H.K441 = F.K0i1";



if($sart == "u")
$query_join[3]=     " LEFT JOIN  k421_dz dz ON dz.id  = H.K0i1";


$query = "SELECT $str_rows FROM $table  H

  where H.K0i1 = '$id_row[0]'
 ";

$result= mysql_query($query);
$row=mysql_fetch_array($result);



$i=0;

while ($var = @mysql_field_name($res,$i))
{

$i++;
if (($sart == "f")&& (preg_match('/^K6/', $var))) continue;

if (($var == "K087")|| ($var == "K200")|| ($var == "K204")||($var == "K441"))
{
if ($var == "K087")$var2="k087_p";
else if ($var == "K200") $var2="k200_p";
else if ($var == "K204") $var2="k204_p";
else if ($var == "K441") $var2="k441_z";


if (($var == "K087")|| ($var == "K200")|| ($var == "K204"))$query2="SELECT 'p' as sart,   IFNULL(P.K900,H_k.id_p )  as name,IFNULL(P.K0i1 ,H_k.id_p )as id,P.K0i1 as ch, H_k.K0i1 as H_k_id  FROM $var2 H_k LEFT JOIN  person P ON H_k.id_p = P.K0i1 where H_k.id ='$id_row[0]' ";
else if ($var = "K441")$query2="SELECT 'z' as sart,IFNULL(IFNULL(F.K640,F.K620),H_k.id_z) as name,IFNULL(F.K0i1 ,H_k.id_z )as id,F.K0i1 as ch, H_k.K0i1 as H_k_id,H_k.K521a,H_k.K521b,H_k.K521c,H_k.K521d,H_k.zeort  FROM $var2 H_k LEFT JOIN  periodica F ON H_k.id_z = F.K0i1 where H_k.id ='$id_row[0]' ";


$result= mysql_query($query2);


$ii=0;


while ($row2=mysql_fetch_array($result))
{

if (!empty($row2[name]))
{

$ii++;
$var2=$var."$ii";
$row2[id]=str_replace ("\"","&quot;",$row2[id]);
print  "

            <tr>
            <td  align=\"left\" bgcolor=\"#D5D5D5\">$a[$var] Update:</td>
            <td bgcolor=\"#D5D5D5\">&nbsp;</td>
            <td bgcolor=\"#D5D5D5\">

            <table border = 1>
             <tr >
               <td rowspan = 2><textarea name=\"$var2\" cols=\"50\" rows=\"3\">$row2[id]</textarea></td>

               <td><a href =\"javascript:open_window('$var2',0)\" >[Index]</a></td>
             </tr>
             <tr>
              <td><a href =\"javascript:ensure($offset,'$row2[H_k_id]','$id_row[0]','$sart',1,'$var')\">[Delete]</a></td>
             </tr>


           ";





if(!empty($row2[ch]))print" <tr><td colspan = 2><a href =\"maske_update.php?id=$row2[id]&sart=$row2[sart]\"  target = \"_blank\">[".htmlspecialchars($row2[name])."]</a></td></tr>";
if ($var == "K441")
{
$row2[K521a]=str_replace ("\"","&quot;",$row2[K521a]);
$row2[K521b]=str_replace ("\"","&quot;",$row2[K521b]);
$row2[K521c]=str_replace ("\"","&quot;",$row2[K521c]);
$row2[K521d]=str_replace ("\"","&quot;",$row2[K521d]);
$row2[zeort]=str_replace ("\"","&quot;",$row2[zeort]);
print"<tr><td colspan = 2><table>
 <tr><td> Band</td><td><input type=\"text\" name=\"K521a".$ii."\" value=\"$row2[K521a]\" size=\"20\"  ></td></tr>
<tr><td> Jahr</td><td><input type=\"text\" name=\"K521b".$ii."\" value=\"$row2[K521b]\" size=\"20\"  ></td></tr>
<tr><td> Heftnr</td><td><input type=\"text\" name=\"K521c".$ii."\" value=\"$row2[K521c]\" size=\"20\"  ></td></tr>
 <tr><td> Seitenangabe</td><td><input type=\"text\" name=\"K521d".$ii."\" value=\"$row2[K521d]\" size=\"20\"  ></td></tr>
<tr><td>  Erscheinungsort</td><td><input type=\"text\" name=\"zeort".$ii."\" value=\"$row2[zeort]\" size=\"20\"  ></td></tr>
</table></td></tr>";





}
$id_hidden=$var2."_id";

print"<input type=\"hidden\" name =\"$id_hidden\" value=\"$row2[H_k_id]\">";
print"</table></td></tr>";
}

}

}
$query2="";
if (($var == "K087")|| ($var == "K200")|| ($var == "K204")||($var== "K441"))$query2="1";
else if (($var == "K240")||($var == "K630"))                                $query2="SELECT I.K003 as sart,I.K800 as name,IFNULL(I.K0i1,H.$var) as id  FROM $table H LEFT JOIN  institution I ON I.K0i1 = H.$var where H.K0i1 ='$id_row[0]' ";
$result= mysql_query($query2);

if (!empty ($query2))
{
$mod = 1;
if ($query2!="1")
{
$row2=mysql_fetch_array($result);
$mod = 0;
}
$row2[id]=str_replace ("\"","&quot;",$row2[id]);

print  "<tr>
        <td  align=\"left\" bgcolor=\"#D5D5D5\">$a[$var] Insert:</td>
        <td bgcolor=\"#D5D5D5\">&nbsp;</td>
        <td bgcolor=\"#D5D5D5\">
        <table = border = 1>
        <tr>
          <td>
           <textarea name=\"$var\" cols=\"50\" rows=\"3\">$row2[id]</textarea>
          </td>
          <td valign = middle>
            <a href =\"javascript:open_window('$var',$mod)\" >[Index]</a>
           </td></tr>";

        if ($var == K441)

        print"<tr><td colspan = 2><table>
         <tr><td> Band</td><td><input type=\"text\" name=\"K521a\" value=\"\"  size=\"30\" ></td></tr>
         <tr><td> Jahr</td><td><input type=\"text\" name=\"K521b\" value=\"\"   size=\"30\"></td></tr>
         <tr><td> Heftnr</td><td><input type=\"text\" name=\"K521c\" value=\"\"  size=\"30\" ></td></tr>
         <tr><td> Seitenangabe</td><td><input type=\"text\" name=\"K521d\" value=\"\"  size=\"30\" > </td></tr>
        <tr><td>  Erscheinungsort</td><td><input type=\"text\" name=\"zeort\" value=\"\"  size=\"30\" ></td></tr>
         </table></td></tr>";


if(!empty($row2[name]))print" <tr><td  colspan = 2 ><a href =\"maske_update.php?id=$row2[id]&sart=$row2[sart]\"  target = \"_blank\">[".htmlspecialchars($row2[name])."]</a></td></tr>";
print"</table></td></tr>";

$query2="";
}





else
{
if (($var == "K0i1")||($var == "K003"))
{
print"<input type=\"hidden\" name =\"$var\" value=\"$row[$var]\">";
 print"    <tr>
            <td  align=\"left\" bgcolor=\"#D5D5D5\">$a[$var] ($var)</td>
            <td bgcolor=\"#D5D5D5\">&nbsp;</td>
            <td bgcolor=\"#D5D5D5\">

             $row[$var]
             </td></tr>";
}
else
{

$row[$var]=str_replace ("\"","&quot;",$row[$var]);
print  "

            <tr>
            <td  align=\"left\" bgcolor=\"#D5D5D5\">$a[$var] ($var)</td>
            <td bgcolor=\"#D5D5D5\">&nbsp;</td>
            <td bgcolor=\"#D5D5D5\">

             <textarea name=\"$var\" cols=\"50\" rows=\"3\">$row[$var]</textarea>
             </td></tr>";
   }
}





$query2="";
}

print"<input type = \"hidden\" name =\"sart\" value=\"$sart\">";


mysql_close($connect);
?>
<tr><td colspan = "2" ><input type = "submit" value="Speichern" ></td>
<?php

print"<td><a href =\"javascript:ensure($offset,'','$id_row[0]','$sart',2,'')\">[Delete data]</a>";
print"<a  href =\"javascript:_close ()\">[Fenster schlie�en]</a></td>";

?>
<input name="offset" type="hidden"  value ="<?php print $offset ?>" >
</form>
</tr></table>


<table>
<form action ="maske_update_2.php"  name="Formular2" onsubmit="return check_input () ">

<tr><td>Ge�ffnete Tabelle:</td><td><select class="form" name="sart">
           <option value="<?php print $sart ?>" <?php if($sart=="m")print"selected"; ?>>Monographien </option>
           <option value="<?php print $sart ?>" <?php if($sart=="u")print"selected"; ?>>Aufs�tze  </option>
           <option value="<?php print $sart ?>" <?php if($sart=="f")print"selected"; ?>>Fortlaufende Werke</option>
           <option value="<?php print $sart ?>" <?php if($sart=="z")print"selected"; ?>>Zeitschriften</option>
           <option value="<?php print $sart ?>" <?php if($sart=="i")print"selected"; ?>>K�rperschaften  </option>
           <option value="<?php print $sart ?>" <?php if($sart=="p")print"selected"; ?>>Personen</option>
           <option value="<?php print $sart ?>" <?php if($sart=="s")print"selected"; ?>>Systematika </option>
           <option value="<?php print $sart ?>" <?php if($sart=="b")print"selected"; ?>>bildliche Darstellungen </option>

</select></td>
<td><input type = "submit" value="gehe zu Datensatz" ></td>
<td><input name="offset" type="text"   value ="<?php print $offset ?>" size="1" maxlength=""> von <?php print $count [0] ?> Datens�tzen</td>



	</form>

<?php
if($offset != 1)print"<td><a href='maske_update_2.php?offset=".($offset-1)."&sart=$sart'>[zur�ck]</a></td>";
if($offset < $count[0])print"<td><a href='maske_update_2.php?offset=".($offset+1)."&sart=$sart'>[vorw�rts]</a></td>";
?>
</tr><tr><td colspan = 5><a href='maske_update_2_choice.php' target= "_blank">[Neue Tabelle �ffnen]</a></td></tr></table>
<SCRIPT LANGUAGE="JavaScript">
<!--
function _close ()
{

self.close();
opener.focus ();
}






 function open_window (index,mod )
{

     var winA = window.open("index.php?mod="+mod+"&id="+index+"", 'MyWindow', 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizeable=1,width=500,height=500');

}


function ensure (offset,delete_id,id,sart,delete_mod,delete_table)
{

if (confirm("Loeschen?")== true){
 var Ziel = "maske_update_2.php?offset="+offset+"&id="+id+"&sart="+sart+"&delete_id="+delete_id+"&delete_mod="+delete_mod+"&delete_table="+delete_table+"";
 window.location.href = Ziel;
}
}




 function check_input ()
{



for (var i = 0; i < document.Formular2.offset.value.length; i++)
{


if (document.Formular2.offset.value.charAt(i) < "0" ||
        document.Formular2.offset.value.charAt(i) > "9" ||  document.Formular2.offset.value > <?php  print $count[0]; ?> )
    {
     alert("Dies ist kein g�ltiger Wert");
    document.Formular2.offset.focus();
    return false;
    }

}
}



//-->
</SCRIPT>


