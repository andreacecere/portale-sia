 <div class="content-wrapper">
     <section class="content-header">
     </section>

     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-6">
                     <div class="card card-outline card-primary">
                         <div class="card-header" style="background-color: white;">
                             <h3 class="card-title">Info item</h3>
                         </div>
                         <form role="form">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label for="seriale">Seriale</label>
                                     <input type="text" class="form-control" id="seriale" value='<?php echo ($articolo[0]['seriale']); ?>' readonly>
                                 </div>
                                 <div class="form-row">
                                     <div class="form-group col-md-4">
                                         <label for="tipo_articolo">Tipo</label>
                                         <input type="text" class="form-control" readonly id="tipo_articolo" value='<?php echo ($articolo[0]['tipo_articolo']); ?>'>
                                     </div>
                                     <div class="form-group col-md-4">

                                         <label for="condizione_articolo">Condizione</label>
                                         <input type="text" class="form-control" readonly id="condizione_articolo" value='<?php echo ($articolo[0]['condizione_articolo']); ?>'>
                                     </div>
                                     <div class="form-group col-md-4">

                                         <label for="fornitore_articolo">Fornitore</label>
                                         <input type="text" class="form-control" readonly id="fornitore_articolo" value='<?php echo ($articolo[0]['fornitore']); ?>'>
                                         
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Note</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" value='<?php echo ($articolo[0]['note']); ?>' readonly>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1" class="mb-3">Attributi</label>
                                     <?php


                                        $json_string = $articolo[0]['attributi'];
                                        $array = json_decode($json_string, true);

                                        $count = 0;
                                        $tot = count($array);

                                        foreach ($array as $key => $val) {

                                            if ($count % 2 == 0)
                                                echo "<div class=\"form-group row\">";

                                            echo "<label for=\"colFormLabelSm\" class=\"col-sm-2 col-form-label col-form-label-sm\">$key</label>";
                                            echo "<div class=\"col-sm-4\">";
                                            echo "<input type=\"text\" readonly class=\"form-control form-control-sm\" value=\"$val\" name=\"$key\" id=\"$key\" colFormLabelSm\">";
                                            echo "</div>";

                                            if (($count % 2 != 0) || $count == $tot - 1)
                                                echo "</div>";

                                            $count++;
                                        }
                                        ?>
                                 </div>
                                 <hr>
                                 <div class='infoDispApp'>
                                    
                                 </div>
                             </div>
                         </form>
                         <div class="card-footer">
                             <?php echo "<td><a href=\"/modificaArticolo/{$articolo[0]['articolo_id']}\" class=\"btn btn-primary btn-sm \" role=\"button\" aria-disabled=\"true\">Modifica</a>" ?>
                         </div>
                     </div>
                 </div>


                 <div class="col-md-6">
                     <div class="card card-outline card-warning">
                         <div class="card-header" style="background-color: white;">
                             <h3 class="card-title">Info affido</h3>
                             
                         </div>
                         <form role="form">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Sede</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" value='<?php echo ($articolo[0]['sede']); ?>' readonly>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Commessa</label>
                                     <input type="text" class="form-control" value='<?php echo ($articolo[0]['ultimo_affido_commessa']); ?>' readonly id="inputCity">
                                 </div>
                                 <div class="form-row">
                                     <div class="form-group col-md-4">
                                         <label for="inputCity">Stato</label>
                                         <input type="text" class="form-control" value='<?php echo ($articolo[0]['stato_articolo']); ?>' readonly id="inputCity">
                                     </div>
                                     <div class="form-group col-md-8">
                                         <label for="inputCity">Affidato</label>
                                         <input type="text" class="form-control" value='<?php echo ($articolo[0]['ultimo_affido_anagrafica']); ?>' readonly id="inputCity">
                                     </div>
                                 </div>
                                 <div class="form-row">
                                     <div class="form-group col-md-4">
                                         <label for="inputCity">Data affido</label>
                                         <input type="text" class="form-control" value='<?php echo ($articolo[0]['ultimo_affido_data']); ?>' readonly id="inputCity">
                                     </div>
                                     <div class="form-group col-md-8">
                                         <label for="inputCity">Affidatario</label>
                                         <input type="text" class="form-control" value='<?php echo ($articolo[0]['ultimo_affido_user']); ?>' readonly id="inputCity">
                                     </div>
                                 </div>

                             </div>
                         </form>
                         <div class="card-footer">
                             <?php
                                if (strtolower(trim($articolo[0]['stato_articolo']) == 'libero')) {
                                    echo "<td><a href=\"/affidaArticolo/{$articolo[0]['articolo_id']}\" class=\"btn btn-warning btn-sm \" role=\"button\" aria-disabled=\"true\">Affida</a>";
                                }

                                if (strtolower(trim($articolo[0]['stato_articolo']) == 'Affidato')) {
                                    echo "<td><a href=\"/disaffidaArticolo/{$articolo[0]['articolo_id']}\" class=\"btn btn-warning btn-sm \" role=\"button\" aria-disabled=\"true\">Disffida</a>";
                                }
                                ?>
                         </div>
                         
                     </div>
                 </div>
             </div>
             <div class='row'>
                <div class='col-md-12'>
                    <div class="card card-outline card-success">
                        <div class="card-header">Storico movimenti</div>
                        <div class='card-body'>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Assegnatario</th>
                                        <th>Destinatario</th>
                                        <th>Commessa</th>
                                        <th>Tipologia di affido</th>
                                        <th>Data movimento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        for($i=0; $i<count($storicoMovimentiDocumenti); $i++){
                                            echo "<tr>";
                                            echo "<td>".ucfirst(strtolower($storicoMovimentiDocumenti[$i]['nominativo_assegnatario']))."</td>";
                                            echo "<td>".ucfirst(strtolower($storicoMovimentiDocumenti[$i]['nominativo_destinatario']))."</td>";
                                            echo "<td>".$storicoMovimentiDocumenti[$i]['descrizione_commessa']."</td>";
                                            echo "<td>".$storicoMovimentiDocumenti[$i]['affidamento_tipo']."<br>".$storicoMovimentiDocumenti[$i]['affidamento_note']."</td>";
                                            echo "<td>".date('d/m/Y H:i:s',strtotime($storicoMovimentiDocumenti[$i]['affidamento_data']))."</td>";
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

 <script>
     $(document).ready(function () {
        
         var seriale = $('#seriale').val(); 
         var tipologia_item = $('#tipo_articolo').val(); 
         if ( tipologia_item == "palmare" ){ 
            $('.infoDispApp').append("<i class=\"fas fa-mobile-alt\"></i> Abilitazione dispositivo<br><br>");
            $.ajax({
                type: "GET",
                url: "http://webapp.easyservizi.it:8085/api_magazzino/getInfoDispositivo.php?imei="+seriale,
                success: function (response) {
                    
                    if (response.ID == undefined ){
                        
                        $('.infoDispApp').append("<div class='container'>\
                        <div class='row'>\
                            <div class='col-md-4'><label>IMEI</label><input type='text' class='form-control form-control-sm' id='imei_new' readonly value='"+seriale+"'></div>\
                            <div class='col-md-4'><label>Password</label><input type='text' class='form-control form-control-sm' id='password_scelta' readonly></div>\
                            <div class='col-md-4'><label>ID Config App</label><input type='text' class='form-control form-control-sm' id='id_global' readonly></div>\
                            <div class='col-md-4'><label>Applicazione</label><input type='text' class='form-control form-control-sm' id='applicazione' readonly></div>\
                            <div class='col-md-4'><label>Attività</label><select id='selectList' class='form-control form-control-sm selectList'><option></option></select></div>\
                            <div class='col-md-4'><label>Abilita il dispositivo</label><br><button class='btn btn-success btn-sm btn-block btnSalvaDispApp' disabled>Salva</button></div>\
                        </div>\
                        </div>");
                    }
                    else{
                        $('.infoDispApp').append("<div class='container'>\
                        <div class='row'>\
                            <div class='col-md-4'><label>ID Dispositivo</label><input type='text' class='form-control form-control-sm' readonly value='"+response.ID+"'></div>\
                            <div class='col-md-4'><label>IMEI</label><input type='text' class='form-control form-control-sm' readonly value='"+response.IMEI+"'></div>\
                            <div class='col-md-4'><label>Password</label><input type='text' class='form-control form-control-sm' readonly value='"+response.Password+"'></div>\
                            <div class='col-md-4'><label>ID Config App</label><input type='text' class='form-control form-control-sm' readonly value='"+response.idGlobalConfig+"'></div>\
                            <div class='col-md-4'><label>Applicazione</label><input type='text' class='form-control form-control-sm' readonly value='"+response.software+"'></div>\
                            <div class='col-md-4'><label>Attività</label><input type='text' class='form-control form-control-sm' readonly value='"+response.attivita_dsc+"'></div>\
                        </div>\
                        </div>");  

                    }
                },
                complete:function(){
                    generaPassword(); 
                    ottieniAttivita(); 
                    ottieniValoreSelezionato(); 
                    
                }
                
            });
        }

     });

     function generaPassword(){
        var caratteri = ["A","B","C","D","E","F","G","H","I","L","M","N","O","P","R","S","T","U","V","Z","Y","K","W"]; 
        var password="",password_scelta = "";
        var carattere;
        var numeri="",numero="";  
        for(var i=0; i<3; i++){
            carattere = Math.floor(Math.random() * caratteri.length);
            password +=caratteri[carattere]; 
        }
        for(var i=0; i<2; i++){
            numeri = Math.floor(Math.random() * 9);
            numero += numeri; 
        }
        var password_scelta = password+numero;
        $('#password_scelta').val(password_scelta);
        console.log(password_scelta); 
     }

     function ottieniAttivita(){
         $.ajax({
             type: "GET",
             url: "http://webapp.easyservizi.it:8085/api_magazzino/getAttivita.php",
             success: function (response) {
                for(var i=0; i<response.length; i++){
                    $("#selectList").append(new Option(response[i].Descrizione, response[i].Descrizione));                
                }
             }
         });
     }

     function ottieniValoreSelezionato(){
        $('.selectList').change(function(){
            var attivita = $(this).val(); 
            $.ajax({
                type: "GET",
                url: "http://webapp.easyservizi.it:8085/api_magazzino/getInfoSoftware.php?attivita="+attivita,
                success: function (response) {
                    console.log(response);
                    $('#id_global').val(response[0].IdGlobal);
                    $('#applicazione').val(response[0].Software);
                    $('.btnSalvaDispApp').removeAttr('disabled','disabled');
                }
            });
        });

        $('.btnSalvaDispApp').click(function(e){
            var imei = $('#imei_new').val(); 
            var password_scelta = $('#password_scelta').val(); 
            var id_global = $('#id_global').val(); 
            var applicazione = $('#applicazione').val(); 
            alert(imei+" "+password_scelta+" "+id_global+" "+applicazione);
            $.ajax({
                type: "POST",
                url: "http://webapp.easyservizi.it:8085/api_magazzino/insertDispAndroid.php",
                data: "imei="+imei+"&operatore="+password_scelta+"&idGlobalConfiguration="+id_global+"&software="+applicazione,
                success: function (response) {
                    
                },
                complete:function(){
                    alert("Dispositivo configurato")
                    location.reload();
                }
            });
            e.preventDefault(); 
        })
     }
 </script>


