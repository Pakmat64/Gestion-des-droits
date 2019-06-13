Param(
[parameter(Mandatory=$true)][string]$codeAgent,
[parameter(Mandatory=$true)][string]$groupe
)

if (Get-Module -ListAvailable -Name ActiveDirectory) {
   
}
else{
   import-module ActiveDirectory 
}

Add-ADGroupMember -Identity $groupe -Members $codeAgent
