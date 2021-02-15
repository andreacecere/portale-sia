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
                        <li class="breadcrumb-item active">Documenti</li>
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
                    <h3 class="card-title">Documenti</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div> 
                <div class="card-body">
                    <div class='row'>
                    <div class='col-md-12'>
                        <?php if (session('msg')) : ?>
                            <div class="alert alert-success">
                                <?= session('msg') ?>
                                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            </div>
                        <?php endif ?>
                    </div>
                    </div>
                    <form method='GET'>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="seriale_input">Seriale</label>
                                <input type="text" class="form-control" name="seriale_input" id="seriale_input">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="seriale_input">Operatore</label>
                                <select class="form-control select2bs4" name="operatore" id="operatore">
                                    <option value=''></option>
                                    <?php 
                                        for($i=0; $i<count($elencoRisorse); $i++){
                                            echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}'>".$elencoRisorse[$i]['nome']." ".$elencoRisorse[$i]['cognome']."</option>"; 
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="tipo_articolo">Tipologia documento</label>
                                <select class="form-control select2bs4" name="tipo_articolo" id="tipo_articolo">
                                    <option value="" selected></option>
                                    <option value="A">Affido</option>
                                    <option value="D">Disaffido</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="data">Data</label>
                                <input type="date" name="data" class='form-control' id='data'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="commessa_input">Commessa</label>
                                <select class="form-control select2bs4" name="commessa_input" id="commessa_input">
                                    <option value="" selected></option>
                                    <?php
                                    for ($i = 0; $i < count($listaCommesse); $i++) {
                                        echo "<option value='{$listaCommesse[$i]['commessa_id']}' >" . $listaCommesse[$i]['descrizione'] . "</option>";
                                        //echo "<option value='{$listaCommesse[$i]['descrizione']}' >" . $listaCommesse[$i]['descrizione'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="condizione_input">ID Operazione</label>
                                <input type='text' class='form-control' name='id_operazione' id='id_operazione'>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="tipo_articolo">Stato documenti</label>
                                <select class="form-control select2bs4" name="stato_documenti" id="stato_documenti">
                                    <option value="" selected></option>
                                    <option value="1">Documenti caricati</option>
                                    <option value="2">Documenti da caricare</option> <!-- 0  -->
                                </select>
                            </div>
                        </div>
                        <button type="submit" id="submitForm" class="btn btn-primary btnCerca">Cerca</button>
                        <button type="submit" id="submitForm" class="btn btn-info btnPulisci">Cancella parametri di ricerca</button>
                    </form>
                </div>
            </div>

            <!-- <div style="visibility: hidden;"> -->
            <?php if ($showTable) : ?>
                <div class="card card-outline card-primary">
                    <div class="card-header" style="background-color: white;">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <table id="tabella_cerca" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Operazione</th>    
                                            <th>Seriale</th>
                                            <th>Affidato a</th>
                                            <th>Commessa</th>
                                            <th>Tipologia</th>
                                            <th>ITEM</th>
                                            <th>Documento caricato</th>
                                            <th>Data</th>
                                            <th>Azioni</th>
                                            
                                        </tr>
                                        <tr class="filters">
                                            <th>ID Operazione</th>  
                                            <th>Seriale</th>
                                            <th>Affidato a</th>
                                            <th>Commessa</th>
                                            <th>Tipologia</th>
                                            <th>ITEM</th>
                                            <th>Documento caricato</th>
                                            <th>Data</th>
                                            <th>Azioni</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            for ($i = 0; $i < count($ricerca); $i++) {
                                                echo "<tr>";
                                                echo "<td class='affidamento_id'>" . $ricerca[$i]['affidamento_id']. "</td>";
                                                echo "<td>" . $ricerca[$i]['articolo_seriale']. "</td>";
                                                echo "<td>" . ucfirst(strtolower($ricerca[$i]['nominativo_destinatario'])). "</td>";
                                                echo "<td>" . $ricerca[$i]['commessa_descrizione']. "</td>";
                                                echo "<td class='affidamento_tipo'>" . $ricerca[$i]['affidamento_tipo']."</td>";
                                                echo "<td>" . ucfirst(strtolower($ricerca[$i]['descrizione_item'])). "</td>";
                                                echo "<td>" . $ricerca[$i]['affidamento_modulo_dsc']. "</td>";
                                                echo "<td>" . date('d/m/Y H:i:s',strtotime($ricerca[$i]['affidamento_data'])). "</td>";
                                                if ( $ricerca[$i]['affidamento_modulo'] == 0 )
                                                    if ( $ricerca[$i]['affidamento_tipo'] == 'A' )
                                                        echo "<td> <a href=\"http://192.168.0.161/reportserver/reportserver/httpauthexport?id=13734&format=pdf&user=user&apikey=test123&p_affidamento_id={$ricerca[$i]['affidamento_id']}\" data-toggle=\"tooltip\" title=\"Rigenera\"><button type=\"button\" class=\"btn btn-outline-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\"><i class=\"fas fa-download\"></i></button></a> <a href=\"#\" data-toggle=\"tooltip\" data-backdrop=\"static\" data-keyboard=\"false\" title=\"Carica\"><button type=\"button\" class=\"btn btn-outline-success uploadIDDocumento btn-sm\" data-toggle=\"modal\" data-target=\"#modal-caricaDocumento\"><i class=\"fas fa-upload\"></i></button></a> <a href=\"#\" data-toggle=\"tooltip\" title=\"Scarica PDF\"><button type=\"button\" class=\"btn btn-outline-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\" disabled><i class=\"far fa-file-pdf\"></i></button></a> <a href='dettaglioDocumento/{$ricerca[$i]['affidamento_id']}'><button type=\"button\" class=\"btn btn-outline-danger btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\">Dettagli</button></a> </td>";
                                                    else
                                                        echo "<td> <a href=\"http://192.168.0.161/reportserver/reportserver/httpauthexport?id=14509&format=pdf&user=user&apikey=test123&p_affidamento_id={$ricerca[$i]['affidamento_id']}\" data-toggle=\"tooltip\" title=\"Rigenera\"><button type=\"button\" class=\"btn btn-outline-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\"><i class=\"fas fa-download\"></i></button></a> <a href=\"#\" data-toggle=\"tooltip\" data-backdrop=\"static\" data-keyboard=\"false\" title=\"Carica\"><button type=\"button\" class=\"btn btn-outline-success uploadIDDocumento btn-sm\" data-toggle=\"modal\" data-target=\"#modal-caricaDocumento\"><i class=\"fas fa-upload\"></i></button></a> <a href=\"#\" data-toggle=\"tooltip\" title=\"Scarica PDF\"><button type=\"button\" class=\"btn btn-outline-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\" disabled><i class=\"far fa-file-pdf\"></i></button></a> <a href='dettaglioDocumento/{$ricerca[$i]['affidamento_id']}'><button type=\"button\" class=\"btn btn-outline-danger btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\">Dettagli</button></a> </td>";
                                                else
                                                    if ( $ricerca[$i]['affidamento_tipo'] == 'A' )
                                                        echo "<td> <a href=\"#\" data-toggle=\"tooltip\" title=\"Rigenera\"><button type=\"button\" class=\"btn btn-outline-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\" disabled><i class=\"fas fa-download\"></i></button></a> <a href=\"#\" data-toggle=\"tooltip\" title=\"Carica\"><button type=\"button\" class=\"btn btn-outline-success uploadIDDocumento btn-sm\" data-toggle=\"modal\" data-target=\"#modal-caricaDocumento\"><i class=\"fas fa-upload\"></i></button></a> <a href=\"#\" data-toggle=\"tooltip\" title=\"Scarica PDF\"><button type=\"button\" class=\"btn btn-outline-info btn-sm scaricaIDAffido\" data-toggle=\"modal\" data-target=\"#modal-scaricaFile\"><i class=\"far fa-file-pdf\"></i></button></a> <a href='dettaglioDocumento/{$ricerca[$i]['affidamento_id']}'><button type=\"button\" class=\"btn btn-outline-danger btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\">Dettagli</button></a> </td>";
                                                    else
                                                        echo "<td> <a href=\"#\" data-toggle=\"tooltip\" title=\"Rigenera\"><button type=\"button\" class=\"btn btn-outline-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\" disabled><i class=\"fas fa-download\"></i></button></a> <a href=\"#\" data-toggle=\"tooltip\" title=\"Carica\"><button type=\"button\" class=\"btn btn-outline-success uploadIDDocumento btn-sm\" data-toggle=\"modal\" data-target=\"#modal-caricaDocumento\"><i class=\"fas fa-upload\"></i></button></a> <a href=\"#\" data-toggle=\"tooltip\" title=\"Scarica PDF\"><button type=\"button\" class=\"btn btn-outline-info btn-sm scaricaIDAffido\" data-toggle=\"modal\" data-target=\"#modal-scaricaFile\"><i class=\"far fa-file-pdf\"></i></button></a> <a href='dettaglioDocumento/{$ricerca[$i]['affidamento_id']}'><button type=\"button\" class=\"btn btn-outline-danger btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\">Dettagli</button></a> </td>";
                                                echo "</tr>";
                                            } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-caricaDocumento">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title uploadModulo">Carica modulo</h4>
                <h4 class="modal-title tipologiaDocumento"></h4>
                <h4 class="modal-title uploadModuloID"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id='formCaricaModulo' action="/uploadModulo/" method="post" enctype="multipart/form-data">
                    
                    <div class="container py-3">
                        <div class="input-group">
                            <div class="custom-file">
                                
                                <input type="file" accept="application/pdf" class="form-control-sm custom-file-input caricaDocumentoPDF" name='file' id="myInput" aria-describedby="myInput" required>
                                <label class="custom-file-label test" for="myInput">Carica il modulo</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="caricaFile">Carica</button>
                            </div>
                        </div>
                        <hr>
                        <input type='checkbox' class='firmaOperatore'> Aggiungi firma operatore
                        <div id="signature-pad" class="signature-pad" style='display:none'>
                            <div class="signature-pad--body">
                                <canvas width='450' height='200' style='border:1px solid black'></canvas>
                            </div>
                            <div class="signature-pad--footer">
                                <!-- <div class="description">Firma qui</div> -->
                                <div class="signature-pad--actions">
                                    <div>
                                        <button type="button" class="btn btn-danger btn-sm button   clear" data-action="clear">Pulisci area firma</button>
                                        <button type="button" class="btn btn-success btn-sm button  save" data-action="save-jpg">Salva la firma</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="myForm">
                            <div class='scelta'>

                            </div>
                        </form>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-danger btn-sm btn-block" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-scaricaFile">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title scaricaModulo">Scarica moduli</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body listaElementiModuli">
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger btn-sm btn-block" data-dismiss="modal">Chiudi</button>
            </div>
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


        $('.uploadIDDocumento').click(function(){
            signaturePad.clear();
        })


        var $text = ""; 
        
        
        $('.btnPulisci').click(function(){
            localStorage.removeItem("seriale_input");
            localStorage.removeItem("tipo_articolo");
            localStorage.removeItem("data");
            localStorage.removeItem("commessa_input");
            localStorage.removeItem("id_operazione");
            localStorage.removeItem("stato_documenti");
            localStorage.removeItem("operatore");           
        }); 

        
        $('#seriale_input').val(localStorage.getItem("seriale_input")); 
        $('#tipo_articolo').val(localStorage.getItem("tipo_articolo")); 
        $('#data').val(localStorage.getItem("data")); 
        $('#commessa_input').val(localStorage.getItem("commessa_input")); 
        $('#id_operazione').val(localStorage.getItem("id_operazione")); 
        $('#stato_documenti').val(localStorage.getItem("stato_documenti")); 
        $('#operatore').val(localStorage.getItem("operatore")); 

        
        $('.btnCerca').click(function(){
            var seriale_input = $('#seriale_input').val(); 
            var tipo_articolo = $('#tipo_articolo').val(); 
            var commessa_input = $('#commessa_input').val(); 
            var stato_documenti = $('#stato_documenti').val();
            var id_operazione = $('#id_operazione').val(); 
            var data = $('#data').val();
            var operatore = $('#operatore').val(); 


            localStorage.setItem("seriale_input", seriale_input);
            localStorage.setItem("tipo_articolo", tipo_articolo);
            localStorage.setItem("commessa_input", commessa_input);
            localStorage.setItem("stato_documenti", stato_documenti);
            localStorage.setItem("id_operazione", id_operazione);
            localStorage.setItem("data", data);
            localStorage.setItem("operatore", operatore);

           

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
            }
            ,dom: 'Bfrtip',
                buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5 ]
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

        $(".uploadIDDocumento").click(function() {
            //alert("OK")
            
            $('.alertMsg').css('display','none');
            var $row = $(this).closest("tr");    
            $text = $row.find(".affidamento_id").text(); 
            var $text_tipologiaDocumento = $row.find(".affidamento_tipo").text(); 
            $('.custom-file-input').val('');
            $('.custom-file-label').text("Carica il modulo"); 
            $('.tipologiaDocumento').text($text_tipologiaDocumento).css('display','none');

            if ( $text_tipologiaDocumento == 'A' ){
                //alert("OK")
                $('.scelta').append("<div class=\"form-check-inline\">\
                                <label class=\"form-check-label\">\
                                    <input type=\"radio\" class=\"form-check-input sceltaDocumento\" name=\"documento\" value='affido' checked>Documento <u>affido</u>\
                                </label>").css('display','none'); 
            }
            else{
                $('.scelta').append("<div class=\"form-check-inline\">\
                                <label class=\"form-check-label\">\
                                    <input type=\"radio\" class=\"form-check-input sceltaDocumento\" name=\"documento\" value='disaffido' checked>Documento <u>disaffido</u>\
                                </label>").css('display','none'); 

            }

            
            $('.downloadModulo').text($text);
            $('.uploadModuloID').css('display','none').text($text);
            $('#formCaricaModulo').attr('action','/uploadModulo/'+$text)

        });
        $(".scaricaIDAffido").click(function() {
            var $row = $(this).closest("tr");    
            var $text = $row.find(".affidamento_id").text(); 
            var tipologia = $row.find(".affidamento_tipo").text(); 
            $.ajax({
                type: "GET",
                url: "ricercaModuli/"+$text+"/"+tipologia,
                success: function (response) {
                    $('.listaElementiModuli').html("");
                    console.log(response);
                    var elementi = JSON.parse(response); 
                    $('.listaElementiModuli').append("<ul>");
                    for(var i=0; i<elementi.length; i++){
                        nomeFile = elementi[i].split("/"); 
                        $('.listaElementiModuli').append("<li><a href='"+elementi[i]+"' download>"+nomeFile[2]+"</a></li>"); 
                    }
                    $('.listaElementiModuli').append('</ul>');
                }
            });
           
        });


        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        document.querySelector('.custom-file-input').addEventListener('change',function(e){
            var fileName = document.getElementById("myInput").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        });

        $('.firmaOperatore').click(function(){
            if ( $('.firmaOperatore').is(':checked') ){


                $('.signature-pad').css('display','block');
                $('#caricaFile').attr('disabled','disabled');

            }
            else{
                $('.signature-pad').css('display','none');
                $('#caricaFile').removeAttr('disabled','disabled');
            }
        });

        $('.save').click(function(){
            //alert("OK")
            $('.save').css('display','none');
            $('.clear').css('display','none');
        });


    var wrapper = document.getElementById("signature-pad");
    var saveJPGButton = wrapper.querySelector("[data-action=save-jpg]");
    var canvas = document.querySelector("canvas");


    var canvas = wrapper.querySelector("canvas");
    var clearButton = wrapper.querySelector("[data-action=clear]");
    var signaturePad = new SignaturePad(canvas, {
        minWidth: 1,
        maxWidth: 1,
    // It's Necessary to use an opaque color when saving image as JPEG;
    // this option can be omitted if only saving as PNG or SVG
    backgroundColor: 'rgb(255, 255, 255)'
    });


    // Returns signature image as data URL (see https://mdn.io/todataurl for the list of possible parameters)
    signaturePad.toDataURL("image/jpeg"); // save image as JPEG



    // Returns signature image as an array of point groups
    const data = signaturePad.toData();

    // Draws signature image from an array of point groups
    signaturePad.fromData(data);

    // Clears the canvas
    signaturePad.clear();

    // Returns true if canvas is empty, otherwise returns false
    signaturePad.isEmpty();

    // Unbinds all event handlers
    signaturePad.off();

    // Rebinds all event handlers
    signaturePad.on();

    //window.onresize = resizeCanvas;
    //resizeCanvas()


    saveJPGButton.addEventListener("click", function (event) {
    //$('.uploadModuloID').css('display','block').text($text);
        if (signaturePad.isEmpty()) {
            alert("Attenzione, devi inserire la tua firma prima di proseguire");
        } else {
            $('#caricaFile').removeAttr('disabled','disabled');
            var dataURL = signaturePad.toDataURL("image/jpeg");
            $.ajax({
                type: "POST",
                url: "caricaFirma",
                data: { imgBase64: dataURL , id_operazione : $text },
                success: function (response) {
                    console.log(response)            
                }
            });
            //download(dataURL, "signature.jpg");
        }
    });

    function download(dataURL, filename) {
    if (navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") === -1) {
        window.open(dataURL);
    } else {
        var blob = dataURLToBlob(dataURL);
        var url = window.URL.createObjectURL(blob);

        var a = document.createElement("a");
        a.style = "display: none";
        a.href = url;
        a.download = filename;

        document.body.appendChild(a);
        a.click();

        window.URL.revokeObjectURL(url);
    }
    }

function dataURLToBlob(dataURL) {
  // Code taken from https://github.com/ebidel/filer.js
  var parts = dataURL.split(';base64,');
  var contentType = parts[0].split(":")[1];
  var raw = window.atob(parts[1]);
  var rawLength = raw.length;
  var uInt8Array = new Uint8Array(rawLength);

  for (var i = 0; i < rawLength; ++i) {
    uInt8Array[i] = raw.charCodeAt(i);
  }

  return new Blob([uInt8Array], { type: contentType });
}

clearButton.addEventListener("click", function (event) {
  signaturePad.clear();
});

function resizeCanvas() {
  // When zoomed out to less than 100%, for some very strange reason,
  // some browsers report devicePixelRatio as less than 1
  // and only part of the canvas is cleared then.
  var ratio =  Math.max(window.devicePixelRatio || 1, 1);

  // This part causes the canvas to be cleared
  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);

  // This library does not listen for canvas changes, so after the canvas is automatically
  // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
  // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
  // that the state of this library is consistent with visual state of the canvas, you
  // have to clear it manually.
  signaturePad.clear();
}




});
</script>
