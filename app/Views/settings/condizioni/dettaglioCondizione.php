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
                         <li class="breadcrumb-item"><a href="/gestioneCondizioni">Gestione condizioni</a></li>
                         <li class="breadcrumb-item"><?php echo ucfirst(strtolower($attributi[0]['tipo_articolo_descrizione'])); ?></li>
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
                 <h6>Informazioni condizione</h6>
                 <div class="card-tools">
                     <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                         <i class="fas fa-minus"></i></button> -->
                 </div>
             </div>
            <br>
            <div class="col-12">
                <?php $session = \Config\Services::session() ?>
                    <?php if ( isset($session->aggiornamento_condizione) ): ?>
                        <div class="alert alert-success" role="alert">                                
                            Modifica avvenuta con successo    
                        </div>
                    <?php endif; ?>
                    <?php if ( isset($session->errore_aggiornamento_condizione) ): ?>
                        <div class="alert alert-danger" role="alert">                                
                            <?php echo "Errore: ".$session->errore_aggiornamento_condizione; ?>
                            
                        </div>
                    <?php endif; ?>
            </div>
            <div class='card-body'>
                <form method="POST">        
                    <div class='container-fluid'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <label>Articolo</label>
                                <input type='text' class='form-control form-control-sm' value="<?php echo ucfirst(strtolower($attributi[0]['tipo_articolo_descrizione'])); ?>" required minlength="4" maxlength="100" name='articolo' readonly>
                            </div>
                            <div class='col-md-6'>
                                <label>Condizione</label>
                                <select class='form-control form-control-sm' name='condizione'>
                                    <?php 
                                        for($i=0; $i<count($articoli); $i++){
                                            if ( $attributi[0]['articolo_condizione'] == $articoli[$i]['descrizione'])
                                                echo "<option value='{$articoli[$i]['condizione_id']}' selected>".ucfirst($articoli[$i]['descrizione'])."</option>";
                                            else
                                                echo "<option value='{$articoli[$i]['condizione_id']}'>".ucfirst($articoli[$i]['descrizione'])."</option>";
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