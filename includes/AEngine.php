<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/4/2015
 * Time: 1:09 AM
 */


namespace AEngine;

final class AEngine extends PluginBase{
	/**
	 * Run the plugin
	 */
	public function run(){

	}

	/**
	 * @return string
	 */
	public function getDIR() {
		return AENGINE_DIR;
	}

	/**
	 * @return string
	 */
	public function getFILE() {
		return AENGINE_FILE;
	}
}