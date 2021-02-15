<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!--<h1>Elenco risorse</h1>-->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Controllo consumi carburante</li>
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
                    <h3 class="card-title">Controllo consumi carburante</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" id="form_richiesta" class="" action="">
                        <div class="form-row">
                            <div class="form-group col-md-4" id="tipo_select">
                                <label for="risorsa_select" id="risorsa_label">Dipendente</label>
                                <select class="form-control select2bs4" <?php if (session()->get('success')) echo "disabled=\"true\""; ?> name="risorsa2" id="risorsa2" style="width: 100%;">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($elencoRisorse); $i++) {
                                        echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}'" . set_select('risorsa2', $elencoRisorse[$i]['anagrafica_id']) . ">" . ucfirst($elencoRisorse[$i]['nome']) . ' ' . ucfirst($elencoRisorse[$i]['cognome']) . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="text" class="form-control" hidden name="anagrafica_input" id="anagrafica_input">
                            </div>
                            <div class="form-group col-md-4" id="tipo_select">
                                <label for="tipo_articolo" id="risorsa_label">Scheda carburante</label>
                                <select class="form-control select2bs4" <?php if (session()->get('success')) echo "disabled=\"true\""; ?> name="scheda_carburante" id="scheda_carburante" style="width: 100%;">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($schedeCarburanti); $i++) {
                                        //echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}'" . set_select('risorsa', $elencoRisorse[$i]['anagrafica_id']) . ">" . ucfirst($elencoRisorse[$i]['nome']) . ' ' . ucfirst($elencoRisorse[$i]['cognome']) . "</option>";
                                        echo "<option value='{$schedeCarburanti[$i]['numero_carta']}'>{$schedeCarburanti[$i]['numero_carta']}</option>";
                                    }
                                    ?>
                                </select>
                                <input type="text" class="form-control" hidden name="anagrafica_input" id="anagrafica_input">
                            </div>
                            <div class="form-group col-md-4" id="tipo_select">
                                <label for="tipo_articolo" id="risorsa_label">Mese</label>
                                <input type="number" name='mese' id='mese' class="form-control" min="1" max="12">
                            </div>
                            <div class="form-group col-md-4" id="tipo_select">
                                <label for="tipo_articolo" id="risorsa_label">Anno</label>
                                <select class="form-control select2bs4" name="anno" id="anno">
                                    <option value=""></option>
                                    <?php
                                        $anno_precednte = date('Y',strtotime('-1 year'));
                                        $anno_corrente = date('Y');
                                        for($i=$anno_corrente; $i>=$anno_precednte; $i--){
                                            echo "<option value='{$i}'>".$i."</option>";
                                        }
                                    ?>
                                    <!-- <option value="" disabled selected></option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option> -->
                                </select>
                            </div>
                            <div class="form-group col-md-4" id="tipo_select">
                                <label for="tipo_articolo" id="risorsa_label">Località</label>
                                <select class="form-control select2bs4" name="localita" id="localita">
                                <option value=""></option>
                                <?php
                                    for ($i = 0; $i < count($listaLocalita); $i++) {
                                        echo "<option value='{$listaLocalita[$i]['localita']}'>{$listaLocalita[$i]['localita']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4" id="tipo_select">
                                <label for="tipo_articolo" id="risorsa_label">Targa</label>
                                <input type='text' class='form-control' name='targa' maxlength='10'>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <button type="submit" id="submitForm" value="formItem" name="submitForm" class="btn btn-primary btn-sm  ml-1">Ricerca</button>
                            <!-- <button type="submit" value="formConferma" id="submitForm" name="submitForm" class="btn btn-primary ml-1">Conferma richiesta</button> -->
                        </div>
                        <hr>
                        <!--</div>

                <div class="card-body"> -->
                        <?php if ($showTable) : ?>
                            <table id="tabella_risorse" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Targa</th>
                                        <th>Località</th>
                                        <th>Tipo prodotto</th>                                        
                                        <th>Data transazione</th>      
                                        <th>Importo</th>  
                                        <th>Azione</th>
                                    </tr>
                                    <tr class="filters">
                                        <th>Targa</th>
                                        <th>Località</th>
                                        <th>Tipo prodotto</th>
                                        <th>Data transazione</th>    
                                        <th>Importo</th>    
                                        <th>Azione</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($elencoAffidi); $i++) {
                                        echo "<tr>";
                                        echo "<td>" . $elencoAffidi[$i]['targa'] . "</td>";
                                        echo "<td>" . $elencoAffidi[$i]['localita'] . "</td>";
                                        echo "<td>" . $elencoAffidi[$i]['tipo_prodotto'] . "</td>";
                                        echo "<td>" . date('d-m-Y H:i:s',strtotime($elencoAffidi[$i]['data_transazione'])) . "</td>";
                                        echo "<td>" . $elencoAffidi[$i]['importo'] . " €</td>";
                                        echo "<td><a href='/dettaglioConsumiCarburante/{$elencoAffidi[$i]['numero_carta']}'><p class='btn btn-outline-primary btn-sm' style='margin:0px'>Dettaglio</p></a>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                </div>
                <!--</form>-->
                <?php if ($showTable) : ?>
                    <!-- <div class="card-footer">
                        <button type="button" id="richiestaButton" value="richiestaButton" name="submitForm" class="btn btn-primary ml-1" data-toggle="modal" data-target="#confermaRichiestaModal">Invia richiesta</button>
                    </div> -->
                <?php endif; ?>

            </div>
    </section>
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
        $('#risorsa').change(function() {

            /*var anagrafica_id = $('#risorsa').val();

            if (anagrafica_id != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Articolo/getInfoDipendente",
                    method: "POST",
                    data: {
                        anagrafica_id: anagrafica_id
                    },
                    success: function(data) {
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
            } */
        });


        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#submitForm').click(function(e){
            var nominativo = $('#risorsa2').val(); 
            var scheda_carburante = $('#scheda_carburante').val(); 
            var mese = $('#mese').val(); 
            var anno = $('#anno').val(); 
            //alert(nominativo+" "+scheda_carburante+" "+mese+" "+anno);
            if ( nominativo == null && scheda_carburante == null && mese == "" && anno == null ){
                alert("Attenzione, devi selezionare almeno un parametro");
                e.preventDefault(); 
            }
           
        }); 

    });
</script>

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
            ,dom: 'Bfrtip',
                buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5 ]
                    }
                },
            ],
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