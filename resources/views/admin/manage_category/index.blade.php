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
            <div>
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg> Create Category
                </a>
            </div>
            <hr>
            @if (Session::get('success'))
                <div class="alert alert-success" id="category_alert">{{ Session::get('success') }}</div>
                {{ Session::put('success', '') }}
            @endif
            @if (Session::get('delete_error'))
                <div class="alert alert-danger" id="category_alert">{{ Session::get('delete_error') }}</div>
                {{ Session::put('delete_error', '') }}
            @endif
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
                <tbody >
                    @php
                        $stt = 1;
                    @endphp
                    @foreach ($categories as $item)
                    <tr >
                        <td  class="text-center">{{ $stt++ }}</td>
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
