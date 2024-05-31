@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Users</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('users.create')
                                <div class="input-group-prepend">
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                </div>
                                @endcan
                                <input type="text" class="form-control" name="q" placeholder="cari berdasarkan nama user">
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
                                    <th scope="col">NAMA USER</th>
                                    <th scope="col">ROLE</th>
                                    <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $no => $user)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($users->currentPage()-1) * $users->perPage() }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $role)
                                        <label class="badge badge-success">{{ $role }}</label>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('users.edit')
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @endcan
                                        @can('users.delete')
                                        <button onClick="deleteUser({{ $user->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $users->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    // Fungsi untuk menghapus pengguna
    function deleteUser(id) {
        var token = "{{ csrf_token() }}";
        swal({
            title: "APAKAH KAMU YAKIN ?",
            text: "INGIN MENGHAPUS DATA INI!",
            icon: "warning",
            buttons: ['TIDAK', 'YA'],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                // Panggil AJAX untuk menghapus pengguna
                $.ajax({
                    url: "/admin/users/" + id,
                    data: {
                        "_token": token,
                        "_method": "DELETE"
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
                            }).then(function() {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        swal({
                            title: 'ERROR!',
                            text: 'Terjadi kesalahan saat menghapus data.',
                            icon: 'error',
                            timer: 1000,
                            showConfirmButton: false,
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
            } else {
                return true;
            }
        });
    }
</script>




@stop
