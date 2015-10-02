<?php
/**
 *  Delete.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  delete Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_Delete extends Sample_ActionForm
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
 *  delete action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_Delete extends Sample_ActionClass
{
    /**
     *  preprocess of delete Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        
        if ($this->af->validate() > 0) {
            // forward to error view (this is sample)
	    if($this->session->isStart()){
            return 'userlist';
}else{return "needlogin";}	
        }
        //$sample = $this->af->get('sample');
        
        return null;
    }

    /**
     *  delete action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
if(!$this->session->isStart()){return "needlogin";}
$um=new UserManager();
    $um=new UserManager();
    $result=$um->userdelete($this->backend,$this->af->get("mailaddress"));
    if(Ethna::isError($result)){
	//$this->ae->addObject("loginError",$result);
        return 'userlist';
    }


        return 'userlist';
    }
}
