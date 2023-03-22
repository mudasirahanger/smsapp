@include('components/header')
    <main class="d-flex flex-nowrap">
        <div class="container">
            <div class="row mt-5">
                <div class="col-3">
                @include('components/menu')     
                </div>
                <div class="col-9">
                    <div class="row">
                        <h1>{{ $title }}</h1>
                       
                        <div class="col">
                        <form  method="POST" action="{{ route('AddcustomerGroup') }}" enctype="multipart/form-data">
                            @csrf
                            @if ($message = Session::get('message'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                          <div class="mb-3">                            
                            <div class="col-sm-3">
                            <label for="csvfile" class="form-label">Group Name</label> 
                               <input class="form-control" type="text" id="csvGroupName" name="csvGroupName">
                            </div>
                            </div>                           
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mb-3">Create</button>
                            </div>
                          </form>
                        </div>
                   
                    </div>  
                             
                </div>
            </div>
        </div>
    </main>
@include('components/footer')