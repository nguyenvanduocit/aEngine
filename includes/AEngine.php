<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/4/2015
 * Time: 1:09 AM
 */


namespace AEngine;

final class AEngine extends PluginBase
{
    /**
     * Run the plugin
     */
    public function run()
    {
        add_action( 'init', array( $this, 'registerAsset' ) );
        if ( ! is_admin()) {
            $this->Front()->init();
        } else {
            $this->Backend()->init();
        }
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

        wp_register_script( 'form_module', AENGINE_URL . 'includes/Form/asset/form.module.js', array( 'aengine','startAEngine' ), AENGINE_VERSION, true );
        wp_register_script('gmap','https://maps.googleapis.com/maps/api/js?key=AIzaSyAADe-KNopn3xRQeTuGuJIOP3-nlcKgqqY&sensor=true&signed_in=true&callback=AEngine.App.onMapLoaded#async#defer', array('aengine'), AENGINE_VERSION, true);
    }
    /**
     * @return \AEngine\Backend
     */
    public function Backend()
    {
        return Backend::getInstance();
    }

    /**
     * @return \AEngine\Front
     */
    public function Front()
    {
        return Front::getInstance();
    }

    /**
     * @return string
     */
    public function getDIR()
    {
        return AENGINE_DIR;
    }

    /**
     * @return string
     */
    public function getFILE()
    {
        return AENGINE_FILE;
    }
}