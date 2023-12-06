
<!-- jQuery 3 -->
<script src="https://act.webseitama.com/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <!-- <h6 class="page-title">Data Ruangan</h6> -->
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#">Laporan Account Ledger</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Laporan Account Ledger</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-md-block">
                                        <div class="dropdown">                                                                

                                            <!-- <a class="btn btn-primary" href="<?php echo base_url()?>customer/tambah" role="button">Tambah Progress Lisensi</a> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body" style="background-color: #ececf1;">
                                        <!-- <h4 class="card-title mb-4">Form Laporan Account Ledger</h4> -->

                                        <!-- <form action="<?php echo base_url('laporan_account_ledger/cetakpdf');?>" method="POST" enctype="multipart/form-data">  -->
                                            


                                            <div class="row">




                                                <div class="col-lg-2">
                                                    <div>
                                                        <div class="mb-2">
                                                            <label class="form-label" for="input-date1">Dari Tanggal</label>
                                                            <input class="form-control" type="date" name="fromDate" id="fromDate">
                                                            <!-- <span class="text-muted">e.g "dd/mm/yyyy"</span> -->
                                                        </div>                                                    
                                                    </div>
                                                </div>                                             
                                                

                                                <div class="col-lg-2">
                                                    <div class="mt-2 mt-lg-0">
                                                        <div class="mb-2">
                                                            <label class="form-label" for="input-email">Sampai Tanggal</label>
                                                            <input class="form-control" type="date" name="toDate" id="toDate">  
                                                        </div>
                                                        
                                                    </div>                                                    
                                                </div>



                                                
                                                <!-- <div class="col-lg-4">
                                                    <div class="mt-4 mt-lg-0">                                                        
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-repeat">Pilih No Rekening</label>                                                            
                                                            <select name="no_rek" id="no_rek" class="form-control">
                                                                <option value="">Pilih No Rekening</option>
                                                                <?php foreach ($datarekening as $u): ?>                                                                        
                                                                        <option value="<?= $u->kode ?>"><?= $u->nama ?></option>
                                                                    <?php endforeach ?>
                                                            </select>   
                                                        </div>                                                        
                                                    </div>
                                                </div> -->


                                                <div class="col-lg-4">
                                                    <div class="mt-2">
                                                        <div class="mb-4"><br>

                                                        <button class="btn btn-info btn-mini" class="easyui-linkbutton" name="view" id="viewData">Tampilkan</button>
                                                        <button class="btn btn-info btn-mini" name="cetak" id="cetak" class="easyui-linkbutton" data-options="iconCls:'icon-print'">Cetak</button>

                                                            <!-- <button type="button" class="btn btn-info btn-mini"name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Pencarian</button>
                                                            <button type="button" class="btn btn-info btn-mini" name="cetak" id="cetak" class="easyui-linkbutton" data-options="iconCls:'icon-print'">Cetak</button> -->


                                                            <!-- <button type="submit" class="btn btn-info btn-mini">Cetak PDF</button> -->
                                                            <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button>  
                                                        </div>
                                                        
                                                    </div>                                                    
                                                </div>



                                          
                                            

                                                
                                            </div>

                                        
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div id="tampildata" class="tampildata"></div>


                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

    <script>
        document.getElementById("viewData").onclick = function() {
            let fromDate = document.getElementById('fromDate').value
            let toDate = document.getElementById('toDate').value
            if (fromDate === '' || toDate === '') {
                alert('Nilai masukan tidak boleh kosong! Periksa kembali inputan anda')
            } else if (fromDate > toDate) {
                alert("Tanggal awal tidak boleh lebih besar dari tanggal akhir.");
            } else {
                getData(fromDate, toDate)
            }
        };

        function getData(fromDate, toDate) {
            let url = "<?= site_url('laporan_account_ledger/bukubesar_view') ?>"
            document.getElementById('tampildata').value = ""
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    'fromDate': fromDate,
                    'toDate': toDate
                },
                cache: false,
                success: function(data) {
                    dt = document.getElementById('tampildata');

                    let insertedContent = document.querySelector(".insertedContent");
                    if (insertedContent) {
                        insertedContent.parentNode.removeChild(insertedContent);
                    }
                    dt.insertAdjacentHTML('afterbegin', "<span class ='insertedContent'>" + data + "</span>");
                }
            })
        }

        document.getElementById("cetak").onclick = function() {
            let fromDate = document.getElementById('fromDate').value
            let toDate = document.getElementById('toDate').value
            if (fromDate === '' || toDate === '') {
                alert('Nilai masukan tidak boleh kosong! Periksa kembali inputan anda')
            } else if (fromDate > toDate) {
                alert("Tanggal awal tidak boleh lebih besar dari tanggal akhir.");
            } else {
                const href = '<?= site_url('laporan_account_ledger/bukubesar_pdf/') ?>' + fromDate + '/' + toDate
                event.preventDefault();
                const {
                    target = '_blank'
                } = event.currentTarget;
                const features = "resizable";
                window.open(href, target, features);
            }
        };
    </script>