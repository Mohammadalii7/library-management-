@extends('component/layout')

@section('title', 'Dashboard')

@section('content')
<style>
  .block {
        background: #ffffff;
    }

    .block .title strong:first-child {
        color: black;
        font-size: 24px;
        font-family: italic;
    }

    .page-header {
        background: #ffffff;
    }
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="container-fluid">

    </div>
</div>

<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="block margin-bottom-sm">
                    <div class="title"><strong>Add New Book</strong></div>
                    <div class="block-body">
                        <form method="POST" action="{{ url('book/addbook') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Book Name</label>
                                <input type="text" class="form-control" id="tite" name="title" placeholder="Enter book name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter description bio"></textarea>
                            </div>


                            <div class="form-group">
                                <label for="copies_available">Copies Available</label>
                                <input type="number" class="form-control" id="copies_available" name="copies_available" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="published_date">Published Date</label>
                                <input type="date" class="form-control" id="published_date" name="published_date" required>
                            </div>

                            <div class="form-group my-4">
                                <label for="author">Author</label>
                                <select name="author_id" required>
                                    <option>Select Author</option>

                                    @foreach($user as $author)

                                    <option value="{{$author->id}}">{{$author->author_name}}</option>

                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group my-4">
                                <label for="category">Category</label>
                                <select name="category_id" required>
                                    <option>Select Category</option>

                                    @foreach($data as $category)

                                    <option value="{{$category->id}}">{{$category->category_name}}</option>

                                    @endforeach
                                </select>

                            </div>







                            <div class="form-group my-4">
                   
                                        <label for="image" class="form-label" style="font-weight: 500;">Book Image</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*">

                                        </div>
                                    
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
