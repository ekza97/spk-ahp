@php
    $urut = 0;
@endphp
@if ($jenis == 'kriteria')
    <form action="{{ route('bobot-kriteria.store') }}" method="post">
    @else
        <form action="{{ route('bobot-alternatif.store') }}" method="post">
@endif
@csrf
<table class="table table-bordered table-hover">
    <thead>
        <tr class="bg-light">
            <th colspan="2" class="text-capitalize text-center">Pilih yang lebih penting</th>
            <th width="60" class="text-center">Nilai Perbandingan</th>
        </tr>
    </thead>
    <tbody>
        @for ($x = 0; $x <= $n - 2; $x++)
            @for ($y = $x + 1; $y <= $n - 1; $y++)
                @php
                    $urut++;
                @endphp
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pilih{{ $urut }}"
                                id="pilihan1{{ $urut }}" value="1" checked>
                            <label class="form-check-label" for="pilihan1{{ $urut }}">
                                {{ $pilihan[$x] }}
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pilih{{ $urut }}"
                                id="pilihan2{{ $urut }}" value="2">
                            <label class="form-check-label" for="pilihan2{{ $urut }}">
                                {{ $pilihan[$y] }}
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="number" min="1" max="9" minlength="1" maxlength="1"
                                class="form-control" name="bobot{{ $urut }}"
                                value="{{ old('bobot' . $urut, $jenis == 'kriteria' ? Helper::getNilaiPerbandinganKriteria($x, $y) : Helper::getNilaiPerbandinganAlternatif($x, $y, $jenis - 1)) }}"
                                required>
                        </div>
                    </td>
                </tr>
            @endfor
        @endfor
    </tbody>
</table>
@if (Helper::getJumlah('kriteria') >= 3)
    <div>
        <input type="hidden" name="jenis" value="{{ $jenis }}">
        {{-- <input class="ui submit button" type="submit" name="submit" value="SUBMIT"> --}}
        <button type="submit" class="btn btn-primary btn-block">
            <i class="bi bi-save"></i>
            Simpan dan Lihat Matriks
        </button>
    </div>
@endif
</form>
