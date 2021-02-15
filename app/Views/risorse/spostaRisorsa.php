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
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active">Richiedi spostamento</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card card-outline card-primary">
             <div class="card-header" style='background-color:#fff'>
                 <h3 class="card-title">Richiesta spostamento</h3>

                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                         title="Collapse">
                         <i class="fas fa-minus"></i></button>
                 </div>
             </div>
             <div class="card-body">
                 <?php $session = \Config\Services::session() ?>
                 <?php if ( isset($session->sposamento_avvenuto) ): ?>
                 <div class="alert alert-success" role="alert">
                     <?php echo $session->sposamento_avvenuto; ?>
                 </div>
                 <?php endif; ?>
                 <?php if ( isset($session->errore_spostamento) ): ?>
                 <div class="alert alert-danger" role="alert">
                     <?php echo "Errore: ".$session->errore_spostamento; ?>
                 </div>
                 <?php endif; ?>
                 <form method="POST">
                     <div class='container-fluid'>
                         <div class='row'>
                             <div class='col-md-3'>
                                 <label>Tipologia di spostamento</label>
                             </div>
                             <div class='col-md-3'>
                                 <select name="tipologia_spostamento" class='form-control' id='tipologia_spostamento'>
                                     <!-- <option value=''></option> -->
                                     <option value='sposta'>Spostamento risorsa</option>
                                     <option value='richiedi'>Richiesta risorsa</option>
                                 </select>   
                             </div>
                             <div class='col-md-3'>
                                <a href="#" data-toggle="tooltip" data-html="true" title="Spostamento risorsa: Se selezionata sposta la risorsa in maniera definitiva<hr>Richiedi risorsa: Se selezionata permette al responsabile di destinazione di accettare o rifiutare la risorsa" data-placement="right"><i class="far fa-question-circle"></i></a>
                             </div>

                         </div>
                         <br>
                         <div id='richiesta_spostamento' style='display:none'>
                             <div class='row'>
                                 <div class='col-md-3'>
                                     <label>Risorsa da spostare</label>
                                     <select class="form-control select2bs4 risorsa_selezionata" name="risorsa"
                                         id="risorsa" style="width: 100%;">
                                         <option value="" disabled selected></option>
                                         <?php
                                    for ($i = 0; $i < count($elencoRisorse); $i++) {
                                        if ( !empty($nominativo) ){
                                            if ( $nominativo == ucfirst($elencoRisorse[$i]['nome'])." ".ucfirst($elencoRisorse[$i]['cognome']) ){
                                                echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}'" . set_select('risorsa', $elencoRisorse[$i]['anagrafica_id']) . " selected>" . ucfirst($elencoRisorse[$i]['nome']) . ' ' . ucfirst($elencoRisorse[$i]['cognome']) . "</option>";
                                            }
                                            else{
                                                echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}'" . set_select('risorsa', $elencoRisorse[$i]['anagrafica_id']) . ">" . ucfirst($elencoRisorse[$i]['nome']) . ' ' . ucfirst($elencoRisorse[$i]['cognome']) . "</option>";
                                            }
                                        }
                                        else{   
                                            echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}'" . set_select('risorsa', $elencoRisorse[$i]['anagrafica_id']) . ">" . ucfirst($elencoRisorse[$i]['nome']) . ' ' . ucfirst($elencoRisorse[$i]['cognome']) . "</option>";
                                        }
                                    }
                                    ?>
                                     </select>
                                 </div>
                                 <div class='col-md-3'>
                                     <label>Commessa attuale</label>
                                     <input type='text' class='form-control' name='commessa_attuale' readonly
                                         id='commessa_attuale' value="<?= set_value('commessa_attuale') ?>">
                                     <input type='text' class='form-control' name='commessa_attuale_id' readonly
                                         id='commessa_attuale_id' value="<?= set_value('commessa_attuale_id') ?>" style='display:none;'>
                                 </div>
                                 <div class='col-md-3'>
                                     <label>Sede attuale</label>
                                     <input type='text' class='form-control' name='sede_attuale' readonly
                                         id='sede_attuale' value="<?= set_value('sede_attuale') ?>">
                                     <input type='text' class='form-control' name='sede_attuale_id' readonly
                                         id='sede_attuale_id' value="<?= set_value('sede_attuale_id') ?>" style='display:none;'>
                                 </div>
                                 <div class='col-md-3'>
                                     <label>Responsabile attuale</label>
                                     <input type='text' class='form-control' name='responsabile_attuale' readonly
                                         id='responsabile_attuale' value="<?= set_value('responsabile_attuale') ?>">
                                     <input type='text' class='form-control' name='responsabile_attuale_id' readonly
                                         id='responsabile_attuale_id'
                                         value="<?= set_value('responsabile_attuale_id') ?>" style='display:none;'>
                                 </div>
                             </div>
                             <div class='row'>
                                 <div class='col-md-3'>
                                     <label>Commessa di destinazione</label>
                                     <select class="form-control select2bs4" id='commessa_di_destinazione'
                                         name='commessa_destinazione'>
                                         <option value="" disabled selected></option>
                                         <?php
                                                for ($i = 0; $i < count($listaCommesse); $i++) {
                                                    echo "<option value='{$listaCommesse[$i]['commessa_id']}'".set_select('commessa_destinazione', $listaCommesse[$i]['commessa_id']).">" . $listaCommesse[$i]['descrizione'] . "</option>";
                                                }
                                        ?>
                                     </select>
                                 </div>
                                 <div class='col-md-3'>
                                     <label>Sede di destinazione</label>
                                     <input type='text' class='form-control' name='sede_di_destinazione' readonly
                                         id='sede_di_destinazione' value="<?= set_value('sede_di_destinazione') ?>">
                                     <input type='text' class='form-control' name='sede_di_destinazione_id' readonly
                                         id='sede_di_destinazione_id'
                                         value="<?= set_value('sede_di_destinazione_id') ?>" style='display:none;'>
                                 </div>
                                 <div class='col-md-3'>
                                     <label>Data presunta presa in carico servizio</label>
                                     <input type='date' class='form-control' id='data_presunta_presa_in_carico'
                                         name='data_presunta_presa_in_carico' required <?php if ( empty(set_value('data_presunta_presa_in_carico')) ) echo "value='".date('Y-m-d')."'" ?>  
                                         value="<?= set_value('data_presunta_presa_in_carico') ?>"
                                         min=<?php echo date('Y-m-d', strtotime(' +0 day')); ?>>
                                 </div>
                                 <div class='col-md-3'>
                                     <label>Responsabile attuale destinazione</label>
                                     <input type='text' class='form-control'
                                         name='responsabile_attuale_commessa_destinazione' readonly
                                         id='responsabile_attuale_commessa_destinazione'
                                         value="<?= set_value('responsabile_attuale_commessa_destinazione') ?>">
                                     <input type='text' class='form-control'
                                         name='responsabile_attuale_commessa_destinazione_id' readonly
                                         id='responsabile_attuale_commessa_destinazione_id'
                                         value="<?= set_value('responsabile_attuale_commessa_destinazione_id') ?>" style='display:none;'>
                                     </select>
                                 </div>
                             </div>
                         </div>
                         <div class='row'>
                             <div class='col-md-12' style='margin-top:20px'>
                                 <div class="callout callout-danger msgErrore" style='display:none'>
                                     <h5>Attenzione</h5>
                                     <p>La procedura non può continuare , controllare che per la <b>risorsa</b>
                                         selezionata i campi evidenziati in rosso siano popolati </p>
                                 </div>
                                 <div class="callout callout-danger msgErrore_commessa" style='display:none'>
                                     <h5>Attenzione</h5>
                                     <p>La procedura non può continuare , controllare che per la <b>commessa</b>
                                         selezionata i campi evidenziati in rosso siano popolati </p>
                                 </div>
                             </div>
                         </div>
                         <div class='row'>
                             <div class='col-md-3' style='margin-top:20px'>
                                 <button type="submit" id="submitForm" value="formItem" name="submitForm"
                                     class="btn btn-primary ml-1 visualizzaItem" disabled>Visualizza item
                                     affidati</button>
                             </div>
                         </div>
                         <hr>
                     </div>
                     <?php if ($showTable) : ?>
                     <p id='data_presa_in_carico' style='display:none;'><?php echo $data_servizio_input; ?></p>
                     <table id="tabella_risorse"
                         class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%"
                         cellspacing="0">
                         <thead>
                             <tr>
                                 <th>Seriale</th>
                                 <th>Tipo item</th>
                                 <th>Sede</th>
                                 <th>Commessa</th>
                                 <th>Data affido</th>
                                 <!-- <th>Azioni <input type="checkbox" class="ml-1" /> Sposta tutti</th>-->
                                 <th><input type="checkbox" id="sposta_tutti_checkbox" name="sposta_tutti_checkbox"
                                         class="ml-2" /> Sposta tutti </th>
                             </tr>
                             <tr class="filters">
                                 <th>Seriale</th>
                                 <th>Tipo item</th>
                                 <th>Sede</th>
                                 <th>Commessa</th>
                                 <th>Data affido</th>
                                 <th>Azioni </th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                            for ($i = 0; $i < count($elencoAffidi); $i++) {
                                echo "<tr>";

                                $seriale = $elencoAffidi[$i]['seriale_articolo'];
                                $affidamentoId = $elencoAffidi[$i]['affidamento_id'];

                                echo "<td>" . $elencoAffidi[$i]['seriale_articolo'] . "</td>";
                                echo "<td>" . $elencoAffidi[$i]['tipo_articolo'] . "</td>";
                                echo "<td>" . $elencoAffidi[$i]['sede'] . "</td>";
                                echo "<td>" . $elencoAffidi[$i]['commessa'] . "</td>";
                                echo "<td>" . $elencoAffidi[$i]['affidamento_data'] . "</td>";
                                echo "<td><label class=\"btn btn-sm \"><input type=\"radio\" name=\"$affidamentoId\" id=\"option1\" value=\"on\" autocomplete=\"off\" checked>  Sposta</label><label class=\"btn ml-2 btn-sm \"><input type=\"radio\" value=\"off\" name=\"$affidamentoId\" id=\"option2\" autocomplete=\"off\">  Resta alla sede attuale</label>"
                                    . "</td>";
                                //. "<a href=\"/dettaglioArticolo/{$listaAffidi[$i]['articolo_id']}\" class=\"btn btn-outline-dark btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettagli</a></td>";  */
                                echo "</tr>";
                            }
                            ?>
                         </tbody>
                     </table>
                     <?php endif; ?>

             </div>
             <!-- /.card-body -->
             <?php if ($showTable) : ?>
             <div class="card-footer">
                 <button type="submit" value="formConferma" id="submitForm" name="submitForm"
                 class="btn btn-primary btnConfermaSpostamento">Conferma</button> 
                </div>
            </form>
            <!-- <button class='btn btn-primary btn-sm' id='modalConferma' data-toggle="modal" data-target="#confermaModal">Conferma</button> -->
             <?php endif; ?>
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->


 <style>
.filters input {
    width: 100%;
    padding: 3px;
    box-sizing: border-box;
}

@media screen and (max-width: 937px) {
    .filters {
        display: none;
    }
}
 </style>


 <!-- Script datatables -->
 <script>
$(document).ready(function() {

    $('#tabella_risorse thead .filters th').each(function() {
        var title = $('#tabella_risorse thead tr:eq(0) th').eq($(this).index()).text();
        $(this).html('<input type="text" class="form-control form-control-sm">');
    });

    // DataTable
    var table = $('#tabella_risorse').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Italian.json"
        }
    });

    table.columns().eq(0).each(function(colIdx) {
        $('input', $('.filters th')[colIdx]).on('keyup change', function() {
            table
                .column(colIdx)
                .search(this.value)
                .draw();
        });
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

});
$(document).ready(function() {

    var data = sessionStorage.getItem('richiesta_spostamento_tipologia');
    //alert(data)
    if (data != "" || data != undefined) {
        //$('option[value=sposta]', data).attr('selected', 'selected');
        $('[name=tipologia_spostamento]').val(data).trigger('click');
        $('#richiesta_spostamento').css('display', 'block');
    }
    if (data == null) {
        $('[name=tipologia_spostamento]').val(null).trigger('click');
        $('#richiesta_spostamento').css('display', 'none');
    }

    $('.btnConfermaSpostamento').click(function() {
        sessionStorage.removeItem("richiesta_spostamento_tipologia");
    });




    var tipologia_spostamento, risorsa_selezionata_id;
    var commessa_attuale;
    var commessa_attuale_id;
    var sede_attuale;
    var sede_attuale_id;
    var responsabile_attuale;
    var responsabile_attuale_id;
    var sede_id;
    var descrizione_sede;
    var nominativo_responsabile_commessa;
    var anagrafica_id;

    $('#modalConferma').click(function(){
        $('#avvisoTestoRichiesto').html("");
        var tipologia_spostamento_selezionata = $('#tipologia_spostamento option:selected').text(); 
        $('#modalTitle').text(tipologia_spostamento_selezionata) 

       if ( tipologia_spostamento_selezionata == "Spostamento risorsa" ){
           $('#avvisoTestoRichiesto').html("<p class='text-danger'><b>Attenzione</b></p><p>Selezionando tale tipologia di spostamento, verrà inviata un email con i dettagli dello spostamento della risorsa.<br><u><i>Tale opzione non compoterà ulteriori operazioni quali il consenso o il rifiuto</u></i>");
       }
       else{
        $('#avvisoTestoRichiesto').html("<p class='text-danger'><b>Attenzione</b></p><p>Selezionando tale tipologia di spostamento, verrà inviata un email con i dettagli dello spostamento della risorsa.<br><u><i>Inoltre dovrai <u><i>consentire o rifiutare</i></u> lo spostamento dall'apposita pagina</p>");
       }
    });


    $('#tipologia_spostamento').change(function() {
        tipologia_spostamento = $(this).val();
        if (tipologia_spostamento == "" || tipologia_spostamento == undefined) {
            $('#richiesta_spostamento').css('display', 'none');
        } else {
            $('#richiesta_spostamento').css('display', 'block');
            sessionStorage.setItem('richiesta_spostamento_tipologia', tipologia_spostamento);
        }
    });

    $('.risorsa_selezionata').change(function() {
        risorsa_selezionata_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "infoRisorsa/" + risorsa_selezionata_id,
            success: function(response) {
                console.log(response)
                var json = JSON.parse(response);
                commessa_attuale = json[0]['commessa'];
                commessa_attuale_id = json[0]['fk_commessa_attuale'];
                sede_attuale = json[0]['sede'];
                sede_attuale_id = json[0]['sede_attuale'];
                responsabile_attuale = json[0]['nominativo_responsabile'];
                responsabile_attuale_id = json[0]['anagrafica_id_responsabile'];

                if (commessa_attuale == null || commessa_attuale == "" || sede_attuale ==
                    null || sede_attuale == "" || responsabile_attuale == null ||
                    responsabile_attuale == "") {

                    $('#commessa_attuale,#sede_attuale,#responsabile_attuale').css('border',
                        '1px solid red');
                    $('#commessa_attuale,#sede_attuale,#responsabile_attuale,#commessa_attuale_id,#sede_attuale_id,#responsabile_attuale_id')
                        .val("")
                    $('.msgErrore').css('display', 'block');

                } else {
                    $('#commessa_attuale,#sede_attuale,#responsabile_attuale').css('border',
                        '1px solid green');
                    $('#commessa_attuale').val(json[0]['commessa']);
                    $('#commessa_attuale_id').val(json[0]['fk_commessa_attuale']);
                    $('#sede_attuale').val(json[0]['sede'])
                    $('#sede_attuale_id').val(json[0]['sede_attuale'])
                    $('#responsabile_attuale').val(json[0]['nominativo_responsabile'])
                    $('#responsabile_attuale_id').val(json[0]['anagrafica_id_responsabile'])
                    $('.msgErrore').css('display', 'none');
                    var esito = controlla_esito();
                    if (esito) {
                        $('.visualizzaItem').attr('disabled', 'disabled');
                    } else {
                        $('.visualizzaItem').removeAttr('disabled', 'disabled');
                    }
                }
            },
            complete: function() {
                var esito = controlla_esito();
                if (esito) {
                    $('.visualizzaItem').attr('disabled', 'disabled');
                } else {
                    $('.visualizzaItem').removeAttr('disabled', 'disabled');
                }
            }
        });
    });

    $('#commessa_di_destinazione').change(function() {
        //alert($(this).val())
        var commessa_destinazione_id = $(this).val()
        $.ajax({
            type: "GET",
            url: "infoCommessaDestinazione/" + commessa_destinazione_id,
            success: function(response) {
                console.log(response)
                var json = JSON.parse(response);
                sede_id = json[0]['magazzino_id'];
                descrizione_sede = json[0]['descrizione_sede'];
                nominativo_responsabile_commessa = json[0][
                    'nominativo_responsabile_commessa'
                ];
                anagrafica_id = json[0]['anagrafica_id'];

                if (sede_id == "" || sede_id == null || descrizione_sede == "" ||
                    descrizione_sede == null) {
                    $('.msgErrore_commessa').css('display', 'block');
                    $('#sede_di_destinazione,#responsabile_attuale_commessa_destinazione')
                        .css('border', '1px solid red');
                    $('#sede_di_destinazione,#responsabile_attuale_commessa_destinazione')
                        .val("")
                } else {
                    $('#sede_di_destinazione,#responsabile_attuale_commessa_destinazione')
                        .css('border', '1px solid green');
                    $('#sede_di_destinazione').val(descrizione_sede);
                    $('#sede_di_destinazione_id').val(sede_id);
                    $('#responsabile_attuale_commessa_destinazione').val(
                        nominativo_responsabile_commessa);
                    $('#responsabile_attuale_commessa_destinazione_id').val(anagrafica_id);
                    $('.msgErrore_commessa').css('display', 'none');
                }
            },
            complete: function() {
                var esito = controlla_esito();
                if (esito) {
                    $('.visualizzaItem').attr('disabled', 'disabled');
                } else {
                    $('.visualizzaItem').removeAttr('disabled', 'disabled');
                }
            }
        });
    });

    function controlla_esito() {
        if (commessa_attuale == null || commessa_attuale == "" || descrizione_sede == null ||
            descrizione_sede == "") {
            return true;
        } else {
            return false;
        }
    }
});
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
 </script>