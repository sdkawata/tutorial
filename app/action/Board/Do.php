<?php
/**
 *  Board/Do.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  board_do Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_BoardDo extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        'uploaded-fileid'=>array(
            'type'=>VAR_TYPE_STRING,
            'name'=>'userfile',
            'required'=>true
        ),
        'content'=>array(
            'type'=>VAR_TYPE_STRING,
            'name'=>'content',
            'required'=>true
        ),
        'color'=>array(
            'type'=>VAR_TYPE_STRING,
            'name'=>'content',
            'required'=>true
        )
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
 *  board_do action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_BoardDo extends Sample_ActionClass
{
    /**
     *  preprocess of board_do Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {

        if ($this->af->validate() > 0) {
            return 'board';
        }
        return null;
    }

    /**
     *  board_do action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        if(!$this->session->isStart()){
            $this->ae->addObject('boardError',Ethna::raiseNotice("you need to login to post",E_SAMPLE_AUTH));
            return 'board';
        }
        $bm=new BoardManager();
        $color=$this->af->get('color');
        if ($color===NULL) {
            $color='#000000';
        }
        $fileid=$this->af->get('uploaded-fileid');
        $content=$this->af->get('content');
        //$content='hage';
        $res=$bm->post(
            $this->backend,
            $this->session->get('username'),
            $content,
            $color,
            $fileid
        );
        if (Ethna::isError($res)) {
            $this->ae->addObject('PostError',$res);
        }else{
            $this->redirect('board');
        }
        return 'board';
    }
}
