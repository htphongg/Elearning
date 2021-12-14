<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../asset/css/forgot-password.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="container padding-bottom-3x mb-2 mt-5">
	    <div class="row justify-content-center">
	        <div class="col-lg-8 col-md-10">
	            <div class="forgot">
	                <h2>Forgot your password?</h2>
	                <p>Change your password in three easy steps. This will help you to secure your password!</p>
	                <ol class="list-unstyled">
	                    <li><span class="text-primary text-medium">1. </span>Enter your email address below.</li>
	                    <li><span class="text-primary text-medium">2. </span>Our system will send you a temporary link</li>
	                    <li><span class="text-primary text-medium">3. </span>Use the link to reset your password</li>
	                </ol>
	            </div>
	            <form action="" class="card mt-4">
	                <div class="card-body">
	                    <div class="form-group"> 
                            <label for="email-for-pass">Enter your email address</label> 
                            <input class="form-control" type="text" name="email-for-pass" required="">
                            <small class="form-text text-muted">Enter the email address you used during the registration on Clone-Classroom.com . Then we'll email a link to this address.</small> 
                        </div>
	                </div>
	                <div class="card-footer"> 
                        <button class="btn btn-success" type="submit">Get New Password</button> 
                        <a href="../index.html" class="btn btn-danger">Back to Login</a> 
                    </div>
	            </form>
	        </div>
	    </div>
	</div>
</body>
</html>