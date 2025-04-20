@include('layout.header', ['title' => 'Dashboard Periksa'])
<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
    <li class="nav-item menu-open">
      <a href="{{ route('dashboardDokter') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('periksaDokter') }}" class="nav-link active">
        <i class="nav-icon fas fa-search"></i>
        <p>
          Periksa
          <span class="right badge badge-danger">New</span>
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('obatDokter') }}" class="nav-link">
        <i class="nav-icon fas fa-vials"></i>
        <p>
          Obat
          <span class="right badge badge-danger">New</span>
        </p>
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
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0">Dashboard</h1> -->
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Periksa</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Daftar Pasien</h3>

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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Pasien</th>
                    <th>Catatan</th>
                    <th>Biaya Periksa</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($periksa as $p)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->pasien->nama }}</td>
                    <td>{{ $p->catatan }}</td>
                    <td>Rp. {{ number_format($p->biaya_periksa, 0, ',', '.') }}</td>
                    <td>
                      <button class="btn btn-warning btn-sm"
                        data-toggle="modal"
                        data-target="#editModal"
                        data-id="{{ $p->id }}"
                        data-nama="{{ $p->pasien->nama }}"
                        data-tgl="{{ $p->tgl_periksa }}"
                        data-catatan="{{ $p->catatan }}"
                        data-biaya="{{ $p->biaya_periksa }}">
                        Edit
                      </button>
                    </td>
                  </tr>
                  @endforeach
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
<!-- Modal Edit Pemeriksaan -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="" id="formEditPeriksa">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Pemeriksaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Pasien</label>
            <input type="text" id="nama" name="nama" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Tanggal Periksa</label>
            <input type="date" name="tgl_periksa" id="tgl_periksa" class="form-control">
          </div>
          <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Pilih Obat</label>
            <select id="obat" class="form-control">
              @foreach ($obats as $obat)
              <option value="{{ $obat->id }}"
                data-nama="{{ $obat->nama_obat }}"
                data-kemasan="{{ $obat->kemasan }}"
                data-harga="{{ $obat->harga }}">
                {{ $obat->nama_obat }} [{{ $obat->kemasan }}] [Rp. {{ number_format($obat->harga, 0, ',','.') }}]
              </option>
              @endforeach
            </select>
          </div>

          <div id="daftar-obat" class="form-group mt-3">
            <ul id="listObat" class="list-group"></ul>
          </div>

          <div class="form-group">
            <label>Biaya Periksa</label>
            <input type="text" id="biaya_periksa_view" value="Rp. 150.000" class="form-control" readonly>
            <input type="hidden" name="biaya_periksa" id="biaya_periksa">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    let hargaAwal = 150000;
    let totalObat = 0;

    function updateTotal() {
      const total = hargaAwal + totalObat;
      $('#biaya_periksa').val(total);
      $('#biaya_periksa_view').val('Rp. ' + total.toLocaleString('id-ID'));
    }

    $('#editModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var nama = button.data('nama');
      var tgl = button.data('tgl');
      var catatan = button.data('catatan');
      var biaya = button.data('biaya');

      var modal = $(this);
      modal.find('#nama').val(nama);
      modal.find('#tgl_periksa').val(tgl);
      modal.find('#catatan').val(catatan);

      totalObat = 0;
      $('#listObat').empty();
      modal.find('#biaya_periksa').val(hargaAwal);

      var actionUrl = '/dokter/periksa/' + id;
      modal.find('#formEditPeriksa').attr('action', actionUrl);
    });

    $('#obat').on('change', function() {
      const selected = $('#obat option:selected');
      const id = selected.val();
      const nama = selected.data('nama');
      const kemasan = selected.data('kemasan');
      const harga = selected.data('harga');

      if ($('#obat-item-' + id).length === 0) {
        const html = `
          <li class="list-group-item d-flex justify-content-between align-items-center" id="obat-item-${id}">
            ${nama} (${kemasan}) - Rp. ${harga}
            <input type="hidden" name="obats[]" value="${id}">
            <button type="button" class="btn btn-sm btn-danger btnHapusObat" data-id="${id}" data-harga="${harga}">Hapus</button>
          </li>
        `;
        $('#listObat').append(html);
        totalObat += harga;
        updateTotal();
      }
    });

    $(document).on('click', '.btnHapusObat', function() {
      const id = $(this).data('id');
      const harga = $(this).data('harga');
      $('#obat-item-' + id).remove();
      totalObat -= harga;
      updateTotal();
    });
  });
</script>

<!-- /.content-wrapper -->
@include('layout.footer')