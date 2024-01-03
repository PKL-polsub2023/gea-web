<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.css">

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
                                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Detail Piutang</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">                                                                


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                   
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <!-- <div class="col col-md-3 col-3 ms-4 mt-2">
                                    <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#myModal">Select Invoice
                                    </button>

                                    </div> -->

                                    <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="card-title mb-4">Form Laporan Account Ledger</h4> -->
                                       
                                            <!-- <div class="row">
                                                <div class="col col-6 col-lg-2">
                                                    <div>
                                                        <div class="mb-2">
                                                            <label class="form-label" for="input-date1">Dari Tanggal</label>
                                                            <input class="form-control" type="date" name="fromDate" id="fromDate">
                                                          
                                                        </div>                                                    
                                                    </div>
                                                </div>                                             
                                                

                                                <div class="col col-6 col-lg-2">
                                                    <div class=" mt-lg-0">
                                                        <div class="mb-2">
                                                            <label class="form-label" for="input-email">Sampai Tanggal</label>
                                                            <input class="form-control" type="date" name="toDate" id="toDate">  
                                                        </div>
                                                        
                                                    </div>                                                    
                                                </div>


                                                <div class=" col col-6 col-lg-2">
                                                    <div class="mt-2 mt-lg-0">
                                                        <div class="mb-2">
                                                            <label class="form-label" for="input-email">Customer</label>
                                                            <select onchange="button()" class="form-control" name="mastercustomer_id" id="mastercustomer_id">
                                                            <option value="">Pilih Customer</option>
                                                            <?php foreach ($customer as $u): ?>
                                                                    <option value="<?= $u['mastercustomer_id'] ?>"><?= $u['namaperusahaan'] ?> - <?= $u['namapic'] ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>                                                    
                                                </div>

                                                <div class="col col-6 col-lg-2">
                                                    <div class="mt-2 mt-lg-0">
                                                        <div class="mb-2">
                                                            <label class="form-label" for="input-email">Status</label>
                                                            <select onchange="button()" class="form-control" name="statushutang" id="statushutang">
                                                                <option value="">Pilih Status Piutang</option>
                                                                <option value="All">Semua Status</option>
                                                                <option value="N">Belum Bayar</option>
                                                                <option value="Y">Sudah Bayar</option>
                                                                </select>
                                                        </div>
                                                        
                                                    </div>                                                    
                                                </div>
                                               

                                                <div class="col col-6 col-lg-4">
                                                    <div class="mt-2">
                                                        <br>
                                                        <div class="row">
                                                                <div class="col-lg-3 me-2">
                                                                    <button class="btn btn-info btn-mini" class="easyui-linkbutton" name="view" id="viewData">Tampilkan</button>
                                                                </div>

                                                                <div class="col-lg-2 me-2" style="display:none" id="div-cetak">
                                                                    <button class="btn btn-info btn-mini" name="cetak" id="cetak" data-bs-toggle="modal" data-bs-target="#myModals">Cetak</button>
                                                                </div>

                                                                <div class="col-lg-3 me-2"  id="div-cetak-stat" style="display:none">
                                                                    <form action="<?php echo base_url('piutang/rekapStat');?>" method="POST" enctype="multipart/form-data"> 
                                                                    <input type="text" id="cetak1-stat" name="mastercustomer_id" value="" hidden >
                                                                    <input type="text" id="cetak2-stat" name="statushutang" value="" hidden >
                                                                    <input type="text" id="cetak3-stat" name="fromdate" value="" hidden >
                                                                    <input type="text" id="cetak4-stat" name="todate" value="" hidden >
                                                                    <button class="btn btn-info btn-mini">Statement</button>
                                                                    </form>
                                                                </div>

                                                                <div class="col-lg-3 me-2 mt-2"  id="div-cetak-ba" style="display:none">
                                                                    <form action="<?php echo base_url('piutang/rekapBa');?>" method="POST" enctype="multipart/form-data"> 
                                                                    <input type="text" id="cetak1-ba" name="mastercustomer_id" value="" hidden  >
                                                                    <input type="text" id="cetak2-ba" name="statushutang" value="" hidden  >
                                                                    <input type="text" id="cetak3-ba" name="fromdate" value="" hidden  >
                                                                    <input type="text" id="cetak4-ba" name="todate" value="" hidden  >
                                                                    <button class="btn btn-info btn-mini">Berita Acara</button>
                                                                    </form>
                                                                </div>

                                                                <div class="col-lg-2" id="div-kembali">
                                                                    <button onclick="reset()" type="button" id="reset" value="Go Back" class="btn btn-warning btn-mini">Kembali</button>  
                                                                </div>
                                                                
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </div> -->
                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                                    <!-- <div class="card-body" id="tampildata">

                                    </div> -->

                                    <div class="card-body" id="tampildata1">
                                   
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Customer</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Alamat</th>
                                                <th>Nama PIC</th>
                                                <th>No Telp</th>
                                                <th>Radius GEA to Lokasi</th>
                                                <th style="text-align:center">Tindakan</th>                                            
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <?php                                                 
                                                $no = 0;
                                                    if($datamaster){
                                                        foreach($datamaster as $u){  
                                                ?>                                                            
                                                <tr>
                                                    <td width="5%" style="text-align:center"><?php echo ++$no ?></td>     
                                                    <td width="5%"><?php echo $u['mastercustomer_id'] ?></td>                                               
                                                    <td><?php echo $u['namaperusahaan'] ?></td> 
                                                    <td><?php echo $u['alamat'] ?></td>
                                                    <td><?php echo $u['namapic'] ?></td>
                                                    <td><?php echo $u['notelp'] ?></td>
                                                    <td><?php echo $u['radius'] ?></td>
                                                    <td style="text-align:center;">
                                                        <!-- <a href="<?= base_url('piutang/paid/' . $u['mastercustomer_id']) ?>" class="btn btn-success btn-sm">Paid</a>                                                     
                                                        <a href="<?= base_url('piutang/pending/' . $u['mastercustomer_id']) ?>" class="btn btn-warning btn-sm">Pending</a>                                                     
                                                        <a href="<?= base_url('piutang/unpayed/' . $u['mastercustomer_id']) ?>" class="btn btn-danger btn-sm">Unpayed</a>                                                      -->
                                                        <!-- <a href="<?= base_url('piutang/invoice/' . $u['mastercustomer_id']) ?>" class="btn btn-info btn-sm">Invoice</a>   
                                                        <a href="<?= base_url('piutang/isiinvoice/' . $u['mastercustomer_id']) ?>" class="btn btn-success btn-sm" target="_blank">PDF Invoice</a>                                                      -->
                                                        <?php if ($u['jumlah_tagihan'] > 0) { ?>
                                                            <a href="<?= base_url('piutang/invoice/' . $u['mastercustomer_id']) ?>" class="btn btn-info btn-sm">Invoice</a>   
                                                            <!-- <a href="<?= base_url('piutang/isiinvoice/' . $u['mastercustomer_id']) ?>" class="btn btn-success btn-sm" target="_blank">Invoice</a>                                                      -->
                                                        <?php } else { ?>
                                                            <span>Tidak ada tagihan</span>
                                                        <?php } ?>
                                                    </td>

                                    
                                                    </td>
                                                </tr>                                        
                                                <?php }}?>
                                            </tbody> 
                                        </table>
                                    </div>
                                </div> 
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

    <!-- sample modal content -->
    <!-- <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="myModalLabel">Select Invoice
                               </h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                   aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                            <form action="<?php echo base_url('piutang/selectInvoice');?>" method="POST" enctype="multipart/form-data" target="_blank"> 
                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Customer</label>
                                   <div class="col-sm-8">
                                    <select class="form-control" name="mastercustomer_id" id="mastercustomer_id">
                                    <option value="">Pilih Customer</option>
                                    <?php foreach ($customer as $u): ?>
                                               <option value="<?= $u['mastercustomer_id'] ?>"><?= $u['namaperusahaan'] ?> - <?= $u['namapic'] ?></option>
                                           <?php endforeach ?>
                                    </select>
                                     
                                   </div>
                               </div>



                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Rentang Tanggal</label>
                                   <div class="col-sm-8">
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <input  type="date" id="fromdate" name="fromdate" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="date" id="todate" name="todate" class="form-control">
                                            </div>
                                    </div>
                                                                                
                                   </div>
                               </div>

                               <div class="row mb-3">
                                   <label for="example-text-input" class="col-sm-4 col-form-label">Status Piutang</label>
                                   <div class="col-sm-8">
                                    <select class="form-control" name="statushutang" id="statushutang">
                                    <option value="">Pilih Status Piutang</option>
                                    <option value="All">Semua Status</option>
                                    <option value="N">Belum Bayar</option>
                                    <option value="Y">Sudah Bayar</option>
                                    </select>
                                   </div>
                               </div>


                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary waves-effect"
                                   data-bs-dismiss="modal">Close</button>
                               <button type="submit" id="cari"
                                   class="btn btn-primary waves-effect waves-light" disabled>Cari</button>
                           </div>
                       </div>
                   
                   </div>       
    </div> -->
               <!-- /.modal -->


                              <!-- sample modal content -->
    <div id="myModals" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="myModalLabel">Print Select Invoice
                               </h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                   aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                            <form action="<?php echo base_url('piutang/printSelectInvoice');?>" method="POST" enctype="multipart/form-data" target="_blank"> 
                                        <input type="text" id="cetak1" name="mastercustomer_id" value="" hidden >
                                        <input type="text" id="cetak2" name="statushutang" value="" hidden >
                                        <input type="text" id="cetak3" name="fromdate" value="" hidden >
                                        <input type="text" id="cetak4" name="todate" value="" hidden >
                                        

                               <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="input-mask">No Invoice</label>
                                    <div class="col-sm-8">
                                    <input onkeyup="cek()" id="no_invoice" name="no_invoice" class="form-control input-mask">    
                                    </div>
                                                                                                          
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="input-mask">Tanggal</label>
                                    <div class="col-sm-8">
                                    <input onchange="cek()" id="tanggal" name="tanggal" class="form-control input-mask" type="date" readonly>     
                                    </div>
                                                                                           
                                </div>
                                                        
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="input-mask">Due Date</label>
                                    <div class="col-sm-8">
                                    <input onchange="cek()" id="dd" name="dd" class="form-control input-mask" type="date" readonly> 
                                    </div>                                                 
                                </div>   
            

                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary waves-effect"
                                   data-bs-dismiss="modal">Close</button>
                               <button type="submit" id="cari"
                                   class="btn btn-primary waves-effect waves-light" disabled>Print</button>
                           </div>
                        </form>
                       </div>
                       <!-- /.modal-content -->
                   </div>
                   <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>





<script type="text/javascript">
// fungsi untuk hapus data
          //pilih selector dari table id datacustomer dengan class .hapuscustomer
          $('#datatable').on('click','.hapuscustomer', function () {
            var mastercoa_id  =   <?php echo $u['mastercoa_id'];?>;
            swal({
                title: 'Konfirmasi',
                text: "Anda ingin menghapus ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                    url:"<?=base_url('customer/hapus')?>",  
                    method:"post",
                    beforeSend :function () {
                    swal({
                        title: 'Menunggu',
                        html: 'Memproses data',
                        onOpen: () => {
                          swal.showLoading()
                        }
                      })      
                    },    
                    data:{mastercoa_id:mastercoa_id},
                    success:function(data){
                      swal(
                        'Hapus',
                        'Berhasil Terhapus',
                        'success'
                      )
                      location.reload(true);
                      //datatable.ajax.reload(null, false)
                    }
                  })
              } else if (result.dismiss === swal.DismissReason.cancel) {
                  swal(
                    'Batal',
                    'Anda membatalkan penghapusan',
                    'error'
                  )
                }
              })
            });


</script>


<!-- <script>
        document.getElementById("viewData").onclick = function() {
            let fromDate = document.getElementById('fromDate').value
            let toDate = document.getElementById('toDate').value
            let mastercustomer_id = document.getElementById('mastercustomer_id').value
            let statushutang = document.getElementById('statushutang').value

            if (fromDate === '' || toDate === '' || mastercustomer_id === '' || statushutang === '') {
                alert('Nilai masukan tidak boleh kosong! Periksa kembali inputan anda')
            } else if (fromDate > toDate) {
                alert("Tanggal awal tidak boleh lebih besar dari tanggal akhir.");
            } else {
                getData(fromDate, toDate, mastercustomer_id, statushutang)
            }
        };

        function getData(fromDate, toDate, mastercustomer_id, statushutang) {
            let url = "<?= site_url('piutang/selectInvoice') ?>"
            document.getElementById('div-cetak').style.display = "block";
            document.getElementById('div-cetak-stat').style.display = "block";
            document.getElementById('div-cetak-ba').style.display = "block";
            document.getElementById('div-kembali').classList.add('mt-2');
            document.getElementById('tampildata').value = ""
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    'fromdate': fromDate,
                    'todate': toDate,
                    'mastercustomer_id' : mastercustomer_id,
                    'statushutang' : statushutang,
                },
                cache: false,
                success: function(data) {
                    dt = document.getElementById('tampildata');

                    let insertedContent = document.querySelector(".insertedContent");
                    if (insertedContent) {
                        insertedContent.parentNode.removeChild(insertedContent);
                    }
                    dt.insertAdjacentHTML('afterbegin', "<span class ='insertedContent'>" + data + "</span>");
                       // Inisialisasi Datatables pada tabel yang baru dimasukkan
                    $('#filter').DataTable();
                    document.getElementById('tampildata1').style.display = "none";
                    document.getElementById('tampildata').style.display = "block";
                    $('#cetak1').val(mastercustomer_id);
                    $('#cetak2').val(statushutang);
                    $('#cetak3').val(fromDate);
                    $('#cetak4').val(toDate);
                    $('#tanggal').val(fromDate);
                    $('#dd').val(toDate);

                    $('#cetak1-ba').val(mastercustomer_id);
                    $('#cetak2-ba').val(statushutang);
                    $('#cetak3-ba').val(fromDate);
                    $('#cetak4-ba').val(toDate);

                    
                    $('#cetak1-stat').val(mastercustomer_id);
                    $('#cetak2-stat').val(statushutang);
                    $('#cetak3-stat').val(fromDate);
                    $('#cetak4-stat').val(toDate);
                }
            })
        }

        function reset()
        {
            document.getElementById('tampildata').style.display = "none";
            document.getElementById('tampildata1').style.display = "block";
            document.getElementById('div-cetak').style.display = "none";
            document.getElementById('div-cetak-stat').style.display = "none";
            document.getElementById('div-cetak-ba').style.display = "none";
            document.getElementById('div-kembali').classList.remove('mt-2');

        }

        function cek()
    {
        var no_invoice = $('#no_invoice').val();
        var dd = $('#dd').val();
        var tanggal = $('#tanggal').val();

        if(no_invoice != "" && dd != "" && tanggal != "")
        {
            document.getElementById("cari").disabled = false;
        }else{
            document.getElementById("cari").disabled = true;
            
        }
    }
</script> -->



