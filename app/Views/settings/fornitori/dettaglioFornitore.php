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
                         <li class="breadcrumb-item"><a href="/gestioneFornitori">Lista fornitori</a></li>
                         <li class="breadcrumb-item"><?php echo ucfirst(strtolower($fornitore[0]['ragione_sociale'])); ?></li>
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
                 <h6>Informazioni fornitore</h6>
                 <div class="card-tools">
                     <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                         <i class="fas fa-minus"></i></button> -->
                 </div>
             </div>
            <div class='card-body'>
                <div class="col-12">
                    <?php $session = \Config\Services::session() ?>
                        <?php if ( isset($session->modifica_fornitore) ): ?>
                            <div class="alert alert-success" role="alert">                                
                                Aggiornamento avvenuto con successo    
                            </div>
                        <?php endif; ?>
                        <?php if ( isset($session->errore_modifica_fornitore) ): ?>
                            <div class="alert alert-danger" role="alert">                                
                                <?php echo "Errore: ".$session->errore_modifica_fornitore; ?>
                            </div>
                    <?php endif; ?>
                </div>
                <form method="POST">        
                    <div class='container-fluid'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <label>Ragione sociale</label><label style='color:red;'> *</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo ucfirst(strtolower($fornitore[0]['ragione_sociale'])); ?>' required minlength="4" maxlength="100" name='ragione_sociale' autofocus>
                            </div>
                            <div class='col-md-6'>
                                <label>P.IVA</label><label style='color:red;'> *</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo strtolower($fornitore[0]['partita_iva']); ?>' required minlength="4" maxlength="20" name='partita_iva'>
                            </div>
                            <div class='col-md-6'>
                                <label>Codice fiscale</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo strtolower($fornitore[0]['codice_fiscale']); ?>' minlength="4" maxlength="20" name='codice_fiscale'>
                            </div>
                            <div class='col-md-6'>
                                <label>Indirizzo</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo strtolower($fornitore[0]['indirizzo']); ?>' minlength="4" maxlength="100" name='indirizzo'>
                            </div>
                            <div class='col-md-6'>
                                <label>Localita</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo strtolower($fornitore[0]['localita']); ?>' maxlength="100" name='localita'>
                            </div>
                            <div class='col-md-6'>
                                <label>Telefono</label>
                                <input type='text' class='form-control form-control-sm' value='<?php echo strtolower($fornitore[0]['telefono']); ?>' maxlength="20" name='telefono'>
                            </div>
                            <div class='col-md-6'>
                                <label>Email</label>
                                <input type='email' class='form-control form-control-sm' value='<?php echo strtolower($fornitore[0]['email']); ?>' maxlength="100" name='email'>
                            </div>
                            <div class='col-md-6'>
                                <label>PEC</label>
                                <input type='email' class='form-control form-control-sm' value='<?php echo strtolower($fornitore[0]['pec']); ?>' maxlength="100" name='pec'>
                            </div>
                            <div class='col-md-6'>
                                 <label>Tipologia</label>
                                 <select class='form-control select2bs4' id='tipologia' name='tipologia'
                                     style='width:100%'>
                                     <?php 
                                        for($i=0; $i<count($tipologia); $i++){
                                            if ( $fornitore[0]['descrizione_tipologia_fornitore'] == $tipologia[$i]['descrizione'] )
                                                echo "<option value='{$tipologia[$i]['id_tipologia_fornitore']}' selected>".ucfirst(strtolower($tipologia[$i]['descrizione']))."</option>";
                                            else
                                                echo "<option value='{$tipologia[$i]['id_tipologia_fornitore']}'>".ucfirst(strtolower($tipologia[$i]['descrizione']))."</option>";
                                        }
                                    ?>
                                 </select>
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