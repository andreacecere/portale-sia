<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Versione</b> 0.0.1
    </div>
</footer>
</div>

<!-- Bootstrap 4 -->
<script type="text/javascript" src="<?php base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select 2 -->
<script src="<?php base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="<?php base_url() ?>/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php base_url() ?> /assets/dist/js/demo.js"></script>


<script>
    $(function() {
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example thead tr').clone(true).appendTo('#example thead');
            $('#example thead tr:eq(1) th').each(function(i) {
                var title = $(this).text();

                $(this).html('<input type="text" class="form-control form-control-sm" " />');

                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });

            var table = $('#example').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Italian.json"
                },
            });
        });

        //$('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>

</body>

</html>