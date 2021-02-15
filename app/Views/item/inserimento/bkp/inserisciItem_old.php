 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
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
         </div>
     </section>

     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12">
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
                                     <label for="exampleInputEmail1">Seleziona il tipo di prodotto che vuoi inserire</label>
                                     <select class='form-control'>
                                         <option></option>
                                         <?php 
                                            for($i=0; $i<count($articoli); $i++){
                                                echo "<option>".$articoli[$i]['tipo_articolo']."</option>";
                                            }
                                         ?>

                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Seriale</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" value='test' readonly>
                                 </div>

                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Note</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" value='note' readonly>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1" class="mb-3">Attributi</label>
                                     <?php
                                        // $json_string = $articolo[0]['attributi'];
                                        // $array = json_decode($json_string, true);

                                        // $count = 0;
                                        // $tot = count($array);

                                        // foreach ($array as $key => $val) {

                                        //     if ($count % 2 == 0)
                                        //         echo "<div class=\"form-group row\">";

                                        //     echo "<label for=\"colFormLabelSm\" class=\"col-sm-2 col-form-label col-form-label-sm\">$key</label>";
                                        //     echo "<div class=\"col-sm-4\">";
                                        //     echo "<input type=\"text\" readonly class=\"form-control form-control-sm\" value=\"$val\" name=\"$key\" id=\"$key\" colFormLabelSm\">";
                                        //     echo "</div>";

                                        //     if (($count % 2 != 0) || $count == $tot - 1)
                                        //         echo "</div>";

                                        //     $count++;
                                        // }
                                        ?>
                                 </div>
                             </div>
                         </form>
                         <!-- <div class="card-footer">
                             
                         </div> -->
                     </div>
                 </div>
             </div>
     </section>
 </div>