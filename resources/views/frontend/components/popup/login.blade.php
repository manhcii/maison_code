<div class="modal fade login" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" id="login">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          @lang('Welcome to our website')
        </h4>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <form class="row" id="login_form" action="{{ route('frontend.login.post') }}" method="POST">
          @csrf
          <div class="col-12">
            <h3>
              @lang('Login to your Account')
            </h3>
          </div>

          <div class="col-12 form-group">
            <label for="username">@lang('Username') <small class="text-danger">*</small></label>
            <input type="text" id="username" name="email" value="" class="form-control" required />
          </div>

          <div class="col-12 form-group">
            <label for="password">@lang('Password') <small class="text-danger">*</small></label>
            <input type="password" id="password" name="password" value="" class="form-control" required />
          </div>

          <div class="col-12 form-group">
            <button class="btn btn-primary m-0" type="submit">
              @lang('Login')
            </button>
            <button class="btn btn-secondary m-0" type="button" data-bs-dismiss="modal" aria-hidden="true">
              @lang('Cancel')
            </button>
            <a href="#" class="float-end d-none">
              @lang('Forgot Password?')
            </a>
          </div>

          <div class="col-12 form-group login_result d-none">
            <div class="alert alert-warning" role="alert">
              @lang('Processing...')
            </div>
          </div>

          @php
            $referer = request()->headers->get('referer');
            $current = url()->full();
          @endphp
          <input type="hidden" name="referer" value="{{ $referer }}">
          <input type="hidden" name="current" value="{{ $current }}">

        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    $("#login_form").submit(function(e) {
      $(".login_result .alert").text("@lang('Processing...')");
      $(".login_result").removeClass('d-none');

      e.preventDefault();
      var form = $(this);
      var url = form.attr('action');
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function(response) {
          form[0].reset();
          if (response.message === 'success') {
            if (response.data.url != '') {
              window.location.href = response.data.url;
            } else {
              location.reload();
            }
          } else {
            $("login_result .alert").html(response.message);
          }

        },
        error: function(response) {
          // Get errors
          console.log(response);
          var errors = response.responseJSON.message;
          console.log(errors);
          if (errors === 'CSRF token mismatch.') {
            $(".login_result .alert").html("@lang('CSRF token mismatch.')");
          } else if (errors === 'The given data was invalid.') {
            $(".login_result .alert").html("@lang('The given data was invalid.')");
          } else {
            $(".login_result .alert").html(errors);
          }
        }
      });
    });
  });
</script>
