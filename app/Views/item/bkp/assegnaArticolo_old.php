<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assegna item</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Item</a></li>
                        <li class="breadcrumb-item active">Assegna item</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Assegna Item</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form class="" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tipo item</label>
                                    <select class="form-control select2bs4" name="tipo_articolo" id="tipo_articolo" value="<?= set_value('tipo_articolo') ?>" style="width: 100%;">
                                        <option value="" disabled selected></option>
                                        <?php
                                        for ($i = 0; $i < count($listaTipoProdotti); $i++) {
                                            echo "<option value='{$listaTipoProdotti[$i]['tipologia_articolo_id']}' >" . $listaTipoProdotti[$i]['tipo_articolo'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.row -->
                            <!-- /.row -->
                        </div>
                        <button type="submit" id="mostraListaArticoliButton" class="btn btn-primary">Mostra</button>
                    </form>
                    <!-- /.card-body -->
                    <!-- <div class="card-footer">
                    </div> -->
                </div>
                <!-- /.card -->
            </div><!-- fine card cerca articolo -->

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lista</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example" class="display table table-sm table-striped table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>seriale</th>
                                        <th>tipo</th>
                                        <th>condizione</th>
                                        <th>stato</th>
                                        <th>azioni</th>
                                    </tr>
                                </thead>
                                <tbody style="margin-top:5px;">
                                    <?php

                                    for ($i = 0; $i < count($listaProdotti); $i++) {
                                        echo "<tr>";
                                        echo "<td> " . $listaProdotti[$i]['seriale'] . "</td>";
                                        echo "<td>" . $listaProdotti[$i]['tipo_articolo'] . "</td>";
                                        echo "<td>" . $listaProdotti[$i]['condizione_articolo'] . "</td>";
                                        echo "<td>" . $listaProdotti[$i]['stato_articolo'] . "</td>";
                                        echo "<td><a href=\"#\" class=\"btn btn-outline-primary btn-sm \" role=\"button\" aria-disabled=\"true\">Affida</a>"
                                            . "<a href=\"#\" class=\"btn btn-outline-danger btn-sm \" style=\"margin-left:5px\" role=\"button\" aria-disabled=\"true\">Dettagli</a></td>";
                                        /*echo "<td><a href='" . base_url() . "/dettaglioArticolo/{$listaProdotti[$i]['articolo_id']}'><button class='btn btn-sm'><i class=\"fas fa-arrow-right\"></i></button></a>" .
                                            "<a href='" . base_url() . "/dettaglioArticolo/{$listaProdotti[$i]['articolo_id']}'><button class='btn btn-sm'><i class=\"fas fa-arrow-right\"></i></button></a>                                        
                                        </td>"; */

                                        //echo "<td>" . $listaProdotti[$i]['condizione_articolo'] . "</td>";
                                        //echo "<td>" . $listaProdotti[$i]['condizione_articolo'] . "</td>";
                                        //echo "<td><a href='" . base_url() . "/dettaglioUtente/{$listaProdotti[$i]['articolo_id']}'><button class='btn btn-sm'><i class=\"far fa-eye\"></i></button></a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- /.row -->

                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <!-- <div class="card-footer">
                    </div> -->
                </div>
                <!-- /.card -->
            </div><!-- fine card cerca articolo -->
    </section>
    <!-- /.content -->
</div>