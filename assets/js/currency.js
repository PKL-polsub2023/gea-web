$('.currency').keyup(function(){
    var _this = $(this);
    var rupiah = formatRupiah(_this.val());
    // console.log(rupiah);
    _this.val(rupiah);
    
    var name = _this.attr('name').split("_x").join("");
    $('input[name="' + name + '"]').val( rupiah.split(".").join("") );
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix){
    if (angka == '' || angka == undefined)
        angka = 0;
    // console.log(angka);
    var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    // console.log(angka, number_string);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function setAsRupiah(uang, prefix)
{
    var nilai           = uang.toString().split(".");
    var depanKoma       = nilai[0];
    var belakangKoma    = nilai.length > 1 ? nilai[1] : '';
    var rupiah          = formatRupiah(parseInt(depanKoma), prefix);
    return belakangKoma !== '' ? rupiah + "," + belakangKoma : rupiah + ",00";
}