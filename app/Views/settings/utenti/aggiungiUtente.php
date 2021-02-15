<?php 
    
?>
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
                         <li class="breadcrumb-item"><a href="/gestioneUtenti">Dashboard</a></li>
                         <li class="breadcrumb-item active">Abilita utente</li>
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
                 <h3 class="card-title">Abilita accesso utente al portale</h3>

                 <div class="card-tools">
                     <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                         <i class="fas fa-minus"></i></button> -->
                     <!--<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                         <i class="fas fa-times"></i></button>-->
                 </div>
             </div>
             <div class="card-body">
                 <div class='container-fluid'>
                    <div class="col-12">
                        <?php $session = \Config\Services::session() ?>
                            <?php if ( isset($session->inserimento_utente) ): ?>
                                <div class="alert alert-success" role="alert">                                
                                    L'operazione è stata conclusa con successo
                                </div>
                            <?php endif; ?>
                            <?php if ( isset($session->errore_inserimento_utente) ): ?>
                                <div class="alert alert-danger" role="alert">                                
                                    Inserimento non avvenuto
                                </div>
                            <?php endif; ?>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <label>Nominativo</label>
                            <div class="input-group mb-3">
                                <select class=" form-control select2bs4 nominativo">
                                    <?php 
                                        for($i=0; $i<count($utenti); $i++)
                                            echo "<option value='{$utenti[$i]->anagrafica_id}'>".ucfirst($utenti[$i]->nominativo)."</option>";
                                    ?>
                                </select>
                                <div class="input-group-append">
                                    <button type='button' class='btn btn-primary btn-sm btnRicerca'>Cerca</button>
                                </div>
                            </div>
                        </div>                           
                    </div>
                    <hr>
                    <div class='esitoRicerca' style='display:none;'>
                        <form method="post">
                            <div class='row'>
                                <div class='col-md-6' style='display:none'>
                                    <label>anagrafica_id</label>
                                    <input type='hidden' class='form-control form-control-sm' name='anagrafica_id' id='anagrafica_id' readonly>
                                </div>
                                <div class='col-md-6'>
                                    <label>Nome</label>
                                    <input type='text' class='form-control form-control-sm' name='nome' id='nome' readonly>
                                </div>
                                <div class='col-md-6'>
                                    <label>Cognome</label>
                                    <input type='text' class='form-control form-control-sm' name='cognome' id='cognome' readonly>
                                </div>
                                <div class='col-md-6'>
                                    <label>Codice fiscale</label>
                                    <input type='text' class='form-control form-control-sm' id='codice_fiscale' readonly>
                                </div>
                                <div class='col-md-6'>
                                    <label>Indirizzo</label>
                                    <input type='text' class='form-control form-control-sm' id='indirizzo' readonly>
                                </div>
                                <div class='col-md-6'>
                                    <label>Recapito telefonico</label>
                                    <input type='text' class='form-control form-control-sm' id='telefono' readonly>
                                </div>
                                <div class='col-md-6'>
                                    <label>Email</label>
                                    <input type='email' class='form-control form-control-sm' id='email' readonly>
                                </div>
                                <div class='col-md-6'>
                                    <label>Ruolo</label>
                                    <select class='form-control form-control-sm ruolo select2bs4' name='ruolo' autofocus>
                                    <?php 
                                        for($i=0; $i<count($ruoli); $i++){
                                            echo "<option value='{$ruoli[$i]['ruolo_utente_id']}'>".$ruoli[$i]['descrizione']."</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                <label>Password</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control-sm" id="basic-addon1"><i class="fas fa-eye mostraPassword"></i></span>
                                    </div>
                                    <input type='password' class='form-control form-control-sm password' value='12345678' name='password' readonly>
                                </div>
                                </div>
                                <!-- <div class='col-md-6'>
                                    <label>Password</label>
                                    <input type='password' class='form-control form-control-sm ' value='password' name='password' readonly>
                                </div> -->
                                <div class='col-md-6'>
                                    <label>Commessa</label>
                                    <select class='form-control form-control-sm select2bs4' name='commessa'>
                                        <?php 
                                            for($i=0; $i<count($commesse); $i++){
                                                //echo "<option value='{$commesse[$i]['commessa_id']}'>".$commesse[$i]['descrizione']." - ".$commesse[$i]['settore']."</option>";
                                                echo "<option value='{$commesse[$i]['commessa_id']}'>".$commesse[$i]['descrizione']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class='col-md-12'>
                                    <hr>
                                    <button type='submit' class='btn btn-primary btn-sm'>Abilita accesso</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
 <script src="<?php base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2({
        theme: "classic"
    });
    $('.btnRicerca').click(function(){
        $('.esitoRicerca').css('display','block');
        var utente_id = $('.nominativo').val(); 
        $.ajax({
            type: "POST",
            url: "/dettaglioAnagraficaUtente",
            data: "utente_id="+utente_id,
            success: function (response) {
                console.log(response);  
                var json = jQuery.parseJSON(response);
                for(var i=0; i<json.length; i++){
                    $('#anagrafica_id').val(json[i].anagrafica_id);
                    $('#nome').val(json[i].nome);
                    $('#cognome').val(json[i].cognome);
                    $('#codice_fiscale').val(json[i].codice_fiscale);
                    $('#indirizzo').val(json[i].indirizzo);
                    $('#telefono').val(json[i].telefono);
                    $('#email').val(json[i].email);

                }
            }
        });
    });
    $('.mostraPassword').mouseenter(function(){
        $('.password').attr("type",'text');
    });
    $('.mostraPassword').mouseleave(function(){
        $('.password').attr("type",'password');
    });
    $('.select2bs4').select2({
            theme: 'bootstrap4'
    })
});
 </script>