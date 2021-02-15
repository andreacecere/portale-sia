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
                <div class='col-md-6'>
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header " style='background-color: white!important;'>
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Crea nuova categoria</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Associa ad una categoria </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Messages</a>
                                </li> -->
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
                                    <div class='container-fluid'>
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <form method="post">
                                                    <input type='hidden' class='form-control' name='tipoFunzione' value="2" readonly>    
                                                    <label>Categorie</label>
                                                    <select class='form-control select2bs4 categoria' name='categoria' style='width:100%'>
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
                                            
                                            <!-- <div class="col-md-6 border-left">
                                                <label>Esplora le categorie</label>
                                                <div id="tree"></div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="card card-warning card-outline card-tabs">
                        <div class="card-header" style='background-color: white!important;'>
                        
                            <label>Esplora le categorie</label>
                        </div>
                        <div class="card-body">
                            
                            <div id="tree"></div>
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

 <script>


$(document).ready(function () {
   var myData;
    $.ajax({
        type: "GET",
        url: "albero",
        success: function (response) {
            myData = jQuery.parseJSON(response);
            //console.log(myData);
            const myTree = $('#tree').tree({
                primaryKey: 'id',
                dataSource: myData,
                checkboxes: false
            });
        }
    });

// const myData = [{ 
//       id: 1, 
//       text: 'Apple', 
//       children: [{ 
//         id: 2, 
//         text: 'Avocado' 
//       }] 
//       },{ 
//       id: 3, 
//       text: 'Banana', 
//       children: [{ 
//         id: 4, 
//         text: 'Beans' 
//       },{ 
//         id: 5, 
//         text: 'Broccoli',
//         children: [{ 
//           id: 6, 
//           text: 'Bunch Grape' 
//         }]
//       }]
// }]
// const myTree = $('#tree').tree({
//       primaryKey: 'id',
//       dataSource: myData,
//       checkboxes: true
// });
    //myTree.getCheckedNodes();

});

// var data;
// $.getJSON(
//     'albero',
//     function(data) {
//         $('#tree1').tree({
//             data: data
//         });
//     }
// );

 </script>
