<footer class="footer">
  <hr>
  <strong>Copyright &copy; 2018-2020 <a href="<?php echo base_url(""); ?>">NOVACAP Licitações</a>.</strong>
  Todos os direitos reservados.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 0.0.1
  </div>
</footer>

</div><!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url("assets/plugins/jquery/jquery.min.js"); ?>"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>

<!-- InputMask -->
<script src="<?php echo base_url("assets/plugins/moment/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js"); ?>"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url("assets/plugins/daterangepicker/daterangepicker.js"); ?>"></script>

<!-- DataTables -->
<script src="<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url("assets/dist/js/adminlte.min.js"); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url("assets/dist/js/demo.js"); ?>"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "searching": true,
      "language" : {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          },
          "select": {
              "rows": {
                  "_": "Selecionado %d linhas",
                  "0": "Nenhuma linha selecionada",
                  "1": "Selecionado 1 linha"
              }
          }
      },
      "columnDefs": [{"width": "13%", "targets" : 6}]
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker({
      locale: {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "De",
        "toLabel": "Até",
        "customRangeLabel": "Customizado",
        "daysOfWeek": [
          "Dom",
          "Seg",
          "Ter",
          "Qua",
          "Qui",
          "Sex",
          "Sáb"
        ],
        "monthNames": [
          "Janeiro",
          "Fevereiro",
          "Março",
          "Abril",
          "Maio",
          "Junho",
          "Julho",
          "Agosto",
          "Setembro",
          "Outubro",
          "Novembro",
          "Dezembro"
        ],
        "firstDay": 0
      }
    })
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "De",
        "toLabel": "Até",
        "customRangeLabel": "Customizado",
        "daysOfWeek": [
          "Dom",
          "Seg",
          "Ter",
          "Qua",
          "Qui",
          "Sex",
          "Sáb"
        ],
        "monthNames": [
          "Janeiro",
          "Fevereiro",
          "Março",
          "Abril",
          "Maio",
          "Junho",
          "Julho",
          "Agosto",
          "Setembro",
          "Outubro",
          "Novembro",
          "Dezembro"
        ],
        "firstDay": 0
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoje'    : [moment(), moment()],
          'Ontem'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Últimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
          'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
          'Este Mês'  : [moment().startOf('month'), moment().endOf('month')],
          'Último Mês': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment(),
        locale: {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "De",
        "toLabel": "Até",
        "customRangeLabel": "Customizado",
        "daysOfWeek": [
          "Dom",
          "Seg",
          "Ter",
          "Qua",
          "Qui",
          "Sex",
          "Sáb"
        ],
        "monthNames": [
          "Janeiro",
          "Fevereiro",
          "Março",
          "Abril",
          "Maio",
          "Junho",
          "Julho",
          "Agosto",
          "Setembro",
          "Outubro",
          "Novembro",
          "Dezembro"
        ],
        "firstDay": 0
      }
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
	
  });
</script>
</body>
</html>
