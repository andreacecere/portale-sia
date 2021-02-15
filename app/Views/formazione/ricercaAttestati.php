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
                         <li class="breadcrumb-item active">Ricerca attestati</li>
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
                 <h3 class="card-title">Ricerca attestati</h3>

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
                         <div class="form-group col-md-4">
                            <label for="inputEmail4">Nominativo</label>
                            <select class="form-control select2bs4 anagrafica_id" name="anagrafica_id">
                                <option value="" selected></option>
                                <?php
                                    for ($i = 0; $i < count($elencoRisorse); $i++) {
                                        echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}' >" . $elencoRisorse[$i]['nome'] . ' ' . $elencoRisorse[$i]['cognome'] . "</option>";
                                    }
                                ?>
                            </select>
                         </div>
                         <div class="form-group col-md-4">
                             <label for="inputPassword4">Mansione</label>
                             <select class="form-control select2bs4 id_mansione" name="id_mansione">
                             <option value="" selected></option>
                                <?php
                                    for ($i = 0; $i < count($elencoMansioni); $i++) {
                                        echo "<option value='{$elencoMansioni[$i]['id_mansione']}' >" . $elencoMansioni[$i]['descrizione']. "</option>";
                                    }
                                ?>
                            </select>
                         </div>
                         <div class="form-group col-md-4">
                             <label for="inputPassword4">Commessa</label>
                             <select class="form-control select2bs4 commessa_id" name="commessa_id">
                             <option value="" selected></option>
                                <?php
                                    for ($i = 0; $i < count($elencoCommesse); $i++) {
                                        echo "<option value='{$elencoCommesse[$i]['commessa_id']}' >" . $elencoCommesse[$i]['descrizione']. "</option>";
                                    }
                                ?>
                            </select>
                         </div>
                         <!-- <div class="form-group col-md-3">
                             <label for="inputPassword4">Inizio contratto</label>
                             <input type="date" class="form-control data_inizio_contratto" name='data_inizio_contratto'>
                         </div> -->
                         <div class="form-group col-md-4">
                             <label for="inputPassword4">In forze fino al</label>
                             <input type="date" class="form-control data_fine_contratto" name='data_fine_contratto'>
                         </div>
                         <div class="form-group col-md-4">
                             <label for="inputPassword4">Tipo certificato</label>
                             <select class="form-control select2bs4 tipologia_attestato_id" name="tipologia_attestato_id">
                             <option value="" selected></option>
                                <?php
                                    for ($i = 0; $i < count($elencoAttestati); $i++) {
                                        echo "<option value='{$elencoAttestati[$i]['attestato_id']}' >" . $elencoAttestati[$i]['descrizione']. "</option>";
                                    }
                                ?>
                            </select>
                         </div>
                         <div class="form-group col-md-4">
                             <label for="inputPassword4">Contratto</label>
                             <select class="form-control select2bs4 contratto" name="contratto">
                                <option value="" selected></option>
                                <option value="TI">Tempo Indeterminato</option>
                                <!-- <option value="TD">Tempo Determinato</option> -->
                            
                            </select>
                         </div>
                         <!-- <div class="form-group col-md-3">
                             <label for="inputPassword4">Attivi alla data</label>
                             <input type="date" class="form-control" name='durata_in_mesi' disabled>
                         </div> -->
                     </div>
                     <button type='submit' class='btn btn-success btn-sm btnRicerca'>Ricerca</button>
                 </form>
             </div>
             <!-- /.card-body -->
         </div>
         <!-- /.card -->
     </section>
     <?php if ($showTable) : ?>
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
                 <table id="tabella_risorse" class="table table-sm table-striped table-bordered dt-responsive nowrap"
                     width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Nominativo</th>
                             <th>Commessa</th>
                             <th>Mansione</th>
                             <th>Attestato</th>
                             <th>Attestato valido dal - al</th>
                             <th>Allegato</th>
                         </tr>
                         <tr class="filters">
                             <th>Nominativo</th>
                             <th>Commessa</th>
                             <th>Mansione</th>
                             <th>Attestato</th>
                             <th>Attestato valido dal</th>
                             <th>Allegato</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                                for ($i = 0; $i < count($ricercaAttestati); $i++) {
                                    echo "<tr>";
                                    echo "<td>" . ucfirst(strtolower($ricercaAttestati[$i]['nominativo'])) . "</td>";
                                    echo "<td>" . ucfirst(strtolower($ricercaAttestati[$i]['descrizione_commessa'])) . "</td>";
                                    echo "<td>" . ucfirst(strtolower($ricercaAttestati[$i]['descrizione_mansione'])) . "</td>";
                                    echo "<td>" . ucfirst(strtolower($ricercaAttestati[$i]['descrizione'])) . "</td>";
                                    echo "<td>" . date('d/m/Y',strtotime($ricercaAttestati[$i]['data_inizio'])) ." - ".date('d/m/Y',strtotime($ricercaAttestati[$i]['data_fine']))."</td>";
                                    // echo "<td>" . date('d/m/Y',strtotime($ricercaAttestati[$i]['data_fine'])) . "</td>";
                                    if ( $ricercaAttestati[$i]['allegato'] == 1 ){
                                        $descrizione_attestato = str_replace(" ","_",$ricercaAttestati[$i]['descrizione']); 
                                        echo "<td><a href='/upload/attestati_formazione/{$ricercaAttestati[$i]['anagrafica_id']}/attestato_{$descrizione_attestato}.pdf' target='_blank'><i class='fas fa-file-signature text-success'></i></a></td>";
                                    }
                                    else
                                        echo "<td><i class='fas fa-file-signature text-danger'></i><small class='text-danger'><i>Allegato non presente</i></small></td>";
                                    // echo "<td>" . "<a href=\"/dettaglioAttestato/{$attestati_presenti[$i]['attestato_id']}\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettaglio</a>" ."</td>";
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
     <?php endif ?>
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

    $('.contratto').change(function(){
        if ( $(this).val() == "TI" )
            $('.data_fine_contratto').attr('disabled','disabled')
        else
            $('.data_fine_contratto').removeAttr('disabled','disabled')
    })

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
                        columns: [ 0,1,2,3,4,5]
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