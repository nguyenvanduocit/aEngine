<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 1:29 PM
 */

namespace AEngine\Module;

/**
 * Class Base
 *
 * Base of all module
 *
 * @package AEngine\Module
 */

abstract class Base {
	/**
	 * Setting values.
	 * @var array
	 */
	protected $settings;
	public $defaultSettings = array('enabled' => true);
	/**
	 * Customizer control
	 * @var array
	 */
	protected $controls = array();
	/**
	 * 'yes' if the method is enabled
	 * @var string
	 */
	public $enabled = '1';
	/** @var  string */
	protected $id;

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	public function run(){
		if(isset($this->controls)){
			add_action('customize_register', array($this,'registerCustomizer'));
		}
		if(is_admin()){
			add_filter('ae_admin_controls', array($this, 'addControlsToAdminPage'));
		}
	}

	/**
	 * @return bool
	 */
	public function isAvailable() {
		$is_available = ( '1' === $this->enabled ) ? true : false;

		return $is_available;
	}
	public function init_settings(){
		foreach($this->controls as $key => $arg){
			ae_set_default_option($key, $arg['value']);
		}
	}
	public function addControlsToAdminPage($controls){
		return array_merge($controls, $this->controls);
	}
	/**
	 * Get module template
	 * @param $name
	 * @param $args
	 */
	public function get_template($template_name, $args = array()){
		global $aEngine;
		$template_path =  'inc/Module/'.ucfirst($this->id).'/template/';
		$aEngine->Template()->get_template($template_name, $args, $template_path);
	}
}