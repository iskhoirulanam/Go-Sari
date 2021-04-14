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
            <form method="post" action="{{ route('garbage-categories.update', $category) }}" class="needs-validation"
              novalidate="">@csrf
              {{ method_field('PUT') }}
              <div class="card-header">
                <h4>JavaScript Validation</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Nama Kategori</label>
                  <input type="text" class="form-control" name="category_name" value="{{ $category->category_name }}"
                    required="">
                  <div class="invalid-feedback">
                    Isian masih kosong
                  </div>
                </div>
                <div class="form-group">
                  <label>Harga</label>
                  <input type="number" class="form-control" value="{{ $category->price }}" name="price" required="">
                  <div class="invalid-feedback">
                    Isian masih kosong
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
