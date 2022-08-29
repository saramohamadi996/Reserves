<div class="row  d-flex">
    <div class="col-xl-6">
        @include('Dashboard::Statistics.cards')
    </div>

    <div class="col-xl-6">
        @include('Dashboard::Statistics.wallets')
    </div>
</div>
<div class="row  d-flex">
    <div class="col-xl-6">
        @include('Dashboard::Statistics.services')
    </div>

    <div class="col-xl-6">
        <div id="tag_container">
            @include('Dashboard::Statistics.staffs')
        </div>
    </div>
</div>
