<!DOCTYPE html>
@extends('admin.layout.layout')

@section('title')
    <title>Discounts</title>
@endsection

@section('name_page')
    <h3>Discount</h3>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <a href="{{ route('discount.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg> Create Discount
                </a>
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success discount_alert mt-3">{!! Session::get('success') !!}</div>
                {{ Session::put('success', '') }}
            @endif
            <hr>
            <div class="d-flex justify-content-end mx-2">
                {{-- <form action="{{  route('product.search') }}" method="GET" class="form-inline d-flex flex-row">
                    <fieldset class="form-group me-3">
                        <label for="category_filter">Category</label>
                        <select class="form-select fw-bold" name="category_filter" id="category_filter">
                            <option value=""> Choose </option>
                            {!! $htmlOption !!}
                        </select>
                    </fieldset>
                    <fieldset class="form-group me-3">
                        <label for="status_filter">Status</label>
                        <select class="form-select fw-bold" name="status_filter" id="status_filter">
                            @if(isset($status) && $status === "Available")
                                <option value=""> Choose </option>  
                                <option selected value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            @endif
                            @if(isset($status) && $status === "Unavailable")
                                <option value=""> Choose </option>  
                                <option value="Available">Available</option>
                                <option selected value="Unavailable">Unavailable</option>
                            @endif
                            @if(empty($status))
                                <option value=""> Choose </option>  
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            @endif
                        </select>
                    </fieldset>
                    <fieldset class="form-group me-3">
                        <label for="sort_filter">Sort</label>
                        <select class="form-select fw-bold" name="sort_filter" id="sort_filter">
                            @if(isset($sort) && $sort === 'latest')
                                <option value=""> Choose </option>  
                                <option selected value="latest">Newest</option>
                                <option value="oldest">Oldest</option>
                                <option value="asc">Price: Low to High</option>
                                <option value="desc">Price: High to Low</option>
                            @endif
                            @if(isset($sort) && $sort === 'oldest')
                                <option value=""> Choose </option>  
                                <option value="latest">Newest</option>
                                <option selected value="oldest">Oldest</option>
                                <option value="asc">Price: Low to High</option>
                                <option value="desc">Price: High to Low</option>
                            @endif
                            @if(isset($sort) && $sort === 'asc')
                                <option value=""> Choose </option>  
                                <option value="latest">Newest</option>
                                <option value="oldest">Oldest</option>
                                <option selected value="asc">Price: Low to High</option>
                                <option value="desc">Price: High to Low</option>
                            @endif
                            @if(isset($sort) && $sort === 'desc')
                                <option value=""> Choose </option>  
                                <option value="latest">Newest</option>
                                <option value="oldest">Oldest</option>
                                <option value="asc">Price: Low to High</option>
                                <option selected value="desc">Price: High to Low</option>
                            @endif
                            @if(empty($sort))
                                <option value=""> Choose </option>  
                                <option value="latest">Newest</option>
                                <option value="oldest">Oldest</option>
                                <option value="asc">Price: Low to High</option>
                                <option value="desc">Price: High to Low</option>
                            @endif
                        </select>
                    </fieldset>
                    <fieldset class="form-group d-flex align-items-end">
                        <button class="btn btn-outline-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                          </svg> Filter</button>
                    </fieldset>
                </form>  --}}
            </div>
            <table class="table table-striped" id="table_discount">
                <thead>
                    <tr>
                        <th class="text-center" ># &nbsp;</th>
                        <th>Name</th>
                        <th>Apply For</th>
                        <th>Type</th>
                        <th>Discount</th>
                        <th class="text-center">Start date</th>
                        <th class="text-center">End date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody >
                    @php
                        $stt = 1;
                    @endphp
                    @foreach ($discounts as $item)
                    <tr >
                        <td class="text-center">{{ $stt++ }}</td>
                        <td class="text-dark fw-bolder">{{ $item->name }}</td>
                        <td class="">{{ $item->apply_for }}</td>
                        <td class="">Discount by {{ $item->discount_type }}</td>
                        <td class="text-danger fw-bolder fst-italic">
                            @if ($item->discount_type == 'Percent')
                                - {{ $item->discount }} %
                            @endif
                            @if ($item->discount_type == 'Price')
                                - {{ $item->discount }} $
                            @endif
                        </td>
                        <td class="text-center">{{ date('d-m-Y | H:i', strtotime($item->date_start)) }}</td>
                        <td class="text-center">{{ date('d-m-Y | H:i', strtotime($item->date_end)) }}</td>
                        <td class="text-center">   
                            {{-- <a href="{{ route('specification.name',['id'=>$item->id])}}">get name </a>  --}}
                            <a class="text-primary border-end border-dark pe-1" 
                                href="#"  
                                data-bs-toggle="modal" data-bs-target="#modalDetailDiscount"
                                onclick="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </a>
                            <a href="" class="text-success border-end border-dark pe-1 ps-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a> 
                            <a class="text-danger action_delete ps-2" data-url="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- code modal --}}
    <section>
        <!-- Modal -->
        <div class="modal fade" id="modalDetailDiscount" tabindex="-1" aria-labelledby="discount-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <span class="text-white fw-bolder modal-title" id="myModalLabel150">Discount Detail</span>
                        <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                            </svg>
                        </button>
                    </div>
                    {{-- code từ đây  --}}
                    <div class="modal-body border-0" id="modal-discount-detail"></div>
                    {{-- end code thông báo  --}}
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<div class="content-wrapper" id="preloader">
</div>
@endsection
<script type="text/javascript" src="{{URL::asset('backend/js/jquery-3.6.0.min.js')}}"></script>
<script type="text/javascript" src={{URL::asset('backend/js/actionDelete.js')}}></script>
<script type='text/javascript' src="{{URL::asset('backend/js/discount/main.js')}}"></script>



