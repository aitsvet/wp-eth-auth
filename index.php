<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Вход - CryptoBank of Pentagon Of America</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="./PentagonApp/bootstrap.css" rel="stylesheet">
	<link href="./PentagonApp/AdminLTE.min.css" rel="stylesheet">
	<link href="./PentagonApp/Main.css" rel="stylesheet">
</head>

<body class="hold-transition login-page">

<noindex>
<div class="flex-container">
    <div class="row"> 
        <div class="flex-item">
		
		<div class="box box-info">
            <!--<div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div>
             /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-8">
                    <input class="form-control" id="inputLogin" type="email" placeholder="Login">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-8">
                    <input class="form-control" id="inputPassword" type="password" placeholder="Password">
                  </div>
                </div>
                <!-- <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                  </div>
                </div>-->
                <div class="form-group text-center">
					<button class="btn btn-info" type="submit" style="width:150px;" id="sign-in">Sign in</button>
				</div>
              </div>
            </form>
          </div>
		
		</div>
		
	
    <div class="eth-net-v">
			Eth network v.<?php
				require 'ethereum.php';

				$ethereum = new Ethereum('https://ropsten.infura.io/HO2I11AcA3PD2m2dzeCE', 443);

				echo $ethereum->net_version();
			?>
		</div>
    </div>
</div>

</noindex>
</body>
</html>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="PentagonApp/Main.js"></script>

