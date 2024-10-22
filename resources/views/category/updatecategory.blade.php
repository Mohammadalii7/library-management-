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
                        <div class="title"><strong>Update Category</strong></div>
                        <div class="block-body">
                            <form method="POST" action="{{ url('category/updatecategory/' . $user->id) }}">
                                @csrf 
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="category_name"  value="{{ old('category_name', $user->category_name) }}" placeholder="Enter category name" required>
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
