@extends('layouts.admin')
@section('content')<div class="page-heading"><div><p class="eyebrow">INVENTARIS</p><h1>Tambah produk</h1></div></div>@include('admin.produk.form', ['formAction' => route('admin.produk.store'), 'formMethod' => 'POST', 'produk' => null])@endsection
