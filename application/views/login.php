    <?Php $v =& $this->form_validation ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Harap Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="<?php echo base_url('index.php/simas/login');?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Ingat Saya
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 alert">
                                      <p><?Php echo validation_errors(); ?></p>
                                    </div>
                                  </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>