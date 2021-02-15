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
                         <li class="breadcrumb-item"><a href='/consumiCarburante'>Consumi carburante</a></li>
                         <li class="breadcrumb-item active">Dettaglio</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card card-outline card-primary">
             <div class="card-header" style='background-color:#fff'>
                 <h3 class="card-title">Dettaglio consumo per la scheda <b><?php echo $dettaglio[0]['numero_carta']; ?></b></h3>
                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                         title="Collapse">
                         <i class="fas fa-minus"></i></button>
                 </div>
             </div>
             <div class="card-body" style="overflow-y: scroll; height:630px;">
                 <div class="col-md-12">
                     <?php 
                        for($i=0; $i<count($dettaglio); $i++){
                            echo "<ul class=\"timeline\">
                                <li style='margin-left:30px;'>
                                    <a>Località: <b>{$dettaglio[$i]['localita']}</b></a>
                                    <a class=\"float-right\"><b>".date('d-m-Y H:i',strtotime($dettaglio[$i]['data_transazione']))."</b></a>
                                    <ul style='margin-top:10px'>
                                       <li>Codice SAP: {$dettaglio[$i]['codice_sap']} </li>
                                       <li>Scontrino: {$dettaglio[$i]['scontrino']}</li>
                                       <li>Tipologia: {$dettaglio[$i]['tipo_prodotto']}</li>
                                       <li>Importo: <b>{$dettaglio[$i]['importo']} €</b></li>
                                       <li>Festivo: {$dettaglio[$i]['festivo']}</li>
                                       <li>Self service: {$dettaglio[$i]['self_service']}</li>
                                       <li>Codice autista: {$dettaglio[$i]['codice_autista']}</li>
                                       <li>Targa: {$dettaglio[$i]['targa']}</li>
                                    </ul>
                                </li>
                            </ul>"; 
                        }
                     ?>
                 </div>
             </div>
             <!-- /.card-body -->
             <div class="card-footer text-center" style='background-color:#fff'>
                 Totale costo: <b class='text-danger'><?php echo $costo[0]['importo']; ?>€</b>
             </div>
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <style>
 ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #006CB0;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #006CB0;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
</style>