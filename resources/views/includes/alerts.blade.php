@if (Session::has('success'))
    <div class="alert alert-success">
        <span class="icon-holder"><i class="ti ti-check-box" ></i></span> &nbsp   {{ Session::get('success') }}
    </div>

    <br />
@endif


@if (Session::has('danger'))
    <div class="alert alert-danger">
        <span class="icon-holder"><i class="ti ti-na" ></i></span>  &nbsp &nbsp   {{ Session::get('danger') }}
    </div>
    <br />
@endif


@if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

      </ul>
    </div>
    <br />
@endif
