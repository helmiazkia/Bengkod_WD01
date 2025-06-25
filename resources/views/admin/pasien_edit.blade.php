{{-- resources/views/admin/pasien_edit.blade.php --}}
@include('layout.header', ['title' => 'Edit Pasien'])

<!-- Sidebar -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
    <li class="nav-item">
      <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.dokter.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user-md"></i>
        <p>Kelola Dokter</p>
      </a>
    </li>
    <li class="nav-item menu-open">
      <a href="{{ route('admin.pasien.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-users"></i>
        <p>Kelola Pasien</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.poli.index') }}" class="nav-link">
        <i class="nav-icon fas fa-hospital-symbol"></i>
        <p>Kelola Poli</p>
      </a>
    </li>
     <li class="nav-item">
      <a href="{{ route('admin.obat.index') }}" class="nav-link">
        <i class="nav-icon fas fa-capsules"></i>
        <p>Kelola Obat</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </li>
  </ul>
</nav>
</div>
</aside>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Edit Data Pasien</h1>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Form Edit Pasien</h3>
        </div>
        <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
          @csrf @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label>No RM</label>
              <input type="text" class="form-control" value="{{ $pasien->no_rm }}" disabled>
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" value="{{ old('nama', $pasien->nama) }}" class="form-control" required>
            </div>
            <div class="form-group">
              <label>No KTP</label>
              <input type="text" name="no_ktp" value="{{ old('no_ktp', $pasien->no_ktp) }}" class="form-control" required>
            </div>
            <div class="form-group">
              <label>No HP</label>
              <input type="text" name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea name="alamat" class="form-control" required>{{ old('alamat', $pasien->alamat) }}</textarea>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" value="{{ old('email', $pasien->user->email) }}" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Password <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small></label>
              <input type="password" name="password" class="form-control" placeholder="Isi jika ingin mengganti password">
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-warning">Perbarui</button>
            <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary float-right">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>

@include('layout.footer')
