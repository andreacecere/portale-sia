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
                        <li class="breadcrumb-item"><a href="/gestioneItem">Gestione Item</a></li>
                        <li class="breadcrumb-item">Aggiungi attributo</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class='container-fluid'>
            <div class='row'>
            <div class="col-12">
                <?php $session = \Config\Services::session() ?>
                    <?php if ( isset($session->inserimento_attributo_valore) ): ?>
                        <div class="alert alert-success" role="alert">                                
                            L'operazione è stata conclusa con successo
                        </div>
                    <?php endif; ?>
                    <?php if ( isset($session->errore_inserimento_valore) ): ?>
                        <div class="alert alert-danger" role="alert">                                
                            <?php echo $session->errore_inserimento_valore; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class='col-md-6'>
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header " style='background-color: white!important;'>
                            <label>Inserisci un nuovo attributo</label>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <input type="text" name="valore" class='form-control' autofocus required minlength="1" maxlength="50">
                                <br>
                                <button type="submit" class='btn btn-success btn-sm'>Registra</button>
                                <?php echo "<a href='/dettaglioItem/{$idAttributo}'><button type=\"button\" class='btn btn-primary btn-sm'>Torna al dettaglio</button></a>"; ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card card-warning card-outline card-tabs">
                        <div class="card-header" style='background-color: white!important;'>
                        
                            <label>Attributi presenti per <?php echo strtolower($attributo[0]['descrizione']); ?></label>
                        </div>
                        <div class="card-body">
                            <ul>
                            <?php 
                                for($i=0; $i<count($attributiPresenti); $i++){
                                    echo "<li>".$attributiPresenti[$i]['descrizione']."</li>";
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
         </div>

         
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
