<?php
/**
 *  Sample_Controller.php
 *
 *  @author     {$author}
 *  @package    Sample
 */

/** Application base directory */
define('BASE', dirname(dirname(__FILE__)));

/** include_path setting (adding "/app" and "/lib" directory to include_path) */
$app = BASE . "/app";
$lib = BASE . "/lib";
set_include_path(implode(PATH_SEPARATOR, array($app, $lib)) . PATH_SEPARATOR . get_include_path());

require_once BASE . '/vendor/autoload.php';
require_once 'Sample_Error.php';
require_once "UserManager.php";
require_once 'Sample_ActionClass.php';
require_once 'Sample_ActionForm.php';
require_once 'Sample_ViewClass.php';
require_once 'Sample_UrlHandler.php';
require_once 'adodb/adodb.inc.php';

/**
 *  Sample application Controller definition.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sample
 */
class Sample_Controller extends Ethna_Controller
{
    /**#@+
     *  @access protected
     */

    /**
     *  @var    string  Application ID(appid)
     */
    protected $appid = 'SAMPLE';

    /**
     *  @var    array   forward definition.
     */
    protected $forward = array();

    /**
     *  @var    array   action definition.
     */
    protected $action = array();

    /**
     *  @var    array       application directory.
     */
    protected $directory = array(
        'action'        => 'app/action',
        'action_cli'    => 'app/action_cli',
        'action_xmlrpc' => 'app/action_xmlrpc',
        'app'           => 'app',
        'plugin'        => 'app/plugin',
        'bin'           => 'bin',
        'etc'           => 'etc',
        'filter'        => 'app/filter',
        'locale'        => 'locale',
        'log'           => 'log',
        'plugins'       => array('app/plugin/Smarty'),
        'template'      => 'template',
        'template_c'    => 'tmp',
        'tmp'           => 'tmp',
        'view'          => 'app/view',
        'www'           => 'www',
        'test'          => 'app/test',
    );

    /**
     *  @var    array       database access definition.
     */
    protected $db = array(
        ''              => DB_TYPE_RW,
    );

    /**
     *  @var    array       extention(.php, etc) configuration.
     */
    protected $ext = array(
        'php'           => 'php',
        'tpl'           => 'tpl',
    );

    /**
     *  @var    array   class definition.
     */
    public $class = array(
        /*
         *  TODO: When you override Configuration class, Logger class,
         *        SQL class, don't forget to change definition as follows!
         */
        'class'         => 'Ethna_ClassFactory',
        'backend'       => 'Ethna_Backend',
        'config'        => 'Ethna_Config',
        'db'            => 'Ethna_DB_ADOdb',
        'error'         => 'Ethna_ActionError',
        'form'          => 'Sample_ActionForm',
        'i18n'          => 'Ethna_I18N',
        'logger'        => 'Ethna_Logger',
        'plugin'        => 'Ethna_Plugin',
        'session'       => 'Ethna_Session',
        'view'          => 'Sample_ViewClass',
        'renderer'      => 'Ethna_Renderer_Smarty',
        'url_handler'   => 'Sample_UrlHandler',
    );

    /**
     *  @var    array       filter definition.
     */
    protected $filter = array(
       'ExectimeFilter'
    );

    /**#@-*/

    /**
     *  Get Default language and locale setting.
     *  If you want to change Ethna's output encoding, override this method.
     *
     *  @access protected
     *  @return array   locale name(e.x ja_JP, en_US .etc),
     *                  system encoding name,
     *                  client encoding name(= template encoding)
     *                  (locale name is "ll_cc" format. ll = language code. cc = country code.)
     */
    protected function _getDefaultLanguage()
    {
        return array('ja_JP', 'UTF-8', '{$client_enc}');
    }

    /**
     *  set Default Template Engine
     *
     *  @access protected
     *  @param  object  Ethna_Renderer
     *  @obsolete
     */
    protected function _setDefaultTemplateEngine($renderer)
    {
    }
}
