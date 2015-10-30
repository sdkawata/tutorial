<?php
/**
 *  Board.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  board view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_View_Board extends Sample_ViewClass
{
    /**
     *  preprocess before forwarding.
     *
     *  @access public
     */
    public function preforward()
    {
        $bm=new BoardManager();
        $boardlist=$bm->boardlist($this->backend);
        krsort($boardlist);
        $this->af->setApp('board', $boardlist);

    }
}
