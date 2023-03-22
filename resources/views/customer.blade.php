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
                            
                            <div class="col-sm-3">
                            <label for="csvfile" class="form-label">Customer Group</label> 
                            <a class="btn badge text-bg-primary" href="{{route('customerGroups')}}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                            </svg> </a>
                            <select class="form-control" id="csvGroup" name="csvGroup">
                            @foreach($groups as $group)
                             <option value="{{ $group->customers_groups_id }}">{{ $group->name }}</option>
                             @endforeach
                            </select>
                            </div>                           
                            <div class="col-sm-6">
                            <label for="csvfile" class="form-label">Customer Csv</label>
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