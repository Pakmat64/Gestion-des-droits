Param(
[parameter(Mandatory=$true)][string]$personne
)

if (Get-Module -ListAvailable -Name ActiveDirectory) {

}
else{
   import-module ActiveDirectory
}

$DN = (Get-QADUser -Identity "$personne" | select DN).DN

$resultats = Get-ADGroup -Filter * -SearchBase "OU=ACCES DOSSIERS,OU=GROUPES,DC=chcb,DC=local" -Properties name,managedby | select name,managedby

$liste =@()

foreach ($repertoire in $resultats){
    if($repertoire.managedby -eq $DN){
            $groupe = $repertoire.name.replace('ggss','')
            $liste += $groupe
            $liste += ','
    }
}

return $liste
