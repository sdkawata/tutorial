<?php

class UserManager
{
    public function auth($backend, $mailaddr, $passwd)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query("SELECT * FROM userlist WHERE id=?", array($mailaddr));
        if (Ethna::isError($list)) {
            return $list;
        }
        $item=$list->fetchRow();
        if (!$item) {
            return Ethna::raiseNotice("you name is not registered", E_SAMPLE_AUTH);
        }
        if ($item['id']===$mailaddr && $item['passwd']===$passwd) {
            // auth success
            return null;
        }
        return Ethna::raiseNotice("you password is wrong", E_SAMPLE_AUTH);
    }
    public function changepass($backend, $mailaddr, $oldpass, $newpass)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query("SELECT * FROM userlist WHERE id=?", array($mailaddr));
        if (Ethna::isError($list)) {
            return $list;
        }
        $item=$list->fetchRow();
        if (!$item) {
            return Ethna::raiseNotice("you account is already deleted", E_SAMPLE_AUTH);
        }
        if ($item['id']===$mailaddr && $item['passwd']===$oldpass) {
            // change pass
            $res=$db->autoExecute("userlist", array("passwd"=>$newpass), "UPDATE", "id='{$mailaddr}'");
            if (Ethna::isError($res)) {
                return $res;
            }
            return null;
        }
        return Ethna::raiseNotice('old password is wrong', E_SAMPLE_AUTH);
    }
    public function userdelete($backend, $mailaddr)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query("DELETE FROM userlist WHERE id=?", array($mailaddr));
        if (Ethna::isError($list)) {
            return $list;
        }
        return null;
    }




    public function signup($backend, $mailaddr, $passwd)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query("SELECT * FROM userlist WHERE id=?", array($mailaddr));
        if (Ethna::isError($list)) {
            return $list;
        }
        $item=$list->fetchRow();
        if ($item) {
            return Ethna::raiseNotice("the user name is already used", E_SAMPLE_AUTH);
        }
        $res=$db->autoExecute("userlist", array("id"=>$mailaddr,"passwd"=>$passwd), "INSERT");
        if (Ethna::isError($res)) {
            return $res;
        }
    //return Ethna::raiseNotice("database error:"+$db->getMessage(),E_SAMPLE_AUTH);

        return null;
    }
    public function userlist($backend)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query("select * from userlist");
        if (Ethna::isError($list)) {
            return $list;
        }
        $res=array();
        while ($item=$list->fetchRow()) {
            $res[$item['id']]=array("id"=>$item['id'],"passwd"=>$item['passwd']);
        }
        return $res;
    }
}
