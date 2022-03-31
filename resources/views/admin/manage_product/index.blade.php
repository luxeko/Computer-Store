<!DOCTYPE html>
@extends('admin.layout.layout')

@section('title')
    <title>Products</title>
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
                        <th class="text-center" ># &nbsp;</th>
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
                        <td>
                            @if (optional($item->getPriceUnit)->price_unit)
                                @if (optional($item->getPriceUnit)->date_end >= $currentDate && optional($item->getPriceUnit)->date_start <=$currentDate && optional($item->getPriceUnit)->date_end > optional($item->getPriceUnit)->date_start)
                                    <p class="text-danger fw-bold fst-italic">$ {{optional($item->getPriceUnit)->price_unit}}</p>  
                                @else
                                    <p class="text-success fw-bold fst-italic">$ {{$item->price}}</p>  
                                @endif
                            @else
                                <p class="text-success fw-bold fst-italic">$ {{$item->price}}</p>  
                            @endif
                        </td>
                        <td>{{ optional($item->category)->name }}</td>
                        <td class="text-center">
                            @if ($item->status === "Available")
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-danger">Unavailable</span>
                            @endif
                        </td>
                        <td class="text-center">   
                            {{-- <a href="{{ route('specification.name',['id'=>$item->id])}}">get name </a>  --}}
                            <a class="text-primary border-dark border-end pe-1" 
                                href="#"  
                                data-bs-toggle="modal" data-bs-target="#modalDetailProduct"
                                onclick="main({{$item->category_id}},{{$item->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </a>
                            <a href="" class="text-success border-dark  border-end pe-1 ps-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a> 
                            <a class="text-danger action_delete ps-2" data-url="{{Route('product.delete', ['id'=>$item->id])}}">
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
    let category_name = '';
    let thumbnails = '';
    let specification = '';
    let tag = '';
    function main(category_id, id){
        getSpecificationById(id);
        getCategoryById(category_id);
        getTagsById(id);
        getThumbnail(id);
        viewProductDetail(id);
    }
    function getSpecificationById(id){
        $.ajax({
            url:`/admin/products/getSpecificationById/${id}`,
            method: 'GET',
            success:(getSpecification)=>{
                let info_product = '';
                getSpecification.forEach(element => {
                    console.log(element.name);
                    info_product = 
                    `<tr>
                        <td class="table-secondary">${element.name}</td>
                        <td>${element.desc!=null ? element.desc : ""}</td>
                    </tr>`;
                    specification += info_product
                });
            }
        })
    }
    function getCategoryById(id){
        $.ajax({
            url:`/admin/products/getCategoryById/${id}`,
            method: 'GET',
            success:(category)=>{
                category_name = category.name;
            }
        })
    }
    function getTagsById(id){
        $.ajax({
            url:`/admin/products/getTagsById/${id}`,
            method:'GET',
            success:(getTag)=>{
                let get_name = '';
                getTag.forEach(element => {
                    get_name = 
                    `<li><a href="#" class="tag">${element.name}</a></li> `
                    tag += get_name;
                });
            }
        })
    }
    function getThumbnail(id){
        $.ajax({
            url:`/admin/products/getThumbnailById/${id}`,
            method:'GET',
            success:(getListThumbnail)=>{
                let getUrlThumbnail = '';
                getListThumbnail.forEach(element => {
                    getUrlThumbnail = 
                    ` <div class="small-img-col">
                        <img src="{{ '${element.thumbnails_path}'}}" width="100%" class="smallImg">
                    </div>`;
                    thumbnails += getUrlThumbnail;
                });
            }
        })
    }
    function viewProductDetail(id){
        let formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });
        let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        $.ajax({
            url:'/admin/products/details',
            method:'GET',
            data:{id:id},
            success:(product)=>{
                let printStatus = '';
                let statusOfProduct = product.status;
                if(statusOfProduct == 'Available' ){
                    printStatus = ` <p class="product-detail-status text-light position-absolute rounded" style="top: 10px; left: 1rem"><span class="ms-2 badge bg-success">${product.status}</span></p>`;
                }else{
                    printStatus = ` <p class="product-detail-status text-light position-absolute rounded" style="top: 10px; left: 1rem"><span class="ms-2 badge bg-danger">${product.status}</span></p>`;
                }
                let productDetail = 
                    `<div class="single-product small-container">
                        <div class="details_row">
                            <div class="details_col">
                                <div class="main-img-row position-relative ">
                                    <img src="{{ '${product.image_path}' }}" id="productImg"/>
                                    ${printStatus}
                                </div>
                                <div class="small-img-row">
                                    ${thumbnails}
                                </div>
                            </div>
                            <div class="details_col">
                                <div>
                                    <h4 class="text-capitalize mb-0">${product.name}</h4>
                                </div>
                                <div>
                                    <code class="mb-0" style="font-size: 12px"><span> Code: </span><span class="">${product.product_code}</span></code>
                                </div>
                                
                                <div class="mt-1">
                                    <p class="mb-0"><span> Price: </span><span class="ms-2 text-success fst-italic">${formatter.format(product.price)}</span></p>
                                </div>
                                <div class="mt-1">
                                    <p class="mb-0"><span> Category: </span><span class="ms-2 fw-bold">${category_name}</span></p>
                                </div>
                                <div class="mt-1">
                                    <p class="mb-0"><span> Add by: </span><span class="ms-2 fw-bold">Duc Anh</span></p>
                                </div>
                                <div class="mt-1">
                                    <p class="mb-0"><span> Created date: </span><span class="ml-2 fw-bold">${new Date(product.created_at).toLocaleDateString("en-US",options)}</span></p>
                                </div>
                                <div class="mt-1">
                                    <p class="mb-0"><span> Updated date: </span><span class="ml-2 fw-bold">${new Date(product.updated_at).toLocaleDateString("en-US",options)}</span></p>
                                </div>
                                <div class="mt-1">
                                    <ul class="tags">
                                        ${tag}
                                    </ul>
                                </div>
                                <hr style="background:#999">
                                <div class="mt-1">
                                    <h6 class="mb-2">Details: </h6>
                                    <div class="detail_desc" style="max-height: 250px;overflow-y: scroll" 
                                        ${product.desc}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="mb-2">Specification: </h6>
                    <div class="row mt-1">
                        <table class="col-md-12 table table-hover">
                            <tbody>
                                ${specification}
                            </tbody>
                        </table>
                    </div>
                    `;
                $('#modal-product-detail').html('').append(productDetail);
                thumbnails = '';
                specification = '';
                tag = '';
            }
        })
    }
</script>

