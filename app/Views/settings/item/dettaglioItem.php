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
                        <li class="breadcrumb-item"><?php echo ucfirst($attributi[0]['nomeArticolo']); ?></li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>
     
     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class='container-fluid'>
            <div class="col-12">
             <?php $session = \Config\Services::session() ?>
                <?php if ( isset($session->inserimento_attributo) ): ?>
                    <div class="alert alert-success" role="alert">                                
                        L'operazione è stata conclusa con successo
                    </div>
                <?php endif; ?>
                <?php if ( isset($session->errore_inserimento_attributo) ): ?>
                    <div class="alert alert-danger" role="alert">                                
                        <?php echo $session->errore_inserimento_attributo; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class='row'>
                <div class='col-md-6'>
                        <div class="card card-outline card-warning">
                            <div class="card-header"  style="background-color: white;">
                                <h3 class="card-title">Aggiungi attributo</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <form method='POST'>
                                <div class="card-body">
                                    <label>Nome attributo</label>
                                    <input type='text' class='form-control form-control-sm' minlength="2" maxlength="40" required placeholder="Esempio: Classe" name='nome_attributo' autofocus>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer" style="background-color: white;">
                                    <button type="submit" class='btn btn-primary btn-sm'>Aggiungi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <div class='col-md-6'>
                    <div class="card card-outline card-primary">
                        <div class="card-header"  style="background-color: white;">
                            <h3 class="card-title">Attributi associati</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <table class="table table-bordered" style='border:0px!important;'>
                              <thead>
                                </thead>
                                <tbody>
                                    <?php 
                                        if ( empty($attributi[0]['descrizione']) ){
                                            echo "<tr>"; 
                                            echo "<td>Non ci sono attributi associati</td>";
                                            echo "</tr>";
                                        }
                                        else
                                            for($i=0; $i<count($attributi);$i++){
                                                echo "<tr>"; 
                                                echo "<td>".ucfirst(strtolower($attributi[$i]['descrizione']))."</td>";
                                                echo "<td class='text-right'><a href='/aggiungiAttributo/{$attributi[$i]['attributo_id']}'><button type='button' class='btn btn-success btn-sm' value='{$attributi[$i]['attributo_id']}'><i class=\"fas fa-plus\"></i></button></a></td>";
                                                echo "</tr>";
                                            }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Elimina attributo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST">
              <input type="text" class='form-control form-control-sm idEliminazione'>
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


<script>
    // $(document).ready(function () {
    //     $( ".elimina" ).on( "click", function() {
    //         $('.idEliminazione').val($( this ).val())
    //     });
    // });
</script>