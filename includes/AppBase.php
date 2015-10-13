<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/13/2015
 * Time: 10:23 AM
 */

namespace AEngine;


abstract class AppBase {
	abstract public function getDIR();

	abstract public function getFILE();
	/**
	 * @return \AEngine\Template
	 */
	public function Template() {
		$args = array(
				'FILE' => $this->getFILE(),
				'DIR'  => $this->getDIR(),
		);
		return Template::getInstance( $args );
	}
}