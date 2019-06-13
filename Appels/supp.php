<?php

  if(isset($_POST['id'])){
    $codeAgent = $_POST['id'];
    $repertoire = $_POST['groupe'];

    Shell_Exec( "powershell -ExecutionPolicy unrestricted -command ../Scripts/Supp.ps1 -personne ".$codeAgent.' '.$repertoire);
  }
