


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <!-- card-header -->
                <div class="card-header" style="background-color: white;">
                    <h3 class="card-title">Elenco risorse</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" class="" action="">
                        <div class="form-row">
                            <div class="col">
                                <select class="form-control select2bs4" name="input_anagrafica_id" id="input_anagrafica_id">
                                    <option value="" disabled selected></option>
                                    <?php

                                        if (count($elencoRisorse)==1)
                                            echo "<option  selected value='{$elencoRisorse[0]['anagrafica_id']}' >" . $elencoRisorse[0]['nome'] . ' ' . $elencoRisorse[0]['cognome'] . "</option>";
                                        else{
                                            for ($i = 0; $i < count($elencoRisorse); $i++) {
                                                echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}' >" . $elencoRisorse[$i]['nome'] . ' ' . $elencoRisorse[$i]['cognome'] . "</option>";
                                            }
                                        }
                                   
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" id="cerca_item_button" name="cerca_item_button" class="btn btn-primary ml-1">Cerca</button>
                            </div>
                        </div>
                    </form>

                    <hr>                  
                    <div id='tabellaDipendenti' style='display:none'>
                        <table style="text-align:center;" id="tabella_elencoRisorse" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                            <thead>
                                <tr>                                  
                                    <th>Nominativo</th>
                                    <th>Sede</th>
                                    <th>Commessa</th>
                                    <th>Data inizio commessa</th>
                                    <th>Azioni</th>
                                </tr>
                                <tr class="filters">
                                    <th>Nominativo</th>
                                    <th>Sede</th>
                                    <th>Commessa</th>
                                    <th>Data inizio commessa</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                for ($i = 0; $i < count($elencoRisorse); $i++) {
                                    echo "<tr>";
                                    echo "<td>" . ucfirst(mb_strtolower($elencoRisorse[$i]['nome'])) .' '. ucfirst(mb_strtolower($elencoRisorse[$i]['cognome']))  . "</td>";
                                    echo "<td>" . $elencoRisorse[$i]['sede'] . "</td>";
                                    echo "<td>" . $elencoRisorse[$i]['commessa'] . "</td>";

                                    if (!empty($elencoRisorse[$i]['data_inizio_commessa']))
                                     echo "<td>" . date('d/m/Y',strtotime($elencoRisorse[$i]['data_inizio_commessa'])) . "</td>"; 
                                    else
                                     echo "<td></td>"; 
                                    
                                    
                                    // echo "<td><a href=\"spostaRisorsa/{$elencoRisorse[$i]['nome']} {$elencoRisorse[$i]['cognome']}\" class=\"btn btn-outline-primary btn-sm \" role=\"button\" aria-disabled=\"true\">Cambia commessa</a>";
                                    echo "<td><a href=\"dettaglioAffidi/{$elencoRisorse[$i]['nome']} {$elencoRisorse[$i]['cognome']}\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Affidi</a>";
                                        if ( session()->get('ruolo_dsc') == "coordinatore" )
                                           echo " <button type=\"button\" class=\"btn btn-outline-info btn-sm attestatiModal_coordinatore\" data-toggle=\"modal\" data-target=\"#attestatiModal_coordinatore\" value='{$elencoRisorse[$i]['anagrafica_id']}'>Attestati</button>";
                                        else
                                           echo " <button type=\"button\" class=\"btn btn-outline-info btn-sm attestatiModal\" data-toggle=\"modal\" data-target=\"#attestatiModal\" value='{$elencoRisorse[$i]['anagrafica_id']}'>Attestati</button>";                                
                                    echo "</td>";
                                    
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="attestatiModal_coordinatore" tabindex="-1" role="dialog" aria-labelledby="confermaRichiestaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestione attestati</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div style="height: 100px;" class='listaAttestati_coordinatore'>
                    
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body listaAttestati_documenti">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only text-center">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Annulla</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="attestatiModal" tabindex="-1" role="dialog" aria-labelledby="confermaRichiestaModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestione attestati</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div style="height: 450px; overflow-y:scroll; text-align:center;" class='listaAttestati'>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" value="formConferma" id="submitForm" name="submitForm" class="btn btn-primary btn-sm btnAggiornaAttestati">Aggiorna Data/e cons.</button>
                    <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Visualizza allegati <i class="fas fa-arrow-down"></i>
                    </button>
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body listaAttestati_documenti">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only text-center">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class='listaAttestati_documenti'>
                    
                </div> -->
                <hr>
                <div class='listaAttestatiNonAssegnati'>
                    <label>Assegna nuovo attestato</label>
                    <select id='selectList' class='select2bs4 form-control form-control-sm attestatoDisponibile'>
                    
                    
                    </select>

                    <label>Data inizio</label>
                    <input type="date" name="data_inizio" class='form-control form-control-sm data_inizio'>
                    <label>Data fine</label>
                    <input type="date" name="data_fine" class='form-control form-control-sm data_fine' readonly>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" value="formConferma" id="submitForm" name="submitForm" class="btn btn-success btn-sm btnAssegna">Assegna</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Annulla</button>
            </div>
            </form>
        </div>
    </div>
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

    $(window).on('load', function(){
        $('#tabellaDipendenti').css('display','block');
    });


    $(document).ready(function() {

        var durata_mesi_attestato_selezionato = ""; 
        var arrayValoriAttestati = []; 
        var attestati_id_array_validi = [];
        var attestati_id_array_non_validi = [];
        var attestato_id; 
        var anagrafica_id;

        $('.data_inizio').attr('readonly','readonly')
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
            dom: 'Bfrtip',
                buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0,1,2,3 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: "btn-primary",
                    exportOptions: {
                        columns: [ 0,1,2,3 ]
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

   

        $('.attestatiModal_coordinatore').click(function(){
            var valoriAttestati_validi = []; 
            var valoriAttestati_non_validi = []; 
            attestati_id_array_validi.splice(0,attestati_id_array_validi.length); 
            attestati_id_array_non_validi.splice(0,attestati_id_array_non_validi.length); 
            $('.listaAttestati_coordinatore').html(""); 
            anagrafica_id = $(this).val(); 
            $.ajax({
                type: "GET",
                url: "ottieniListaAttestati/"+anagrafica_id,
                success: function (response) {
                    var json = JSON.parse(response);
                    if ( json.length == 0 ){
                        $('.listaAttestati_coordinatore').append("<b>Attenzione per questo dipendente non sono presenti attestati</b>"); 
                        $('.btnAggiornaAttestati').css('display','none'); 
                    }


        
                    for(var i=0; i<json.length; i++){

                        $('.btnAggiornaAttestati').css('display','block'); 

                        giorni = attestato_scaduto(json[i].data_fine);
                        
                        if ( giorni > 0 ){
                            attestati_id_array_validi.push(json[i].attestato_id);

                            var descrizione_attestato = json[i].descrizione.replace(" ","_");
                
                         
                            var descrizione_attestato_split = descrizione_attestato.split("_"); 
                            var esistenza_documento = json[i].allegato; 
                            if ( esistenza_documento == null || esistenza_documento == 0  ){
                                esistenza_documento = "<a class='text-center text-danger'><i class=\"fas fa-file-signature\"></i></a>";
                            } 
                            else{
                                esistenza_documento = "<a href='upload/attestati_formazione/"+anagrafica_id+"/attestato_"+descrizione_attestato+".pdf' target='_blank' class='text-center text-success'><i class=\"fas fa-file-signature\"></i></a>";
                            }

                            $('.listaAttestati_coordinatore').append(
                                    
                                    "<div class='container '>\
                                        <div class='row'>\
                                        <div class='col-md-12'>\
                                            <div  class='form-row'>\
                                                <div class='col' style='width:100px; margin-top:20px;' > <b class='descrizione_attestato'>"+json[i].descrizione.toUpperCase()+"</b></div>\
                                                <div class='col'> <b>Conseguito il</b>\
                                                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_inizio' value='"+json[i].data_inizio+"' readonly>\
                                                </div>\
                                                <div class='col'> <b>Scadenza al</b>\
                                                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_fine'' value='"+json[i].data_fine+"' readonly>\
                                                    </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <br>"
                            );
                        }
                        else{
                            
                            attestati_id_array_non_validi.push(json[i].attestato_id);
                            $('.listaAttestati_coordinatore').append(
                                    "<div style='text-align:center;' class='container'>\
                                        <div class='row'>\
                                            <div class='col-md-12'>\
                                                <div class='form-row'>\
                                                <div class='col' style='margin-top:20px'> <b class='text-danger'>"+json[i].descrizione+"</b><br><small class='text-danger'><i>(Scaduto)</i></small></div>\
                                                <div class='col'> <b>Conseguito il</b>\
                                                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_inizio' value='"+json[i].data_inizio+"' readonly style='border:1px solid red;'>\
                                                </div>\
                                                <div class='col'> <b>Scadenza al</b>\
                                                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_fine' value='"+json[i].data_fine+"' readonly style='border:1px solid red;'>\
                                                </div>\
                                                <div class='col'></div>\
                                            <div>\
                                        </div>\
                                    </div><br>");
                        }
                    }
                    
                },
                complete: function(){
                    $('#selectList').html(""); 
                    $.ajax({
                        type: "GET",
                        url: "ottieniListaAttestatiNonAncoraDisponibile/"+anagrafica_id,
                        success: function (response) {
                            var jsonResponse = JSON.parse(response); 
                            $("#selectList").append(new Option("", ""));                           
                            for(var i=0; i<jsonResponse.length; i++)
                             
                              var str = jsonResponse[i].descrizione;
                              var desc = str.toUpperCase();

                                $("#selectList").append(new Option(jsonResponse[i].descrizione, jsonResponse[i].attestato_id));                           
                        }
                    });

                    
                    $('.file_allegato_dsc').click(function(){
                      
                        var attestato_id_tmp = $(this).text();             
                        var res =  attestato_id_tmp.split("|");
                        attestato_id=res[1];          
                    });


                    $('.file_allegato').change(function(event){ 

                        event.preventDefault();

                        var nome_file = $(this).val(); 
                        var conferma = confirm("Vuoi davvero caricare il file selezionato?")
                        if ( conferma ){
          
                            $(this).prop('disabled', false);  
                            $(".loader").show();

                            attestato_id = attestato_id.charAt(attestato_id.length - 1).trim(); 
                           
                            console.log("Anagrafica_id: "+anagrafica_id.trim()+" attesato_id: "+attestato_id);

                            var formData = new FormData();
                            var allegato = $(this).get(0).files[0];
                            formData.append('allegato',allegato); 
                            formData.append('anagrafica_id',anagrafica_id); 
                            formData.append('attestato_id',attestato_id);
                            $.ajax({
                                type: "POST",
                                cache: false,
                                contentType: false,
                                processData: false,
                                url: "uploadAllegato",
                                data: formData,
                                success: function (response) {
                                    $('.file_allegato').val("");  

                                    $(this).prop('disabled', true); 

                                    $(".loader").modal('hide');
                                    alert("Attestato/i aggiornato/i");

                                    //console.log(response);
                                    //location.reload(); 
                                }
                            });
                            
                        }
                        else{
                            $('.file_allegato').val("");    
                        }

                        return false;
                    });
                }
            });

        });


        $('.attestatiModal').click(function(event){
            event.preventDefault();

            var valoriAttestati_validi = []; 
            var valoriAttestati_non_validi = []; 
            attestati_id_array_validi.splice(0,attestati_id_array_validi.length); 
            attestati_id_array_non_validi.splice(0,attestati_id_array_non_validi.length); 
            
            $('.listaAttestati').html(""); 
            anagrafica_id = $(this).val(); 
            $.ajax({
                type: "GET",
                url: "ottieniListaAttestati/"+anagrafica_id,
                success: function (response) {

                    var json = JSON.parse(response);
                    if ( json.length == 0 ){
                        $('.listaAttestati').append("<b>Attenzione per questo dipendente non sono presenti attestati</b>"); 
                        $('.btnAggiornaAttestati').css('display','none'); 
                    }

                   //console.log(json);

                    for(var i=0; i<json.length; i++){

                        $('.btnAggiornaAttestati').css('display','block'); 

                        giorni = attestato_scaduto(json[i].data_fine);


                        var esistenza_documento = json[i].allegato;
                        var msg;
                        if ( esistenza_documento == null || esistenza_documento == 0  ){
                            esistenza_documento = "<a class='text-center text-danger'><i class=\"fas fa-file-signature\"></i></a>";
                            msg="Allegato<br> Seleziona file";
                            colorExist=" border-color: red; ";
                        
                        } 
                        else{
                            esistenza_documento = "<a href='upload/attestati_formazione/"+anagrafica_id+"/attestato_"+descrizione_attestato+".pdf' target='_blank' class='text-center text-success'><i class=\"fas fa-file-signature\"></i></a>";

                            msg="File esistente <br>  clicca qui per sost.";
                            colorExist=" border-color: green;";
                        }


                        
                        if ( giorni > 0 ){
                            attestati_id_array_validi.push(json[i].attestato_id);
                            var descrizione_attestato = json[i].descrizione.replace(" ","_");

                         

                            var descrizione_attestato_split = descrizione_attestato.split("_");                          

                            $('.listaAttestati').append(                              
                                    "<div class='container'>\
                                        <div class='row'>\
                                        <div class='col-md-12'>\
                                            <div class='form-row'>\
                                                <div class='col' style='margin-top:20px;  word-break: break-all;' > <b class='descrizione_attestato'>"+json[i].descrizione.toUpperCase()+"</b></div>\
                                                <div class='col'> <b>Conseguito il</b>\
                                                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_inizio' value='"+json[i].data_inizio+"'>\
                                                </div>\
                                                <div class='col'> <b>Scadenza al</b>\
                                                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_fine' value='"+json[i].data_fine+"' readonly>\
                                                </div>\
                                                <div class='col'> \
                                                    <input  type=\"file\" id=\"upload\" class='file_allegato' value='a' accept='application/pdf' hidden/>\
                                                    <label  style=\"cursor:pointer; "+colorExist+" \" class='btn  file_allegato_dsc' for=\"upload\">"+msg+"<p style=' display:none'>|"+json[i].attestato_id+"</p></label>\
                                                </div>\
                                                \
                                            </div>\
                                        </div>\
                                    </div>\
                                    <br>"
                            );
                        }
                        else{
                            
                            attestati_id_array_non_validi.push(json[i].attestato_id);
                            $('.listaAttestati').append(
                                    "<div class='container'>\
                                        <div class='row'>\
                                            <div class='col-md-12'>\
                                                <div class='form-row'>\
                                                <div class='col' style='margin-top:20px; word-break: break-all;'> <b class='text-danger'>"+json[i].descrizione+"</b><br><small class='text-danger'><i>(Scaduto)</i></small></div>\
                                                <div class='col'> <b>Conseguito il</b>\
                                                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_inizio' value='"+json[i].data_inizio+"' style='border:1px solid red;'>\
                                                </div>\
                                                <div class='col'> <b>Scadenza al</b>\
                                                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_fine' value='"+json[i].data_fine+"' readonly style='border:1px solid red;'>\
                                                </div>\
                                                <div class='col'> \
                                                    <input  type=\"file\" id=\"upload\" class='file_allegato' value='a' accept='application/pdf' hidden/>\
                                                    <label  style=\"cursor:pointer; "+colorExist+" \" class='btn file_allegato_dsc' for=\"upload\">"+msg+"<p style=' display:none'>|"+json[i].attestato_id+"</p></label>\
                                                </div>\
                                            <div>\
                                        </div>\
                                    </div><br>");
                        }
                    }
                    
                },
                complete: function(){
                    $('#selectList').html(""); 
                    $.ajax({
                        type: "GET",
                        url: "ottieniListaAttestatiNonAncoraDisponibile/"+anagrafica_id,
                        success: function (response) {
                            var jsonResponse = JSON.parse(response); 
                            $("#selectList").append(new Option("", ""));   
                            
                         
                            for(var i=0; i<jsonResponse.length; i++){
                           
                                var str = jsonResponse[i].descrizione;
                                var desc = str.toUpperCase();
                             //console.log(jsonResponse[i].descrizione+" , "+jsonResponse[i].attestato_id);
                               $("#selectList").append(new Option(desc, jsonResponse[i].attestato_id));       

                            }
                                               
                        }
                    });

                    
                    $('.file_allegato_dsc').click(function(){
                     
                        var attestato_id_tmp = $(this).text();             
                        var res =  attestato_id_tmp.split("|");
                        attestato_id=res[1];                                           
                    });


                    $('.file_allegato').change(function(){ 
                  
                        var _this= $(this);
                        _this.prop('disabled', true);  
                        _this.unbind();       
                                        
                      //$(this).prop("disabled",true);
                        $(".loader").show();
			

                        var nome_file = $(this).val(); 
                        var conferma = confirm("Vuoi davvero caricare il file selezionato?")
                        if ( conferma ){
                            console.log("Anagrafica_id: "+anagrafica_id.trim()+" attestato_id: "+attestato_id);
                           // attestato_id = attestato_id.charAt(attestato_id.length - 1).trim(); 
                            
                            var formData = new FormData();
                            var allegato = $(this).get(0).files[0];
                            formData.append('allegato',allegato); 
                            formData.append('anagrafica_id',anagrafica_id); 
                            formData.append('attestato_id',attestato_id);
                            $.ajax({
                                type: "POST",
                                cache: false,
                                contentType: false,
                                processData: false,
                                url: "uploadAllegato",
                                data: formData,
                                success: function (response) {

                                    $('.file_allegato').val("");                                  
		
                                    //$(this).prop('disabled', false);                                                     
                       
                                    alert("Il file è stato inserito "); 
                                    $('#attestatiModal').modal('hide');    
                                    $(".loader").hide();  
                                           
                                    //console.log(response);
                                    //location.reload(); 
                                }
                            });
                            
                        }
                        else{
                            $('.file_allegato').val("");    
                        }
                    });
                }
            });

            $('#selectList').change(function(event){
                event.preventDefault();
           
                $('.data_inizio').val("");
                $('.data_fine').val("");

                if ($(this).val() == ""){
                    $('.data_inizio').attr('readonly','readonly')
                }
                else{
                    $('.data_inizio').removeAttr('readonly','readonly')
                    $.ajax({
                        type: "GET",
                        url: "ottieniInformazioniAttestato/"+$(this).val(),
                        success: function (response) {
                            // console.log("Responso: "+response)
                            durata_mesi_attestato_selezionato = response
                        }
                    });

                }
            });

            $('.data_inizio').change(function(){
                var data_selezionata = $(this).val();
                data_selezionata = data_selezionata.split("-");
                 
                var giorno_selezionato = data_selezionata[2]; 
                var mese_selezionato = data_selezionata[1]; 
                var anno_selezionato = data_selezionata[0]; 
                dts = new Date(anno_selezionato,mese_selezionato,giorno_selezionato);
               // console.log("Responso: "+durata_mesi_attestato_selezionato)
                dts.setMonth(dts.getMonth() + parseInt(durata_mesi_attestato_selezionato)); // calcolo il nuovo mese di fine

                var day = dts.getDate();
                var mm = dts.getMonth();
                var yyyy = dts.getFullYear();

                if ( day <= 9 )
                    day = "0"+day;
                
                if ( mm == 0 )
                    mm = 1; 
                if ( mm <= 9 )
                    mm = "0"+mm;

                $('.data_fine').val(yyyy+"-"+mm+"-"+day);
                        
        });

/*
           $('.btnAggiornaAttestati').click(function(event){
            event.stopImmediatePropagation();
                 event.preventDefault();
                var _this= $(this);
               // _this.prop('disabled', true);  
                _this.unbind();       
                

                alert("ok");
            });
*/



            $('.btnAggiornaAttestati').click(function(event){
                event.stopImmediatePropagation();
                event.preventDefault();
                var _this= $(this);
                _this.prop('disabled', true);  
                _this.unbind();       
                $(".loader").show();
             
           
                valoriAttestati_validi.splice(0,valoriAttestati_validi.length); 
                valoriAttestati_non_validi.splice(0,valoriAttestati_non_validi.length);

                for(var i=0; i<attestati_id_array_validi.length; i++){
                    valoriAttestati_validi.push(attestati_id_array_validi[i]+"|"+$('.'+attestati_id_array_validi[i]+"_inizio").val()+"|"+$('.'+attestati_id_array_validi[i]+"_fine").val());
                }

                for(var i=0; i<attestati_id_array_non_validi.length; i++){
                    valoriAttestati_non_validi.push(attestati_id_array_non_validi[i]+"|"+$('.'+attestati_id_array_non_validi[i]+"_inizio").val()+"|"+$('.'+attestati_id_array_non_validi[i]+"_fine").val());
                }

                $.ajax({
                    type: "POST",
                    url: "aggiornaAttestatiOperatore",
                    data: "valoriAttestati_validi="+valoriAttestati_validi+"&valoriAttestati_non_validi="+valoriAttestati_non_validi+"&anagrafica_id="+anagrafica_id,
                    success: function (response) {                
                        alert("Attestato/i aggiornato/i"); 
                        _this.prop('disabled', false);  
                        $(".loader").hide();   
                        $('#attestatiModal').modal('hide');

                     
                      //  $('#attestatiModal').remove();
                        //$('#attestatiModal').modal('hide');
                                   
                        //location.reload(); 
                     //   console.log(response);  
                    }
                });
                //$(".loader").hide();  
               
                return false;
            }); 


            $('.btnAssegna').click(function(event){
                event.stopImmediatePropagation();
                event.preventDefault();
                var _this= $(this);
                _this.prop('disabled', true);  
               // _this.unbind();       
                $(".loader").show();
             
                var attestatoDisponibile = $('.attestatoDisponibile').val(); 
                var data_inizio = $('.data_inizio').val(); 
                var data_fine = $('.data_fine').val(); 

                if ( attestatoDisponibile != "" && data_inizio != "" && data_fine != ""  ){
                    $.ajax({
                        type: "POST",
                        url: "/attribuisciAttestatoRisorsa",
                        data: "attestato_disponibile_id="+attestatoDisponibile+"&data_inizio="+data_inizio+"&data_fine="+data_fine+"&anagrafica_id="+anagrafica_id,
                        success: function (response) {
                            $('.data_inizio').val(""); 
                            $('.data_fine').val(""); 
                          
                            _this.prop("disabled",false);
                            $(".loader").hide();  
                           // $('#attestatiModal').hide();

                            $('#attestatiModal').modal('hide');
                        //$('#attestatiModal').modal('toggle');
                            alert("Attestato assegnato");                      
                        }
                    });
                }
                else{
                    $(".loader").hide(); 
                    alert("Attenzione, selezionare la tipologia di attestato e la data inizio");
                    _this.prop("disabled",false); 
                }
                return false;
            });

            setInterval(() => {
                //console.log(anagrafica_id); 
                $.ajax({
                    type: "GET",
                    url: "verificaDocumentiPerOperatore/"+anagrafica_id,
                    success: function (response) {
                        $('.listaAttestati_documenti').html("");
                        var json = JSON.parse(response);
                        var allegato_presente; 
                        var allegato_descrizione; 
                        var data_fine,scaduto,data_caricamento_attestato; 
                       

                        if ( json.length > 0 ){
                            for(var i=0; i<json.length; i++){
                                allegato_presente = json[i].allegato; 
                                data_fine = json[i].data_fine;                      
                            //  descrizione_attestato = json[i].descrizione.replace(" ","_"); 
                                descrizione_attestato = json[i].descrizione.replace(/ /g, '_');
                                descrizione_attestato = descrizione_attestato .replace(/\//g,"_");
                                descrizione_attestato = descrizione_attestato .replace(/\*/g,"_");
                                descrizione_attestato = descrizione_attestato .replace(/\$/g,"_");
                                descrizione_attestato = descrizione_attestato .replace(/\'/g,"_");
                                descrizione_attestato = descrizione_attestato .replace(/\?/g,"_");
                                descrizione_attestato = descrizione_attestato .replace(/\=/g,"_");
                                descrizione_attestato = descrizione_attestato .replace(/\&/g,"_");
                                descrizione_attestato = descrizione_attestato .replace(/\%/g,"_");
                                descrizione_attestato = descrizione_attestato .replace(/\'/g,"_");
                                descrizione_attestato = descrizione_attestato .replace(/\"/g,"_");
                                descrizione_attestato = descrizione_attestato .replace(/\^/g,"_");
                           
                        
                                data_caricamento_attestato = json[i].data_caricamento_attestato;
                                var esistenza_documento = json[i].allegato; 
                                giorni = attestato_scaduto(data_fine);
                                if ( giorni <= 0 ){
                                    scaduto = "<i class='text-danger'><small><b>(Allegato Scaduto)</b></small></i>";
                                }
                                else{
                                    scaduto = ""; 
                                }

                                if ( allegato_presente == 1 ){
                                    esistenza_documento = "<ul class=\"list-group\">\
                                                                <li class=\"list-group-item d-flex justify-content-between\">\
                                                                <small><b>"+json[i].descrizione.toUpperCase()+"</b><br>(Caricato il: "+data_caricamento_attestato+")"+"</small>"+scaduto+"\
                                                                <span class=\"badge badge-pill\"><a href='<?=base_url('upload/attestati_formazione')?>/"+anagrafica_id+"/attestato_"+descrizione_attestato+".pdf'' target='_blank'><i class=\"fas fa-file-signature\"></i></a></span>\
                                                        </li>";
                                    $('.listaAttestati_documenti').append(esistenza_documento);
                                }
                            }
                        }
                                              
                    }
                });
              
            }, 2000);
            

        }); 
         
    });
    

    function attestato_scaduto(data_fine){
        var oggi = new Date();
        var giorno = String(oggi.getDate()).padStart(2, '0');
        var mese = String(oggi.getMonth() + 1).padStart(2, '0'); //January is 0!
        var anno = oggi.getFullYear();
        var oggi = new Date(anno,mese,giorno);

        var split_data_fine = data_fine.split("-");
        var giorno_data_fine = split_data_fine[2]; 
        var mese_data_fine = split_data_fine[1]; 
        var anno_data_fine = split_data_fine[0]; 
        var scadenza_al = new Date(anno_data_fine,mese_data_fine,giorno_data_fine); 

        var giorni = Math.floor((Date.UTC(scadenza_al.getFullYear(), scadenza_al.getMonth(), scadenza_al.getDate()) - Date.UTC(oggi.getFullYear(), oggi.getMonth(), oggi.getDate()) ) /(1000 * 60 * 60 * 24));

        return giorni; 
    }

</script>
<style>
input[type=file] {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 150px;
}
.file_allegato{
  /* background-color: #f7f7f7; */
  color: black;
  /* padding: 0.1rem; */
  /* font-family: sans-serif; */
  border-radius: 0.1rem;
  cursor: pointer;
  /* margin-top: 1rem; */
}
</style>