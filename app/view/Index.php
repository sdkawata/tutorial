<?php
/**
 *  Index.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  Index view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_View_Index extends Sample_ViewClass
{
    /**
     *  preprocess before forwarding.
     *
     *  @access public
     */
    public function preforward()
    {
    if($this->session->isStart()){
$this->af->setApp("logined",true);
$this->af->setApp("username",$this->session->get("username"));
}else{
$this->af->setApp("logined",false);
}
    }
}

