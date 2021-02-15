  <div class="content-wrapper">
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">

                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <li class="breadcrumb-item active">Modifica item</li>
                      </ol>
                  </div>
              </div>
          </div>
      </section>

      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                      <!-- general form elements -->
                      <div class="card card-outline card-primary">
                          <div class="card-header" style="background-color: white;">
                              <h3 class="card-title">Info item</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form role="form" method="post">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Seriale</label>
                                      <input type="text" class="form-control" readonly id="seriale_articolo" value='<?php echo ($articolo[0]['seriale']); ?>'>
                                      <input type="text" hidden class="form-control" name="articolo_id" id="articolo_id" value='<?php echo ($articolo[0]['articolo_id']); ?>'>
                                  </div>
                                  <div class="form-row">
                                      <div class="form-group col-md-4" id="tipo_select">
                                          <label for="tipo_articolo" id="tipo_articolo_label">Tipo</label>
                                          <select class="form-control select2bs4" name="tipo_articolo" id="tipo_articolo" style="width: 100%;">
                                              <?php
                                                for ($i = 0; $i < count($listaTipoProdotti); $i++) {
                                                    if (strtolower($listaTipoProdotti[$i]['tipo_articolo']) == strtolower(($articolo[0]['tipo_articolo'])))
                                                        echo "<option selected value='{$listaTipoProdotti[$i]['tipologia_articolo_id']}' >" . $listaTipoProdotti[$i]['tipo_articolo'] . "  </option>";
                                                    else
                                                        echo "<option value='{$listaTipoProdotti[$i]['tipologia_articolo_id']}' >" . $listaTipoProdotti[$i]['tipo_articolo'] . "</option>";
                                                }
                                                ?>
                                          </select>
                                      </div>
                                      <div class="form-group col-md-4" id="condizione_select">
                                          <label for="condizione_articolo" id="condizione_articolo_label">Condizione</label>
                                          <select class="form-control select2bs4" name="condizione_articolo" id="condizione_articolo" style="width: 100%;">
                                              <?php
                                                for ($i = 0; $i < count($listaCondizioniArticolo); $i++) {
                                                    if (strtolower($listaCondizioniArticolo[$i]['articolo_condizione']) == strtolower(($articolo[0]['condizione_articolo'])))
                                                        echo "<option selected value='{$listaCondizioniArticolo[$i]['condizione_id']}' >" . $listaCondizioniArticolo[$i]['articolo_condizione'] . "  </option>";
                                                    else
                                                        echo "<option value='{$listaCondizioniArticolo[$i]['condizione_id']}' >" . $listaCondizioniArticolo[$i]['articolo_condizione'] . "</option>";
                                                }
                                                ?>
                                          </select>
                                      </div>
                                      <div class="form-group col-md-4" id="fornitore_select">
                                          <label for="fornitore_articolo" id="fornitore_articolo_label">Fornitore</label>
                                          <select class="form-control select2bs4" name="fornitore_articolo" id="fornitore_articolo" style="width: 100%;">
                                              <?php
                                                for ($i = 0; $i < count($listaFornitoriArticolo); $i++) {
                                                    if (strtolower($listaFornitoriArticolo[$i]['ragione_sociale']) == strtolower(($articolo[0]['fornitore']))) {
                                                        echo "<option selected value='{$listaFornitoriArticolo[$i]['fornitore_id']}' >" . $listaFornitoriArticolo[$i]['ragione_sociale'] . "  </option>";
                                                    } else
                                                        echo "<option value='{$listaFornitoriArticolo[$i]['fornitore_id']}' >" . $listaFornitoriArticolo[$i]['ragione_sociale'] . "</option>";
                                                }
                                                ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Note</label>
                                      <input type="text" class="form-control" name="note_articolo" id="note_articolo" value='<?php echo ($articolo[0]['note']); ?>'>
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
                              <div class="card-footer">
                                  <button type="submit" class='btn btn-sm btn-primary'>Salva modifiche</button>
                              </div>
                              <?php if (isset($validation)) : ?>
                                  <div class="card-footer">
                                      <div class="col-12">
                                          <div class="alert alert-danger" role="alert">
                                              <?= $validation->listErrors() ?>
                                          </div>
                                      </div>
                                  </div>
                              <?php endif; ?>
                              <?php if (session()->get('success')) : ?>
                                  <div class="card-footer">
                                      <div class=" col-3 m-3 alert alert-success" role="alert">
                                          <?= session()->get('success') ?>
                                      </div>
                                  </div>
                              <?php endif; ?>
                              <?php if (session()->get('error')) : ?>
                                  <div class="card-footer">
                                      <div class="col-3 m-3  alert alert-danger" role="alert">
                                          <?= session()->get('error') ?>
                                      </div>
                                  </div>
                              <?php endif; ?>
                          </form>
                      </div>
                  </div>
              </div>
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script src="<?php base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>

  <script>
      $(document).ready(function() {
          $('#tipo_articolo').change(function() {
              var tipo_articolo = $('#tipo_articolo').val();
              //alert(tipo_articolo);
              if (tipo_articolo != '') {

                  $.ajax({
                      url: "<?php echo base_url(); ?>/Articolo/getCondizioniJson",
                      method: "POST",
                      data: {
                          tipo_articolo: tipo_articolo
                      },
                      success: function(data) {
                          var parsed = JSON.parse(data);

                          var $el = $("#condizione_articolo");
                          $el.empty();

                          $.each(parsed, function(key, data2) {
                              console.log(key)
                              $.each(data2, function(index, data2) {
                                  $el.append($("<option></option>")
                                      .attr("value", data2.tipo_articolo_condizione_id).text(data2.articolo_condizione));
                              })
                          })

                      },
                      error: function(xhr, ajaxOptions, thrownError) {
                          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                      }
                  });

                  $.ajax({
                      url: "<?php echo base_url(); ?>/Articolo/getFornitoriJson",
                      method: "POST",
                      data: {
                          tipo_articolo: tipo_articolo
                      },
                      success: function(data) {
                          var parsed = JSON.parse(data);

                          var $el = $("#fornitore_articolo");
                          $el.empty();

                          $.each(parsed, function(key, data2) {
                              console.log(key)
                              $.each(data2, function(index, data2) {
                                  $el.append($("<option></option>")
                                      .attr("value", data2.fornitore_id).text(data2.ragione_sociale));
                              })
                          })
                      },
                      error: function(xhr, ajaxOptions, thrownError) {
                          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                      }
                  });
              }
          });

          $('.select2bs4').select2({
              theme: 'bootstrap4'
          })

          $('input, select').on('change', function() {
              $(this).addClass('changed');

              //myMap.set($(this).attr('id'), document.getElementById($(this).attr('id')).value);

            //   $(this).css('border', '1px solid red');

              if ($(this).attr('id') == 'tipo_articolo') {
                  $("#tipo_select").css('color', 'red');
                  $("#tipo_articolo_label").css('color', 'black');
              }

              if ($(this).attr('id') == 'condizione_articolo') {
                  $("#condizione_select").css('color', 'red');
                  $("#condizione_articolo_label").css('color', 'black');
              }

              if ($(this).attr('id') == 'fornitore_articolo') {
                  $("#fornitore_select").css('color', 'red');
                  $("#fornitore_articolo_label").css('color', 'black');
              }
          });
      });
  </script>


<script>
     $(document).ready(function () {
        
         var seriale = $('#seriale_articolo').val(); 
         
         var tipologia_item = $('#tipo_articolo').val(); 
         if ( tipologia_item == "1" )//indica il palmare
         { 
            $('.infoDispApp').append("<i class=\"fas fa-mobile-alt\"></i> Abilitazione dispositivo<br><br>");
            $.ajax({
                type: "GET",
                url: "http://webapp.easyservizi.it:8085/api_magazzino/getInfoDispositivo.php?imei="+seriale,
                success: function (response) {
                    console.log(response)
                    // if (response.ID == undefined ){
                        
                    //     $('.infoDispApp').append("<div class='container'>\
                    //     <div class='row'>\
                    //         <div class='col-md-4'><label>IMEI</label><input type='text' class='form-control form-control-sm' id='imei_new' readonly value='"+seriale+"'></div>\
                    //         <div class='col-md-4'><label>Password</label><input type='text' class='form-control form-control-sm' id='password_scelta' readonly></div>\
                    //         <div class='col-md-4'><label>ID Config App</label><input type='text' class='form-control form-control-sm' id='id_global' readonly></div>\
                    //         <div class='col-md-4'><label>Applicazione</label><input type='text' class='form-control form-control-sm' id='applicazione' readonly></div>\
                    //         <div class='col-md-4'><label>Attività</label><select id='selectList' class='form-control form-control-sm selectList'><option></option></select></div>\
                    //         <div class='col-md-4'><label>Abilita il dispositivo</label><br><button class='btn btn-success btn-sm btn-block btnSalvaDispApp' disabled>Salva</button></div>\
                    //     </div>\
                    //     </div>");
                    // }
                    // else{
                        $('.infoDispApp').append("<div class='container'>\
                        <div class='row'>\
                            <div class='col-md-4'><label>ID Dispositivo</label><input type='text' class='form-control form-control-sm' readonly value='"+response.ID+"'></div>\
                            <div class='col-md-4'><label>IMEI</label><input type='text' class='form-control form-control-sm' readonly value='"+response.IMEI+"'></div>\
                            <div class='col-md-4'><label>Password</label><input type='text' class='form-control form-control-sm' readonly value='"+response.Password+"'></div>\
                            <div class='col-md-4'><label>ID Config App</label><input type='text' class='form-control form-control-sm' id='id_global' readonly value='"+response.idGlobalConfig+"'></div>\
                            <div class='col-md-4'><label>Applicazione</label><input type='text' class='form-control form-control-sm' id='applicazione' readonly value='"+response.software+"'></div>\
                            <div class='col-md-4'><label>Attività</label><select id='selectList' class='form-control form-control-sm selectList'><option></option></select></div>\
                        </div>\
                        </div>");  

                    // }
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
            var idGlobal,software; 
            $.ajax({
                type: "GET",
                url: "http://webapp.easyservizi.it:8085/api_magazzino/getInfoSoftware.php?attivita="+attivita,
                success: function (response) {
                    //console.log(response);
                    idGlobal = response[0].IdGlobal; 
                    software = response[0].Software; 
                    seriale = $('#seriale_articolo').val(); 
                    $('#id_global').val(response[0].IdGlobal);
                    $('#applicazione').val(response[0].Software);
                    $('.btnSalvaDispApp').removeAttr('disabled','disabled');
                },
                complete:function(){
                    var conferma = confirm("Attenzione, confermando verranno modificate le abilitazioni al dispositivo, vuoi continuare ? ")
                    if ( conferma ){
                        //alert(seriale+" "+idGlobal+" "+software)
                        $.ajax({
                            type: "POST",
                            url: "http://webapp.easyservizi.it:8085/api_magazzino/updateDispAndroid.php",
                            data: "imei="+seriale+"&idGlobalConfiguration="+idGlobal+"&software="+software,
                            success: function (response) {
                                console.log("Esito: "+response);
                                alert("Aggiornamento abilitazione dispositivo");
                                location.reload();
                            }
                        });
                    }
                }
            });
        });

        
     }
 </script>
