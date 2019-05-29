Param(
[parameter(Mandatory=$true)][string]$repertoire
)

$membres = Get-QADGroupMember $repertoire |select Name, objectClass, Description


$liste = @()

foreach($membre in $membres){
    
    if($membre.objectClass -eq "user"){
        $description = $membre.description
        $nom = $membre.Name
        
        if([string]::IsNullOrEmpty($description)){
            $description = 'sans'
        }
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