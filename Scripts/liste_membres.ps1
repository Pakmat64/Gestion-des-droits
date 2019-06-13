Param(
[parameter(Mandatory=$true)][string]$groupe
)

if (Get-Module -ListAvailable -Name ActiveDirectory) {

}
else{
   import-module ActiveDirectory
}

$membres = Get-QADGroupMember $groupe |select Name, objectClass, Description

$liste = @()

foreach($membre in $membres){

    if($membre.objectClass -eq "user"){
        $description = $membre.description
        $nom = $membre.Name

        $liste += @($membre.Name;':';$description)

             $liste += ','

    }

    if($membre.objectClass -eq "group"){

        $description = '( Groupe )'

        $nom = $membre.Name.replace('ggss','')

        $liste += @($description;':';$nom)

             $liste += ','

    }
}

    return $liste
