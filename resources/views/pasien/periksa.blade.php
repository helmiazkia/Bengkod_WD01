@include('layout.header', ['title' => 'Dashboard Periksa'])

<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item menu-open">
      <a href="{{ route('dashboardPasien') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('periksaPasien') }}" class="nav-link active">
        <i class="nav-icon fas fa-search"></i>
        <p>Periksa</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-lock"></i>
        <p>Logout</p>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Periksa</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      
      <!-- Form Periksa -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Form Periksa</h3>
        </div>
        <form action="{{ route('storePeriksa') }}" method="POST">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label>Nama Anda</label>
              <input type="text" class="form-control" value="{{ Auth::user()->nama }}" readonly>
            </div>
            <div class="form-group">
              <label for="id_dokter">Pilih Dokter</label>
              <select class="form-control" id="id_dokter" name="id_dokter" required>
                @foreach ($showDokter as $dokter)
                  <option value="{{ $dokter->id }}">dr. {{ $dokter->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Kirim Permintaan Periksa</button>
          </div>
        </form>
      </div>

      <!-- Riwayat Periksa -->
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Riwayat Periksa</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Dokter</th>
                    <th>Tanggal Periksa</th>
                    <th>Biaya Periksa</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($periksa as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>dr. {{ $item->dokter->nama }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td> <!-- Tanggal berdasarkan created_at -->
                    <td>
                      @if ($item->biaya_periksa)
                        Rp. {{ number_format($item->biaya_periksa, 0, ',', '.') }}
                      @else
                        N/A
                      @endif
                    </td>
                    <td>
                      <span class="badge badge-success">
                        Menunggu Pemeriksaan
                      </span>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center">Belum ada riwayat periksa.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('layout.footer')
  