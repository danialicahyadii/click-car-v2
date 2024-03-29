<script>
    //fungsi untuk menyimpan newData di luar scope function
    let newData

    // Sembunyikan bagian bulan saat pertama kali dimuat
    $('#filterMonthSelect').hide();

    // Membuat bagian select month muncul ketika memilih 'Choose By Month'
    $('#filterSelect').change(function() {
        let filterType = $(this).val();
        console.log(filterType);
        if (filterType == 'ByMonth') {
            $('#filterMonthSelect').show();
        } else {
            $('#filterMonthSelect').hide();
        }
    });

    $('#filter-bulan').click(function() {
        $('#filterModal').modal('show');
    });
    var chart = null; // Variabel global untuk menyimpan instance chart ApexCharts

    function unescapeHTML(html) {
        let doc = new DOMParser().parseFromString(html, "text/html");
        return doc.documentElement.textContent;
    }


    // Fungsi untuk memperbarui atau menginisialisasi chart
    function updateOrInitChart(response) {
        let driverData = response.series[0].data.map(function(item) {
            return unescapeHTML(item.toString());
        });

        let driverLabels = response.series[0].labels.map(function(item) {
            return unescapeHTML(item.toString()).toUpperCase();
        });

        let vehicleData = response.series[1].data.map(function(item) {
            return unescapeHTML(item.toString());
        });

        let vehicleLabels = response.series[1].labels.map(function(item) {
            return unescapeHTML(item.toString()).toUpperCase();
        });

        let employeeData = response.series[2].data.map(function(item) {
            return unescapeHTML(item.toString());
        });

        let employeeLabels = response.series[2].labels.map(function(item) {
            return unescapeHTML(item.toString()).toUpperCase();
        });

        // Buat objek data baru berdasarkan respons
        newData = [{
            name: 'Driver',
            data: driverData.slice(0, 5),
            labels: driverLabels.slice(0, 5),
        }, {
            name: 'Kendaraan',
            data: vehicleData.slice(0, 5),
            labels: vehicleLabels.slice(0, 5),
        }, {
            name: 'Penumpang',
            data: employeeData.slice(0, 5),
            labels: employeeLabels.slice(0, 5),
        }];

        // Periksa apakah chart sudah diinisialisasi sebelumnya
        if (chart) {
            // Jika sudah, perbarui series chart dengan data yang baru
            chart.updateSeries(newData);

        } else {
            // Jika belum, inisialisasi chart
            let options = {
                series: newData,
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Rank 1', 'Rank 2', 'Rank 3', 'Rank 4', 'Rank 5'],
                },
                yaxis: {
                    title: {
                        text: 'Digunakan'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val;
                        }
                    },
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        let seriesName = w.config.series[seriesIndex].name;
                        let dataValue = w.config.series[seriesIndex].data[dataPointIndex];
                        let seriesLabels = w.config.series[seriesIndex].labels;


                        let newDataLabels = newData[seriesIndex].labels;
                        let newDataName = newData[seriesIndex].name;
                        let labelToShow = newDataLabels[dataPointIndex] === '-' || newDataLabels[dataPointIndex] === '--' ? 'Transportasi Online' : newDataLabels[dataPointIndex];

                        return newDataName + ': ' + labelToShow + ': ' + dataValue + ' Used';
                    }
                }
            };

            chart = new ApexCharts(document.querySelector("#column_chart"), options);
            chart.render();
        }

        // Tutup modal jika diperlukan
        $("#filterModal").modal("hide");
    }

    //function untuk update filter card pada setiap driver
    function updateOrInitCard(response) {
        let driverCustomLabels = response.series[0].labels;
        let driverCustomData = response.series[0].data;

        // Hapus konten sebelumnya dari #top10driver sebelum menambahkan konten baru
        $("#top10driver").empty();

        // Loop melalui driverData dan tambahkan konten ke #top10driver
        $.each(driverCustomLabels, function(key, row) {
            let $card = $('<div>').addClass('d-flex border-top pt-2');
            let $img = $('<img>').attr('src', row.avatar ? row.avatar :
                'assets/img/avatars/profiles/icon-user.png').addClass('avatar rounded me-3').attr('alt',
                'shreyu');
            let $div = $('<div>').addClass('flex-grow-1');

            // Periksa apakah row.nama didefinisikan sebelum mengakses panjangnya
            if (row && driverCustomData) {
                let namaText = (key + 1) + '. ' + (row === '-' || row === '--' ? 'Transportasi Online' : (row.length > 25 ? row
                    .substring(0, 25).toUpperCase() + '...' : row.toUpperCase()));

                let $h5 = $('<h5>').addClass('mt-1 mb-0 fs-15').attr('title', row).text(namaText);
                let $h4 = $('<h4>').addClass('fw-normal mt-1 mb-2');
                let $span = $('<span>').addClass('text-warning');

                for (let i = 1; i <= 5; i++) {
                    let $star = $('<i>').addClass('fas fa-star');
                    $span.append($star);
                }

                $.each(driverCustomData, function(index, value) {
                    if (index == key) {
                        $h4.append($span).append(' ' + value + ' kali dirating');
                    }
                });


                $div.append($h5).append($h4);
                $card.append($img).append($div);
                $("#top10driver").append($card);
            } else {
                console.error('row.nama tidak didefinisikan:', row);
            }
            // $("#top10driver").append('<b>Hello World!</b> '+ row +'<br>');
        });

    }

    //function untuk update filter pada setiap vehicle
    function updateOrInitVehicle(response) {
        let kendaraanCustomLabels = response.series[1].labels;
        let kendaraanCustomData = response.series[1].data;

        $("#top10kendaraan").empty();

        $.each(kendaraanCustomLabels, function(key, row) {
            let $card = $('<div>').addClass('d-flex border-top pt-2');
            let $img = $('<img>').attr('src', 'assets/img/icon-car.png').addClass('avatar rounded me-3').attr('alt', 'shreyu');
            let $div = $('<div>').addClass('flex-grow-1');
            let jenisKendaraan = row ? row : 'JENIS KENDARAAN TIDAK DITEMUKAN';
            let $a = $('<a>').addClass('text-dark').attr('href', '#').attr('title', jenisKendaraan);
            let $h5 = $('<h5>').addClass('mt-1 mb-0 fs-15').text((key + 1) + '. ' + (row == '-' ? 'Transportasi Online' : row.toUpperCase()));
            let $h5Subtitle = $('<h5>').addClass('text-muted fw-normal mt-1 mb-2').text('Total Riwayat: ' + kendaraanCustomData[key] + ' kali dipakai');

            $a.append($h5);
            $div.append($a).append($h5Subtitle);
            $card.append($img).append($div);
            $("#top10kendaraan").append($card);
        });
    }

    //function untuk update filter pada setiap passenger
    function updateOrInitPassenger(response) {
        let penumpangCustomLabels = response.series[2].labels;
        let penumpangCustomData = response.series[2].data;

        $("#top10penumpang").empty();

        $.each(penumpangCustomLabels, function(key, row) {
            let $card = $('<div>').addClass('d-flex border-top pt-2');
            let $img = $('<img>').attr('src', 'assets/img/avatars/profiles/icon-user.png').addClass('avatar rounded me-3').attr('alt', 'shreyu');
            let $div = $('<div>').addClass('flex-grow-1');
            let jabatan = row ? row : 'JABATAN TIDAK DITEMUKAN';
            let $a = $('<a>').addClass('text-dark').attr('href', '#').attr('title', jabatan);
            let $h5 = $('<h5>').addClass('mt-1 mb-0 fs-15').text((key + 1) + '. ' + (row.length > 25 ? row.substring(0, 25).toUpperCase() + '...' : row.toUpperCase()));
            let $h5Subtitle = $('<h5>').addClass('text-muted fw-normal mt-1 mb-2').text('Total Riwayat: ' + penumpangCustomData[key] + ' kali perjalanan');

            $a.append($h5);
            $div.append($a).append($h5Subtitle);
            $card.append($img).append($div);
            $("#top10penumpang").append($card);
        });
    }

    // AJAX untuk mendapatkan data awal saat halaman dimuat
    function loadInitialData() {
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "POST", // Sesuaikan dengan jenis permintaan yang sesuai
            url: "/dashboard/filter-bulan", // Ganti dengan URL yang sesuai untuk data awal
            data: {
                filter_type: 'YTD', // Sesuaikan
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {

                // Panggil fungsi untuk menginisialisasi atau memperbarui chart dengan data awal
                updateOrInitChart(response);

                updateOrInitCard(response);

                updateOrInitVehicle(response);

                updateOrInitPassenger(response);

            },
            error: function(error) {
                // Tangani kesalahan jika diperlukan
                console.error(error);
            }
        });
    }

    // Panggil fungsi untuk memuat data awal saat halaman dimuat
    loadInitialData();

    // AJAX untuk melakukan filter
    $("#filterModal #button-submit").click(function() {
        // Ambil nilai dari select box
        let filterType = $("#filterSelect").val();
        let month = $("#month").val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Lakukan permintaan AJAX
        $.ajax({
            type: "POST",
            url: "/home/filter-bulan", // Ganti dengan URL tujuan Anda
            data: {
                filter_type: filterType,
                month: month
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                // Tangani respons dari server di sini
                console.log(response);

                // Memperbarui atau menginisialisasi chart dengan data yang baru
                updateOrInitChart(response);

                updateOrInitCard(response);

                updateOrInitVehicle(response);

                updateOrInitPassenger(response);
            },
            error: function(error) {
                // Tangani kesalahan jika diperlukan
                console.error(error);
            }
        });
    });
</script>
