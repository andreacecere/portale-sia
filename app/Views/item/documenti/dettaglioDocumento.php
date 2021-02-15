 <!-- Content Wrapper. Contains page content -->
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
                                     <label for="exampleInputEmail1">Seriale</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" value='<?php echo ($articolo[0]['seriale']); ?>' readonly>
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
                             </div>
                         </form>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="card card-outline card-warning">
                         <div class="card-header" style="background-color: white;">
                             <h3 class="card-title">Info affido</h3>
                             <!-- <div class="card-tools">
                                 <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                     <i class="fas fa-times"></i></button>
                             </div> -->
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
                         
                     </div>
                 </div>

             </div>

     </section>
 </div>

