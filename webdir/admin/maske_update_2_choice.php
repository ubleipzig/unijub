<HTML>
<HEAD>
<link rel="stylesheet" type="text/css" href="stylesheets.css">
<TITLE>Leipzig - Bibliographie</TITLE> 
</HEAD>

<body>

<p>Bitte wählen sie eine Werkart:</p> 
<form action ="maske_update_2.php"  name="Formular" onsubmit="">

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



<input type = "submit" value="Go" ></form>


</body>
</html>