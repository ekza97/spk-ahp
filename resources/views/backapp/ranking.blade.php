@extends('layouts.app')

@can('read permission')

    @push('scriptcss')
        <style>
            .ribbon-cell {
                position: relative;
            }

            .ribbon {
                position: absolute;
                top: 4px;
                left: -15px;
                /* Adjusted to left */
                background-color: #ff5722;
                /* Ribbon color */
                color: white;
                padding: 5px 25px;
                font-size: 14px;
                font-weight: bold;
                transform: rotate(0deg);
                -webkit-transform: rotate(0deg);
            }

            /* Optionally, you can style the ribbon text */
            .ribbon::before {
                content: '';
                position: absolute;
                top: 100%;
                left: 0;
                /* Adjusted to left */
                border-top: 5px solid #ff5722;
                /* Ribbon color */
                border-left: 15px solid transparent;
            }
        </style>
    @endpush
    @section('content')
        <div class="page-heading">
            @component('components.breadcrumb')
                @slot('menu')
                    Hasil Perhitungan dan Ranking
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
                    <div class="card">
                        <div class="card-body">
                            <h4>Hasil Perhitungan</h4>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Overall Composite Height</th>
                                        <th>Priority Vector (rata-rata)</th>
                                        @for ($i = 0; $i <= $jmlAlternatif - 1; $i++)
                                            <th>{{ Helper::getAlternatifNama($i) }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($x = 0; $x <= $jmlKriteria - 1; $x++)
                                        <tr>
                                            <td>{{ Helper::getKriteriaNama($x) }}</td>
                                            <td>{{ round(Helper::getKriteriaPV(Helper::getKriteriaID($x)), 5) }}</td>
                                            @for ($y = 0; $y <= $jmlAlternatif - 1; $y++)
                                                <td>{{ round(Helper::getAlternatifPV(Helper::getAlternatifID($y), Helper::getKriteriaID($x)), 5) }}
                                                </td>
                                            @endfor
                                        </tr>
                                    @endfor
                                </tbody>

                                <tfoot>
                                    <tr class="bg-light">
                                        <th colspan="2">Total</th>
                                        @for ($i = 0; $i <= $jmlAlternatif - 1; $i++)
                                            <th>{{ round($nilai[$i], 5) }}</th>
                                        @endfor
                                    </tr>
                                </tfoot>

                            </table>


                            <h4 class="mt-4">Perangkingan</h4>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-light">
                                        <th style="width:100px;">Peringkat</th>
                                        <th>Alternatif</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alternatif as $item)
                                        @php
                                            $urut = $loop->iteration;
                                        @endphp
                                        <tr>
                                            @if ($urut == 1)
                                                <td class="ribbon-cell">
                                                    <div class="ribbon">Pertama</div>
                                                </td>
                                            @else
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                            @endif
                                            <td>{{ $item['nama'] }}</td>
                                            <td>{{ $item['nilai'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endsection

@endcan
