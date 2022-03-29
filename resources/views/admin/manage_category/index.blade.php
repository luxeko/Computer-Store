@extends('admin.layout.layout')

@section('title')
    <title>Category</title>
@endsection

@section('name_page')
    <h3>Category</h3>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg> Create Category
                </a>
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success mt-3" id="category_alert">{!! Session::get('success') !!}</div>
                {{ Session::put('success', '') }}
            @endif
           
            <div hidden class="category_delete alert alert-danger mt-3">
                <span class="category_delete_title fw-bolder text-uppercase"> </span>
                <span class="category_delete_detail"> </span>
            </div>
            <hr>
            <div class="d-flex justify-content-end mx-2">
                <form action="{{  route('category.search') }}" method="GET" class="form-inline d-flex flex-row">
                    <fieldset class="form-group me-3">
                        <label for="parent_id_filter">Category Parent</label>
                        <select class="form-select fw-bold" name="parent_id_filter" id="parent_id_filter">
                            <option value=""> Choose </option>
                            {!! $htmlOption !!}
                        </select>
                    </fieldset>
                    <fieldset class="form-group me-3">
                        <label for="status_filter">Status</label>
                        <select class="form-select fw-bold" name="status_filter" id="status_filter">
                            @if(isset($status) && $status === "Active")
                                <option value=""> Choose </option>  
                                <option selected value="Active">Active</option>
                                <option value="Unactive">Unactive</option>
                            @endif
                            @if(isset($status) && $status === "Unactive")
                                <option value=""> Choose </option>  
                                <option value="Active">Active</option>
                                <option selected value="Unactive">Unactive</option>
                            @endif
                            @if(empty($status))
                                <option value=""> Choose </option>  
                                <option value="Active">Active</option>
                                <option value="Unactive">Unactive</option>
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
                            @endif
                            @if(isset($sort) && $sort === 'oldest')
                                <option value=""> Choose </option>  
                                <option value="latest">Newest</option>
                                <option selected value="oldest">Oldest</option>
                            @endif
                            @if(empty($sort))
                                <option value=""> Choose </option>  
                                <option value="latest">Newest</option>
                                <option value="oldest">Oldest</option>
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category Parent</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $stt = 1;
                    @endphp
                    @foreach($categories as $item)
                    <tr >
                        <td class="text-center">{{ $stt++ }}</td>
                        <td class="text-dark fw-bolder">{{ $item->name }}</td>
                        <td class="desc">{!! $item->description !!}</td>
                        <td> {{ optional($item->getParentName)->name }}</td>
                        <td class="text-center">
                            @if ($item->status === "Active")
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Unactive</span>
                            @endif
                        </td>
                        <td class="text-center">    
                            <a href="{{ Route('category.edit', ['id'=>$item->id])}}" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                            <a class="btn btn-danger action_delete" data-url="{{Route('category.delete', ['id'=>$item->id])}}"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
<div class="content-wrapper" id="preloader">
</div>
@endsection
<script type="text/javascript" src="{{URL::asset('backend/js/jquery-3.6.0.min.js')}}"></script>
<script type="text/javascript" src={{URL::asset('backend/js/actionDelete.js')}}></script>
<script type='text/javascript' src="{{URL::asset('backend/js/category/main.js')}}"></script>

<script>
    $(document).ready(function(){
        $('.desc').children().css('padding-top', '15px');
    })
</script>
