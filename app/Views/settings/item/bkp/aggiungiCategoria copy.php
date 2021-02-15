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
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/gestioneItem">Gestione Item</a></li>
                        <li class="breadcrumb-item">Aggiungi categoria</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class='container-fluid'>
            <div class='row'>
            <div class="col-12">
                <?php $session = \Config\Services::session() ?>
                    <?php if ( isset($session->inserimento_categoria) ): ?>
                        <div class="alert alert-success" role="alert">                                
                            L'operazione è stata conclusa con successo
                        </div>
                    <?php endif; ?>
                    <?php if ( isset($session->errore_inserimento_categoria) ): ?>
                        <div class="alert alert-danger" role="alert">                                
                            <?php echo $session->errore_inserimento_categoria; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class='col-md-12'>
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0" style='background-color: white!important;'>
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Crea nuova categoria</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Associa ad una categoria </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Messages</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Settings</a>
                                </li> -->
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                    <form method="post">
                                        <input type='hidden' class='form-control' name='tipoFunzione' value="1" readonly>    
                                        <label>Nome categoria</label>
                                        <input type='text' class='form-control' required maxlength="40" name='nome_categoria' minlength="4" placeholder="Esempio: contatore">
                                        <br>
                                        <button type="submit" class='btn btn-sm btn-primary'>Crea una nuova categoria</button>    
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                    <form method="post">
                                        <input type='hidden' class='form-control' name='tipoFunzione' value="2" readonly>    
                                        <label>Categorie</label>
                                        <select class='form-control select2bs4' name='categoria' style='width:100%'>
                                            <?php 
                                                for($i=0; $i<count($allCategorie); $i++){
                                                    echo "<option>".ucfirst(strtolower($allCategorie[$i]['descrizione']))."</option>";
                                                }
                                            ?>
                                        </select>
                                        <label>Nome categoria</label>
                                        <input type='text' class='form-control' required maxlength="40" name='nome_categoria' minlength="4" placeholder="Esempio: contatore">
                                        <br>
                                        <button type="submit" class='btn btn-sm btn-primary'>Associa alla categoria selezionata</button>  
                                    </form>
                                </div>

  
                                <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                                    
                                    <?php 

                                        //echo $albero[0]['descrizione']."<br>";//Padre
                                        //echo count($albero[0]['Figlio'][0])."<br>";
                                        //echo print_r($albero[1]['Figlio'][0])."<br><br>";
                                        $nodiPadri = count($test);
                                        //echo $nodiPadri; 
                                        for($padre = 0; $padre<$nodiPadri; $padre++){
                                            echo "<ul id=\"myUL\">";
                                            echo "<li><span class=\"caret\">".ucfirst(strtolower($test[$padre]['descrizione']))."</span>";
                                            echo "<ul class=\"nested\">";
                                            //echo "<b>Padre:</b> ".$test[$padre]['descrizione']."<br>";
                                            for($i=0; $i<count($albero[$padre]['Figlio'][0]); $i++){
                                                if ( isset($albero[$padre]['Figlio'][$i]['descrizione']) ){
                                                    echo "<li>Nodo: ".ucfirst(strtolower($albero[$padre]['Figlio'][$i]['descrizione']))."</li>";
                                                    //echo "->Nodo: ".$albero[$padre]['Figlio'][$i]['descrizione']."<br>";
                                                    if ( isset($albero[$padre]['Figlio'][$i]['Figlio']) ){
                                                        $nodiInterni = count($albero[0]['Figlio'][$i]['Figlio']);
                                                        //echo "Nodi interni: ".count($albero[0]['Figlio'][$i]['Figlio'])."<br>";
                                                        for ($j=0; $j<$nodiInterni; $j++){
                                                            //echo "--->Nodo interno: ".$albero[$padre]['Figlio'][0]['Figlio'][$j]['descrizione']."<br>";
                                                            if ( isset($albero[$padre]['Figlio'][0]['Figlio'][$j]['Figlio']) ){
                                                                echo "<li><span class=\"caret\">Sottonodo: ".ucfirst(strtolower($albero[$padre]['Figlio'][0]['Figlio'][$j]['descrizione']))."</span>";
                                                                $sottoNodiInterni = count($albero[0]['Figlio'][0]['Figlio'][$j]['Figlio']);
                                                                echo "<ul class=\"nested\">";
                                                                for($w=0; $w<$sottoNodiInterni; $w++){
                                                                    //echo $sottoNodiInterni;                                                                    
                                                                    echo "<li class='sottonodointerno'>A".ucfirst(strtolower($albero[$padre]['Figlio'][0]['Figlio'][$j]['Figlio'][$w]['descrizione']))."</li>";
                                                                    //echo "---->Nodo interno: ".$albero[$padre]['Figlio'][0]['Figlio'][$j]['Figlio'][$w]['descrizione']."<br>";                                                                    
                                                                }
                                                                echo "</ul>";
                                                                //echo "---Nodo interno: ".$albero[0]['Figlio'][0]['Figlio'][$j]['descrizione']."<br>";
                                                                //print_r($albero[0]['Figlio'][0]['Figlio'][$j]['Figlio'][1]['descrizione']);
                                                            }
                                                        }
                                                    }
                                                }
                                                echo "</li>";
                                            }
                                            echo "</ul>";
                                        }
     
                                        $dumpStr = var_export($albero,true);
                                        echo "<pre>";
                                        echo $dumpStr;
                                        echo "</pre>";

                                    ?>
                                    
                                </div>
                                <!--<div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                                    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis. 
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>

         
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\002B";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}

.sottonodointerno {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.sottonodointerno:before {
  content: '↳';
  margin-right: 10px;
  font-size: 20px;
}
</style>
<script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>
