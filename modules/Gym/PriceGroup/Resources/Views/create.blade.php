@extends('Dashboard::master')
@section('content')

    <div class="ms-auto mx-lg-auto col-12 col-md-8 col-xl-5 p-3 p-md-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">یک گروه قیمت جدید تنظیم کنید </h5>
                <button href="{{route('price_groups.index')}}" class="btn-close"></button>
            </div>
            <form action="{{ route('price_groups.store') }}" class="padding-30" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row row-space-10">

                            <div class="col-6">
                                <label class="form-label"> عنوان گروه </label>
                                <input type="text" autocomplete="off" name="title" value="{{ old('title') }}"
                                       class="form-control @error('title') is-invalid @enderror"/>
                                @error("title")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label"> قیمت (ریال) </label>
                                <input type="text" autocomplete="off" name="price" value="{{ old('price') }}"
                                       class="form-control" oninput="this.value=this.value.replace(/[^0-9\s]/g,'');"/>
                            </div>

                            <div class="col-6 mt-3">
                                <select name="category_id" id="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">انتخاب دسته بندی</option>
                                    @foreach($categories as $category)
                                        <option class="bg-gray-600"
                                                value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('price_groups.index')}}" class="btn btn-outline-default">بستن</a>
                    <button type="submit" class="btn btn-outline-theme">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>
@endsection
