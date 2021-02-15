 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                         <li class="breadcrumb-item active">Cambia Password</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card card-outline card-primary">
             <div class="card-header" style='background-color:#fff'>
                 <h3 class="card-title">Cambia password</h3>

                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                         title="Collapse">
                         <i class="fas fa-minus"></i></button>
                 </div>
             </div>
             <div class="card-body">
                    <?php $session = \Config\Services::session() ?>
                        <?php if ( isset($session->cambio_avvenuto) ): ?>
                            <div class="alert alert-success" role="alert">                                
                                <?php echo $session->cambio_avvenuto; ?>  
                            </div>
                        <?php endif; ?>
                        <?php if ( isset($session->cambio_non_avvenuto) ): ?>
                            <div class="alert alert-danger" role="alert">                                
                                <?php echo "Errore: ".$session->cambio_non_avvenuto; ?>
                            </div>
                    <?php endif; ?>
                 <form method='post'>
                     <div class="form-group row">
                         <label for="inputPassword" class="col-sm-2 col-form-label">Nuova password</label>
                         <div class="col-sm-10">
                             <input type="password" class="form-control form-control-sm password" minlength='3' maxlenght='10' name='password' required>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="inputPassword" class="col-sm-2 col-form-label">Conferma password</label>
                         <div class="col-sm-10">
                             <input type="password" class="form-control form-control-sm conferma_password" minlength='3' maxlenght='10' required>
                         </div>
                     </div>
             </div>
             <div class="card-footer" style='background-color:#fff'>
                 <button type='submit' class='btn btn-success btn-sm btnAggiornaPassword'>Aggiorna la password</button>
             </div>
             </form>
             <!-- /.card-body -->
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <script>
    $(document).ready(function () {
        $('.btnAggiornaPassword').click(function(e){
            var password = $('.password').val(); 
            var conferma_password = $('.conferma_password').val(); 
            if ( password != conferma_password ){
                alert("Attenzione, le password non corrispondono"); 
                e.preventDefault(); 
            }
        })
    });
 </script>