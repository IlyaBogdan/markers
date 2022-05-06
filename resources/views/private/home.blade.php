@extends('../base')

@section('title')Home page @endsection

@section('static')
  <link rel="stylesheet" href="{{ asset('css/private.css') }}">
  <link rel="stylesheet" href="{{ asset('css/map.css') }}">
@endsection

@section('private')
  <header class="row d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="col-10">Markers</h5>
      <span class="col-1">{{ Auth::user()->login }}</span>
      <div class="col-1">
        <a class="btn btn-outline-warning" href="{{ route('user.logout') }}">Logout</a>
      </div>
  </header>

  <div class="container" id="main">
    <div class="row">
      <div class="col-1"></div>
      <div class="col-3 action-bar">
        <div class="row"><button class="btn btn-success" onclick="showForm('add');">Add</button></div>
        <div class="row"><button class="btn btn-warning" onclick="showForm('find');">Find</button></div>
        <div class="row"><button class="btn btn-danger" onclick="showForm('delete');">Delete</button></div>
        <div class="row" id="description-section"></div>
      </div>
      <div class="col-7">
        <canvas id="map"></canvas>

        <div id="add-form">
          <div class="top">
            <h1>Add new marker</h1>
            <button class="btn btn-outline-danger" onclick="showForm('close-form');">X</button>
          </div>
          <form action="#">
              <div class="mb-3">
                  <label for="mobile" class="form-label">Mobile</label>
                  <input class="form-control" type="text" id="mobile" name="mobile" placeholder="Mobile">
              </div>
              <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <input class="form-control" type="description" id="description" name="description" placeholder="Description">
              </div>
              <div class="mb-3">
                  <div>Coordinates</div>
                  <div id="coordinates">
                    <input class="form-control" type="number" id="x" name="x" placeholder="x">
                    <input class="form-control" type="number" id="y" name="y" placeholder="y">
                  </div>
              </div>
              <button type="button" class="btn btn-success" onclick="addMarker();">Add</button>
          </form>
        </div>

      </div>
      <div class="col-1"></div>
    </div>
  </div>
  
  <script src="{{ asset('js/map.js') }}"></script>
  <script src="{{ asset('js/utils.js') }}"></script>
@endsection
