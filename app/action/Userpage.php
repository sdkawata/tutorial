<?php
/**
 *  Userpage.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  userpage Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_Userpage extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        'userid'=>[
            'name'=>'userid',
            'type'=>VAR_TYPE_STRING,
            'required'=>true
        ]
    );
}

/**
 *  userpage action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_Userpage extends Sample_ActionClass
{
    /**
     *  preprocess of userpage Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        if ($this->af->validate() > 0) {
            // forward to error view (this is sample)
            return 'error';
        }
        $sample = $this->af->get('sample');
        return null;
    }

    /**
     *  userpage action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $userid=$this->af->get('userid');
        $this->af->setApp('userid',$userid);
        if ($this->session->isStart()){
            if ($userid===$this->session->get('username')) {
                $this->af->setApp('ismypage',true);
            }
        }
        return 'userpage';
    }
}
