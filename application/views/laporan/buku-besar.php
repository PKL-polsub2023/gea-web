<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Buku Besar</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .center {
            margin: 0 auto;
            text-align: center;
            padding-top: 10px;
        }

        label,
        input {
            display: inline-block;
            margin-right: 10px;
        }

        label {
            width: 100px;
        }

        input {
            width: 200px;
        }
    </style>
</head>

<body id="container">
    <?php $this->load->view('./navbar'); ?>
    <div id="utama">
        <section class="center">
            <label for="fromDate">Dari Tanggal</label>
            <input type="date" name="fromDate" id="fromDate">
            <label for="toDate">Sampai Tanggal</label>
            <input type="date" name="toDate" id="toDate">
            <button name="view" id="viewData">Tampilkan</button>
            <button name="cetak" id="cetak">Cetak</button>
        </section>
        <section>
            <div id="tampildata" class="tampildata"></div>
        </section>
    </div>

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
            let url = "<?= site_url('laporan/bukubesar_view') ?>"
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
                const href = '<?= site_url('laporan/bukubesar_pdf/') ?>' + fromDate + '/' + toDate
                event.preventDefault();
                const {
                    target = '_blank'
                } = event.currentTarget;
                const features = "resizable";
                window.open(href, target, features);
            }
        };
    </script>
</body>

</html>