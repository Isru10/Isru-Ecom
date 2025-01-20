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
                    <h4>Edit</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="" class="btn btn-success">Back</a>

                </div>

            </div>

        </div>
        <div class="card-body">
        <form method="POST" action="{{route('spost.update',$post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="">
                        <img style="width: 200px;" src="{{asset($post->image)}}" alt="">
                </div>
                    <label for="" class="form-label"> Image</label>
                    <input name="image" type="file" class="form-control">
            </div>


            <div class="form-group">
                    <label for="" class="form-label">Title </label>
                    <input name="title" type="text" class="form-control" value="{{$post->title}}"/>
            </div>


            <div class="form-group">
                    <label for="" class="form-label"> Category</label>
                    <select name="scategory_id" class="form-control" id="">
    <option value="">Select</option>
                    @foreach ($categories as $category )
        <option {{$category->id == $post->scategory_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach

                    </select>
            </div>

            <div class="form-group">
                    <label for="" class="form-label">Description</label>
                    <textarea  type="text" name="description" class="form-control" cols="30" rows="10" id="" > {{$post->description}}</textarea>
            </div>
            <div class="form-group mt-3">
                    <button class="btn btn-primary">Edit</button>
            </div>

        </form>
        </div>
    </div>

</div>
@endsection
