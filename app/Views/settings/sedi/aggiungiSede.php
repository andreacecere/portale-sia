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
                        <li class="breadcrumb-item">Aggiungi sede</li>
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
                <?php if ( isset($session->inserimento_sede) ): ?>
                    <div class="alert alert-success" role="alert">                                
                        L'operazione è stata conclusa con successo
                    </div>
                <?php endif; ?>
                <?php if ( isset($session->errore_inserimento_sede) ): ?>
                    <div class="alert alert-danger" role="alert">                                
                        <?php echo $session->errore_inserimento_sede; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <div class="card card-outline card-primary">
                        <div class="card-header"  style="background-color: white;">
                            <h3 class="card-title">Aggiungi sede</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <form method='POST'>
                            <div class="card-body">
                                <div class='container-fluid'>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <label>Sede</label><label style='color:red'>*</label>
                                            <input type='text' class='form-control ' required maxlength="50" minlength="4" name='sede_magazzino' autofocus>
                                        </div>
                                        <div class='col-md-5'>
                                            <label>Indirizzo</label><label style='color:red'>*</label>
                                            <input type='text' class='form-control ' required maxlength="50" minlength="4" name='indirizzo_magazzino'>
                                        </div>
                                        <div class='col-md-1'>
                                            <label>CAP</label>
                                            <input type='text' class='form-control ' maxlength="5" minlength="4" name='cap_magazzino'>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>Località</label>
                                            <input type='text' class='form-control ' maxlength="50" minlength="4" name='localita_magazzino'>
                                        </div>
                                        <div class='col-md-2'>
                                            <label>Frazione</label>
                                            <input type='text' class='form-control ' maxlength="50" minlength="2" name='frazione_magazzino'>
                                        </div>
                                        <div class='col-md-2'>
                                            <label>Recapito telefonico</label>
                                            <input type='text' class='form-control ' maxlength="12" minlength="2" name='telefono_magazzino'>
                                        </div>
                                        <div class='col-md-4'>
                                            <label>Email</label><label style='color:red'>*</label>
                                            <input type='email' class='form-control ' required maxlength="50" minlength="2" name='email_magazzino'>
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