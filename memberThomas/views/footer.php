<?php
    if(is_user_logged_in()) {
        $user = wp_get_current_user();
        $roles = ( array )$user->roles;
        $role = implode(",", $roles);
    echo "<script type='text/javascript'>var role ='$role';</script>";
    }
?>
<script type="text/javascript">
    window.onload = userRole();
    function userRole() {
        if(typeof role !== 'undefined'){
            if(role == 'zenith'){
                if(window.location.href == 'https://kreon.shop/login' || window.location.href == 'https://kreon.shop/zenith-download'){

                }else{
                    window.location.replace("https://kreon.shop/zenith-download");
                }
            }
        }
    }
    if(role == 'zenith') {
        if(document.getElementById('menu-zenith-menu')){
            document.getElementById('menu-zenith-menu').style.display = "none";
        }
        if(document.getElementById('top-header')){
            document.getElementById('top-header').style.display = "none";
        }
    }
</script>
