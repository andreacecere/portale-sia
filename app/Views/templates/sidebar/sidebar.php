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
                <li class=" nav-header">ITEM</li>

                <li class="nav-item">
                    <a href="/cercaArticolo"
                        class="nav-link <?= ($uri->getSegment(1) == 'cercaArticolo' ? 'active' : null) ?>">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Cerca
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/assegnaArticolo"
                        class="nav-link <?= ($uri->getSegment(1) == ('assegnaArticolo') ? 'active' : null) ?>">
                        <i class="nav-icon fas fa-forward"></i>
                        <p>
                            Affida item
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/elencoAffidi"
                        class="nav-link <?= ($uri->getSegment(1) == 'elencoAffidi' ? 'active' : null) ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Elenco affidi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/documenti" class="nav-link <?= ($uri->getSegment(1) == 'documenti' ? 'active' : null) ?>">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>
                            Documenti
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="/consumiCarburante"
                        class="nav-link <?= ($uri->getSegment(1) == 'consumiCarburante' ? 'active' : null) ?>">
                        <i class="nav-icon fas fa-gas-pump"></i>
                        <p>
                            Consumi carburante
                        </p>
                    </a>
                </li> -->

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

                <li class="nav-header">RICHIESTE</li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon  fas fa-cart-arrow-down"></i>
                        <!-- <i class="nav-icon fas fa-file-signature"></i> -->
                        <p>
                            Richieste ITEM
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="nuovaRichiesta" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Nuova richiesta
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/visualizzaRichieste" class="nav-link">
                                <i class="nav-icon far fa-eye"></i>
                                <p>
                                    Visualizza richieste
                                </p>
                            </a>
                        </li>
                    </ul>
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
                <li class="nav-item">
                    <a href="/spostaRisorsa"
                        class="nav-link <?= ($uri->getSegment(1) == 'spostaRisorsa' ? 'active' : null) ?>">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Richiesta spostamento
                        </p>
                    </a>
                </li>
                <li class="nav-item controlloRichieste">
                    <a href="/controlloRichieste"
                        class="nav-link <?= ($uri->getSegment(1) == 'controlloRichieste' ? 'active' : null) ?>">
                        <i class="nav-icon far fa-bell"><p style='display:none' id='user_id'><?php echo session()->get('id'); ?></p></i>
                        <p id='avvisi'>
                            <?php if (isset($valore) ) echo $valore ?>
                            <!-- Controllo richieste -->

                            <div class="spinner-grow spinner-grow-sm text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </p>
                    </a>
                </li>
                <li class="nav-header">SETTINGS</li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas  fa-sitemap"></i>
                        <!-- <i class="nav-icon fas fa-file-signature"></i> -->
                        <p>
                            Item
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/wizard" class="nav-link">
                                <i class="nav-icon fas fa-hat-wizard"></i>
                                <p>
                                    Configura item
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/inserisciItem"
                                class="nav-link <?= ($uri->getSegment(1) == 'inserisciItem' ? 'active' : null) ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>
                                    Aggiungi nuovo item
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/gestioneItem"
                                class="nav-link <?= ($uri->getSegment(1) == 'gestioneItem' ? 'active' : null) ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>
                                    Gestione Item
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/gestioneCondizioni"
                                class="nav-link  <?= ($uri->getSegment(1) == 'gestioneCondizioni' ? 'active' : null) ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>
                                    Condizioni
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/gestioneStati"
                                class="nav-link  <?= ($uri->getSegment(1) == 'gestioneStati' ? 'active' : null) ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>
                                    Stati
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <!-- <i class="nav-icon fas fa-file-signature"></i> -->
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Utenti
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/gestioneUtenti"
                                class="nav-link  <?= ($uri->getSegment(1) == 'gestioneUtenti' ? 'active' : null) ?>">
                                <i class="nav-icon fas fa-user-friends"></i>
                                <p>
                                    Accesso al portale
                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="/gestioneMansioni"
                                class="nav-link <?= ($uri->getSegment(1) == 'gestioneMansioni' ? 'active' : null) ?>">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>
                                    Mansioni
                                </p>
                            </a>
                        </li> -->
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <!-- <i class="nav-icon fas fa-file-signature"></i> -->
                        <p>
                            Gestione
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/gestioneCommesse"
                                class="nav-link <?= ($uri->getSegment(1) == 'gestioneCommesse' ? 'active' : null) ?>">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    Commesse
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/gestioneFornitori"
                                class="nav-link <?= ($uri->getSegment(1) == 'gestioneFornitori' ? 'active' : null) ?>">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Fornitori
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/gestioneSedi"
                                class="nav-link <?= ($uri->getSegment(1) == 'gestioneSedi' ? 'active' : null) ?>">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Sedi
                                </p>
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