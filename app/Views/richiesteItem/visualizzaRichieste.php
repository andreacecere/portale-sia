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
                         <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                         <li class="breadcrumb-item active">Visualizza richieste</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card card-outline card-primary">
             <div class="card-header" style='background-color:#fff'>
                 <h3 class="card-title">Richieste</h3>

                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                         title="Collapse">
                         <i class="fas fa-minus"></i></button>
                 </div>
             </div>
             <div class="card-body">
                 <form method='POST'>
                     <div class='container-fluid'>
                         <div class='row'>
                             <div class='col-md-4'>
                                 <label>Prodotto richiesto</label>
                                 <input type="text" class='form-control' name="prodotto_richiesto" maxlength='20'>
                             </div>
                             <div class='col-md-4'>
                                 <label>Destinatario</label>
                                 <select name="destinatario" id="destinatario" class='form-control select2bs4'
                                     style='width:100%'>
                                     <option></option>
                                     <?php 
                                    for($i=0; $i<count($lista_dipendenti); $i++){
                                        echo "<option value='{$lista_dipendenti[$i]['nome']} {$lista_dipendenti[$i]['cognome']}'>".ucfirst(strtolower($lista_dipendenti[$i]['nome']))." ".ucfirst(strtolower($lista_dipendenti[$i]['cognome']))."</option>"; 
                                    }
                                ?>
                                 </select>
                             </div>
                             <div class='col-md-4'>
                                 <label>Sede</label>
                                 <select name="sede" id="sede" class='form-control select2bs4' style='width:100%'>
                                     <option></option>
                                     <?php 
                                    for($i=0; $i<count($magazzino_sedi); $i++)
                                        echo "<option value='{$magazzino_sedi[$i]['magazzino_id']}'>".$magazzino_sedi[$i]['descrizioneMagazzino']."</option>"; 
                                ?>
                                 </select>
                             </div>
                             <div class='col-md-4'>
                                 <label>Commessa</label>
                                 <select name="commessa" id="commessa" class='form-control select2bs4'
                                     style='width:100%'>
                                     <option></option>
                                     <?php 
                                    for($i=0; $i<count($commesse); $i++){
                                        echo "<option value='{$commesse[$i]['commessa_id']}'>".ucfirst(strtolower($commesse[$i]['descrizione']))."</option>"; 
                                    }
                                ?>
                                 </select>
                             </div>
                             <div class='col-md-4'>
                                 <label>Effettuata da</label>
                                 <select name="effettuata_da" id="effettuata_da" class='form-control select2bs4'
                                     style='width:100%'>
                                     <option></option>
                                     <?php 
                                    for($i=0; $i<count($lista_dipendenti); $i++){
                                        echo "<option value='{$lista_dipendenti[$i]['nome']}.{$lista_dipendenti[$i]['cognome']}'>".ucfirst(strtolower($lista_dipendenti[$i]['nome']))." ".ucfirst(strtolower($lista_dipendenti[$i]['cognome']))."</option>"; 
                                    }
                                ?>
                                 </select>
                             </div>
                             <div class='col-md-4'>
                                 <label>Stato della richiesta</label>
                                 <select name="stati" id="stati" class='form-control select2bs4' style='width:100%'>
                                     <option></option>
                                     <?php 
                                    for($i=0; $i<count($stati); $i++){
                                        echo "<option value='{$stati[$i]['descrizione']}'>".ucfirst(strtolower($stati[$i]['descrizione']))."</option>"; 
                                    }
                                ?>
                                 </select>
                             </div>
                             <div class='col-md-4'>
                                 <br>
                                 <button type='submit' class='btn btn-success'>Ricerca</button>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
             <?php if ($showTable) : ?>
             <div class="card-body">
                 <div class='container-fluid'>
                     <div id='tabellaRichieste' style='display:none'>
                         <table id="tabella_elencoRichieste"
                             class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%"
                             cellspacing="0">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Prodotto richiesto</th>
                                     <th>Quantità</th>
                                     <th>Destinatario</th>
                                     <th>Sede</th>
                                     <th>Commessa</th>
                                     <th>Effettuata da</th>
                                     <th>Data richiesta</th>
                                     <!-- <th>Stato della richiesta</th> -->
                                     <th>Stato della richiesta</th>
                                     <th>Disponibilità</th>

                                 </tr>
                                 <tr class="filters">
                                     <th>ID</th>
                                     <th>Prodotto richiesto</th>
                                     <th>Quantità</th>
                                     <th>Destinatario</th>
                                     <th>Sede</th>
                                     <th>Commessa</th>
                                     <th>Effettuata da</th>
                                     <th>Data richiesta</th>
                                     <!-- <th>Stato della richiesta</th> -->
                                     <th>Stato della richiesta</th>
                                     <th>Disponibilità</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    for($i=0; $i<count($richieste); $i++){
                                        echo "<tr>";
                                        echo "<td class='richiesta_item_id'>".$richieste[$i]['richiesta_item_id']."</td>";
                                        echo "<td><button type=\"button\" class=\"btn btn-outline-info btn-sm btn-block modalProdotto\" data-toggle=\"modal\" data-target=\"#modal-default\">".ucfirst(strtolower($richieste[$i]['dsc_prodotto_richiesto']))."</button></td>";
                                        //echo "<td class='dsc_prodotto_richiesto'><a href='#' id='note' data-toggle='tooltip' data-placement='right' title='Note: ".$richieste[$i]['note']."'>".ucfirst(strtolower($richieste[$i]['dsc_prodotto_richiesto']))."</a></td>";
                                        echo "<td class='quantita'>".$richieste[$i]['quantita']." pz</td>";
                                        echo "<td>".strtolower($richieste[$i]['destinatario'])."</td>";
                                        echo "<td>".strtolower($richieste[$i]['sede'])."</td>";
                                        echo "<td>".strtolower($richieste[$i]['commessa'])."</td>";
                                        echo "<td>".strtolower($richieste[$i]['richiedente'])."</td>";
                                        echo "<td>".date('d/m/Y H:i:s',strtotime($richieste[$i]['data_richiesta']))."</td>";
                                        // echo "<td class='stato_richiesta'>".$richieste[$i]['stato_richiesta']."</td>";
                                        // echo "<td><select class='valori form-control form-control-sm'></select></td>";
                                        if ( $richieste[$i]['stato_richiesta'] == "annullata" ){
                                            echo "<td class='text-danger'><small>".strtoupper($richieste[$i]['stato_richiesta'])."</small></td>";
                                        }
                                        elseif ( $richieste[$i]['stato_richiesta'] == "evasa" ){
                                            echo "<td class='text-success'><small>".strtoupper($richieste[$i]['stato_richiesta'])."</small></td>";
                                        }
                                        else{
                                            echo "<td><select class='form-control form-control-sm valori'>";
                                            for($j=0; $j<count($stati); $j++){
                                                if ( $stati[$j]['descrizione'] == $richieste[$i]['stato_richiesta'] )
                                                    echo "<option  value='{$stati[$j]['stato_richiesta_id']}' selected>".$stati[$j]['descrizione']."</option>";
                                                else
                                                    echo "<option value='{$stati[$j]['stato_richiesta_id']}' >".$stati[$j]['descrizione']."</option>";
                                            }
                                            echo "</select></td>";
                                            // echo "</tr>";
                                            // echo "<td><button class='btn btn-primary btn-sm verifica'>Verifica</button></td>";                                       
                                        }
                                        echo "<td><button class='btn btn-primary btn-sm verifica'>Verifica</button></td>";                                       
                                        echo "</tr>";
                                    }
                                ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
             <?php endif ?>
             <!-- /.card-body -->
             <div class="card-footer" style='background-color:#fff'>
                 Footer
             </div>
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <div class="modal fade" id="modal-default">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Timeline <i class="fas fa-history"></i></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">

                 <ul class="timeline">
                 </ul>
                 <label>Note:</label>
                 <textarea id="note" class='form-control form-control-sm' style='resize:none;' disabled></textarea>
             </div>
             <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>


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

ul.timeline {
    list-style-type: none;
    position: relative;
}

ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}

ul.timeline>li {
    margin: 20px 0;
    padding-left: 20px;
}

ul.timeline>li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #0060A6;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
 </style>

 <!-- Script datatables -->
 <script>
$(window).on('load', function() {
    $('#tabellaRichieste').css('display', 'block');
});

$(document).ready(function() {

    $('#tabella_elencoRichieste thead .filters th').each(function() {
        var title = $('#tabella_elencoRichieste thead tr:eq(0) th').eq($(this).index()).text();
        $(this).html('<input type="text" class="form-control form-control-sm">');
    });

    // DataTable
    var table = $('#tabella_elencoRichieste').DataTable({
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
                    columns: [2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [2, 3, 4, 5, 6, 7, 8]
                }
            },
        ],
        "columnDefs": [{
                "targets": [0],
                "visible": true,
                "searchable": true
            },
            {
                "targets": [0],
                "visible": false
            }
        ],
        "order": [[ 7, "asc" ]]
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
    $(document).ready(function() {
        // console.log("stato_richiesta: "+$('.stato_richiesta').text())
        // $(".valori").append(new Option("", ""));
        // $.ajax({
        //     type: "GET",
        //     url: "getStatoRichiesta",
        //     success: function (response) {
        //         var json = JSON.parse(response);
        //         for(var i=0; i<json.length; i++){
        //             //console.log(json[i]['descrizione'])

        //             if ( json[i]['descrizione'] != "da prendere in carico" ){
        //                 $(".valori").append(new Option(json[i]['descrizione'], json[i]['stato_richiesta_id']));

        //             }
        //         }
        //     }
        // }); 

        $('.valori').change(function() {
            var conferma = confirm(
                "Attenzione, procedendo verrà effettuato un cambio di stato per la richiesta corrente, vuoi continuare?"
            )
            if (conferma) {
                var $row = $(this).closest("tr");
                var $text = $row.find(".dsc_prodotto_richiesto").text();
                var $richiesta_item_id = $row.find(".richiesta_item_id").text();
                //alert("Stato: "+$(this).val()+" Dsc_prodotto: "+$text+" id_Richiesta: "+$richiesta_item_id)
                var stato_richiesta = $(this).val();
                var richiesta_item_id = $richiesta_item_id;

                $.ajax({
                    type: "POST",
                    url: "cambioStatoRichiesta",
                    data: {
                        stato_richiesta: stato_richiesta,
                        richiesta_item_id: richiesta_item_id
                    },
                    success: function(response) {
                        location.reload();
                        console.log(response)
                    }
                });
            }


        });

        $(".verifica").click(function() {
            var btn = $(this);
            var $row = $(this).closest("tr");
            var $text = $row.find(".dsc_prodotto_richiesto").text();
            var richiesta_item_id = $row.find(".richiesta_item_id").text();
            var quantita = $row.find(".quantita").text();
            // alert(richiesta_item_id+" "+quantita)
            //alert($(this).html())

            $.ajax({
                type: "GET",
                url: "verificaDisponibilita/"+richiesta_item_id+"/"+quantita.replace("pz","").trim(),
                success: function (response) {    
                    console.log(response)
                    if ( response == "disponibile" ){
                        btn.addClass("btn btn-success").html("<i class=\"fas fa-check\"></i>")
                    }
                    else{
                        btn.addClass("btn btn-danger").html("<i class=\"fas fa-times\"></i> <small>"+response+"</small>")
                    }   
                }
            });
        });

        $('[data-toggle="tooltip"]').tooltip();

        $('.modalProdotto').click(function(){
            $('.timeline').html("")
            var $row = $(this).closest("tr");
            var $text = $row.find(".dsc_prodotto_richiesto").text();
            var $richiesta_item_id = $row.find(".richiesta_item_id").text();
            $.ajax({
                type: "GET",
                url: "/timelineRichiesta/"+$richiesta_item_id,
                success: function (response) {
                    // console.log(response) 
                    var json = JSON.parse(response);
                    for(var i=0; i<json.length; i++){
                        $('.timeline').append("<li>\
                                <a target=\"#\" style='margin-left:30px;'><b>"+json[i]['stato_descrizione_richiesta']+"</b></a>\
                                <a href=\"#\" class=\"float-right\" style='margin-left:30px;'>"+json[i]['data_aggiornamento_richiesta']+"</a>\
                                <p style='margin-left:30px;'><small>Operazione eseguita da: "+json[i]['username']+"</small></p>\
                            </li>");                    
                    }
                    $('#note').html(json[0]['note']);
                    
                }
            });
        });


    });


});
 </script>