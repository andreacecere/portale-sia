<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!--<h1>Elenco risorse</h1>-->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Richiesta spostamento risorsa</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <!-- card-header -->
                <div class="card-header" style="background-color: white;">
                    <h3 class="card-title">Richiesta spostamento risorsa</h3>
                    <?php 
                        //echo "<br>".$nominativo; 
                    ?>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                <div class="col-12">
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
                </div>
                    <form method="POST" id="form_richiesta" class="" action="">
                        <div class="form-row">
                            <div class="form-group col-md-4" id="tipo_select">
                                <label for="tipo_articolo" id="risorsa_label">Risorsa da spostare</label>
                                <select class="form-control select2bs4" <?php if (session()->get('success')) echo "disabled=\"true\""; ?> name="risorsa" id="risorsa" style="width: 100%;">
                                    <option value="" disabled selected ></option>
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
                                <input type="text" class="form-control" hidden name="anagrafica_input" id="anagrafica_input" value="<?= set_value('anagrafica_input') ?>">
                            </div>
                            <div class="form-group col-md-4" id="condizione_select">
                                <label for="condizione_articolo" id="condizione_articolo_label">Commessa attuale</label>
                                <input type="text" class="form-control" readonly name="commessa_input" id="commessa_input" value="<?= set_value('commessa_input') ?>">
                            </div>
                            <div class="form-group col-md-4" id="fornitore_select">
                                <label for="fornitore_articolo" id="fornitore_articolo_label">Sede attuale</label>
                                <input type="text" class="form-control" readonly name="sede_input" id="sede_input" value="<?= set_value('sede_input') ?>">
                                <input type="text" class="form-control" readonly style="display: none;" id="fk_tipologia_articolo_id" value=''>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3" id="tipo_select">
                                <label for="commessa_destinazione_input" id="commessa_destinazione_label">Commessa di destinazione</label>
                                <select class="form-control select2bs4" name="commessa_destinazione_input" id="commessa_destinazione_input">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($listaCommesse); $i++) {
                                        echo "<option value='{$listaCommesse[$i]['commessa_id']}'" . set_select('commessa_destinazione_input', $listaCommesse[$i]['commessa_id']) . ">" . $listaCommesse[$i]['descrizione'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="condizione_select">
                                <label for="sede_new_commessa" id="sede_new_commessa_label">Sede di destinazione</label>
                                <input type="text" class="form-control" readonly name="sede_new_commessa_input" id="sede_new_commessa_input" value="<?= set_value('sede_new_commessa_input') ?>">
                            </div>
                            <div class="form-group col-md-3" id="condizione_select">
                                <label for="data_servizio_input" id="data_servizio_label">Data presunta presa in carico servizio</label>
                                <input type="date" class="form-control" name="data_servizio_input" id="data_servizio_input" value="<?= set_value('sede_new_commessa_input') ?>" required>
                            </div>
                            <div class="form-group col-md-3" id="fornitore_select">
                                <label for="riferimento_commessa_output" id="riferimento_commessa_output_label">Attuale riferimento</label>
                                <input type="text" class="form-control" readonly name="riferimento_commessa_output" id="riferimento_commessa_output" value="<?= set_value('riferimento_commessa_output') ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <button type="submit" id="submitForm" value="formItem" name="submitForm" class="btn btn-primary ml-1 visualizzaItem">Visualizza item affidati</button>
                            <!-- <button type="submit" value="formConferma" id="submitForm" name="submitForm" class="btn btn-primary ml-1">Conferma richiesta</button> -->
                        </div>
                        <hr>
                        <!--</div>

                <div class="card-body"> -->
                        <?php if ($showTable) : ?>
                            <p id='data_presa_in_carico' style='display:none;'><?php echo $data_servizio_input; ?></p>
                            <table id="tabella_risorse" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Seriale</th>
                                        <th>Tipo item</th>
                                        <th>Sede</th>
                                        <th>Commessa</th>
                                        <th>Data affido</th>
                                        <!-- <th>Azioni <input type="checkbox" class="ml-1" /> Sposta tutti</th>-->
                                        <th><input type="checkbox" id="sposta_tutti_checkbox" name="sposta_tutti_checkbox" class="ml-2" /> Sposta tutti </th>
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
                <!--</form>-->
                <?php if ($showTable) : ?>
                    <div class="card-footer">
                        <button type="button" id="richiestaButton" value="richiestaButton" name="submitForm" class="btn btn-primary ml-1" data-toggle="modal" data-target="#confermaRichiestaModal">Invia richiesta</button>
                    </div>
                <?php endif; ?>

            </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="confermaRichiestaModal" tabindex="-1" role="dialog" aria-labelledby="confermaRichiestaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Conferma invio richiesta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <p>Vuoi confermare la richiesta di spostamento della risorsa? La conferma genererà l'invio di una mail</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" value="formConferma" id="submitForm" name="submitForm" class="btn btn-primary">Conferma</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annulla</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal mancaResponsabile" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Avviso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class='text-danger'>Attenzione, la procedura di affido non può continuare in quanto non è presente alcun responsabile</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btnResponsabileCommessa">Assegna responsabile alla commessa</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
      </div>
    </div>
  </div>
</div>

<script src="<?php base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>

<!-- Script datatables -->
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

<script>
    $(document).ready(function() {
        
        $('#data_servizio_input').val(localStorage.getItem("data_servizio_input")); 
        //change
        var anagrafica_id;
        anagrafica_id = $('#risorsa').val();
        ottieniInfo(anagrafica_id);


        $('#risorsa').change(function() {
            anagrafica_id = $('#risorsa').val();
            ottieniInfo(anagrafica_id);

        });

        $('#commessa_destinazione_input').change(function() {
            var commessa_input = $('#commessa_destinazione_input').val();
            if (commessa_input != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Articolo/getInfoCommessa",
                    method: "POST",
                    data: {
                        commessa_id: commessa_input
                    },
                    success: function(data) {
                        var parsed = JSON.parse(data);
                        console.log(data);
                        var commessa = parsed[0];

                        $("#riferimento_commessa_output").val(commessa.responsabile);
                        $("#sede_new_commessa_input").val(commessa.magazzino);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        });

        $('#sposta_tutti_checkbox').change(function() {
            if (document.getElementById("sposta_tutti_checkbox").checked)
                jQuery("#form_richiesta input:radio").attr('disabled', true);
            else
                jQuery("#form_richiesta input:radio").attr('disabled', false);
        });

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('.visualizzaItem').click(function(e){
            var data = $('#data_servizio_input').val(); 
            localStorage.setItem("data_servizio_input", data);
            var riferimento_commessa_output = $('#riferimento_commessa_output').val();
            //alert(riferimento_commessa_output);
            if ( riferimento_commessa_output == "" ){
                $('.mancaResponsabile').modal('show');
                e.preventDefault(); 
            }
            else{
                var data = $('#data_servizio_input').val();
                localStorage.setItem("data_servizio_input", data);
            }
            
        });

       
    });

    function ottieniInfo(anagrafica_id){
        if (anagrafica_id != null ) {
                //alert(anagrafica_id)
                $.ajax({
                    url: "<?php echo base_url(); ?>/Articolo/getInfoDipendente",
                    method: "POST",
                    data: {
                        anagrafica_id: anagrafica_id
                    },
                    success: function(data) {
                        console.log(data);
                        // console.log(data);
                        var parsed = JSON.parse(data);
                        var user = parsed[0];

                        //console.log(user);                       

                        $("#anagrafica_input").val(anagrafica_id);
                        $("#sede_input").val(user.sede);
                        $("#commessa_input").val(user.commessa);
                        $("#fk_sede_input").val(user.magazzino_id);
                        $("#fk_commessa_input").val(user.fk_commessa_id);
                        $("#risorsa_nominativo").val(user.nome + ' ' + user.cognome);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
    }
</script>

<!-- Script datatables -->
<script>
    $(document).ready(function() {

        $('.btnResponsabileCommessa').click(function(){
            location.href = "/gestioneCommesse/"
        });

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
</script>