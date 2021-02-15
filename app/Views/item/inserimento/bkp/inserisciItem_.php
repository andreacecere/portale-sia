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
                    <!-- <a href='/aggiungiCommessa'><button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Aggiungi commessa"><i class="fas fa-plus-circle"></i></button></a>                 -->
                </div>
            </div>
            <div class="card-body">
                <div class="col-12 esitoInserimento">
                    
                </div>
                <label>Seleziona l'item da inserire</label>
                <div class="row">
                    <div class="col-md-10">
                        <select class="form-control select2bs4" name="tipo_articolo" id="tipo_articolo" style="width: 100%;" >
                            <?php
                                for ($i = 0; $i < count($articoli); $i++) {
                                    echo "<option value='{$articoli[$i]['tipologia_articolo_id']}'>".$articoli[$i]['tipo_articolo']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <button type="submit" id="cerca_item_button" name="cerca_item_button" class="btn btn-primary">Cerca</button>
                    </div>
                </div>
            </div>
             <!-- /.card-body -->
            <!-- <form method="POST"> -->
                <!-- <div class="card-footer dati" style="display: none;">
                    <div class='container-fluid'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <label>Seriale</label> <label style='color:red'> *</label>
                                <input type='text' class='form-control form-control-sm seriale' maxlength="10" required>
                                <p id='erroreSeriale'></p>
                            </div>
                            <div class='col-md-6'>
                                <label>Fornitori</label>
                                <select class='form-control form-control-sm select2bs4 fornitore'>
                                    <?php 
                                        for($i=0; $i<count($fornitori); $i++){
                                            echo "<option value='{$fornitori[$i]['fornitore_id']}'>".$fornitori[$i]['ragione_sociale']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='col-md-6'>
                                <label>Condizione</label>
                                <select class='form-control form-control-sm select2bs4 condizione'>
                                    <?php 
                                        for($i=0; $i<count($condizioni); $i++){
                                            echo "<option value='{$condizioni[$i]['condizione_id']}'>".ucfirst($condizioni[$i]['descrizione'])."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='col-md-6'>
                                <label>Stato</label>
                                <select class='form-control form-control-sm select2bs4 stato'>
                                    <?php 
                                        for($i=0; $i<count($stato); $i++){
                                            echo "<option value='{$stato[$i]['stato_articolo_id']}'>".ucfirst($stato[$i]['descrizione'])."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='col-md-6'>
                                <label>Magazzino</label>
                                <select class='form-control form-control-sm select2bs4 magazzino'>
                                    <?php 
                                        for($i=0; $i<count($sediMagazzino); $i++){
                                            echo "<option value='{$sediMagazzino[$i]['magazzino_id']}'>".$sediMagazzino[$i]['descrizioneMagazzino']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='col-md-6'>
                                <label>Note</label>
                                <textarea class='form-control form-control-sm note' maxlength='200' style='resize:none;'></textarea>
                            </div>
                            
                            
                        </div>
                    </div>
                   
                </div> -->
                
                <div class="card-footer esitoProdotto">
                    
                </div>
                <div class="card-footer aggiungiItem" style='display:none;important'>
                    <button type="submit" id="aggiungi" name="cerca_item_button" class="btn btn-primary btn-block aggiungi">Aggiungi item</button>
                </div>
            <!-- </form> -->
            <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <script>
     $(document).ready(function () {
         
         $('#cerca_item_button').click(function(){
            $('.aggiungiItem,.dati').css('display','block');
            $('.esitoProdotto').html("");
            var tipologia_articolo_id = $('#tipo_articolo').val();
            $.ajax({
                type: "POST",
                url: "ottieniAttributiAssociati",
                data: "tipologia_articolo_id="+tipologia_articolo_id,
                success: function (response) {
                    console.log(response);  
                    var obj = JSON.parse(response);
                    if ( obj[0] == "" ){
                        $('.aggiungi').css('display','none');
                        $('.esitoProdotto').html("<p class='text-center'><b>Attenzione, per l'item selezionato non sono stati trovati attributi l'operazione di inserimento non può continuare</b></p>");
                    }
                    else{
                        $('.aggiungi').css('display','block');
                        var elementi = obj.length; 
                        for(var i=0; i<elementi; i++){
                            //console.log(obj[i].DescrizioneArticolo);
                            
                            $('.esitoProdotto').append("<label class='lblesito'>"+obj[i].DescrizioneArticolo+"</label><br>");
                            var contaAttributi = obj[i].Attributo.length; 
                            //console.log(contaAttributi);
                            //$('.esitoProdotto').append("<select>");
                            var select = $("<select class='form-control form-control-sm esito' name='test'></select>");
                            for(var j=0; j<contaAttributi; j++){
                                select.append("<option>"+obj[i].Attributo[j]+"</option>");
                                //$('.text').append(new Option("A", "B"));
                                // $('.esitoProdotto').append("<option>"+obj[i].Attributo[j]+"</option>");
                                //console.log(obj[i].Attributo[j]);
                                // $('.esitoProdotto').append("</select>");
                                $('.esitoProdotto').append(select);
                                // $('.esitoProdotto').append("<button type=\"button\" id=\"aggiungi\" name=\"cerca_item_button\" class=\"btn btn-primary\">Aggiungi</button>");
                            }
                        }
                    } 
                }
            });
         }); 

        //  $('.codiceArticolo').keyup(function(){
            
        //     var cntTesto = $('.codiceArticolo').val().length 
        //     if ( cntTesto <= 3 ){
        //         $('.codiceArticolo').css('border','1px solid red');
        //         $('#erroreCodice').html("Attenzione, il codice articolo deve avere più di 3 caratteri");
        //     }
        //     else{
        //         $('#erroreCodice').html("");
        //         $('.codiceArticolo').css('border','1px solid green');
        //     }
        //  });

         $('.seriale').keyup(function(){
            var cntTesto = $('.seriale').val().length 
            if ( cntTesto <= 3 ){
                $('.seriale').css('border','1px solid red');
                $('#erroreSeriale').html("Attenzione, il codice articolo deve avere più di 3 caratteri");
            }
            else{
                $('#erroreSeriale').html("");
                $('.seriale').css('border','1px solid green');
            }
         });

         $('.aggiungi').click(function(){
            var tipo_articolo = $('#tipo_articolo').val(); 
            var magazzino = $('.magazzino').val(); 
            // var codiceArticolo = $('.codiceArticolo').val(); 
            var seriale = $('.seriale').val(); 
            var fornitore = $('.fornitore').val(); 
            var condizione = $('.condizione').val(); 
            var stato = $('.stato').val(); 
            var note = $('.note').val(); 

            // if ( codiceArticolo == "" || codiceArticolo.length <= 3 ){
            //     $('.codiceArticolo').css('border','1px solid red');
            //     return; 
            // }
            // // else{
            // //     $('.codiceArticolo').css('border','1px solid green');
            // // }
            if ( seriale == "" || seriale.length <= 3 ){
                $('.seriale').css('border','1px solid red');
                $('#erroreSeriale').html("Attenzione, il codice articolo deve avere più di 3 caratteri");
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return; 
            }
            if ( seriale.length >= 3 ){
                var arrayLbl = []; 
                var elementi = []; 
                $('.lblesito').each(function(index,item){
                    //alert($(this).text())
                    var lbl = $(this).text();
                    var lblMod = lbl.replace(" ","_");
                    arrayLbl.push(lblMod.toLocaleLowerCase() );
                });
                $('.esito').each(function(index,item){
                    //console.log($(this).val())
                    var esito = $(this).val(); 
                    var lblMod = esito.replace(" ","_");
                    elementi.push(lblMod.toLocaleLowerCase())
                });
                var arrayDati = []
                for(let i=0; i<arrayLbl.length; i++){
                    arrayDati.push(arrayLbl[i] + ':' + elementi[i])
                }

                var i = 0; 
                obj = arrayLbl.reduce(function(obj, v) {obj[v] = elementi[i];i++;return obj;}, {})

                $.ajax({
                    type: "POST",
                    url: "/doInserisciItem",
                    data: "tipo_articolo="+tipo_articolo+"&magazzino="+magazzino+"&fornitore="+fornitore+"&condizione="+condizione+"&stato="+stato+"&seriale="+seriale+"&note="+note+"&arrayDati="+JSON.stringify(obj),
                    success: function (response) {
                        //alert(response)
                        console.log(response);
                        if ( response.includes("Attenzione") ){
                            $('.esitoInserimento').html("<div class=\"alert alert-danger text-center\"><strong> Attenzione! </strong>"+response+"</div>");
                        }
                        else{
                            $('.esitoInserimento').html("<div class=\"alert alert-success text-center\">"+response+"</div>");
                        }
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }
                });
            }
         });
     });
 </script>