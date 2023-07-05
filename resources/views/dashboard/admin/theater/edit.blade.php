@extends('dashboard.layouts.main')
@section('container')
<div class="card mb-4">
    <div class="card-header"> Edit theater
    </div>
    <div class="card-body"> @if($errors->any())
        <ul class="alert alert-danger list-unstyled"> @foreach($errors->all() as $error)
            <li>- {{ $error }}</li> @endforeach
        </ul> @endif

        <form method="POST" action="{{ route('dashboard.admin.theater.update', ['id'=> $viewData['theater']->getId()]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Id:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="id" value="{{ $viewData['theater']->getId() }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="name" value="{{ $viewData['theater']->getName() }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Status:</label>
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
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div> @endsection