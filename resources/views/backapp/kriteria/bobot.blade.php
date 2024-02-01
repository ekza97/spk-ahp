@extends('layouts.app')

@can('read permission')

    @section('content')
        <div class="page-heading">
            @component('components.breadcrumb')
                @slot('menu')
                    Perbandingan Kriteria
                @endslot
                @slot('url_sub1')
                    {{ route('home') }}
                @endslot
                @slot('sub1')
                    Dashboard
                @endslot
            @endcomponent

            <section class="section row">
                <div class="col-md-6">
                    <!-- Form Course Modal -->
                    <div class="card">
                        <div class="card-body">
                            {{ Helper::showTabelPerbandingan('kriteria','kriteria') }}
                        </div>
                    </div>
                    <!--/ Form Course Modal -->
                </div>
                <div class="col-md-6">
                    <!-- Permission Table -->
                    <div class="card border-1 border-primary">
                        <div class="card-header border-bottom p-3 pb-1">
                            <h4 class="card-title">Tabel Tingkat Kepentingan menurut Saaty (1980)</h4>
                        </div>
                        <div class="card-body table-responsive p-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="120">Nilai Numerik</th>
                                    <th>Tingkat Kepentingan <em>(Preference)</em></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Sama pentingnya <em>(Equal Importance)</em></td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Sama hingga sedikit lebih penting</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Sedikit lebih penting <em>(Slightly more importance)</em></td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Sedikit lebih hingga jelas lebih penting</td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Jelas lebih penting <em>(Materially more importance)</em></td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td>Jelas hingga sangat jelas lebih penting</td>
                                </tr>
                                <tr>
                                    <td class="text-center">7</td>
                                    <td>Sangat jelas lebih penting <em>(Significantly more importance)</em></td>
                                </tr>
                                <tr>
                                    <td class="text-center">8</td>
                                    <td>Sangat jelas hingga mutlak lebih penting</td>
                                </tr>
                                <tr>
                                    <td class="text-center">9</td>
                                    <td>Mutlak lebih penting <em>(Absolutely more importance)</em></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <!--/ Permission Table -->
                </div>


                <!--Delete Modal -->
                @include('utils.ajaxDelete')
            </section>
        </div>
    @endsection

    @push('scriptjs')
        <script>
            $('table').on('draw.dt', function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            })

            $('#btnCancel').on('click', function() {
                $('[name="kode"]').val('');
                $('[name="nama"]').val('');
                $('[name="kode"]').focus();
                $("#saveKriteria").attr('action', '');
                $("#btnSave").html('<i class="bi bi-save"></i> Simpan');
            });

            function editData(id) {
                $('[name="name"]').focus();
                var link = "{{ route('kriteria.edit', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        id: id
                    },

                    success: function(response) {
                        window.scrollTo(0, 0);
                        $("#btnSave").html('<i class="bi bi-save"></i> Update');
                        $("#saveKriteria").attr('action', response.link);
                        $('[name="kode"]').val(response.kode);
                        $('[name="nama"]').val(response.nama);
                    },
                    error: function(response) {
                        toastr.error('Terjadi kesalahan', 'ERROR');
                    },
                });
            }

            $('#saveKriteria').on('submit', function(e) {
                e.preventDefault();
                let spin =
                    '<div class="spinner-border spinner-border-sm text-white" role="status"><span class="visually-hidden">Loading...</span></div>';
                $("#btnSave").html(spin + ' Processing...').attr('disabled', 'disabled');
                var link = $("#saveKriteria").attr('action');
                let type = "PUT";
                if (link == "") {
                    link = "{{ route('kriteria.store') }}";
                    type = "POST";
                }
                let kode = $('[name="kode"]').val();
                let nama = $('[name="nama"]').val();

                $.ajax({
                    url: link,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: type,
                    dataType: 'json',
                    data: {
                        kode: kode,
                        nama: nama
                    },
                    success: function(response) {
                        $("#saveKriteria").attr('action', '');
                        $("#btnSave").html('<i class="bi bi-save"></i> Simpan').removeAttr('disabled');
                        //delete field
                        $('[name="kode"]').val('');
                        $('[name="nama"]').val('');
                        // window.scrollTo(0, document.body.scrollHeight);
                        $('#kriteria-table').DataTable().ajax.reload(null, false);
                        $('[name="kode"]').focus();
                        toastr.success(response.message, 'SUCCESS');
                    },
                    error: function(response) {
                        $("#btnSave").html('<i class="bi bi-save"></i> Simpan').removeAttr('disabled');
                        toastr.error('Proses menyimpan error: ' + response.responseText, 'ERROR');
                    },
                });
            });

            $(document).on('click', '#deleteKriteria', function(e) {
                e.preventDefault();
                let allData = new FormData(this);
                var linkDel = $(this).attr('action');
                $('#deleteModal').modal('show');
                $("#btnYes").click(function() {
                    $.ajax({
                        url: linkDel,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        data: allData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                            linkDel = '';
                            $('#deleteModal').modal('hide');
                            $('#kriteria-table').DataTable().ajax.reload(null, false);
                            $('[name="name"]').focus();
                            if (response) {
                                toastr.success('Berhasil hapus', 'SUCCESS');
                            }
                            if (!response) {
                                toastr.warning('Tidak Bisa Dihapus', 'WARNING');
                            }
                        },

                    });
                });
                $(".btnBatal").click(function() {
                    linkDel = '';
                    $('#deleteModal').modal('hide');
                });
            });
        </script>

        {{-- {!! $dataTable->scripts() !!} --}}
    @endpush

@endcan
