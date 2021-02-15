<div class="login-box">
    <div class="login-logo">
        <b>Gestione </b>Materiale</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Benvenuto</p>
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <form class="" action="" method="post">
                <div class="input-group mb-3">
                    <input type="username" class="form-control" name="username" id="username" value="<?= set_value('username') ?>" placeholder="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?php if (isset($validation)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <!--<div class="row">
                    <div class="col-12">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Resta connesso
                            </label>
                        </div>
                    </div>
                </div> -->
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Accedi</button>
                </div>
            </form>
            <!-- <p class="mb-1">
                <a href="reimposta_password">Password dimenticata</a>
            </p> -->
        </div>
    </div>
</div>