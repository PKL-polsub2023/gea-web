<h3 style="text-align: center;">Laporan Laba Rugi Periode: <?= $periode ?></h3>
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
        width: 100%;
        border: 1px solid;
        border-collapse: collapse;
        padding: 5px;
    }

    td {
        text-align: left;
    }

    .text-bold {
        font-weight: bold;
    }
</style>
<table class="center">

    <?php
    $saldoTerakhir = array();
    $jumlahDebit = 0;
    $jumlahKredit = 0;
    $lastStatus = '';

    $saldo_tetap = 0;
    $saldo_lancar = 0;

    $total_beban = 0;
    $total_pendapatan = 0;
    $pajak = 0;
    foreach ($dtMasterCoa as $key => $coa) {        
        /* id_kelompokakun 
            * 1 - Aset/Aktiva
            * 2 - Modal
            * 3 - Kewajiban/Passiva
            * 4 - Pendapatan
            * 5 - Beban
            */
        if ($coa['id_kelompokakun'] == 4 || $coa['id_kelompokakun'] == 5) {             
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

            if ($coa['id_kelompokakun'] == 5) {
                if ($lastStatus != 'Beban') {
                    echo "<tr><td class='text-bold'>Beban</td></tr>";
                    $lastStatus = 'Beban';
                }
            }

            if ($coa['id_kelompokakun'] == 4) {
                if ($lastStatus != 'Pendapatan') {
                    echo "<tr><td class='text-bold'>Pendapatan</td></tr>";
                    $lastStatus = 'Pendapatan';
                }
            }
    ?>
            <tr>
                <td>
                    <dd>
                        <span class="text-left"><?= $coa['nama']; ?></span>
                        <span class="text-right"><?= number_format($saldo, 2, ',', '.'); ?></span>
                    </dd>
                </td>
            </tr>
    <?php
        }
    }
    
    foreach ($saldoTerakhir as $key => $saldo) {
        if (substr($key, 0, 2) >= "40" && substr($key, 0, 2) < 50) {            
            $total_pendapatan += $saldo;
        } else {
            $total_beban += $saldo;
        }
    }   
    ?>
    <tr>
        <td class="text-bold">
            <span class="text-left">Total Pendapatan</span>
            <span class="text-right"><?= number_format($total_pendapatan, 2, ',', '.'); ?></span>
        </td>
    </tr>
    <tr>
        <td class="text-bold">
            <span class="text-left">Total Beban</span>
            <span class="text-right"><?= number_format($total_beban, 2, ',', '.'); ?></span>
        </td>
    </tr>
    <tr>
        <td class="text-bold">
            <span class="text-left">Laba Sebelum Pajak</span>
            <span class="text-right"><?= number_format($total_pendapatan - $total_beban, 2, ',', '.'); ?></span>
        </td>
    </tr>
    <tr>
        <td class="text-bold">
            <dd><span class="text-left">Pajak</span></dd>
            <span class="text-right"><?= number_format(0, 2, ',', '.'); ?></span>
        </td>
    </tr>
    <tr>
        <td class="text-bold">
            <span class="text-left">Laba Bersih</span>
            <span class="text-right"><?= number_format(($total_pendapatan - $total_beban) - $pajak, 2, ',', '.'); ?></span>
        </td>
    </tr>
</table>