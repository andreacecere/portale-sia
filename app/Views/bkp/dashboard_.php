 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style='background-color:white'>
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Dashboard</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">

                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content" style='margin-top:30px;'>
         <div class='container-fluid'>
             <div class='row'>
                 <div class='col-md-3'>
                     <div class="info-box">
                         <span class="info-box-icon bg-primary"><i class="fas fa-mobile-alt"></i></span>
                         <div class="info-box-content">
                             <span class="info-box-text">Terminali</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'><a href="#" data-toggle="tooltip"
                                         data-placement="bottom" title="Disponibili">Disponibili:
                                         <?php echo $cntTerminaliLiberi[0]['seriale']; ?></a></span> / <a href="#"
                                     data-toggle="tooltip" data-placement="bottom" title="Affidati"> Affidati:
                                     <?php echo $cntTerminaliAffidati[0]['seriale']; ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class='col-md-3'>
                     <div class="info-box">
                         <span class="info-box-icon bg-primary"><i class="fas fa-sim-card"></i></span>
                         <div class="info-box-content">
                             <span class="info-box-text">Sim</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'><a href="#" data-toggle="tooltip"
                                         data-placement="bottom" title="Disponibili">Disponibili:
                                         <?php echo $cntSimLiberi[0]['seriale']; ?></a></span> / <a href="#"
                                     data-toggle="tooltip" data-placement="bottom" title="Affidati"> Affidati:
                                     <?php echo $cntSimLiberiAffidati[0]['seriale']; ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class='col-md-3'>
                     <div class="info-box">
                         <span class="info-box-icon bg-primary"><i class="fas fa-user-friends"></i></span>
                         <div class="info-box-content">
                             <span class="info-box-text">Risorse</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'><a
                                         href='elencoRisorse'><?php echo $risorse[0]['anagrafica_id']; ?></span></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class='col-md-3'>
                     <div class="info-box">
                         <span class="info-box-icon bg-primary"><i class="fas fa-building"></i></span>
                         <div class="info-box-content">
                             <span class="info-box-text">Commesse</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'><a
                                         href='gestioneCommesse'><?php echo $commesse[0]['descrizione']; ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class='col-md-3'>
                     <div class="info-box">
                         <span class="info-box-icon bg-primary"><i class="far fa-file-alt"></i></span>
                         <div class="info-box-content">
                             <span class="info-box-text">Moduli di affido</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'><a href="#" data-toggle="tooltip"
                                         data-placement="bottom" title="Da Caricare" class='text-danger'>Da caricare:
                                         <?php echo $documenti_da_caricare[0]['affidamento_modulo']; ?></a></span> / <a
                                     href="#" data-toggle="tooltip" data-placement="bottom" title="Caricati">Caricati:
                                     <?php echo $documenti_caricati[0]['affidamento_modulo']; ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class='col-md-3'>
                     <div class="info-box">
                         <span class="info-box-icon bg-primary"><i class="fas fa-file-signature"></i></span>
                         <div class="info-box-content">
                             <span class="info-box-text">Attestati di formazione</span>
                             <br>
                             <div style="float:left;">
                                 <span class="info-box-number" style='display:inline'><a href="/inserisciAttestato">
                                         <?php echo $attestati_formazione; ?></a></span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
 </script>