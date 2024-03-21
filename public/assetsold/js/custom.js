document.addEventListener("DOMContentLoaded", function() {
    // Mendapatkan tab yang aktif saat ini
    const activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        // Mengatur tab yang aktif sesuai dengan yang disimpan sebelumnya
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }

    // Menyimpan tab yang aktif saat ini saat tab berubah
    $('#myTab a').on('click', function(e) {
        localStorage.setItem('activeTab', $(this).attr('href'));
    });
});