<div class="card card-outline card-primary">
    <div class="card-header" style="background-color: white;">
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">

                <table id="tabella_cerca" class="table table-sm table-striped table-bordered dt-responsive nowrap"
                    width="100%" cellspacing="0">
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
                                                echo "<td>" . $ricerca[$i]['nominativo_destinatario']. "</td>";
                                                // echo "<td>" . $ricerca[$i]['nominativo_destinatario']. "</td>";
                                                echo "<td>" . $ricerca[$i]['commessa_descrizione']. "</td>";
                                                echo "<td>" . $ricerca[$i]['affidamento_tipo']."</td>";
                                                echo "<td>" . $ricerca[$i]['descrizione_item']. "</td>";
                                                echo "<td>" . $ricerca[$i]['affidamento_modulo_dsc']. "</td>";
                                                echo "<td>" . $ricerca[$i]['affidamento_data']. "</td>";
                                                //echo "<td>" . "<a href=\"/dettaglioDocumento/{$ricerca[$i]['affidamento_id']}\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettagli</a>"."</td>";
                                                if ( $ricerca[$i]['affidamento_modulo'] == 0 )
                                                    echo "<td> <a href=\"#\" data-toggle=\"tooltip\" title=\"Rigenera\"><button type=\"button\" class=\"btn btn-outline-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\"><i class=\"fas fa-download\"></i></button></a> <a href=\"#\" data-toggle=\"tooltip\" title=\"Carica\"><button type=\"button\" class=\"btn btn-outline-success uploadIDDocumento btn-sm\" data-toggle=\"modal\" data-target=\"#modal-caricaDocumento\"><i class=\"fas fa-upload\"></i>a</button></a> <a href=\"#\" data-toggle=\"tooltip\" title=\"Scarica PDF\"><button type=\"button\" class=\"btn btn-outline-info btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\" disabled><i class=\"far fa-file-pdf\"></i></button></a> <button type=\"button\" class=\"btn btn-outline-danger btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\">Dettagli</button> </td>";
                                                else
                                                    echo "<td> <a href=\"#\" data-toggle=\"tooltip\" title=\"Rigenera\"><button type=\"button\" class=\"btn btn-outline-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\" disabled><i class=\"fas fa-download\"></i></button></a> <a href=\"#\" data-toggle=\"tooltip\" title=\"Carica\"><button type=\"button\" class=\"btn btn-outline-success uploadIDDocumento btn-sm\" data-toggle=\"modal\" data-target=\"#modal-caricaDocumento\"><i class=\"fas fa-upload\"></i>b</button></a> <a href=\"#\" data-toggle=\"tooltip\" title=\"Scarica PDF\"><button type=\"button\" class=\"btn btn-outline-info btn-sm scaricaIDAffido\" data-toggle=\"modal\" data-target=\"#modal-scaricaFile\"><i class=\"far fa-file-pdf\"></i></button></a> <button type=\"button\" class=\"btn btn-outline-danger btn-sm\" data-toggle=\"modal\" data-target=\"#modal-default\">Dettagli</button> </td>";
                                                echo "</tr>";
                                            } 
                                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-caricaDocumento">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title uploadModulo">Carica modulo</h4>
                <h4 class="modal-title uploadModuloID"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <form id='formCaricaModulo' action="/uploadModulo/115" method="post" enctype="multipart/form-data"> -->
                    
                    <div class="container py-3">
                        <div class="input-group">
                            <div class="custom-file">
                                
                                <input type="file" accept="application/pdf" class="form-control-sm custom-file-input caricaDocumentoPDF" name='file' id="myInput" aria-describedby="myInput" required>
                                <label class="custom-file-label test" for="myInput">Carica il modulo</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="caricaFile">Carica!!</button>
                            </div>
                        </div>
                        <hr>
                        <form id="myForm">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input sceltaDocumento" name="documento" value='affido' checked>Documento <u>affido</u>
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input sceltaDocumento" name="documento" value='disaffido' >Documento <u>disaffido</u>
                                </label>
                            </div>
                        </form>
                        <!-- <div class="alert alert-info alertMsg" style='display:none;'>
                            il file è stato caricato
                        </div> -->
                    </div>
                <!-- </form> -->
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

<script>
    $(document).ready(function() {
        $('.btnCerca').click(function(){
            alert("OK");
            var seriale_input = $('#seriale_input').val(); 
            var tipo_articolo = $('#tipo_articolo').val(); 
            var stato_articolo = $('#stato_articolo').val(); 
            var condizione_input = $('#condizione_input').val(); 
            var commessa_input = $('#commessa_input').val(); 
            var sede_input = $('#sede_input').val(); 
            var stato_documenti = $('#stato_documenti').val();

            //alert(seriale_input); 

            $.ajax({
                type: "POST",
                url: "visualizzaTabellaRicerca",
                data: "seriale_input=123",
                success: function (response) {
                    $('.esitoVisualizza').html(response);
                }
            });
        }); 
        
        
        $('#seriale_input').val(localStorage.getItem("seriale_input")); 
        $('#tipo_articolo').val(localStorage.getItem("tipo_articolo")); 
        //manca data
        $('#commessa_input').val(localStorage.getItem("commessa_input")); 
        //manca id operazione
        $('#stato_documenti').val(localStorage.getItem("stato_documenti")); 

        
        // $('.btnCerca').trigger('click');
        // $('.btnCerca').attr('disabled','disabled');

        $('.btnCerca').click(function(){
            var seriale_input = $('#seriale_input').val(); 
            var tipo_articolo = $('#tipo_articolo').val(); 
            var stato_articolo = $('#stato_articolo').val(); 
            var condizione_input = $('#condizione_input').val(); 
            var commessa_input = $('#commessa_input').val(); 
            var sede_input = $('#sede_input').val(); 
            var stato_documenti = $('#stato_documenti').val();

            localStorage.setItem("seriale_input", seriale_input);
            localStorage.setItem("tipo_articolo", tipo_articolo);
            localStorage.setItem("stato_articolo", stato_articolo);
            localStorage.setItem("condizione_input", condizione_input);
            localStorage.setItem("commessa_input", commessa_input);
            localStorage.setItem("sede_input", sede_input);
            localStorage.setItem("stato_documenti", stato_documenti);

            

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
            // alert("OK")
            $('.alertMsg').css('display','none');
            var $row = $(this).closest("tr");    
            var $text = $row.find(".affidamento_id").text(); 
            $('.custom-file-input').val('');
            $('.custom-file-label').text("Carica il modulo"); 
            
            $('.downloadModulo').text($text);
            $('.uploadModuloID').css('display','none').text($text);
            $('#formCaricaModulo').attr('action','/uploadModulo/'+$text)

        });
        $(".scaricaIDAffido").click(function() {
            var $row = $(this).closest("tr");    // Find the row
            var $text = $row.find(".affidamento_id").text(); // Find the text
            $.ajax({
                type: "GET",
                url: "ricercaModuli/"+$text,
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
            // $('.downloadModulo').text($text);
            // //alert($text);
            // $('#formCaricaModulo').attr('action','/uploadModulo/'+$text)

        });


        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        document.querySelector('.custom-file-input').addEventListener('change',function(e){
            var fileName = document.getElementById("myInput").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        });

       

        $('#caricaFile').on('click', function() {
            $('.alertMsg').css('display','none');
            var uploadModuloID = ""; 
            var documento = $('input[name=documento]:checked', '#myForm').val();
            //alert("OK")
            var file_data = $('#myInput').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            form_data.append('documento', documento);
            console.log(file_data);
            uploadModuloID = $('.uploadModuloID').text(); 
            alert(uploadModuloID); 
            $.ajax({
                url: 'uploadModulo/'+uploadModuloID,
                dataType: 'text',  
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    if ( response.includes("ok") ){
                        $('.alertMsg').css('display','block');
                    }
                }
            });
        });
    });
</script>