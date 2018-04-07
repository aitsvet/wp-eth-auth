<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<noindex>
<?php

require 'ethereum.php';

$ethereum = new Ethereum('https://ropsten.infura.io/HO2I11AcA3PD2m2dzeCE', 443);

echo $ethereum->net_version();
?>
</noindex>
</body>
</html>