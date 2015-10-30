<?php

class BoardManager
{
    public function post($backend, $userid, $text, $color, $fname, $ext)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query('SELECT id FROM board');
        if (Ethna::isError($list)) {
            return $list;
        }
        while ($item=$list->fetchRow()) {
            $id= $id<$item['id'] ? $item['id'] : $id;
        }
        $id=$id+1;
        $newfname=NULL;
        if ($fname!==NULL || $fname!=='') {
            error_log("fname:" . $fname);
            $newfname='image' . $id . '.' . $ext;
            $fullpath='/home/vagrant/sample/www/uploaded/' . $newfname;
            rename($fname, $fullpath);
        }
        $res=$db->autoExecute(
            'board',
            array(
                'id'=>$id,
                'userid'=>$userid,
                'filename'=>$newfname,
                'color'=>$color,
                'content'=>$text,
                'submittime'=>date('Y-m-d H:i:s')
            ),
            'INSERT');
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
                'userid'=>$item['userid'],
                'filename'=>$item['filename'],
                'color'=>$item['color'],
                'submittime'=>$item['submittime'],
                'content'=>$item['content']
            );
        }
        return $res;
    }
}
