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
                         <li class="breadcrumb-item"><a href="/gestioneCommesse">Gestione commesse</a></li>
                         <li class="breadcrumb-item"><?php echo ucfirst(strtolower($commessa[0]['descrizione'])); ?></li>
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
                 <h6>Informazioni commessa</h6>
                 <div class="card-tools">
                     <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                         <i class="fas fa-minus"></i></button> -->
                 </div>
             </div>
            <br>
            <div class="col-12">
                <?php $session = \Config\Services::session() ?>
                    <?php if ( isset($session->inserimento_commessa) ): ?>
                        <div class="alert alert-success" role="alert">                                
                            Modifica avvenuta con successo    
                        </div>
                    <?php endif; ?>
                    <?php if ( isset($session->errore_modifica) ): ?>
                        <div class="alert alert-danger" role="alert">                                
                            <?php echo "Errore: ".$session->errore_modifica; ?>
                            
                        </div>
                    <?php endif; ?>
            </div>

            <div class='card-body'>
                <form form method="POST">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nome della commessa</label>
                        <div class="col-sm-10">
                            <input type='text' class='form-control' value="<?php echo ucfirst(strtolower($commessa[0]['descrizione'])); ?>" required minlength="4" maxlength="100" name='nome_commessa'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Settore della commessa</label>
                        <div class="col-sm-10">
                            <select class='form-control select2bs4 form-control-sm' name='settore'>
                                <?php 
                                    for($i=0; $i<count($settori); $i++){
                                        if ( $commessa[0]['settore'] == $settori[$i]['settore'])
                                            echo "<option selected>".ucfirst($settori[$i]['settore'])."</option>";
                                        else
                                            echo "<option>".ucfirst($settori[$i]['settore'])."</option>";
                                    }
                                ?> 
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Azienda di riferimento</label>
                        <div class="col-sm-10">
                            <select class='form-control select2bs4 form-control-sm' name='azienda'>
                                <?php 
                                    for($i=0; $i<count($aziende); $i++){
                                        if ( $commessa[0]['azienda'] == $aziende[$i]['descrizione'])
                                            echo "<option value='{$aziende[$i]['azienda_ID']}'selected>".$aziende[$i]['descrizione']."</option>";
                                        else
                                            echo "<option value='{$aziende[$i]['azienda_ID']}'>".$aziende[$i]['descrizione']."</option>";
                                    }
                                ?> 
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Responsabile di riferimento</label>
                        <div class="col-sm-10">
                            <select class='form-control select2bs4 form-control-sm' name='responsabile'>
                                <?php 
                                    for($i=0; $i<count($responsabile); $i++){
                                        //echo "<option value='{$responsabile[$i]['anagrafica_id']}'>".ucfirst($responsabile[$i]['nominativo_responsabile'])."</option>";
                                        if ( $commessa[0]['nominativo_responsabile'] == $responsabile[$i]['nominativo_responsabile'])
                                            echo "<option value='{$responsabile[$i]['anagrafica_id']}'selected>".$responsabile[$i]['nominativo_responsabile']."</option>";
                                        else
                                            echo "<option value='{$responsabile[$i]['anagrafica_id']}'>".$responsabile[$i]['nominativo_responsabile']."</option>";
                                    }
                                ?> 
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Magazzino/Sede</label>
                        <div class="col-sm-10">
                            <select class='form-control select2bs4 form-control-sm' name='magazzino_sede'>
                                <?php 
                                    for($i=0; $i<count($magazzino); $i++){
                                        if ( $commessa[0]['descrizioneMagazzino'] == $magazzino[$i]['descrizioneMagazzino'])
                                            echo "<option value='{$magazzino[$i]['magazzino_id']}' selected>".$magazzino[$i]['descrizioneMagazzino']."</option>";
                                        else
                                            echo "<option value='{$magazzino[$i]['magazzino_id']}'>".$magazzino[$i]['descrizioneMagazzino']."</option>";
                                    }
                                ?> 
                            </select>
                        </div>
                    </div>
                    <button type='submit' class='btn btn-primary btn-sm'>Salva</button>
                </form>

            </div>

            <!-- <div class='card-body'>
                <form method="POST">        
                    <div class='container-fluid'>
                        <div class='row'>
                            <div class='col-md-3'>
                                <label>Commessa</label><label style='color:red;'> *</label>
                                <input type='text' class='form-control form-control-sm' value="<?php echo ucfirst(strtolower($commessa[0]['descrizione'])); ?>" required minlength="4" maxlength="100" name='nome_commessa'>
                            </div>
                            <div class='col-md-3'>
                                <label>Settore</label>
                                <select class='form-control form-control-sm' name='settore'>
                                    <?php 
                                        for($i=0; $i<count($settori); $i++){
                                            if ( $commessa[0]['settore'] == $settori[$i]['settore'])
                                                echo "<option selected>".$settori[$i]['settore']."</option>";
                                            else
                                                echo "<option>".$settori[$i]['settore']."</option>";
                                        }
                                    ?> 
                                </select>
                            </div>
                            <div class='col-md-3'>
                                <label>Azienda</label>
                                <select class='form-control form-control-sm' name='azienda'>
                                    <?php 
                                        for($i=0; $i<count($aziende); $i++){
                                            if ( $commessa[0]['azienda'] == $aziende[$i]['descrizione'])
                                                echo "<option value='{$aziende[$i]['azienda_ID']}'selected>".$aziende[$i]['descrizione']."</option>";
                                            else
                                                echo "<option value='{$aziende[$i]['azienda_ID']}'>".$aziende[$i]['descrizione']."</option>";
                                        }
                                    ?> 
                                </select>
                            </div>
                            <div class='col-md-3'>
                                <label>Azienda</label>
                                <select class='form-control form-control-sm' name='azienda'>
                                    <?php 
                                        for($i=0; $i<count($aziende); $i++){
                                            if ( $commessa[0]['azienda'] == $aziende[$i]['descrizione'])
                                                echo "<option value='{$aziende[$i]['azienda_ID']}'selected>".$aziende[$i]['descrizione']."</option>";
                                            else
                                                echo "<option value='{$aziende[$i]['azienda_ID']}'>".$aziende[$i]['descrizione']."</option>";
                                        }
                                    ?> 
                                </select>
                            </div>
                        </div>
                        <br>
                        <button type='submit' class='btn btn-primary btn-sm'>Salva</button>
                    </div>
                </form>
            </div> -->
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->