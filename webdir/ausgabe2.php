<HTML>
<HEAD>
<TITLE>Leipzig - Bibliographie</TITLE>
</HEAD>
<link rel="stylesheet" type="text/css" href="stylesheets.css">
<body>





<?php
include "config.php";

$db=_connect (HOST,USER,PASSWORD,DATABASE)  ;

$id=  _array_item_2 ($_GET,"id");
$sart=_array_item_2 ($_GET,"sart");


$filter[0]=_array_item_2 ($_GET,"filter0");
$filter[1]=_array_item_2 ($_GET,"filter1");
$filter[2]=_array_item_2 ($_GET,"filter2");
$filter[3]=_array_item_2 ($_GET,"filter3");
$filter[4]=_array_item_2 ($_GET,"filter4");

$sort =_array_item_2 ($_GET,"sort");

$url="filter0=$filter[0]&filter1=$filter[1]&filter2=$filter[2]&filter3=$filter[3]&filter4=$filter[4]&sort=$sort&trunk0=1";



print"<TABLE width =\"100%\" cellpadding=\"0\" cellspacing=\"10\" border=\"1\">";

if($sart == "m")
{

$table="monographie m";



$query="SELECT m.K320,m.K799,m.K335,m.K410 as eort,m.K412 as verlag,m.K425 as ejahr,m.K433 as umfang,IFNULL(i.K800,m.K240) as Koerperschaft,m.K240 as kid,m.K440 as schriftenreihe
        ,m.K086 as systematik,m.K060 as quelle,m.K510 as hochschulort,m.K511 as hart,m.K513 as promotion,m.K403
        FROM $table  LEFT JOIN institution i  ON m.K240 = i.K0i1    where m.K0i1 = '$id'";



$result= mysql_query($query);
$row=mysql_fetch_array($result) ;



titel ($row[K320],$row[K335],$url,$sart);


titel_zusatz ($row[schriftenreihe],$row[K799])   ;



//verfasser

person ($id,$url,$sart)  ;


//sonstige
sonstige ($id,$url)  ;

//körperschaft

koerperschaft ($row[Koerperschaft],$row[kid],$url)  ;

//ort verlag jahr

ovj ($row[eort],$row[verlag],$row[ejahr],"",$url);




//umfang
umfang ($row[umfang]);


//reihe


//Hochschulschrift:

if(!empty($row[hochschulort])){
print"<tr><td valign='top'><strong>Hochschulschrift:</strong></td><td>";
 print htmlspecialchars($row[hochschulort]);

if(!empty($row[hart])){if(!empty($row[hochschulort]))print "&nbsp;:&nbsp;"; print htmlspecialchars($row[hart]);}

if(!empty($row[promotion])){if(!empty($row[hart]))print ",&nbsp;"; else if((!empty($row[hochschulort])))print "&nbsp;:&nbsp;"; print htmlspecialchars($row[promotion]);}

print"</td></tr>";
}
//schlagwörter
schlagwort ($id,$url) ;


if(!empty($row[K403])){
print"<tr><td valign=\"top\"><strong>Ausgabenbezeichnung:</strong></td><td>";
 print htmlspecialchars($row[K403]);
print"</td></tr>";
}


print"</table>";
}
// ----------------------------------------------------------------------------------------------
else if ($sart == "u")
{
$table="unselbststaendig u";

$query="SELECT u.K320 ,u.K335 ,u.K410 as eort,u.K412 as verlag,
u.K425 as ejahr,u.K448 as kongress,u.K433 as umfang,u.K799 
FROM $table

where u.K0i1 = '$id' ";


$result= mysql_query($query);
$row=mysql_fetch_array($result) ;



//titel

titel ($row[K320],$row[K335],$url,$sart);
titel_zusatz ("",$row[K799])   ;

//kongress
if(!empty($row[kongress]))
{
print"<tr><td valign='top'><strong>Kongress:</strong></td><td>";
print htmlspecialchars($row[kongress]);
print"</td></tr>";
}


//verfasser
person ($id,$url,$sart)  ;


//sonstige
sonstige ($id,$url)  ;





$query="SELECT IFNULL(IFNULL(f.K640,f.K620),dz.id_z) as zeitschrift,
dz.K521b as dzjahr,dz.K521d as seite,dz.K521a as band,
dz.K521c as heftnr,f.K0i1 as zid,dz.zeort as zeort,f.K632 as verlag From k441_z dz 
LEFT JOIN  periodica f On dz.id_z = f.K0i1 where dz.id = '$id' Group by zeitschrift ";

$result= mysql_query($query);



while($row2=mysql_fetch_array($result)) 
{
if(!empty($row2[zeitschrift]))
{
print"<tr><td valign='top'><strong>In :</strong></td><td>";

if(!empty($row2[zid]))print" <a href=\"ausgabe2.php?id=".urlencode($row2[zid])."&sart=z&$url\">".htmlspecialchars($row2[zeitschrift])."</a>";
else print htmlspecialchars($row2[zeitschrift]);

if(!empty($row2[zeort])){if((!empty($row2[zeitschrift]))||(!empty($row2[stitel]))) print"&nbsp;-&nbsp;"; print htmlspecialchars($row2[zeort]);}

if(!empty($row2[verlag])){if(!empty($row2[zeort]))print "&nbsp;:&nbsp;";else if((!empty($row2[zeitschrift]))||(!empty($row2[stitel])))print"&nbsp;-&nbsp;"; print "<a href=\"ausgabe.php?suchwort0=".urlencode($row2[verlag])."&suchindex0=7&$url \">".htmlspecialchars($row2[verlag])."</a>";}

if(!empty($row2[band]))    print ",&nbsp;".htmlspecialchars($row2[band]);

if(!empty($row2[dzjahr])){if (!empty($row2[band]))print "&nbsp;"; else print",&nbsp;"; print "(".htmlspecialchars($row2[dzjahr]).")";}

if(!empty($row2[heftnr])){print ",&nbsp;".htmlspecialchars($row2[heftnr]); }

if(!empty($row2[seite])){ print ",&nbsp;".htmlspecialchars($row2[seite]); }


print"</td></tr>";
}
}

ovj ($row[eort],$row[verlag],$row[ejahr],"",$url);

//umfang
umfang ($row[umfang]);


//schlagwörter
schlagwort ($id,$url) ;

print"</table>";
}

///////- periodica!!!-------------------------------------
else if ($sart == "f")
{
$table="periodica F";

$query="SELECT F.K320 as htitel,F.K335 as ztitel,
IFNULL(I.K800,F.K240) as koerperschaft,I.K0i1 as kid,F.K410 as eort,F.K412 as verlag,
 F.K426 as gjahr, F.K427 as djahr,F.K799
 FROM $table
 LEFT JOIN institution I ON F.K240 = I.K0i1

 WHERE F.K0i1 = '$id' ";


$result= mysql_query($query);
$row=mysql_fetch_array($result) ;

//titel
titel ($row[htitel],$row[ztitel],$url,$sart);
titel_zusatz ("",$row[K799])   ;


//körperschaft
koerperschaft ($row[koerperschaft],$row[kid],$url)  ;




ovj ($row[eort],$row[verlag],$row[gjahr],$row[djahr],$url);




print"</table>";
}

else if ($sart == "z")
{
$table="periodica F";

$query="SELECT F.K640 as htitel,F.K635 as ztitel,F.K620 as zztitel,F.K610 as ename,
IFNULL(I.K800,F.K630) as herausgeber,I.K0i1 as kid,F.K631 as eort,F.K632 as verlag,
 F.K636 as gjahr, F.K637 as djahr,F.K799,IFNULL(I2.K800,F.K240) as koerperschaft,I2.K0i1 as k2id
 FROM $table
 LEFT JOIN institution I ON F.K630 = I.K0i1
  LEFT JOIN institution I2 ON F.K240 = I2.K0i1
 WHERE F.K0i1 = '$id' ";

$result= mysql_query($query);
$row=mysql_fetch_array($result) ;

//titel
titel ($row[htitel],$row[ztitel],$url,$sart);

if(!empty($row[htitel]))$row[ztitel]="";

titel2 ($row[zztitel],$row[ztitel],$url,$sart);

if(!empty($row[zztitel]))$row[ztitel]="";

titel3 ($row[ename],$row[ztitel],$url,$sart);



titel_zusatz ("",$row[K799])   ;



//herausgeber

herausgeber ($row[herausgeber],$row[kid],$url)  ;



ovj ($row[eort],$row[verlag],$row[gjahr],$row[djahr],$url);

//Ersch.-verlauf:
if(!empty($row[everlauf])){
print"<tr><td valign=\"top\"><strong>Ersch.-verlauf:</strong></td><td>";
 print htmlspecialchars($row[everlauf]);
print"</td></tr>";
}

koerperschaft ($row[koerperschaft],$row[k2id],$url)  ;
print"</table>";
}


else if ($sart == "b")
{
$table="monographie m";


$query="SELECT m.K320,m.K799,m.K335,m.K410 as eort,m.K412 as verlag,m.K403 as beschreibung,m.K425 as ejahr,m.K433 as umfang,IFNULL(i.K800,m.K240) as Koerperschaft,m.K440 as schriftenreihe
        ,m.K086 as systematik,m.K060 as quelle,m.K510 as hochschulort,m.K511 as hart,m.K513 as promotion
        FROM $table  LEFT JOIN institution i  ON m.K240 = i.K0i1    where m.K0i1 = '$id'";



$result= mysql_query($query);
$row=mysql_fetch_array($result) ;


titel ($row[K320],$row[K335],$url,$sart);


titel_zusatz ($row[schriftenreihe],$row[K799])   ;



//verfasser
person ($id,$url,$sart)  ;


//sonstige
sonstige ($id,$url)  ;

//körperschaft

koerperschaft ($row[Koerperschaft],$row[kid],$url)  ;

//ort verlag jahr

ovj ($row[eort],$row[verlag],$row[ejahr],"",$url);




//umfang
umfang ($row[umfang]);


//beschreibung
if(!empty($row[beschreibung])) print"<tr><td><strong>Beschreibung:</strong></td><td>".htmlspecialchars($row[beschreibung])."</td></tr>";




//schlagwörter
schlagwort ($id,$url) ;

print"</table>";
}
mysql_close($db);
?>

<p align = "center"><a  href ="javascript:_close ()">[Fenster schließen]</a></p> 

</body>
</html>

<SCRIPT LANGUAGE="JavaScript">
<!--
function _close ()
{

self.close();
opener.focus ();
}
//-->
</SCRIPT>
