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
                    <div class="title"><strong>Update Book</strong></div>
                    <div class="block-body">
                        <form method="POST" action="{{ url('book/updatebook/' .$book->id ) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Book Name</label>
                                <input type="text" class="form-control" id="tite" name="title"  value="{{ old('title', $book->title) }}" placeholder="Enter book name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"  placeholder="Enter description bio">{{$book->description}}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="copies_available">Copies Available</label>
                                <input type="number" class="form-control" id="copies_available" name="copies_available" min="0" value={{$book->copies_available}} required>
                            </div>
                            <div class="form-group">
                                <label for="published_date">Published Date</label>
                                <input type="date" class="form-control" id="published_date" name="published_date" value={{$book->published_date}} required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach($category as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="author_id">Author</label>
                                <select name="author_id" class="form-control" required>
                                    <option value="">Select Author</option>
                                    @foreach($author as $author)
                                    <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>
                                        {{ $author->author_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group my-4">
                             <label for="image" class="form-label" style="font-weight: 500;">Current Image</label>
                                        <img src="/books/{{$book->image}}" style="height:150px;">
                                        <br>
                              
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
