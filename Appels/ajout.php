<?php
 if(isset($_POST['codeAgent'])){
$codeAgent = $_POST['codeAgent'];

Shell_Exec ('powershell -executionpolicy unrestricted -command ../Scripts/Ajout.ps1 '.$codeAgent);
}
