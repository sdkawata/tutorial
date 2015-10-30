<?php
/**
 *  Board.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  board Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_Board extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        'start'=>[
            'type'=>VAR_TYPE_INT,
            'name'=>'start'
        ]
    );

    /**
     *  Form input value convert filter : sample
     *
     *  @access protected
     *  @param  mixed   $value  Form Input Value
     *  @return mixed           Converted result.
     */
    /*
    protected function _filter_sample($value)
    {
        //  convert to upper case.
        return strtoupper($value);
    }
    */
}

/**
 *  board action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_Board extends Sample_ActionClass
{
    /**
     *  preprocess of board Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        return null;
    }

    /**
     *  board action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
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
            array_push($display_posts,current(array_slice($boardlist,$i,1,true)));
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
