@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <span class="text-sm font-medium text-[#5B6472]">Inventaris</span>
    <h1 class="font-['Space_Grotesk'] text-2xl font-semibold text-[#0B1220] mt-0.5">Edit produk</h1>
</div>
@include('admin.produk.form', ['formAction' => route('admin.produk.update', $produk), 'formMethod' => 'PUT', 'produk' => $produk])
@endsection