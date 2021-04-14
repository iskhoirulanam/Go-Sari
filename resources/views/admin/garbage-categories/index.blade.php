@extends('layouts.admin.main')
@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>DataTables</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Modules</a></div>
        <div class="breadcrumb-item">DataTables</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">DataTables</h2>
      <p class="section-lead">
        We use 'DataTables' made by @SpryMedia. You can check the full documentation <a
          href="https://datatables.net/">here</a>.
      </p>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Basic DataTables</h4>
            </div>
            <div class="card-body">
              <div>
                <a href="{{ route('garbage-categories.create') }}" class="btn btn-sm btn-primary mr-1 mb-3"><i
                    class="fas fa-plus"></i> Tambah Data</a>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="category">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #ID
                      </th>
                      <th>Jenis Kategori</th>
                      <th>Harga</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                    <tr>
                      <td>{{ $category->id }}</td>
                      <td>{{ $category->category_name }}</td>
                      <td>{{ number_format($category->price) }}</td>
                      <td>
                        <a href="{{ route('garbage-categories.edit', $category) }}" class="btn btn-sm btn-primary mr-1"
                          data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <form style="display: inline-block;"
                          action="{{ route('garbage-categories.destroy', $category) }}" method="post">
                          @csrf @method('DELETE')
                          <button class="btn btn-sm btn-danger" type="submit" data-toggle="tooltip" title="Hapus"><i
                              class="fas fa-trash"></i></button>
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
<script>
$(document).ready(function() {
  $('#category').DataTable();
});
</script>
@endsection
