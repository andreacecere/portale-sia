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
                         <li class="breadcrumb-item active">Controllo richieste</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card card-outline card-primary">
             <div class="card-header">
                 <h3 class="card-title">Controllo richieste</h3>
                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                         <i class="fas fa-minus"></i></button>
                 </div>
             </div>
             <div class="card-body">
            <?php $json = json_decode($listaMovimento,true); ?>
             <!-- <table class="table table-hover" style='margin-top:-50px;'> -->
             <table id="tabella_elencoRisorse" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0" style='font-size:14px;'>
             <thead>
                <tr>
                    
                    <th>Data Richiesta</th>
                    <th>Data Inizio servizio</th>
                    <th>Nominativo spostamento</th>
                    <th>Magazzino Da - A</th>
                    <th>Commessa Da - A</th>
                    <th>Seriale</th>
                    <th>Stato movimento</th>
                    <th>Riferimento commessa</th>
                </tr>
                <!-- <tr class='filters'>
                    
                    <th>Data Richiesta</th>
                    <th>Data Inizio servizio</th>
                    <th>Nominativo spostamento</th>
                    <th>Magazzino Da - A</th>
                    <th>Commessa Da - A</th>
                    <th>Stato movimento</th>
                    <th>Seriale</th>
                    <th>Riferimento commessa</th>
                </tr> -->
            </thead>
            <tbody>
             <?php 
                
                // echo "<pre>";
                // //print_r($json);
                // echo "</pre>";

                for($i=0; $i<count($json); $i++){
                    //echo "A"."<br>";
                    
                    // echo "<tbody>";
                    
                    for($j=0; $j<count($json[$i]); $j++){
                        //echo $json[$i][$j]['nominativo_spostamento'];
                        //echo "B"."<br>";
                        echo "<tr>
                            <td>".date('d/m/Y',strtotime($json[$i][$j]['movimento_data_richiesta']))."</td>
                            <td>".date('d/m/Y',strtotime($json[$i][$j]['movimento_data_inizio_servizio']))."</td>
                            <td>".ucfirst($json[$i][$j]['nominativo_spostamento'])."</td>
                            <td>".ucfirst($json[$i][$j]['magazzino_provenienza_dsc'])." - ".ucfirst($json[$i][$j]['magazzino_destinazione_dsc'])."</td>
                            <td>".ucfirst($json[$i][$j]['commessa_provenienza'])." - ".ucfirst($json[$i][$j]['commessa_destinazione'])."</td>
                            <td>".ucfirst($json[$i][$j]['articolo_seriale'])." - ".ucfirst($json[$i][$j]['descrizione'])."</td>"; 
                            if ( $json[$i][$j]['movimento_stato'] == 'sposta' )
                                echo "<td class='text-danger'>".ucfirst($json[$i][$j]['movimento_stato'])."</td>"; 
                            else
                                echo "<td class='text-success'>".ucfirst($json[$i][$j]['movimento_stato'])."</td>"; 
                            echo "<td>".ucfirst($json[$i][$j]['nominativo_responsabile_commessa'])."</td>
                        </tr>";
                    }
                    echo "<tr>
                            
                            <td><button class='btn btn-success btn-sm btnConsenti' value='{$json[$i][$j-1]['richiesta_id']}' data-toggle='modal' data-target='#confermaRichiestaModal'><i class=\"fas fa-check\"></i> Consenti</button> <button class='btn btn-danger btn-sm btnRifiuta' value='{$json[$i][$j-1]['richiesta_id']}' data-toggle='modal' data-target='#annullaRichiestaModel'><i class=\"far fa-trash-alt\"></i> Rifiuta</button></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td><td></td><td></td><td></td>
                        </tr>";
                    
                        echo "</tbody>";
                    }
                

                //echo $json[0][1]->movimento_id;
                // echo $json[1][0]->movimento_id;
             ?>
            <!-- </tbody> -->
             </table>
             </div>
             <div class="card-footer">
             </div>
         </div>
     </section>
 </div>

 <div class="modal fade" id="confermaRichiestaModal" tabindex="-1" role="dialog" aria-labelledby="confermaRichiestaModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Consenti trasferimento risorse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <p>Vuoi consentire il trasferimento della risorsa con gli item in suo possesso?</p>
                    <p class='text-danger'>Attenzione, la procedura è irreversibile.La conferma genererà l'invio di una mail</p>
                    <p id='id_consentire' style='display:none;'></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" value="formConferma" id="confermaDialog" name="submitForm" class="btn btn-primary">Conferma</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="annullaBtnConferma">Annulla</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="annullaRichiestaModel" tabindex="-1" role="dialog" aria-labelledby="annullaRichiestaModel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rifiuta trasferimento risorse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <p class='text-danger'>Attenzione, rifiutando la richiesta la risorsa e i suoi item non verranno spostati.<br>La conferma genererà l'invio di una mail</p>
                    <p id='id_rifiuta' style='display:none;'></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" value="formConferma" id="rifiutaDialog" name="submitForm" class="btn btn-primary">Conferma</button>
                <button type="button" class="btn btn-danger" id="annullaBtnRifiuto" data-dismiss="modal">Annulla</button>
            </div>
            </form>
        </div>
    </div>
</div>

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
            },
            "lengthMenu": [[100, 150, 200, -1], [100, 150, 200, "Tutti"]],
            "ordering": false,
            "searching": false
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

    $(document).ready(function () {
        
        $('.btnConsenti').click(function(){
            //alert($(this).val())
            $('#id_consentire').text($(this).val())
        });

        $('.btnRifiuta').click(function(){
            //alert($(this).val())
            $('#id_rifiuta').text($(this).val())
        });

        $('#confermaDialog').click(function(){
            //alert("Conferma lo spostamento");
            $(this).attr('disabled','disabled')
            $(this).html("<button class=\"btn btn-primary btn-sm\" type=\"button\" disabled>\
                            <span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span> Invio email in corso...\
                            <span class=\"sr-only\">Loading...</span>\
                            </button>");
            $('#annullaBtnConferma').attr("disabled","disabled");
            $.ajax({
                type: "GET",
                url: "/confermaSpostamento/"+$('#id_consentire').text(),
                success: function (response) {
                    location.reload();
                },                
            });
        });
        $('#rifiutaDialog').click(function(){
            $(this).attr('disabled','disabled')
            $(this).html("<button class=\"btn btn-primary btn-sm\" type=\"button\" disabled>\
                            <span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span> Invio email in corso...\
                            <span class=\"sr-only\">Loading...</span>\
                            </button>");
            $('#annullaBtnRifiuto').attr("disabled","disabled");
            $.ajax({
                type: "GET",
                url: "/confermaRifiuto/"+$('#id_rifiuta').text(),
                success: function (response) {
                    location.reload();
                }
            });
        });


    });
</script>