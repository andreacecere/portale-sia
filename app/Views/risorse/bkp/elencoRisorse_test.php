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
                                    for ($i = 0; $i < count($elencoRisorse); $i++) {
                                        echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}' >" . $elencoRisorse[$i]['nome'] . ' ' . $elencoRisorse[$i]['cognome'] . "</option>";
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
            
                    <table id="tabella_elencoRisorse" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
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
                                echo "<td>" . ucfirst(strtolower($elencoRisorse[$i]['nome'])) . ' ' . ucfirst(strtolower($elencoRisorse[$i]['cognome']))  . "</td>";
                                echo "<td>" . $elencoRisorse[$i]['sede'] . "</td>";
                                echo "<td>" . $elencoRisorse[$i]['commessa'] . "</td>";
                                echo "<td>" . date('d/m/Y',strtotime($elencoRisorse[$i]['data_inizio_commessa'])) . "</td>";                               
                                echo "<td><a href=\"spostaRisorsa/{$elencoRisorse[$i]['nome']} {$elencoRisorse[$i]['cognome']}\" class=\"btn btn-outline-primary btn-sm \" role=\"button\" aria-disabled=\"true\">Cambia commessa</a>"
                                    . "<a href=\"dettaglioAffidi/{$elencoRisorse[$i]['nome']} {$elencoRisorse[$i]['cognome']}\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Affidi</a>"
                                    . " <button type=\"button\" class=\"btn btn-outline-info btn-sm attestatiModal\" data-toggle=\"modal\" data-target=\"#attestatiModal\" value='{$elencoRisorse[$i]['anagrafica_id']}'>Attestati</button>"
                                    . "</td>";
                                
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="attestatiModal" tabindex="-1" role="dialog" aria-labelledby="confermaRichiestaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestione attestati</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class='listaAttestati'>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" value="formConferma" id="submitForm" name="submitForm" class="btn btn-primary btn-sm btnAggiornaAttestati">Aggiorna</button>
                </div>
                <hr>
                <div class='listaAttestatiNonAssegnati'>
                    <label>Assegna nuovo attestato</label>
                    <select id='selectList' class='form-control form-control-sm attestatoDisponibile'></select>
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
    $(document).ready(function() {
        var durata_mesi_attestato_selezionato = ""; 
        //var arrayAttestatiValidi = []; 
        //var arrayAttestatiNonValidi = []; 
        var arrayValoriAttestati = []; 
        var attestati_id_array_validi = [];
        var attestati_id_array_non_validi = [];
        var attestato_id; 
        // var valoriAttestati_validi = []; 
        // var valoriAttestati_non_validi = []; 
        var anagrafica_id;
        var json; 
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

        $('.attestatiModal').click(function(){
            // alert("aperti");
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
                    json = JSON.parse(response);
                    if ( json.length == 0 ){
                        $('.listaAttestati').append("<b>Attenzione per questo dipendente non sono presenti attestati</b>"); 
                        $('.btnAggiornaAttestati').css('display','none'); 
                    }
                    test(json,attestati_id_array_validi,anagrafica_id); 
                    
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
                                $("#selectList").append(new Option(jsonResponse[i].descrizione, jsonResponse[i].attestato_id));                           
                        }
                    });

                    
                    $('.file_allegato_dsc').click(function(){
                        alert($(this).text())
                        attestato_id = $(this).text(); 
                        // var $row = $(this).closest(".descrizione_attestato"); 
                        // var $text = $row.find(".descrizione_attestato").text(); 
                        // alert($text);
                    });


                    $('.file_allegato').change(function(){
                        alert($(this).val())
                        var nome_file = $(this).val(); 
                        // var $row = $(this).closest(".descrizione_attestato"); 
                        // var $text = $row.find(".descrizione_attestato").text(); 
                        // alert($text);
                        // var $row = $(this).closest(".row").css({"color": "red", "border": "2px solid red"}); 
                        // var $text = $row.find(".descrizione_attestato").text(); 
                        //alert(nome_file);
                        var conferma = confirm("Vuoi davvero caricare il file selezionato? "+nome_file)
                        if ( conferma ){
                            attestato_id = attestato_id.charAt(attestato_id.length - 1).trim(); 
                            console.log("Anagrafica_id: "+anagrafica_id.trim()+" attesato_id: "+attestato_id);
                            //closest("ul").css({"color": "red", "border": "2px solid red"});
                            //alert("OK");
                            var formData = new FormData();
                            var allegato = $(this).get(0).files[0];
                            //console.log(allegato)
                            //$(this).val("");
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
                                    console.log(response);
                                    $('.listaAttestati').html("");
                                    alert("mo ricarico"); 
                                },
                                complete:function(){
                                    
                                    test(json,attestati_id_array_validi,anagrafica_id);
                                }
                            });
                            
                        }
                        else{
                            alert("No")
                            $(this).val("");
                        }
                        //$('.file_allegato').val(nome_file);
                        // alert(nome_file)
                    });
                }
            });

            $('#selectList').change(function(){
                // alert($(this).val())

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
                //console.log(data_selezionata);
                data_selezionata = data_selezionata.split("-");
                 
                var giorno_selezionato = data_selezionata[2]; 
                var mese_selezionato = data_selezionata[1]; 
                var anno_selezionato = data_selezionata[0]; 
                //console.log(giorno_selezionato+" "+mese_selezionato+" "+anno_selezionato); 

                dts = new Date(anno_selezionato,mese_selezionato,giorno_selezionato);
                //dts.setMonth(dts.getMonth() + 1); // calcolo il nuovo mese di fine
                console.log("Responso: "+durata_mesi_attestato_selezionato)
                dts.setMonth(dts.getMonth() + parseInt(durata_mesi_attestato_selezionato)); // calcolo il nuovo mese di fine
                //dts.setDate(Math.min(n, GetMonthDays(dts.getFullYear(),dts.getMonth())));

                var day = dts.getDate();
                var mm = dts.getMonth();
                var yyyy = dts.getFullYear();

                //console.log(day); 
                if ( day <= 9 )
                    day = "0"+day;
                
                if ( mm == 0 )
                    mm = 1; 
                if ( mm <= 9 )
                    mm = "0"+mm;

                $('.data_fine').val(yyyy+"-"+mm+"-"+day);
                        
            });

            $('.btnAggiornaAttestati').click(function(){
                //console.log(attestati_id_array.length); 
                valoriAttestati_validi.splice(0,valoriAttestati_validi.length); 
                valoriAttestati_non_validi.splice(0,valoriAttestati_non_validi.length);
                
                for(var i=0; i<attestati_id_array_validi.length; i++){
                    //console.log("Valore: "+attestati_id_array_validi[i]);
                    valoriAttestati_validi.push(attestati_id_array_validi[i]+"|"+$('.'+attestati_id_array_validi[i]+"_inizio").val()+"|"+$('.'+attestati_id_array_validi[i]+"_fine").val());
                }
                for(var i=0; i<attestati_id_array_non_validi.length; i++){
                    //console.log("Valore: "+attestati_id_array_non_validi[i]);
                    valoriAttestati_non_validi.push(attestati_id_array_non_validi[i]+"|"+$('.'+attestati_id_array_non_validi[i]+"_inizio").val()+"|"+$('.'+attestati_id_array_non_validi[i]+"_fine").val());
                }

                $.ajax({
                    type: "POST",
                    url: "aggiornaAttestatiOperatore",
                    data: "valoriAttestati_validi="+valoriAttestati_validi+"&valoriAttestati_non_validi="+valoriAttestati_non_validi+"&anagrafica_id="+anagrafica_id,
                    success: function (response) {
                        location.reload(); 
                        console.log(response);  
                    }
                });


            }); 

            $('.btnAssegna').click(function(){
                
                
                var attestatoDisponibile = $('.attestatoDisponibile').val(); 
                var data_inizio = $('.data_inizio').val(); 
                var data_fine = $('.data_fine').val(); 

                if ( attestatoDisponibile != "" && data_inizio != "" && data_fine != ""  ){
                    $.ajax({
                        type: "POST",
                        url: "/attribuisciAttestatoRisorsa",
                        data: "attestato_disponibile_id="+attestatoDisponibile+"&data_inizio="+data_inizio+"&data_fine="+data_fine+"&anagrafica_id="+anagrafica_id,
                        success: function (response) {
                            alert("Attestato assegnato, a breve verrà ricaricata la pagina"); 
                            location.reload(); 
                            //console.log(response);
                        }
                    });
                }
                else{
                    alert("Attenzione, selezionare la tipologia di attestato e la data inizio"); 
                }


            });
            

        }); 
       
    });
    
    function test(json,attestati_id_array_validi,anagrafica_id){
        for(var i=0; i<json.length; i++){

$('.btnAggiornaAttestati').css('display','block'); 

var oggi = new Date();
var giorno = String(oggi.getDate()).padStart(2, '0');
var mese = String(oggi.getMonth() + 1).padStart(2, '0'); //January is 0!
var anno = oggi.getFullYear();
var oggi = new Date(anno,mese,giorno);

var data_fine = json[i].data_fine; 
var split_data_fine = data_fine.split("-");
var giorno_data_fine = split_data_fine[2]; 
var mese_data_fine = split_data_fine[1]; 
var anno_data_fine = split_data_fine[0]; 
var scadenza_al = new Date(anno_data_fine,mese_data_fine,giorno_data_fine); 

var giorni = Math.floor((Date.UTC(scadenza_al.getFullYear(), scadenza_al.getMonth(), scadenza_al.getDate()) - Date.UTC(oggi.getFullYear(), oggi.getMonth(), oggi.getDate()) ) /(1000 * 60 * 60 * 24));
//console.log("Giorni: "+giorni); 


if ( giorni > 0 ){
    //arrayAttestatiValidi.push(json[i].attestato_id+";"+json[i].data_inizio+";"+json[i].data_fine); 
    
    attestati_id_array_validi.push(json[i].attestato_id);
    var descrizione_attestato = json[i].descrizione.replace(" ","_");
    var descrizione_attestato_split = descrizione_attestato.split("_"); 
    var esistenza_documento = json[i].allegato; 
    console.log(esistenza_documento);
    if ( esistenza_documento == null || esistenza_documento == 0  ){
        esistenza_documento = "<a class='text-center text-danger'><i class=\"fas fa-file-signature\"></i></a>";
    } 
    else{
        esistenza_documento = "<a href='visualizzaAllegato/"+anagrafica_id+"/"+descrizione_attestato+".pdf' target='_blank' class='text-center text-success'><i class=\"fas fa-file-signature\"></i></a>";
    }

    $('.listaAttestati').append(
        
            "<div class='form-row'>\
                <div class='col' style='margin-top:20px'> <b class='descrizione_attestato'>"+json[i].descrizione+"</b></div>\
                <div class='col'> <b>Conseguito il</b>\
                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_inizio' value='"+json[i].data_inizio+"'>\
                </div>\
                <div class='col'> <b>Scandenza al</b>\
                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_fine'' value='"+json[i].data_fine+"' readonly>\
                    </div>\
                <div class='col'> <b>Allegato</b><br>\
                    <input type=\"file\" id=\"upload\" class='file_allegato' value='a' accept='application/pdf' hidden/>\
                    <label class='file_allegato_dsc' for=\"upload\">Seleziona file <p style='display:none'>"+json[i].attestato_id+"</p></label>\
                </div>\
                <div class='col'><b class='text-center'>Mostra</b><br>\
                    "+esistenza_documento+"\
                </div>\
            </div><br>"
    );
    
    //arrayAttestatiValidi.push(json[i].attestato_id+";"+$('.ambienticonfinanti').val()+";"+json[i].data_fine); 
}
else{
    //arrayAttestatiNonValidi.push(json[i].attestato_id+";"+json[i].data_inizio+";"+json[i].data_fine); 
    attestati_id_array_non_validi.push(json[i].attestato_id);
    $('.listaAttestati').append(
            "<div class='form-row'>\
                <div class='col' style='margin-top:20px'> <b class='text-danger'>"+json[i].descrizione+"</b><br><small class='text-danger'><i>(Scaduto)</i></small></div>\
                <div class='col'> <b>Conseguito il</b>\
                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_inizio' value='"+json[i].data_inizio+"' style='border:1px solid red;'>\
                </div>\
                <div class='col'> <b>Scandenza al</b>\
                    <input type='date' class='form-control form-control-sm "+json[i].attestato_id+"_fine' value='"+json[i].data_fine+"' readonly style='border:1px solid red;'>\
                    </div>\
            </div><br>");
}
}
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