<?php

/*
Plugin Name: WP Taxonomy Custom Fields
Plugin URI: https://github.com/bluesuiter/wp-taxonomy-custom-fields.git
Description: 
Version: 0.7.18
Author: Script-Recipes
Author URI: https://www.facebook.com/Script-Recipes-252174671855204/
Donate link: 
License: GPL3
*/

if(!defined('ABSPATH'))
{
    die();
}

function myplugin_update_db_check() {
    if(get_site_option('wtcf_version') != '0.7.18') {
        update_site_option('wtcf_version', '0.7.18');
    }
}
add_action('plugins_loaded', 'myplugin_update_db_check');

if(file_exists(plugin_dir_path(__FILE__).'helper.php'))
{
    require_once(plugin_dir_path(__FILE__).'helper.php');
}

_bsigLodFile(plugin_dir_path(__FILE__).'wtcf-admin-interface.php');
$site_taxonomies = array_column(get_object_taxonomies('post', 'name'), 'name');
$wtcfAdmin = new wtcfAdmin();
$wtcfAdmin->taxonomyList = $site_taxonomies;
$wtcfAdmin->_wtcfTrigger();

function _wtcfScript()
{
    wp_enqueue_media(); 
    wp_enqueue_script('wtcf', plugin_dir_url(__FILE__) . 'js/image-upload-script.js', 'jquery', '0.7.18', true);
}
add_action('admin_enqueue_scripts',  '_wtcfScript');

foreach($wtcfAdmin->taxonomyList as $taxonomy)
{
    add_action('edited_' . $taxonomy, array($wtcfAdmin, 'save_taxonomy_custom_meta'), 10, 2);
    add_action('create_' . $taxonomy, array($wtcfAdmin, 'save_taxonomy_custom_meta'), 10, 2);
}
