$(document).ready(function() {
    // Efek fade-in untuk gambar
    $('.gallery img').each(function(index) {
        $(this).delay(index * 200).fadeIn(500).addClass('loaded');
    });

    // Menampilkan gambar dalam modal saat diklik
    $('.gallery img').on('click', function() {
        var imgSrc = $(this).attr('src');
        $('#modal-img').attr('src', imgSrc);
        $('.modal').fadeIn(300);
    });

    // Menutup modal saat tombol close atau area di luar gambar diklik
    $('.close, .modal').on('click', function() {
        $('.modal').fadeOut(300);
    });

    // Mencegah klik pada gambar menutup modal
    $('#modal-img').on('click', function(event) {
        event.stopPropagation();
    });
});