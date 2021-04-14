@extends('layouts.admin.main')
@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Dusun</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Kelola Data</a></div>
        <div class="breadcrumb-item">Dusun</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Dusun</h4>
            </div>
            <div class="card-body">
              <div>
                <a href="{{ route('hamlets.create') }}" class="btn btn-sm btn-primary mr-1 mb-3"><i
                    class="fas fa-plus"></i> Tambah Data</a>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="hamletTable">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #ID
                      </th>
                      <th>Nama Dusun</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($hamlets as $hamlet)
                    <tr>
                      <td>{{ $hamlet->id }}</td>
                      <td>{{ $hamlet->hamlet_name }}</td>
                      <td>
                        <a href="{{ route('hamlets.edit', $hamlet) }}" class="btn btn-sm btn-primary mr-1"
                          data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <form style="display: inline-block;" action="{{ route('hamlets.destroy', $hamlet) }}"
                          method="post">
                          @csrf @method('DELETE')
                          <button class="btn btn-sm btn-danger" type="submit" data-toggle="tooltip" title="Hapus">
                            <i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@section('script')
@if (Session::has('success'))
<script>
iziToast.success({
  position: 'topRight',
  title: 'Sukses',
  message: '{{ Session::get("success") }}',
  timeout: 3000
});
</script>
@endif
<script>
$(document).ready(function() {
  $('#hamletTable').DataTable();
});
</script>
@endsection
