@extends('main')

@section('content')

    <div class="container">

        <div class="mt-5">
            <a class="btn btn-success" href="http://{{ $_SERVER['HTTP_HOST'] }}/create">
                Create
                <i class="mdi mdi-pencil"></i>
            </a>
        </div>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="text-center">Post Number</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($posts as $index=>$post)
                <tr>
                    <th scope="row">{{ ++$index }}</th>
                    <th scope="row" class="text-center">{{ $post['section'] }}</th>
                    <td class="text-center">
                        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/posts?section={{ $post['section'] }}" class="btn btn-primary">
                            View
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/edit?section={{ $post['section'] }}" class="btn btn-warning">
                            Edit
                            <i class="mdi mdi-application-edit-outline"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection