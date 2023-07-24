@extends('dashboard.layouts.main')

@section('container')
<div class="details row px-4 gap-3 position-relative">
    @if (session()->has('messege'))
    <div style="left: 50%;
          transform: translateX(-50%); z-index: 100 !important; position: absolute;" class="w-50 top-0 z-30 alert alert-success alert-dismissible fade show" role="alert">
        {{ session('messege') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="recentCustomer col p-3 rounded">
        <div class="cardHeader d-flex justify-content-between">
            <h5>Ticket</h5>
            <div class="search" style="width: 200px; height: 40px; padding-bottom: 8px;">
                <label for="" style="height: 100%;">
                    <input style="height: 100%" id="searchval" type="text" placeholder="Search..">
                    <ion-icon style="height: 100%" name="search-outline"></ion-icon>
                </label>
            </div>
        </div>
        <div class="table-customer overflow-auto">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Movie</th>
                        <th>Date&Time</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tiket as $t)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{$t->movie}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-muted mb-0">{{$t->date}} {{$t->time}}</p>
                        </td>
                        <td>
                            <p class="text-muted mb-0">{{number_format($t->total_price, 0, '.', '.');}}</p>
                        </td>
                        <td>
                            <div class="row w-100">
                                <div class="col-lg-12">
                                    <a href="/dashboard/member/tiket/{{$t->order_id}}" class="badge badge-edit text-white bg-primary rounded-pill d-inline">
                                        view
                                    </a>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex mt-2 justify-content-end">
                {!! $tiket->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection