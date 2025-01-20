@extends('layouts.smaster')
@section('content')

<div class="main-content mt-5">
<div class="card">
    <div class="card-header">

    <div class="row">
        <div class="col-md-6">
            <h4>Posts</h4>
        </div>
        <div class=" col-md-6 d-flex justify-content-end" >
        <a href="{{route('spost.create')}}" class="btn btn-success m-3"> Create</a>
        <a href="" class="btn btn-dark m-3 "> Trashed</a>

        </div>



    </div>

    </div>
    <div class="card-body">
    <table class="table table-striped tabel-bordered border-dark">

  <tbody>

    <!-- <tr>
      <th scope="row">{{$post->id}}</th>
      <td>
        <img width="80" src="{{asset($post->image)}}" alt="">
      </td>
      <td>{{$post->title}}</td>
      <td>{{$post->description}}      </td>
      <td>{{$post->scategory_id}}</td>
      <td>{{date('d-m-Y',strtotime($post->created_at))}}</td>
      <td>
        <a href="{{route('spost.edit',$post->id)}}" class="btn btn-sm btn-primary "> Edit</a>
        <a href="" class="btn btn-sm btn-danger "> Delete</a>
        <a href="" class="btn btn-sm btn-success "> Show</a>

      </td>
    </tr> -->


        <tr>
            <td>Id</td>
            <td>{{$post->id}}</td>

        </tr>
        <tr>
            <td>Image</td>
            <td>
                <img width="300" src="{{asset($post->image)}}" alt="">
            </td>
        </tr>


        <tr>
            <td>Title</td>
            <td>{{$post->title}}</td>
        </tr>

        <tr>
            <td>Description</td>
            <td>{{$post->description}}</td>

        </tr>


        <tr>
            <td>Category</td>
            <td>{{$post->scategory_id}}</td>

        </tr>


        <tr>
            <td>Publish date </td>
            <td>{{date('d-m-Y',strtotime($post->created_at))}}</td>

        </tr>
  </tbody>
</table>
    </div>
</div>
</div>

@endsection
