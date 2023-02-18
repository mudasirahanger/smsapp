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
                    <div class="col mt-3 p-3">

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Templates</a>
                                <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                                <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <form>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Template Name</label>
                                        <input class="form-control" type="text" id="formFile">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary mb-3">Save</button>
                                    </div>
                                </form>

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                Lorem ipsum dolor sit amet.</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, consequuntur. Laborum, placeat.</div>
                        </div>


                    </div>
                </div>
            </div>
</main>
@include('components/footer')