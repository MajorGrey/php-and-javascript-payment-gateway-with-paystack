<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700" rel="stylesheet">
<title>PHP payment gateway </title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<style type="text/css">
	body{
		color: #999;
		background: #e2e2e2;
		font-family: 'Roboto', sans-serif;
	}
	.form-control{
		min-height: 41px;
		box-shadow: none;
		border-color: #e1e1e1;
	}
	.form-control:focus{
		border-color: #00cb82;
	}	
    .form-control, .btn{        
        border-radius: 3px;
    }
	.form-header{
		margin: -30px -30px 20px;
		padding: 30px 30px 10px;
		text-align: center;
		background: #00cb82;
		border-bottom: 1px solid #eee;
		color: #fff;
	}
	.form-header h2{
		font-size: 34px;
		font-weight: bold;
        margin: 0 0 10px;
		font-family: 'Pacifico', sans-serif;
    }
	.form-header p{
		margin: 20px 0 15px;
		font-size: 17px;
		line-height: normal;
		font-family: 'Courgette', sans-serif;
	}
    .signup-form{
		width: 390px;
		margin: 0 auto;	
		padding: 30px 0;	
	}
    .signup-form form{
		color: #999;
		border-radius: 3px;
    	margin-bottom: 15px;
        background: #f0f0f0;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
	.signup-form .form-group{
		margin-bottom: 20px;
	}		
	.signup-form label{
		font-weight: normal;
		font-size: 13px;
	}
    .signup-form input[type="checkbox"]{
		margin-top: 2px;
	}
    .signup-form .btn{        
        font-size: 16px;
        font-weight: bold;
		background: #00cb82;
		border: none;
		min-width: 200px;
    }
	.signup-form .btn:hover, .signup-form .btn:focus{
		background: #00b073 !important;
        outline: none;
	}
    .signup-form a{
		color: #00cb82;		
	}
    .signup-form a:hover{
		text-decoration: underline;
	}
</style>
</head>
<body>
<div class="signup-form">
    <form action="javascript:void()		">
		<!-- <div class="form-header">
			<h2>Make Payment</h2>
			<p>Fill this to make your payment</p>
		</div> -->
        <div class="form-group">
			<label>Name</label>
        	<input type="text" class="form-control" id="name" >
        </div>
        <div class="form-group">
			<label>Email Address</label>
        	<input type="email" class="form-control" id="email">
        </div>
		<div class="form-group">
			<label>Mobile No</label>
            <input type="number" class="form-control" id="mobile">
        </div>
		<div class="form-group">
			<label>Amount</label>
            <input type="number" class="form-control" id="amount" >
        </div>        
        <div class="form-group">
			<label class="checkbox-inline"><input type="checkbox" > I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
		</div>
		<div class="form-group">
			<button id="pay" class="btn btn-primary btn-block btn-lg">Pay</button>
		</div>
		<div class="form-group">
			<center><p>Check all transactions <a href="trans.php">here</a></p></center>
			<center><p class="text-muted">&copy <?php echo date("Y"); ?> <a class="" href="https://chuksokwuenu.com" target="_black">chuks okwuenu</a></p></center>
		</div>	
    <!-- </form> -->

</div>
</body>
<script>
	 $(document).ready(function(){
	 	$('#pay').click(function(){
	 		const email = $('#email').val();
	 		const mobile = $('#mobile').val();
	 		const name = $('#name').val();
	 		const amount = $('#amount').val();
	 		const kobo = "00" 
           	if (email == "" || mobile == "" || name == "" || amount == "") {
           		alert("filed should not be empty")
           	}else if ($('input[type=checkbox]:checked').length == 0) {
           		alert("you have not checked the box")
           	}else{
           		 var handler = PaystackPop.setup({
              key: 'pk_test_889d100bcbabfcd63113ec042ee9e16497b038dd',
              email: email,
              amount: amount+kobo,
              currency: "NGN",
              ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
              metadata: {
                 custom_fields: [
                    {
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: mobile
                    }
                 ]
              },
              callback: function(response){
                  alert('success. transaction ref is ' + response.reference);
                    $.ajax({
            	url : "server.php",
				type: "post",
				async: false,
				data: {
					"done": 1,
					"name" : name,
					"email" : email,
					"mobile" : mobile,
					"amount" : amount,
					"ref" : response.reference

				},
				success: function(data){
					console.log(data);
				}
            });
              },
              onClose: function(){
                 // window.location.href="pay.php";
              }
            });
            handler.openIframe();
    
           	}
	 	});
	 })
</script>
</html>                            