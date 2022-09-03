<div class="card">
    <div class="card-body p-0">
        <div class="modal-header align-items-center">
            <h5 class="modal-title d-flex align-items-end">
               <span class="me-2 mb-1 opacity-5">
                    <i class="bi bi-x-diamond"></i>
                </span>
                <h6 class="flex-grow-1">
                    ساعت :
                    {{jdate($reserve->start)->format("H:i")}}
                    الی :
                    {{jdate($reserve->end)->format("H:i")}}
                </h6>
                <h6 class="flex-grow-1">
                    تاریخ :
                    {{jdate($reserve->start_time)->format("Y/m/d")}}</h6>
            </h5>
            <a href="#" data-bs-dismiss="modal" class="ms-auto btn-close"></a>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group mb-2 ">
                        <div class="input-group">
                            @foreach ($reserve->users as $user)
                                <div class="col-lg-9">
                                    <div class="form-group mb-2 ">
                                        <div class="input-group d-block">
                                            <div class="form-check w-100">
                                                <label class="form-check-label" for="">
                                                    <div class="form-group d-flex mb-2">
                                                        <button class="input-group-text fw-bold w-70px fs-13px me-1"
                                                                style="color: #3cd2a5">
                                                            {{$user->pivot->status}}
                                                        </button>
                                                        <div class="input-group ms-auto">
                                                            <div class="input-group-text fw-bold w-250px fs-13px">
                                                                {{$user->name}}
                                                            </div>
                                                            <input type="text" class="form-control text-sm-center w-25"
                                                                   value="{{$user->mobile}}"/>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-arrow">
        <div class="card-arrow-top-left"></div>
        <div class="card-arrow-top-right"></div>
        <div class="card-arrow-bottom-left"></div>
        <div class="card-arrow-bottom-right"></div>
    </div>
</div>


