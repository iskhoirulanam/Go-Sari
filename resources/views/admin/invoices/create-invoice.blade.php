@extends('layouts.admin.main')
@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Form Validation</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Forms</a></div>
        <div class="breadcrumb-item">Form Validation</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Form Validation</h2>
      <p class="section-lead">
        Form validation using default from Bootstrap 4
      </p>
      <div class="row">
        <div class="col-12 col-md-8 col-lg-8">
          <div class="card">
            <form method="post" action="{{ route('invoices.store') }}" class="needs-validation" novalidate="">@csrf
              <div class="card-header">
                <h4>JavaScript Validation</h4>
              </div>
              <div class="card-body">
                <input type="hidden" name="user_id" value="{{$member->id}}">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" id="name" name="user_name" value="{{$member->name}}"
                    readonly />
                  <div class="invalid-feedback">
                    Isian masih kosong
                  </div>
                </div>
                <div class="form-group">
                  <label>No. Hp</label>
                  <input type="text" class="form-control" id="phone" name="user_phone" value="{{$member->phone}}"
                    readonly />
                  <div class="invalid-feedback">
                    Isian masih kosong
                  </div>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="email" name="user_email" value="{{$member->email}}"
                    readonly />
                  <div class="invalid-feedback">
                    Isian masih kosong
                  </div>
                </div>
                <div class="form-group">
                  <label>Kategori Sampah</label>
                  <input type="text" class="form-control" id="category"
                    value="{{$member->garbageCategory->category_name}}" readonly />
                  <div class="invalid-feedback">
                    Isian masih kosong
                  </div>
                </div>
                <div class="form-group">
                  <label>Jumlah Tagihan</label>
                  <input type="number" class="form-control" id="amount" name="total_amount"
                    value="{{ $member->garbageCategory->price }}" readonly />
                  <div class="invalid-feedback">
                    Isian masih kosong
                  </div>
                </div>
                <div class="form-group">
                  <label>Bulan</label>
                  <select class="form-control" id="month" name="month" required="">
                    <option selected value="">Pilih ...</option>
                    @foreach (range(1, 12) as $m)
                    <option value="{{ date('F Y', mktime(0, 0, 0, $m)) }}">{{ date('F - Y', mktime(0, 0, 0, $m)) }}
                    </option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Isian masih kosong
                  </div>
                </div>
                <div class="form-group">
                  <label>Batas Pembayaran</label>
                  <input type="datetime-local" class="form-control" id="dueTo" name="payment_due" required="" />
                  <div class="invalid-feedback">
                    Isian masih kosong
                  </div>
                </div>

              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@section('script')
<script>
$.validate({
  form: '#validation_style',
  modules: 'security'
});
@endsection
