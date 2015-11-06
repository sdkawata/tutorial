<?php
/**
 *  Iconadd.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  addicon Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_Iconadd extends Sample_ActionForm
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
 *  addicon action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_Iconadd extends Sample_ActionClass
{
    /**
     *  preprocess of addicon Action.
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
     *  addicon action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        if($this->session->isStart()){
            return 'iconadd';
        }else{
            return 'needlogin';
        }
    }
}
