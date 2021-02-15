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
                         <li class="breadcrumb-item"><a href="/gestioneUtenti">Gestione utenti</a></li>
                         <li class="breadcrumb-item"><?php echo ucfirst($utente[0]['nome'])." ".ucfirst($utente[0]['cognome']); ?></li>
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
                 <h6>Dettaglio utente</h6>
                 <div class="card-tools">
                     <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                         <i class="fas fa-minus"></i></button> -->
                 </div>
             </div>
             
            <div class='card-body'>
                <h6>Dati accesso piattaforma</h6>
                <br>               
                <div class="col-12">
                    <?php $session = \Config\Services::session() ?>
                        <?php if ( isset($session->aggiorna_utente) ): ?>
                            <div class="alert alert-success" role="alert">                                
                                L'operazione è stata conclusa con successo
                            </div>
                        <?php endif; ?>
                        <?php if ( isset($session->errore_aggiorna_utente) ): ?>
                            <div class="alert alert-danger" role="alert">                                
                                Inserimento non avvenuto
                            </div>
                        <?php endif; ?>
                </div>
                <form method="POST">        
                    <div class='container-fluid'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <label>Username</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo strtolower($utente[0]['username']); ?>' readonly maxlength="40">
                            </div>
                            <div class='col-md-6'>
                                <label>Password</label>
                                <input type='password' class='form-control form-control-sm' name='password'>
                            </div>
                            <div class='col-md-6'>
                                <label>Stato</label>
                                <select class='form-control form-control-sm' name='stato'>
                                    <?php
                                        if ( $utente[0]['utente_attivo'] == "1" ){            
                                            echo "<option value='1' selected>ATTIVO</option>";
                                            echo "<option value='0' >NON ATTIVO</option>";
                                        }
                                        else{
                                            echo "<option value='1'>ATTIVO</option>";
                                            echo "<option value='0' selected>NON ATTIVO</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='col-md-6'>
                                <label>Ruolo</label>
                                <select class='form-control form-control-sm ruolo' name='ruolo'>
                                <?php 
                                    for($i=0; $i<count($ruoli); $i++){
                                        if ( $utente[0]['ruolo'] == $ruoli[$i]['descrizione'] )
                                            echo "<option value='{$ruoli[$i]['ruolo_utente_id']}' selected>".$ruoli[$i]['descrizione']."</option>";
                                        else
                                            echo "<option value='{$ruoli[$i]['ruolo_utente_id']}'>".$ruoli[$i]['descrizione']."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div class='col-md-6'>
                                <label>Data creazione</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo date('d/m/Y',strtotime($utente[0]['data_creazione'])); ?>' readonly>
                            </div>
                        </div>
                        <div class='row'>                       
                        </div>
                    </div>
                </div>
                <div class="card-footer" style='background-color:white;'>
                    <h6>Dati profilo</h6>
                    <br>
                    <div class='container-fluid'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <label>Nome</label><label style='color:red;'> *</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo ucfirst($utente[0]['nome']); ?>' required minlength="4" maxlength="20" name='nome'>
                            </div>
                            <div class='col-md-6'>
                                <label>Cognome</label><label style='color:red;'> *</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo ucfirst($utente[0]['cognome']); ?>' required minlength="4" maxlength="20" name='cognome'>
                            </div>
                            <div class='col-md-6'>
                                <label>Email</label><label style='color:red;'> *</label>
                                <input type='email' class='form-control form-control-sm' value='<?php echo $utente[0]['email']; ?>' required maxlength="50" name='email'>
                            </div>
                            <div class='col-md-6'>
                                <label>Azienda</label>
                                <select class='form-control form-control-sm' name='azienda'>
                                    <?php 
                                        for($i=0; $i<count($aziende); $i++){
                                            if ( $utente[0]['azienda'] == $aziende[$i]['descrizione'] )
                                                echo "<option value='{$aziende[$i]['azienda_ID']}' selected>".$aziende[$i]['descrizione']."</option>";
                                            else
                                                echo "<option value='{$aziende[$i]['azienda_ID']}' >".$aziende[$i]['descrizione']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='col-md-6'>
                                <label>Commessa</label>
                                <select class='form-control form-control-sm' name='commessa'>
                                    <?php 
                                        for($i=0; $i<count($commessa); $i++){
                                            if ( $utente[0]['commessa'] == $commessa[$i]['descrizione'] )
                                                echo "<option value='{$commessa[$i]['commessa_id']}' selected>".$commessa[$i]['descrizione']."</option>";
                                            else
                                                echo "<option value='{$commessa[$i]['commessa_id']}' >".$commessa[$i]['descrizione']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='col-md-6'>
                                <label>Codice fiscale</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo $utente[0]['codice_fiscale']; ?>' readonly>
                            </div>
                        </div>
                        <hr>
                        <button type='submit' class='btn btn-primary btn-sm'>Salva</button>
                    </div>
                </div>
             </form>
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->