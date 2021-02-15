  <div class="content-wrapper">
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <li class="breadcrumb-item active">Disaffida item</li>
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
                              <h3 class="card-title">Disaffida item</h3>
                              <h3 class="card-title idGeneratoPDF" style='display:block;'><?php if ( isset($pdfIDAffido)) echo $pdfIDAffido; ?></h3>
                          </div>
                          <?php if (session()->get('affida_success')) : ?>
                              <div class="alert alert-success" role="alert">
                                  <?= session()->get('affida_success') ?>
                              </div>
                          <?php endif; ?>
                          <form role="form" method="post">
                              <div class="card-body">
                                  <div class="form-row">
                                      <div class="form-group col-md-6">
                                          <label for="articolo_seriale">Seriale</label>
                                          <input type="text" class="form-control" readonly name="articolo_seriale" id="articolo_seriale" value='<?php echo ($articolo[0]['seriale_articolo']); ?>'>
                                          <input type="text" class="form-control" hidden name="affidamento_id" id="affidamento_id" value='<?php echo ($articolo[0]['affidamento_id']); ?>'>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <label for="risorsa_nominativo">Affidato a</label>
                                          <input type="text" class="form-control" readonly name="risorsa_nominativo" id="risorsa_nominativo" value='<?php echo ($articolo[0]['nome'] . ' ' . $articolo[0]['cognome']); ?>'>
                                      </div>
                                  </div>
                                  <div class="form-row">
                                      <div class="form-group col-md-3">
                                          <label for="sede_input">Sede attuale</label>
                                          <input type="text" class="form-control" readonly name="articolo_seriale" id="articolo_seriale" value='<?php echo ($articolo[0]['sede']); ?>'>
                                      </div>
                                      <div class="form-group col-md-3">
                                          <label for="commessa_input">Commessa</label>
                                          <input type="text" class="form-control" readonly name="commessa_input" id="commessa_input" value='<?php echo ($articolo[0]['commessa']); ?>'>
                                      </div>
                                      <div class="form-group col-md-4">
                                          <label for="commessa_input">Responsabile</label>
                                          <input type="text" class="form-control" readonly name="responsabile_descrizione" id="responsabile_descrizione" value='<?php echo ($articolo[0]['anagrafica_responsabile_descrizione']); ?>'>
                                      </div>
                                      <div class="form-group col-md-2">
                                          <label for="sede_input">Data affido</label>
                                          <input type="text" class="form-control" readonly name="articolo_seriale" id="articolo_seriale" value='<?php echo (date("d-m-Y h:i:s", strtotime($articolo[0]['affidamento_data']))); ?>'>
                                      </div>
                                      <!-- <div class="form-group col-md-4">
                                          <label for="commessa_input">Utente affidatario</label>
                                          <input type="text" class="form-control" readonly name="articolo_seriale" id="articolo_seriale" value='<php echo ($articolo[0]['ultimo_affido_user']); ?>'>
                                      </div> -->
                                  </div>

                                  <div class="form-row">
                                      <div class="form-group col-md-4">
                                          <label for="articolo_tipo">Tipo</label>
                                          <input type="text" class="form-control" readonly name="articolo_tipo" id="articolo_tipo" value='<?php echo ucfirst(($articolo[0]['tipo_articolo'])); ?>'>
                                      </div>
                                      <div class="form-group col-md-4">
                                          <label for="articolo_condizione">Condizione</label>
                                          <select class="form-control select2bs4" name="condizione_articolo" id="condizione_articolo">
                                              <?php
                                                for ($i = 0; $i < count($listaCondizioniArticolo); $i++) {
                                                    //if (strtolower($listaCondizioniArticolo[$i]['condizione_id']) == strtolower(($articolo[0]['fk_condizione_id'])))
                                                    if (($listaCondizioniArticolo[$i]['condizione_id']) == (($articolo[0]['fk_condizione_id'])))
                                                        echo "<option selected value='{$listaCondizioniArticolo[$i]['condizione_id']}' >" . $listaCondizioniArticolo[$i]['articolo_condizione'] . "  </option>";
                                                    else
                                                        echo "<option value='{$listaCondizioniArticolo[$i]['condizione_id']}' >" . $listaCondizioniArticolo[$i]['articolo_condizione'] . "</option>";
                                                }
                                                ?>
                                          </select>
                                      </div>
                                      <div class="form-group col-md-4">
                                          <label for="articolo_condizione">Fornitore</label>
                                          <input type="text" class="form-control" readonly name="articolo_fornitore" id="articolo_fornitore" value='<?php echo ucfirst(($articolo[0]['fornitore'])); ?>'>
                                      </div>
                                  </div>
                                  <div class="form-group mt-3">
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
                                  <div class="form-group">
                                      <label for="note_input">Note disaffido</label>
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

  <!-- Select 2 -->
  <script src="<?php base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>

  <script>
      $(document).ready(function() {
          $('.select2bs4').select2({
              theme: 'bootstrap4'
          })
      });

      $(document).ready(function() {
        var idPDF =  $('.idGeneratoPDF').text(); 

        if ( idPDF != "" ){
            window.open("http://192.168.0.161/reportserver/reportserver/httpauthexport?id=14509&format=pdf&user=user&apikey=test123&p_affidamento_id="+idPDF);
            $('.btnSalva').attr('disabled','disabled');
        }

      }); 
  </script>