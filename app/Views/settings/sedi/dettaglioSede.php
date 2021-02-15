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
                        <li class="breadcrumb-item"><a href="/gestioneSedi">Gestione Sede</a></li>
                        <li class="breadcrumb-item"><?php echo ucfirst($attributi[0]['descrizioneMagazzino']); ?></li>
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
                <?php if ( isset($session->aggiornamento_sede) ): ?>
                    <div class="alert alert-success" role="alert">                                
                        L'operazione è stata conclusa con successo
                    </div>
                <?php endif; ?>
                <?php if ( isset($session->errore_aggiornamento_sede) ): ?>
                    <div class="alert alert-danger" role="alert">                                
                        <?php echo $session->errore_aggiornamento_sede; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <div class="card card-outline card-primary">
                        <div class="card-header"  style="background-color: white;">
                            <h3 class="card-title">Dettaglio sede</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form method='POST'>
                            <div class="card-body">
                                <div class='container-fluid'>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <label>Sede</label><label style='color:red'>*</label>
                                            <input type='text' class='form-control ' value='<?php echo $attributi[0]['descrizioneMagazzino']; ?>' required maxlength="50" minlength="4" name='sede_magazzino' autofocus>
                                        </div>
                                        <div class='col-md-5'>
                                            <label>Indirizzo</label><label style='color:red'>*</label>
                                            <input type='text' class='form-control ' required maxlength="50" minlength="4" value='<?php echo $attributi[0]['indirizzo']; ?>' name='indirizzo_magazzino'>
                                        </div>
                                        <div class='col-md-1'>
                                            <label>CAP</label>
                                            <input type='text' class='form-control ' maxlength="7" minlength="4" value='<?php echo $attributi[0]['cap']; ?>' name='cap_magazzino'>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>Località</label>
                                            <input type='text' class='form-control ' maxlength="50" minlength="4" value='<?php echo $attributi[0]['localita']; ?>' name='localita_magazzino'>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>Frazione</label>
                                            <input type='text' class='form-control ' maxlength="50" minlength="2" value='<?php echo $attributi[0]['frazione']; ?>' name='frazione_magazzino'>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>Recapito telefonico</label>
                                            <input type='text' class='form-control ' maxlength="12" minlength="2" value='<?php echo $attributi[0]['telefono']; ?>' name='telefono_magazzino'>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>Email</label><label style='color:red'>*</label>
                                            <input type='email' class='form-control ' required maxlength="50" minlength="2" value='<?php echo $attributi[0]['email']; ?>' name='email_magazzino'>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>Magazziniere</label><label style='color:red'>*</label>
                                            <select class='form-control select2bs4' name='magazziniere' width='100%' required>
                                                <option></option>
                                                <?php 
                                                    for($i=0; $i<count($listaAnagrafica); $i++){
                                                        if ( $listaAnagrafica[$i]['anagrafica_id'] == $attributi[0]['riferimento'] )
                                                            echo "<option value='{$listaAnagrafica[$i]['anagrafica_id']}' selected>".ucfirst(strtolower($listaAnagrafica[$i]['cognome']))." ".ucfirst(strtolower($listaAnagrafica[$i]['nome']))."</option>";
                                                        else
                                                        echo "<option value='{$listaAnagrafica[$i]['anagrafica_id']}'>".ucfirst(strtolower($listaAnagrafica[$i]['cognome']))." ".ucfirst(strtolower($listaAnagrafica[$i]['nome']))."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>Recapito telefonico magazziniere</label>
                                            <input type='text' class='form-control ' maxlength="12" minlength="2" value='<?php echo $attributi[0]['telefono_riferimento']; ?>' name='telefono_magazziniere'>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer" style="background-color: white;">
                                <button type="submit" class='btn btn-primary btn-sm'>Salva</button>
                            </div>
                        </form>
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
              <input type="text" class='form-control  idEliminazione'>
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
    $(document).ready(function () {
        $( ".elimina" ).on( "click", function() {
            $('.idEliminazione').val($( this ).val())
        });
    });
</script>