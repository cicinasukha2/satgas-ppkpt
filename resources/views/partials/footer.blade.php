<footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2025 <div class="bullet"></div> By Satgas PPKPT Universitas Teknologi Digital Indonesia
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- modal konfirmasi-->
  <div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Konfirmasi</h4>
        </div>
        <div class="modal-body btn-info">
          Apakah Anda yakin ingin menghapus data ini ?
        </div>
        <div class="modal-footer">
          <a href="javascript:;" class="btn btn-danger" id="hapus-true-data">Hapus</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        </div>
      </div>
    </div>
  </div>
<!-- General JS Scripts -->
<script src="{{ asset('modules/jquery.min.js') }}"></script>
<script src="{{ asset('modules/popper.js') }}"></script>
<script src="{{ asset('modules/tooltip.js') }}"></script>
<script src="{{ asset('modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('modules/moment.min.js') }}"></script>
<script src="{{ asset('js/stisla.js') }}"></script>


<!-- JS Libraries -->
<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>