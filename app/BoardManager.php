<?php

class BoardManager
{
    private $acceptable_exts=array(
        'png'=>array(
            'content-type'=>'image/png'
        ),
        'jpg'=>array(
            'content-type'=>'image/jpeg'
        )
    );
    private function savepath($fname) {
        return '/home/vagrant/sample/www/uploaded/' . $fname;
    }
    public function s3upload($fname, $fileid, $ext)
    {
        $ctype='binary/octet-stream';
        if (array_key_exists($ext,$this->acceptable_exts)) {
            $ctype=$this->acceptable_exts[$ext]['content-type'];
        }else{
            return Ethna::raiseNotice("a file which has ext ". $ext . ' is not allowed to upload',E_SAMPLE_AUTH);
        }
        //$fullpath=$this->savepath($newfname);
        //rename($fname, $fullpath);
        try{
            $s3=Aws\S3\S3Client::factory(
                array(
                    'key'=>SecretConfig::$config['AWS_ACCESS_KEY_ID'],
                    'secret'=>SecretConfig::$config['AWS_SECRET_ACCESS_KEY'],
                    'region'=>SecretConfig::$config['AWS_DEFAULT_REGION']
                    )
            );
            error_log('ctype:' . $ctype);
            $result=$s3->putObject(
                array(
                    'ACL'=>'public-read',
                    'Bucket'=>SecretConfig::$config['AWS_BUCKET_NAME'],
                    'Key'=>$fileid,
                    'Body'=>fopen($fname,'r'),
                        'ContentType'=>$ctype
                )
            );
            //$fileurl=$result['ObjectURL'];
        }catch(Exception $e){
            throw $e;
            //return Ethna::raiseNotice('error occured while accessing AWS errormessage:' . $e->getMessage(),E_SAMPLE_AUTH);
        }
        return null;
    }
    public function post($backend, $userid, $text, $color, $fileid)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query('SELECT id FROM board');
        if (Ethna::isError($list)) {
            return $list;
        }
        $id = 0;
        while ($item=$list->fetchRow()) {
            $id= $id<$item['id'] ? $item['id'] : $id;
        }
        $id=$id+1;
        $res=$db->autoExecute(
            'board',
            array(
                'id'=>$id,
                'userid'=>$userid,
                'fileid'=>$fileid,
                //'fileurl'=>$fileurl,
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
                //'fileurl'=>$item['fileurl'],
                'fileid'=>$item['fileid'],
                'color'=>$item['color'],
                'submittime'=>$item['submittime'],
                'content'=>$item['content']
            );
        }
        return $res;
    }
    public function getImageUrl($fileid)
    {
        try{
            $s3=Aws\S3\S3Client::factory(
                array(
                    'key'=>SecretConfig::$config['AWS_ACCESS_KEY_ID'],
                    'secret'=>SecretConfig::$config['AWS_SECRET_ACCESS_KEY'],
                    'region'=>SecretConfig::$config['AWS_DEFAULT_REGION']
                )
            );
            $result=$s3->getObjectUrl(
                SecretConfig::$config['AWS_BUCKET_NAME'],
                $fileid
            );
        }catch(Exception $e){
            throw $e;
        }
        return $result;
    }
    public function delete($backend, $id)
    {
        $db=& $backend->getDB();
        if (Ethna::isError($db)) {
            return $db;
        }
        $list=$db->query("select * from board where id=?",array($id));
        if ($item=$list->fetchRow()) {
            $fileid=$item['fileid'];
            if ($fileid!==NULL && $fileid!=="") {
                try{
                    $s3=Aws\S3\S3Client::factory(
                        array(
                            'key'=>SecretConfig::$config['AWS_ACCESS_KEY_ID'],
                            'secret'=>SecretConfig::$config['AWS_SECRET_ACCESS_KEY'],
                            'region'=>SecretConfig::$config['AWS_DEFAULT_REGION']
                        )
                    );
                    $result=$s3->deleteObject(
                        array(
                            'Bucket'=>SecretConfig::$config['AWS_BUCKET_NAME'],
                            'Key'=>$fileid,
                        )
                    );
                }catch(Exception $e){
                    throw $e;
                    //return Ethna::raiseNotice('error occured while accessing AWS errormessage:' . $e->getMessage(),E_SAMPLE_AUTH);
                }
            }
        }
        $list=$db->query("DELETE FROM board WHERE id=?", array($id));
        if (Ethna::isError($list)) {
            return $list;
        }
        return null;
    }
    public function addUrl($entry){
        $um=new UserManager();
        if($entry['fileid']!==NULL && $entry['fileid']!==''){
            $entry['fileurl']=$this->getImageUrl($entry['fileid']);
        }
        $entry['iconurl']=$um->getIconUrl($entry['userid']);
        return $entry;

    }
}
