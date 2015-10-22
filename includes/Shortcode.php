<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 1:41 PM
 */

namespace AEngine;

use AEngine\Abstracts\Singleton;

class Shortcode extends Singleton{
	protected $shortcode_classes;
	public function __construct(){
		$this->shortcode_classes = apply_filters('aengine_shortcode_map',array(
			'\AEngine\Shortcode\PostList'
		));
	}
	public function init(){
		/**
		 * Tell WP to run this classes load_shortcode function for all the
		 * shortcodes registered here in.
		 *
		 * With this method we only load shortcode classes when we need them.
		 */
		foreach( $this->shortcode_classes as $shortcode => $class ){
			add_shortcode( $shortcode, array( $this,'render_shortcode' ) );

		}
	}

	/**
	 * Respond to WordPress do_shortcode calls
	 * for shortcodes registered in the initialize_shortcodes function.
	 *
	 * @since 1.8.0
	 *
	 * @param $attributes
	 * @param $content
	 * @param $code z` shortcode that is being requested
	 *
	 * @return string
	 */
	public function render_shortcode( $attributes='', $content='', $code ){
		// only respond if the shortcode that we've added shortcode
		// classes for.
		/** @var string $code */
		if( ! isset( $this->shortcode_classes[ $code ] ) ){
			return '';
		}

		// create an instances of the current requested shortcode
		$shortcode_handling_class = $this->shortcode_classes[ $code ];
		/** @var \AEngine\Shortcode\ShortcodeInterface $shortcode */
		$shortcode = new $shortcode_handling_class( $attributes, $content, $code );
		// we expect the sensei class instantiated to implement the Sensei_Shortcode interface
		if( ! in_array( 'AEngine\Shortcode\ShortcodeInterface', class_implements( $shortcode) ) ){
			$message = "The rendering class for your shortcode: $code, must implement the AEngine\\Shortcode\\ShortcodeInterface";
			_doing_it_wrong('\AEngine\Shortcode::render_shortcode',$message, '1.9.0' );

		}
		return $shortcode->render();
	}
}