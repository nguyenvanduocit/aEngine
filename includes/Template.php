<?php
/**
 * This is template manager
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 10:28 PM
 */

namespace AEngine;


use AEngine\Abstracts\Singleton;

class Template extends Singleton{
	/** @var  string */
	protected $FILE;
	/** @var  string */
	protected $DIR;

	/**
	 * Template constructor.
	 *
	 * @param $args
	 *
	 * @throws \Exception
	 */
	public function __construct($args) {
		if(!isset($args['FILE'], $args['DIR'])){
			throw new \Exception('Template constructor nee FILE, and DIR');
		}
		$this->FILE = $args['FILE'];
		$this->DIR = $args['DIR'];
	}

	/**
	 * @return string
	 */
	public function getFILE(){
		return $this->FILE;
	}

	/**
	 * @return string
	 */
	public function getDIR(){
		return $this->DIR;
	}
	/**
	 * sensei_get_template function.
	 *
	 * @access public
	 * @param mixed $template_name
	 * @param array $args (default: array())
	 * @param string $template_path (default: '')
	 * @param string $default_path (default: '')
	 * @return void
	 */
	public function get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		if ( $args && is_array($args) ) {
			extract( $args );
		}
		$located = $this->locate_template( $template_name, $template_path, $default_path );

		do_action( 'aengine_before_template_part', $template_name, $template_path, $located );

		include( $located );

		do_action( 'aengine_after_template_part', $template_name, $template_path, $located );
	}
	/**
	 * Locate template, currently, this is check like a plugin, but
	 *
*@param        $template_name
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return mixed|void
	 */
	public function locate_template( $template_name, $template_path = '', $default_path = '' ) {
		if ( ! $template_path ) {
			$template_path = 'diress/';
		}
		if ( ! $default_path ){
			$default_path = $this->getDIR() .'/template-parts/';
		}
		// Look within passed path within the theme - this is priority
		$templateNames = array();
		if(wp_is_mobile()){
			$templateNames[] = $template_path.'mobile/'.$template_name;
		}
		$templateNames[] = $template_path . $template_name;
		$templateNames[] = $template_name;

		$template = locate_template( $templateNames );

		// Get default template
		if ( ! $template )
			$template = $default_path . $template_name;

		// Return what we found
		return apply_filters( 'aengine_locate_template', $template, $template_name, $template_path );
	}
}