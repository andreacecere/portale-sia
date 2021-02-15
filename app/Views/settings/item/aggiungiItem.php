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
                        <li class="breadcrumb-item">Aggiungi item</li>
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
                    <?php if ( isset($session->inserimento_item) ): ?>
                        <div class="alert alert-success" role="alert">                                
                            L'operazione è stata conclusa con successo
                        </div>
                    <?php endif; ?>
                    <?php if ( isset($session->errore_inserimento_item) ): ?>
                        <div class="alert alert-danger" role="alert">                                
                            <?php echo $session->errore_inserimento_item; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class='col-md-12'>
                    <div class="card card-outline card-primary">
                        <div class="card-header"  style="background-color: white;">
                            <h3 class="card-title">Aggiungi nuovo item</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form method="post">
                            <div class="card-body">
                                <label>Categoria</label>
                                <select class='form-control select2bs4' name='categoria' style='width:100%'>
                                <?php 
                                    for($i=0; $i<count($categorieFoglie); $i++){
                                        echo "<option>".ucfirst(strtolower($categorieFoglie[$i]['descrizione']))."</option>";
                                    }
                                ?>
                                </select>
                                <label>Nome item</label>
                                <input type='text' class='form-control' required maxlength="40" name='nome_item' minlength="1" placeholder="Esempio: contatore">
                                <br>
                                <button type="submit" class='btn btn-sm btn-primary'>Aggiungi</button>
                            </div>
                        </form>
                        <!-- /.card-body -->
                        <!-- <div class="card-footer">
                            Footer
                        </div> -->
                    </div>
                </div>
            </div>
         </div>

         
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
