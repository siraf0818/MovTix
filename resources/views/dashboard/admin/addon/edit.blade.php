@extends('dashboard.layouts.main')
@section('container')
<div class="details row px-4 gap-3 position-relative">
    <div class="recentCustomer col p-3">
        <div class="cardHeader d-flex justify-content-between">
            <h5>Create AddOn</h5>
        </div>
        <div class="card-body"> 
            @if($errors->any())
            <ul class="alert alert-danger list-unstyled"> 
                @foreach($errors->all() as $error)
                <li>- {{ $error }}</li> 
                @endforeach
            </ul> 
            @endif

            <form method="POST" action="{{ route('dashboard.admin.addon.update', ['id'=> $viewData['addon']->getId()]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label" style="font-weight: bold;">
                                Name:
                            </label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="name" value="{{ $viewData['addon']->getName() }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label" style="font-weight: bold;">
                                Price:
                            </label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="price" value="{{ $viewData['addon']->getPrice() }}" type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label" style="font-weight: bold;">
                                Image:
                            </label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input class="form-control" type="file" name="image">
                            </div>
                        </div>
                    </div>
                    <div class="col"> &nbsp;
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: bold;">Description</label>
                    <textarea class="form-control" name="description" rows="3">{{$viewData['addon']->getDescription() }}</textarea>
                </div>
                <div class="d-flex justify-content-start my-2">
                    <button class="btn badge-save px-4" style="color: #ffffff; background: #52527a;">Save </button>
                </div>
            </form>
        </div>
    </div>
</div> @endsection