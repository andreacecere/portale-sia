 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <section class="content-header">
         <!--    <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">

                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active">Dettaglio articolo</li>
                     </ol>
                 </div>
             </div>
         </div>-->
     </section>

     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-6">
                     <div class="card card-outline card-primary">
                         <div class="card-header" style="background-color: white;">
                             <h3 class="card-title">Info item</h3>
                             <!-- <div class="card-tools">
                                 <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                     <i class="fas fa-times"></i></button>
                             </div> -->
                         </div>
                         <form role="form">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Seriale</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" value='<?php echo ($articolo[0]['seriale']); ?>' readonly>
                                 </div>
                                 <div class="form-row">
                                     <div class="form-group col-md-6">
                                         <label for="tipo_articolo">Tipo</label>
                                         <input type="text" class="form-control" readonly id="tipo_articolo" value='<?php echo ($articolo[0]['tipo_articolo']); ?>'>
                                         <!--<label for="inputCity">Tipo</label>
                                         <select class="form-control" disabled="disabled" name="tipo_articolo" id="tipo_articolo" style="width: 100%;">
                                         <label for="condizione_articolo">Condizione</label>
                                         <select class="form-control" disabled="disabled" name="condizione_articolo" id="condizione_articolo" style="width: 100%;">
                                             <?php
                                                /*
                                                for ($i = 0; $i < count($listaTipoProdotti); $i++) {
                                                    if (strtolower($listaTipoProdotti[$i]['condizione_articolo']) == strtolower(($articolo[0]['condizione_articolo'])))
                                                        echo "<option selected value='{$listaTipoProdotti[$i]['tipologia_articolo_id']}' >" . $listaTipoProdotti[$i]['tipo_articolo'] . "  </option>";
                                                } */
                                                ?>
                                         </select> -->
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Note</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" value='<?php echo ($articolo[0]['note']); ?>' readonly>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Attributi</label>
                                     <pre><?php echo ($articolo[0]['attributi']); ?></pre>
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
                                     <input type="text" class="form-control" id="exampleInputEmail1" readonly>
                                 </div>
                                 <div class="form-row">
                                     <div class="form-group col-md-4">
                                         <label for="inputCity">Stato</label>
                                         <input type="text" class="form-control" value='<?php echo ($articolo[0]['stato_articolo']); ?>' readonly id="inputCity">
                                     </div>
                                     <div class="form-group col-md-8">
                                         <label for="inputCity">Affidato</label>
                                         <input type="text" class="form-control" readonly id="inputCity">
                                     </div>
                                 </div>

                             </div>
                         </form>
                         <div class="card-footer">
                             <?php echo "<td><a href=\"/affidaArticolo/{$articolo[0]['articolo_id']}\" class=\"btn btn-warning btn-sm \" role=\"button\" aria-disabled=\"true\">Affida</a>" ?>
                         </div>
                     </div>
                 </div>
             </div>
     </section>
 </div>