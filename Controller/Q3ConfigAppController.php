<?php
/**
 * Q3Config stored configuration system
 *
 * PHP version 5
 *
 * Copyright (c) 2013, Juanvi Vercher
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) 2013, Juanvi Vercher
 * @link          www.artvisual.net
 * @package       Q3Config
 * @subpackage    Q3Config.controllers
 * @since         v 0.6.0 (28-Jun-2013)
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 *
 */
App::uses('AppController', 'Controller');

class Q3ConfigAppController extends AppController{
	public function render($view = null, $layout = null) {
            if (is_null($view)) {
                $view = $this->action;
            }
            $viewPath = substr(get_class($this), 0, strlen(get_class($this)) - 10);
            if (!file_exists(APP . 'View' . DS . $viewPath . DS . $view . '.ctp')) {
                $this->plugin = 'Q3Config';
            } else {
                $this->viewPath = $viewPath;
                $this->plugin='';
            }
            return parent::render($view, $layout);
        }
}
