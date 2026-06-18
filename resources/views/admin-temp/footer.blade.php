@yield('admin-temp.footer')

<footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
        <div class="row">
            <div class="col-sm my-1">
                <p class="m-0">PKK | Cipinang Melayu &#9829; crafted by Team <a
                        href="https://themeforest.net/user/codedthemes" target="_blank"></a>
                    <a href="https://www.nusamandiri.ac.id/nuri/index.js">Universitas Nusa
                        Mandiri</a>.</p>
            </div>
            <div class="col-auto my-1">
                <ul class="list-inline footer-link mb-0">
                    {{-- <li class="list-inline-item"><a href="../index.html">Home</a></li> --}}
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- [Page Specific JS] start -->
<script src="{{ asset('assets_admin/js/plugins/apexcharts.min.js') }}"></script>
{{-- <script src="{{ asset('assets_admin/js/pages/dashboard-default.js') }}"></script> --}}
<script src="{{ asset('assets_admin/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets_admin/js/pcoded.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/feather.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('assets_admin/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/jszip.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/datepicker-full.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/plugins/choices.min.js') }}"></script>
<script>
    layout_change('light');
</script>
@stack('scripts')
<script>
    change_box_container('false');
</script>
<script>
    layout_rtl_change('false');
</script>
<script>
    preset_change("preset-1");
</script>
<script>
    font_change("Public-Sans");
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
            removeItemButton: true,
            allowHTML: true
        });
    });
</script>
<script>
    $('#basic-btn-rw').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });
    $('#basic-btn').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });
    $('#basic-btn-da').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });
    $('#basic-btn-kegiatan').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });

    // $('#basic-btn-kegiatan').DataTable({
    //     dom: 'Bfrtip',
    //     buttons: [{
    //         extend: 'print',
    //         // 1. Hilangkan judul default agar kita bisa buat Kop sendiri
    //         title: '',

    //         // 2. Filter kolom (opsional: agar kolom 'Action' tidak ikut terprint)
    //         exportOptions: {
    //             columns: ':not(:last-child)'
    //         },

    //         // 3. Fungsi Utama untuk Memodifikasi Dokumen
    //         customize: function(win) {

    //             // Menambahkan Kop Surat (Header) ke bagian atas (prepend)
    //             $(win.document.body).prepend(`
    //                 <div class="header-print" style="text-align:center;">
    //                     <h2>LAPORAN KEGIATAN ...</h2>
    //                     <p>KELURAHAN CIPINANG MELAYU</p>
    //                     <hr>
    //                     <table style="text-align:left;">
    //                         <!-- Baris Nama, Jabatan, dll sesuai image_05a7d0.jpg -->
    //                     </table>
    //                 </div>
    //             `);

    //             // Menambahkan Tanda Tangan (Footer) ke bagian bawah (append)
    //             $(win.document.body).append(`
    //                 <div class="footer-print" style="margin-top: 30px;">
    //                     <div style="float:right;">Jakarta, 31 Maret 2026...</div>
    //                     <div style="float:left;">Mengetahui...</div>
    //                 </div>
    //             `);

    //             // Mengatur Styling Tabel agar garisnya muncul (Bordered)
    //             $(win.document.body).find('table')
    //                 .addClass('compact')
    //                 .css({
    //                     'border': '1px solid #000',
    //                     'font-size': '12px'
    //                 });
    //         }
    //     }]
    // });

    $('#basic-btn-suratm').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });
    $('#basic-btn-suratk').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });
    $('#basic-btn-papan').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });
    $('#basic-btn-umum').DataTable({
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'print']
    });
    $('#basic-btn-potensi').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });
    $('#basic-btn-keuangan').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });
    $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {
        // Find the newly active tab's table and invalidate/redraw it
        $.fn.dataTable.tables({
            visible: true,
            api: true
        }).columns.adjust();
    });

    // [ Zero Configuration ] start
    $('#simpletable').DataTable();

    // [ Default Ordering ] start
    $('#order-table').DataTable({
        order: [
            [3, 'desc']
        ]
    });

    // [ Multi-Column Ordering ]
    $('#multi-colum-dt').DataTable({
        columnDefs: [{
                targets: [0],
                orderData: [0, 1]
            },
            {
                targets: [1],
                orderData: [1, 0]
            },
            {
                targets: [4],
                orderData: [4, 0]
            }
        ]
    });

    // [ Complex Headers ]
    $('#complex-dt').DataTable();

    // [ DOM Positioning ]
    $('#DOM-dt').DataTable({
        dom: '<"top"i>rt<"bottom"flp><"clear">'
    });

    // [ Alternative Pagination ]
    $('#alt-pg-dt').DataTable({
        pagingType: 'full_numbers'
    });

    // [ Scroll - Vertical ]
    $('#scr-vrt-dt').DataTable({
        scrollY: '200px',
        scrollCollapse: true,
        paging: false
    });

    // [ Scroll - Vertical, Dynamic Height ]
    $('#scr-vtr-dynamic').DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false
    });

    // [ Language - Comma Decimal Place ]
    $('#lang-dt').DataTable({
        language: {
            decimal: ',',
            thousands: '.'
        }
    });
</script>
