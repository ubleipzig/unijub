<HTML>
<HEAD>
<TITLE>Leipzig - Bibliographie</TITLE>
</HEAD>
<link rel="stylesheet" type="text/css" href="stylesheets.css">
<body>




<?php
include "config.php";

$db=_connect (HOST,USER,PASSWORD,DATABASE);

$i2=-1;
for($i=0;$i<4;$i++)
{
if($var=_array_item ($_GET,"suchwort".$i))
{
 $i2++;
 $trunk[$i2]=_array_item_2 ($_GET,"trunk".$i);
 $suchindex[$i2]=_array_item_2 ($_GET,"suchindex".$i);
 $connector[$i2]=_array_item_2 ($_GET,"connector".$i);
 $suchwort[$i2]=$var;

}
}

if(empty($suchwort[0]))$trunk[0]=_array_item_2 ($_GET,"trunk0");




$filter[0]=_array_item_2 ($_GET,"filter0");
$filter[1]=_array_item_2 ($_GET,"filter1");
$filter[2]=_array_item_2 ($_GET,"filter2");
$filter[3]=_array_item_2 ($_GET,"filter3");
$filter[4]=_array_item_2 ($_GET,"filter4");

$operator =_array_item_2 ($_GET,"operator");
$page =_array_item_2 ($_GET,"page");
$sort =_array_item_2 ($_GET,"sort");
$smod =_array_item_2 ($_GET,"smod");

$url_2="
suchindex0=".urlencode($suchindex[0])."
&suchwort0=".urlencode(stripslashes($suchwort[0] )) ."
&connector0=".urlencode($connector[0]) ."
&trunk0=".urlencode($trunk[0])."
&filter0=".urlencode($filter[0])."
&suchindex1=".urlencode($suchindex[1])."
&suchwort1=".urlencode(stripslashes($suchwort[1]))."
&connector1=".urlencode($connector[1])."
&trunk1=".urlencode($trunk[1])."
&filter1=".urlencode($filter[1])."
&suchindex2=".urlencode($suchindex[2])."
&suchwort2=".urlencode(stripslashes($suchwort[2]))."
&connector2=".urlencode($connector[2])."
&trunk2=".urlencode($trunk[2])."
&filter2=".urlencode($filter[2])."
&operator=".urlencode($operator)."
&suchwort3=".urlencode(stripslashes($suchwort[3]) )."
&sort=".urlencode($sort)."
&operator=".urlencode($operator)."
&filter3=".urlencode($filter[3])."
&filter4=".urlencode($filter[4]);



print"<table width = 100% ><tr><td>";

if ($smod == 0)
{
include "maske.php";
print"</td><td align = middle ><a href=\"ausgabe.php?smod=1&$url_2\">Erweiterte Suche</a></td>";
}
else
{
include "maske2.php";
print"</td><td align = middle><a href=\"ausgabe.php?smod=0&$url_2\">Einfache Suche</a></td>";
}

print"</tr></table>";



















for($i=0;$i<4;$i++)
{

if(empty($suchwort[$i]))continue;
$var=$suchwort[$i];
if($trunk[$i])$var="LIKE '%$var%'";
else $var= "= '$var' ";

switch ($suchindex[$i])
{

case 1: //all




$query_con[0][$i] ="M.K060 $var OR M.K086    $var OR M.K087    $var OR M.K140 $var OR M.K200 $var OR M.K204    $var OR M.K240    $var

OR M.K320    $var OR M.K335    $var OR M.K403    $var OR M.K433    $var OR M.K410    $var OR M.K412   $var OR M.K421    $var

OR M.K422   $var OR M.K425   $var OR M.K426   $var OR M.K440    $var OR M.K448    $var

OR M.K510    $var OR M.K511   $var OR M.K513    $var OR M.K519   $var OR M.K760    $var

OR M.K761    $var OR M.K777    $var OR M.K799   $var

OR P.K900 $var OR P.K910 $var OR P.K911 $var OR P2.K900 $var OR P2.K910 $var OR P2.K911 $var

OR I.K800  $var OR  I.K810  $var OR I.K811  $var OR I.K812

OR P3.K900 $var OR P3.K910 $var OR P3.K911 $var ";

$query_join[0][3] ="LEFT JOIN  k200_p H_k200  ON H_k200.id = M .K0i1
                    LEFT JOIN  person P ON H_k200.id_p = P.K0i1
                    LEFT JOIN  k204_p H_k204  ON H_k204.id = M .K0i1
                    LEFT JOIN  person P2 ON H_k204.id_p = P2.K0i1
                    LEFT JOIN  institution I ON M.k240 = I.K0i1
                    LEFT JOIN  k087_p H_k087  ON H_k087.id =M .K0i1
                    LEFT JOIN  person P3 ON H_k087.id_p = P3.K0i1";


$query_con[1][$i] ="U.K060 $var OR U.K086 $var OR U.K087 $var OR U.K200 $var OR U.K204 $var OR U.K240 $var OR U.K320 $var OR U.K335 $var OR U.K403 $var OR U.K433 $var OR U.K410 $var OR U.K412 $var OR U.K425 $var OR U.K440 $var OR   U.K448 $var  OR U.K761 $var OR U.K777 $var OR U.K799 $var
                    OR P.K900 $var OR P.K910 $var OR P.K911 $var OR P2.K900 $var OR P2.K910 $var OR P2.K911 $var
                    OR I.K800  $var OR  I.K810  $var OR I.K811  $var OR I.K812
                   OR P3.K900 $var OR P3.K910 $var OR P3.K911 $var OR F.K632 $var
                    OR F.K060 $var OR F.K086 $var OR F.K204 $var OR F.K240 $var OR F.K310 $var OR F.K320 $var OR F.K330 $var OR F.K335 $var OR F.K340 $var OR F.K350 $var OR F.K410 $var OR F.K412 $var OR F.K426 $var OR F.K427 $var OR F.K610 $var OR F.K620 $var OR F.K630 $var OR F.K631 $var OR F.K632 $var OR F.K635 $var OR F.K636 $var OR F.K637 $var OR F.K640 $var OR F.K760 $var OR F.K761 $var OR F.K778 $var OR F.K799 $var OR F.K910 $var
                    OR dz.K521a $var OR dz.K521b $var OR dz.K521c $var OR dz.K521d $var OR dz.zeort $var
";

$query_join[1][5] ="LEFT JOIN  k200_p H_k200  ON H_k200.id = U.K0i1
                    LEFT JOIN  person P ON H_k200.id_p = P.K0i1
                    LEFT JOIN  k204_p H_k204  ON H_k204.id = U.K0i1
                    LEFT JOIN  person P2 ON H_k204.id_p = P2.K0i1
                    LEFT JOIN  institution I ON U.k240 = I .K0i1
                    LEFT JOIN  k087_p H_k087  ON H_k087.id =U.K0i1
                    LEFT JOIN  person P3 ON H_k087.id_p = P3.K0i1
                    LEFT JOIN  k441_z dz ON dz.id  = U.K0i1
                    LEFT JOIN  periodica F ON dz.id_z = F.K0i1


                    ";







$query_con[2][$i] ="F.K060 $var OR F.K086 $var OR F.K204 $var OR F.K240 $var OR F.K310 $var OR F.K320 $var OR F.K330 $var OR F.K335 $var OR F.K340 $var OR F.K350 $var OR F.K410 $var OR F.K412 $var OR F.K426 $var OR F.K427 $var OR F.K610 $var OR F.K620 $var OR F.K630 $var OR F.K631 $var OR F.K632 $var OR F.K635 $var OR F.K636 $var OR F.K637 $var OR F.K640 $var OR F.K760 $var OR F.K761 $var OR F.K778 $var OR F.K799 $var OR F.K910 $var
                    OR I.K800 $var OR I.K810 $var OR I.K811 $var OR I.K812 $var  OR I2.K800 $var OR I2.K810 $var OR I2.K811 $var OR I2.K812 $var

";


$query_join[2][2] ="LEFT JOIN  institution I ON F.K240= I .K0i1
                    LEFT JOIN  institution I2 ON F.K630= I2 .K0i1";










break;



case 4: //person

$query_con[0][$i]="P.K900 $var OR P.K910 $var OR P.K911 $var OR P2.K900 $var OR P2.K910 $var OR P2.K911 $var OR H_k200.id_p $var OR H_k204.id_p $var  ";


$query_con[1][$i]=" P.K900 $var OR P.K910 $var OR P.K911 $var OR P2.K900 $var OR P2.K910 $var OR P2.K911 $var  OR H_k200.id_p $var OR H_k204.id_p $var ";


$query_con[2][$i]="F.K240 $var OR I.K800 $var OR I.K810 $var OR I.K811 $var OR I.K812 $var  OR F.K630 $var OR I2.K800 $var OR I2.K810 $var OR I2.K811 $var";


$query_join[0][0] ="LEFT JOIN  k200_p H_k200  ON H_k200.id = M .K0i1
                    LEFT JOIN  person P ON H_k200.id_p = P.K0i1
                    LEFT JOIN  k204_p H_k204  ON H_k204.id = M .K0i1
                    LEFT JOIN  person P2 ON H_k204.id_p = P2.K0i1";

$query_join[1][0] ="LEFT JOIN  k200_p H_k200  ON H_k200.id = U .K0i1
                    LEFT JOIN  person P ON H_k200.id_p = P.K0i1
                    LEFT JOIN  k204_p H_k204  ON H_k204.id = U .K0i1
                    LEFT JOIN  person P2 ON H_k204.id_p = P2.K0i1";




$query_join[2][0] =" LEFT JOIN  institution I ON F.K240= I .K0i1
                     LEFT JOIN  institution I2 ON F.K630= I2 .K0i1
                     ";





break;


case 2: //titel
$query_con[0][$i] = "M.K320  $var OR M.K335  $var";
$query_con[1][$i] = "U.K320  $var OR U.K335  $var";
$query_con[2][$i] = "F.K310  $var OR F.K320  $var  OR F.K610  $var OR F.K620  $var OR F.K635 $var OR F.K640 $var";
break;




case 5://k�rperschaft
$query_con[0][$i] = "I.K800  $var OR  I.K810  $var OR I.K811  $var OR I.K812  $var OR M.K240  $var";
$query_con[1][$i] = "I.K800  $var OR  I.K810  $var OR I.K811  $var OR I.K812  $var OR U.K240  $var";
$query_con[2][$i]="  F.K240 $var OR I.K800 $var OR I.K810 $var OR I.K811 $var OR I.K812 $var  OR F.K630 $var OR I2.K800 $var OR I2.K810 $var OR I2.K811 $var";


$query_join[0][1] ="LEFT JOIN  institution I ON M.k240 = I .K0i1";

$query_join[1][1] ="LEFT JOIN  institution I ON U.k240  = I .K0i1";

$query_join[2][0] =" LEFT JOIN  institution I ON F.K240= I .K0i1
                     LEFT JOIN  institution I2 ON F.K630= I2 .K0i1
                     ";


break;

case 6://ort
$query_con[0][$i] = "M.K410 $var ";
$query_con[1][$i] = "U.K410 $var OR dz.zeort $var";
$query_con[2][$i] = "F.K631 $var OR F.K410 $var";

break;


case 7://verlag/zeitschirft
$query_con[0][$i] = "M.K412 $var ";
$query_con[1][$i] = "U.K412 $var OR F.K632 $var  ";
$query_con[2][$i] = "F.K412 $var OR F.K632 $var ";

$query_join[1][4] ="
LEFT JOIN  k441_z dz ON dz.id  = U.K0i1
LEFT JOIN  periodica F ON dz.id_z = F.K0i1
                  ";





break;

case 3://schlagwort
$query_con[0][$i] = "P3.K900 $var OR P3.K910 $var OR P3.K911 $var OR H_k087.id_p $var";
$query_con[1][$i] = "P3.K900 $var OR P3.K910 $var OR P3.K911 $var OR H_k087.id_p $var";

$query_join[0][2] ="LEFT JOIN  k087_p H_k087  ON H_k087.id =M .K0i1
                    LEFT JOIN  person P3 ON H_k087.id_p = P3.K0i1";

$query_join[1][2] ="LEFT JOIN  k087_p H_k087  ON H_k087.id =U .K0i1
                    LEFT JOIN  person P3 ON H_k087.id_p = P3.K0i1";
break;






case 9:
switch ($operator)
{
case 0: $operator2 = "<";   break;
case 1: $operator2 = ">";   break;
case 2: $operator2 = "<=" ; break;
case 3: $operator2 = ">=";  break;
case 4: $operator2 = "=" ;  break;
}
$var=$suchwort[$i2];
$query_con[0][3] = "M.K425 $operator2 $var ";
$query_con[1][3] = "dz.K521b $operator2 $var OR U.K425 $operator2 $var  ";
$query_con[2][3] = "F.K636 $operator2 $var ";
$query_join[1][3]=" LEFT JOIN  k441_z dz ON dz.id  = U.K0i1";
break;



}
}






//connector setzen

$klammer_offen=array(FALSE,FALSE,FALSE);
$last="";

//$i=0;
for($i=0;$i<4;$i++)
{
//$i2=0;
for($i2=0;$i2<4;$i2++)
{

if (!empty($query_con[$i][$i2]))
{

if($connector[$i2] == 0 )
{

$query[$i]=$query[$i].$query_con[$i][$i2].") AND (";
$klammer_offen[$i]=TRUE;
$last =$connector[$i2];


}

if($connector[$i2] == 1 )
{
$query[$i]=$query[$i].$query_con[$i][$i2]."  OR  ";

$last =$connector[$i2];
}

if($connector[$i2] == 2 )
{
$query[$i]=$query[$i].$query_con[$i][$i2].")AND NOT (";
$klammer_offen[$i]=TRUE;
$last =$connector[$i2];
}
}
}// for 2



if($klammer_offen[$i])
{
if ($last == 0)$query[$i]="(".$query[$i]." 1)";
else  $query[$i]="(".$query[$i]." 0)";
}
else
{
$query[$i]="".$query[$i]." 0";
}

$last="";
}// for 1


if ($sort == 1)

{
$query_temp_z=",titel char (5)";
$row[0]=",LEFT(M.K320,5) ";
$row[1]=",LEFT(U.K320,5) ";
$row[2]=",LEFT(IFNULL(F.K320,IFNULL(F.K640,F.K620)),5) ";
}



//query

$query_temp="Create Temporary TABLE Temp (
	id  char (30) NOT NULL ,
	sart char (1) NOT NULL
	$query_temp_z,

	 PRIMARY KEY  (id)
	) Engine = MYISAM;";
$result= mysql_query($query_temp);
unset($query_temp);




$table[0]="monographie M";
$table[1]="unselbststaendig U";
$table[2]="periodica F";



$row[0]="M.K0i1,M.K003 $row[0]";
$row[1]="U.K0i1,U.K003 $row[1]";
$row[2]="F.K0i1,F.K003 $row[2]";

//per



if (!empty ($query_join[0][3])){
$query_join[0][0]="";
$query_join[0][1]="";
$query_join[0][2]="";

}



if($filter[0])
{
$query_0="SELECT $row[0] FROM $table[0]
{$query_join[0][0]}
{$query_join[0][1]}
{$query_join[0][2]}
{$query_join[0][3]}


where $query[0] AND M.K003 = 'm'  GROUP BY K0i1";

$result= mysql_query("INSERT INTO Temp $query_0");
}



if (!empty ($query_join[1][5])){
$query_join[1][0]="";
$query_join[1][1]="";
$query_join[1][2]="";

$query_join[1][4]="";
}

if($filter[1])
{
$query_1="Select $row[1] FROM $table[1]
{$query_join[1][0]}
{$query_join[1][1]}
{$query_join[1][2]}
{$query_join[1][3]}
{$query_join[1][4]}
{$query_join[1][5]}


where $query[1] GROUP BY K0i1";

$result= mysql_query("INSERT INTO Temp $query_1");





}

if (!empty ($query_join[2][2])){
$query_join[2][0]="";
$query_join[2][1]="";

}


if($filter[2])
{
$query_2="Select $row[2] FROM $table[2]
{$query_join[2][0]}
{$query_join[2][1]}
{$query_join[2][2]}

where $query[2] GROUP BY K0i1";

$result= mysql_query("INSERT INTO Temp $query_2");
}


if (!empty ($query_join[0][3])){
$query_join[0][0]="";
$query_join[0][1]="";
$query_join[0][2]="";

}



if($filter[4])
{
$query_4="SELECT $row[0] FROM $table[0]
{$query_join[0][0]}
{$query_join[0][1]}
{$query_join[0][2]}
{$query_join[0][3]}


where $query[0] AND M.K003 = 'b'  GROUP BY K0i1";

$result= mysql_query("INSERT INTO Temp $query_4");
}





if(empty($page)){$offset=0;  $page=1;}
else $offset =($page-1) *10;

if ($sort == 0)$order="sart";
else if ($sort == 1)$order="titel";





$result_temp= mysql_query("SELECT id,sart FROM Temp  ORDER BY $order LIMIT $offset,10");



$result_count= mysql_query("SELECT id FROM Temp GROUP BY 1 ");
$count[0]= mysql_num_rows($result_count);




if($offset+10 > $count[0])$upto=$count[0];
else  $upto = $offset+10;

if(empty($suchwort[0]))die ("<p>Bitte geben sie einen Suchbegriff ein</p>");

else
{
print"<TABLE width =\"100%\" cellpadding=\"0\" cellspacing=\"10\" border=\"0\"><tr><td><table width = \"100%\" border = \"0\"><tr><td>Es sind <strong>$count[0]</strong> Treffer <br> Dies sind die Treffer <strong>".(1+$offset)."</strong> - <strong>".($upto)."</strong><br>
Seite <strong>$page</strong> von <strong>".ceil($count[0]/10)."</strong></td></tr></table></td></tr><tr><td>" ;

}



$i=0;



foreach ($suchindex as $row)
{

switch ($row)
{
case 1:$var="(Alle W&ouml;rter)";          break;
case 2:$var="(Titel)";          break;
case 3:$var="(Schlagw&ouml;rter)";   break;
case 4:$var="(Person, Autor)";  break;
case 5:$var="(K&ouml;rperschaft )";  break;
case 6:$var="(Ort)";            break;
case 7:$var="(Verlag)";         break;
case 8:$var="(Systematik)";     break;
case 9:$var="(Erscheinungsjahr)&nbsp;$operator2";break;
}
if($i == 0)print"<table><tr><td><strong>Ihre Aktion:&nbsp;</strong></td><td>";
else print"<tr><td &nbsp;</td><td>";
if($i == 0)print"suchen&nbsp;";
else if($connector[$i-1]== 1)print"erweitern&nbsp;";
else print"einschr&auml;nken&nbsp;";

print"$var&nbsp;".htmlspecialchars(stripslashes($suchwort[$i]))."</td></tr>";
$i++;
}




print"</table></td></tr><tr><td colspan = \"0\" >";
if(($count[0] == 0)&&(!empty($suchwort[0])))die("Ihre Suche lieferte keine Ergebnisse</td></tr></table>");

else print"<TABLE cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";






$query_join[0][0] ="LEFT JOIN  k200_p H_k200  ON H_k200.id = M .K0i1
                    LEFT JOIN  person P ON H_k200.id_p = P.K0i1";

$query_join[1][0] ="LEFT JOIN  k200_p H_k200  ON H_k200.id = U .K0i1
                    LEFT JOIN  person P ON H_k200.id_p = P .K0i1

                    LEFT JOIN  k441_z dz ON dz.id = U .K0i1
                    LEFT JOIN  periodica F On dz.id_z = F .K0i1";




$query_join[2][0] ="LEFT JOIN  institution I ON F.K240= I.K0i1
                    LEFT JOIN  institution I2 ON F.K630= I2.K0i1" ;





$i=$offset;
while ($row_temp=mysql_fetch_row($result_temp))
{
$i++;


if($row_temp[1] == "m")$path="image/icon_books.gif";
else if($row_temp[1] == "u")$path="image/icon_art_va.gif";
else if(($row_temp[1] == "z")||($row_temp[1] == "f"))$path="image/icon_per_va.gif";
else if($row_temp[1] == "b")$path="image/icon_pictures_va.gif";


print"<TR valign=top>
<td width=35 align=right>
<img src=\"$path\" alt=\"\" border=0 hspace=3 vspace=2 width=20 height=20 align=absmiddle></td>


<TD align=right>$i.&nbsp;</TD>";

if($i%2 == 0)print"<TD class=\"box0\">";
else print"<TD class=\"box1\">";



if($row_temp[1] == "m")
{
$row="M.K0i1,M.K003,M.K320,M.K335,M.K410,M.K412,M.K425,IFNULL(P.K900,H_k200.id_p)";
$query="SELECT $row FROM $table[0] {$query_join[0][0]} where M.K0i1 = '$row_temp[0]' ";
$result= mysql_query($query);

$row=mysql_fetch_row($result);
$url="$row[0]&sart=$row[1]&filter0=$filter[0]&filter1=$filter[1]&filter2=$filter[2]&filter3=$filter[3]&filter4=$filter[4]&sort=$sort";

if(!empty($row[2])){print "<a href='ausgabe2.php?id=$url' target=\"_blank\" >".htmlspecialchars($row[2]); if(!empty($row[3]))print"&nbsp;:&nbsp;".htmlspecialchars($row[3]); print"</a><br>"; }

if(!empty($row[7])){print "/&nbsp;".htmlspecialchars($row[7]).".";}

if(!empty($row[4])){if(!empty($row[7]))print "&nbsp;-&nbsp;"; print htmlspecialchars($row[4]);}

if(!empty($row[5])){if (!empty($row[4]))print "&nbsp;:&nbsp;";else if(!empty($row[7]))print "&nbsp;-&nbsp;"; print htmlspecialchars($row[5]);}

if(!empty($row[6])){if(!empty($row[5]))print ",&nbsp;"; else if(!empty($row[4]))print "&nbsp;:&nbsp;"; else if (!empty($row[7])) print"&nbsp;-&nbsp;"; print htmlspecialchars($row[6]); }
}



else if($row_temp[1] == "u")/////////////unselbstst�ndig/////////////////////
{

$row="U.K0i1,U.K003,U.K320,U.K335,IFNULL(IFNULL(F.K640,F.K620),dz.id_z) as ztitel,dz.K521b as dzjahr,dz.K521d as seite,dz.K521a as band,dz.K521c as heftnr,IFNULL(P.K900,H_k200.id_p) as person,U.K410 as eort,U.K412 as verlag, U.K425 as ejahr,dz.zeort as zeort,F.K632 as verlag_z";
$query="SELECT $row FROM $table[1] {$query_join[1][0]} where U.K0i1 = '$row_temp[0]' ";
$result= mysql_query($query);
$row=mysql_fetch_array($result);
$url="$row[0]&sart=$row[1]&filter0=$filter[0]&filter1=$filter[1]&filter2=$filter[2]&filter3=$filter[3]&filter4=$filter[4]&sort=$sort";

if(!empty($row[K320])){print "<a href='ausgabe2.php?id=$url' target=\"_blank\"  >".htmlspecialchars($row[K320]);if(!empty($row[K335]))print"&nbsp;:&nbsp;".htmlspecialchars($row[K335]); print"</a><br>"; }

if(!empty($row[person])){print "/&nbsp;".htmlspecialchars($row[person]).".";}


if (!empty ($row[ztitel]))
{
if(!empty($row[ztitel])){if(!empty($row[person]))print "&nbsp;-&nbsp;"; print "In:&nbsp;".htmlspecialchars($row[ztitel]);}

if(!empty($row[zeort])){if(!empty($row[ztitel])) print"&nbsp;-&nbsp;"; print htmlspecialchars($row[zeort]);}

if(!empty($row[verlag_z])){if(!empty($row[zeort]))print "&nbsp;:&nbsp;";else if((!empty($row[ztitel])))print"&nbsp;-&nbsp;"; print htmlspecialchars($row[verlag_z]);}

if(!empty($row[band]))    print ",&nbsp;".htmlspecialchars($row[band]);

if(!empty($row[dzjahr])){if (!empty($row[band]))print "&nbsp;"; else print",&nbsp;"; print "(".htmlspecialchars($row[dzjahr]).")";}

if(!empty($row[heftnr])){print ",&nbsp;".htmlspecialchars($row[heftnr]); }

if(!empty($row[seite])){ print ",&nbsp;".htmlspecialchars($row[seite]); }





}
else
{

if(!empty($row[eort])){if(!empty($row[person]))print "&nbsp;-&nbsp;"; print htmlspecialchars($row[eort]);}

if(!empty($row[verlag])){if (!empty($row[eort]))print "&nbsp;:&nbsp;";else if(!empty($row[person]))print "&nbsp;-&nbsp;"; print htmlspecialchars($row[verlag]);}

if(!empty($row[ejahr])){if(!empty($row[eort]))print ",&nbsp;"; else if(!empty($row[verlag]))print "&nbsp;:&nbsp;"; else if (!empty($row[person])) print"&nbsp;-&nbsp;"; print htmlspecialchars($row[ejahr]); }

}
}

else if ($row_temp[1] == "z") /////////////periodica/////////////////////
{

$row="F.K0i1,F.K003,IFNULL(F.K640,F.K620),F.K635,F.K631,F.K632,F.K636,F.K637 as djahr,IFNULL(I2.K800,F.K630) as verfasser";
$query="SELECT $row FROM $table[2] {$query_join[2][0]} where F.K0i1 = '$row_temp[0]' ";
$result= mysql_query($query);
$row=mysql_fetch_row($result);
$url="$row[0]&sart=$row[1]&filter0=$filter[0]&filter1=$filter[1]&filter2=$filter[2]&filter3=$filter[3]&filter4=$filter[4]&sort=$sort";

if(!empty($row[2])){print "<a href='ausgabe2.php?id=$url' target=\"_blank\"   >".htmlspecialchars($row[2]);if(!empty($row[3]))print"&nbsp;:&nbsp;".htmlspecialchars($row[3]); print"</a><br>"; }

if(!empty($row[8])){print "/&nbsp;".htmlspecialchars($row[8]).".";}

if(!empty($row[4])){if(!empty($row[8]))print "&nbsp;-&nbsp;"; print htmlspecialchars($row[4]);}

if(!empty($row[5])){if((!empty($row[8]))||(!empty($row[4])))print "&nbsp;:&nbsp;"; print htmlspecialchars($row[5]);}

if(!empty($row[6])){if(!empty($row[5]))print ",&nbsp;"; else if(!empty($row[4]))print "&nbsp;:&nbsp;"; else if (!empty($row[8])) print"&nbsp;-&nbsp;"; print htmlspecialchars($row[6]); if(!empty($row[7])) print "&nbsp;-&nbsp;".htmlspecialchars($row[7]);}

}

else if ($row_temp[1] == "f")

{

$row="F.K0i1,F.K003,F.K320 as titel,F.K335 as ztitel,F.K410 as eort,F.K412 as verlag,F.K426 as gjahr,F.K427 as djahr,IFNULL(I.K800,F.K240) as verfasser";
$query="SELECT $row FROM $table[2] {$query_join[2][0]} where F.K0i1 = '$row_temp[0]' ";
$result= mysql_query($query);
$row=mysql_fetch_array($result);
$url="$row[0]&sart=$row[1]&filter0=$filter[0]&filter1=$filter[1]&filter2=$filter[2]&filter3=$filter[3]&filter4=$filter[4]&sort=$sort";

if(!empty($row[titel])){print "<a href='ausgabe2.php?id=$url' target=\"_blank\"   >".htmlspecialchars($row[titel]);if(!empty($row[ztitel]))print"&nbsp;:&nbsp;".htmlspecialchars($row[ztitel]); print"</a><br>"; }

if(!empty($row[verfasser])){print "/&nbsp;".htmlspecialchars($row[verfasser]).".";}

if(!empty($row[eort])){if(!empty($row[verfasser]))print "&nbsp;-&nbsp;"; print htmlspecialchars($row[eort]);}

if(!empty($row[verlag])){if((!empty($row[verfasser]))||(!empty($row[eort])))print "&nbsp;:&nbsp;"; print htmlspecialchars($row[verlag]);}

if(!empty($row[gjahr])){if(!empty($row[verlag]))print ",&nbsp;"; else if(!empty($row[eort]))print "&nbsp;:&nbsp;"; else if (!empty($row[8])) print"&nbsp;-&nbsp;"; print htmlspecialchars($row[gjahr]); if(!empty($row[djahr])) print "&nbsp;-&nbsp;".htmlspecialchars($row[djahr]);}


}


else if ($row_temp[1] == "b")
{
$row="M.K0i1,M.K003,M.K320,M.K335,M.K410,M.K412,M.K425,IFNULL(P.K900,H_k200.id_p)";
$query="SELECT $row FROM $table[0] {$query_join[0][0]} where M.K0i1 = '$row_temp[0]' ";
$result= mysql_query($query);
$row=mysql_fetch_row($result);
$url="$row[0]&sart=$row[1]&filter0=$filter[0]&filter1=$filter[1]&filter2=$filter[2]&filter3=$filter[3]&filter4=$filter[4]&sort=$sort";

if(!empty($row[2])){print "<a href='ausgabe2.php?id=$url' target=\"_blank\"  >".htmlspecialchars($row[2]);if(!empty($row[3]))print"&nbsp;:&nbsp;".htmlspecialchars($row[3]); print"</a><br>"; }

if(!empty($row[7])){print "/&nbsp;".htmlspecialchars($row[7]).".";}

if(!empty($row[4])){if(!empty($row[7]))print "&nbsp;-&nbsp;"; print htmlspecialchars($row[4]);}

if(!empty($row[5])){if (!empty($row[4]))print "&nbsp;:&nbsp;";else if(!empty($row[7]))print "&nbsp;-&nbsp;"; print htmlspecialchars($row[5]);}

if(!empty($row[6])){if(!empty($row[5]))print ",&nbsp;"; else if(!empty($row[4]))print "&nbsp;:&nbsp;"; else if (!empty($row[7])) print"&nbsp;-&nbsp;"; print htmlspecialchars($row[6]); }

}

print"</td</tr>";

}
print"</table></tr></td><tr><td><table width = \"100%\">"

?>


<form action ="ausgabe.php"  name="Formular2" onsubmit="return check_input () ">


<input name="suchindex0" type="hidden"  value ="<?php print $suchindex[0] ?>" >
<input name="suchwort0" type="hidden"  value ="<?php print stripslashes($suchwort[0]) ?>" >
<input name="suchindex1" type="hidden"  value ="<?php print $suchindex[1] ?>" >
<input name="suchwort1" type="hidden"  value ="<?php print stripslashes($suchwort[1]) ?>" >
<input name="suchindex2" type="hidden"  value ="<?php print $suchindex[2] ?>" >
<input name="suchwort2" type="hidden"  value ="<?php print stripslashes($suchwort[2]) ?>" >
<input name="suchwort3" type="hidden"  value ="<?php print stripslashes($suchwort[3]) ?>" >

<input name="connector0" type="hidden"  value ="<?php print $connector[0] ?>" >
<input name="connector1" type="hidden"  value ="<?php print $connector[1] ?>" >
<input name="connector2" type="hidden"  value ="<?php print $connector[2] ?>" >

<input name="trunk0" type="hidden"  value ="<?php print $trunk[0] ?>" >
<input name="trunk1" type="hidden"  value ="<?php print $trunk[1] ?>" >
<input name="trunk2" type="hidden"  value ="<?php print $trunk[2] ?>" >

<input name="filter0" type="hidden"  value ="<?php print $filter[0] ?>" >
<input name="filter1" type="hidden"  value ="<?php print $filter[1] ?>" >
<input name="filter2" type="hidden"  value ="<?php print $filter[2] ?>" >
<input name="filter3" type="hidden"  value ="<?php print $filter[3] ?>" >
<input name="filter4" type="hidden"  value ="<?php print $filter[4] ?>" >



<input name="operator" type="hidden"  value ="<?php print $operator ?>" >
<input name="sort" type="hidden"  value ="<?php print $sort ?>" >



<TR><TD>
<input type = "submit" value="gehe zu Seite" >
<input name="page" type="text"   value ="<?php print $page ?>" size="1" maxlength="">
</TD><TD align ="middle">
</form>
<?php








if($offset != 0)print"<a href='ausgabe.php?page=".($page-1)."&smod=$smod&$url_2'>[zur�ck]</a>";
if($offset+10 < $count[0])print"<a href='ausgabe.php?page=".($page+1)."&smod=$smod&$url_2'>[vorw�rts]</a>";
print"</TD></TR></table></td></tr></table>";

mysql_close($db);
?>



<script type="text/javascript">

 function check_input ()
{



for (var i = 0; i < document.Formular2.page.value.length; i++)
{


if (document.Formular2.page.value.charAt(i) < "0" ||
        document.Formular2.page.value.charAt(i) > "9" ||  document.Formular2.page.value > <?php  print ceil($count[0]/10); ?> )
    {
     alert("Dies ist kein g�ltiger Wert");
    document.Formular2.page.focus();
    return false;
    }

}
}
</script>

</body>
</html>
