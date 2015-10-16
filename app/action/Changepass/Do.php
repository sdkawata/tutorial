<?php
/**
 *  Changepass/Do.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  changepass_do Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_ChangepassDo extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
    "oldpass"=>[
    "name"=>"oldpass",
    "type" =>VAR_TYPE_STRING,
    "required"=>true
    ],
    "newpass"=>[
    "name"=>"newpass",
    "type" =>VAR_TYPE_STRING,
    "required"=>true
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
 *  changepass_do action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_ChangepassDo extends Sample_ActionClass
{
    /**
     *  preprocess of changepass_do Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {

        if ($this->af->validate() > 0) {
            // forward to error view (this is sample)
            return 'changepass';
        }
        $sample = $this->af->get('sample');

        return null;
    }

    /**
     *  changepass_do action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        if (!$this->session->isStart()) {
            return "needlogin";
        }
        $id=$this->session->get("username");
        $um=new UserManager();
        $result=$um->changepass($this->backend, $id, $this->af->get("oldpass"), $this->af->get("newpass"));
        if (Ethna::isError($result)) {
            $this->ae->addObject("loginError", $result);
            return 'changepass';
        }
//login


        return 'index';

    }
}
