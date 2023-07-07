@extends('dashboard.layouts.main')
@section('container')
<div class="details row px-4 gap-3 position-relative">
    <div class="recentCustomer col p-3 ">
        <div class="cardHeader d-flex justify-content-between">
            <h5>Edit Theater</h5>
        </div>
        <div class="card-body"> 
            @if($errors->any())
            <ul class="alert alert-danger list-unstyled"> 
                @foreach($errors->all() as $error)
                <li>- {{ $error }}</li> 
                @endforeach
            </ul> 
            @endif

            <form method="POST" action="{{ route('dashboard.admin.theater.update', ['id'=> $viewData['theater']->getId()]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label" style="font-weight: bold;">
                                Id:
                            </label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="id" value="{{ $viewData['theater']->getId() }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label" style="font-weight: bold;">
                                Name:
                            </label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="name" value="{{ $viewData['theater']->getName() }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label" style="font-weight: bold;">
                                Status:
                            </label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <select autocomplete="off" name="status" class="form-select">
                                    @if ($viewData['theater']->getStatus() === "Available")
                                    <option>-</option>
                                    <option selected>Available</option>
                                    @else
                                    <option selected>-</option>
                                    <option>Available</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start my-2">
                    <button class="btn badge-save px-4" style="color: #ffffff; background: #52527a;">Save </button>
                </div>
            </form>
        </div>
    </div>
</div> @endsection