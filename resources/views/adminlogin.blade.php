@extends('layout.adminloginnav')
@section('content')

<body>
  <!-- <div id="loader" class="loader">
    <div class="sk-folding-cube">
      <div class="sk-cube1 sk-cube"></div>
      <div class="sk-cube2 sk-cube"></div>
      <div class="sk-cube4 sk-cube"></div>
      <div class="sk-cube3 sk-cube"></div>
    </div>
  </div> -->
  
  <div id="logindiv">
    <fieldset>
      <div class="card mb-3 mx-auto" style="max-width: 20rem;">
        <div class="card-header">
          <h5 class="font-weight-bolder" align="center">Welcome to Insakay-Admin</h5>
        </div>
          <div class="card-body">

            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><img src="{{ URL::asset('img/person_18.png') }}"></i></span>
              </div>
              <input type="email" class="form-control" id="email" placeholder="Email Address">
            </div>

            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><img src="{{ URL::asset('img/key_18.png') }}"></span>
              </div>
              <input type="password" class="form-control" id="password" placeholder="Password">
            </div>

            <input type="submit" class="btn btn-primary float-right" onclick="adminlogin()" value="Log in">

          </div>
        </div>
      </div>
    </fieldset>
  </div>


<script type="text/javascript" src="{{URL::asset('js/index.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/modals.js')}}"></script>

 
</script>

@stop  
</body>
</html>