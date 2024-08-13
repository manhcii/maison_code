@if (session('errorMessage'))
  <div class="alert alert-dismissible alert-danger alert-fixed">
    {{ session('errorMessage') }}
    <button type="button" class="close btn-close"data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if (session('successMessage'))
  <div class="alert alert-dismissible alert-success alert-fixed">
    {{ session('successMessage') }}
    <button type="button" class="close btn-close" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if ($errors->any())
  <div class="alert alert-dismissible alert-danger alert-fixed">
    @foreach ($errors->all() as $error)
      <p>{{ $error }}</p>
    @endforeach
    <button type="button" class="close btn-close"data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<style>
  .alert-fixed {
    position: fixed;
    top: 0px;
    right: 0px;
    margin: 1rem;
    z-index: 9999;
  }
</style>