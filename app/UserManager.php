<?php


class UserManager{
public function auth($backend,$mailaddr,$passwd){
$db=& $backend->getDB();
if(Ethna::isError($db)){
return $db;
}
$escaped=pg_escape_string($mailaddr);
$list=$db->query("SELECT * FROM usernames WHERE id='{$escaped}'");
if(Ethna::isError($list)){return $list;}
$item=$list->fetchRow();
if(!$item){
	return Ethna::raiseNotice("you name is not registered",E_SAMPLE_AUTH);
}
if($item['id']===$mailaddr && $item['passwd']===$passwd){
// auth success
return null;
}
	return Ethna::raiseNotice("you password is wrong",E_SAMPLE_AUTH);
}




public function signup($backend,$mailaddr,$passwd){
$db=& $backend->getDB();
if(Ethna::isError($db)){
return $db;
}
$escaped=pg_escape_string($mailaddr);
$list=$db->query("SELECT * FROM usernames WHERE id='{$escaped}'");
if(Ethna::isError($list)){return $list;}
$item=$list->fetchRow();
if($item){
	return Ethna::raiseNotice("the user name is already used",E_SAMPLE_AUTH);
}
$res=$db->autoExecute("usernames",array("id"=>$mailaddr,"passwd"=>$passwd),"INSERT");
if(Ethna::isError($res)){return $res;}
//return Ethna::raiseNotice("database error:"+$db->getMessage(),E_SAMPLE_AUTH);

return null;
}
public function userlist($backend){
$db=& $backend->getDB();
if(Ethna::isError($db)){return $db;}
$list=$db->query("select * from usernames");
if(Ethna::isError($list)){return $list;}
$res=array();
while($item=$list->fetchRow()){
$res[$item['id']]=array("id"=>$item['id'],"passwd"=>$item['passwd']);
}
return $res;
}
}