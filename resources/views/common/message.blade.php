@if(session()->has('success'))
<div id="model_success" class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>{{ session()->get('success') }}！</strong>
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>{{ session()->get('error') }}！</strong>
</div>
@endif