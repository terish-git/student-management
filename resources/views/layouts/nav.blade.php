<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="{!! (Request::is('/') ? 'active' : '') !!}"><a href="{{ url('/') }}">Home</a></li>
      <li class="{!! (Request::is('teachers*') ? 'active' : '') !!}"><a href="{{ url('teachers') }}">Teachers</a></li>
      <li class="{!! (Request::is('student*') ? 'active' : '') !!}"><a href="{{ url('students') }}">Students</a></li>
      <li class="{!! (Request::is('marks*') ? 'active' : '') !!}"><a href="{{ url('marks') }}">Marks</a></li>
    </ul>
  </div>
</nav>