<h3 style="text-align: center;">Laporan Buku Besar Periode: <?= $periode ?></h3>
<h4 style="text-align: center;"><?= $subjudul ?></h4>
<style>
    .text-left {
        float: left
    }

    .text-right {
        float: right
    }

    .text-center {
        text-align: center;
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
        padding: 10px;
    }

    table {
        width: 100%;
    }
</style>

<?php foreach ($dtMasterCoa as $key => $coa) { ?>
    <table class="center">
        <tr>
            <th colspan="6">
                <span class="text-left">Nama Akun: <?= $coa['nama']; ?></span>
                <span class="text-right">Kode Akun: <?= $coa['kode']; ?></span>
            </th>
        </tr>
        <tr>
            <th width="5%">No Jurnal</th>
            <th width="20%">Tanggal</th>
            <th width="30%">Keterangan</th>
            <th width="15%">Debit</th>
            <th width="15%">Kredit</th>
            <th width="15%">Saldo</th>
        </tr>
        <?php
        $saldo = 0;
        
        $foundSaldo = false;
        foreach ($saldoAwal as $key => $s_awal) {
            if ($s_awal['kode']==$coa['kode'] ) {
                $foundSaldo = true;
                $saldo .= $s_awal['saldo_normal'];
        ?>
                <tr>
                    <td colspan="5">Saldo Awal</td>
                    <td><?= number_format($s_awal['saldo_normal'], 2, ',', '.'); ?></td>
                </tr>
            <?php
            }
        }
        $foundDT = false;
        foreach ($dt as $key => $jurnal) {
            if ($jurnal['kode'] == $coa['kode']) { 
                $foundDT = true;
                ?>
                <tr>
                    <td><?= $jurnal['no_jurnal'] ?></td>
                    <td><?= date('d F Y', strtotime($jurnal['tanggal'])); ?></td>
                    <td><?= $jurnal['keterangan'] ?></td>
                    <td><?= number_format($jurnal['debit'], 2, ',', '.'); ?></td>
                    <td><?= number_format($jurnal['kredit'], 2, ',', '.'); ?></td>
                    <td>
                        <?php                        
                        /* 
                         * 1 - Aset/Aktiva
                         * 2 - Kewajiban/Passiva
                         * 3 - Modal
                         * 4 - Pendapatan
                         * 5 - Beban
                         */

                        if($jurnal['id_kelompokakun']== 2 || $jurnal['id_kelompokakun']== 3 || $jurnal['id_kelompokakun']== 4){
                            $saldo += $jurnal['kredit'] - $jurnal['debit'];
                        } else {
                            $saldo += $jurnal['debit'] - $jurnal['kredit'];
                        }
                        echo number_format($saldo, 2, ',', '.');
                        ?>
                    </td>
                </tr>
        <?php
            }
        }
        if (!$foundDT && !$foundSaldo) {
            echo "<tr><td colspan='6'>Tidak Ada Data Tersedia</td></tr>";
        }
        ?>
    </table></br>
<?php
}
?>