<?php
/**
 *  Iconadd/Do.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  iconadd_do Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_IconaddDo extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        'userfile'=>array(
            'type'=>VAR_TYPE_FILE,
            'name'=>'userfile'
            //            'required'=>true
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
 *  addicon_do action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_IconaddDo extends Sample_ActionClass
{
    /**
     *  preprocess of addicon_do Action.
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
     *  addicon_do action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        if(!$this->session->isStart()){
            return 'needlogin';
        }
        $file=$this->af->get('userfile');
        if ($file['size']===0 || $file['tmp_name']==='') {
            $this->ae->addObject(
                'iconadderror',
                Ethna::raiseNotice('need file',E_SAMPLE_AUTH)
            );
            return 'iconadd';
        }
        $um=new UserManager();
        $userid=$this->session->get('username');
        $res=$um->uploadIcon(
            $userid,
            $file['tmp_name'],
            pathinfo($file['name'],PATHINFO_EXTENSION)
        );
        $this->redirect('iconadd');
        return 'iconadd';
    }
}
