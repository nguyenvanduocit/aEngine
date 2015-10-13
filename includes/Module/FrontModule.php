<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/13/2015
 * Time: 11:12 AM
 */

namespace AEngine\Module;


abstract class FrontModule extends Base{
	/**
	 * @return bool
	 */
	public function isAvailable() {
		return parent::isAvailable() && !is_admin();
	}
}