  <div class="content-wrapper">
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <li class="breadcrumb-item active">Affida item</li>
                      </ol>
                  </div>
              </div>
          </div>
      </section>

      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                      <div class="card card-outline card-primary">
                          <div class="card-header" style="background-color: white;">
                              <h3 class="card-title">Affida item</h3>
                              <h3 class="card-title idGeneratoPDF" style='display:none;'><?php if ( isset($pdfIDAffido)) echo $pdfIDAffido; ?></h3>
                          </div>
                          <?php if (session()->get('affida_success')) : ?>
                              <div class="alert alert-success" role="alert">
                                  <?= session()->get('affida_success') ?>
                              </div>
                          <?php endif; ?>
                          <form role="form" method="post">
                              <div class="card-body">
                                  <div class="form-row">
                                      <div class="form-group col-md-3">
                                          <label for="articolo_seriale">Seriale</label>
                                          <input type="text" class="form-control" readonly name="articolo_seriale" id="articolo_seriale" value='<?php echo ($articolo[0]['seriale']); ?>'>
                                      </div>
                                      <div class="form-group col-md-3">
                                          <label for="articolo_tipo">Tipo</label>
                                          <input type="text" class="form-control" readonly name="articolo_tipo" id="articolo_tipo" value='<?php echo ucfirst(($articolo[0]['tipo_articolo'])); ?>'>
                                          <input type="text" class="form-control" readonly style="display: none;" id="fk_tipologia_articolo_id" value='<?php echo ucfirst(($articolo[0]['fk_tipologia_articolo_id'])); ?>'>
                                      </div>
                                      <div class="form-group col-md-3">
                                          <label for="articolo_condizione">Condizione</label>
                                          <input type="text" class="form-control" readonly name="articolo_condizione" id="articolo_condizione" value='<?php echo ucfirst(($articolo[0]['condizione_articolo'])); ?>'>
                                          <input type="text" class="form-control" readonly style="display: none;" name="fk_condizione_id" id="fk_condizione_id" value='<?php echo ucfirst(($articolo[0]['fk_condizione_id'])); ?>'>
                                      </div>
                                      <div class="form-group col-md-3">
                                          <label for="articolo_condizione">Sede attuale</label>
                                          <input type="text" class="form-control" readonly name="articolo_condizione" id="articolo_condizione" value='<?php echo ucfirst(($articolo[0]['sede'])); ?>'>
                                          <input type="text" class="form-control" readonly style="display: none;" id="fk_magazzino_id" value='<?php echo ucfirst(($articolo[0]['fk_magazzino_id'])); ?>'>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="input_dipendente">Risorsa a cui affidare l'item</label>
                                      <select class="form-control select2bs4" <?php if (session()->get('success')) echo "disabled=\"true\""; ?> name="risorsa" id="risorsa" style="width: 100%;" required>
                                          <option value="" disabled selected></option>
                                          <?php
                                            //echo $affidato;
                                            for ($i = 0; $i < count($elencoRisorse); $i++) {
                                                echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}' >" . ucfirst($elencoRisorse[$i]['nome']) . ' ' . ucfirst($elencoRisorse[$i]['cognome']) . "</option>";
                                            }
                                            ?>
                                      </select>
                                      <input type="hidden" name="risorsa_nominativo" id="risorsa_nominativo" value="" />
                                  </div>
                                  <div class="form-row">
                                      <div class="form-group col-md-4">
                                          <label for="sede_input">Sede</label>
                                          <input type="text" class="form-control" readonly name="sede_input" id="sede_input" value=''>
                                          <input type="text" class="form-control" readonly name="fk_sede_input" style="display: none;" readonly id="fk_sede_input" value=''>
                                      </div>
                                      <div class="form-group col-md-4">
                                          <label for="commessa_input">Commessa</label>
                                          <input type="text" class="form-control" readonly name="commessa_input" id="commessa_input" value=''>
                                          <input type="text" class="form-control" readonly name="fk_commessa_input" readonly style="display: none;" id="fk_commessa_input" value=''>
                                      </div>
                                      <div class="form-group col-md-4">
                                          <label for="Responsabile">Responsabile commessa</label>
                                          <input type="text" class="form-control" readonly name="responsabile_input_dsc" id="responsabile_input_dsc" value=''>
                                          <input type="text" class="form-control" readonly name="responsabile_input_id" style="display: none;" id="responsabile_input_id" value=''>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="note_input">Note</label>
                                      <input type="text" class="form-control" <?php if (session()->get('success')) echo "readonly"; ?> name="note_input" id="note_input" value=''>
                                  </div>
                              </div>
                              <div class="card-footer">
                                  <button type="submit" class='btn btn-sm btn-primary btnSalva'>Salva</button>
                              </div>
                              <?php if (isset($validation)) : ?>
                                  <div class="card-footer">
                                      <div class="col-3">
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
          </div>
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Avviso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class='text-danger'>Attenzione, la procedura di affido non può continuare in quanto non è presente alcun responsabile</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btnResponsabileCommessa">Assegna responsabile alla commessa</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
      </div>
    </div>
  </div>
</div>


  <!-- Select 2 -->
  <script src="<?php base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>

  <script>
      $(document).ready(function() {
        var idPDF =  $('.idGeneratoPDF').text(); 
        var commessa; 


        if ( idPDF != "" ){
            window.open("http://192.168.0.161/reportserver/reportserver/httpauthexport?id=13734&format=pdf&user=user&apikey=test123&p_affidamento_id="+idPDF);
            $('.btnSalva').attr('disabled','disabled');
        }

          $('#risorsa').change(function() {
              var anagrafica_id = $('#risorsa').val();
              if (anagrafica_id != '') {
                  $.ajax({
                      url: "<?php echo base_url(); ?>/Articolo/getInfoDipendente",
                      method: "POST",
                      data: {
                          anagrafica_id: anagrafica_id
                      },
                      success: function(data) {
                          var parsed = JSON.parse(data);
                          var user = parsed[0];
                          commessa = user.fk_commessa_id;

                          console.log(user);

                          $("#sede_input").val(user.sede);
                          $("#commessa_input").val(user.commessa);
                          $("#fk_sede_input").val(user.magazzino_id);
                          $("#fk_commessa_input").val(user.fk_commessa_id);
                          var fk_commessa_id = user.fk_commessa_id;
                          $("#risorsa_nominativo").val(user.nome + ' ' + user.cognome);

                          $.ajax({
                              type: "GET",
                              url: "/getResponsabile/"+fk_commessa_id,
                              success: function (response) {
                                var json = JSON.parse(response);
                                var responsabile_id = json.responsabile_id; 
                                var nominativo_responsabile = json.nominativo_responsabile;
                                //console.log(responsabile_id+" "+nominativo_responsabile); 
                                $('#responsabile_input_dsc').val(nominativo_responsabile);
                                $('#responsabile_input_id').val(responsabile_id);
                                if ( responsabile_id == 0 || nominativo_responsabile == "" ){
                                    //alert("Attenzione, la procedura non può procedere in quanto non è presente nessun responsabile");
                                    $('.btnSalva').attr('disabled','disabled'); 
                                    $('.modal').modal('show'); 
                                }
                                else{
                                    $('.btnSalva').removeAttr('disabled','disabled'); 
                                }

                              },
                              error: function(xhr, ajaxOptions, thrownError) {
                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }        
                          });

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

          $('.btnResponsabileCommessa').click(function(){
            location.href = "/dettaglioCommessa/"+commessa
          });
      });
  </script>