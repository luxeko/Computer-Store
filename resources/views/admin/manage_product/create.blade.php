<!DOCTYPE html>
@extends('admin.layout.layout')

@section('title')
    <title>Product</title>
@endsection

@section('name_page')
    <h3>Create Product</h3>
@endsection

@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height  d-flex justify-content-center">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-8 form-group has-icon-left">
                                                <label for="first-name-icon">Name of Product</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control text-dark"
                                                        placeholder="e.g: Shoes"
                                                        id="first-name-icon" name="name" value="{{ old('name') }}">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-bookmarks"></i>
                                                    </div>
                                                </div>
                                                @if (Session::has('name'))
                                                    <div class="text-danger product_alert">{{ Session::get('name') }}</div>
                                                    {{ Session::put('name', '') }}
                                                @endif
                                                @if (Session::has('duplicate_name'))
                                                    <div class="text-danger product_alert">{{ Session::get('duplicate_name') }}</div>
                                                    {{ Session::put('duplicate_name', '') }}
                                                @endif
                                            </div>
                                            <fieldset class="form-group col-4">
                                                <label for="category_id">Category</label>
                                                <select class="form-select" name="category_id">
                                                    <option value=""> Choose </option>
                                                    {!! $htmlOption !!}
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-8 form-group has-icon-left">
                                                <label for="code">Code of Product</label>
                                                <div class="position-relative">
                                                    <input type="text" 
                                                            class="form-control text-dark "
                                                            placeholder="e.g: xt039112"
                                                            id="code" 
                                                            name="product_code" 
                                                            value="{{ old('product_code') }}">
                                                    <div class="form-control-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                                                            <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z"/>
                                                            <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z"/>
                                                            <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z"/>
                                                            <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z"/>
                                                            <path d="M12 9h2V8h-2v1Z"/>
                                                          </svg>
                                                    </div>
                                                </div>
                                                @if (Session::has('product_code'))
                                                    <div class="text-danger product_alert">{{ Session::get('product_code') }}</div>
                                                    {{ Session::put('product_code', '') }}
                                                @endif
                                                @if (Session::has('duplicate_product_code'))
                                                    <div class="text-danger product_alert">{{ Session::get('duplicate_product_code') }}</div>
                                                    {{ Session::put('duplicate_product_code', '') }}
                                                @endif
                                            </div>
                                            <fieldset class="form-group col-4">
                                                <label for="status">Status</label>
                                                <select class="form-select" name="status">
                                                    @if (old('status') === 'Available')
                                                        <option value=""> Choose </option>
                                                        <option selected value="Available">Available</option>
                                                        <option value="Unavailable">Unavailable</option>
                                                    @elseif(old('status') === 'Unavailable')
                                                        <option value=""> Choose </option>
                                                        <option value="Available">Available</option>
                                                        <option selected value="Unavailable">Unavailable</option>
                                                    @elseif(empty(old('status')))
                                                        <option value=""> Choose </option>
                                                        <option value="Available">Available</option>
                                                        <option value="Unavailable">Unavailable</option>
                                                    @endif
                                                </select>
                                                @if (Session::has('status'))
                                                    <div class="text-danger product_alert">{{ Session::get('status') }}</div>
                                                    {{ Session::put('status', '') }}
                                                @endif
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-8 form-group has-icon-left">
                                                <label for="price">Price of Product</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control text-dark"
                                                        placeholder="e.g: 19.99"
                                                        id="price" name="price" value="{{ old('price') }}"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                    <div class="form-control-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                                          </svg>
                                                    </div>
                                                </div>
                                                @if (Session::has('price'))
                                                    <div class="text-danger product_alert">{{ Session::get('price') }}</div>
                                                        {{ Session::put('price', '') }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image_path">Image</label>
                                            <div class="position-relative">
                                                <input type="file" name="image_path" class="image_path">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="thumbnails">Thumbnails <span class="text-danger">(Max: 5 | Min: 3)</span></label>
                                            <div class="position-relative">
                                                <input  id="thumbnails" 
                                                        multiple
                                                        type="file" 
                                                        name="thumbnails_path[]" 
                                                        class="form-control-file">
                                            </div>
                                            <span id="err_thumbnail"></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="tags">Tags</label>
                                            <div class="">
                                                <select id="tags" name="tags[]" class="form-control tags_select_choose" multiple="multiple" value="{{ old('tags') }}"></select>
                                                {{-- <div class="form-control-icon">
                                                    <i class="bi bi-tag"></i>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="dark">Description</label>
                                            <textarea id="dark" name="desc" cols="15" rows="15">{{ old('description') }}</textarea>
                                            @if (Session::has('description'))
                                                <div class="text-danger category_alert">{{ Session::get('description') }}</div>
                                                {{ Session::put('description', '') }}
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <h3>Specifications</h3>
                                    <div class="col-12 mb-3">
                                        {{-- add more specifications --}}
                                        <div id="specifications"></div>
                                        <button type="button" class="add_specification btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                            </svg> Add more
                                        </button>
                                    </div>
                                    <hr>
                                    <div class="col-12 d-flex justify-content-between">
                                        <div>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Create</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                        <div>
                                            <a href="{{ route('product.index') }}" class="btn btn-danger">Move back</a>
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
<script type='text/javascript' src="{{URL::asset('backend/js/product/main.js')}}"></script>
<script type='text/javascript' src="{{URL::asset('backend/js/tags.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.add_specification').click(function(){
            genderSelect();
        })
        genderSelect();  
      
        function genderSelect(){
            let container = $("#specifications");
            let item = `
                <div class="specification_container">
                    <div class="form-group">
                        <div class="row" >
                            <div class="col-5">
                                <label for="name_specification">Name</label>
                                <input type="text" class="form-control text-dark" id="name_specification" name="name_specification[]">
                            </div>
                            <div class="col-5">
                                <label for="detail_specification">Description</label>
                                <input type="text" class="form-control text-dark" id="detail_specification" name="detail_specification[]">
                            </div>
                           
                            <div class="col-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger fw-bolder remove_specification">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.append(item);
            function remove(index){
                container.splice(index, 1)
            }
            $(document).on('click', '.remove_specification', function () {
                $(this).closest('.specification_container').remove();
            });          
        }
    })
</script>