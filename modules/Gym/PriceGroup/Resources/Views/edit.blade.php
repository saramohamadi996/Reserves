@extends('Dashboard::master')
@section('content')
    <div class="ms-auto mx-lg-auto col-12 col-md-8 col-xl-5 p-3 p-md-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش گروه</h5>
                <button href="{{ route('price_groups.index') }}" class="btn-close"></button>
            </div>
            <form action="{{ route('price_groups.update', $price_group->id) }}" class="padding-30" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row row-space-10">


                            <div class="col-6">
                                <label class="form-label"> عنوان گروه </label>
                                <input type="text" name="title" value="{{ $price_group->title }}" required
                                    class="form-control @error('title') is-invalid @enderror" />
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label"> قیمت (ریال) </label>
                                <input type="text" name="price" value="{{ $price_group->price }}"
                                    class="form-control @error('price') is-invalid @enderror" />

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 mt-3">
                                <select name="category_id" id="categoryId"
                                    class="js-states form-control @error('category_id') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $category->category_id) selected @endif>{{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('price_groups.index') }}" class="btn btn-outline-default">بستن</a>
                    <button type="submit" class="btn btn-outline-theme">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>
@endsection
