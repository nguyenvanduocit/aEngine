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
		add_action( 'wp_enqueue_scripts', array( $this, 'startAEngineJs' ), 500 );
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
	public function startAEngineJs(){
		wp_enqueue_script('startAEngine');
	}
}