@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-people"></i> Kelola User</h4>
    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah User
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-x-circle"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($user->role == 'petugas')
                                <span class="badge bg-primary">Petugas</span>
                            @else
                                <span class="badge bg-success">Customer</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.user.show', $user->id) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.user.edit', $user->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.user.destroy', $user->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data user</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection