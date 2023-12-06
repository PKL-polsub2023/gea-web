<h3 style="text-align: center;">Laporan Neraca Periode: <?= $periode ?></h3>
<h4 style="text-align: center;"><?= $subjudul ?></h4>
<style>
    .text-left {
        float: left
    }

    .text-right {
        float: right
    }

    .center {
        margin-left: auto;
        margin-right: auto;
    }

    table,
    th,
    td {
        border: 1px solid;
        border-collapse: collapse;
        padding: 5px 10px 5px 10px;
        vertical-align: top;
    }

    table {
        width: 100%;
    }

    td {
        text-align: left;
    }

    .text-bold {
        font-weight: bold;
    }

    dd {
        clear: both;
    }

    dt+dd {
        clear: none;
    }
</style>

<table class="center">
    <tr>
        <th>Aktiva</th>
        <th>Pasiva</th>
    </tr>
    <tr>
        <!-- untuk kolom aktiva-->
        <td>
            <?php
            $saldoTerakhir = array();
            $jumlahDebit = 0;
            $jumlahKredit = 0;
            $lastStatus = '';

            $saldo_aktiva_tetap = 0;
            $saldo_aktiva_lancar = 0;
            foreach ($dtMasterCoa as $key => $coa) {
                /* id_kelompokakun 
                * 1 - Aset/Aktiva
                * 2 - Kewajiban/Passiva
                * 3 - Modal
                * 4 - Pendapatan
                * 5 - Beban
                */
                if ($coa['id_kelompokakun'] == 1) {
                    $saldo = 0;
                    foreach ($saldoAwal as $key => $s_awal) {
                        if ($coa['kode'] == $s_awal['kode']) {
                            $saldo += $s_awal['saldo_normal'];
                        }
                    }
                    foreach ($dt as $key => $jurnal) {
                        if ($jurnal['kode'] == $coa['kode']) {
                            if ($jurnal['id_kelompokakun'] == 2 || $jurnal['id_kelompokakun'] == 3 || $jurnal['id_kelompokakun'] == 4) {
                                $saldo += $jurnal['kredit'] - $jurnal['debit'];
                            } else {
                                $saldo += $jurnal['debit'] - $jurnal['kredit'];
                            }
                        }
                    }
                    $saldoTerakhir[$coa['kode']] = $saldo;
                    $debit = number_format(0, 2, ',', '.');
                    $kredit = number_format(0, 2, ',', '.');
                    if ($coa['id_kelompokakun'] == 1 || $coa['id_kelompokakun'] == 5) {
                        $debit = number_format($saldoTerakhir[$coa['kode']], 2, ',', '.');
                        $jumlahDebit += $saldoTerakhir[$coa['kode']];
                    } else {
                        $kredit = number_format(abs($saldoTerakhir[$coa['kode']]), 2, ',', '.');
                        $jumlahKredit += abs($saldoTerakhir[$coa['kode']]);
                    }
                    if (substr($coa['kode'], 0, 2) >= "10" && substr($coa['kode'], 0, 2) < "12") {
                        if ($lastStatus != 'Aktiva Lancar') {
                            echo "<dt class='text-bold'>Aktiva Lancar</dt>";
                            $lastStatus = 'Aktiva Lancar';
                        }
                    } else {
                        if ($lastStatus != 'Aktiva Tetap') {
                            echo "</br><dt class='text-bold'>Aktiva Tetap</dt>";
                            $lastStatus = 'Aktiva Tetap';
                        }
                    }
            ?>
                    <dd>
                        <span class="text-left"><?= $coa['nama']; ?></span>
                        <span class="text-right"><?= number_format($saldo, 2, ',', '.'); ?></span>
                    </dd>
            <?php
                    // tambahkan saldo aktiva tetap dan aktiva lancar
                    if (substr($coa['kode'], 0, 2) >= "10" && substr($coa['kode'], 0, 2) < "12") {
                        $saldo_aktiva_lancar += $saldo;
                    } else {
                        $saldo_aktiva_tetap += $saldo;
                    }
                }
            }
            ?>
        </td>
        <!-- untuk kolom pasiva -->
        <td>
            <?php
            $saldoTerakhir = array();
            $jumlahDebit = 0;
            $jumlahKredit = 0;
            $lastStatus = '';
            $saldo_modal = 0;
            $saldo_pasiva_lancar = 0;

            //hitung laba rugi
            $saldoTerakhirLabaRugi = array();
            $jumlahDebitLabaRugi = 0;
            $jumlahKreditLabaRugi = 0;

            $total_beban = 0;
            $total_pendapatan = 0;
            $pajak = 0;
            $labaRugi = 0;
            foreach ($dtMasterCoa as $key => $coa) {
                /* id_kelompokakun 
                * 1 - Aset/Aktiva
                * 2 - Kewajiban/Passiva
                * 3 - Modal
                * 4 - Pendapatan
                * 5 - Beban
                */
                if ($coa['id_kelompokakun'] == 3 || $coa['id_kelompokakun'] == 2) {
                    $saldo = 0;
                    foreach ($saldoAwal as $key => $s_awal) {
                        if ($coa['kode'] == $s_awal['kode']) {
                            $saldo += $s_awal['saldo_normal'];
                        }
                    }
                    foreach ($dt as $key => $jurnal) {
                        if ($jurnal['kode'] == $coa['kode']) {
                            if ($jurnal['id_kelompokakun'] == 2 || $jurnal['id_kelompokakun'] == 3 || $jurnal['id_kelompokakun'] == 4) {
                                $saldo += $jurnal['kredit'] - $jurnal['debit'];
                            } else {
                                $saldo += $jurnal['debit'] - $jurnal['kredit'];
                            }
                        }
                    }
                    $saldoTerakhir[$coa['kode']] = $saldo;
                    $debit = number_format(0, 2, ',', '.');
                    $kredit = number_format(0, 2, ',', '.');
                    if ($coa['id_kelompokakun'] == 1 || $coa['id_kelompokakun'] == 5) {
                        $debit = number_format($saldoTerakhir[$coa['kode']], 2, ',', '.');
                        $jumlahDebit += $saldoTerakhir[$coa['kode']];
                    } else {
                        $kredit = number_format(abs($saldoTerakhir[$coa['kode']]), 2, ',', '.');
                        $jumlahKredit += abs($saldoTerakhir[$coa['kode']]);
                    }

                    if ($coa['id_kelompokakun'] == 2) {
                        if ($lastStatus != 'Pasiva Lancar') {
                            echo "<dt class='text-bold'>Pasiva Lancar</dt>";
                            $lastStatus = 'Pasiva Lancar';
                        }
                    } else {
                        if ($lastStatus != 'Modal') {
                            echo "</br><dt class='text-bold'>Modal</dt>";
                            $lastStatus = 'Modal';
                        }
                    }

                    $html = '<dd>
  <span class="text-left">' . $coa['nama'] . '</span>
  <span class="text-right">' . number_format($saldo, 2, ",", ".") . '</span>
 </dd>';
                    echo $html;
                    // tambahkan saldo modal dan pasiva lancar
                    if ($coa['id_kelompokakun'] == 2) {
                        $saldo_pasiva_lancar += $saldo;
                    } else {
                        $saldo_modal += $saldo;
                    }
                }

                if ($coa['id_kelompokakun'] == 4 || $coa['id_kelompokakun'] == 5) {
                    $saldoLabaRugi = 0;
                    foreach ($saldoAwal as $key => $s_awal) {
                        if ($coa['kode'] == $s_awal['kode']) {
                            $saldoLabaRugi += $s_awal['saldo_normal'];
                        }
                    }
                    foreach ($dt as $key => $jurnal) {
                        if ($jurnal['kode'] == $coa['kode']) {
                            if ($jurnal['id_kelompokakun'] == 2 || $jurnal['id_kelompokakun'] == 3 || $jurnal['id_kelompokakun'] == 4) {
                                $saldoLabaRugi += $jurnal['kredit'] - $jurnal['debit'];
                            } else {
                                $saldoLabaRugi += $jurnal['debit'] - $jurnal['kredit'];
                            }
                        }
                    }
                    $saldoTerakhirLabaRugi[$coa['kode']] = $saldoLabaRugi;
                    $debit = number_format(0, 2, ',', '.');
                    $kredit = number_format(0, 2, ',', '.');

                    if ($coa['id_kelompokakun'] == 1 || $coa['id_kelompokakun'] == 5) {
                        $debit = number_format($saldoTerakhirLabaRugi[$coa['kode']], 2, ',', '.');
                        $jumlahDebitLabaRugi += $saldoTerakhirLabaRugi[$coa['kode']];
                    } else {
                        $kredit = number_format(abs($saldoTerakhirLabaRugi[$coa['kode']]), 2, ',', '.');
                        $jumlahKreditLabaRugi += abs($saldoTerakhirLabaRugi[$coa['kode']]);
                    }
                }
            }

            foreach ($saldoTerakhirLabaRugi as $key => $saldoLR) {
                if (substr($key, 0, 2) >= "40" && substr($key, 0, 2) < 50) {
                    $total_pendapatan += $saldoLR;
                } else {
                    $total_beban += $saldoLR;
                }
            }

            $labaRugi = $total_pendapatan - $total_beban;
            $html = "<dd>
 <span class='text-left'>Laba Rugi Berjalan</span>
 <span class='text-right'>" . number_format($labaRugi, 2, ',', '.') . "</span>
</dd>";
            echo $html;
            ?>
            </br>
        </td>
    </tr>
    <tr>
        <td>
            <div class="text-bold">
                <span class='text-left'>Total Aktiva Lancar</span><span class='text-right'><?= number_format($saldo_aktiva_lancar, 2, ',', '.') ?></span></br>
                <span class='text-left'>Total Aktiva Tetap</span><span class='text-right'><?= number_format($saldo_aktiva_tetap, 2, ',', '.') ?></span></br>
                <span class='text-left'>Total Aktiva</span><span class='text-right'><?= number_format($saldo_aktiva_tetap + $saldo_aktiva_lancar, 2, ',', '.') ?></span>
            </div>
        </td>
        <td>
            <div class="text-bold">
                <span class='text-left'>Total Pasiva Lancar</span><span class='text-right'><?= number_format($saldo_pasiva_lancar, 2, ',', '.') ?></span></br>
                <span class='text-left'>Total Modal</span><span class='text-right'><?= number_format($saldo_modal + $labaRugi, 2, ',', '.') ?></span></br>
                <span class='text-left'>Total Pasiva</span><span class='text-right'><?= number_format($saldo_pasiva_lancar + $saldo_modal + $labaRugi, 2, ',', '.') ?></span>
            </div>
        </td>
    </tr>
</table>