<?php

define ("HOST",$_ENV['MYSQL_HOST']);
define ("USER",$_ENV['MYSQL_USER']);
define ("PASSWORD",$_ENV['MYSQL_PASSWORD']);
define ("DATABASE",$_ENV['MYSQL_DATABASE']);


function _connect ($host,$user,$pw,$db)
{
$mysql=mysql_connect ($host,$user,$pw);

mysql_select_db (DATABASE,$mysql) ;
return $mysql;

}





function _array_item ($ar,$key)
{

if(is_array($ar) && array_key_exists($key,$ar)&&(!empty($ar[$key])))
{
 if (!get_magic_quotes_gpc())return addslashes($ar[$key]);

 else return trim($ar[$key]);

}

else  return FALSE;

}

function _array_item_2 ($ar,$key)
{
if(is_array($ar) && array_key_exists($key,$ar)) return trim($ar[$key]);
else return FALSE;

}


function display_title ($row,$url)
{
$ar = array("[","]","(",")","/","\"",",",";");
foreach(explode(" ",$row) as $var)
{

foreach ($ar as $str)
{

if (substr($var,-strlen($var),1) == $str)
{
$left_char=substr($var,-strlen($var),1);
$var = substr($var,1);

}



if (substr($var,-1,1) == $str)
{
$right_char=substr($var,-1,1);
$var = substr($var,0,strlen($var)-1);

}

}

print" $left_char<a href=\"ausgabe.php?suchwort0=".urlencode($var)."&suchindex0=2&$url\">".htmlspecialchars($var)."</a>$right_char ";

$left_char ="";
$right_char ="";

}
}

function display_kname ($row,$url)
{

foreach(explode(" ",$row) as $var) print"<a href=\"ausgabe.php?suchwort0=".urlencode($var)."&suchindex0=5&$url\">".htmlspecialchars($var)."</a>";
}



function titel ($str,$str2,$url,$sart)
{
if(!empty($str))
{
if ($sart == "u") $name = "Aufsatz:";
else $name = "Titel:";
print"<tr><td valign='top'><strong>".htmlspecialchars($name)."</strong></td><td >";
display_title($str,$url);
if(!empty($str2)){print"&nbsp;:&nbsp;"; display_title($str2,$url);};
print"</td>";
}
}

function titel3 ($str,$str2,$url,$sart)
{
if(!empty($str))
{
print"<tr><td valign='top'><strong>ehem. Titel</strong></td><td >";
display_title($str,$url);
if(!empty($str2)){print"&nbsp;:&nbsp;"; display_title($str2,$url);};
print"</td>";
}
}

function titel2 ($str,$str2,$url,$sart)
{
if(!empty($str))
{
print"<tr><td valign='top'><strong>Kurz-/Zitiertitel</strong></td><td >";
display_title($str,$url);
if(!empty($str2)){print"&nbsp;:&nbsp;"; display_title($str2,$url);};
print"</td>";
}
}


function titel_zusatz ($schriftenreihe,$K799)
{

if(!empty($schriftenreihe)){
print"<tr><td valign='top'><strong>Schriftenreihe:</strong></td><td>";
print htmlspecialchars($schriftenreihe);
print"</td></tr>";
}

if(!empty($K799))
{
print"<tr><td valign='top'><strong>Zusatzbemerkungen:</strong></td><td>";
print htmlspecialchars($K799);
print"</td></tr>";
}


}







function person ($id,$url,$sart)
{
$query="SELECT IFNULL(p.K900,id_p) as verfasser,p.K910 as pseudonym,p.K920 as gjahr,p.K930 as djahr,p.K940 as beruf FROM k200_p
LEFT JOIN person p ON id_p = p.K0i1 where id = '$id' AND  id_p IS NOT NULL";
$result2= mysql_query($query);

if (mysql_numrows($result2)){
if ($sart == "b") $name = "Künstler";
else $name = "Verfasser";

print"<tr><td valign='top'><strong>".htmlspecialchars($name)."</strong></td><td>";


while($row2=mysql_fetch_array($result2)){

print"<table><tr><td><a href=\"ausgabe.php?suchwort0=".urlencode($row2[verfasser])."&suchindex0=4&$url\">".htmlspecialchars($row2[verfasser]); if (!empty ($row2[pseudonym]))print "&nbsp;[".htmlspecialchars($row2[pseudonym])."]</a></td></tr>";
if(!empty($row2[gjahr]))print"<tr><td>".htmlspecialchars($row2[gjahr])."&nbsp;-&nbsp;".htmlspecialchars($row2[djahr])."</td></tr>";
if(!empty($row2[beruf]))print "<tr><td>".htmlspecialchars($row2[beruf])."</td></tr>";
print"</table>";
}


print"</td></tr>";
}
}




function sonstige ($id,$url)
{
$query="SELECT IFNULL(p.K900,id_p) as verfasser,p.K910 as pseudonym,p.K920 as gjahr,p.K930 as djahr,p.K940 as beruf,zusatz FROM k204_p
LEFT JOIN person p ON id_p = p.K0i1 where id = '$id' AND  id_p IS NOT NULL";
$result2= mysql_query($query);

if (mysql_numrows($result2)){


print"<tr><td valign='top'><strong>sonstige Personen</strong></td><td>";


while($row2=mysql_fetch_array($result2)){

print"<table><tr><td><a href=\"ausgabe.php?suchwort0=".urlencode($row2[verfasser])."&suchindex0=4&$url\">$row2[verfasser]"; if (!empty ($row2[pseudonym]))print "&nbsp;[".htmlspecialchars($row2[pseudonym])."]</a>";
if(!empty($row2[zusatz]))print "&nbsp;".htmlspecialchars($row2[zusatz]);
print"</td></tr>";
if(!empty($row2[gjahr]))print"<tr><td>".htmlspecialchars($row2[gjahr])."&nbsp;-&nbsp;".htmlspecialchars($row2[djahr])."</td></tr>";
if(!empty($row2[beruf]))print "<tr><td>$row2[beruf]</td></tr>";
print"</table>";
}

print"</td></tr>";

}
}



function schlagwort ($id,$url)
{
$query="SELECT IFNULL(p.K900,id_p) as verfasser,p.K910 as pseudonym,p.K920 as gjahr,p.K930 as djahr,p.K940 as beruf FROM k087_p
LEFT JOIN person p ON id_p = p.K0i1 where id = '$id' AND  id_p IS NOT NULL";
$result2= mysql_query($query);

if (mysql_numrows($result2)){


print"<tr><td valign='top'><strong>Schlagw&ouml;rter:</strong></td><td>";


while($row2=mysql_fetch_array($result2)){

print"<table><tr><td><a href=\"ausgabe.php?suchwort0=".urlencode($row2[verfasser])."&suchindex0=3&$url\">".htmlspecialchars($row2[verfasser]); if (!empty ($row2[pseudonym]))print "&nbsp;[".htmlspecialchars($row2[pseudonym])."]</a></td></tr>";
if(!empty($row2[gjahr]))print"<tr><td>".htmlspecialchars($row2[gjahr])."&nbsp;-&nbsp;".htmlspecialchars($row2[djahr])."</td></tr>";
if(!empty($row2[beruf]))print "<tr><td>".htmlspecialchars($row2[beruf])."</td></tr>";
print"</table>";
}


print"</td></tr>";
}




}

function koerperschaft ($str,$kid,$url)
{

if(!empty($str)) {

print"<tr><td valign='top'><strong>K&ouml;rperschaft:</strong></td><td>";
if (!empty($kid))
{

$table="institution K";

$query="SELECT K.K800 as name,K.K810 aname ,K.K811 as fname,K.K812 as sname,K.K820 gjahr,K.K830 djahr
 FROM $table WHERE K.K0i1 = '$kid' ";

$result= mysql_query($query);
$row=mysql_fetch_array($result) ;

print"<table>";
if(!empty($row[name]))print"<tr><td valign='top'>Name:</td><td><a href=\"ausgabe.php?suchwort0=".urlencode($str)."&suchindex0=5&$url\">"; print htmlspecialchars($str); print"</a></td></tr>";


if(!empty($row[aname]))print "<tr><td valign='top'>Andere Namensform:</td><td>".htmlspecialchars($row[aname])."</td></tr>";

if(!empty($row[fname]))print "<tr><td valign='top'>fr&uuml;herer Name:</td><td>".htmlspecialchars($row[fname])."</td></tr>";

if(!empty($row[sname]))print "<tr><td valign='top'>sp&auml;terer Name:</td><td>".htmlspecialchars($row[sname])."</td></tr>";



if(!empty($row[gjahr]))print "<tr><td valign='top'>Gr&uuml;ndung:</td><td>".htmlspecialchars($row[gjahr])."</td></tr>";

if(!empty($row[djahr]))print "<tr><td valign='top'>Aufl&ouml;sung:</td><td>".htmlspecialchars($row[djahr])."</td></tr>";



print"</table>";


}
else print htmlspecialchars($str);;

print"</td></tr>";
}

}

function herausgeber ($str,$kid,$url)
{

if(!empty($str)) {

print"<tr><td valign='top'><strong>Herausgeber:</strong></td><td>";
if (!empty($kid))
{

$table="institution K";

$query="SELECT K.K800 as name,K.K810 aname ,K.K811 as fname,K.K812 as sname,K.K820 gjahr,K.K830 djahr
 FROM $table WHERE K.K0i1 = '$kid' ";

$result= mysql_query($query);
$row=mysql_fetch_array($result) ;

print"<table>";
if(!empty($row[name]))print"<tr><td valign='top'>Name:</td><td><a href=\"ausgabe.php?suchwort0=".urlencode($str)."&suchindex0=5&$url\">"; print htmlspecialchars($str); print"</a></td></tr>";


if(!empty($row[aname]))print "<tr><td valign='top'>Andere Namensform:</td><td>".htmlspecialchars($row[aname])."</td></tr>";

if(!empty($row[fname]))print "<tr><td valign='top'>fr&uuml;herer Name:</td><td>".htmlspecialchars($row[fname])."</td></tr>";

if(!empty($row[sname]))print "<tr><td valign='top'>sp&auml;terer Name:</td><td>".htmlspecialchars($row[sname])."</td></tr>";



if(!empty($row[gjahr]))print "<tr><td valign='top'>Gr&uuml;ndung:</td><td>".htmlspecialchars($row[gjahr])."</td></tr>";

if(!empty($row[djahr]))print "<tr><td valign='top'>Aufl&ouml;sung:</td><td>".htmlspecialchars($row[djahr])."</td></tr>";



print"</table>";


}
else print htmlspecialchars($str);;

print"</td></tr>";
}

}


function ovj ($o,$v,$j,$dj,$url)
{
if((!empty($o))||(!empty($v))||(!empty($j)))
{
print"<tr><td valign='top'><strong>Erschienen:</strong></td><td>";
if(!empty($o)) print htmlspecialchars($o);

if(!empty($v)){if(!empty($o))print "&nbsp;:&nbsp;"; print "<a href=\"ausgabe.php?suchwort0=".urlencode($v)."&suchindex0=7&$url \">".htmlspecialchars($v)."</a>";}

if(!empty($j)){if(!empty($v))print ",&nbsp;"; else if((!empty($o)))print "&nbsp;:&nbsp;"; print htmlspecialchars($j) ;if (!empty($dj))print"&nbsp;-&nbsp;".htmlspecialchars($dj);}


print"</td></tr>";
}
}

function umfang ($umfang)
{
if(!empty($umfang)) print"<tr><td><strong>Umfang:</strong></td><td>".htmlspecialchars($umfang)."</td></tr>";

}
?>
