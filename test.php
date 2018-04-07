<!DOCTYPE html>
<html><head>
    <meta http-equiv="Content-Type" content="text/plain; charset=UTF-8">
</head><body><noindex><?php
$ecrecoverAddress = '0x15130713e7a5dc999cc8ec01baf9166b9c18fc64';
if (isset($_POST['data'])) {
    require 'ethereum.php';
    $eth = new Ethereum('https://ropsten.infura.io/HO2I11AcA3PD2m2dzeCE', 443);
    $call = new Ethereum_Message($ecrecoverAddress, $_POST['data']);
    echo hexdec($eth->eth_call($call, NULL)) == '1' ? 'true' : 'false';
    ?></noindex></body></html><?php die(0);
}?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
var wait4accounts = (cb) =>
    if (web3.eth.accounts.length > 0) cb()
    else setTimeout(() => wait4accounts(cb), 1000)
jQuery(() => wait4accounts(() => {
var m = (new Date()).toString()
var h = web3.sha3(m)
var a = web3.eth.accounts[0]
web3.personal.sign(h, a, function (err, sig) {
    var r = '0x' + sig.slice(2, 66)
    var s = '0x' + sig.slice(66, 130)
    var v = '0x' + sig.slice(130, 132)
    var abi = [{"constant":true,"inputs":[{"name":"hash","type":"bytes32"},{"name":"v","type":"uint8"},{"name":"r","type":"bytes32"},{"name":"s","type":"bytes32"},{"name":"signer","type":"address"}],"name":"verify","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"pure","type":"function"}]
    var c = web3.eth.contract(abi)
    var e = '<?php echo $ecrecoverAddress; ?>'
    var i = c.at(e)
    var d = i.verify.getData(h, v, r, s, a)
    jQuery.post('http://blagosoft.ru/2fa/test.php', {data: d},
        (err, res) => alert(res))
/*    var b = {from: a, to: e, data: d}
    var bh = web3.sha3(b)
    web3.personal.sign(bh, (err, t) =>
        jQuery.post('http://blagosoft.ru/2fa/test.php',
        {data: d, tx: t},
        (err, res) => alert(res))
    )*/
})}))
</script>
</noindex>
</body>
</html>