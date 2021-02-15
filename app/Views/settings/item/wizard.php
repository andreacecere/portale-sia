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
                         <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                         <li class="breadcrumb-item active">Configura item</li>
                     </ol>
                 </div>
             </div>
         </div>
     </section>




     <section class="content">
         <div class="card card-outline card-primary">
             <div class="card-header" style='background-color:white'>Configurazione guidata di un nuovo item</div>
             <div class="card-body">
                 <ul class="nav nav-pills justify-content-center nav-fill" id="myTab" role="tablist">
                     <li class="nav-item">
                         <a class="nav-link step1 active btn btn-rounded" id="home-tab" data-toggle="tab" href="#step1"
                             role="tab" aria-controls="step1" aria-selected="true" style="border-radius:900px;"><i
                                 class="fas fa-arrow-circle-right"></i></a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link step2 btn btn-rounded disabled" id="profile-tab" data-toggle="tab"
                             href="#step2" role="tab" aria-controls="step2" style="border-radius:900px;"
                             aria-selected="false"><i class="fas fa-arrow-circle-right"></i></a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link step3 btn btn-rounded disabled" id="contact-tab" data-toggle="tab"
                             href="#step3" role="tab" aria-controls="step3" style="border-radius:900px;"
                             aria-selected="false"><i class="fas fa-arrow-circle-right"></i></a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link step4 btn btn-rounded disabled" id="contact-tab" data-toggle="tab"
                             href="#step4" role="tab" aria-controls="step4" style="border-radius:900px;"
                             aria-selected="false"><i class="fas fa-clipboard-list"></i></a>
                     </li>
                 </ul>
                 <hr>
                 <div class="tab-content" id="myTabContent">
                     <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="home-tab">
                         <label>Seleziona la categoria</label>
                         <select class='form-control select2bs4' id='categoria' name='categoria' style='width:100%'>
                             <?php 
                                    for($i=0; $i<count($categorieFoglie); $i++){
                                        echo "<option>".ucfirst(strtolower($categorieFoglie[$i]['descrizione']))."</option>";
                                    }
                                ?>
                         </select>
                         <label>Nome item</label>
                         <input type='text' class='form-control' required maxlength="40" id='nome_item' name='nome_item'
                             minlength="1" placeholder="Esempio: contatore">
                         <br>
                         <button class='btn btn-success btn-sm' id="click-me-div1">Avanti <i class="fas fa-arrow-circle-right"></i></button>
                     </div>
                     <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="profile-tab">
                         <div class='row'>
                             <div class='col-md-6'>
                                 <div class="card card-outline card-warning">
                                     <div class="card-header" style="background-color: white;">
                                         <h3 class="card-title">Aggiungi attributo</h3>
                                         <div class="card-tools">
                                         </div>
                                     </div>

                                     <div class="card-body">
                                         <label>Nome attributo</label>
                                         <input type='text' class='form-control form-control-sm nomeAttributo'
                                             minlength="2" maxlength="40" required placeholder="Esempio: Classe"
                                             name='nome_attributo' autofocus>
                                     </div>
                                     <!-- /.card-body -->
                                     <div class="card-footer" style="background-color: white;">
                                         <button class='btn btn-primary btn-sm btnAggiungi'>Aggiungi</button>
                                     </div>

                                 </div>
                             </div>
                             <div class='col-md-6'>
                                 <div class="card card-outline card-primary">
                                     <div class="card-header" style="background-color: white;">
                                         <h3 class="card-title">Attributi associati</h3>
                                         <div class="card-tools"></div>
                                     </div>

                                     <div class="card-body listaAttributi">
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <br>
                         <button class='btn btn-success btn-sm' id="click-me-div2">Avanti <i class="fas fa-arrow-circle-right"></i></button>
                     </div>
                     <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="profile-tab">
                         <div class='col-md-12'>
                             <div class="card card-outline card-primary">
                                 <div class="card-header" style="background-color: white;">
                                     <h3 class="card-title">Attributi associati</h3>
                                     <div class="card-tools"></div>
                                 </div>

                                 <div class="card-body listaAttributi2">
                                 </div>
                             </div>
                         </div>
                         <br>
                         <button class='btn btn-success btn-sm' id="click-me-div3">Avanti <i class="fas fa-arrow-circle-right"></i></button>
                     </div>
                     <div class="tab-pane fade" id="step4" role="tabpanel" aria-labelledby="contact-tab">
                         <div class='col-md-12'>
                             <div class="card card-outline card-primary">
                                 <div class="card-header" style="background-color: white;">
                                     <h3 class="card-title">Riepilogo informazioni</h3>
                                     <div class="card-tools"></div>
                                 </div>
                                 <div class="card-body listaAttributi3">
                                 </div>
                                 <div class="card-body" style='margin-top:-35px;'>
                                     <label>Condizione</label>
                                     <select class='select2bs4' id='condizione_item'>
                                         <?php 
                                        for($i=0; $i<count($condizioni); $i++){
                                            echo "<option value='{$condizioni[$i]['condizione_id']}'>".$condizioni[$i]['descrizione']."</option>";     
                                        }
                                    ?>
                                     </select>
                                 </div>
                                 <div class='card-footer'><button class='btn btn-success btn-sm'
                                         id="click-me-div-finish">Concludi <i class="far fa-thumbs-up"></i></button>
                                 </div>
                             </div>
                         </div>
                        
                     </div>
                 </div>
             </div>
             <hr>
         </div>
     </section>
 </div>
 <script>
$(document).ready(function() {
    //var attributi = []; 
    //var valoreAttributi = []; 
    var test = [];
    var nomeAttributo;
    var valore = [];
    var test;
    var attributi_valore = [];
    var categoria_seleziona, nome_item, condizione_item;
    var array_fk_attributi_id = []; 
    $('[data-toggle="tooltip"]').tooltip();

    $('#click-me-div1').click(function() {
        categoria_seleziona = $('#categoria').val();
        nome_item = $('#nome_item').val();
        if ( nome_item == "" || nome_item == undefined ){
            $('#nome_item').css('border','1px solid red'); 
            return; 
        }
        else{

            $.ajax({
                type: "GET",
                url: "controllaEsistenzaITEM/"+nome_item,
                success: function (response) {
                    if ( response.includes("errore") ){
                        alert("Attenzione, risulta già presente l'item");
                    }
                    else{
                        $('#nome_item').css('border','1px solid green'); 
                        $('.step2').removeClass('disabled');
                        $('.nav-pills a[href="#step2"]').tab('show');
                    }                    
                }
            });

        }
        //alert(categoria_seleziona+" "+nome_item);
    });

    $('#click-me-div2').click(function() {
        if ( nomeAttributo == "" || nomeAttributo == undefined ){
            $('.nomeAttributo').css('border','1px solid red');
            return; 
        }
        else{
            $('.nomeAttributo').css('border','1px solid green');
        }
        $('.step3').removeClass('disabled');
        $('.nav-pills a[href="#step3"]').tab('show');
    });

    $('#click-me-div-finish').click(function() {
        condizione_item = $('#condizione_item').val();
        var fk_attributo_id; 
        var flag = 0; 
        var j = 0; 
        $.ajax({
            type: "GET",
            url: "aggiungiItemWizard",
            data: "nome_item="+nome_item+"&categoria="+categoria_seleziona,
            success: function (response) {
                var fk_tipologia_id = response.trim();
                
                for(var i=0; i<valore.length; i++){
                    $.ajax({
                        type: "GET",
                        url: "inserisciAttributiWizard/"+fk_tipologia_id+"/"+valore[i],
                        success: function (response) {
                            fk_attributo_id = response.trim();
                            $.ajax({
                                type: "GET",
                                url: "inserisciAttributiValoreWizard/"+fk_attributo_id+"/"+attributi_valore[0],
                                success: function (response) {
                                    
                                }
                            });
                            attributi_valore.shift();
                        },                 
                    });
                }
                $.ajax({
                    type: "GET",
                    url: "aggiungiCondizioneDispositivoWizard/"+fk_tipologia_id+"/"+condizione_item,
                    success: function (response) {
                    }
                }); 
                
            },
            complete: function(){
                alert("ITEM inserito");
                location.reload();
            }
        });

        // console.log(array_fk_attributi_id);

        // condizione_item = $('#condizione_item').val(); 
        // console.log(categoria_seleziona);
        // console.log(nome_item); 
        // for(var i=0; i<valore.length; i++){
        //     console.log(valore[i]); 
        // }
        // for(var i=0; i<attributi_valore.length; i++){
        //     console.log(attributi_valore[i])
        // }
        // console.log(condizione_item); 

        //alert("Fine, procedo a inserire");
        //alert("ITEM inserito");
        //location.reload();
    }); 
    $('.btnAggiungi').click(function() {
        nomeAttributo = $('.nomeAttributo').val();
        if ( nomeAttributo == "" || nomeAttributo == undefined ){
            $('.nomeAttributo').css('border','1px solid red');
            return; 
        }
        else{
            $('.nomeAttributo').css('border','1px solid green');
        }
        
        nomeAttributo = nomeAttributo.replace(" ", "_");
        valore.push(nomeAttributo)
        $('.listaAttributi').append("<p>" + nomeAttributo + "</p>");

        $('.listaAttributi2').append("<p>" + nomeAttributo + "<input type='text' name='" +
            nomeAttributo + "' id='" + nomeAttributo +
            "' class='form-control form-control-sm' maxlength='100'></p>");
        $('.nomeAttributo').val("");

    });

    $('#click-me-div3').click(function() {
      
        
        attributi_valore = []; 
        for (var i = 0; i < valore.length; i++) {
            test = $('#' + valore[i]).val();
            attributi_valore.push(test);
        }

        //console.log(attributi_valore);
        for (var i=0; i<attributi_valore.length; i++){
            if ( attributi_valore[i] == "" || attributi_valore[i] == undefined ){

                return; 
            }
        }
        $('.step4').removeClass('disabled');
        $('.nav-pills a[href="#step4"]').tab('show');


        $('.listaAttributi3').html("");
        $('.listaAttributi3').append("<p><b>Categoria selezionata: </b>" + categoria_seleziona +
        "</p>");
        $('.listaAttributi3').append("<p><b>Nome item: </b>" + nome_item + "</p>");
        for (var i = 0; i < valore.length; i++) {
            $('.listaAttributi3').append("<p><b>" + valore[i] + "</b>: " + attributi_valore[i] + "</p>");
        }


    });


});
 </script>