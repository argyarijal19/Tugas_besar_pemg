<!DOCTYPE html>
<html lang="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login dengan CodeIgniter 3 &raquo; Jaranguda.com</title>
	<link href="<?= base_url();?>/assets/login.css" rel="stylesheet">
</head>

<body>
	<h2>Login To Get You API Access</h2>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="<?php echo base_url('auth/register') ?>" method="POST">
				<?php echo form_open('auth/register'); ?>
				<?php echo validation_errors(); ?>
					<h1>Create Account</h1>
					<div class="social-container">
					</div>
					<span>create username and password for registration</span>
					<input type="text" class="form-control" name="username" placeholder="Nama">
					<input type="password" class="form-control" name="password" placeholder="Password">
					<input type="password" class="form-control" name="password2" placeholder="Confirm Password">
					<button>Sign Up</button>
				<?php echo form_close(); ?>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="<?php echo base_url('auth/login') ?>" method="POST">
				<h1>Sign in</h1>
				<div class="social-container">
				</div>
				<span>Use Your Account</span>
				<input type="text" class="form-control" id="username" name="username" placeholder="Username">
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				<br>
				<button>Sign In</button>
				<?php if ($this->session->flashdata('msg')) { ?>
					<script>
						alert('<?= $this->session->flashdata('msg') ?> ')
					</script>
				<?php } ?>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal info</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>Make Your Username and SignUp Now!!</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>
</html>