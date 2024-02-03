@extends('layouts.app')

@section('content')
    <div class="page-heading">
        @component('components.breadcrumb')
            @slot('menu')
                Dashboard
            @endslot
        @endcomponent
        <section class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header py-3">
                        <h3>Analitycal Hierarchy Process (AHP)</h3>
                    </div>
                    <div class="card-body">
                        <p>Analytic Hierarchy Process (AHP) merupakan suatu model pendukung keputusan yang dikembangkan oleh
                            Thomas L. Saaty. Model pendukung keputusan ini akan menguraikan masalah multi faktor atau multi
                            kriteria yang kompleks menjadi suatu hirarki. Hirarki didefinisikan sebagai suatu representasi
                            dari sebuah permasalahan yang kompleks dalam suatu struktur multi level dimana level pertama
                            adalah tujuan, yang diikuti level faktor, kriteria, sub kriteria, dan seterusnya ke bawah hingga
                            level terakhir dari alternatif.</p>
    
                        <p>AHP membantu para pengambil keputusan untuk memperoleh solusi terbaik dengan mendekomposisi
                            permasalahan kompleks ke dalam bentuk yang lebih sederhana untuk kemudian melakukan sintesis
                            terhadap berbagai faktor yang terlibat dalam permasalahan pengambilan keputusan tersebut. AHP
                            mempertimbangkan aspek kualitatif dan kuantitatif dari suatu keputusan dan mengurangi
                            kompleksitas suatu keputusan dengan membuat perbandingan satu-satu dari berbagai kriteria yang
                            dipilih untuk kemudian mengolah dan memperoleh hasilnya.</p>
    
                        <p>AHP sering digunakan sebagai metode pemecahan masalah dibanding dengan metode yang lain karena
                            alasan-alasan sebagai berikut :</p>
    
                        <ol>
                            <li>Struktur yang berhirarki, sebagai konsekuesi dari kriteria yang dipilih, sampai pada
                                subkriteria yang paling dalam.</li>
                            <li>Memperhitungkan validitas sampai dengan batas toleransi inkonsistensi berbagai kriteria dan
                                alternatif yang dipilih oleh pengambil keputusan.</li>
                            <li>Memperhitungkan daya tahan output analisis sensitivitas pengambilan keputusan.</li>
                        </ol>
    
                        <br>
    
                        <h3>Tabel Tingkat Kepentingan menurut Saaty (1980)</h3>
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
