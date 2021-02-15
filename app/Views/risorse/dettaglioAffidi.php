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
                        <li class="breadcrumb-item"><a href="/elencoRisorse">Elenco risorse</a></li>
                        <li class="breadcrumb-item active">Dettaglio affidi</li>
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
                    <?php if ($showTable) : ?>
                        <!--<table id="example" class="display table table-sm table-striped table-bordered table-hover" style="width:100%"> -->
                        <table id="tabella_risorse" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Seriale</th>
                                    <th>Tipo item</th>
                                    <th>Sede</th>
                                    <th>Commessa</th>
                                    <th>Data affido</th>
                                </tr>
                                <tr class="filters">
                                    <th>Seriale</th>
                                    <th>Tipo item</th>
                                    <th>Sede</th>
                                    <th>Commessa</th>
                                    <th>Data affido</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                for ($i = 0; $i < count($elencoAffidi); $i++) {
                                    echo "<tr>";
                                    echo "<td>" . $elencoAffidi[$i]['seriale_articolo'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['tipo_articolo'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['sede'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['commessa'] . "</td>";
                                    echo "<td>" . date('d/m/Y H:i:s',strtotime($elencoAffidi[$i]['affidamento_data'])) . "</td>";
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