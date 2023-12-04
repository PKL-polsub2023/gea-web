$('#mastercoa_id').change(function(){ 

    if($(this).val() == '') reset()
    else {
        var id=$(this).val();
        $.ajax({
            url : url_getakun,
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){
                var html = '';
                
                var i;
                for(i=0; i<data.length; i++){
                    html  += data[i].nama;
                    
                    if (data[i].jenis == 'Debit') {
                        $('#debit_aw').val('0');
                        $('#kredit_aw').val('-');
                        $('#debit_aw').prop('disabled', false);
                        $('#kredit_aw').prop('disabled', true);
                        $('#debit_aw').css("background-color", "#FFF");
                        $('#kredit_aw').css("background-color", "#DDD");
                    }else if (data[i].jenis == 'Kredit') {
                        $('#debit_aw').val('-');
                        $('#kredit_aw').val('0');
                        $('#debit_aw').prop('disabled', true);
                        $('#kredit_aw').prop('disabled', false);
                        $('#debit_aw').css("background-color", "#DDD");
                        $('#kredit_aw').css("background-color", "#FFF");
                    }
                }
                $('#namarek').val(html);
                $('button#tambah').prop('disabled', false)
            }
        });
    }

    return false;
}); 

$(document).on('click', '#tambah', function(e){
    const url_tambahjurnal = $('#content').data('url') + '/tambahjurnal';

    const data_jurnalmasuk= {
        mastercoa_id: $('select[name="mastercoa_id"]').val(), 
        namarek: $('input[name="namarek"]').val(),
        debit: $('input[name="debit"]').val() == "" ? 0 : $('input[name="debit"]').val().toString().replace(",","."),
        kredit: $('input[name="kredit"]').val() == "" ? 0 : $('input[name="kredit"]').val().toString().replace(",","."),
    };

    $.ajax({
        url: url_tambahjurnal,
        type: 'POST',
        data: data_jurnalmasuk,
        success: function(data){
            if($('select[name="mastercoa_id"]').val() == data_jurnalmasuk.mastercoa_id) $('option[value="' + data_jurnalmasuk.mastercoa_id + '"]').hide();
            reset();

            $('table#isi tbody').append(data);
            $('tfoot').show();

            $('#totaldebit').html('<p align="left">Total Debit : <strong><span id="totaldebit_footer">' + setAsRupiah(hitung_totaldebit(), "Rp. ") + '</span></strong></p>')
            $('input[name="totaldebit_hidden"]').val(hitung_totaldebit())

            $('#totalkredit').html('<p align="left">Total Kredit : <strong><span id="totalkredit_footer">' + setAsRupiah(hitung_totalkredit(), "Rp. ") + '</span></strong></p>')
            $('input[name="totalkredit_hidden"]').val(hitung_totalkredit())
        }
    });

})

/**
 * Delete row
 */
$(document).on('click', '#tombol-hapus', function(){
    $(this).closest('.row-isi').remove();

    $('option[value="' + $(this).data('namarek') + '"]').show();

    $('#totaldebit_footer').html(setAsRupiah(hitung_totaldebit(), "Rp. "));
    $('input[name="totaldebit_hidden"]').val(hitung_totaldebit());

    $('#totalkredit_footer').html(setAsRupiah(hitung_totalkredit(), "Rp. "));
    $('input[name="totalkredit_hidden"]').val(hitung_totalkredit());

    // console.log($('#isi tbody').children().length);
    if($('#isi tbody').children().length == 0) {
        $('#isi tfoot').hide();
    }
})

/**
 * Disable form when submit
 */
$('button[type="submit"]').on('click', function(){
    $('select[name="mastercoa_id"]').prop('disabled', true)
    $('input[name="namarek"]').prop('disabled', true)
    $('input[name="debit_x"]').prop('disabled', true)
    $('input[name="debit"]').prop('disabled', true)
    $('input[name="kredit_x"]').prop('disabled', true)
    $('input[name="kredit"]').prop('disabled', true)
})

/**
 * Reset form
 */
function reset(){
    $('#mastercoa_id').val('')
    $('#namarek').val('')
    $('input[name="debit"]').val('')
    $('input[name="debit_x"]').val('')
    $('input[name="kredit"]').val('')
    $('input[name="kredit_x"]').val('')
    $('button#tambah').prop('disabled', true)
}

/**
 * Function total kredit
 */
function hitung_totalkredit(){
    let totalkredit = 0;
    $('input[name="kredit_hidden[]"]').each(function(){
        // console.log($(this).val());
        var nilai = $(this).val() == NaN || $(this).val() == '' ? 0 : $(this).val();
        // console.log(nilai);
        totalkredit += parseFloat(nilai)
        // console.log(totalkredit);
    })
    return totalkredit;
}

/**
 * Function total debit
 */
function hitung_totaldebit(){
    let totaldebit = 0;
    $('input[name="debit_hidden[]"]').each(function(){
        var nilai = $(this).val() == NaN || $(this).val() == '' ? 0 : $(this).val();
        totaldebit += parseFloat(nilai)
    })
    return totaldebit;
}

/**
 * Disable enter
 */
$(document).keypress(function(event){
    if (event.which == '13') {
          event.preventDefault();
       }
})