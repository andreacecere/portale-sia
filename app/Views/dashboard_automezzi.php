 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style='background-color:white'>
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Dashboard</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">

                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content" style='margin-top:30px;'>
         <div class='container-fluid'>
             <div class='row'>
                 <!-- <div class='col-md-4 col-sm-4' style='color:#fff'>
                     <div class="info-box" style='background: linear-gradient(to right,#0060A6, #00ADE8);'>
                         <div class="info-box-content">
                             <span class="info-box-text" style='color:#fff'>Terminali</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'>Disponibili:
                                     <?php echo $cntTerminaliLiberi[0]['seriale']; ?></a></span> / Affidati:
                                 <?php echo $cntTerminaliAffidati[0]['seriale']; ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div> -->
                 <!-- <div class='col-md-4 col-sm-4' style='color:#fff'>
                     <div class="info-box" style='background: linear-gradient(to right,#0060A6, #00ADE8);'>
                         <div class="info-box-content">
                             <span class="info-box-text" style='color:#fff'>Sim</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'>Disponibili:
                                     <?php echo $cntSimLiberi[0]['seriale']; ?></a></span> / Affidati:
                                 <?php echo $cntSimLiberiAffidati[0]['seriale']; ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div> -->
                 <!-- <div class='col-md-4 col-sm-4' style='color:#fff'>
                     <div class="info-box" style='background: linear-gradient(to right,#0060A6, #00ADE8);'>
                         <div class="info-box-content">
                             <span class="info-box-text" style='color:#fff'>Moduli di affido</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'>Da caricare:
                                     <?php echo $documenti_da_caricare[0]['affidamento_modulo']; ?></a></span> /
                                 Caricati:
                                 <?php echo $documenti_caricati[0]['affidamento_modulo']; ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div> -->
                 <!-- <div class='col-md-4 col-sm-4' style='color:#fff'>
                     <div class="info-box" style='background: linear-gradient(to right,#0060A6, #00ADE8);'>
                         <div class="info-box-content">
                             <span class="info-box-text" style='color:#fff'>Attestati di formazione</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'>
                                     <?php echo $attestati_formazione; ?></span>
                             </div>
                         </div>
                     </div>
                 </div> -->
                 <!-- <div class='col-md-4 col-sm-4' style='color:#fff'>
                     <div class="info-box" style='background: linear-gradient(to right,#0060A6, #00ADE8);'>
                         <div class="info-box-content">
                             <span class="info-box-text" style='color:#fff'>Commesse</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'><a href='gestioneCommesse'
                                         style='color:#fff'><?php echo $commesse[0]['descrizione']; ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div> -->
                 <div class='col-md-6 col-sm-6' style='color:#fff'>
                     <div class="info-box" style='background: linear-gradient(to right,#0060A6, #00ADE8);'>
                         <div class="info-box-content">
                             <span class="info-box-text" style='color:#fff'>Automezzi</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'><a href='#'
                                         style='color:#fff'><?php echo "<small>(da implementare)</small>" ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class='col-md-6 col-sm-6' style='color:#fff'>
                     <div class="info-box" style='background: linear-gradient(to right,#0060A6, #00ADE8);'>
                         <div class="info-box-content">
                             <span class="info-box-text" style='color:#fff'>Schede carburanti</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'><a href='#'
                                         style='color:#fff'><?php echo $totale_schede_carburanti[0]['numero_carta']; ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
     </section>

     <div class="container-fluid" style='margin-top:30px'>
         <div class="card card-outline card-primary">
             <div class="card-header" style='background-color:#fff'>
                 <h3 class="card-title text-danger">Schede carburanti con importi maggiori di <b>100 €</b></h3>
                 <div class="card-tools">
                 </div>
             </div>
             <div class="card-body">
                 <table id="tabella_risorse" class="table table-sm table-striped table-bordered dt-responsive nowrap"
                     width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Scheda carburante</th>
                             <th>Importo</th>
                         </tr>
                         <tr class="filters">
                             <th>Scheda carburante</th>
                             <th>Importo</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php 
                                for($i=0; $i<count($schede_carburanti); $i++){
                                    echo "<tr>"; 
                                    echo "<td><a href='/dettaglioConsumiCarburante/{$schede_carburanti[$i]['numero_carta']}'>".ucfirst(strtolower($schede_carburanti[$i]['numero_carta']))."</a></td>";
                                    echo "<td class='text-danger'><b>".ucfirst(strtolower($schede_carburanti[$i]['importo']))." €</b></td>";
                                    echo "</tr>"; 
                                }
                             ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

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
 <script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

});
 </script>
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
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Italian.json",
                
            }
            ,dom: 'Bfrtip',
                buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0,1 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0,1 ]
                    }
                },
            ],
            "order": [[ 1, "desc" ]]
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