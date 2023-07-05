@extends('dashboard.layouts.main')
@section('container')
<div class="card mb-4">
    <div class="card-header">
        Create addon
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form method="POST" action="{{ route('dashboard.admin.addon.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="name" value="{{ old('name') }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Price:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="price" value="{{ old('price') }}" type="number" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Image:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input class="form-control" type="file" name="image">
                        </div>
                    </div>
                </div>
                <div class="col"> &nbsp;
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Manage addon
    </div>
    <div class="search" style="width: 200px; height: 40px; padding-bottom: 8px;">
        <label for="" style="height: 100%;">
            <input style="height: 100%" id="searchval" type="text" placeholder="Search..">
            <ion-icon style="height: 100%" name="search-outline"></ion-icon>
        </label>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData["addon"] as $addon)
                <tr>
                    <td>
                        <img src="{{asset('/storage/'.$addon->getImage())}}" alt="" style="width: 45px; height: 45px;" class="rounded-circle">
                        {{ $addon->getName() }}
                    </td>
                    <td>{{ $addon->getDescription() }}</td>
                    <td>{{ $addon->getPrice() }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('dashboard.admin.addon.edit', ['id'=> $addon->getId()])}}">
                            <i class="bi-pencil"></i>
                        </a>
                        <form action="{{ route('dashboard.admin.addon.delete', $addon->getId())}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm(' Are you sure?')">
                                <i class="bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr> @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection