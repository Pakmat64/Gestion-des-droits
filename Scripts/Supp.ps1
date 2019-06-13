Param(

[parameter(Mandatory=$true)][string]$personne,
[parameter(Mandatory=$true)][string]$repertoire
)

if (Get-Module -ListAvailable -Name ActiveDirectory) {

}
else{
   import-module ActiveDirectory
}

 Remove-ADGroupMember -Identity $repertoire -Members $personne -Confirm:$false
