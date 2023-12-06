

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <!-- <li class="menu-title">Main</li> -->

                            <li>
                                <a href="<?php echo base_url()?>dashboard" class="waves-effect">
                                    <i class="ti-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>       
                            
                            

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-receipt"></i>
                                    <span>Master Data</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?php echo base_url()?>profil_perusahaan">Master Data Perusahaan</a></li>     
                                    <li><a href="<?php echo base_url()?>master_coa">Master COA</a></li>                                
                                    <li><a href="<?php echo base_url()?>master_supplier">Master Supplier</a></li>                                
                                    <li><a href="<?php echo base_url()?>master_customer">Master Customer</a></li>                                
                                    <!-- <li><a href="<?php echo base_url()?>master_rekening">Master Rekening GEA</a></li>                                 -->
                                </ul>
                            </li>


                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-receipt"></i>
                                    <span>Transaksi</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <!--
                                    <li><a href="<?php echo base_url()?>jurnal_masuk">Input Jurnal Harian Pemasukan</a></li>
                                    <li><a href="<?php echo base_url()?>jurnal_keluar">Input Jurnal Pengeluaran</a></li>
                                    -->
                                    <li><a href="<?php echo base_url()?>jurnal_masuk">Input Transaksi Harian</a></li>                                      
                                    <li><a href="<?php echo base_url()?>jurnal_balik">Input Jurnal Balik</a></li> 
                                    <li><a href="<?php echo base_url()?>selisih_kurs">Input Selisih Kurs</a></li> 
                                    <li><a href="<?php echo base_url()?>penyusutan">Input Penyusutan</a></li> 
                                    <li><a href="<?php echo base_url()?>daftar_aktiva">Input Daftar Aktiva</a></li>                                    
                                </ul>
                            </li>

                            <!--<li>-->
                            <!--    <a href="javascript: void(0);" class="has-arrow waves-effect">-->
                            <!--        <i class="ti-receipt"></i>-->
                            <!--        <span>Proses Posting</span>-->
                            <!--    </a>-->
                            <!--    <ul class="sub-menu" aria-expanded="false">-->
                            <!--        <li><a href="<?php echo base_url()?>posting_bulanan">Posting Bulanan</a></li>-->
                            <!--        <li><a href="#">Posting Tahunan</a></li>                                    -->
                            <!--    </ul>-->
                            <!--</li>-->


                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-receipt"></i>
                                    <span>Laporan</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?php echo base_url()?>laporan_entry">Laporan Entry</a></li>    
                                    <li><a href="<?php echo base_url()?>laporan_account_ledger">Laporan Account Ledger</a></li>  
                                    <li><a href="<?php echo base_url()?>laporan_trial_balance">Laporan Trial Balance</a></li>
                                    <li><a href="<?php echo base_url()?>laporan_profit_lost">Laporan Profit & Lost</a></li>
                                    <li><a href="<?php echo base_url()?>laporan_balance_sheet">Laporan Balance Sheet</a></li>  
                                    <li><a href="<?php echo base_url()?>hutang">Hutang</a></li>  
                                    <li><a href="<?php echo base_url()?>piutang">Piutang</a></li>  
                                    
                                    <!-- <li><a href="<?= site_url('laporan/bukubesar')?>">Buku Besar</a></li>
                                    <li><a href="<?= site_url('laporan/neracasaldo')?>">Neraca Saldo</a></li>
                                    <li><a href="<?= site_url('laporan/neraca')?>">Neraca</a></li>
                                    <li><a href="<?= site_url('laporan/labarugi')?>">Laba Rugi</a></li> -->


                                </ul>
                            </li>


                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ti-receipt"></i>
                                    <span>Utility</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <!--<li><a href="<?php echo base_url()?>/backup_restore">Backup & Restore</a></li> -->
                                    <!--<li><a href="#">Unposting</a></li>-->
                                    <li><a href="<?php echo base_url()?>saldo_awal">Input Saldo Awal</a></li>
                                    <!--<li><a href="#">Setting Date</a></li>                              -->
                                </ul>
                            </li>


                           
                            <li>
                                <a href="<?php echo base_url()?>/Acountmanajer" class="waves-effect">
                                    <i class="ti-receipt"></i>
                                    <span>User Management</span>
                                </a>
                            </li>


                            <li>
                                <a href="<?php echo base_url()?>/login/logout" class="waves-effect">
                                    <i class="ti-new-window"></i>
                                    <span>Keluar</span>
                                </a>
                            </li>

                           

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->