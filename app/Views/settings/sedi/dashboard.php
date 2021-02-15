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
                        <li class="breadcrumb-item active"><?php echo $nomePagina; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card card-outline card-primary">
                <div class="card-header" style="background-color: white;">
                    <h3 class="card-title"><?php echo $headerCard; ?></h3>
                    <br>
                    <div class="card-tools">
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button> -->
                        <a href='/aggiungiSede'><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Aggiungi sede"><i class="fas fa-plus-circle"></i></button></a>
                        <!-- <a href='#'><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Scarica report"><i class="far fa-file-excel"></i></button></a> -->
                        
                    </div>
                </div>
                <div class="card-body">
                    <!-- <table id="tabella" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0"> -->
                    <table id="tabella" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                        <thead>
                            <tr>
                                <th>Sede</th>
                                <th>Magazziniere</th>
                                <th>Indirizzo</th>
                                <th>Località</th>
                                <th>Recapito</th>
                                <th>Email</th>
                                <th>Azioni</th>
                            </tr>
                            <tr class="filters">
                                <th>Sede</th>
                                <th>Magazziniere</th>
                                <th>Indirizzo</th>
                                <th>Località</th>
                                <th>Recapito</th>
                                <th>Email</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            for ($i = 0; $i < count($sedi); $i++) {
                                echo "<tr>";
                                echo "<td>" . ucfirst(strtolower($sedi[$i]['descrizioneMagazzino'])) . "</td>";
                                echo "<td>" . ucfirst(strtolower($sedi[$i]['magazziniere'])) . "</td>";
                                echo "<td>" . ucfirst(strtolower($sedi[$i]['indirizzo'])) . "</td>";
                                echo "<td>" . ucfirst(strtolower($sedi[$i]['localita'])) . "</td>";
                                echo "<td>" . ucfirst(strtolower($sedi[$i]['telefono'])) . "</td>";
                                echo "<td><a href='mailto:{$sedi[$i]['email']}'>" . strtolower($sedi[$i]['email']) . "</a></td>";
                                echo "<td><a href='" . base_url() . "/dettaglioSede/{$sedi[$i]['magazzino_id']}'><button class='btn btn-sm btn-outline-danger'>Dettagli</button></a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer-->
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


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
        $('#tabella thead .filters th').each(function() {
            var title = $('#tabella thead tr:eq(0) th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control form-control-sm">');
        });

        var table = $('#tabella').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            responsive: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Italian.json"
            },
            dom: 'Bfrtip',
                buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: "btn-primary",
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
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>