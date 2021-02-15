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
                         <li class="breadcrumb-item active">Nuova richiesta</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card card-outline card-primary">
             <div class="card-header" style='background-color:#fff!important'>
                 <h3 class="card-title">Nuova richiesta ITEM</h3>

                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                         title="Collapse">
                         <i class="fas fa-minus"></i></button>
                 </div>
             </div>
             <div class="card-body">
                 <div class='container-fluid'>
                     <div class='row'>
                         <div class='col-md-6'>
                             <label>Seleziona prodotto</label>
                             <select class='form-control select2bs4' id='tipologia_articolo' style='width:100%'>
                                 <option></option>
                                 <?php
                                    for($i=0; $i<count($articoli_presenti); $i++){
                                        echo "<option value='{$articoli_presenti[$i]['tipologia_articolo_id']}'>".ucfirst(strtolower($articoli_presenti[$i]['tipo_articolo']))."</option>"; 
                                    }
                                ?>
                             </select>
                         </div>
                         <div class='col-md-6'>
                             <div class="form-check">
                                 <input class="form-check-input" type="checkbox" value=""
                                     id="checkboxProdottoNonPresente">
                                 <label class="form-check-label" for="defaultCheck1" style='margin-bottom:7px;'>
                                     Richiedi prodotto non presente
                                 </label>

                             </div>
                             <input type="text" name="nuovo_prodotto" id="nuovo_prodotto" class='form-control'
                                 placeholder='Richiedi nuovo prodotto' maxlength='30' disabled>
                         </div>
                         <div class='col-md-12 visualizzaAttributiITEM' style='margin-top:30px;display:none'>
                             <div class="accordion" id="accordionExample">
                                 <div class="card card-outline card-primary">
                                     <div class="card-header" id="headingOne" style='background-color:#fff'>
                                         <h5 class="mb-0 text-center">
                                             <button class="btn btn-link" type="button" data-toggle="collapse"
                                                 data-target="#collapseOne" aria-expanded="false"
                                                 aria-controls="collapseOne">
                                                 Specifica attributi richiesti
                                             </button>
                                         </h5>
                                     </div>

                                     <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                         data-parent="#accordionExample">
                                         <div class="card-body attributiItem">
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="card-body" style='margin-top:-30px;'>
                 <div class='container-fluid'>
                     <div class='row'>
                         <div class='col-md-6'>
                             <label>Quantità</label>
                             <select name="quantita" id="quantita" class='form-control select2bs4' style='width:100%'>
                                 <?php 
                                    for($i=1; $i<=99; $i++)
                                        echo "<option value='{$i}'>".$i."</option>"; 
                                ?>
                             </select>
                         </div>
                         <div class='col-md-6'>
                             <label>Destinatario</label>
                             <select name="destinatario" id="destinatario" class='form-control select2bs4'
                                 style='width:100%'>
                                 <?php 
                                    for($i=0; $i<count($lista_dipendenti); $i++){
                                        echo "<option value='{$lista_dipendenti[$i]['anagrafica_id']}'>".ucfirst(strtolower($lista_dipendenti[$i]['nome']))." ".ucfirst(strtolower($lista_dipendenti[$i]['cognome']))."</option>"; 
                                    }
                                ?>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="card-body" style='margin-top:-30px;'>
                 <div class='container-fluid'>
                     <div class='row'>
                         <div class='col-md-6'>
                             <label>Sede</label>
                             <select name="sede" id="sede" class='form-control select2bs4' style='width:100%'>
                                 <?php 
                                    for($i=0; $i<count($magazzino_sedi); $i++)
                                        echo "<option value='{$magazzino_sedi[$i]['magazzino_id']}'>".$magazzino_sedi[$i]['descrizioneMagazzino']."</option>"; 
                                ?>
                             </select>
                         </div>
                         <div class='col-md-6'>
                             <label>Commessa</label>
                             <select name="commessa" id="commessa" class='form-control select2bs4' style='width:100%'>
                                 <?php 
                                    for($i=0; $i<count($commesse); $i++){
                                        echo "<option value='{$commesse[$i]['commessa_id']}'>".ucfirst(strtolower($commesse[$i]['descrizione']))."</option>"; 
                                    }
                                ?>
                             </select>
                         </div>
                         <div class='col-md-12'>
                             <label>Note</label>
                             <textarea class='form-control' id='note' style='resize:none;' maxlength='250'></textarea>
                             <small><i>(max 200 caratteri)</i></small>
                             <hr>
                             <button class='btn btn-success btn-sm btnAggiungiRichiesta'>Aggiungi alla
                                 richiesta</button>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- /.card-body -->
             <div class="card-footer " style='background-color:#fff!important'>
                 <table id="richiestatabella" class="table table-bordered table-hover table-sm" >
                    <thead>
                        <tr>
                            <th>Prodotto</th>
                            <th>Attributi</th>
                            <th>Quantità richiesta</th>
                            <th>Destinatario</th>
                            <th>Sede</th>
                            <th>Commessa</th>
                            <th>Note</th>
                            <th>Azioni</th>
                            <th style='display:none'>Separatore</th>
                        </tr>
                    </thead>
                </table>
                <hr>
                <button class='btn btn-success btn-sm btnRegistra'>Registra la richiesta</button>
             </div>
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <script>
$(document).ready(function() {
    
    var arrayLbl = []; 
    var arrayValore = []; 
    var arrayLbl_finale = [], arrayValore_finale = [];
    $('#checkboxProdottoNonPresente').change(function() {
        if ($(this).is(':checked')) {
            $('#nuovo_prodotto').removeAttr('disabled', 'disabled');
            $('#tipologia_articolo').attr('disabled', 'disabled');
            $('.visualizzaAttributiITEM').css('display', 'none');
        } else {
            // $('#nuovo_prodotto').css('display', 'none');
            $('#nuovo_prodotto').attr('disabled', 'disabled');
            $('#tipologia_articolo').removeAttr('disabled', 'disabled');
            $('#nuovo_prodotto').val("")

            //$('#tipologia_articolo').css('display','none');
        }
    });

    $('#tipologia_articolo').change(function() {
        if ($(this).val() != "")
            $('.visualizzaAttributiITEM').css('display', 'block');
        else
            $('.visualizzaAttributiITEM').css('display', 'none');
        $('.attributiItem').html("")
        $.ajax({
            type: "GET",
            url: "getAttributo/" + $(this).val(),
            success: function(response) {
                var obj = JSON.parse(response);
                if (obj[0] == "") {
                    $('.attributiItem').html(
                        "<p class='text-center'><b>Attenzione, per l'item selezionato non sono stati trovati attributi l'operazione di inserimento non può continuare</b></p>"
                    );
                } else {

                    var elementi = obj.length;
                    for (var i = 0; i < elementi; i++) {
                        $('.attributiItem').append("<label class='lblesito'>" + obj[i]
                            .DescrizioneArticolo + " </label><br>");
                        var contaAttributi = obj[i].Attributo.length;
                        var select = $(
                            "<select class='form-control form-control-sm valore_presente' name='valore_presente'></select>"
                        );
                        for (var j = 0; j < contaAttributi; j++) {
                            var attributo = obj[i].Attributo[j];
                            attributo = attributo.replace("%20", "");
                            select.append("<option>" + attributo + " </option>");
                            $('.attributiItem').append(select);
                        }
                    }
                }
                //console.log(json)
                //$('.attributiItem').append(response)
                //console.log(response);
            },
            complete:function(){
                //prelevaDati();
            }
        });
    })

    $('.btnAggiungiRichiesta').click(function() {
        arrayValore = []; 
        arrayLbl.push($('.lblesito').text().trim());
        var valoreSelezionato = $('.valore_presente option:selected').text(); 
        valoreSelezionato = valoreSelezionato.replace(" ",";").trim();
        //arrayValore.push($('.valore_presente option:selected').text());
        arrayValore.push(valoreSelezionato);
        
        console.log(arrayValore)
        
        // var arrayLbl_finale = [], arrayValore_finale = [];
        
        // for(var i=0; i<arrayLbl.length; i++){
        //     lbl = arrayLbl[i].split(" "); 
        //     valore = arrayValore[i].split(" "); 
        //     arrayLbl_finale.push(lbl);
        //     arrayValore_finale.push(valore);
        // }
        //console.log(arrayLbl_finale[0][1])
        //console.log(arrayValore_finale)

        // for(var i=0; i<arrayLbl_finale.length; i++){
        //     console.log("A "+arrayLbl_finale[0][i])
        // }

        // console.log(arrayLbl+" "+arrayValore)
        //arrayValore
        //lbl = $('.lblesito').text(); 
        
        //alert(lbl+" "+valore_selezionato)
        var prodotto_selezionato_dsc = $('#tipologia_articolo option:selected').text();
        var prodotto_selezionato_id = $('#tipologia_articolo').val();
        var nuovo_prodotto = $('#nuovo_prodotto').val();
        var quantita = $('#quantita').val();
        var destinatario_dsc = $('#destinatario option:selected').text();
        var destinatario_id = $('#destinatario').val();
        var sede_dsc = $('#sede option:selected').text();
        var sede_id = $('#sede').val()
        var commessa_dsc = $('#commessa option:selected').text();
        var commessa_id = $('#commessa').val()
        var note = $('#note').val();
        //alert(destinatario_dsc)
        if ($('#checkboxProdottoNonPresente').is(':checked')) {
            prodotto_selezionato_dsc = nuovo_prodotto;
        }
        if ( prodotto_selezionato_dsc != "" && destinatario_dsc != "" ){
            var table = $('#richiestatabella');
            table.find("tbody tr").remove();
            table.append("<tr><td class='prodotto'>"+prodotto_selezionato_dsc.trim()+"</td><td class='attributi'>"+arrayValore+"</td><td class='quantita'>"+quantita.trim()+"</td><td class='destinatario'>"+destinatario_dsc.trim()+"</td><td class='sede'>"+sede_dsc.trim()+"</td><td class='commessa'>"+commessa_dsc.trim()+"</td><td class='note'>"+note.trim()+"</td><td><button class=\"btn btn-danger btn-sm btnDelete\"><i class=\"far fa-trash-alt text-center\"></i></button></td><td style='display:none'>|</td></tr>");
            $('#note').val("")
            $('#tipologia_articolo').val(null).trigger('change');
        }

        
        
    });

    $('.btnRegistra').click(function(){
        var conferma_registrazione = confirm("Vuoi procedere con la registrazione di questa richiesta ? ")
        if ( conferma_registrazione ){
            $('#richiestatabella tr').each(function() {
                var prodotto = $(this).find(".prodotto").html();    
                var attributi = $(this).find(".attributi").html();
                var quantita = $(this).find(".quantita").html();
                var destinatario = $(this).find(".destinatario").html();
                var sede = $(this).find(".sede").html();
                var commessa = $(this).find(".commessa").html();
                var note = $(this).find(".note").html();
                if ( prodotto != undefined || attributi != undefined || quantita != undefined || destinatario != undefined || sede != undefined || commessa != undefined || note != undefined ){
                    //console.log(prodotto+"\n"+attributi+"\n"+quantita+"\n"+destinatario+"\n"+sede+"\n"+commessa+"\n"+note+"\n")
                    $.ajax({
                        type: "POST",
                        url: "/inserisciRichiestaItem",
                        data: {
                            prodotto: prodotto, 
                            attributi: attributi, 
                            quantita: quantita, 
                            destinatario: destinatario, 
                            sede: sede, 
                            commessa: commessa, 
                            note: note
                        },
                        success: function (response) {
                            console.log(response)    
                            if ( response.includes("inserimento_avvenuto") ){
                                location.reload(); 
                            } 
                            else{
                                alert("Si è verificato un problema durante la richiesta,riprovare");
                                location.reload(); 
                            }
                        }
                    });
    
                }
            });

        }
        // var data = $('#richiestatabella').find("td");
        // var array_item = [];
        // data.each(function(){
        //     array_item.push($(this).html());
            
        
        // })  

        //     $.ajax({
        //         type: "POST",
        //         url: "/inserisciRichiestaItem",
        //         data: "item="+array_item,
        //         success: function (response) {
        //             console.log(response)      
        //         }
        //     });
        
    }); 

    $("#richiestatabella").on('click','.btnDelete',function(){
       $(this).closest('tr').remove();
     });

    function prelevaDati(){
        // lbl = $('.lblesito').text(); 
        // valore_selezionato = $('.valore_presente option:selected').text(); 
        // alert(lbl+" "+valore_selezionato)
        arrayLbl.push($('.lblesito').text().trim());
        arrayValore.push($('.valore_presente option:selected').text());
        // var arrayLbl_finale = [], arrayValore_finale = [];
        
        for(var i=0; i<arrayLbl.length; i++){
            lbl = arrayLbl[i].split(" "); 
            valore = arrayValore[i].split(" "); 
            arrayLbl_finale.push(lbl);
            arrayValore_finale.push(valore);
        }
    }

});
 </script>