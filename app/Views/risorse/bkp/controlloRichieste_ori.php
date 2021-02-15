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
                         <li class="breadcrumb-item active">Richieste pendenti</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title">Richieste pendenti</h3>

                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                         <i class="fas fa-minus"></i></button>
                 </div>
             </div>

             <div class="card-body">
                <table id="tabella_elencoRisorse" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0" style='font-size:14px;'>
                    <thead>
                        <tr>
                            <!-- <th>ID Movimento</th> -->
                            <!-- <th>ID Affido</th> -->
                            <th>Data Richiesta</th>
                            <th>Data Inizio servizio</th>
                            <th>Nominativo spostamento</th>
                            <th>Magazzino Da - A</th>
                            <!-- <th>Magazzino destinazione</th> -->
                            <th>Commessa Da - A</th>
                            <!-- <th>Commessa destinazione</th> -->
                            <th>Seriale</th>
                            <!-- <th>Tipologia articolo</th> -->
                            <th>Riferimento commessa</th>
                            <th>Azione</th>
                        </tr>
                        <tr class="filters">
                            <!-- <th>ID Movimento</th> -->
                            <!-- <th>ID Affido</th> -->
                            <th>Data Richiesta</th>
                            <th>Data Inizio servizio</th>
                            <th>Nominativo spostamento</th>
                            <th>Magazzino Da - A</th>
                            <!-- <th>Magazzino destinazione</th> -->
                            <th>Commessa Da - A</th>
                            <!-- <th>Commessa destinazione</th> -->
                            <th>Seriale</th>
                            <!-- <th>Tipologia articolo</th> -->
                            <th>Riferimento commessa</th>
                            <th>Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($listaMovimento); $i++) {
                            echo "<tr>";
                            echo "<td>" . date('d/m/Y',strtotime($listaMovimento[$i]['movimento_data_richiesta'])). "</td>";
                            echo "<td>" . date('d/m/Y',strtotime($listaMovimento[$i]['movimento_data_inizio_servizio'])). "</td>";
                            echo "<td>" . ucfirst($listaMovimento[$i]['nominativo_spostamento']). "</td>";
                            echo "<td>" . ucfirst($listaMovimento[$i]['magazzino_provenienza_dsc'])." - ".ucfirst($listaMovimento[$i]['magazzino_destinazione_dsc'])."</td>";
                            echo "<td>" . ucfirst($listaMovimento[$i]['commessa_provenienza'])." - ". ucfirst($listaMovimento[$i]['commessa_destinazione']). "</td>";
                            echo "<td>" . ucfirst($listaMovimento[$i]['articolo_seriale'])." - ".ucfirst($listaMovimento[$i]['descrizione']). "</td>";
                            echo "<td>" . ucfirst($listaMovimento[$i]['nominativo_responsabile_commessa']). "</td>";
                            echo "<td><button class='btn btn-success btn-sm'>OK</button> | <button class='btn btn-danger btn-sm'>NO</button></td>";
                           
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
             </div>
             <!-- /.card-body -->
             <div class="card-footer">
                 Footer
             </div>
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 
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
        $('#tabella_elencoRisorse thead .filters th').each(function() {
            var title = $('#tabella_elencoRisorse thead tr:eq(0) th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control form-control-sm">');
        });

        // DataTable
        var table = $('#tabella_elencoRisorse').DataTable({
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