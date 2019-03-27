@extends('layout.loginnav')
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
      <div class="card border-light mb-3" style="max-width: 20rem;">
        <div class="card-header">Welcom to Insakay</div>
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Password">
              <input type="hidden" name="_token" value="{{ Session::token() }}">
            </div>
            <input type="submit" class="btn btn-secondary" onclick="login()" value="Log in">
          </div>
        </div>
      </div>
    </fieldset>
  </div>


<script type="text/javascript" src="{{URL::asset('js/index.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>

 
</script>

@stop  
</body>
</html>