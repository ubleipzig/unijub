<HTML>
<HEAD>
<TITLE>Leipzig - Bibliographie</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="stylesheets.css">
</HEAD>
<body>
<table border = 1>

<?php
include "config.php";
$sart=_array_item ($_GET,"sart");
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

while ($var = @mysql_field_name($res,$i)){$$var=_array_item ($_GET,"$var");$i++;$str_rows=$str_rows."$var,";  $str2_rows=$str2_rows."'".$$var."',";}
$str_rows=substr ($str_rows,0,strlen($str_rows)-1);
$str2_rows=substr ($str2_rows,0,strlen($str2_rows)-1);

if ($sart != "b")$row ="max_id_".$sart;
else $row ="max_id_"."m";


$query = "SELECT $row FROM info";
$result= mysql_query($query);
$info=mysql_fetch_array ($result);

$info[0]=$info[0]{0}.(substr($info[0],1)+1);

$query = "INSERT INTO $table (K0i1,K003,$str_rows)
                    VALUES ('$info[0]','$sart',$str2_rows)";
if($result= mysql_query($query))print "<tr><td>Erfolg:</td><td>$query</td></tr>";
else print"<tr><td>Fehler:</td><td>$query</td></tr>";





foreach (explode(";",$K087) as $var )
{

if(!empty($var))
{
$query = "INSERT INTO k087_p (id,id_p)
                      VALUES ('$info[0]','$var')";
if($result= mysql_query($query))print "<tr><td>Erfolg:</td><td>$query</td></tr>";
else print"<tr><td>Fehler:</td><td>$query</td></tr>";

}
}


foreach (explode(";",$K200) as $var )
{

if(!empty($var))
{
$query = "INSERT INTO k200_p (id,id_p)
                      VALUES ('$info[0]','$var')";
if($result= mysql_query($query))print "<tr><td>Erfolg:</td><td>$query</td></tr>";
else print"<tr><td>Fehler:</td><td>$query</td></tr>";

}

}



foreach (explode(";",$K204) as $var )
{
if(!empty($var))
{
$query = "INSERT INTO k204_p (id,id_p)
                      VALUES ('$info[0]','$var')";
if($result= mysql_query($query))print "<tr><td>Erfolg:</td><td>$query</td></tr>";
else print"<tr><td>Fehler:</td><td>$query</td></tr>";

}

}
$K521a=explode (";",_array_item ($_GET,"K521a"));
$K521b=explode (";",_array_item ($_GET,"K521b"));
$K521c=explode (";",_array_item ($_GET,"K521c"));
$K521d=explode (";",_array_item ($_GET,"K521d"));
$zeort=explode (";",_array_item ($_GET,"zeort"));
$y=0;
foreach (explode(";",$K441) as $var )
{

if(!empty($var))
{


$query = "INSERT INTO k441_z (id,id_z,K521a,K521b,K521c,K521d,zeort)
                      VALUES ('$info[0]','$var','$K521a[$y]','$K521b[$y]','$K521c[$y]','$K521d[$y]','$zeort[$y]')";
if($result= mysql_query($query))print "<tr><td>Erfolg:</td><td>$query</td></tr>";
else print"<tr><td>Fehler:</td><td>$query</td></tr>";
$y++;
}


}

if ($sart == "b")$sart ="m";
$query = "UPDATE info SET max_id_".$sart."= '$info[0]' ";
if($result= mysql_query($query))print "<tr><td>Erfolg:</td><td>$query</td></tr>";
else print"<tr><td>Fehler:</td><td>$query</td></tr>";


print"<meta http-equiv=\"refresh\" content=\"10; URL=maske_insert.php\">";
print"<p>Wenn die automatische Weiterleitung nicht funktioniert klicken sie <a href = \"maske_insert.php\">hier</a></p>";

mysql_close($connect);

?>