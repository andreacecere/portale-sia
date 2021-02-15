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
                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                         <li class="breadcrumb-item active"><a href='/inserisciAttestato'>Gestione attestati</a></li>
                         <li class="breadcrumb-item active"><?php echo strtoupper($attestato[0]['descrizione']); ?></li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title">Dettaglio</h3>

                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                         title="Collapse">
                         <i class="fas fa-minus"></i></button>
                 </div>
             </div>
             <div class="card-body">
                 <?php $session = \Config\Services::session() ?>
                 <?php if ( isset($session->modifica_attestato) ): ?>
                 <div class="alert alert-success" role="alert">
                     Modifica avvenuta con successo
                 </div>
                 <?php endif; ?>
                 <?php if ( isset($session->errore_inserimento_commessa) ): ?>
                 <div class="alert alert-danger" role="alert">
                     <?php echo "Errore: ".$session->errore_inserimento_commessa; ?>

                 </div>
                 <?php endif; ?>

                 <form method="post">
                     <div class="form-row">
                         <div class="form-group col-md-4">
                             <label for="inputEmail4">Descrizione</label>
                             <input type="text" class="form-control" minlength='3' maxlength='255' name='descrizione'
                                 required value='<?php echo $attestato[0]['descrizione']; ?>'>
                         </div>
                         <div class="form-group col-md-4">
                             <label for="inputPassword4">Durata in mesi</label>
                             <input type="number" class="form-control" min='1' max='90' name='durata_in_mesi' required value=<?php echo $attestato[0]['durata_mesi']; ?>> 
                         </div>
                         <div class="form-group col-md-4">
                         <?php 
                            
                         ?>
                             <label for="inputPassword4">Visibile</label>
                             <select class='form-control' name='visibile'>
                             <?php 
                                if ( $attestato[0]['visibile'] == 1 ){
                                    echo "<option value='1' selected>Si</option>";
                                    echo "<option value='0'>No</option>";
                                }
                                else{
                                    echo "<option value='1'>Si</option>";
                                    echo "<option value='0' selected>No</option>";
                                }
                             ?>
                             </select>
                         </div>
                     </div>
                     <button type='submit' class='btn btn-success btn-sm'>Modifica informazioni attestato</button>
                 </form>
                 
             </div>
             <!-- /.card-body -->
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->