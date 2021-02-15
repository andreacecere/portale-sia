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
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active">Dettaglio articolo</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <!-- left column -->
                 <div class="col-md-6">
                     <!-- general form elements -->
                     <div class="card card-primary">
                         <div class="card-header">
                             <h3 class="card-title">Info articolo</h3>
                             <div class="card-tools">
                                 <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                     <i class="fas fa-times"></i></button>
                             </div>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form role="form">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Seriale</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" value='<?php echo ($articolo[0]['seriale']); ?>' readonly>
                                 </div>
                                 <div class="form-row">
                                     <div class="form-group col-md-6">
                                         <label for="inputCity">Tipo</label>
                                         <select class="form-control" disabled="disabled" name="tipo_articolo" id="tipo_articolo" style="width: 100%;">
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
                                     <div class="form-group col-md-6">
                                         <label for="inputCity">Condizione</label>
                                         <select class="form-control" disabled="disabled" name="tipo_articolo" id="tipo_articolo" style="width: 100%;">
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
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Note</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" value='<?php echo ($articolo[0]['note']); ?>' readonly>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Attributi</label>
                                     <pre><?php echo ($articolo[0]['attributi']); ?>'</pre>
                                 </div>
                             </div>
                             <!-- /.card-body -->

                             <!--<div class="card-footer">
                                 <button type="submit" class="btn btn-primary">Submit</button>
                             </div> -->
                         </form>

                         <div class="card-footer">
                             <?php echo "<td><a href=\"/dettaglioArticolo/{$articolo[0]['articolo_id']}\" class=\"btn btn-outline-primary btn-sm \" role=\"button\" aria-disabled=\"true\">Modifica</a>" ?>
                         </div>
                     </div>
                 </div>

                 <!-- right column -->
                 <div class="col-md-6">
                     <div class="card card-warning">
                         <div class="card-header">
                             <h3 class="card-title">Info affido</h3>
                             <div class="card-tools">
                                 <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                     <i class="fas fa-times"></i></button>
                             </div>
                         </div>
                         <!-- /.card-header -->
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
                             <!-- /.card-body -->

                             <!--<div class="card-footer">
                                 <button type="submit" class="btn btn-primary">Submit</button>
                             </div> -->
                         </form>
                         <!-- /.card-body -->
                         <div class="card-footer">
                             <button type="submit" id="cerca_item_button" name="cerca_item_button" class="btn btn-outline-primary btn-sm align-baseline ml-1">Affida</button>
                         </div>
                     </div>
                 </div>
             </div>


             <!-- <div class="card card-secondary">               
                 <div class="card-header">
                     <h3 class="card-title">Azioni articolo</h3>
                     <div class="card-tools">
                         <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                     </div>
                 </div>

                 <div class="card-body">
                     <form class="" action="" method="post">
                         <div class="row">
                             <button type="submit" id="cerca_item_button" name="cerca_item_button" class="btn btn-primary align-baseline ml-1">Modifica</button>
                             <button type="submit" id="cerca_item_button" name="cerca_item_button" class="btn btn-warning align-baseline ml-1">Affida</button>
                         </div>
                     </form>
                 </div>
             </div> -->

     </section>


     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->