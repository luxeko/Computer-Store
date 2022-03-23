<!DOCTYPE html>
@extends('admin.layout.layout')

@section('title')
    <title>Category</title>
@endsection

@section('name_page')
    <h3>Edit Category</h3>
@endsection

@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height  d-flex justify-content-center">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" action="{{ route('category.update', ['id'=>$category->id]) }}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Name of Category</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"
                                                    placeholder="e.g: Shoes"
                                                    id="first-name-icon" name="name" value="{{ $category->name }}">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-tag"></i>
                                                </div>
                                            </div>
                                            @if (Session::has('name'))
                                                <div class="text-danger category_alert">{{ Session::get('name') }}</div>
                                                {{ Session::put('name', '') }}
                                            @endif
                                            @if (Session::has('duplicate_name'))
                                                <div class="text-danger category_alert">{{ Session::get('duplicate_name') }}</div>
                                                {{ Session::put('duplicate_name', '') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="snow">Description</label>
                                            <textarea id="dark" name="description" cols="15" rows="15">{{ $category->description }}</textarea>
                                            @if (Session::has('description'))
                                                <div class="text-danger category_alert">{{ Session::get('description') }}</div>
                                                {{ Session::put('description', '') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4 d-flex flex-row">
                                        <fieldset class="form-group col-md-5 me-3">
                                            <label for="status">Status</label>
                                            <select class="form-select" name="status">
                                                @if ($category->status === 'Active')
                                                    <option value=""> Choose </option>
                                                    <option selected value="Active">Active</option>
                                                    <option value="Unactive">Unactive</option>
                                                @elseif($category->status === 'Unactive')
                                                    <option value=""> Choose </option>
                                                    <option value="Active">Active</option>
                                                    <option selected value="Unactive">Unactive</option>
                                                @endif
                                            </select>
                                            @if (Session::has('status'))
                                                <div class="text-danger category_alert">{{ Session::get('status') }}</div>
                                                {{ Session::put('status', '') }}
                                            @endif
                                        </fieldset>
                                        <fieldset class="form-group col-md-5">
                                            <label for="parent_id">Parent Category</label>
                                            <select class="form-select" name="parent_id">
                                                <option value=""> Choose </option>
                                                {!! $htmlOption !!}
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <div>
                                            <a href="{{ route('category.index') }}" class="btn btn-danger">Move back</a>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
<script type='text/javascript' src="{{URL::asset('backend/js/category/main.js')}}"></script>