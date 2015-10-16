<?php
/**
 *  Userlist.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  userlist Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_Userlist extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array();

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
 *  userlist action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_Userlist extends Sample_ActionClass
{
    /**
     *  preprocess of userlist Action.
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
     *  userlist action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        if ($this->session->isStart()) {
            return 'userlist';
        } else {
            return 'needlogin';
        }
    }
}
