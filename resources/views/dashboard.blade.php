@include('components/header')
    <main class="d-flex flex-nowrap">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-3 col-sm-1 col-xs-1">
                @include('components/menu')     
                </div>
                <div class="col-md-9 col-sm-3 col-xs-3">
                    <div class="row">
                        <h1>Dashboard</h1>
                    <div class="alert alert-primary shadow-lg rounded" role="alert">
                         You're logged in!
                    </div>   
                    </div>  
                    <div class="row">
                                <div class="col-lg-3 col-6">
                                        <div class="text-bg-info p-4 text-center shadow-lg rounded">
                                                <h3 id="newsms">0</h3>
                                                <p>New SMS</p>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                <div class="text-bg-info p-4 text-center shadow-lg rounded">
                                                <h3>0</h3>
                                                <p>New Whatsapp</p>
                                        </div>
                                </div>
                            <div class="col-lg-3 col-6">
                            <div class="text-bg-info p-4 text-center shadow-lg rounded">
                                                <h3 id="inqueue">0</h3>
                                                <p>In Queue</p>
                                        </div>
                            </div>
                            <div class="col-lg-3 col-6">
                            <div class="text-bg-success p-4 text-center shadow-lg rounded">
                                                <h3 id="customers">0</h3>
                                                <p>Customers</p>
                                        </div>
                            </div>
                     </div>               
                </div>
            </div>
        </div>
    </main>
    
<script>
   $(document).ready(function(){
    $.ajax({ 
        url: "{{ url('/getDashboardAjax') }}",
        success: function(json){
           if(json){
           jsondata = JSON.parse(json);
           $('#newsms').html(jsondata.newsms);
           $('#inqueue').html(jsondata.inqueue);
           $('#customers').html(jsondata.customers);
           }
        }
    });
});
</script>
@include('components/footer')