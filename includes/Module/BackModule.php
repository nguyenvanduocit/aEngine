<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/13/2015
 * Time: 11:13 AM
 */

namespace AEngine\Module;

/**
 * Class BackModule
 *
 * This module only available for backend
 *
 * @package AEngine\Module
 */

abstract class BackModule extends Base{
	/**
	 * @return bool
	 */
	public function isAvailable() {
		return parent::isAvailable() && is_admin();
	}
}