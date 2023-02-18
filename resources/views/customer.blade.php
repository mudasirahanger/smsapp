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
                          <form>
                          <div class="mb-3">
                            <label for="formFile" class="form-label">Customer Csv</label>
                            <input class="form-control" type="file" id="formFile">
                            </div>
                            <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Download sample <a href="#">click here</a></label>
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