<?php
/**
 * This is module manager
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 5:25 PM
 */

namespace AEngine;


use AEngine\Abstracts\Singleton;

class Module extends Singleton{
	/** @var  \AEngine\Module\Base[] */
	protected $modules;
	protected function loadModule($load_modules){
		$load_modules = apply_filters( 'aengine_modules', $load_modules );
		// Get sort order option
		$ordering = (array) get_option( 'aengine_module_order', array( 'header' => 1 ) );
		// Max 50 module
		$order_end = 50;
		/** @var \AEngine\Module\Base[] $loadedModules */
		$loadedModules = array();
		// Load gateways in order
		foreach ( $load_modules as $module ) {
			/** @var \AEngine\Module\Base $load_module */
			$load_module = is_string( $module ) ? new $module() : $module;

			if ( isset( $ordering[ $load_module->getId() ] ) && is_numeric( $ordering[ $load_module->getId() ] ) ) {
				// Add in position
				$loadedModules[ $ordering[ $load_module->getId() ] ] = $load_module;
			} else {
				// Add to end of the array
				$loadedModules[ $order_end ] = $load_module;
				$order_end ++;
			}
		}
		ksort( $loadedModules );
		if ( count( $loadedModules ) > 0 ) {
			foreach ( $loadedModules as $order => $module ) {
				$this->modules[ $module->getId() ] = $module;
			}
		}
	}
	/**
	 * Get gateways.
	 *
	 * @access public
	 * @return array
	 */
	public function getModules() {
		return $this->modules;
	}

	/**
	 * @param $id
	 *
	 * @return Module\Base|null
	 */
	public function getModule($id){
		if(array_key_exists($id, $this->modules)){
			return $this->modules[$id];
		}
		return null;
	}
	/**
	 * Run all active module
	 */
	public function runActivedModules() {
		$modules = $this->getAvailableModules();
		foreach ( $modules as $index => $module ) {
			$module->run();
		}
	}

	/**
	 * @return \AEngine\Module\Base[]
	 */
	public function getAvailableModules() {
		$availableModule = array();
		foreach ( $this->modules as $index => $module ) {
			if ( $module->isAvailable() ) {
				$availableModule[] = $module;
			}
		}

		return $availableModule;
	}
}