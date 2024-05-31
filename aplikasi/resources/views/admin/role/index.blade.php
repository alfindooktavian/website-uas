@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Roles</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Roles</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('roles.create')
                                <div class="input-group-prepend">
                                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary" style="padding-top: 10px;">
                                        <i class="fa fa-plus-circle"></i> TAMBAH
                                    </a>
                                </div>
                                @endcan
                                <input type="text" class="form-control" name="q" placeholder="cari berdasarkan nama role">
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
                                    <th scope="col" style="width: 15%">NAMA ROLE</th>
                                    <th scope="col">PERMISSIONS</th>
                                    <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td style="text-align: center">{{ $roles->firstItem() + $loop->index }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                        <button class="btn btn-sm btn-success mb-1 mt-1 mr-1">{{ $permission->name }}</button>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @can('roles.edit')
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        @endcan
                                        @can('roles.delete')
                                        <button onClick="deleteRole({{ $role->id }})" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $roles->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    //ajax delete
    function deleteRole(id) {
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
                $.ajax({
                    url: "{{ url('admin/role') }}/" + id,
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
                    }
                });
            } else {
                return true;
            }
        });
    }
</script>
@endsection
