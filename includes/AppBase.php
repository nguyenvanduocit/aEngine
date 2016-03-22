<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/13/2015
 * Time: 10:23 AM.
 */

namespace AEngine;

abstract class AppBase
{
    abstract public function getDIR();

    abstract public function getFILE();

	/**
	 * @return bool|array
	 */
    protected function getPostTypeClasses()
    {
        return false;
    }

	/**
	 * @return bool|array
	 */
    protected function getAPIRoutes()
    {
        return false;
    }
    public function run()
    {
        if ($this->getPostTypeClasses()) {
            add_action('init', array($this, 'registerPostTypes'));
        }
        if ($this->getAPIRoutes()) {
            add_action('rest_api_init', array($this, 'registerAPIRoutes'));
        }
    }
    public function registerAPIRoutes()
    {
        $routes = $this->getAPIRoutes();
        if ($routes) {
            foreach ($routes as $route) {

                register_rest_route($route['namespace'], $route['route'], isset($route['args'])?$route['args']:null, isset($route['override'])?$route['override']:null);
            }
        }
    }
    public function registerPostTypes()
    {
        $postTypeFactory = PostType::getInstance();
        $postTypeFactory->loadPostType($this->getPostTypeClasses());
        $postTypeFactory->init();
    }
    /**
     * @return \AEngine\Template
     */
    public function Template()
    {
        $args = array(
                'FILE' => $this->getFILE(),
                'DIR' => $this->getDIR(),
        );

        return Template::getInstance($args);
    }
}
