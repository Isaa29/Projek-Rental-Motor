@extends('layouts.customer')
@section('title', 'Rental Motor - Rental Motor Jaya')

@section('content')
    <div class="page-wrap">

        <div class="page-hdr">
            <h1>Daftar Motor Rental</h1>
            <p>Pilih jenis motor sesuai kebutuhan perjalanan Anda</p>
        </div>

        {{-- Filter & Pencarian --}}
        <div class="filter-bar" style="margin-bottom:20px;">
            <input type="text" id="searchMotor" class="form-control" style="flex:1;min-width:180px;"
                placeholder="Cari nama motor atau merk...">
            <select id="filterMerk" class="form-control" style="width:140px;">
                <option value="">Semua Merk</option>
                @foreach ($merks as $m)
                    <option value="{{ $m }}">{{ $m }}</option>
                @endforeach
            </select>
            <select id="filterStatus" class="form-control" style="width:150px;">
                <option value="">Semua Status</option>
                <option value="tersedia">Tersedia</option>
                <option value="habis">Tidak Tersedia</option>
            </select>
        </div>

        {{-- Loading indicator --}}
        <div id="loadingMotor" style="display:none;text-align:center;padding:20px;color:var(--text);font-size:13px;">
            Memuat data...
        </div>

        {{-- Grid Motor --}}
        <div id="motorGrid" class="motor-grid">
            @forelse($jenisList as $jenis)
                <div class="motor-card">
                    <div class="motor-foto">
                        @if ($jenis->foto)
                            <img src="{{ asset('storage/motors/' . $jenis->foto) }}" alt="{{ $jenis->nama_jenis }}">
                        @else
                            &#128663;
                        @endif
                    </div>
                    <div class="motor-body">
                        <div class="motor-tersedia">
                            <h3 class="motor-nama">{{ $jenis->nama_jenis }}</h3>
                            @if ($jenis->tersedia_count > 0)
                                <span class="badge badge-tersedia">Tersedia</span>
                            @else
                                <span class="badge badge-disewa">Habis</span>
                            @endif
                        </div>

                        <p class="merk">
                            {{ $jenis->merk }} &bull; {{ $jenis->tipe }}
                        </p>

                        <p class="harga">
                            Rp {{ number_format($jenis->harga_sewa, 0, ',', '.') }}/hari
                        </p>
                        <div class="motor-aksi">
                            <a href="{{ route('customer.rental.show', $jenis->id) }}" class="btn-card-det">Detail</a>
                            @if ($jenis->tersedia_count > 0)
                                <a href="{{ route('customer.sewa.create', $jenis->id) }}" class="btn-card-sw">Sewa</a>
                            @else
                                <button disabled class="btn-card-off">Habis</button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column:1/-1;">
                    <div class="es-ico">&#128663;</div>
                    <h3>Belum Ada Motor</h3>
                    <p>Belum ada jenis motor yang terdaftar.</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        var elCari = document.getElementById('searchMotor');
        var elMerk = document.getElementById('filterMerk');
        var elStatus = document.getElementById('filterStatus');

        function jalankanFilter() {
            cariMotorCustomer(elCari.value, elMerk.value, elStatus.value);
        }

        elCari.addEventListener('input', jalankanFilter);
        elMerk.addEventListener('change', jalankanFilter);
        elStatus.addEventListener('change', jalankanFilter);
    </script>
@endsection
