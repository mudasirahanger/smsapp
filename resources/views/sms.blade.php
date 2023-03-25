@include('components/header')
    <main class="d-flex flex-nowrap">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-3 col-sm-1 col-xs-1">
                @include('components/menu')     
                </div>
                <div class="col-md-9 col-sm-3 col-xs-3">
                    <div class="row">
                        <h1>{{ $title }}</h1>
                        <div class="col mt-3 p-3">
                          <form method="POST" action="{{ route('send') }}" enctype="multipart/form-data" >
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
                            <label for="exampleFormControlInput1" class="form-label">Customer Group </label> 
                             <select name="customer_group_id" class="form-control">
                             <option value='' selected>Select</option>
                             @foreach($groups as $group)
                             <option value="{{ $group->customers_groups_id }}">{{ $group->name }}</option>
                             @endforeach
                             </select>
                            </div>
                            <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select Template</label>
                            <select class="form-select" name="template_id" aria-label="Default select example">
                            <option value='' selected>Select</option>
                            @foreach($templates as $template)
                             <option value="{{ $template->settings_id }}">{{ $template->name }}</option>
                             @endforeach
                            </select>
                            </div>
                          
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mb-3">Send</button>
                            </div>
                          </form>
                        </div>                   
                    </div>   
                </div>
            </div>
        </div>
    </main>
@include('components/footer')