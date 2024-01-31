@extends('layouts.exam')

@section('content')
    <div class="page-heading">
        @component('components.breadcrumb')
            @slot('menu')
                Ikuti Ujian
            @endslot
            @slot('url_sub1')
                {{ route('home') }}
            @endslot
            @slot('sub1')
                Dashboard
            @endslot
            @slot('url_sub2')
                {{ route('exam-students.index') }}
            @endslot
            @slot('sub2')
                Ujian
            @endslot
        @endcomponent

        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>tes</td>
                                    <td>:</td>
                                    <td>adsd</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body"></div>
                    </div>
                </div>
            </div>
            <!-- Role Table -->
            <div class="card border-1 border-primary">
                <div class="card-header border-bottom p-3">
                    {{-- <h4 class="card-title text-white">Daftar Pengguna</h4> --}}
                    <a href="#" class="btn btn-sm btn-primary" onclick="addData()"><i class="bi bi-plus-circle"></i>
                        Tambah</a>
                </div>
                <div class="card-body table-responsive p-4">
                    <form id="saveExam" action="" method="post">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title mt-n3">Tambah Ujian</h4>
                            <button type="button" class="btn-close btnCancel"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-danger" style="margin-top:-15px;">* Wajib diisi</p>
                            <div class="row p-1">
                                <div class="form-group col-12 mb-3">
                                    <label for="name" class="form-label">Nama Ujian<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" autofocus
                                        required>
                                </div>
                                <div class="form-group col-12 mb-3">
                                    <label for="mapel_id" class="form-label">Mata Pelajaran<span
                                            class="text-danger">*</span></label>
                                    <select name="mapel_id" id="mapel_id" class="form-select" required>
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach (Helper::mapel() as $item)
                                            <option value="{{ $item->id }}">{{ $item->code . '-' . $item->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6 mb-2">
                                    <label for="jml_soal" class="form-group">Jumlah Soal<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="jml_soal" id="jml_soal" class="form-control nisn" required>
                                </div>
                                <div class="form-group col-6 mb-2">
                                    <label for="jml_waktu" class="form-group">Waktu Ujian<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control nisn" name="jml_waktu" id="jml_waktu"
                                            aria-describedby="basic-addon2" required>
                                        <span class="input-group-text" id="basic-addon2">Menit</span>
                                    </div>
                                </div>
                                <div class="form-group col-6 mb-2">
                                    <label for="exam_start_date" class="form-group">Tanggal Mulai<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="exam_start_date" id="exam_start_date" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-6 mb-2">
                                    <label for="exam_start_time" class="form-group">Jam Mulai<span
                                            class="text-danger">*</span></label>
                                    <input type="time" name="exam_start_time" id="exam_start_time" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-6 mb-2">
                                    <label for="exam_end_date" class="form-group">Tanggal Selesai<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="exam_end_date" id="exam_end_date" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-6 mb-2">
                                    <label for="exam_end_time" class="form-group">Jam Selesai<span
                                            class="text-danger">*</span></label>
                                    <input type="time" name="exam_end_time" id="exam_end_time" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-12 mb-2">
                                    <label for="type" class="form-label">Pengacakan Soal<span
                                            class="text-danger">*</span></label>
                                    <select name="type" id="type" class="form-select" required>
                                        <option value="">Pilih</option>
                                        <option value="acak">Soal diacak</option>
                                        <option value="urut">Soal diurut</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn btn-icon icon-left btnCancel" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i>
                                Batal
                            </button>
                            <button type="submit" class="btn btn-icon icon-left btn-primary" id="btnSave">
                                <i class="bi bi-save"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--/ Role Table -->
        </section>
    </div>
@endsection
