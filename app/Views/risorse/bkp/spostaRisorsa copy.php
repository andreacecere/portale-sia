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
                        <li class="breadcrumb-item active">Sposta risorsa</li>
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
                    <h3 class="card-title">Sposta risorsa</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <!-- <label for="input_dipendente">Risorsa da spostare</label> -->
                <div class="card-body">
                    <form method="post" class="" action="">
                        <div class="form-row">
                            <div class="col">
                                <select class="form-control select2bs4" <?php if (session()->get('success')) echo "disabled=\"true\""; ?> name="risorsa" id="risorsa" value="<?= set_value('risorsa') ?>" style="width: 100%;">
                                    <option value="" disabled selected></option>
                                    <?php
                                    for ($i = 0; $i < count($elencoRisorse); $i++) {
                                        echo "<option value='{$elencoRisorse[$i]['anagrafica_id']}' >" . ucfirst($elencoRisorse[$i]['nome']) . ' ' . ucfirst($elencoRisorse[$i]['cognome']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" id="cerca_item_button" name="cerca_item_button" class="btn btn-primary ml-1">Cerca</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <label class="mb-3">Dati commessa - sede</label>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <!--<label for="articolo_seriale">Commessa attuale</label>-->
                            <input type="text" class="form-control" readonly name="commessa_input" id="commessa_input" value="<?= set_value('commessa_input') ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <!--<label for="articolo_tipo">Sede attuale</label>-->
                            <input type="text" class="form-control" readonly name="sede_input" id="sede_input" value="<?= set_value('sede_input') ?>">
                            <input type="text" class="form-control" readonly style="display: none;" id="fk_tipologia_articolo_id" value=''>
                        </div>
                    </div>

                    <!-- <hr> -->

                    <?php if ($showTable) : ?>

                        <label class="mb-3">Item affidati</label>
                        <hr>

                        <!--<table id="example" class="display table table-sm table-striped table-bordered table-hover" style="width:100%"> -->
                        <table id="tabella_risorse" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Seriale</th>
                                    <th>Tipo item</th>
                                    <th>Sede</th>
                                    <th>Commessa</th>
                                    <th>Data affido</th>
                                    <th>Azioni</th>
                                </tr>
                                <tr class="filters">
                                    <th>Seriale</th>
                                    <th>Tipo item</th>
                                    <th>Sede</th>
                                    <th>Commessa</th>
                                    <th>Data affido</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($elencoAffidi); $i++) {
                                    echo "<tr>";
                                    $seriale = $elencoAffidi[$i]['seriale_articolo'];
                                    echo "<td>" . $elencoAffidi[$i]['seriale_articolo'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['tipo_articolo'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['sede'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['commessa'] . "</td>";
                                    echo "<td>" . $elencoAffidi[$i]['affidamento_data'] . "</td>";
                                    echo "<td><label class=\"btn btn-sm bg-success\"><input type=\"radio\" name=\"$seriale\" id=\"option1\" autocomplete=\"off\" checked>  Sposta</label><label class=\"btn ml-2 btn-sm btn-danger\"><input type=\"radio\" name=\"$seriale\" id=\"option2\" autocomplete=\"off\">  Resta alla sede attuale</label>"
                                        . "</td>";
                                    //. "<a href=\"/dettaglioArticolo/{$listaAffidi[$i]['articolo_id']}\" class=\"btn btn-outline-dark btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettagli</a></td>";  */
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php endif; ?>


                </div>
            </div>
    </section>
</div>


<script src="<?php base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>

<!-- Script datatables -->
<style>
    .filters input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

    @media screen and (max-width: 937px) {
        .filters {
            display: none;
        }
    }
</style>

<script>
    $(document).ready(function() {
        $('#risorsa').change(function() {
            var anagrafica_id = $('#risorsa').val();
            if (anagrafica_id != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>/Articolo/getInfoDipendente",
                    method: "POST",
                    data: {
                        anagrafica_id: anagrafica_id
                    },
                    success: function(data) {
                        var parsed = JSON.parse(data);
                        var user = parsed[0];

                        $("#sede_input").val(user.sede);
                        $("#commessa_input").val(user.commessa);
                        $("#fk_sede_input").val(user.magazzino_id);
                        $("#fk_commessa_input").val(user.fk_commessa_id);
                        $("#risorsa_nominativo").val(user.nome + ' ' + user.cognome);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        });

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>

<!-- Script datatables -->
<script>
    $(document).ready(function() {
        $('#tabella_risorse thead .filters th').each(function() {
            var title = $('#tabella_risorse thead tr:eq(0) th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control form-control-sm">');
        });

        // DataTable
        var table = $('#tabella_risorse').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            responsive: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Italian.json"
            }
        });

        table.columns().eq(0).each(function(colIdx) {
            $('input', $('.filters th')[colIdx]).on('keyup change', function() {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    });
</script>