@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kategori</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-folder"></i> Kategori</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('categories.create')
                                <div class="input-group-prepend">
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                </div>
                                @endcan
                                <input type="text" class="form-control" name="q" placeholder="cari berdasarkan nama kategori">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                    <th scope="col">NAMA KATEGORI</th>
                                    <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-center">
                                        @can('categories.edit')
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @endcan
                                        @can('categories.delete')
                                        <button onClick="deleteCategory({{ $category->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $categories->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function deleteCategory(id) {
    var token = "{{ csrf_token() }}";
    swal({
        title: "APAKAH KAMU YAKIN ?",
        text: "INGIN MENGHAPUS DATA INI!",
        icon: "warning",
        buttons: ['TIDAK', 'YA'],
        dangerMode: true,
    }).then(function(isConfirm) {
        if (isConfirm) {
            //ajax delete
            jQuery.ajax({
                url: "{{ url('admin/categories') }}/" + id,
                type: 'POST',
                data: {
                    "_token": token,
                    "_method": "DELETE"
                },
                success: function(response) {
                    if (response.status == "success") {
                        swal({
                            title: 'BERHASIL!',
                            text: 'DATA BERHASIL DIHAPUS!',
                            icon: 'success',
                            timer: 1000,
                            buttons: false,
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        swal({
                            title: 'GAGAL!',
                            text: 'DATA GAGAL DIHAPUS!',
                            icon: 'error',
                            timer: 1000,
                            buttons: false,
                        }).then(function() {
                            location.reload();
                        });
                    }
                },
                error: function(response) {
                    swal({
                        title: 'GAGAL!',
                        text: 'TERJADI KESALAHAN!',
                        icon: 'error',
                        timer: 1000,
                        buttons: false,
                    });
                }
            });
        }
    });
}

</script>
@stop
