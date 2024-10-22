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
                        <div class="title"><strong>Add New Author</strong></div>
                        <div class="block-body">
                            <form method="POST" action="{{ url('author/addauthor') }}" enctype="multipart/form-data">
                                @csrf 
                                <div class="form-group">
                                    <label for="name">Author Name</label>
                                    <input type="text" class="form-control" id="name" name="author_name" placeholder="Enter author name" required>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Enter author bio"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="birth_date">Birth Date</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                                </div>
                                   <div class="form-group my-4">
                   
                                        <label for="image" class="form-label" style="font-weight: 500;">Author Image</label>
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
