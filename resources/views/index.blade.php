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
            @can('create',\App\Models\Spost::class)
            <a href="{{route('spost.create')}}" class="btn btn-success m-3"> Create</a>
            <a href="{{route('spost.trashed')}}" class="btn btn-dark m-3 "> Trashed</a>
            @endcan

        </div>



    </div>

    </div>
    <div class="card-body">
    <table class="table table-striped tabel-bordered border-dark">
  <thead style="background: #f2f2f2">
    <tr>
      <th scope="col width:5%" >#</th>
      <th scope="col" style="width: 10%">Image</th>
      <th scope="col" style="width: 20%">Title</th>
      <th scope="col" style="width: 30%">Description</th>
      <th scope="col" style="width: 10%">Category</th>
      <th scope="col" style="width: 10%">Publish date</th>
      <th scope="col" style="width: 20%">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post )

    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>
        <img width="80" src="{{asset($post->image)}}" alt="">
      </td>
      <td>{{$post->title}}</td>
      <td>{{$post->description}}      </td>
      <td>{{$post->scategory->name}}</td>
      <td>{{date('d-m-Y',strtotime($post->created_at))}}</td>
      <td>

      <div class="d-flex gap-1">

        <!-- <a href="" class="btn btn-sm btn-danger "> Delete</a> -->
        <a href="{{route('spost.show',$post->id)}}" class="btn btn-sm btn-success "> Show</a>
        @can('update',$post)
        <a href="{{route('spost.edit',$post->id)}}" class="btn btn-sm btn-primary "> Edit</a>
        @endcan



        @can('delete',$post)
        <form method="POST" action="{{route('spost.destroy',$post->id)}}">

@csrf
@method('DELETE')

<button type="submit" class="btn btn-sm btn-danger">Delete</button>
</form>
        @endcan


      </div>

      </td>

    </tr>

    @endforeach

  </tbody>

</table>
{{$posts->links()}}
    </div>
</div>
</div>

@endsection
