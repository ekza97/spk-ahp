@extends('layouts.app')

@can('read permission')

    @section('content')
        <div class="page-heading">
            @component('components.breadcrumb')
                @slot('menu')
                    Perbandingan Alternatif &rarr; {{ Helper::getKriteriaNama($jenis-1) }}
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
                    <div class="card">
                        <div class="card-body">
                            {{ Helper::showTabelPerbandingan($jenis) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
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
                </div>
            </section>
        </div>
    @endsection

@endcan
