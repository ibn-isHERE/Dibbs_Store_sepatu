@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-eye"></i> Detail User</h4>
    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Nama Lengkap</th>
                        <td>: {{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>: 
                            @if($user->role == 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($user->role == 'petugas')
                                <span class="badge bg-primary">Petugas</span>
                            @else
                                <span class="badge bg-success">Customer</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Terdaftar</th>
                        <td>: {{ $user->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Update</th>
                        <td>: {{ $user->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('admin.user.destroy', $user->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection