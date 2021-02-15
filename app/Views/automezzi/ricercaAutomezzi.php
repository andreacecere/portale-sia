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
                        <li class="breadcrumb-item active">Cerca automezzo</li>
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
                    <h3 class="card-title">Cerca automezzo</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <form method='POST'>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="seriale_input">Targa</label>
                                <input type="text" class="form-control" name="seriale_input" id="seriale_input">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="tipo_articolo">Modello</label>
                                <select class="form-control select2bs4" name="tipo_articolo" id="tipo_articolo">
                                    <option value="" disabled selected></option>
                                    <?php
                                        for ($i = 0; $i < 10; $i++) {
                                            echo "<option value='{$i}' >" . $i . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" id="submitForm" class="btn btn-primary btnCerca">Cerca</button>
                    </form>
                    
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
                                            // for ($i = 0; $i < count($ricerca); $i++) {
                                            //     echo "<tr>";
                                            //     echo "<td>" . $ricerca[$i]['seriale']. "</td>";
                                            //     echo "<td>" . $ricerca[$i]['tipo_articolo']. "</td>";
                                            //     echo "<td>" . $ricerca[$i]['sede']. "</td>";
                                            //     echo "<td>" . $ricerca[$i]['stato_articolo']. "</td>";
                                            //     echo "<td>" . "<a href=\"/dettaglioArticolo/{$ricerca[$i]['articolo_id']}\" class=\"btn btn-outline-dark btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettagli</a>". "</td>";
                                            //     echo "</tr>";
                                            // } 
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