<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <form action="<?=base_url('index.php/user/login')?>" method="post" id="login-form">
                <?php 
                $error = $this->session->flashdata('login_error'); 
                if ($error) { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong><?=$error?></strong>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label for="username" class="control-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required="required">
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-success" id="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
