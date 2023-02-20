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
                        <div class="row">
                        <div class="alert alert-info">
                                    {{ $message }}                                
                                </div>
                        </div>
                        <div class="col">
                        <form  method="POST" action="{{ route('addCustomer') }}" enctype="multipart/form-data">
                            @csrf
                            @if ($message = Session::get('success'))
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
                            <label for="csvfile" class="form-label">Customer Csv</label>
                            <div class="col-sm-3">
                            <input class="form-control" type="file" id="csvfile" name="csvfile">
                            </div>
                            </div>
                            <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Download sample <a href="{{ asset('public/sample.csv') }}">click here</a></label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mb-3">Upload</button>
                            </div>
                          </form>
                        </div>
                   
                    </div>  
                             
                </div>
            </div>
        </div>
    </main>
@include('components/footer')