@extends('layouts.admin')
@section('content')<div class="page-heading"><div><p class="eyebrow">INVENTARIS</p><h1>Edit produk</h1></div></div>@include('admin.produk.form', ['formAction' => route('admin.produk.update', $produk), 'formMethod' => 'PUT', 'produk' => $produk])@endsection
