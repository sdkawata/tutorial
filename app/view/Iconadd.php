<?php
/**
 *  Addicon.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  addicon view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_View_Iconadd extends Sample_ViewClass
{
    /**
     *  preprocess before forwarding.
     *
     *  @access public
     */
    public function preforward()
    {
        $userid=$this->session->get('username');
        $um=new UserManager();
        $this->af->setApp('iconurl',$um->getIconUrl($userid));
    }
}
