Param(
[parameter(Mandatory=$true)][string]$personne
)


#$acl = Get-Acl C:\Users\pako.mathieu\Documents\test 

#$usersid = New-Object System.Security.Principal.Ntaccount ("CHCB\$personne")


#Remove-NTFSAccess –Path "C:\Users\pako.mathieu\Documents\test " –Account "$personne@chcb.local" -AccessRights Modify

#$acl.PurgeAccessRules($usersid)


 Remove-ADGroupMember -Identity ggssDSIOTEST -Members $personne -Confirm:$false

