<?php
/**
 *  Userlist.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  userlist view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_View_Userlist extends Sample_ViewClass
{
    /**
     *  preprocess before forwarding.
     *
     *  @access public
     */
    public function preforward()
    {
        $um=new UserManager();
        $list=$um->userlist($this->backend);
        $this->af->setApp("userlist", $list);
        $this->af->setApp("listsize", count($list));
    }
}
