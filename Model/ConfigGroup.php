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
 * @subpackage    Q3Config.models
 * @since         v 0.6.0 (28-Jun-2013)
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 *
 */

App::uses('Q3ConfigAppModel','Q3Config.Model');

class ConfigGroup extends Q3ConfigAppModel
{
	var $name = 'ConfigGroup';//for php4
	  var $hasMany = array(
 			'Config'=>array('className'=>'Q3Config.Config',
 							'conditions'=>array('Config.editable >='=>1),
 							'order'=>array('order'=>'ASC')
	  						)
	  );
}
