<div class="register-box">
    <div class="register-logo">
        <a href="../../index2.html"><b>Gestione</b>Materiale</a>
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Cambia la password attuale</p>
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <form class="" action="/cambio_password" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="username" name="username" id="username" readonly value="<?= set_value('username', $user['username']) ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="nuova password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="conferma_password" id="conferma_password" value="" placeholder="conferma password">
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
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Aggiorna password</button>
                </div>
            </form>

            <a href="dashboard" class="text-center">Torna alla dashboard</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>