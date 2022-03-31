<!DOCTYPE html>
@extends('admin.layout.layout')

@section('title')
    <title>Create Discount</title>
@endsection

@section('name_page')
<div class="flex-row d-flex align-items-center">
    <a class="text-dark" href="{{route('discount.index')}}">Discount</a> 
    <span class="text-dark fw-bolder">&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
      </svg>&nbsp;
    </span>
    <a class="text-primary fw-bolder" href="{{route('discount.create')}}">Create Discount</a>
</div>
@endsection
@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" method="POST" action="{{ route('discount.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                @if (Session::has('product_has_discount'))
                                    <div style="font-size: 14px" class="alert alert-danger fw-bold discount_alert mb-4">{{ Session::get('product_has_discount') }}</div>
                                    {{ Session::put('product_has_discount', '') }}
                                @endif
                                @if (Session::has('category_has_discount'))
                                    <div style="font-size: 14px" class="alert alert-danger fw-bold discount_alert mb-4">{{ Session::get('category_has_discount') }}</div>
                                    {{ Session::put('category_has_discount', '') }}
                                @endif
                                <div class="row">
                                    <div class="col-md-8 form-group has-icon-left">
                                        <div>
                                            <label for="first-name-icon">Name of Discount</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control text-dark"
                                                    id="first-name-icon" name="name" value="{{ old('name') }}">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-tags"></i>
                                                </div>
                                            </div>
                                            @if (Session::has('name'))
                                                <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('name') }}</div>
                                                {{ Session::put('name', '') }}
                                            @endif
                                            @if (Session::has('duplicate_name'))
                                                <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('duplicate_name') }}</div>
                                                {{ Session::put('duplicate_name', '') }}
                                            @endif
                                        </div>
                                        <div class="mt-4">
                                            <label for="description">Description of Discount</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control text-dark"
                                                    id="description" name="description" value="{{ old('description') }}">
                                                <div class="form-control-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="discount_type">Type of Discount</label>
                                                    <select name="discount_type" id="discount_type" class="form-select">
                                                        @if (old('discount_type') === 'Price')
                                                            <option value="">Choose</option>
                                                            <option selected value="Price">Discount by Price $</option>
                                                            <option value="Percent">Discount by Percent %</option>
                                                        @elseif (old('discount_type') === 'Percent')
                                                            <option value="">Choose</option>
                                                            <option value="Price">Discount by Price $</option>
                                                            <option selected value="Percent">Discount by Percent %</option>
                                                        @elseif (empty(old('discount_type')))
                                                            <option value="">Choose</option>
                                                            <option value="Price">Discount by Price $</option>
                                                            <option value="Percent">Discount by Percent %</option>
                                                        @endif
                                                    </select>
                                                    @if (Session::has('discount_type'))
                                                        <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('discount_type') }}</div>
                                                        {{ Session::put('discount_type', '') }}
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <div class="discount_percent" hidden>
                                                        <label for="discount_percent">Discount</label>
                                                        <div class="position-relative">
                                                            <input type="text" 
                                                                    class="form-control text-dark" 
                                                                    id="discount_percent" name="discount_percent" 
                                                                    value="{{ old('discount_percent') }}"
                                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                            <div class="form-control-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-percent" viewBox="0 0 16 16">
                                                                    <path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0zM4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="error_percent" style="font-size: 14px" hidden></div>
                                                       
                                                    </div>
                                                    <div class="discount_price" hidden>
                                                        <label for="discount_price">Discount</label>
                                                        <div class="position-relative">
                                                            <input type="text" 
                                                                    class="form-control text-dark" 
                                                                    id="discount_price" name="discount_price" 
                                                                    value="{{ old('discount_price') }}"
                                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                            <div class="form-control-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                                                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                                                  </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if (Session::has('discount_price'))
                                                        <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('discount_price') }}</div>
                                                        {{ Session::put('discount_price', '') }}
                                                    @endif
                                                    @if (Session::has('discount_percent'))
                                                        <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('discount_percent') }}</div>
                                                        {{ Session::put('discount_percent', '') }}
                                                    @endif
                                                    @if (Session::has('percent_illegal'))
                                                        <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('percent_illegal') }}</div>
                                                        {{ Session::put('percent_illegal', '') }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="apply_for">Apply For</label>
                                                    <select name="apply_for" id="apply_for" class="form-select">
                                                        @if (old('apply_for') === 'Category')
                                                            <option value="">Choose</option>
                                                            <option selected value="Category">Category</option>
                                                            <option value="Product">Product</option>
                                                        @elseif (old('apply_for') === 'Product')
                                                            <option value="">Choose</option>
                                                            <option value="Category">Category</option>
                                                            <option selected value="Product">Product</option>
                                                        @elseif (empty(old('apply_for')))
                                                            <option value="">Choose</option>
                                                            <option value="Category">Category</option>
                                                            <option value="Product">Product</option>
                                                        @endif
                                                    </select>
                                                    @if (Session::has('apply_for'))
                                                        <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('apply_for') }}</div>
                                                        {{ Session::put('apply_for', '') }}
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <div class="list_category form-group" hidden>
                                                        <label for="category_id">List Category</label>
                                                        <div class="">
                                                            <select style="width:100%;" name="category_id[]" id="category_id" class="form-control discount_select border" multiple="multiple" >
                                                                {!! $htmlOption !!}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="list_product form-group" hidden>
                                                        <label for="product_id">List Product</label>
                                                        <div class="">
                                                            <select style="width:100%" name="product_id[]" id="product_id" class="form-control discount_select" multiple="multiple" >
                                                                @foreach($products as $value)
                                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if (Session::has('category_id'))
                                                        <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('category_id') }}</div>
                                                        {{ Session::put('category_id', '') }}
                                                    @endif
                                                    @if (Session::has('product_id'))
                                                        <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('product_id') }}</div>
                                                        {{ Session::put('product_id', '') }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="date_start">Start date</label>
                                                <input id="date_start" name="date_start" type="datetime-local" value="{{ old('date_start') }}" class="form-control text-dark">
                                                @if (Session::has('date_start'))
                                                    <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('date_start') }}</div>
                                                    {{ Session::put('date_start', '') }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <label for="date_end">End date</label>
                                                <input id="date_end" name="date_end" type="datetime-local" value="{{ old('date_end') }}" class="form-control text-dark">
                                                @if (Session::has('date_end_lower_date_now'))
                                                    <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('date_end_lower_date_now') }}</div>
                                                    {{ Session::put('date_end_lower_date_now', '') }}
                                                @endif
                                                @if (Session::has('date_end_lower_date_start'))
                                                    <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('date_end_lower_date_start') }}</div>
                                                    {{ Session::put('date_end_lower_date_start', '') }}
                                                @endif
                                                @if (Session::has('date_end'))
                                                    <div style="font-size: 14px" class="text-danger fw-bold discount_alert mt-2">{{ Session::get('date_end') }}</div>
                                                    {{ Session::put('date_end', '') }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="col-12 d-flex justify-content-between">
                                        <div>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Create</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                        <div>
                                            <a href="{{ route('discount.index') }}" class="btn btn-danger">Move back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
<script type="text/javascript" src="{{URL::asset('backend/js/jquery-3.6.0.min.js')}}"></script>
<script type='text/javascript' src="{{URL::asset('backend/js/tags.js')}}"></script>
<script type='text/javascript' src="{{URL::asset('backend/js/discount/main.js')}}"></script>
