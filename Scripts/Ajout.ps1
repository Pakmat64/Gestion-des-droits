Param(
[parameter(Mandatory=$true)][string]$personne,
[parameter(Mandatory=$true)][string]$repertoire
)

Add-ADGroupMember -Identity $repertoire -Members $personne

