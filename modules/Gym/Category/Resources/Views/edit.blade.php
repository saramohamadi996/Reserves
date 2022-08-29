@extends('Dashboard::master')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif
    <div class="ms-auto mx-lg-auto col-12 col-md-8 col-xl-5 p-3 p-md-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش دسته بندی </h5>
                <button href="{{route('categories.index')}}" class="btn-close"></button>
            </div>
            <form action="{{ route('categories.update', $category->id) }}" class="padding-30" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row row-space-10">


                            <div class="col-6">
                                <label class="form-label"> نام دسته بندی </label>
                                <input type="text" name="title" value="{{ $category->title }}"
                                       class="form-control @error('title') is-invalid @enderror"/>
                                @error("title")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label"> نامک دسته بندی </label>
                                <input type="text" name="slug" value="{{ $category->slug}}"
                                       class="form-control @error('slug') is-invalid @enderror"/>

                                @error("slug")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mt-5 col-6">
                                <label class="mb-2">دسته بندی اصلی</label>
                                <select class="form-select" name="parent_id" id="parent_id">
                                    <option selected></option>
                                    @foreach($categories as $categoryItem)
                                        <option class="bg-gray-700" value="{{ $categoryItem->id }}"
                                                @if($categoryItem->id == $category->parent_id)
                                                    selected @endif>{{ $categoryItem->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('categories.index')}}" class="btn btn-outline-default">بستن</a>
                    <button type="submit" class="btn btn-outline-theme">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>
@endsection
