<div class="col-xs-6 log-button">
    <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm"><h4>Login</h4></a>
</div> <!-- login button-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content login-content">
        <div class="modal-header login-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Login</h4>
        </div>
            <form name="input" action="API/read/login.php" method="POST" id="loginForm">
                <div class="modal-body login-body">
                    <p class="username">Username:</p>
                    <input type="text" class="form-control username" name="txt_username" placeholder="username" value="<?php if(isset($error)){echo $uname;}?>">
                    <p class="password">Password:</p>
                    <input type="password" class="form-control password" name="txt_password" placeholder="password">
                </div>
                <div class="errorMessages"><!-- error messages goes here --></div>
                <div class="modal-footer login-footer">
                    <button type="submit" name="btn-login" class="btn">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
