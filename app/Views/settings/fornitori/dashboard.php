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
             <div class="card-header"  style="background-color: white;">
                 <h3 class="card-title"><?php echo $headerCard; ?></h3>
                 <br>
                 <div class="card-tools">
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button> -->
                        <a href='/aggiungiFornitore'><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Aggiungi fornitore"><i class="fas fa-plus-circle"></i></button></a>
                        <!-- <a href='#'><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="Scarica report"><i class="far fa-file-excel"></i></button></a> -->
                    </div>
                </div>
                <div class="card-body">
                <table id="tabella" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Ragione sociale</th>
                            <th>P.IVA</th>
                            <th>Indirizzo</th>
                            <th>Recapito telefonico</th>
                            <th>Email</th>
                            <th>Tipologia</th>
                            <th>Azioni</th>
                        </tr>
                        <tr class='filters'>
                            <th>Ragione sociale</th>
                            <th>P.IVA</th>
                            <th>Indirizzo</th>
                            <th>Recapito telefonico</th>
                            <th>Email</th>
                            <th>Tipologia</th>
                            <th>Azioni</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        
                        <?php 
                            for($i=0; $i<count($fornitori); $i++){
                                echo "<tr>";
                                echo "<td>".ucfirst(strtolower($fornitori[$i]['ragione_sociale']))."</td>";
                                echo "<td>".ucfirst(strtolower($fornitori[$i]['partita_iva']))."</td>";
                                echo "<td>".ucfirst(strtolower($fornitori[$i]['indirizzo']))."</td>";
                                echo "<td>".ucfirst(strtolower($fornitori[$i]['telefono']))."</td>";
                                echo "<td><a href='mailto:{$fornitori[$i]['email']}'>".strtolower($fornitori[$i]['email'])."</a></td>";
                                echo "<td>".ucfirst(strtolower($fornitori[$i]['descrizione_tipologia_fornitore']))."</td>";
                                echo "<td><a href='".base_url()."/dettaglioFornitore/{$fornitori[$i]['fornitore_id']}'><button class='btn btn-sm btn-outline-danger'>Dettagli</button></a></td>";
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


 <!-- Script datatables -->
 <style>
.filters input {
    width: 100%;
    padding: 3px;
    box-sizing: border-box;
}
@media screen and (max-width: 937px) {
    .filters{
        display:none;
    }
}

</style>

 <!-- Script datatables -->
<script>
$(document).ready(function() {
    $('#tabella thead .filters th').each(function() {
        var title = $('#tabella thead tr:eq(0) th').eq($(this).index()).text();
        // if ( title == "tipologia" )
            $(this).html('<input type="text" class="form-control form-control-sm">');
        // else
        //     $(this).html('<input type="text" class="form-control form-control-sm">');
    });

    // DataTable
    var table = $('#tabella').DataTable( {
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
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

</script>