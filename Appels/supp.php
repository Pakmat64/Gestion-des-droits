<?php

  if(isset($_POST['id'])){
    $codeAgent = $_POST['id'];
    $nom = $_POST['nom'];



$commande = "powershell -ExecutionPolicy unrestricted -command ../Scripts/Supp.ps1 -personne ".$codeAgent;

Shell_Exec($commande);


  }
