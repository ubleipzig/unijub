<HTML>
<HEAD>
<TITLE>Leipzig - Bibliographie</TITLE> 
</HEAD>
<link rel="stylesheet" type="text/css" href="stylesheets.css">
<body>
<table border = 1>

<?php


include "config.php";
$connect=_connect (HOST,USER,PASSWORD,DATABASE)  ;

$K003=_array_item ($_GET,"K003");
$K521a=explode (";",_array_item ($_GET,"K521a"));
$K521b=explode (";",_array_item ($_GET,"K521b"));
$K521c=explode (";",_array_item ($_GET,"K521c"));
$K521d=explode (";",_array_item ($_GET,"K521d"));
$zeort=explode (";",_array_item ($_GET,"zeort"));


if ($K003 == "m")$table ="monographie";
else if ($K003 == "u")$table ="unselbststaendig";
else if (($K003 == "f")||($K003 == "z"))$table ="periodica";
else if ($K003 == "i")$table ="institution";
else if ($K003 == "p")$table ="person";
else if ($K003 == "s")$table ="systematik";
else if ($K003 == "b")$table ="monographie";
else die ("Fehler");


$res =mysql_list_fields (DATABASE,"$table",$connect);
$i=0;

while ($var = @mysql_field_name($res,$i))
{
$i++;
$$var=_array_item ($_GET,"$var");
$str =_array_item ($_GET,"$var");
$str=str_replace ("&quot;","\"",$str);
$str_rows=$str_rows."$var = '$str',";  
unset ($str);

	
if ($var == "K087")       {$column ="$K087"; $var2="k087_p";}
else if ($var == "K200")  {$column ="$K200"; $var2="k200_p";}
else if   ($var == "K204"){$column ="$K204";  $var2="k204_p";}
else if   ($var == "K441"){$column ="$K441";  $var2="k441_z";}


$x=0;
$y=0;
if (!empty ($column))
{

foreach (explode (";", $column) as $str)
{


if (!empty ($str))
{
$str=str_replace ("&quot;","\"",$str);
$K521a[$y]=str_replace ("&quot;","\"",$K521a[$y]);
$K521b[$y]=str_replace ("&quot;","\"",$K521b[$y]);
$K521c[$y]=str_replace ("&quot;","\"",$K521c[$y]);
$K521d[$y]=str_replace ("&quot;","\"",$K521d[$y]);
$zeort[$y]=str_replace ("&quot;","\"",$zeort[$y]);


if ($var == "K441")$query = "INSERT INTO $var2 (id,id_z,K521a,K521b,K521c,K521d,zeort) VALUES ('$K0i1','$str','$K521a[$y]','$K521b[$y]','$K521c[$y]','$K521d[$y]','$zeort[$y]')";
else $query = "INSERT INTO $var2 (id,id_p) VALUES ('$K0i1','$str')";

if($result= mysql_query($query))print "<tr><td>Erfolg:</td><td>$query</td></tr>";
else print"<tr><td>Fehler:</td><td>$query</td></tr>";
$y++;
}
$x++;
}
unset ($column);

}





$x=1;


while ($column =_array_item ($_GET,"$var"."$x"))
{
$column=str_replace ("&quot;","\"",$column);
$kid=_array_item ($_GET,"$var"."$x"."_id");
if ($var == "K441")
{
$c[0]=str_replace ("&quot;","\"",_array_item ($_GET,"K521a"."$x"));
$c[1]=str_replace ("&quot;","\"",_array_item ($_GET,"K521b"."$x"));
$c[2]=str_replace ("&quot;","\"",_array_item ($_GET,"K521c"."$x"));
$c[3]=str_replace ("&quot;","\"",_array_item ($_GET,"K521d"."$x"));
$c[4]=str_replace ("&quot;","\"",_array_item ($_GET,"zeort"."$x"));




$query = "Update $var2   Set id = '$K0i1', id_z = '$column',K521a = '$c[0]',K521b = '$c[1]',K521c = '$c[2]',K521d = '$c[3]',zeort = '$c[4]' where K0i1 = '$kid'";

}
else $query ="Update $var2   Set id = '$K0i1', id_p = '$column' where K0i1 = '$kid'";



if($result= mysql_query($query))print "<tr><td>Erfolg:</td><td>$query</td></tr>";
else print"<tr><td>Fehler:</td><td>$query</td></tr>";

$x++;
}
unset ($x);
unset ($column);







if   ($var == "K240")     $column="$K240";
else if   ($var == "K630")$column ="$K630";





if (!empty ($column))
{
$query = "Update $table   Set $var = '$column' where K0i1 = '$K0i1'";
if($result= mysql_query($query))print "<tr><td>Erfolg:</td><td>$query</td></tr>";
else print"<tr><td>Fehler:</td><td>$query</td></tr>";

unset ($column);
}
}




$str_rows=substr ($str_rows,0,strlen($str_rows)-1);

$query = "Update $table Set $str_rows where K0i1 = '$K0i1'";
if($result= mysql_query($query))print "<tr><td>Erfolg:</td><td>$query</td></tr>";
else print"<tr><td>Fehler:</td><td>$query</td></tr>";


print"<meta http-equiv=\"refresh\" content=\"2; URL=maske_update.php?id=$K0i1&sart=$K003\">";
print"<p>Wenn die automatische Weiterleitung nicht funktioniert klicken sie <a href = \"maske_update.php?id=$K0i1&sart=$K003\"> hier</a></p>";
mysql_close($connect);
?>
</body>
</html>