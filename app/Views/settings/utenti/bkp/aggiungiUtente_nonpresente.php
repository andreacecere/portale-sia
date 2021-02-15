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
                         <li class="breadcrumb-item active">Crea utente</li>
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
                 <h3 class="card-title">Crea</h3>

                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                         <i class="fas fa-minus"></i></button>
                     <!--<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                         <i class="fas fa-times"></i></button>-->
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
                            <?php if ( isset($session->success) ): ?>
                                <div class="alert alert-success" role="alert">                                
                                    Inserimento avvenuto con successo    
                                </div>
                            <?php endif; ?>
                            <?php if ( isset($session->errore) ): ?>
                                <div class="alert alert-danger" role="alert">                                
                                    Si è verificato una problematica durante l'inserimento delle informazioni
                                </div>
                            <?php endif; ?>
                    </div>
                     <form method="POST">
                         
                            <div class='row'>
                                <div class='col-md-6'>
                                    <label>Nome</label> <label style='color:red'> *</label>
                                    <input type='text' class='form-control form-control-sm' name='nome' minlength="4" maxlength="20">
                                </div>
                                <div class='col-md-6'>
                                    <label>Cognome</label> <label style='color:red'> *</label>
                                    <input type='text' class='form-control form-control-sm' name='cognome' minlength="4" maxlength="20">
                                </div>
                                <div class='col-md-6'>
                                    <label>Codice fiscale</label>
                                    <input type='text' class='form-control form-control-sm' name='codice_fiscale' maxlength="20">
                                </div>
                                <div class='col-md-6'>
                                    <label>Indirizzo</label>
                                    <input type='text' class='form-control form-control-sm' name='indirizzo' maxlength="20">
                                </div>
                                <div class='col-md-6'>
                                    <label>Località</label>
                                    <input type='text' class='form-control form-control-sm' name='localita' maxlength="20">
                                </div>
                                <div class='col-md-6'>
                                    <label>Recapito telefonico</label>
                                    <input type='text' class='form-control form-control-sm' name='recapito_telefonico' maxlength="20">
                                </div>
                                <div class='col-md-6'>
                                    <label>Email</label>
                                    <input type='email' class='form-control form-control-sm' name='email' maxlength="30">
                                </div>
                                <div class='col-md-6'>
                                    <label>Password</label> <label style='color:red'> *</label>
                                    <input type='password' class='form-control form-control-sm' name='password' maxlength="20" value='password' readonly>
                                </div>
                                <div class='col-md-6'>
                                    <label>Stato</label>
                                    <select class='form-control form-control-sm' name='attivo'>
                                        <option value="1">ATTIVO</option>
                                        <option value="0">NON ATTIVO</option>
                                    </select>
                                    <br>
                                </div>
                                <div class='col-md-6'>
                                    <label>Commesse</label>
                                    <!-- Attenzione, qui la scelta della commessa è unica non multipla!! -->
                                    <select class="js-example-basic-multiple" name="commesse[]" multiple="multiple" style='width:100%'>
                                        <?php 
                                            for($i=0; $i<count($commesse); $i++){
                                                echo "<option value='{$commesse[$i]['commessa_id']}'>".$commesse[$i]['descrizione']."</option>";
                                            }
                                        ?>
                                        <!-- <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option> -->
                                    </select>
                                    <br>
                                </div>
                            </div>
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