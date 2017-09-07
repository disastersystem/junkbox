<link rel="stylesheet" href="css/loginModal.css"/>

<div class="modal loginRegisterModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content register-content">

			<!-- Tabs -->
			<ul class="nav nav-tabs">
			  <li role="presentation" tabRole = "login" class="active"><a href="#" onClick = "toggleTab('login');">Login</a></li>
			  <li role="presentation" tabRole = "register" ><a href="#" onClick = "toggleTab('register');">Register</a></li>
			</ul>

			<!-- <div class = "exitModal">x</div> -->

			<!-- Login content -->
			<div class = "contentType" role = "login">
				<form name="input" action="API/read/login.php" method="POST" id="loginForm">
					<div class="modal-body login-body">
						<p class="username">Username:</p>
						<input type="text" class="form-control username" name="txt_username" placeholder="username">
						<p class="password">Password:</p>
						<input type="password" class="form-control password" name="txt_password" placeholder="password">
					</div>
					<div class="errorMessages"><!-- error messages goes here --></div>
					<div class="modal-footer login-footer">
						<button type="submit" style = "background: #796d9e;" name="btn-login" class="btn">Login</button>
						<button class = "exitModal">Close</button>
					</div>
				</form>
			</div>
			<!-- END Login content -->

			<!-- Register content -->
			<div class = "contentType" role = "register" style = "display:none;">
				<form name="input" action="API/create/register.php" method="POST" id="registerForm">
					<div class="modal-body register-body">
						<p class="username">Username:</p>
						<input type="text" class="form-control username" name="txt_username_reg" placeholder="username">
						<p class="password">Password:</p>
						<input type="password" class="form-control password" name="txt_password_reg" placeholder="password">
					</div>
					<div class="errorMessages"><!--error messages goes here--></div>
					<div class="modal-footer register-footer">
						<button type="submit" style = "background: #008576;" name="btn-signup" class="btn">Register</button>
						<button class = "exitModal">Close</button>
					</div>
				</form>
			</div>
			<!-- END Register content -->


		</div>
		<script>
			function toggleTab(content)
			{
				// Reset:
				$('.contentType').css('display','none');
				$('.nav-tabs>li').attr('class','');

				$('.errorMessages').text("");

				// Set active:
				$('.contentType[role='+content+']').css('display','block');

				$('.nav-tabs>li[tabRole='+content+']').addClass('active');
			}
		</script>
	</div>
</div>
