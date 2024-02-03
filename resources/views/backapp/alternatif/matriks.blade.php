@extends('layouts.app')

@can('read permission')

    @section('content')
        <div class="page-heading">
            @component('components.breadcrumb')
                @slot('menu')
                    Matriks Alternatif &rarr; {{ Helper::getKriteriaNama($jenis-1) }}
                @endslot
                @slot('url_sub1')
                    {{ route('home') }}
                @endslot
                @slot('sub1')
                    Dashboard
                @endslot
            @endcomponent

            <section class="section row">
                <div class="col-md-12">
                    <!-- Form Course Modal -->
                    <div class="card">
                        <div class="card-body">
                            <h4>Matriks Perbandingan Berpasangan</h4>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Kriteria</th>
                                        @for ($i = 0; $i <= $n - 1; $i++)
                                            <th>
                                                {{ Helper::getAlternatifNama($i) }}
                                            </th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($x = 0; $x <= $n - 1; $x++)
                                        <tr>
                                            <td>
                                                {{ Helper::getAlternatifNama($x) }}
                                            </td>
                                            @for ($y = 0; $y <= $n - 1; $y++)
                                                <td>{{ round($matrik[$x][$y], 5) }}</td>
                                            @endfor
                                        </tr>
                                    @endfor
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <th>Jumlah</th>
                                        @for ($i = 0; $i <= $n - 1; $i++)
                                            <th>{{ round($jmlmpb[$i], 5) }}</th>
                                        @endfor
                                    </tr>
                                </tfoot>
                            </table>


                            <br>

                            <h4>Matriks Nilai Kriteria</h4>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Kriteria</th>
                                        @for ($i = 0; $i <= $n - 1; $i++)
                                            <th>{{ Helper::getAlternatifNama($i) }}</th>
                                        @endfor
                                        <th>Jumlah</th>
                                        <th>Priority Vector</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($x = 0; $x <= $n - 1; $x++)
                                        <tr>
                                            <td>{{ Helper::getAlternatifNama($x) }}</td>
                                            @for ($y = 0; $y <= $n - 1; $y++)
                                                <td>{{ round($matrikb[$x][$y], 5) }}</td>
                                            @endfor
                                            <td>{{ round($jmlmnk[$x], 5) }}</td>
                                            <td>{{ round($pv[$x], 5) }}</td>

                                        </tr>
                                    @endfor
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <th colspan="{{ $n + 2 }}">Principe Eigen Vector (λ maks)</th>
                                        <th>{{ round($eigenvektor, 5) }}</th>
                                    </tr>
                                    <tr class="bg-light">
                                        <th colspan="{{ $n + 2 }}">Consistency Index</th>
                                        <th>{{ round($consIndex, 5) }}</th>
                                    </tr>
                                    <tr class="bg-light">
                                        <th colspan="{{ $n + 2 }}">Consistency Ratio</th>
                                        <th>{{ round($consRatio * 100, 2) }} %</th>
                                    </tr>
                                </tfoot>
                            </table>
                            @if ($consRatio > 0.1)
                                <div class="alert alert-danger fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <div class="d-inline-flex align-items-center">
                                        <strong class="me-2">Nilai Consistency Ratio melebihi 10% !!!</strong>
                                    </div>
                                    <p class="mb-0">Mohon input kembali tabel perbandingan...</p>
                                </div>


                                <a href='javascript:history.back()'>
                                    <button class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i>
                                        Kembali
                                    </button>
                                </a>
                            @else
                                @if ($jenis == Helper::getJumlah('alternatif'))
                                    <a href="{{ route('ranking.index') }}">
                                        <button class="btn btn-primary" style="float: right;">
                                            <i class="bi bi-arrow-right"></i>
                                            Lanjut
                                        </button>
                                    </a>
                                @else
                                    <a href="{{ route('bobot-alternatif.index', $jenis + 1) }}">
                                        <button class="btn btn-primary" style="float: right;">
                                            <i class="bi bi-arrow-right"></i>
                                            Lanjut ke {{ Helper::getKriteriaNama($jenis) }}
                                        </button>
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                    <!--/ Form Course Modal -->
                </div>
            </section>
        </div>
    @endsection
@endcan
