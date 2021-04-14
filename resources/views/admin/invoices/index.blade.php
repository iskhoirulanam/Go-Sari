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
                <table class="table table-striped table-bordered" id="invoiceTable">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #ID
                      </th>
                      <th>Invoice Code</th>
                      <th>Member</th>
                      <th>Bulan</th>
                      <th>Total</th>
                      <th>Batas Pembayaran</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                      <td>{{ $invoice->id }}</td>
                      <td>{{ $invoice->code }}</td>
                      <td>{{ ucfirst($invoice->user->name) }}</td>
                      <td>{{ $invoice->month }}</td>
                      <td>Rp. {{ number_format($invoice->total_amount) }}</td>
                      <td>
                        {{ date('d/M/Y', strtotime($invoice->payment_due)) }}, pukul
                        {{ date('H:i:s', strtotime($invoice->payment_due)) }}
                      </td>
                      <td>
                        @if($invoice->payment_status == 'paid')
                        <span class="badge badge-pill badge-success">{{ ucfirst($invoice->payment_status) }}</span>
                        @else
                        <span class="badge badge-pill badge-warning">{{ ucfirst($invoice->payment_status) }}</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-sm btn-info mr-1"
                          data-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                        <form style="display: inline-block;" action="{{ route('invoices.destroy', $invoice) }}"
                          method="post">
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
  $('#invoiceTable').DataTable();
});
</script>
@endsection
