<?php
/**
 *  Comment/Do.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  comment_do Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_CommentDo extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        "comment"=>[
            "name"=>"mailaddr",
            "type"=>VAR_TYPE_STRING,
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
 *  comment_do action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_CommentDo extends Sample_ActionClass
{
    /**
     *  preprocess of comment_do Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        if ($this->af->validate() > 0) {
            // forward to error view (this is sample)
            return 'comment';
        }
        return null;
    }

    /**
     *  comment_do action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        if (! $this->session->isStart()) {
            return 'needlogin';
        }
        error_log("send mail");
        $mailaddr = file_get_contents("/home/vagrant/mailaddr");
        $comment=$this->af->get('comment');
        $ethna_mail = & new Ethna_MailSender($this->backend);
        $ethna_mail->send(
            $mailaddr,
            'comment.tpl',
            array(
                'comment' => $comment,
                'username' => $this->session->get('username')
            )
        );
        return 'index';
    }
}
