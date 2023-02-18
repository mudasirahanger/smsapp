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
                          <form>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" min="11" id="exampleFormControlInput1" placeholder="9199999999">
                            </div>
                            <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select Template</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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