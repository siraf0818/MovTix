@extends('dashboard.layouts.main')
@section('container')
<div class="details row px-4 gap-3 position-relative">
    <div class="recentCustomer col p-3 ">
        <div class="cardHeader d-flex justify-content-between">
            <h5>Create Theater</h5>
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
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label" style="font-weight: bold;">
                                ID:
                            </label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="id" value="{{ old('id') }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label" style="font-weight: bold;">
                                Name:
                            </label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="name" value="{{ old('name') }}" type="text" class="form-control">
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
                                    <option selected>-</option>
                                    <option>Available</option>
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
</div>
<div class="details row px-4 gap-3 position-relative">
    <div class="recentCustomer col p-3">
        <div class="cardHeader d-flex justify-content-between">
            <h5>Manage Theater</h5>
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
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewData["theater"] as $theater)
                    <tr>
                        <td>
                            <p class="fw-normal mb-1">{{ $theater->getId() }}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $theater->getName() }}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $theater->getStatus() }}</p>
                        </td>
                        <td>
                            <div class="row w-50">
                                <div class="col-lg-6">
                                    <!-- edit -->
                                    <a class="badge badge-edit text-white bg-primary rounded-pill d-inline" href="{{route('dashboard.admin.theater.edit', ['id'=> $theater->getId()])}}">
                                        edit
                                    </a>
                                </div>

                                <div class="col-lg-6">
                                    <!-- delete -->
                                    <form action="{{ route('dashboard.admin.theater.delete', $theater->getId())}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" onclick="return confirm('Are you sure?')" class="badge btn badge-delete text-white bg-danger rounded-pill d-inline">
                                            delete
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr> @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
<script>
    $('#id').change(function() {
        var id = $('#id').val();
        $('#code').val(id);
    });
</script>
@endsection