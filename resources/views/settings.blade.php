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
                                <a class="nav-link active" id="nav-settings-tab" data-bs-toggle="tab" onclick="getsettings(1)" href="#nav-settings" role="tab" aria-controls="nav-settings-tab" aria-selected="true">Settings</a>
                                <a class="nav-link" id="nav-sms-tab" data-bs-toggle="tab" onclick="getsettings(2)" href="#nav-sms" role="tab" aria-controls="nav-sms-tab" aria-selected="true">SMS Gateways</a>
                                <a class="nav-link" id="nav-home-tab" data-bs-toggle="tab" onclick="getsettings(3)" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Templates</a>
                                <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" onclick="getsettings(4)" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                                <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="myTabContent">
                        
                        <div class="tab-pane fade show active" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">
                        <div class="mb-3 col-md-12">    
                         <h5 class="p-2 text-primary">List Settings</h5>
                                    <table class="table table-striped-columns" id="table-3">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Key</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table-data-1">
                                        </tbody>
                                    </table>
                                    </div>
                                    <h5 class="p-2 text-primary">Add Settings</h5>
                            
                                <form class="form-control mt-3 p-3" id="settings-from">
                                   
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Default SMS Gateway</label>
                                        <div class="col-sm-5">
                                        <select class="form-select" name="setting_sms_gateway" id="setting_sms_gateway">
                                            <option>Select</option>
                                            @foreach($smsgateways as $sms)
                                            <option value="{{ $sms->settings_id }}">{{ $sms->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Template Name</label>
                                        <div class="col-sm-5">
                                        <select class="form-select" name="setting_template_id" id="setting_template_id">
                                            <option>Select</option>
                                            @foreach($templates as $template)
                                            <option value="{{ $template->settings_id }}">{{ $template->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>    
                                    
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Status</label>
                                        <div class="col-sm-5">
                                        <select class="form-select" aria-label="Default select example" id="setting-status" name="setting-status">
                                            <option >Select</option>
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <a class="btn btn-primary mb-3" onclick="addSettings(1,$('#setting_sms_gateway').val(),$('#setting_template_id').val(),$('#setting-status').val())">Save</a>
                                    </div>
                                </form>                    
                            </div>
                            <div class="tab-pane fade" id="nav-sms" role="tabpanel" aria-labelledby="nav-sms-tab">
                                <div class="mb-3 col-md-12">
                                <h5 class="p-2 text-primary">List Gateways</h5>
                                    <table class="table table-striped-columns" id="table-2">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Key</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table-data-2">
                                        </tbody>
                                    </table>
                                    </div>
                                    <h5 class="p-2 text-primary">Add Gateways</h5>
                                    <form class="form-control mt-3 p-3" id="settings-from-sms">
                                    <div class="mb-3">
                                                <label for="formFile" class="form-label">Gateway name</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="name-sms" name="name" required>
                                                <div class="invalid-feedback">
                                                </div>
                                                </div>
                                               
                                            </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Api Keys</label>
                                        <div class="col-sm-12">
                                         <input type="text" class="form-control" id="keys-sms" name="keys">
                                        </div>
                                    </div>                                     
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Status</label>
                                        <div class="col-sm-5">
                                        <select class="form-select" aria-label="Default select example" id="status-sms" name="status">
                                            <option >Select</option>
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                            <a class="btn btn-primary mb-3" onclick="addSettings(2,$('#name-sms').val(),$('#keys-sms').val(),$('#status-sms').val())">Save</a>
                                        </div>
                                    </form>
                            </div>
                            </div>
                            <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mb-3 col-md-12">
                                <h5 class="p-2 text-primary">List Templates</h5>
                                    <table class="table table-striped-columns" id="table-3">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Key</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table-data-3">
                                        </tbody>
                                    </table>
                                    </div>
                                    <h5 class="p-2 text-primary">Add Templates</h5>
                                    <form class="form-control mt-3 p-3" id="settings-from-templates">

                                    <div class="mb-3">
                                                <label for="formFile" class="form-label">Template Name/ID</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" name="template_name" id="template_name">
                                                </div>
                                            </div>
                                        
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Template</label>
                                            <div class="col-sm-5 mb-3">
                                                    <textarea class="form-control" id="template-text" name="template-text"rows="3">Welcome to SMSApp. Your OTP for mobile verification is {VAR1}. Thanks, SMSApp.
                                                    </textarea>
                                                    </div>
                                        </div>
                                        <div class="mb-3">
                                        <label for="formFile" class="form-label">Status</label>
                                        <div class="col-sm-5">
                                        <select class="form-select" aria-label="Default select example" id="template-status" name="template-status">
                                            <option >Select</option>
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="mb-3">
                                            <a class="btn btn-primary mb-3" onclick="addSettings(3,$('#template_name').val(),$('#template-text').val(),$('#template-status').val())">Save</a>
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
<script>
   
function addSettings(id,value1,value2,value3){
   
    var formData = {
                'settings_type': id,  
                'name' : value1,
                'keys' : value2,
                'status' : value3,
            };
    $.ajax({ 
        type:'post',
        url: "{{ url('/AddSettings') }}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: formData,
        success: function(data){  
            if($.isEmptyObject(data.error)){
             Swal.fire('Settings Inserted')
            } else {
            $("#myTabContent").before('<div class="alert alert-danger">'+data.error+'</div>');
            }
          
        }
    });

}
function getsettings(id){
        var formData = {
                'id': id //for get email 
            };
        $.ajax({ 
        type:'post',
        url: "{{ url('/getsettingsAjaxSMS') }}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: formData,
       
        success: function(html){
            $("#table-data-"+id).html(html);           
        }
    }); 
    $('#table'+id).DataTable({
        ordering: false,
        info: false,
    });
}
  
function deleteSettings(id){
     var setting_id = id;
     var formData = {
                'id': setting_id //for get email 
            };
     $.ajax({ 
        type:'post',
        url: "{{ url('/deleteSettings') }}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: formData,
        success: function(json){
           Swal.fire('Settings Deleted')
        }
    });
    }
</script>



@include('components/footer')