<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 10:36 PM
 */

namespace AEngine;


use AEngine\Abstracts\Singleton;

class Widget extends Singleton{
	protected $widget_classes;
	public function init(){
		foreach( $this->widget_classes as $index => $class ){
			Abstracts\Widget::init( $class );
		}
	}
}