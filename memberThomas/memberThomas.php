<?php

/*
Plugin Name: Member Thomas
Description: Test de création de membre
Author: Thomas Gamez
Version: 0.0.1
*/

if ( ! defined( 'ABSPATH' ) )
	exit;

define ('THOMAS_PLUGIN_DIR', plugin_dir_path(__FILE__));
require THOMAS_PLUGIN_DIR.'vendor/autoload.php';

$plugin = new \Thomas\MemberThomas\memberPlugin(__FILE__);