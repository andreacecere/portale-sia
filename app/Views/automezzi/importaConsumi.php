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
                        <li class="breadcrumb-item active">Importa consumi</li>
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
                    <h3 class="card-title">Importa consumi</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="file_consumi">File dei consumi carburante</label>
                            <input type="file" class='form-control' id="file" name="file" accept="application/vnd.ms-excel"/>
                        </div>
                        <div class="form-group col-sm-6" style='width:100%'>
                            <label for="fornitore">Fornitore</label>
                            <select class="form-control select2bs4" name="fornitore" id="fornitore">
                                <?php
                                        for ($i = 0; $i < count($fornitori_carb); $i++) {
                                            echo "<option value='{$fornitori_carb[$i]['fornitore_id']}' >" . $fornitori_carb[$i]['ragione_sociale'] . "</option>";
                                        }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <button disabled type="button" class="btn btn-primary btn-sm btnOpenModal" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false"> 
                        Carica il file
                    </button>
                </div>
            </div>

        </div>
</div>
</section>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Attenzione</h4>
            </div>
            <div class="modal-body">
                <p class='text-danger'>Attenzione, stai per caricare il file dei consumi vuoi realmente procedere ? </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id='close'>Chiudi</button>
                <button type="button" class="btn btn-primary" id='caricaFile'>Carica il file</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

    $('#file').change(function(){
        if ( $(this).val() != "" ){
            $('.btnOpenModal').removeAttr('disabled','disabled');
        }
        else{
            $('.btnOpenModal').attr('disabled','disabled');
        }
    });
    
    $('#caricaFile').click(function(e){
        $('#caricaFile').html("<button class=\"btn btn-primary btn-sm\" disabled>\
                                <span class=\"spinner-border spinner-border-sm\"></span>\
                                 Elaborazione in corso...\
                                </button>");
        $('#close').attr('disabled','disabled');
        var formData = new FormData();
        formData.append('file', $('#file')[0].files[0]);
        formData.append('fonitore', $('#fornitore').val());
        $.ajax({
            type: "POST",
            url: "caricaFileConsumi",
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                
            },
            complete:function(){
                alert("Elaborazione completata, a breve verrà ricaricata la pagina");
                setInterval(() => {
                    location.reload();
                }, 2000);
            }
        });
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
        },
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3]
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