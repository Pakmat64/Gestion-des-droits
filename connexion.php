<?php
/*
Page: connexion.php
*/

/* Connexion LDAP */

    if(empty($_POST['login'])) {
        echo "Le champ Pseudo est vide.";
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
        if(empty($_POST['mdp'])) {
            echo "Le champ Mot de passe est vide.";
        }
        else {
          $codeAgent= trim($_POST['login']);
          $serveur = "172.17.0.201"; //Adresse du serveur Active Directory : chcb.local
          $racine = "DC=chcb,DC=local"; //DN (nom distingué) de la racine de l'annuaire AD

          $DN = Shell_Exec('powershell -executionpolicy unrestricted -command ./Scripts/RecupDN.ps1 \"'.$codeAgent.'\"');// Identifiant de connexion à l'annuaire récupéré du formulaire de connexion

          $mdp = $_POST['mdp']; //Mot de passe de connexion à l'annuaire

          $ds=ldap_connect($serveur); //Connection au serveur AD

          $r=ldap_bind($ds,$DN,$mdp);//Authentification à l'annaire

          if($r && !empty($DN)){

          session_start();

          $_SESSION['codeAgent'] = $codeAgent;

          header('Location: ./listeRepertoires.php');

          }
          else {
            header('Location: ./index.php?erreur=erreur');
          }
        }
      }
?>
