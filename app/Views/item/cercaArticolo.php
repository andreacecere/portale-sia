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
                        <li class="breadcrumb-item active">Cerca item</li>
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
                    <h3 class="card-title">Cerca item</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <form method='POST'>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="seriale_input">Seriale</label>
                                <input type="text" class="form-control" name="seriale_input" id="seriale_input">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="tipo_articolo">Tipo</label>
                                <select class="form-control select2bs4" name="tipo_articolo" id="tipo_articolo">
                                    <option value="" disabled selected></option>
                                    <?php
                                        for ($i = 0; $i < count($listaTipoProdotti); $i++) {
                                            echo "<option value='{$listaTipoProdotti[$i]['tipologia_articolo_id']}' >" . $listaTipoProdotti[$i]['tipo_articolo'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="stato_articolo">Stato</label>
                                <select class="form-control select2bs4" name="stato_articolo" id="stato_articolo">
                                    <option value="" disabled selected></option>
                                    <?php
                                        for ($i = 0; $i < count($listaStatoProdotti); $i++) {
                                            echo "<option value='{$listaStatoProdotti[$i]['stato_articolo_id']}' >" . $listaStatoProdotti[$i]['descrizione'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="condizione_input">Condizione</label>
                                <select class="form-control select2bs4" name="condizione_input" id="condizione_input">
                                    <option value="" disabled selected></option>
                                    <?php
                                        for ($i = 0; $i < count($listaCondizioni); $i++) {
                                            echo "<option value='{$listaCondizioni[$i]['condizione_id']}' >" . $listaCondizioni[$i]['descrizione'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="commessa_input">Commessa</label>
                                <select class="form-control select2bs4" name="commessa_input" id="commessa_input">
                                    <option value="" disabled selected></option>
                                    <?php
                                        for ($i = 0; $i < count($listaCommesse); $i++) {
                                            //echo "<option value='{$listaCommesse[$i]['commessa_id']}' >" . $listaCommesse[$i]['descrizione'] . "</option>";
                                            echo "<option value='{$listaCommesse[$i]['descrizione']}' >" . $listaCommesse[$i]['descrizione'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="sede_input">Sede</label>
                                <select class="form-control select2bs4" name="sede_input" id="sede_input">
                                    <option value="" disabled selected></option>
                                    <?php
                                        for ($i = 0; $i < count($listaMagazzini); $i++) {
                                            //echo "<option value='{$listaMagazzini[$i]['magazzino_id']}' >" . $listaMagazzini[$i]['descrizioneMagazzino'] . "</option>";
                                            echo "<option value='{$listaMagazzini[$i]['descrizioneMagazzino']}' >" . $listaMagazzini[$i]['descrizioneMagazzino'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!--
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="inputPassword4">Data affido da</label>
                                <input type="password" class="form-control" id="inputPassword4">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="inputPassword4">Data affido a</label>
                                <input type="password" class="form-control" id="inputPassword4">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="inputEmail4">Fornitore</label>
                                <select class="form-control select2bs4" name="fornitori_input" id="fornitori_input">
                                    <option value="" disabled selected></option>
                                    <?php
                                    /*
                                    for ($i = 0; $i < count($listaFornitori); $i++) {
                                        echo "<option value='{$listaFornitori[$i]['fornitore_id']}' >" . $listaFornitori[$i]['ragione_sociale'] . "</option>";
                                    } */
                                    ?>
                                </select>
                            </div>
                        </div> -->
                        <button type="submit" id="submitForm" class="btn btn-primary btnCerca">Cerca</button>
                    </form>
                    <!-- <hr> -->
                </div>
            </div>

            <!-- <div style="visibility: hidden;"> -->
            <?php if ($showTable) : ?>
                <div class="card card-outline card-primary">
                    <div class="card-header" style="background-color: white;">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tabella_cerca" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Seriale</th>
                                            <th>Tipologia</th>
                                            <th>Sede</th>
                                            <th>Stato articolo</th>
                                            <th>Azioni</th>
                                        </tr>
                                        <tr class="filters">
                                            <th>Seriale</th>
                                            <th>Tipologia</th>
                                            <th>Sede</th>
                                            <th>Stato articolo</th>
                                            <th>Azioni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            for ($i = 0; $i < count($ricerca); $i++) {
                                                echo "<tr>";
                                                echo "<td>" . $ricerca[$i]['seriale']. "</td>";
                                                echo "<td>" . $ricerca[$i]['tipo_articolo']. "</td>";
                                                echo "<td>" . $ricerca[$i]['sede']. "</td>";
                                                echo "<td>" . $ricerca[$i]['stato_articolo']. "</td>";
                                                echo "<td>" . "<a href=\"/dettaglioArticolo/{$ricerca[$i]['articolo_id']}\" class=\"btn btn-outline-dark btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettagli</a>". "</td>";
                                                echo "</tr>";
                                            } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            </div>
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

<!-- Script datatables -->
<script>
    $(document).ready(function() {
        $('#submitForm').click(function(e){
            var seriale_input = $('#seriale_input').val(); 
            var tipo_articolo = $('#tipo_articolo').val(); 
            var stato_articolo = $('#stato_articolo').val(); 
            var condizione_input = $('#condizione_input').val(); 
            var commessa_input = $('#commessa_input').val(); 
            var sede_input = $('#sede_input').val(); 

            
            if ( seriale_input == "" && tipo_articolo == null && stato_articolo == null && condizione_input == null && commessa_input == null && sede_input == null ){
                alert("Attenzione, devi selezionare almeno un parametro");
                e.preventDefault(); 
            }
            // var condizione_input = $('#condizione_input').val(); 
            // var commessa_input = $('#commessa_input').val(); 
            // var sede_input = $('#sede_input').val(); 

            // alert(seriale_input+" "+tipo_articolo+" "+stato_articolo+" "+condizione_input+" "+commessa_input+" "+sede_input);
            
            // if ( seriale_input == null && tipo_articolo == null && stato_articolo == null && condizione_input == null && commessa_input == null && sede_input == null  ){
            //    alert("Ok"); 
            //    e.preventDefault();
            // }
        });
        

        $('#tabella_cerca thead .filters th').each(function() {
            var title = $('#tabella_cerca thead tr:eq(0) th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control form-control-sm">');
        });

        // DataTable
        var table = $('#tabella_cerca').DataTable({
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
                        columns: [ 0,1,2,3 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0,1,2,3 ]
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