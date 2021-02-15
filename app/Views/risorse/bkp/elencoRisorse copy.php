<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assegna item</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Elenco risorse</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <!-- card-header -->
                <div class="card-header">
                    <h3 class="card-title">Elenco risorse</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <form class="" action="" method="post">
                        <div class="row">
                            <div class="col">
                                <select class="form-control select2bs4" name="input_anagrafica_id" id="input_anagrafica_id">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($elencoRisorse); $i++) {
                                        echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}' >" . $elencoRisorse[$i]['nome'] . ' ' . $elencoRisorse[$i]['cognome'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" id="cerca_item_button" name="cerca_item_button" class="btn btn-primary">Cerca</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example" class="display table table-sm table-striped table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nominativo</th>
                                        <th>Item</th>
                                        <th>Seriale</th>
                                        <th>Sede</th>
                                        <th>Commessa</th>
                                        <th>azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($listaAffidi); $i++) {
                                        echo "<tr>";
                                        echo "<td>" . $listaAffidi[$i]['nome'] . ' ' . $listaAffidi[$i]['cognome'] . "</td>";
                                        echo "<td>" . $listaAffidi[$i]['tipo_articolo'] . "</td>";
                                        echo "<td>" . $listaAffidi[$i]['seriale_articolo'] . "</td>";
                                        echo "<td>" . $listaAffidi[$i]['sede'] . "</td>";
                                        echo "<td>" . $listaAffidi[$i]['commessa'] . "</td>";
                                        /* echo "<td><a href=\"/affidaArticolo/{$listaAffidi[$i]['articolo_id']}\" class=\"btn btn-outline-primary btn-sm \" role=\"button\" aria-disabled=\"true\">Affida</a>"
                                            . "<a href=\"/modificaArticolo/{$listaAffidi[$i]['articolo_id']}\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Modifica</a>"
                                            . "<a href=\"/dettaglioArticolo/{$listaAffidi[$i]['articolo_id']}\" class=\"btn btn-outline-dark btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettagli</a></td>"; */
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>