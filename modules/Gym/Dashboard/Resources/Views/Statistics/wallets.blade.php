<div id="bootstrapTable" class="mb-5">
    <div class="card">
        <div class="card-body">
            <h6>لیست تراکنش ها</h6>
            <table class="table table table-bordered col-6" data-toggle="table"
                   data-sort-class="table-active"
                   data-sortable="true" data-search="true" data-pagination="true">
                <thead>
                <tr>
                    <th data-sortable="true">#</th>
                    <th data-sortable="true">نوع</th>
                    <th data-sortable="true">جمع</th>
                    <th data-sortable="true">عملیات</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>1</td>
                    <td>واریز</td>
                    <td>{{number_format($credits)}} ریال </td>
                    <td>
                        @if( $credits <= 0)
                            <button
                                class="btn btn-outline-link p-1 detail" disabled
                                style="color: #3cd2a5">
                                <i class="bi bi-eye-slash" style="font-size: 1.5rem;"></i>
                            </button>
                        @else
                            <a type="button" data-bs-toggle="modal" data-type="credit"
                               data-bs-target="#modalDetail"
                               class="btn btn-outline-link p-1 wallet-detail" style="color: #3cd2a5">
                                <i class="bi bi-eye" style="font-size: 1.5rem;"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>برداشت</td>
                    <td>{{ number_format($debits) }} ریال </td>
                    <td>
                        @if( $debits <= 0)
                            <button
                                class="btn btn-outline-link p-1 detail" disabled
                                style="color: #3cd2a5">
                                <i class="bi bi-eye-slash" style="font-size: 1.5rem;"></i>
                            </button>
                        @else
                            <a type="button" data-bs-toggle="modal" data-type="debit"
                               data-bs-target="#modalDetail"
                               class="btn btn-outline-link p-1 wallet-detail" style="color: #3cd2a5">
                                <i class="bi bi-eye" style="font-size: 1.5rem;"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>
</div>
