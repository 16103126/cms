@if(session('message'))
    <div class="alert alert-danger" role="alert">
        <p>{{session('message')}}</p>
    </div>
@endif

<div id="message" class="alert alert-danger d-none" role="alert">
   
</div>