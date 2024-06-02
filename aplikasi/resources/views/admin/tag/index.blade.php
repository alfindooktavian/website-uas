@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tags</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-tags"></i> Tags</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tags.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('tags.create')
                                <div class="input-group-prepend">
                                    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                </div>
                                @endcan
                                <input type="text" class="form-control" name="q" placeholder="Cari berdasarkan nama tag">
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
                                    <th scope="col">NAMA TAG</th>
                                    <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td class="text-center">
                                        @can('tags.edit')
                                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @endcan
                                        @can('tags.delete')
                                        <button onClick="deleteTag({{ $tag->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $tags->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Ajax delete
    function Delete(id) {
        var token = "{{ csrf_token() }}";
        swal({
            title: "APAKAH KAMU YAKIN ?",
            text: "INGIN MENGHAPUS DATA INI!",
            icon: "warning",
            buttons: ['TIDAK', 'YA'],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                // Ajax delete
                $.ajax({
                    url: "{{ route('admin.tags.index') }}/" + id,
                    data: {
                        "_token": token,
                        "_method": 'DELETE'
                    },
                    type: 'POST',
                    success: function(response) {
                        if (response.status == "success") {
                            swal({
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false,
                                showCancelButton: false,
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
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false,
                            }).then(function() {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                return true;
            }
        })
    }
</script>
@endsection
