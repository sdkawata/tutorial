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
        $start=$this->af->get('start');
        error_log('start:' . $start);
        if ($start===NULL) {
            $start=0;
        }
        if ($start<0) {
            $start=0;
        }

        $count=5;

        $bm=new BoardManager();
        $boardlist=$bm->boardlist($this->backend);
        krsort($boardlist);
        $total=count($boardlist);
        $display_posts=array();
        for ($i=$start; $i<$start+$count && $i<$total; $i++) {
            $cur=current(array_slice($boardlist,$i,1,true));
            $cur['fileurl']=$bm->getImageUrl($cur['fileid']);
            array_push($display_posts,$cur);
        }
        if ($start>0) {
            $this->af->setApp('hasprev', true);
            $this->af->setApp('prev', $start-$count);
        }else{
            $this->af->setApp('hasprev', false);
        }
        if ($start+$count < $total) {
            $this->af->setApp('hasnext', true);
            $this->af->setApp('next', $start+$count);
            $this->af->setApp('last', (ceil($total/$count)-1) * $count);
        }else{
            $this->af->setApp('hasnext', false);
        }
        $this->af->setApp('posts', $display_posts);
        $this->af->setApp('link', '/?action_board=true');
        $this->af->setApp('count', $count);
        $this->af->setApp('current', $start);
        $this->af->setApp('pager', Ethna_Util::getDirectLinkList($total, $start, $count));
        return 'board';

    }
}
