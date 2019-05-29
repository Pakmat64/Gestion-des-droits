#Param(
#[parameter(Mandatory=$true)][string]$chemin
#)

#Install-Module NTFSSecurity


$personnes = Get-NTFSAccess –Path C:\Users\pako.mathieu\Documents\test 

#Get-acl -path "C:\Users\pako.mathieu\Documents\test" | fl


$Users = $personnes.Account.AccountName | Where-Object { $_ -ne "AUTORITE NT\Système"} |Where-Object { $_ -ne "BUILTIN\Administrateurs"}

$liste = @()




for($i=0; $i -le $Users.Length-1 ; $i++){

    
    $CN = $Users[$i].Split('\')[1]
     
    $user = Get-aduser –identity $CN -Properties Description 

    
    $description = $user.Description

    if([string]::IsNullOrEmpty($description)){
        $description = 'sans'
    }
  
    $liste +=  @($CN;':';$description)

    if($i -lt $Users.Length-1){
        $liste += ','
    }
    
   
  
}
return $liste
 
