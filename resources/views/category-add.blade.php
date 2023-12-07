@extends('layouts.mainlayout')

@section('title', 'Add Category')

@section('content')
    
    <h1>Add New Category</h1>

    <div>
        <form action="category-add" method="post">
            @csrf 
            <div class="mt-5 w-50">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Category Name">
            </div>

            <div class="mt-3">
                <button class="btn btn-success me-3" type="submit">Save</button>
                <a href="categories" class="btn btn-secondary">cancel</a>
            </div>

        </form>
    </div>

@endsection