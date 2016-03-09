<?php
/**
 *  User-info.php
 *
 *  @author     {$author}
 *  @package    Sample
 */


use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *  user-info Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_Userinfo extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        'id'=>array(
            'type'=>VAR_TYPE_STRING,
            'text'=>'userid',
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
 *  user-info action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_Userinfo extends Sample_ActionClass
{
    /**
     *  preprocess of user-info Action.
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
     *  user-info action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $um=new UserManager();
        $id=$this->af->comment=$this->af->get('id');
        $res=$um->isUserExists($this->backend,$id);
        if ($res){
            $url=$um->getIconUrl($id);
            (new JsonResponse(array('icon_url'=>$url)))->send();

        }else{
            (new JsonResponse(array('error'=>'no such user id'),HTTP_BAD_REQUEST))->send();
        }

        return null;
    }
}
