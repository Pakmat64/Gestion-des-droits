<?php
 if(isset($_POST['codeAgent'])){
   $codeAgent = $_POST['codeAgent'];
   $repertoire = $_POST['rep'];

   $result = Shell_Exec ('powershell -executionpolicy unrestricted -command ../Scripts/Ajout.ps1 '.$codeAgent.' '.$repertoire);
}

?>
