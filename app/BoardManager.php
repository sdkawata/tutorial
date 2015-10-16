<?php

class BoardManager
{
    public function post($backend, $username, $text, $color, $fname)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query("SELECT * FROM usernames WHERE id=?", array($mailaddr));
        if (Ethna::isError($list)) {
            return $list;
        }
        $item=$list->fetchRow();
        if ($item) {
            return Ethna::raiseNotice("the user name is already used", E_SAMPLE_AUTH);
        }
        $res=$db->autoExecute("usernames", array("id"=>$mailaddr,"passwd"=>$passwd), "INSERT");
        if (Ethna::isError($res)) {
            return $res;
        }
    //return Ethna::raiseNotice("database error:"+$db->getMessage(),E_SAMPLE_AUTH);

        return null;
    }
    public function boardlist($backend)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query("select * from board");
        if (Ethna::isError($list)) {
            return $list;
        }
        $res=array();
        while ($item=$list->fetchRow()) {
            $res[$item['id']]=array(
                'id'=>$item['id'],
                'username'=>$item['username'],
                'fname'=>$item['fname'],
                'color'=>$item['color'],
                'time'=>$item['time'],
                'text'=>$item['text']
            );
        }
        return $res;
    }
}
