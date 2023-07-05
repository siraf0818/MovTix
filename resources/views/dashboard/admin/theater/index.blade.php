@extends('dashboard.layouts.main')
@section('container')
<div class="card mb-4">
    <div class="card-header">
        Create theater
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form method="POST" action="{{ route('dashboard.admin.theater.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">ID:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="id" value="{{ old('id') }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
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
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Status:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <select autocomplete="off" name="status" class="form-select">
                                <option selected>-</option>
                                <option>Available</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Manage theater
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
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData["theater"] as $theater)
                <tr>
                    <td>{{ $theater->getId() }}</td>
                    <td>
                        {{ $theater->getName() }}
                    </td>
                    <td>{{ $theater->getStatus() }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('dashboard.admin.theater.edit', ['id'=> $theater->getId()])}}">
                            <i class="bi-pencil"></i>
                        </a>
                        <form action="{{ route('dashboard.admin.theater.delete', $theater->getId())}}" method="POST">
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
<script>
    $('#id').change(function() {
        var id = $('#id').val();
        $('#code').val(id);
    });
</script>
@endsection