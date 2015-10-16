<?php
/**
 *  Logout.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  logout Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_Logout extends Sample_ActionForm
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
 *  logout action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_Logout extends Sample_ActionClass
{
    /**
     *  preprocess of logout Action.
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
     *  logout action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $this->session->destroy();
        return 'index';
    }
}
