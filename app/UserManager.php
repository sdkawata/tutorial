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
    public function isUserExists($backend, $userid)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query("SELECT * FROM userlist WHERE id=?", array($userid));
        if (Ethna::isError($list)) {
            return $list;
        }
        $item=$list->fetchRow();
        if ($item) {
            return true;
        }else{
            return false;
        }
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
        $list=$db->query("select * from userlist order by id");
        if (Ethna::isError($list)) {
            return $list;
        }
        $res=array();
        while ($item=$list->fetchRow()) {
            $res[$item['id']]=array("id"=>$item['id'],"passwd"=>$item['passwd']);
        }
        return $res;
    }
    public function getIconUrl($userid)
    {
        $res="";
        try{
            $s3=Aws\S3\S3Client::factory(
                array(
                    'key'=>SecretConfig::$config['AWS_ACCESS_KEY_ID'],
                    'secret'=>SecretConfig::$config['AWS_SECRET_ACCESS_KEY'],
                    'region'=>SecretConfig::$config['AWS_DEFAULT_REGION']
                )
            );
            if ($s3->doesObjectExist(
                SecretConfig::$config['AWS_BUCKET_NAME'],
                $userid . '/icon'
            )) {
                $res=$s3->getObjectUrl(
                    SecretConfig::$config['AWS_BUCKET_NAME'],
                    $userid . '/icon'
                );
            }else{
                $res=$s3->getObjectUrl(
                    SecretConfig::$config['AWS_BUCKET_NAME'],
                    'defaulticon'
                );
            }
        }catch(Exception $e){
            throw $e;
            //return Ethna::raiseNotice('error occured while accessing AWS errormessage:' . $e->getMessage(),E_SAMPLE_AUTH);
        }
        return $res;
    }
    public function uploadIcon($userid, $fname, $ext)
    {
        $fileid = ($userid . '/icon');
        $bm=new BoardManager();
        $res=$bm->s3upload($fname, $fileid, $ext);
    }
}
