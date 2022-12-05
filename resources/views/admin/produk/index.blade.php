@extends('admin.layout')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Data Produk</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash')
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Mitra</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @php
                            $i =0;
                            @endphp
                            @forelse($data as $row)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{$row->nama produk}}</td>
                                <td>{{$row->kategori}}</td>
                                <td>{{$row->mitra}}</td>
                                <td>{{$row->harga}}</td>
                                <td>{{$row->stok}}</td>
                                <td class="text-center">
                                    <form action="{{route('produk.destroy',Crypt::encrypt($row->id))}}" method="POST">
                                        <a class="btn btn-warning btn-sm" href="{{route('produk.edit',Crypt::encrypt($row->id))}}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">Data Tidak Ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
                <div class="card-footer text-right">
                    <a href="{{route('produk.create')}}" class="btn btn-primary">Tambah Data Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection