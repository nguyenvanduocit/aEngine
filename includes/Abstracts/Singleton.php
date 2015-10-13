<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/12/2015
 * Time: 9:09 PM
 */

namespace AEngine\Abstracts;


class Singleton {
	protected function __construct()
	{
	}

	final public static function getInstance()
	{
		static $instances = array();

		$calledClass = get_called_class();
		$args =func_get_args();
		if (!isset($instances[$calledClass]))
		{
			if($args){
				$instances[$calledClass] = new static($args[0]);
			}
			else{
				$instances[$calledClass] = new static();
			}
		}

		return $instances[$calledClass];
	}

	final private function __clone()
	{
	}
}