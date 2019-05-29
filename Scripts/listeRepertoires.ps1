Param(
[parameter(Mandatory=$true)][string]$personne
)

$resultats = Get-ADGroup -Filter * -SearchBase "OU=ACCES DOSSIERS,OU=GROUPES,DC=chcb,DC=local" 

$repertoires = $resultats.name

$liste =@()

#foreach ($repertoire in $repertoires){
 #  $repertoire = $repertoire.replace('ggss','') 
  # $repertoire = $repertoire.Trim()
   # $liste += $repertoire + ','   
#}

foreach ($repertoire in $repertoires){
  $Liste_membre_groupe = Get-ADGroupMember $repertoire
  foreach($membre in $Liste_membre_groupe){
    if($membre.objectClass -eq "user"){
        if($membre.name -eq $personne){
            $repertoire = $repertoire.replace('ggss','')
            $liste += $repertoire
            $liste += ','
        }
    }
    if($membre.objectClass -eq "group"){
       $Liste_utilisateurs_groupe = Get-ADGroupMember $Membre 
       foreach($utilisateur in $Liste_utilisateurs_groupe){
         if($utilisateur.name -eq $personne){
            $repertoire = $repertoire.replace('ggss','')
            $liste += $repertoire
            $liste += ','
         }
       }
    }
  }
    
}

$liste