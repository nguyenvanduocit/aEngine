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

	public function getDIR() {
		return AENGINE_DIR;
	}

	public function getFILE() {
		return AENGINE_FILE;
	}
}