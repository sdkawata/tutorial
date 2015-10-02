<?php
class UserManager{
public function auth($mailaddress,$password){
if($password!=="passwd"){
return Ethna::raiseNotice("auth fail",E_SAMPLE_AUTH);
}
// auth sucess
return null;
}
}