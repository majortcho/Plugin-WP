<?php
if(!is_user_logged_in()){
?>    
<script>
if(window.location.href != 'https://kreon.shop/login'){
    window.location.replace('https://kreon.shop/login');
}
</script>
<?php
}
?>