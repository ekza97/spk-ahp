@extends('layouts.app')

@can('read permission')

    @section('content')
        <div class="page-heading">
            @component('components.breadcrumb')
                @slot('menu')
                    Matriks Kriteria
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
                            <h3 class="ui header">Matriks Perbandingan Berpasangan</h3>
                            <table class="ui collapsing celled blue table">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        <th>
                                            @for ($i = 0; $i <= ($n-1); $i++)
                                                {{ Helper::getKriteriaNama($i) }}
                                            @endfor
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($x = 0; $x <= ($n-1); $i++)
                                        <tr>
                                            <td>
                                                {{ Helper::getKriteriaNama($i) }}
                                            </td>
                                            @for ($y = 0; $y <= ($n-1); $i++)
                                                {{-- <td>{{ round($matrik[$x][$y],5) }}</td> --}}
                                            @endfor
                                        </tr>
                                    @endfor
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Jumlah</th>
                                        <?php
                                        for ($i = 0; $i <= ($n-1); $i++) {
                                            echo '<th>' . round($jmlmpb[$i], 5) . '</th>';
                                        }
                                        ?>
                                    </tr>
                                </tfoot>
                            </table>


                            <br>

                            <h3 class="ui header">Matriks Nilai Kriteria</h3>
                            <table class="ui celled red table">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        <?php
                                        for ($i = 0; $i <= $n - 1; $i++) {
                                            echo '<th>' . Helper::getKriteriaNama($i) . '</th>';
                                        }
                                        ?>
                                        <th>Jumlah</th>
                                        <th>Priority Vector</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($x = 0; $x <= $n - 1; $x++) {
                                        echo '<tr>';
                                        echo '<td>' . Helper::getKriteriaNama($x) . '</td>';
                                        for ($y = 0; $y <= $n - 1; $y++) {
                                            echo '<td>' . round($matrikb[$x][$y], 5) . '</td>';
                                        }
                                    
                                        echo '<td>' . round($jmlmnk[$x], 5) . '</td>';
                                        echo '<td>' . round($pv[$x], 5) . '</td>';
                                    
                                        echo '</tr>';
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="<?php echo $n + 2; ?>">Principe Eigen Vector (λ maks)</th>
                                        <th><?php echo round($eigenvektor, 5); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="<?php echo $n + 2; ?>">Consistency Index</th>
                                        <th><?php echo round($consIndex, 5); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="<?php echo $n + 2; ?>">Consistency Ratio</th>
                                        <th><?php echo round($consRatio * 100, 2); ?> %</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <?php
	if ($consRatio > 0.1) {
?>
                            <div class="ui icon red message">
                                <i class="close icon"></i>
                                <i class="warning circle icon"></i>
                                <div class="content">
                                    <div class="header">
                                        Nilai Consistency Ratio melebihi 10% !!!
                                    </div>
                                    <p>Mohon input kembali tabel perbandingan...</p>
                                </div>
                            </div>

                            <br>

                            <a href='javascript:history.back()'>
                                <button class="ui left labeled icon button">
                                    <i class="left arrow icon"></i>
                                    Kembali
                                </button>
                            </a>

                            <?php
	} else {}

?>
                            <br>

                            <a href="bobot.php?c=1">
                                <button class="ui right labeled icon button" style="float: right;">
                                    <i class="right arrow icon"></i>
                                    Lanjut
                                </button>
                            </a>
                        </div>
                    </div>
                    <!--/ Form Course Modal -->
                </div>
            </section>
        </div>
    @endsection
@endcan
