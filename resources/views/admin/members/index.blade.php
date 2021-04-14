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
              <div class="table-responsive">
                <table id="memberTable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Status</th>
                      <th>Invoice</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>No. HP</th>
                      <th>Alamat</th>
                      <th>Kategori Limbah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($members as $member)
                    <tr>
                      <td>{{ $member->id }}</td>
                      <td>
                        @if($member->status == 0)
                        <button class="btn btn-round btn-sm btn-danger change-status px-2" data-id="{{ $member->id }}"
                          data-status="1" data-toggle="tooltip" title="Klik untuk aktifkan akun">Inactive
                        </button>
                        @else
                        <button class="btn btn-round btn-sm btn-success change-status px-2" data-id="{{ $member->id }}"
                          data-status="0" data-toggle="tooltip" title="Klik untuk non-aktifkan akun">Active
                        </button>
                        @endif
                      </td>
                      <td>
                        <?php
                          $currentInvoice = \App\Models\Invoice::where('user_id', $member->id)->where('month', $currentMonth)->first();
                        ?>
                        <a href="{{ route('members.create_invoice', $member->id) }}" class="btn btn-sm btn-success mr-1"
                          data-toggle="tooltip" title="Buat Invoice"><i class="fas fa-plus-circle"></i></a>
                        @if(!empty($currentInvoice))
                        <a href="" class="btn btn-sm btn-info mr-1" data-toggle="tooltip"
                          title="Detail invoice bulan ini"><i class="fas fa-info-circle"></i></a>
                        @endif
                      </td>
                      <td>{{ ucfirst($member->name) }}</td>
                      <td>{{ $member->nik }}</td>
                      <td>{{ $member->phone }}</td>
                      <td>{{ $member->address }}</td>
                      <td>{{ $member->garbageCategory->category_name }}</td>
                      <td>
                        <a href="" class="btn btn-sm btn-info mr-1" data-toggle="tooltip" title="Detail"><i
                            class="fas fa-info-circle"></i></a>
                        <a href="" class="btn btn-sm btn-primary mr-1" data-toggle="tooltip" title="Edit"><i
                            class="fas fa-pencil-alt"></i></a>
                        <form style="display: inline-block;" action="" method="post">
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
    $('#memberTable').DataTable();
    $('.change-status').click(function() {
      var member_id = $(this).data('id');
      var status = $(this).data('status');
      // alert('id ' + id);
      // alert('status ' + status);

      swal({
          title: 'Apakah Anda yakin?',
          text: 'Anda akan mengubah status akun member.',
          icon: 'warning',
          buttons: true,
          dangerMode: true,
        })
        .then((willChange) => {
          if (willChange) {
            $.ajax({
              type: "post",
              dataType: "json",
              url: '/admin/members/change-status',
              data: {
                'status': status,
                'member_id': member_id
              },
              success: function(data) {
                window.location.reload();
              }
            });
            swal('Status akun member berhasil dirubah.', {
              icon: 'success',
            });
          } else {
            swal('Status member tidak dirubah.');
          }
        });
    });
  });
  </script>
  @endsection
