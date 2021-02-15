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
                         <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                         <li class="breadcrumb-item active">Gestione attestati</li>
                         <li class="breadcrumb-item active">Inserisci attestato</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card card-outline card-primary">
             <div class="card-header" style='background-color:#fff!important;'>
                 <h3 class="card-title">Inserisci nuovo attestato</h3>

                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                         title="Collapse">
                         <i class="fas fa-minus"></i></button>
                 </div>
             </div>
             <div class="card-body">
             <?php if (session()->get('inserimento_avvenuto')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('inserimento_avvenuto') ?>
                </div>
            <?php endif; ?>
                 <form method="post">
                     <div class="form-row">
                         <div class="form-group col-md-6">
                             <label for="inputEmail4">Descrizione</label>
                             <input type="text" class="form-control" minlength='3' maxlength='255' name='descrizione'   required >
                         </div>
                         <div class="form-group col-md-6">
                             <label for="inputPassword4">Durata in mesi</label>
                             <input type="number" class="form-control" min='1' max='90' name='durata_in_mesi' required >
                         </div>
                     </div>
                     <button type='submit' class='btn btn-success btn-sm'>Inserisci attestato</button>
                 </form>
             </div>
             <!-- /.card-body -->
         </div>
         <!-- /.card -->
     </section>
     <section class="content">
         <!-- Default box -->
         <div class="card card-outline card-success">
             <div class="card-header" style='background-color:#fff!important;'>
                 <h3 class="card-title" >Elenco attestati</h3>

                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                         title="Collapse">
                         <i class="fas fa-minus"></i></button>
                 </div>
             </div>
             <div class="card-body">
                 <table id="tabella_risorse" style="text-align:center;" class="table table-sm table-striped table-bordered dt-responsive nowrap"
                     width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Descrizione attestato</th>
                             <th>Durata <small>( mesi )</small></th>
                             <th>Visibile</th>
                             <th>Azione</th>
                         </tr>
                         <tr class="filters">
                             <th>Descrizione attestato</th>
                             <th>Durata</th>
                             <th>Visibile</th>
                             <th>Azione</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                                for ($i = 0; $i < count($attestati_presenti); $i++) {
                                    $visibile = $attestati_presenti[$i]['visibile']  == 1 ? 'Si' : 'No';
                                    echo "<tr>";
                                    echo "<td>" .mb_strtoupper ( $attestati_presenti[$i]['descrizione']) . "</td>";
                                    echo "<td>" . $attestati_presenti[$i]['durata_mesi'] . "</td>";
                                    echo "<td>" . $visibile . "</td>";
                                    echo "<td>" . "<a href=\"/dettaglioAttestato/{$attestati_presenti[$i]['attestato_id']}\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettaglio</a>" ."</td>";
                                    echo "</tr>";
                                }
                                ?>
                     </tbody>
                 </table>
             </div>
             <!-- /.card-body -->
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