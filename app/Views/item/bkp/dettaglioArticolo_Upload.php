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
                                     <div class="form-group col-md-4">
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
                                     <div class="form-group col-md-4">

                                         <label for="fornitore_articolo">Fornitore</label>
                                         <input type="text" class="form-control" readonly id="fornitore_articolo" value='<?php echo ($articolo[0]['fornitore']); ?>'>
                                         <!--<label for="condizione_articolo">Condizione</label>
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
             <div class='col-md-6'>
                <div class="card card-outline card-success">
                    <div class="card-header">Documenti</div>
                        <div class="card-footer">
                        <?php if (session('msg')) : ?>
                            <div class="alert alert-success">
                                <?= session('msg') ?>
                                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            </div>
                        <?php endif ?>
                    
                        <form action="/uploadModulo/<?php echo $articoloID; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="ultimo_affido_anagrafica" value='<?php echo $articolo[0]['ultimo_affido_anagrafica'];?>'>
                            <input type="hidden" name="tipo_articolo" value='<?php echo $articolo[0]['tipo_articolo'];?>'>
                            <input type="hidden" name="stato_articolo" value='<?php echo $articolo[0]['stato_articolo'];?>'>
                            <div class="container py-3">
                                <div class="input-group">
                                    <div class="custom-file">
                                        
                                        <input type="file" class="form-control-sm custom-file-input" name='file' id="myInput" aria-describedby="myInput">
                                        <label class="custom-file-label" for="myInput">Carica il modulo di affido</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" id="myInput">Carica</button>
                                    </div>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="documento" value='affido' checked>Documento <u>affido</u>
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="documento" value='disaffido' >Documento <u>disaffido</u>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
             <div class='col-md-6'>
                <div class="card card-outline card-success">
                    <div class="card-header">Documenti caricati</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nome documento</th>
                                    <th>Tipologia</th>
                                    <th>Azione</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>ciccio.pdf</td>
                                    <td>Affido</td>
                                    <td><a href='#'></a></td>
                                </tr>
                                <tr>
                                    <td>ciccio.pdf</td>
                                    <td>Disaffido</td>
                                    <td><a href='#'></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
             </div>
        </div>
     </section>
 </div>

 <script>
document.querySelector('.custom-file-input').addEventListener('change',function(e){
    var fileName = document.getElementById("myInput").files[0].name;
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = fileName
});

 </script>