<?php
/**
 * @package eth2fa
 * @version 0.1
 */
/*
Plugin Name: Ethereum Authorization
Plugin URI: https://github.com/aitsvet/eth2fa
Description: Ethereum Authorization
Author: Unblock Hackathon
Version: 0.1
Author URI: https://unlocktheblock.io
*/

$ecRecovererAddress = '0x006bfda698205f187c179d216ca729fa79f26ea2';
if (isset($_POST['data'])) {
    require 'ethereum.php';
    $eth = new Ethereum('https://ropsten.infura.io/HO2I11AcA3PD2m2dzeCE', 443);
    $call = new Ethereum_Message($ecRecovererAddress, $_POST['data']);
	echo $eth->eth_call($call, NULL);
	die(0);
}

function eth2fa_scripts() {
//    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js');
    wp_enqueue_script('jquery');
}
add_action('login_enqueue_scripts', 'eth2fa_scripts');

function eth2fa_head() {
?> <script type="text/javascript">
	var waiter = (callback) => {
		if (web3.eth.accounts.length > 0) callback()
		else setTimeout(() => waiter(callback), 1000)
	}
	jQuery(() => waiter(() => {
		var hash = web3.sha3((new Date()).toString())
		var user = web3.eth.defaultAccount
		web3.personal.sign(hash, user, function (error, signature) {
			var abi = [{"constant":false,"inputs":[{"name":"hash","type":"bytes32"},{"name":"signature","type":"bytes"}],"name":"recover","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"anonymous":false,"inputs":[{"indexed":false,"name":"hash","type":"bytes32"},{"indexed":false,"name":"signature","type":"bytes"},{"indexed":false,"name":"signer","type":"address"}],"name":"ECRecovery","type":"event"}]
			var contract = web3.eth.contract(abi).at('<?php echo $ecRecovererAddress; ?>')
			var data = contract.recover.getData(hash, signature)
			jQuery.post('<?php echo plugins_url( 'filename', __FILE__ );?>',
				{data: data}, (result) => alert(result))
	})}))
	</script>
<?php }
add_action('login_head', 'eth2fa_head');

?>
