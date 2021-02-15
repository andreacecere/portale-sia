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
                         <li class="breadcrumb-item"><a href="/gestioneCommesse">Commesse</a></li>
                         <li class="breadcrumb-item active">Aggiungi commessa</li>
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
                 <h3 class="card-title">Aggiungi una nuova commessa</h3>

                 <div class="card-tools">
                     <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                         <i class="fas fa-minus"></i></button> -->
                 </div>
             </div>
             <div class="card-body">
                 <div class='container-fluid'>
                    <?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-12">
                        <?php $session = \Config\Services::session() ?>
                            <?php if ( isset($session->inserimento_commessa) ): ?>
                                <div class="alert alert-success" role="alert">                                
                                    Inserimento avvenuto con successo    
                                </div>
                            <?php endif; ?>
                            <?php if ( isset($session->errore_inserimento_commessa) ): ?>
                                <div class="alert alert-danger" role="alert">                                
                                    <?php echo "Errore: ".$session->errore_inserimento_commessa; ?>
                                    
                                </div>
                            <?php endif; ?>
                    </div>
                     <form method="POST">
                        <div class='row'>
                            <div class='col-md-4'>
                                <label>Nome commessa</label> <label style='color:red'> *</label>
                                <input type='text' class='form-control form-control-sm' name='nome_commessa' required minlength="2" maxlength="20">
                            </div>
                            <div class='col-md-4'>
                                <label>Settore</label> <label style='color:red'> *</label>
                                <select class='form-control form-control-sm' name='settore'>
                                    <option value='interno'>Interno</option>
                                    <option value='letture'>Letture</option>
                                    <option value='recapito'>Recapito</option>
                                    <option value='impianti'>Impianti</option>
                                </select>
                            </div>
                            <div class='col-md-4'>
                                <label>Azienda</label> <label style='color:red'> *</label>
                                <select class='form-control form-control-sm' name='azienda'>
                                    <?php 
                                        for($i=0; $i<count($aziende); $i++){
                                            echo "<option value='{$aziende[$i]['azienda_ID']}'>".$aziende[$i]['descrizione']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <button type='submit' class='btn btn-primary btn-sm'>Salva</button>
                        </form>
                     </div>
                 </div>
             </div>
             <!-- /.card-body -->
             <!-- <div class="card-footer">
                 Footer
             </div> -->
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
 </script>