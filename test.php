<?php
$twoFAAddress = '0x5df9ff716521d195de47ece76f270531add1d71a';
if (isset($_POST['data'])) {
    require 'ethereum.php';
    $eth = new Ethereum('https://ropsten.infura.io/HO2I11AcA3PD2m2dzeCE', 443);
    $call = new Ethereum_Message($twoFAAddress, $_POST['data']);
    echo hexdec($eth->eth_call($call, NULL)) == '1' ? 'true' : 'false';
} else { ?>
<!DOCTYPE html><html><head></head><body>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
var waiter = (callback) => {
    if (web3.eth.accounts.length > 0) callback()
    else setTimeout(() => waiter(callback), 1000)
}
jQuery(() => waiter(() => {
    var hash = web3.sha3((new Date()).toString())
    var user = web3.eth.defaultAccount
    web3.personal.sign(hash, user, function (error, signature) {
        var abi = [{"constant":true,"inputs":[{"name":"user","type":"address"},{"name":"hash","type":"bytes32"},{"name":"signature","type":"bytes"}],"name":"verify","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"pure","type":"function"},{"constant":false,"inputs":[{"name":"user","type":"address"},{"name":"hash","type":"bytes32"},{"name":"signature","type":"bytes"}],"name":"login","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"anonymous":false,"inputs":[{"indexed":false,"name":"user","type":"address"},{"indexed":false,"name":"hash","type":"bytes32"},{"indexed":false,"name":"signature","type":"bytes"},{"indexed":false,"name":"result","type":"bool"}],"name":"LoginAttempt","type":"event"}]
        var contract = web3.eth.contract(abi).at('<?php echo $twoFAAddress; ?>')
        var data = contract.login.getData(user, hash, signature)
        jQuery.post('http://blagosoft.ru/2fa/test.php', {data: data}, (result) => alert(result))
})}))
</script></body></html><?php } ?>