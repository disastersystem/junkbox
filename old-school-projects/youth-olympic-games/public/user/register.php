<!-- REGISTER -->
<div class="col-xs-6 reg-button">
    <a href="#" data-toggle="modal" data-target=".bs-register-modal-sm"><h4>Register</h4></a>
</div> <!-- register button-->
<div class="modal fade bs-register-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content register-content">
            <div class="modal-header register-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabelReg">Register</h4>
            </div>
            <form name="input" action="API/create/register.php" method="POST" id="registerForm">
                <div class="modal-body register-body">
                    <p class="username">Username:</p>
                    <input type="text" class="form-control username" name="txt_username_reg" placeholder="username" value="<?php if(isset($errorReg)){echo $uname;}?>">
                    <p class="password">Password:</p>
                    <input type="password" class="form-control password" name="txt_password_reg" placeholder="password">
                </div>
                <div class="errorMessages"><!-- error messages goes here --></div>
                <div class="modal-footer register-footer">
                    <button type="submit" name="btn-signup" class="btn">Register</button>
                </div>
            </form>
      </div>
  </div>
</div>
