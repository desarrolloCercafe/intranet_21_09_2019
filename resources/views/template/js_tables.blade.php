{!!Html::script("bower_components/jquery/dist/jquery.min.js")!!}
<!-- Bootstrap 3.3.7 -->
{!!Html::script("bower_components/bootstrap/dist/js/bootstrap.min.js")!!}
<!-- DataTables -->
{!!Html::script("bower_components/datatables.net/js/jquery.dataTables.min.js")!!}

{!!Html::script("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")!!}
<!-- SlimScroll -->
{!!Html::script("bower_components/jquery-slimscroll/jquery.slimscroll.min.js")!!}
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
{!!Html::script("bower_components/fastclick/lib/fastclick.js")!!}
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>