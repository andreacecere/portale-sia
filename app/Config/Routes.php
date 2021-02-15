<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Users');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/* default routs 

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true); */

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Controller::metodo
// http://example.com/[controller-class]/[controller-method]/[arguments]

// todo: fix alla pubblicazione sul server
$routes->get('/', 'Users::index');
$routes->get('/login', 'Users::login');

$routes->get('dashboard', 'Dashboard::index');
$routes->match(['get', 'post'], 'assegnaArticolo', 'Articolo::assegnaArticolo');
$routes->match(['get','post'],'/cambioPassword', 'Users::cambioPassword');
$routes->match(['get','post'],'/recuperoCredenziali', 'Users::recuperoCredenziali');
// $routes->match(['get','post'],'/generaPassword/(:any)/(:any)','Users::generaPassword/$1/$2');
$routes->match(['get','post'],'/generaPassword/(:any)/(:any)','Users::generaPassword/$1/$2');
$routes->get('/logout', 'Users::logout');

$routes->match(['get', 'post'], '/cercaArticolo', 'Articolo::cercaArticolo');
$routes->get('/dettaglioArticolo/(:num)', 'Articolo::dettaglioArticolo/$1');

$routes->match(['get', 'post'], '/modificaArticolo/(:num)', 'Articolo::modificaArticolo/$1');
//$routes->get('/modificaArticolo/(:num)', 'Articolo::modificaArticolo/$1');

//routes->get('/affidaArticolo/(:num)', 'Articolo::affidaArticolo/$1');
$routes->match(['get', 'post'], '/affidaArticolo/(:num)', 'Articolo::affidaArticolo/$1');

$routes->match(['get', 'post'], '/disaffidaArticolo/(:num)', 'Articolo::disaffidaArticolo/$1');

$routes->match(['get', 'post'], '/getCondizioniArticolo/(:num)', 'Articolo::getCondizioniArticolo/$1');
// Elenco risorse
$routes->match(['get', 'post'], 'elencoRisorse', 'Risorse::elencoRisorse');
// Elenco affidi
$routes->match(['get', 'post'], 'elencoAffidi', 'Articolo::elencoAffidi');
$routes->match(['get', 'post'], 'dettaglioAffidi/(:any)', 'Articolo::dettaglioAffidi/$1');
// Ricerca item
$routes->match(['get', 'post'], 'cercaArticolo', 'Articolo::cercaArticolo');
// Sposta risorse
$routes->match(['get', 'post'], 'spostaRisorsa/(:any)', 'Risorse::spostaRisorsa/$1');
$routes->match(['get', 'post'], 'spostaRisorsa', 'Risorse::spostaRisorsa');
$routes->get('/infoRisorsa/(:num)','Risorse::infoRisorsa/$1');
$routes->get('/infoCommessaDestinazione/(:num)','Risorse::infoCommessaDestinazione/$1');
$routes->post('/effettuaSpostamento','Risorse::effettuaSpostamento'); 

$routes->match(['get', 'post'], 'spostaRisorsa_old/(:any)', 'Risorse::spostaRisorsa_old/$1');
$routes->match(['get', 'post'], 'spostaRisorsa_old', 'Risorse::spostaRisorsa_old');

// consumi carburante
// $routes->match(['get', 'post'], 'consumiCarburante', 'Articolo::consumiCarburante');

$routes->get('getResponsabile/(:num)','Articolo::getResponsabile/$1');

//$routes->get('reimposta_password', 'Users::reimpostaPassword',);


//Routes: utenti
$routes->get('gestioneUtenti', 'Settings::indexUtenti');
$routes->match(['get', 'post'], '/dettaglioUtente/(:num)', 'Settings::dettaglioUtente/$1');
$routes->match(['get', 'post'], '/aggiungiUtente', 'Settings::aggiungiUtente');
$routes->post('/dettaglioAnagraficaUtente', 'Settings::dettaglioAnagraficaUtente');
//$routes->post('/aggiungiUtente', 'Settings::aggiungiUtente');

//Routes: commesse
$routes->get('gestioneCommesse', 'Settings::indexCommesse');
$routes->match(['get', 'post'], '/aggiungiCommessa', 'Settings::aggiungiCommessa');
$routes->match(['get', 'post'], '/dettaglioCommessa/(:num)', 'Settings::dettaglioCommessa/$1');


//Routes: fornitori
$routes->get('gestioneFornitori', 'Settings::indexFornitori');
$routes->match(['get', 'post'], '/aggiungiFornitore', 'Settings::aggiungiFornitore');
$routes->match(['get', 'post'], '/dettaglioFornitore/(:num)', 'Settings::dettaglioFornitore/$1');

//Routes: item
$routes->get('gestioneItem', 'Settings::indexItem');
$routes->match(['get', 'post'], '/aggiungiItem', 'Settings::aggiungiItem');
$routes->match(['get', 'post'], '/dettaglioItem/(:num)', 'Settings::dettaglioItem/$1');
$routes->match(['get', 'post'], '/aggiungiCategoria', 'Settings::aggiungiCategoria');
$routes->match(['get', 'post'], '/aggiungiAttributo/(:num)', 'Settings::aggiungiAttributo/$1');
$routes->get('albero', 'Settings::albero');

//Routes: condizioni
$routes->get('gestioneCondizioni', 'Settings::indexCondizioni');
$routes->match(['get', 'post'], '/aggiungiCondizione', 'Settings::aggiungiCondizione');
$routes->match(['get', 'post'], '/dettaglioCondizione/(:num)', 'Settings::dettaglioCondizione/$1');
$routes->match(['get', 'post'], '/aggiungiCondizioni', 'Settings::aggiungiCondizioni');

// //Routes: stato
$routes->get('gestioneStati', 'Settings::indexStati');
$routes->match(['get', 'post'], '/aggiungiStato', 'Settings::aggiungiStato');
$routes->match(['get', 'post'], '/dettaglioStato/(:num)', 'Settings::dettaglioStato/$1');
$routes->match(['get', 'post'], '/aggiungiStato', 'Settings::dettaglioStato');

//Routes: sedi_magazzino

$routes->get('gestioneSedi', 'Settings::indexSedi');
$routes->match(['get', 'post'], '/aggiungiItem', 'Settings::aggiungiItem');
$routes->match(['get', 'post'], '/dettaglioSede/(:num)', 'Settings::dettaglioSede/$1');
$routes->match(['get', 'post'], '/aggiungiSede', 'Settings::aggiungiSede');


$routes->match(['get', 'post'], '/inserisciItem', 'Articolo::inserisciItem');
$routes->match(['get','post'],'/ottieniAttributiAssociati', 'Articolo::ottieniAttributiAssociati');
$routes->post('/doInserisciItem', 'Articolo::doInserisciItem');
$routes->post('/uploadModulo/(:num)','Documenti::uploadModulo/$1'); 

/* Documenti */
$routes->match(['get', 'post'],'/documenti','Documenti::ricercaDocumenti');
$routes->match(['get', 'post'],'/documenti/(:any)','Documenti::ricercaDocumenti/$1');
$routes->get('/dettaglioDocumento/(:num)','Documenti::dettaglioDocumento/$1'); 
$routes->get('/ricercaModuli/(:num)/(:any)','Documenti::ricercaModuli/$1/$2'); 
$routes->get('/remainder','Documenti::remainder'); 
$routes->post('caricaFirma','Documenti::caricaFirma'); 
$routes->get('/ottieniFotoFirma/(:num)','Documenti::ottieniFotoFirma/$1');


// Controllo richieste 
$routes->match(['get','post'],'/controlloRichieste','Richieste::index');
$routes->get('/getRichiestePending/(:num)','Richieste::getRichiestePending/$1');
$routes->get('/confermaSpostamento/(:num)','Richieste::confermaSpostamento/$1'); 
$routes->get('/confermaRifiuto/(:num)','Richieste::confermaRifiuto/$1');

$routes->get('/getInfoDipendente2/(:num)','Articolo::getInfoDipendente2/$1');
$routes->get('/getResponsabileCommessa/(:num)/(:num)/(:num)','Articolo::testInfo/$1/$2/$3');


//wizard
$routes->get('/wizard','Settings::wizard');
$routes->get('/aggiungiItemWizard','Settings::aggiungiItemWizard'); 
$routes->get('/inserisciAttributiWizard/(:any)/(:any)','Settings::inserisciAttributiWizard/$1/$2'); 
$routes->get('/inserisciAttributiValoreWizard/(:any)/(:any)','Settings::inserisciAttributiValoreWizard/$1/$2');
$routes->get('/aggiungiCondizioneDispositivoWizard/(:any)/(:any)','Settings::aggiungiCondizioneDispositivoWizard/$1/$2');
$routes->get('/controllaEsistenzaITEM/(:any)','Settings::controllaEsistenzaITEM/$1');


//formazione

$routes->match(['get','post'],'/inserisciAttestato','Formazione::inserisciAttestato'); 
$routes->match(['get','post'],'/dettaglioAttestato/(:num)','Formazione::dettaglioAttestato/$1');
$routes->match(['get','post'],'ottieniListaAttestati/(:num)','Formazione::ottieniListaAttestati/$1'); 
$routes->match(['get','post'],'ottieniListaAttestatiNonAncoraDisponibile/(:num)','Formazione::ottieniListaAttestatiNonAncoraDisponibile/$1'); 
$routes->get('/ottieniInformazioniAttestato/(:num)','Formazione::ottieniInformazioniAttestato/$1');
$routes->post('/aggiornaAttestatiOperatore','Formazione::aggiornaAttestatiOperatore');
$routes->post('/attribuisciAttestatoRisorsa','Formazione::attribuisciAttestatoRisorsa'); 
$routes->post('/uploadAllegato','Formazione::uploadAllegato');
$routes->get('/verificaDocumentiPerOperatore/(:any)','Formazione::verificaDocumentiPerOperatore/$1');
$routes->match(['get','post'],'ricercaAttestati','Formazione::ricercaAttestati');


//RichiesteItem

$routes->match(['get','post'],'/nuovaRichiesta','RichiesteItem::nuovaRichiesta'); 
$routes->get('getAttributo/(:num)','RichiesteItem::getAttributo/$1');
$routes->post('/inserisciRichiestaItem','RichiesteItem::inserisciRichiestaItem');
$routes->match(['get','post'],'/visualizzaRichieste','RichiesteItem::visualizzaRichieste');
$routes->get('/getStatoRichiesta','RichiesteItem::getStatoRichiesta');
$routes->post('/cambioStatoRichiesta','RichiesteItem::cambioStatoRichiesta'); 
$routes->get('/timelineRichiesta/(:num)','RichiesteItem::timelineRichiesta/$1');
$routes->get('/verificaDisponibilita/(:num)/(:num)','RichiesteItem::verificaDisponibilita/$1/$2');
// $routes->get('testAnagrafica','RichiesteItem::testAnagrafica');


//Automezzi
$routes->match(['get','post'],'/ricercaAutomezzi','Automezzi::ricercaAutomezzi'); 
$routes->match(['get','post'],'/importaConsumi','Automezzi::importaConsumi'); 
$routes->post('/caricaFileConsumi','Automezzi::caricaFileConsumi');
$routes->match(['get', 'post'], 'consumiCarburante', 'Automezzi::consumiCarburante');
$routes->get('/dettaglioConsumiCarburante/(:any)', 'Automezzi::dettaglioConsumiCarburante/$1');


// //Cron - Email
// $routes->cli('cron','Cronjobs::cronEmail'); 

// //Test
$routes->get('test','Test::index');
$routes->get('/dispositivi','Test::test'); 
//$routes->cli('cron','Test::cron'); 

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
