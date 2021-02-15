<div class="content-wrapper">
    <section class="content-header">
        <!-- <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   <h1>Affida item</h1> 
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Affida item</li>
                    </ol>
                </div>
            </div>
        </div> -->
    </section>

    <section class="content">
        <!-- <div class="container-fluid"> -->
        <div class="card card-outline card-primary">
            <!-- card-header -->
            <div class="card-header" style="background-color: white;">
                <h3 class=" card-title">Affida Item</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form class="" action="" method="post">
                    <div class="row">
                        <div class="col">
                            <select class="form-control select2bs4" name="tipo_articolo" id="tipo_articolo" value="<?= set_value('tipo_articolo') ?>">
                                <option value="" disabled selected></option>
                                <?php
                                for ($i = 0; $i < count($listaTipoProdotti); $i++) {
                                    echo "<option value='{$listaTipoProdotti[$i]['tipologia_articolo_id']}' >" . $listaTipoProdotti[$i]['tipo_articolo'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="input_seriale_articolo" name="input_seriale_articolo" placeholder="Seriale articolo">
                        </div>
                        <div class="col">
                            <button type="submit" id="cerca_item_button" name="cerca_item_button" class="btn btn-primary">Cerca</button>
                        </div>
                    </div>
                    <?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </form>
                <hr>
                <!--<table id="example" class="display table table-sm table-striped table-bordered table-hover dt-responsive nowrap" style="width:100%" cellspacing="0">-->
                <table id="tabella_assegnaArticoli" class="table table-sm table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>seriale</th>
                            <th>tipo</th>
                            <th>condizione</th>
                            <th>stato</th>
                            <th>sede</th>
                            <th>azioni</th>
                        </tr>
                        <tr class="filters">
                            <th>seriale</th>
                            <th>tipo</th>
                            <th>condizione</th>
                            <th>stato</th>
                            <th>sede</th>
                            <th>azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($listaProdotti); $i++) {
                            echo "<tr>";
                            echo "<td>" . $listaProdotti[$i]['seriale'] . "</td>";
                            echo "<td>" . $listaProdotti[$i]['tipo_articolo'] . "</td>";
                            echo "<td>" . $listaProdotti[$i]['condizione_articolo'] . "</td>";
                            echo "<td>" . $listaProdotti[$i]['stato_articolo'] . "</td>";
                            echo "<td>" . $listaProdotti[$i]['sede'] . "</td>";
                            echo "<td><a href=\"/affidaArticolo/{$listaProdotti[$i]['articolo_id']}\" class=\"btn btn-outline-primary btn-sm \" role=\"button\" aria-disabled=\"true\">Affida</a>"
                                . "<a href=\"/modificaArticolo/{$listaProdotti[$i]['articolo_id']}\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Modifica</a>"
                                . "<a href=\"/dettaglioArticolo/{$listaProdotti[$i]['articolo_id']}\" class=\"btn btn-outline-dark btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettagli</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
        <!-- </div> -->
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

<!-- Script datatables -->
<script>
    $(document).ready(function() {
        $('#tabella_assegnaArticoli thead .filters th').each(function() {
            var title = $('#tabella_assegnaArticoli thead tr:eq(0) th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control form-control-sm">');
        });

        // DataTable
        var table = $('#tabella_assegnaArticoli').DataTable({
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