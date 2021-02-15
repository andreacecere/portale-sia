
<style>
.sidebar-dark-success .nav-sidebar > .nav-item > .nav-link.active,
.sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
    background: linear-gradient(to right,#0060A6, #00ADE8);
    /*background-color: red!important;;*/
  color: #ffffff;
},

</style>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/dashboard" class="brand-link" style=''>
          <img src="<?php base_url() ?>/assets/img/pink_logo.png" class='img-fluid' alt="Easy Servizi" width="95%"
              style='margin-top:10px;'>
      </a>

      <!-- Sidebar -->
      <div class="sidebar" style='margin-top:30px;'>
          <?php $uri = service('uri');
            if (session()->get('isLoggedIn')) : ?>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-item has-treeview">
                      <a href="/dashboard"
                          class="nav-link <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>">
                          <i class="nav-icon fas fa-home "></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>



                  <li class="nav-header">FORMAZIONE DIPENDENTI</li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-file-signature"></i>
                          <p>
                              Formazione
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                          <li class="nav-item">
                              <a href="/ricercaAttestati" class="nav-link">
                                  <!-- <i class="far fa-circle nav-icon"></i> -->
                                  <i class="nav-icon fas fa-search"></i>
                                  <p>Ricerca</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/inserisciAttestato" class="nav-link">
                                  <i class="nav-icon fas fa-passport"></i>
                                  <!-- <i class="far fa-circle nav-icon"></i> -->
                                  <p>Attestati</p>
                              </a>
                          </li>
                      </ul>
                  </li>


                  <li class="nav-header">RISORSE</li>
                  <li class="nav-item">
                      <a href="/elencoRisorse"
                          class="nav-link <?= ($uri->getSegment(1) == 'elencoRisorse' ? 'active' : null) ?>">
                          <i class="nav-icon fas fa-id-card-alt"></i>
                          <p>
                              Elenco risorse
                          </p>
                      </a>
                  </li>
                  


              </ul>
          </nav>
          <?php endif; ?>
  </aside>

  <script>
$(document).ready(function() {
var user_id = $('#user_id').text(); 

setInterval(function() {
    $.ajax({
        type: "GET",
        url: "/getRichiestePending/"+user_id,
        success: function(response) {

            $('.spinner-grow').css('display', 'none');
            $('#avvisi').text("Hai " + response + " spostamenti");

        }
    });

}, 5000);
});
</script>