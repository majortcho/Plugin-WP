<?php

namespace Thomas\MemberThomas;

use Thomas\MemberThomas\Controller\adminController;
include 'controller/adminController.php';

Class memberPlugin{
	const TRANSIENT_MEMBER_ACTIVATED = 'thomas_member_activated';
	public function __construct(string $file){
		register_activation_hook($file, [$this, 'pluginActivation']);
		add_action('admin_notices', [$this, 'noticeActivation']);
        add_action('wp_head', [$this, 'header']);
        add_action('wp_footer', [$this, 'footer']);
        add_action('after_setup_theme', [$this, 'remove_admin_bar']);
        add_filter( 'wp_nav_menu_items', [$this, 'add_loginout_link'], 10, 2 );
        add_filter('login_redirect', [$this, 'custom_login_redirect']);
        add_role( 'zenith', 'Zenith', array(
            'read' => true,
            'create_posts' => false,
            'edit_posts' => false,
            'edit_others_posts' => false,
            'publish_posts' => false,
            'manage_categories' => false,
        ));
        add_role( 'distributors', 'Distributors', array(
            'read' => true,
            'create_posts' => false,
            'edit_posts' => false,
            'edit_others_posts' => false,
            'publish_posts' => false,
            'manage_categories' => false,
        ));

        if(is_admin()){
            $adminController = new adminController();
        }
	}

	public function pluginActivation(): void{
		set_transient(self::TRANSIENT_MEMBER_ACTIVATED, true);
	}

	public function noticeActivation(){
		if(get_transient(self::TRANSIENT_MEMBER_ACTIVATED)){
            self::render('notices', ['message'=> "<strong>Thomas Member</strong> est maintenant activé!"]);
            delete_transient(self::TRANSIENT_MEMBER_ACTIVATED);
		}
	}

	public static function render(string $name, array $args = []): void{
		extract($args);

		$file = THOMAS_PLUGIN_DIR . "views/$name.php";

        ob_start();
        include_once($file);
        echo ob_get_clean();
	}
    public static function header(){
        include_once(THOMAS_PLUGIN_DIR . "views/header.php");
    }

    public static function footer(){
        include_once(THOMAS_PLUGIN_DIR . "views/footer.php");

    }
    function remove_admin_bar() {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
    }
    function add_loginout_link( $items, $args ) {
        if (is_user_logged_in() && $args->theme_location == 'primary') {
            $items .= '<li id="log"><a href="'. wp_logout_url() .'">Log Out</a></li>';
        }
        elseif (!is_user_logged_in() && $args->theme_location == 'primary') {
            $items .= '<li id="log"><a href="'. site_url('wp-login.php') .'">Log In</a></li>';
        }
        return $items;
    }
    function custom_login_redirect() {
        if(current_user_can('zenith')){
            return home_url().'/zenith-download';
        }else{
            return home_url().'/distributors-login';
        }
    }
}
?>