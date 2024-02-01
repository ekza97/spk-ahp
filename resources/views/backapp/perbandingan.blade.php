@php
    $urut = 0;
@endphp
<form action="bobot-kriteria/matriks" method="post">
    @csrf
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th colspan="2" class="text-capitalize text-center">Pilih yang lebih penting</th>
                <th width="60" class="text-center">Nilai Perbandingan</th>
            </tr>
        </thead>
        <tbody>
            @for ($x = 0; $x <= ($n-2); $x++)
                @for ($y = ($x+1); $y <= ($n-1); $y++)
                @php
                    $urut++;
                @endphp               
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pilih{{ $urut }}" id="pilihan1{{ $urut }}" value="1" checked>
                            <label class="form-check-label" for="pilihan1{{ $urut }}">
                                {{ $pilihan[$x] }}
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pilih{{ $urut }}" id="pilihan2{{ $urut }}" value="2">
                            <label class="form-check-label" for="pilihan2{{ $urut }}">
                                {{ $pilihan[$x] }}
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="number" min="1" max="9" minlength="1" maxlength="1" class="form-control" name="bobot{{ $urut }}" value="{{ $kriteria=='kriteria'?Helper::getNilaiPerbandinganKriteria($x,$y):Helper::getNilaiPerbandinganAlternatif($x,$y,($jenis-1)) }}" required>
                        </div>
                        <div class="field">
                        </div>
                    </td>
                </tr>
                @endfor
            @endfor
        </tbody>
    </table>
    <div>
        <input type="text" name="jenis" value="{{ $jenis }}" hidden>
        {{-- <input class="ui submit button" type="submit" name="submit" value="SUBMIT"> --}}
        <button type="submit" class="btn btn-primary btn-block">
            <i class="bi bi-save"></i>
            Simpan dan Lihat Matriks
        </button>
    </div>
</form>
<div>
    <a href="bobot-kriteria/matriks" class="btn btn-info btn-block">
        <i class="bi bi-save"></i>
        Simpan dan Lihat Matriks
    </a>
</div>
