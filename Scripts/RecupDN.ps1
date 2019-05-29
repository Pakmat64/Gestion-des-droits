Param(
[parameter(Mandatory=$true)][string]$personne
)
$DN = (Get-QADUser -Identity "$personne" | select DN).DN

return $DN