<?php
/**
 *  Board/Delete.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/**
 *  board_delete Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Form_BoardDelete extends Sample_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
        'id' => array(
            'type'        => VAR_TYPE_INT,    // Input type
            'form_type'   => FORM_TYPE_TEXT,  // Form type
            'name'        => 'id'        // Display name
        )
    );
}

/**
 *  board_delete action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Action_BoardDelete extends Sample_ActionClass
{
    /**
     *  preprocess of board_delete Action.
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
        return null;
    }

    /**
     *  board_delete action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $bm=new BoardManager();
        $bm->delete($this->backend,$this->af->get('id'));
        return 'board';
    }
}
