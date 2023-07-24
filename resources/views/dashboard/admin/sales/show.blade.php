@extends('dashboard.layouts.main')

@section('container')
<div class="details row px-4 gap-3 position-relative mt-2">
    @if (session()->has('messege'))
    <div style="left: 50%;
          transform: translateX(-50%); z-index: 100 !important; position: absolute;" class="w-50 top-0 z-30 alert alert-success alert-dismissible fade show" role="alert">
        {{ session('messege') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="recentOrders col-lg-12 p-3" style="min-height: calc(100vh - 60px);">
        <div class="cardHeader row">
            <div class="d-flex align-items-center col-12 col-lg-8 col-md-8">
                <img src="/img/logo.png" alt="" style="width: 45px; height: 45px;" class="">
                <div class="ms-3">
                    <p class="fw-bold mb-0">MovTix</p>
                    <p class="text-muted mb-0">movtix@gmail.com</p>
                </div>
            </div>
            <p class="text-muted mb-0 col mt-2">Polines</p>
        </div>
        <div class="d-flex row invoice mt-3 mx-1 justify-content-between purple-gradient color-block z-depth-1">
            <div class="col-lg-4 col-12 p-3">
                <p class="fw-bolder mb-0">Invoice Number</p>
                <p class="fw-normal mb-0">{{$detail->order_id}}</p>
                <p class="fw-normal mb-0">Issued Date: <span class="fw-bolder">{{$detail->created_at->format('d M, Y')}}</span></p>
                <p class="fw-normal mb-0">Due Date: <span class="fw-bolder">{{$detail->created_at->format('d M, Y')}}</span></p>
            </div>
            <div class="col-lg-4 col-12 p-3">
                <p class="fw-bolder mb-0">Billed to</p>
                <p class="fw-normal mb-0">{{$detail->user->name}}</p>
                <p class="fw-normal mb-0">{{$detail->user->address}}</p>
            </div>
        </div>
        <div class="item-detail mt-3">
            <p class="fw-bold mb-0">Item Detail</p>
            <div class="table-order overflow-auto mt-2">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Date Time</th>
                            <th>Movie</th>
                            <th>Seats</th>
                            <th>Tickets</th>
                            <th>Addons</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p class="fw-normal mb-1">#{{$detail->order_id}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$detail->date}}</p>
                                <p class="text-muted mb-0">{{$detail->time}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$detail->movie}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">@foreach (App\Models\Seat::where('order_id', '=', $detail->order_id)->get() as $seat)
                                    [{{ $seat->no_seat }}]
                                    @endforeach
                                </p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$detail->jml_tiket}} Tickets
                                </p>
                                <p class="fw-normal mb-1">Total: Rp.{{$detail->tiket_price}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$detail->addon}}</p>
                                <p class="fw-normal mb-1">Total: Rp.{{$detail->addon_price}}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="total-amount row">
            <div class="col-lg-8 mt-3">
                @if($detail->payment != null)
                <div class="row">
                    <div class="col-6">
                        <p class="fw-normal text-muted mb-0">Transaction Time:</p>
                    </div>
                    <div class="col-6">
                        <p class="text-muted fw-bolder mb-0">{{date('d M, Y', strtotime("+0 day", strtotime($detail->payment->transaction_time)))}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="fw-normal text-muted mb-0">Transaction Status:</p>
                    </div>
                    <div class="col-6">
                        <p class="text-muted fw-bolder mb-0">{{$detail->payment->transaction_status}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="fw-normal text-muted mb-0">Payment Type:</p>
                    </div>
                    <div class="col-6">
                        <p class="text-muted fw-bolder mb-0">{{$detail->payment->payment_type}}</p>
                    </div>
                </div>

                @endif
            </div>
            <div class="col-lg-4 mt-3">
                <div class="row">
                    <div class="col-6">
                        <p class="fw-bolder mb-0">Sub Total</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-normal mb-0">RP. {{number_format($price, 0, '.', '.');}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="fw-bolder mb-0">PPN</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-normal mb-0">RP. {{number_format($ppn, 0, '.', '.');}}</p>
                    </div>
                </div>
                <hr style="color: rgb(179, 176, 176)">
                <div class="row">
                    <div class="col-6">
                        <p class="fw-bolder mb-0">Total Amount</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-normal mb-0">RP. {{number_format($detail->total_price, 0, '.', '.');}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection