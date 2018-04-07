<?php
/*
Plugin Name: 2fa ethereum
Plugin URI: /
Description: Add 2factor with ethereum metamask
Author: team
Author URI: http://ottopress.com
*/

//TODO не успел сделать на бекенде проверку 

function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}    
 
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

function my_login() { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script>
	$(document).ready(function(){
		$("#wp-submit").prop("type","button");
		
		
  
		$("#wp-submit").on("click",function(){
			web3.personal.sign(web3.sha3("hello"),web3.eth.defaultAccount,function(err,hex){
				
				var newInput = $("<input name='hex' value="+hex+" id=hex type='hidden'>");
				$('input#user_login').after(newInput);
				$("#loginform").submit();
			})
		})
	})

	
	</script>
<?php }
add_action( 'login_enqueue_scripts', 'my_login' );

?>
