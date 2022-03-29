@extends('admin.layout.layout')

@section('title')
    <title>Product</title>
@endsection

@section('name_page')
    <h3>Product</h3>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <a href="{{ route('product.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg> Create Product
                </a>
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success product_alert mt-3">{!! Session::get('success') !!}</div>
                {{ Session::put('success', '') }}
            @endif
            <hr>
            <div class="d-flex justify-content-end mx-2">
                <form action="{{  route('product.search') }}" method="GET" class="form-inline d-flex flex-row">
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
                </form> 
            </div>
            <table class="table table-striped" id="table_product">
                <thead>
                    <tr>
                        <th class="text-center" ># </th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody >
                    @php
                        $stt = 1;
                    @endphp
                    @foreach ($products as $item)
                    <tr >
                        <td class="text-center">{{ $stt++ }}</td>
                        <td class="admin_product_img text-center"><img src="{{ $item->image_path }}" ></td>
                        <td class="text-dark fw-bolder">{{ $item->name }}</td>
                        <td class="text-success fw-bolder fst-italic">$ {{ $item->price }}</td>
                        <td>{{ optional($item->category)->name }}</td>
                        <td class="text-center">
                            @if ($item->status === "Available")
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-danger">Unavailable</span>
                            @endif
                        </td>
                        <td class="text-center">    
                            <a class="btn btn-primary" href="#"  data-bs-toggle="modal" data-bs-target="#modalDetailProduct"><i class="bi bi-eye"></i></a>
                            <a href="" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                            <a class="btn btn-danger action_delete" data-url="{{Route('product.delete', ['id'=>$item->id])}}"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <section>
        <!-- Modal -->
        <div class="modal fade" id="modalDetailProduct" tabindex="-1" aria-labelledby="product-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <span class="text-white fw-bolder modal-title" id="myModalLabel150">Product Detail</span>
                        <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                            </svg>
                        </button>
                    </div>
                    {{-- code từ đây  --}}
                    <div class="modal-body border-0" id="modal-product-detail"></div>
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
<script type='text/javascript' src="{{URL::asset('backend/js/product/main.js')}}"></script>
<script>

</script>

