$(function () {
    // Handle change event
    $("#seksireferensi").change(function () {
        var seksi = $(this).val();
        $.ajax({
            url: '/referensi/pegawai/add?seksireferensi=' + encodeURIComponent(seksi),
            type: "GET",
            dataType: "json",
            success: function (data) {
                var namaContainer = $("#nama-container");
                namaContainer.empty();
                namaContainer.append("<select class='form-control' id='nama' name='nama' required>");
                $.each(data, function (index, user) {
                    $("#nama").append("<option value='" + user.id + "'>" + "NIP : " + user.nip + " Nama: " + user.nama + "</option>");
                });
                namaContainer.append("</select>");
            }
        });
    });


    $('#pic').change(function () {
        if ($(this).val() == 'lainnya') {
            $('#pic_lainnya').show().prop('required', true);
        } else {
            $('#pic_lainnya').hide().prop('required', false);
        }
    });


    $('#kegiatan').change(function () {
        if ($(this).val() == 'lainnya') {
            $('#kegiatan_lainnya').show().prop('required', true);;
        } else {
            $('#kegiatan_lainnya').hide().prop('required', false);
        }
    });
    
});
