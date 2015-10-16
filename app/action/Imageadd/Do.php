<?php
/**
 *  Imageadd/Do.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  imageadd_do Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_ImageaddDo extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        'userfile'=>array(
            'type'=>VAR_TYPE_FILE,
            'name'=>'userfile'
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
 *  imageadd_do action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_ImageaddDo extends Sample_ActionClass
{
    /**
     *  preprocess of imageadd_do Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        if ($this->af->validate() > 0) {
            // forward to error view (this is sample)
            return 'imageadd';
        }
        return null;
    }

    /**
     *  imageadd_do action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $file=$this->af->get('userfile');
        if ($file['size']===0 || $file['tmp_name']==='') {
            return 'imageadd';
        }
        rename($file['tmp_name'], '/home/vagrant/sample/www/uploaded/image.jpg');
        return 'index';
    }
}
