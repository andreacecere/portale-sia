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
                         <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                         <li class="breadcrumb-item"><a href="/gestioneStati">Lista Stati</a></li>
                         <li class="breadcrumb-item">Aggiungi condizione</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card card-outline card-primary">
             <div class="card-header"  style="background-color: white;">
                 <h6>Aggiungi Stato</h6>
                 <div class="card-tools">
                     <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                         <i class="fas fa-minus"></i></button> -->
                 </div>
             </div>
            <div class='card-body'>
                <div class="col-12">
                    <?php $session = \Config\Services::session() ?>
                        <?php if ( isset($session->inserimento_stato) ): ?>
                            <div class="alert alert-success" role="alert">                                
                                Inserimento avvenuto con successo    
                            </div>
                        <?php endif; ?>
                        <?php if ( isset($session->errore_inserimento_stato) ): ?>
                            <div class="alert alert-danger" role="alert">                                
                                <?php echo "Errore: ".$session->errore_inserimento_stato; ?>
                                
                            </div>
                    <?php endif; ?>
                </div>
                <form method="POST">        
                    <div class='container-fluid'>
                        <div class='row'>
                            <div class='col-md-12'>
                                <label>Stato</label><label style='color:red;'> *</label>
                                <input type='text' class='form-control ' required minlength="4" maxlength="100" autofocus name='nuovo_stato'>
                            </div>
                        </div>
                        <br>
                        <button type='submit' class='btn btn-primary btn-sm'>Salva</button>
                    </div>
                </form>
            </div>
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->