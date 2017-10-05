<?php



?>

<table border = 0>

<form action ="ausgabe.php" method="GET" name="Formular" onsubmit="return chkFormular()">






<tr>    <td class="form" >
    	     <select class="form" name="suchindex0">
           <option value="1" <?php if($suchindex[0]==1)print"selected"; ?>>All</option>
           <option value="2" <?php if($suchindex[0]==2)print"selected"; ?>>Titel</option>
           <option value="3" <?php if($suchindex[0]==3)print"selected"; ?>>Schlagwörter</option>
           <option value="4" <?php if($suchindex[0]==4)print"selected"; ?>>Person, Autor</option>
           <option value="5" <?php if($suchindex[0]==5)print"selected"; ?>>Körperschaft</option>
           <option value="6" <?php if($suchindex[0]==6)print"selected"; ?>>Ort</option>
           <option value="7" <?php if($suchindex[0]==7)print"selected"; ?>>Verlag </option>

          </select>


<input name="suchwort0" type="text"   value ="<?php print htmlspecialchars(stripslashes($suchwort[0]), ENT_QUOTES);  ?>" size="30" maxlength="40">



<input type="checkbox" name="trunk0" value="1" <?php if(!empty($trunk[0]))print" CHECKED"; ?> > trunkiert
</td>


    </tr>




<tr>
<td>
<input type="checkbox" name="filter0" value="1" <?php if($filter[0]==1)print"CHECKED "; ?> onclick ="return check_filter(0)">Monographie
<input type="checkbox" name="filter1" value="1" <?php if($filter[1]==1)print"CHECKED "; ?> onclick ="return check_filter(1)">Aufsätze
<input type="checkbox" name="filter2" value="1" <?php if($filter[2]==1)print"CHECKED "; ?> onclick ="return check_filter(2)">Periodica
<input type="checkbox" name="filter4" value="1" <?php if($filter[4]==1)print"CHECKED "; ?> onclick ="return check_filter(4)">bildliche Darstellungen



<a  href="javascript:setFilter(1)" style="font-size:0.8em"  >[Alle Auswählen]</a>

</td>

</tr>




<tr><td><input type = "submit" value="Suchen" >   <input type="reset" value=" Abbrechen"> </td></tr>


<input name="smod" type="hidden"  value ="<?php print $smod ?>" >
<input name="sort" type="hidden"  value ="<?php print $sort ?>" >

</form>
</table>
<hr>

<script type="text/javascript">

function chkFormular ()
{
var chk = 0,chkZ=1;

  if (document.Formular.suchwort0.value != "") chk =1 ;





  if (chk == 0)
   {
    alert("Es muss mindestens eine Feld ausgefüllt sein!");
    document.Formular.suchwort0.focus();
    return false;
   }




 return true;

}


function setFilter (index)
{


var wert = true;



document.Formular.filter0.checked = wert;
document.Formular.filter1.checked = wert;
document.Formular.filter2.checked = wert;
document.Formular.filter4.checked = wert;

}

function check_filter(index)
{
var chk = 0;


if(index != 0) {if(document.Formular.filter0.checked != false)chk=1;}
if(index != 1) {if(document.Formular.filter1.checked != false)chk=1;}
if(index != 2) {if(document.Formular.filter2.checked != false)chk=1;}
if(index != 4) {if(document.Formular.filter4.checked != false)chk=1;}

if(chk == 0)
{
if(index == 0) document.Formular.filter0.checked = true;
if(index == 1) document.Formular.filter1.checked = true;
if(index == 2) document.Formular.filter2.checked = true;
if(index == 4) document.Formular.filter4.checked = true;
}



}
</script>


