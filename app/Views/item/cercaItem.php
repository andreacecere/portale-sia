<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!--<h1>Elenco risorse</h1>-->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cerca item</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <!-- card-header -->
                <div class="card-header" style="background-color: white;">
                    <h3 class="card-title">Cerca item</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">

                    <!-- <form>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="inputAddress">Seriale</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="inputEmail4">Tipo</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="inputPassword4">Stato</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="inputPassword4">Condizione</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="inputEmail4">Fornitore</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="inputPassword4">Data affido da</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="inputPassword4">Data affido a</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div> 
                        <button type="submit" class="btn btn-primary">Cerca</button>
                    </form> -->

                    <form>
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                <label for="inputAddress">Seriale</label>
                                <input type="text" class="form-control" id="inputAddress">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputEmail4">Tipo</label>
                                <select class="form-control select2bs4" name="tipo_articolo" id="tipo_articolo">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($listaTipoProdotti); $i++) {
                                        echo "<option value='{$listaTipoProdotti[$i]['tipologia_articolo_id']}' >" . $listaTipoProdotti[$i]['tipo_articolo'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputPassword4">Stato</label>
                                <select class="form-control select2bs4" name="stato_articolo" id="stato_articolo">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($listaStatoProdotti); $i++) {
                                        echo "<option value='{$listaStatoProdotti[$i]['stato_articolo_id']}' >" . $listaStatoProdotti[$i]['descrizione'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="inputPassword4">Condizione</label>
                                <select class="form-control select2bs4" name="condizione_input" id="condizione_input">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($listaCondizioni); $i++) {
                                        echo "<option value='{$listaCondizioni[$i]['condizione_id']}' >" . $listaCondizioni[$i]['descrizione'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="inputPassword4">Commessa</label>
                                <select class="form-control select2bs4" name="commessa_input" id="commessa_input">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($listaCommesse); $i++) {
                                        echo "<option value='{$listaCommesse[$i]['commessa_id']}' >" . $listaCommesse[$i]['descrizione'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="inputPassword4">Sede</label>
                                <select class="form-control select2bs4" name="sede_input" id="sede_input">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($listaMagazzini); $i++) {
                                        echo "<option value='{$listaMagazzini[$i]['magazzino_id']}' >" . $listaMagazzini[$i]['descrizione'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="inputPassword4">Data affido da</label>
                                <input type="password" class="form-control" id="inputPassword4">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="inputPassword4">Data affido a</label>
                                <input type="password" class="form-control" id="inputPassword4">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="inputEmail4">Fornitore</label>
                                <select class="form-control select2bs4" name="sede_input" id="sede_input">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($listaFornitori); $i++) {
                                        echo "<option value='{$listaFornitori[$i]['fornitore_id']}' >" . $listaFornitori[$i]['ragione_sociale'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div> -->
                        <button type="submit" class="btn btn-primary">Cerca</button>
                    </form>



                    <!--  <form method="post" class="" action="">
                        <div class="form-row">
                            <div class="col">
                                <select class="form-control select2bs4" name="input_anagrafica_id" id="input_anagrafica_id">
                                    <option value="" disabled selected></option>
                                    <?php
                                    /* for ($i = 0; $i < count($elencoAffidi); $i++) {
                                        echo "<option value='{$elencoAffidi[$i]['anagrafica_id']}' >" . $elencoAffidi[$i]['nome'] . ' ' . $elencoAffidi[$i]['cognome'] . "</option>";
                                    } */
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" id="cerca_item_button" name="cerca_item_button" class="btn btn-primary ml-1">Cerca</button>
                            </div>
                        </div>
                    </form> -->

                    <hr>
                    <div <?php echo "style=\"display: none;\""; ?>>
                        <table id="example" class="display table table-sm table-striped table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nominativo</th>
                                    <th>Seriale</th>
                                    <th>Sede</th>
                                    <th>Commessa</th>
                                    <th>Data affido</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*
                            for ($i = 0; $i < count($elencoAffidi); $i++) {
                                echo "<tr>";
                                echo "<td>" . $elencoAffidi[$i]['nome'] . ' ' . $elencoAffidi[$i]['cognome'] . "</td>";
                                echo "<td>" . $elencoAffidi[$i]['seriale_articolo'] . "</td>";
                                echo "<td>" . $elencoAffidi[$i]['sede'] . "</td>";
                                echo "<td>" . $elencoAffidi[$i]['commessa'] . "</td>";
                                echo "<td>" . $elencoAffidi[$i]['affidamento_data'] . "</td>";
                                echo "<td><a href=\"/affidaArticolo/{$elencoAffidi[$i]['anagrafica_id']}\" class=\"btn btn-outline-primary btn-sm \" role=\"button\" aria-disabled=\"true\">Cambio commessa</a>"
                                    . "<a href=\"/modificaArticolo/{$elencoAffidi[$i]['anagrafica_id']}\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Item affidati</a>"
                                    . "</td>";
                                //. "<a href=\"/dettaglioArticolo/{$listaAffidi[$i]['articolo_id']}\" class=\"btn btn-outline-dark btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettagli</a></td>";  
                                echo "</tr>";
                            } */
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>