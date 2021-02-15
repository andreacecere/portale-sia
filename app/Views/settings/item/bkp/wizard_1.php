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
                         <li class="breadcrumb-item active">Blank Page</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card card-outline card-primary">
             <div class="card-header" style="background-color: white;">
                 <h3 class="card-title">Configura ITEM</h3>

                 <div class="card-tools">
                     <a href='/aggiungiCategoria'><button type="button" class="btn btn-primary btn-sm"
                             data-toggle="tooltip" data-placement="left" title="Aggiungi categoria"><i
                                 class="fas fa-stream"></i></button></a>
                 </div>
             </div>
             <div class="card-body">
                 <!-- <form method="post"> -->

                <label>Categoria</label>
                <select class='form-control select2bs4' name='categoria' style='width:100%'>
                    <?php 
                            for($i=0; $i<count($categorieFoglie); $i++){
                                echo "<option>".ucfirst(strtolower($categorieFoglie[$i]['descrizione']))."</option>";
                            }
                        ?>
                </select>
                <label>Nome item</label>
                <input type='text' class='form-control' required maxlength="40" name='nome_item' minlength="1"
                    placeholder="Esempio: contatore">
                <br>
                <button type="button" class='btn btn-sm btn-primary btnProsegui1'>Prosegui</button>

                 <!-- </form> -->
             </div>
             <hr>
             <div class="card-body card2" style='display:none;'>
                <label>Categoria</label>
                <select class='form-control select2bs4' name='categoria' style='width:100%'>
                    <?php 
                            for($i=0; $i<count($categorieFoglie); $i++){
                                echo "<option>".ucfirst(strtolower($categorieFoglie[$i]['descrizione']))."</option>";
                            }
                        ?>
                </select>
                <label>Nome item</label>
                <input type='text' class='form-control' required maxlength="40" name='nome_item' minlength="1"
                    placeholder="Esempio: contatore">
                <br>
                <button type="button" class='btn btn-sm btn-primary btnProsegui2'>Prosegui</button>
             </div>
             <div class="card-body card3" style="display:none;">
                <label>Categoria</label>
                <select class='form-control select2bs4' name='categoria' style='width:100%'>
                    <?php 
                            for($i=0; $i<count($categorieFoglie); $i++){
                                echo "<option>".ucfirst(strtolower($categorieFoglie[$i]['descrizione']))."</option>";
                            }
                        ?>
                </select>
                <label>Nome item</label>
                <input type='text' class='form-control' required maxlength="40" name='nome_item' minlength="1"
                    placeholder="Esempio: contatore">
                <br>
                <button type="button" class='btn btn-sm btn-primary btnProsegui3'>Prosegui</button>
             </div>
             <hr>
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    $('.btnProsegui1').click(function(){
        $('.card2').fadeIn(); 
    }); 
    $('.btnProsegui2').click(function(){
        $('.card3').fadeIn(); 
    });         

});
 </script>