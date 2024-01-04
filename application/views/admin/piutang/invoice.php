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
                                        <li class="breadcrumb-item active" aria-current="page">Detail Piutang</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">                                                                

                                            <!-- <a class="btn btn-primary" href="<?php echo base_url()?>tagihan_customer/tambah" role="button">Tambah Tagihan Customer</a> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row" style="background-color:#dee2e6">
                                            <h3>Create Invoice</h3>
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
                                                            <input type="text" value="<?php echo $mastercustomer_id ?>" name="mastercustomer_id" id="mastercustomer_id" hidden>
                                                        </div>
                                                        
                                                    </div>                                                    
                                                </div>
                                                <!-- <div class="col col-6 col-lg-2">
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
                                                </div> -->
                                               

                                                <div class="col col-11 col-lg-4">
                                                    <div class="mt-2">
                                                        <br>
                                                        <div class="row">
                                                                <div class="col col-3 col-lg-2 me-4">
                                                                    <button class="btn btn-info btn-mini" class="easyui-linkbutton" name="view" id="viewData">Preview</button>
                                                                </div>

                                                                <!-- <div class="col col-3 col-lg-2 me-4"  id="div-cetak" style="display:none">
                                                                    <button class="btn btn-info btn-mini" name="cetak" id="cetak" data-bs-toggle="modal" data-bs-target="#myModals">Invoice</button>
                                                                </div>

                                                                <div class="col col-3 col-lg-3 me-2"  id="div-cetak-stat" style="display:none" >
                                                                    <form action="<?php echo base_url('piutang/rekapStat');?>" method="POST" enctype="multipart/form-data"> 
                                                                    <input type="text" id="cetak1-stat" name="mastercustomer_id" value="" hidden >
                                                                    <input type="text" id="cetak2-stat" name="statushutang" value="" hidden >
                                                                    <input type="text" id="cetak3-stat" name="fromdate" value="" hidden >
                                                                    <input type="text" id="cetak4-stat" name="todate" value="" hidden >
                                                                    <button class="btn btn-info btn-mini">Statement</button>
                                                                    </form>
                                                                </div>

                                                                <div class="col col-3 col-lg-5 mt-2"  id="div-cetak-ba" style="display:none" >
                                                                    <form action="<?php echo base_url('piutang/rekapBa');?>" method="POST" enctype="multipart/form-data"> 
                                                                    <input type="text" id="cetak1-ba" name="mastercustomer_id" value="" hidden  >
                                                                    <input type="text" id="cetak2-ba" name="statushutang" value="" hidden  >
                                                                    <input type="text" id="cetak3-ba" name="fromdate" value="" hidden  >
                                                                    <input type="text" id="cetak4-ba" name="todate" value="" hidden  >
                                                                    <button class="btn btn-info btn-mini">Berita Acara</button>
                                                                    </form>
                                                                </div> -->

                                                                <div class="col col-3 col-lg-2" id="div-kembali">
                                                                    <button onclick="reset()" type="button" id="reset" value="Go Back" class="btn btn-warning btn-mini">Kembali</button>  
                                                                </div>
                                                                
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </div>

                                            

                                        <div class="card-body" id="tampildata1">
                                            <h3>Data Tagihan</h3>
                                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Total Volume Gas</th>
                                                    <th>Pressure Out (P)</th>
                                                    <th>V (sm<sup>3</sup>)</th>
                                                    <!-- <th>Jumlah Tagihan</th> -->
                                                    <!-- <th>Status</th> -->

                                                    <!-- <th style="text-align:center">Tindakan</th>                                             -->
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
                                                        <!-- <td><?php echo $u['mastercustomer_id'] ?></td>  -->
                                                        <!-- <td><?php echo $u['tagihan_customer_id'] ?></td>  -->
                                                        <td><?php echo $u['tanggal'] ?></td>
                                                        <td><?php echo $u['volumegas']?></td>
                                                        <td><?php echo $u['preasure']?></td>
                                                        <td><?php echo $u['harga']?></td>
                                                        <!-- <td><?php echo $u['total_tagihan'] ?></td> -->
                                                        <!-- <td><?php echo $u['statushutang'] ?></td> -->
                                                        <!-- <td style="text-align:center">
                                                                <?php
                                                                if($u["statushutang"] == "belum bayar"){
                                                                    ?>
                                                                        <a onclick="return confirm('Anda Yakin Akan Memverifikasi Pembayaran Hutang ?')" href="<?= base_url('piutang/validasi_y/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" style="width:35px;"><i class="fa fa-check"></i></a>                                                                                                         
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <?php
                                                                }
                                                                ?>   
                                                                <a href="<?= base_url('tagihan_customer/ubah/' . $u['tagihan_customer_id']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Ubah Pressure Out</a>                                    
                                                                <a href="<?= base_url('piutang/cetakinvoice/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" >Statement</a>                                                     
                                                                <a href="<?= base_url('piutang/cetakba/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" >Berita Acara</a> 
                                                                <a href="<?= base_url('piutang/isiinvoice_satuan/' . $u['tagihan_customer_id']) ?>" class="btn btn-success btn-sm" target="_blank">Invoice</a>
                                                                                                            
                                                        </td> -->

                                        
                                                        </td>
                                                    </tr>                                        
                                                    <?php }}?>
                                                </tbody> 
                                            </table>
                                        </div>

                                        <h3 id="judul" style="display:none">Create Invoice</h3>   
                                        <div class="card-body" id="tampildata">
                                                    
                                        </div>

                                    
                                     

                                    </div>
                                </div> 
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->



               








<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
 





<script type="text/javascript">
// fungsi untuk hapus data
          //pilih selector dari table id datarekening dengan class .hapusrekening
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

<script>
        document.getElementById("viewData").onclick = function() {
            let fromDate = document.getElementById('fromDate').value
            let toDate = document.getElementById('toDate').value
            let mastercustomer_id = document.getElementById('mastercustomer_id').value

            if (fromDate === '' || toDate === '') {
                alert('Nilai masukan tidak boleh kosong! Periksa kembali inputan anda')
            } else if (fromDate > toDate) {
                alert("Tanggal awal tidak boleh lebih besar dari tanggal akhir.");
            } else {
                getData(fromDate, toDate, mastercustomer_id)
            }
        };

    function hitung()
    {
       let p = $('#p').val();
       let fromdate = $('#f-4').val();
       let todate = $('#f-5').val();
       let mastercustomer_id = $('#f-1').val();
       let url = "<?= site_url('piutang/ubahPressure') ?>";
       $.ajax({
                type: 'POST',
                url: url,
                data: {
                    'p' : p,
                    'fromdate' : fromdate,
                    'todate' : todate,
                    'mastercustomer_id' : mastercustomer_id,
                },
                cache: false,
                success: function(data) {
                    var totalTagihanFormatted = formatRupiah(data.total_tagihan);
                    $("#total_tagihan").val(totalTagihanFormatted);
                    $("#total_formatted").val(data.total_formatted);
                    $("#v0").val(p);
                    $("#f-2").val(data.total_formatted);
                    $("#f-3").val(totalTagihanFormatted);
                    $("#f-6").val(data.vt);
                    $("#f-7").val(data.ap);
                    $("#f-8").val(data.k);
                    $("#f-9").val(data.t);
                    $("#f-10").val(data.v1);
                    $("#f-11").val(data.v2);
                    $("#f-12").val(data.harga_jual);
                }
            })
       
    }
    function formatRupiah(angka) {
    var number_string = angka.toString();
    var split = number_string.split(',');
    var sisa = split[0].length % 3;
    var rupiah = split[0].substr(0, sisa);
    var ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp ' + rupiah;
    }   

        function getData(fromDate, toDate, mastercustomer_id, statushutang) {
            let url = "<?= site_url('piutang/selectInvoice') ?>"
            // document.getElementById('div-cetak').style.display = "block";
            // document.getElementById('div-cetak-stat').style.display = "block";
            // document.getElementById('div-cetak-ba').style.display = "block";
            // document.getElementById('div-kembali').classList.add('mt-2');
            document.getElementById('judul').style.display = "block";
            document.getElementById('tampildata1').style.display = "none";
            document.getElementById('tampildata').style.display = "block";
            document.getElementById('tampildata').value = ""
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    'fromdate': fromDate,
                    'todate': toDate,
                    'mastercustomer_id' : mastercustomer_id,
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
                    $('#riwayat-invoice').DataTable();
                
                }
            })
        }

        function reset()
        {
            document.getElementById('tampildata1').style.display = "block";
            document.getElementById('tampildata').style.display = "none";
            // document.getElementById('div-cetak').style.display = "none";
            // document.getElementById('div-cetak-stat').style.display = "none";
            // document.getElementById('div-cetak-ba').style.display = "none";
            document.getElementById('div-kembali').classList.remove('mt-2');
            document.getElementById('judul').style.display = "none";

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

    function validasi(id)
    {
        let fromDate = document.getElementById('fromDate').value
        let toDate = document.getElementById('toDate').value
        let mastercustomer_id = document.getElementById('mastercustomer_id').value

        swal({
                title: 'Konfirmasi',
                text: "Anda Ingin Konfirmasi Invoice? ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Konfirmasi',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                    url:"<?=base_url('invoice/validasi_y')?>",  
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
                    data:{id:id},
                    success:function(data){
                      swal(
                        'Konfirmasi',
                        'Berhasil Konfirmasi',
                        'success'
                      )
                      getData(fromDate, toDate, mastercustomer_id)
                   
                    //   location.reload(true);
                      //datatable.ajax.reload(null, false)
                    }
                  })
              } else if (result.dismiss === swal.DismissReason.cancel) {
                  swal(
                    'Batal',
                    'Anda membatalkan Konfirmasi',
                    'error'
                  )
                }
              })
    }


    function deleteInvoice(id)
    {
        let fromDate = document.getElementById('fromDate').value
        let toDate = document.getElementById('toDate').value
        let mastercustomer_id = document.getElementById('mastercustomer_id').value

        swal({
                title: 'Hapus',
                text: "Anda Ingin Menghapus Invoice? ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Konfirmasi',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                    url:"<?=base_url('invoice/hapusInvoice')?>",  
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
                    data:{id:id},
                    success:function(data){
                      swal(
                        'Dihapus',
                        'Berhasil Dihapus',
                        'success'
                      )
                      getData(fromDate, toDate, mastercustomer_id)
                   
                    //   location.reload(true);
                      //datatable.ajax.reload(null, false)
                    }
                  })
              } else if (result.dismiss === swal.DismissReason.cancel) {
                  swal(
                    'Batal',
                    'Anda Membatalkan Hapus Invoice',
                    'error'
                  )
                }
              })
    }
</script>




