<h3 style="text-align: center;">Laporan Neraca Saldo Periode: <?= $periode ?></h3>
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
        padding: 15px;
    }

    table {
        width: 100%;
    }
</style>
<table class="center">
    <tr>
        <th>Kode Akun</th>
        <th>Nama Akun</th>
        <th>Debit</th>
        <th>Kredit</th>
    </tr>
    <?php
    $saldoTerakhir = array();
    $jumlahDebit = 0;
    $jumlahKredit = 0;
    foreach ($dtMasterCoa as $key => $coa) {
        $saldo = 0;
        foreach ($saldoAwal as $key => $s_awal) {
            if ($coa['kode'] == $s_awal['kode']) {
                $saldo += $s_awal['saldo_normal'];
            }
        }
        foreach ($dt as $key => $jurnal) {
            if ($jurnal['kode'] == $coa['kode']) {
                /* 
                * 1 - Aset/Aktiva
                * 2 - Modal
                * 3 - Kewajiban/Passiva
                * 4 - Pendapatan
                * 5 - Beban
                */
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
        /* 
        * 1 - Aset/Aktiva
        * 2 - Modal
        * 3 - Kewajiban/Passiva
        * 4 - Pendapatan
        * 5 - Beban
        */
        if ($coa['id_kelompokakun'] == 1 || $coa['id_kelompokakun'] == 5) {
            $debit = number_format($saldoTerakhir[$coa['kode']], 2, ',', '.');
            $jumlahDebit += $saldoTerakhir[$coa['kode']];
        } else {
            $kredit = number_format(abs($saldoTerakhir[$coa['kode']]), 2, ',', '.');
            $jumlahKredit += abs($saldoTerakhir[$coa['kode']]);
        }
    ?>
        <tr>
            <td><?= $coa['kode']; ?></td>
            <td><span class="text-left"><?= $coa['nama']; ?></span></td>
            <td><span class="text-right"><?= $debit; ?></span></td>
            <td><span class="text-right"><?= $kredit; ?></span></td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <th colspan="2">Jumlah</th>
        <th><span class="text-right"><?= number_format($jumlahDebit, 2, ',', '.'); ?></span></th>
        <th><span class="text-right"><?= number_format($jumlahKredit, 2, ',', '.'); ?></span></th>
    </tr>
</table>