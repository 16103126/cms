@if(session('success'))
    <div class="alert alert-success" role="alert" id="success">
        <p>{{session('success')}}</p>
    </div>
@endif

<div id="successMsg" class="alert alert-success d-none" role="alert" >
    
</div>