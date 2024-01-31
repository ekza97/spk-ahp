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
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Profile Views</h6>
                                        <h6 class="font-extrabold mb-0">112.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Followers</h6>
                                        <h6 class="font-extrabold mb-0">183.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Following</h6>
                                        <h6 class="font-extrabold mb-0">80.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Saved Post</h6>
                                        <h6 class="font-extrabold mb-0">112</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-primary" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="{{ asset('') }}assets/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Europe</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">862</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-europe"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-success" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="{{ asset('') }}assets/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">America</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">375</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-america"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="{{ asset('') }}assets/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Indonesia</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">1025</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-indonesia"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Comments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="{{ asset('') }}assets/images/faces/5.jpg">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">Cantik</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">Congratulations on your graduation!
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="{{ asset('') }}assets/images/faces/2.jpg">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">Ganteng</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">Wow amazing design! Can you make
                                                        another tutorial for
                                                        this design?</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
