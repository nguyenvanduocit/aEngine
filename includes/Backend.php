<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 9:26 PM
 */

namespace AEngine;


use AEngine\Abstracts\Singleton;

final class Backend extends Singleton{

    public function init() {
        add_action( 'admin_enqueue_scripts', array( $this, 'startAEngineJs' ), 100 );
        add_action( 'admin_enqueue_scripts', array( $this, 'startAEngineJs' ), 100 );
    }
    public function startAEngineJs(){
        wp_enqueue_script('aengine');

        wp_enqueue_script('backend', AENGINE_URL.'/js/backend.js', array('aengine'), true);

        wp_enqueue_script('startAEngine');
    }
}