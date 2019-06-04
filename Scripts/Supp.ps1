Param(

[parameter(Mandatory=$true)][string]$personne,
[parameter(Mandatory=$true)][string]$repertoire
)

 Remove-ADGroupMember -Identity $repertoire -Members $personne -Confirm:$false

