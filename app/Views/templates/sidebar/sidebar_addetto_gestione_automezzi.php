<style>
.sidebar-dark-success .nav-sidebar>.nav-item>.nav-link.active,
.sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
    background: linear-gradient(to right, #0060A6, #00ADE8);
    /*background-color: red!important;;*/
    color: #ffffff;
}

,
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
                    <a href="/dashboard" class="nav-link <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>">
                        <i class="nav-icon fas fa-home "></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header">AUTOMEZZI</li>
                <li class="nav-item">
                    <a href="/consumiCarburante"
                        class="nav-link <?= ($uri->getSegment(1) == 'consumiCarburante' ? 'active' : null) ?>">
                        <i class="nav-icon fas fa-gas-pump"></i>
                        <p>
                            Consumi carburante
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-car"></i>
                        <p>
                            Automezzi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/ricercaAutomezzi" class="nav-link">
                                <i class="nav-icon fas fa-search"></i>
                                <p>Cerca</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/importaConsumi" class="nav-link">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>Importa consumi</p>
                            </a>
                        </li>
                    </ul>
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
            url: "/getRichiestePending/" + user_id,
            success: function(response) {

                $('.spinner-grow').css('display', 'none');
                $('#avvisi').text("Hai " + response + " spostamenti");

            }
        });

    }, 5000);
});
</script>