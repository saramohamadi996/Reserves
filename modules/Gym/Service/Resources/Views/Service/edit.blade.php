@extends('Dashboard::master')
@section('content')
    <div class="ms-auto mx-lg-auto col-12 col-md-8 col-xl-5 p-3 p-md-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش خدمت</h5>
                <button href="{{ route('services.index') }}" class="btn-close"></button>
            </div>
            <form action="{{ route('services.update', $service->id) }}" class="padding-30" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row row-space-10">
                            <div class="col-6">
                                <label class="form-label"> عنوان خدمت </label>
                                <input type="text" name="title" value="{{ $service->title }}" required
                                       class="form-control @error('title') is-invalid @enderror" />
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label"> نامک </label>
                                <input type="text" name="slug" value="{{ $service->slug }}"
                                       class="form-control @error('slug') is-invalid @enderror" />

                                @error('slug')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label"> کد خدمت </label>
                                <input type="text" name="code_service" value="{{ $service->code_service }}"
                                       class="form-control @error('code_service') is-invalid @enderror" />

                                @error('code_service')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label"> ترتیب نمایش </label>
                                <input type="text" name="priority" value="{{ $service->priority }}"
                                       class="form-control @error('priority') is-invalid @enderror" />

                                @error('priority')
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
                                                @if ($category->id == $category->category_id) selected @endif>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('services.index') }}" class="btn btn-outline-default">بستن</a>
                    <button type="submit" class="btn btn-outline-theme">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>
@endsection
