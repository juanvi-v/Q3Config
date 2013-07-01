<?php

/**
 * Loaded once
 */

if(!Configure::read('DefinedConfigs')) {
	Configure::write('DefinedConfigs',true);

	App::uses('Config','Q3Config.Model');

	$Config=new Config();
	$configs = $Config->find('all',array(
			'conditions'=>array(
					'Config.define'=>array(1,2)
			)
	));

	foreach($configs as $conf){
		if($conf['Config']['define']=='1'){
			define($conf['Config']['config_key'],$conf['Config']['value']);
		}
		else{
			Configure::write($conf['Config']['config_key'],$conf['Config']['value']);
		}
	}
}
