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
        <!-- Default box -->
        <div class="card card-outline card-primary">
            <div class="card-header" style="background-color: white;">
                <h3 class="card-title"><?php echo $headerCard; ?></h3>
                <br>
                <div class="card-tools">
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button> -->
                    <a href='/aggiungiUtente'><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Abilita utente"><i class="fas fa-user-lock"></i></button></a>
                    <!-- <a href='#'><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Scarica report"><i class="far fa-file-excel"></i></button></a> -->
                </div>
            </div>
            <div class="card-body">
                <table id="tabella" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Attivo</th>
                            <th>Nominativo</th>
                            <th>Ruolo</th>
                            <th>Commessa</th>
                            <th>Azienda</th>
                            <th>Ultimo accesso</th>
                            <th>Azioni</th>
                        </tr>
                        <tr class="filters">
                            <th>Attivo</th>
                            <th>Nominativo</th>
                            <th>Ruolo</th>
                            <th>Commessa</th>
                            <th>Azienda</th>
                            <th>Ultimo accesso</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        for ($i = 0; $i < count($utenti); $i++) {
                            echo "<tr>";
                            echo "<td>" . ucfirst(strtolower($utenti[$i]['utente_attivo_descrizione'])) . "</td>";
                            echo "<td>" . ucfirst(strtolower($utenti[$i]['nome']) . " " . ucfirst(strtolower($utenti[$i]['cognome']))) . "</td>";
                            echo "<td>" . ucfirst(strtolower($utenti[$i]['ruolo'])) . "</td>";
                            echo "<td>" . ucfirst(strtolower($utenti[$i]['commessa'])) . "</td>";
                            echo "<td>" . ucfirst(strtolower($utenti[$i]['azienda'])) . "</td>";
                            echo "<td>" . $utenti[$i]['utente_ultimo_accesso'] . "</td>";
                            echo "<td><a href='" . base_url() . "/dettaglioUtente/{$utenti[$i]['utente_id']}'><button class='btn btn-sm btn-outline-danger'>Dettagli</button></a></td>";
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
        $('#tabella thead .filters th').each(function() {
            var title = $('#tabella thead tr:eq(0) th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control form-control-sm">');
        });

        // DataTable
        var table = $('#tabella').DataTable({
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


    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>