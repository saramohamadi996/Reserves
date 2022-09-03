@extends('Dashboard::master')
@section('content')
    <div class="ms-auto mx-lg-auto col-12 col-md-8 col-xl-5 p-3 p-md-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ایجاد دسته بندی جدید </h5>
                <button href="{{route('categories.index')}}" class="btn-close"></button>
            </div>


            <form action="{{ route('categories.store') }}" class="padding-30" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row row-space-10">
                            <div class="col-12">
                                <label class="form-label"> نام دسته بندی </label>
                                <input type="text" autocomplete="off" name="title"  value="{{ old('title') }}"
                                       class="form-control @error('title') is-invalid @enderror"/>
                                @error("title")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mt-3 col-6">
                                <select name="parent_id" id="parent_id"
                                        class="form-select @error('parent_id') is-invalid @enderror">
                                    <option value="">دسته بندی اصلی</option>
                                    @foreach($categories as $category)
                                        <option class="bg-gray-600" value="{{ $category->id }}">
                                            {{ $category->title }}
                                        </option>
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
