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
                                        <li class="breadcrumb-item"><a href="#">Piutang</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Form Invoice</h4>
                                        <form action="<?php echo base_url('Piutang/pdfinvoice/'.$id);?>" method="POST" enctype="multipart/form-data"> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>

                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">No Invoice</label>
                                                            <input id="input-mask" name="no_invoice" class="form-control input-mask">                                                            
                                                        </div>


                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Tanggal</label>
                                                            <input id="input-mask" name="tanggal" class="form-control input-mask" type="date">                                                            
                                                        </div>
                                                        
                                                        <div class="mb-4">
                                                            <label class="form-label" for="input-mask">Due Date</label>
                                                            <input id="input-mask" name="dd" class="form-control input-mask" type="date">                                                            
                                                        </div>   
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="col-md-2">
                                                <div class="float-end d-none d-md-block">
                                                    <div class="dropdown">                                                         
                                                        <button type="submit" class="btn btn-primary btn-mini">Cetak Invoice</button>
                                                    </div>
                                                </div>
                                            </div>
                                            


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                               
      
