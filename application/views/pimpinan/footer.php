


                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                Copyright © <script>document.write(new Date().getFullYear())</script> PT GEA<span class="d-none d-sm-inline-block"><i class="mdi mdi-heart text-danger"></i>.</span>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <!-- <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title px-3 py-4">
                    <a href="javascript:void(0);" class="right-bar-toggle float-end">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                    <h5 class="m-0">Settings</h5>
                </div>

               
                <hr class="mt-0" />
                <h6 class="text-center">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="<?=base_url()?>/assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="<?=base_url()?>/assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" 
                            data-appStyle="assets/css/app-dark.min.css" />
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="<?=base_url()?>/assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css" />
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>
                    <div class="d-grid">
                        <a href="https://1.envato.market/grNDB" class="btn btn-primary mt-3" target="_blank"><i class="mdi mdi-cart me-1"></i> Purchase Now</a>
                    </div>
                </div>

            </div> 
        </div> -->
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="<?=base_url()?>/assets/libs/jquery/jquery.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/node-waves/waves.min.js"></script>


        <!-- Peity chart-->
        <script src="<?=base_url()?>/assets/libs/peity/jquery.peity.min.js"></script>

        <!-- Plugin Js-->
        <script src="<?=base_url()?>/assets/libs/chartist/chartist.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>

        <script src="<?=base_url()?>/assets/js/pages/dashboard.init.js"></script>

        <!--<script src="<?=base_url()?>/assets/js/app.js"></script>-->
        <script src="<?=base_url()?>/assets/js/currency.js"></script>

        <!-- demo js-->
        <script src="<?=base_url()?>/assets/js/pages/chartist.init.js"></script>

        <!-- Required datatable js -->
        <script src="<?=base_url()?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Datatable init js -->
        <script src="<?=base_url()?>/assets/js/pages/datatables.init.js"></script> 
        <script src="<?=base_url()?>/assets/js/app.js"></script>

        <!-- Buttons examples -->
        <script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/jszip/jszip.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?=base_url()?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?=base_url()?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <script type="text/javascript">
                $(document).ready(function(){
                $('#datakwitansi_id').on('change',function(){ 
                // $('#datakwitansi_id').change(function(){ 
                    var datakwitansi_id=$(this).val();
                    $.ajax({
                        type : "POST",
                        url  : "<?php echo site_url('suratjalan_customer/ambilData')?>",
                        dataType : "JSON",
                        data : {datakwitansi_id: datakwitansi_id},
                        cache:false,
                        success: function(data){
                            $.each(data,function(datakwitansi_id, tanggal, no_polisi, nama_driver, lokasispbg){
                                $('[name="tanggal"]').val(data.tanggal);
                                $('[name="no_polisi"]').val(data.no_polisi);
                                $('[name="nama_driver"]').val(data.nama_driver);
                                $('[name="lokasispbg"]').val(data.lokasispbg);
                                $('[name="tekananawal"]').val(data.tekananawal);
                                $('[name="tekananakhir"]').val(data.tekananakhir);
                                $('[name="totalisatorawal"]').val(data.totalisatorawal);
                                $('[name="totalisatorakhir"]').val(data.totalisatorakhir);
                                $('[name="hargasatuan"]').val(data.hargasatuan);
                                $('[name="volumegas"]').val(data.volumegas);
                                $('[name="total"]').val(data.total);
                            });
                            
                        }
                    });
                    return false;
                });
                });

                $(document).ready(function(){
                $('#suratjalan_customer_id').on('change',function(){ 
                // $('#datakwitansi_id').change(function(){ 
                    var suratjalan_customer_id=$(this).val();
                    $.ajax({
                        type : "POST",
                        url  : "<?php echo site_url('tagihan_customer/ambilData')?>",
                        dataType : "JSON",
                        data : {suratjalan_customer_id: suratjalan_customer_id},
                        cache:false,
                        success: function(data){
                            $.each(data,function(suratjalan_customer_id, tanggalkirim, total){
                                $('[name="tanggalkirim"]').val(data.tanggalkirim);
                                $('[name="total"]').val(data.total);
                            });
                            
                        }
                    });
                    return false;
                });
                });

                $(document).ready(function(){
                $('#mastersupplier_id').on('change',function(){ 
                // $('#datakwitansi_id').change(function(){ 
                    var mastersupplier_id=$(this).val();
                    $.ajax({
                        type : "POST",
                        url  : "<?php echo site_url('data_kwitansi/ambilHargaSatuan')?>",
                        dataType : "JSON",
                        data : {mastersupplier_id: mastersupplier_id},
                        cache:false,
                        success: function(data){
                            $.each(data,function(mastersupplier_id){
                                $('[name="hargasatuan"]').val(data.hargasatuan);
                                
                                var volumegas =  $('[name="volumegas"]').val();
                                $('[name="total"]').val(data.hargasatuan * volumegas);
                            });
                            
                        }
                    });
                    return false;
                });
                });

                $(document).ready(function(){
                $('#volumegas').on('input',function(){ 
                    var hargasatuan =  $('[name="hargasatuan"]').val();
                    var volumegas =  $('[name="volumegas"]').val();
                    $('[name="total"]').val(hargasatuan * volumegas);
                });
                });
        </script>
        

    </body>

</html>