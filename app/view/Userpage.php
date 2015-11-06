<?php
/**
 *  Userpage.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  userpage view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_View_Userpage extends Sample_ViewClass
{
    /**
     *  preprocess before forwarding.
     *
     *  @access public
     */
    public function preforward()
    {
        $userid=$this->af->getApp('userid');
        $um=new UserManager();
        $this->af->setApp('iconurl',$um->getIconUrl($userid));
        $bm=new BoardManager();
        $boardlist=$bm->boardlist($this->backend);
        krsort($boardlist);
        $mylist=array();
        foreach ($boardlist as $post) {
            if($post['userid']==$userid) {
                array_push($mylist,$bm->addUrl($post));
            }
        }
        $this->af->setApp('posts',$mylist);
    }
}
