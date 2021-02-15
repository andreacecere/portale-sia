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
                        <li class="breadcrumb-item active">Elenco affidi</li>
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
                    <h3 class="card-title">Elenco affidi</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">

                    <form method="post" class="" action="">
                        <div class="form-row">
                            <div class="col">
                                <select class="form-control select2bs4" name="input_anagrafica_id" id="input_anagrafica_id">
                                    <option value="" disabled selected></option>
                                    <!-- <option value="all">Visualizza tutti</option> -->
                                    <?php
                                    for ($i = 0; $i < count($elencoRisorse); $i++) {
                                        echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}' >" . $elencoRisorse[$i]['nome'] . ' ' . $elencoRisorse[$i]['cognome'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" id="cerca_item_button" name="cerca_item_button" class="btn btn-primary ml-1">Cerca</button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <?php if ($showTable) : ?>
                        <!--<table id="example" class="display table table-sm table-striped table-bordered table-hover" style="width:100%"> -->
                        <table id="tabella_risorse" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nominativo</th>
                                    <th>Seriale</th>
                                    <th>Tipo item</th>
                                    <th>Sede</th>
                                    <th>Commessa</th>
                                    <th>Data affido</th>
                                    <th>Azioni</th>
                                </tr>
                                <tr class="filters">
                                    <th>Nominativo</th>
                                    <th>Seriale</th>
                                    <th>Tipo item</th>
                                    <th>Sede</th>
                                    <th>Commessa</th>
                                    <th>Data affido</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($elencoAffidi); $i++) {
                                    echo "<tr>";
                                    echo "<td>" . $elencoAffidi[$i]['nome'] . ' ' . $elencoAffidi[$i]['cognome'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['seriale_articolo'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['tipo_articolo'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['sede'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['commessa'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['affidamento_data'] . "</td>";
                                    echo "<td>" . "<a href=\"/dettaglioArticolo/{$elencoAffidi[$i]['articolo_id']}\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettaglio</a>" ."</td>";
                                    // echo "<td><a href=\"/affidaArticolo/{$elencoAffidi[$i]['tipo_articolo']}\" class=\"btn btn-outline-primary btn-sm \" role=\"button\" aria-disabled=\"true\">Cambio commessa</a>"
                                    //     . "<a href=\"/dettaglioArticolo/{$elencoAffidi[$i]['articolo_id']}\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettaglio</a>"
                                    //     . "</td>";
                                    //. "<a href=\"/dettaglioArticolo/{$listaAffidi[$i]['articolo_id']}\" class=\"btn btn-outline-dark btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettagli</a></td>";  */
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

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