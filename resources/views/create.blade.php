@extends('layouts.smaster')
@section('content')

<div class="main-content mt-5">
@if ($errors->any())
            @foreach ($errors->all() as $error)

                <div class="alert alert-danger">
                    {{$error}}
                </div>

            @endforeach

        @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Create</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="" class="btn btn-success">Back</a>

                </div>

            </div>

        </div>


        <div class="card-body">
        <form method="POST" action="{{route('spost.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                    <label for="" class="form-label"> Image</label>
                    <input name="image" type="file" class="form-control">
            </div>


            <div class="form-group">
                    <label for="" class="form-label"> Title</label>
                    <input name="title" type="text" class="form-control">
            </div>


            <div class="form-group">
                    <label for="" class="form-label"> Category</label>
                    <select  class="form-control" id="" name="scategory_id">
                        <option value="">select</option>
                    @foreach ($categories  as  $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach


                    </select>
            </div>

            <div class="form-group">
                    <label for="" class="form-label"> Description</label>
                    <textarea type="text" name="description" class="form-control" cols="30" rows="10" id="" ></textarea>
            </div>
            <div class="form-group mt-3">
                    <button class="btn btn-primary">Submit</button>
            </div>

        </form>
        </div>
    </div>

</div>
@endsection
