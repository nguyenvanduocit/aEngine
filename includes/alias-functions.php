<?php
function AE_GET($var){
	return \AEngine\Util::GET($var);
}
function AE_POST($var){
	return \AEngine\Util::POST($var);
}
function ae_get_option($key, $default = null){
	return apply_filters('ae_get_option', $key, $default);
}
function ae_set_option($key, $value){
	return apply_filters('ae_set_option', $key, $value);
}
function ae_set_default_option($key, $value){
	return apply_filters('set_default_option', $key, $value);
}