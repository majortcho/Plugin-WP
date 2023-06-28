<?php

namespace Thomas\MemberThomas\Controller;

use Thomas\MemberThomas\memberPlugin;

Class adminController{

    public function __construct(){
        $this->init_hooks();
    }
    public function init_hooks(){
        //ajout d'une catégories a la barre de menu admin
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_init', [$this, 'admin_init']);
        add_action('user_row_actions', [$this, 'usersDisplayRole']);
    }
    public function admin_menu() {
    add_menu_page( 'Member configuration', 'Member', 'manage_options', 'member-configuration', [$this, 'PluginConfiguration'], '', 24);
    }
    public function PluginConfiguration(){
        memberPlugin::render('config');
    }

    public function admin_init(){
        register_setting('member_config_general', 'member_config_general');
        add_settings_section('member_main', null, null, 'member-configuration');
        add_settings_field('create_member', 'choisir un rôle :', [$this, 'choose_member_render'], 'member-configuration', 'member_main');
    }
    public function choose_member_render(){

    }
    public function usersDisplayRole(){
        if(current_user_can('administrator')){
        }
    }


}
?>
