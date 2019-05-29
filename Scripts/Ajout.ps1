Param(
[parameter(Mandatory=$true)][string]$personne
)

Add-ADGroupMember -Identity ggssDSIOTEST -Members $personne

