<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/22/2015
 * Time: 9:30 PM
 */

namespace AEngine;


use AEngine\Abstracts\Singleton;

final class Front extends Singleton {
	public function init() {
		add_action( 'init', array( $this, 'registerAsset' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'startAEngineJs' ), 100 );
		add_filter('clean_url', array($this, 'addAsyncForscript'), 11, 1);
	}

	/**
	 * @param $url
	 *
	 * @return mixed|string
	 */
	public function addAsyncForscript($url)
	{
		if (strpos($url, '#async')!==false) {
			$url = str_replace( '#async','', $url ) . "' async='async";
		}
		if (strpos($url, '#defer')!==false) {
			$url = str_replace( '#defer','', $url ) . "' defer='defer";
		}
		return $url;
	}
	/**
	 * Enqueue script and style
	 */
	public function registerAsset() {
		wp_register_script( 'marionette', AENGINE_URL . 'js/lib/backbone.marionette.js', array( 'backbone' ), AENGINE_VERSION, true );
		wp_register_script( 'aengine', AENGINE_URL . 'js/aengine.js', array(
			'backbone',
			'marionette'
		), AENGINE_VERSION, true );
		wp_register_script( 'startAEngine', AENGINE_URL . 'js/startEngine.js', array( 'aengine', ), AENGINE_VERSION, true );
		wp_register_script('gmap','https://maps.googleapis.com/maps/api/js?key=AIzaSyAADe-KNopn3xRQeTuGuJIOP3-nlcKgqqY&sensor=true&signed_in=true&callback=AEngine.App.onMapLoaded#async#defer', array('aengine'), AENGINE_VERSION, true);
	}
	public function startAEngineJs(){
		wp_enqueue_script('startAEngine');
	}
}