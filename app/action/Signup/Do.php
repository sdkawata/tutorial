><?php
/**
 *  Signup/Do.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  signup_do Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_SignupDo extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
    "mailaddress"=>[
    "name"=>"mailaddr",
    "type" =>VAR_TYPE_STRING,
    "required"=>true
    ],
    "password"=>[
    "name"=>"passwd",
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
 *  signup_do action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_SignupDo extends Sample_ActionClass
{
    /**
     *  preprocess of signup_do Action.
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
     *  signup_do action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $um=new UserManager();
        $result=$um->signup($this->backend, $this->af->get("mailaddress"), $this->af->get("password"));
        if (Ethna::isError($result)) {
            $this->ae->addObject("loginError", $result);
            return 'signup';
        }
//login
        $this->session->start();
        $this->session->set("username", $this->af->get("mailaddress"));
        $this->redirectindex();
        return 'index';
        //return 'signup_do';
    }
}
