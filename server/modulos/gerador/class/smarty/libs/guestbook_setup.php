<?php

/**
 * Project: Guestbook Sample Smarty Application
 * Author: Monte Ohrt 
 * File: guestbook_setup.php
 * Version: 1.1
 */

require(GUESTBOOK_DIR . '/libs/guestbook.lib.php');
require(SMARTY_DIR . '/Smarty.class.php');

// smarty configuration
class Guestbook_Smarty extends Smarty {
    function __construct() {
      parent::__construct();
      $smarty->template_dir = "templates/";
      $this->assign('TABELA', 'contatos');
      $this->display('json.tpl');
	  /*$this->setTemplateDir(GUESTBOOK_DIR . 'templates');
      $this->setCompileDir(GUESTBOOK_DIR . 'templates_c');
      $this->setConfigDir(GUESTBOOK_DIR . 'configs');
      $this->setCacheDir(GUESTBOOK_DIR . 'cache');*/
    }
}
$z = new Guestbook_Smarty();
?>