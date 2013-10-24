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
App::uses('Q3ConfigAppController', 'Q3Config.Controller');

class ConfigsController extends Q3ConfigAppController {

    var $name = 'Configs';

    var $uses = array('Q3Config.Config','Q3Config.ConfigGroup');

    protected $admin_level=100;



    /** @method admin_index
     *  renders config options
     */
	function admin_index(){
		$groups = $this->ConfigGroup->find('all',array('conditions'=>array('ConfigGroup.active'=>1),'order'=>array('order'=>'ASC')));
		$this->set(compact('groups'));
	}

	/** @method admin_save
	 *  saves a group of options, usually from a block
	 */
	function admin_save_options(){
		if(isset($this->data['Config'])){
				foreach($this->data['Config'] as $config):
				$this->Config->id=$config['id'];
				$this->Config->saveField('value',$config['value']);
			endforeach;
			$this->Session->setFlash(__d('q3_config','Items saved'));
			$this->redirect(array('action' => 'index'));
		}
		else{
			$this->Session->setFlash(__d('q3_config','ERROR: no item has been saved'));
			$this->redirect(array('action' => 'index'));
		}
	}

	/** @method admin_panic
	 * enables the panic mode, to disable a basic site function for maintenance
	 */
	function admin_panic(){
		$config_panic=$this->Config->find('first',array('fields'=>'Config.id','conditions'=>array('Config.config_key'=>'PANIC')));
		$this->Config->id=$config_panic['Config']['id'];
		$this->Config->saveField('value',1);
		$this->Session->setFlash(__d('q3_config','Panic mode enabled'));
		$this->redirect($this->referer());
	}

	/** @method admin_dont_panic
	 * disables the panic mode, to enable a basic site function after maintenance
	 */
	function admin_dont_panic(){
		$config_panic=$this->Config->find('first',array('fields'=>'Config.id','conditions'=>array('Config.config_key'=>'PANIC')));
		$this->Config->id=$config_panic['Config']['id'];
		$this->Config->saveField('value',0);
		$this->Session->setFlash(__d('q3_config','Panic mode disabled'));
		$this->redirect($this->referer());
	}
}
