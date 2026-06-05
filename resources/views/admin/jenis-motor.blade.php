@extends('layouts.admin')
@section('title','Jenis Motor')
@section('header','Jenis Motor')
@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
    <span class="info-badge">{{ $jenisList->count() }} jenis motor</span>
    <a href="{{ route('admin.jenis-motor.create') }}" class="btn btn-primary">+ Tambah Jenis Motor</a>
</div>

<div class="filter-bar" style="margin-bottom:16px;">
    <input type="text" id="searchJenis" class="form-control" style="flex:1;min-width:180px;" placeholder="Cari nama atau merk...">
    <select id="filterMerkJenis" class="form-control" style="width:140px;">
        <option value="">Semua Merk</option>
        <option>Honda</option><option>Yamaha</option><option>Suzuki</option><option>Kawasaki</option>
    </select>
</div>

<div class="card">
    <div class="tabel-wrap">
        <table>
            <thead>
                <tr>
                    <th>Foto</th><th>Nama Jenis</th><th>Merk</th><th>Tipe</th>
                    <th>Harga/Hari</th><th>Total Unit</th><th>Tersedia</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody id="jenisTableBody">
                @forelse($jenisList as $j)
                <tr>
                    <td>
                        @if($j->foto)
                            <img src="{{ asset('storage/motors/'.$j->foto) }}" style="width:48px;height:40px;object-fit:cover;border-radius:8px;">
                        @else
                            <div class="foto-placeholder">M</div>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $j->nama_jenis }}</td>
                    <td>{{ $j->merk }}</td>
                    <td>{{ $j->tipe }}</td>
                    <td style="color:var(--primary);font-weight:600;">Rp {{ number_format($j->harga_sewa,0,',','.') }}</td>
                    <td>{{ $j->motors_count }} unit</td>
                    <td>
                        <span class="badge {{ $j->tersedia_count > 0 ? 'badge-tersedia' : 'badge-disewa' }}">
                            {{ $j->tersedia_count }} tersedia
                        </span>
                    </td>
                    <td>
                        <div class="aksi-btn">
                            <a href="{{ route('admin.unit-motor.index',['jenis'=>$j->id]) }}" class="btn btn-sm btn-success">Unit</a>
                            <a href="{{ route('admin.jenis-motor.edit',$j->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.jenis-motor.destroy',$j->id) }}" method="POST" onsubmit="return confirm('Hapus jenis motor ini? Semua unit terkait akan ikut terhapus.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;padding:32px;color:#aaa;">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script>
    var elS = document.getElementById('searchJenis');
    var elM = document.getElementById('filterMerkJenis');
    function doFilter() { cariJenisMotorAdmin(elS.value, elM.value); }
    elS.addEventListener('input', doFilter);
    elM.addEventListener('change', doFilter);
</script>
@endsection
