<!DOCTYPE html>
@extends('admin.layout.layout')

@section('title')
    <title>Create Category</title>
@endsection

@section('name_page')
<div class="flex-row d-flex align-items-center">
    <a class="text-dark" href="{{route('category.index')}}">Category</a> 
    <span class="text-dark fw-bolder">&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
      </svg>&nbsp;
    </span>
    <a class="text-primary fw-bolder" href="{{route('category.create')}}">Create Category</a>
</div>
@endsection

@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height  d-flex justify-content-center">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">Name of Category</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"
                                                    placeholder="e.g: Shoes"
                                                    id="first-name-icon" name="name" value="{{ old('name') }}">
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
                                            <textarea id="dark" name="description" cols="15" rows="15">{{ old('description') }}</textarea>
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
                                                @if (old('status') === 'Active')
                                                    <option value=""> Choose </option>
                                                    <option selected value="Active">Active</option>
                                                    <option value="Unactive">Unactive</option>
                                                @elseif(old('status') === 'Unactive')
                                                    <option value=""> Choose </option>
                                                    <option value="Active">Active</option>
                                                    <option selected value="Unactive">Unactive</option>
                                                @elseif(empty(old('status')))
                                                    <option value=""> Choose </option>
                                                    <option value="Active">Active</option>
                                                    <option value="Unactive">Unactive</option>
                                                @endif
                                            </select>
                                            @if (Session::has('status'))
                                                <div class="text-danger category_alert">{{ Session::get('status') }}</div>
                                                {{ Session::put('status', '') }}
                                            @endif
                                        </fieldset>
                                        <fieldset class="form-group col-md-5">
                                            <label for="parent_id">Category Parent</label>
                                            <select class="form-select" name="parent_id">
                                                <option value=""> Choose </option>
                                                {!! $htmlOption !!}
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <div>
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Create</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                        <div>
                                            <a href="{{ route('category.index') }}" class="btn btn-danger">Move back</a>
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