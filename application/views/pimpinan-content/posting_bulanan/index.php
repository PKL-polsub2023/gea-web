<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

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
                                        <li class="breadcrumb-item"><a href="#">Posting Bulanan</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data Posting Bulanan</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
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
                                        <h4 class="card-title mb-4">Form Posting Bulanan</h4>

                                        <form action="<?php echo base_url('posting_bulanan/simpanposting');?>" id="postingbulanan" method="POST" enctype="multipart/form-data"> 
                                            


                                            <div class="row">

                                                <div class="col-lg-4">
                                                    <div class="mt-4 mt-lg-0">                                                        
                                                        <div class="mb-4">                                                         
                                                            <label class="form-label" for="input-date1">Dari Tanggal</label>
                                                            <input class="form-control" type="date" id="tgl_awal" name="tgl_awal[]">
                                                        </div>                                                        
                                                    </div>
                                                </div>



                                                <div class="col-lg-4">
                                                    <div>
                                                        <div class="mb-4">       
                                                            <label class="form-label" for="input-email">Sampai Tanggal</label>
                                                            <input class="form-control" type="date" id="tgl_akhir" name="tgl_akhir[]"> 
                                                        </div>                                                    
                                                    </div>
                                                </div>                                             
                                                



                                               



                                                <div class="col-lg-4">
                                                    <div class="mt-4 mt-lg-0">
                                                        <div class="mb-4">
                                                             <center>
                                                            <label class="form-label" for="input-email">&nbsp;</label><br>

                                                            <?php if ($cekjurnalposting->status_postingan_jurnal == ""){ ?>
                                                       
                                                               
                                                                <button id="save" type="submit" class="btn btn-info btn-mini">Proses Posting Bulanan</button>
                                                                <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button>


                                                            <?php } else if ($cekjurnalposting->status_postingan_jurnal == "0"){ ?>

                                                                
                                                                <button id="save" type="submit" class="btn btn-info btn-mini">Proses Posting Bulanan</button>
                                                                <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button>

                                                            <?php } else { ?>
                                                                
                                                                <button id="sudahdikunci" disabled class="btn btn-danger btn-mini">Data Jurnal Sudah Di Kunci !!!</button>                                                            
                                                                <button type="button" value="Go Back" onclick="history.back(-1)" class="btn btn-warning btn-mini">Kembali</button>

                                                            <?php } ?>                                                           





                                                            </center>
                                                        </div>
                                                        
                                                    </div>                                                    
                                                </div>

                                                <?php      
                                                    if($datajurnalmasuk){
                                                        foreach($datajurnalmasuk as $u){  
                                                ?> 
                                                  


                                                <span id="success_message"></span>
                                                <div class="form-group" id="process" style="display:none;">
                                                    <div class="progress" style="height: 24px;">
                                                        <input type="hidden" name="no_jurnal[]" value="<?php echo $u['no_jurnal']?>">
                                                        <input type="hidden" name="jurnalmasuk_id[]" value="<?php echo $u['jurnalmasuk_id']?>">
                                                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>

                                                <?php }}?>
                                            

                                                
                                            </div>


                                       

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->




<script>
 
 $(document).ready(function(){

    //$('#sudahdikunci').hide();
  
  $('#postingbulanan').on('submit', function(event){
   event.preventDefault();
   var count_error = 0;

//    if($('#first_name').val() == '')
//    {
//     $('#first_name_error').text('First Name is required');
//     count_error++;
//    }
//    else
//    {
//     $('#first_name_error').text('');
//    }

//    if($('#last_name').val() == '')
//    {
//     $('#last_name_error').text('Last Name is required');
//     count_error++;
//    }
//    else
//    {
//     $('#last_name_error').text('');
//    }

   if(count_error == 0)
   {
    $.ajax({
     url:"posting_bulanan/simpanposting",
     method:"POST",
     data:$(this).serialize(),
     beforeSend:function()
     {
      $('#save').attr('disabled', 'disabled');
      $('#process').css('display', 'block');
     },
     success:function(data)
     {
      var percentage = 0;

      var timer = setInterval(function(){
       percentage = percentage + 20;
       progress_bar_process(percentage, timer);
      }, 1000);
     }
    })
   }
   else
   {
    return false;
   }
  });

  function progress_bar_process(percentage, timer)
  {
   $('.progress-bar').css('width', percentage + '%');
   if(percentage > 100)
   {
    clearInterval(timer);
    $('#postingbulanan')[0].reset();
    $('#process').css('display', 'none');
    $('.progress-bar').css('width', '0%');
    $('#save').attr('disabled', false);
    $('#success_message').html("<div class='alert alert-success'>Selamat Data Jurnal Berhasil Diposting !!!</div>");
    setTimeout(function(){
     $('#success_message').html('');
     $('#save').hide();
     window.location.reload();
     $('#sudahdikunci').show();
    }, 1500);
   }
  }

 });
</script>



