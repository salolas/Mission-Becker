<?php
function password_encrypt($password){
	//Verschlueselung: SHA-256
	//bei SHA-512: crypt($string, '$6$rounds=5000$usesomesillystringforsalt$')
	return	crypt($string, '$5$rounds=5000$a4f7htz30dnmtiH687LR15d)$');
}
function password_equals($userinput, $encrypted){
	return (crypt($userinput, $encrypted) == $userinput);
}
?>