


<table border =0 style="margin-left:3em">

<form action ="ausgabe.php" method="GET" name="Formular" onsubmit="return chkFormular()">






<?php


for ($i=0;$i<3;$i++)
{

?>

<tr>    <td class="form" nowrap>
    	     <select class="form" name="<?php print"suchindex".$i ?>">
           <option value="1" <?php if($suchindex[$i]==1)print"selected"; ?>>All</option>
           <option value="2" <?php if($suchindex[$i]==2)print"selected"; ?>>Titel</option>
           <option value="3" <?php if($suchindex[$i]==3)print"selected"; ?>>Schlagwörter</option>
           <option value="4" <?php if($suchindex[$i]==4)print"selected"; ?>>Person, Autor</option>
           <option value="5" <?php if($suchindex[$i]==5)print"selected"; ?>>Körperschaft</option>
           <option value="6" <?php if($suchindex[$i]==6)print"selected"; ?>>Ort</option>
           <option value="7" <?php if($suchindex[$i]==7)print"selected"; ?>>Verlag</option>
           </select>
</td>

<td class="form" >
<input name="<?php print"suchwort".$i ?>" type="text"   value ="<?php if ($suchindex[$i] != 9) print htmlspecialchars(stripslashes($suchwort[$i]), ENT_QUOTES);  ?>" size="30" maxlength="40">
</td>



<td class="form" >




	<select class="form" name="<?php print "connector".$i ?>">
          <option value="0"  <?php if($connector[$i]==0)print"selected"; ?> >und </option>
          <option value="1"  <?php if($connector[$i]==1)print"selected"; ?> >oder</option>
          <option value="2"  <?php if($connector[$i]==2)print"selected"; ?>  > und nicht</option>
          </select>

    </td>




<td class="form" >
    <input type="checkbox" name="<?php print"trunk".$i ?>" value="1" <?php if(!empty($trunk[$i]))print" CHECKED"; ?> > trunkiert
 </td>


    </tr>





<?php	 } ?>




	<tr>

<td>Erscheinungsjahr</td>
<td colspan= 3>
<select class="form" name="operator">
<option value="0" <?php if($operator==0)print"selected"; ?> ><   </option>
<option value="1" <?php if($operator==1)print"selected"; ?> >>  </option>
<option value="2" <?php if($operator==2)print"selected"; ?> ><=  </option>
<option value="3" <?php if($operator==3)print"selected"; ?> >>=  </option>
<option value="4" <?php if($operator==4)print"selected"; ?> >=  </option>

</select>


	<input name="suchwort3" type="text"   value ="<?php if ($suchindex[$i2] == 9)  print  htmlspecialchars(stripslashes($suchwort[$i2]), ENT_QUOTES);; ?>" size="30" maxlength="40">
         <input name="connector3" type="hidden"   value ="0" >
         <input name="suchindex3" type="hidden"   value ="9" >

         </td>
	</tr>



<tr><td colspan = 4><input type = "submit" value="Suchen" >
<input type="reset" value=" Abbrechen">

Ordnen nach:<select class="form" name="sort">
<option value="0" <?php if($sort==0)print"selected"; ?> >Werkart</option>
<option value="1" <?php if($sort==1)print"selected"; ?> >Titel</option>
</td></tr>


<tr><td colspan = 4>
<input type="checkbox" name="filter0" value="1" <?php if($filter[0]==1)print"CHECKED "; ?> onclick ="return check_filter(0)">Monographie
<input type="checkbox" name="filter1" value="1" <?php if($filter[1]==1)print"CHECKED "; ?> onclick ="return check_filter(1)">Aufs�tze
<input type="checkbox" name="filter2" value="1" <?php if($filter[2]==1)print"CHECKED "; ?> onclick ="return check_filter(2)">Periodica
<input type="checkbox" name="filter4" value="1" <?php if($filter[4]==1)print"CHECKED "; ?> onclick ="return check_filter(4)">bildliche Darstellungen

</td></tr>






<input name="smod" type="hidden"  value ="<?php print $smod ?>" >


</form>
</table>
<hr>

<script type="text/javascript">

function chkFormular ()
{
var chk = 0,chkZ=1;

  if (document.Formular.suchwort0.value != "") chk =1 ;
  if (document.Formular.suchwort1.value != "") chk =1 ;
  if (document.Formular.suchwort2.value != "") chk =1 ;
  if (document.Formular.suchwort3.value != "") chk =1 ;

  for (i = 0; i < document.Formular.suchwort3.value.length; i++)
    if (document.Formular.suchwort3.value.charAt(i) < "0" ||
        document.Formular.suchwort3.value.charAt(i) > "9" || document.Formular.suchwort3.value.length < 4)
      chkZ = 0;


  if (chk == 0)
   {
    alert("Es muss mindestens eine Feld ausgef�llt sein!");
    document.Formular.suchwort0.focus();
    return false;
   }


 if(chkZ == 0)
    {
    alert("Jahreszahl keine g�ltige Zahl!");
    document.Formular.suchwort3.focus();
    return false;
    }

 return true;

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

if(index == 4) document.Formular.filter4.checked = true;
}



}




function setFilter (index)
{


var wert = true;



document.Formular.filter0.checked = wert;
document.Formular.filter1.checked = wert;
document.Formular.filter2.checked = wert;

document.Formular.filter4.checked = wert;

}




</script>


