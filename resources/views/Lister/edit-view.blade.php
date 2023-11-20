<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Lister Dashboard </title>
  <link rel="stylesheet" href="{{url('/css/dash.css')}}" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
          <img src="/logo.jpg" alt="">
          <span class="nav-item">DashBoard</span>
        </a></li>
        <li><a href="/lister-dashboard">
          <i class="fas fa-home"></i>
          <span class="nav-item">Home</span>
        </a></li>
        <li><a href="/view-vacancies">
          <i class="fas fa-wallet"></i>
          <span class="nav-item">My Vacancies</span>
        </a></li>
        <li><a href="/vacancy-history">
          <i class="fas fa-chart-bar"></i>
          <span class="nav-item">History</span>
        </a></li>
        <li><a href="/new-vacancy">
          <i class="fas fa-tasks"></i>
          <span class="nav-item">New Vacancy</span>
        </a></li>
        <li><a href="/bookings">
          <i class="fas fa-tasks"></i>
          <span class="nav-item">View Booking</span>
        </a></li>
        <li><a href="/logout" class="logout">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
    </nav>

    <section class="main">
      <div class="main-top">
        <h1>Add Vacancy</h1>
        <i class="fas fa-user-cog"></i>
      </div>
      <div class="vacancy-form">
        <section class="form-container">
      <header>Update Vacancy Form</header>
      <form action="{{ route('update', ['id' => $editVacancy->id]) }}" class="form" method="post">
        @csrf
        <div class="input-box">
          <input type="text" name="user_name" value="{{$data->name}}"  hidden />
        </div>
        <div class="input-box">
          <input type="text" name="email" value="{{$data->email}}"  hidden />
        </div>
        <div class="input-box">
          <label>Location</label>
          <input type="text" placeholder="Enter vacancy location" name="location" value="{{$editVacancy->location}}" required />
        </div>
        <div class="column">
          <div class="input-box">
            <label>Price</label>
            <input type="number" placeholder="Enter price" name="price" value="{{$editVacancy->price}}" required />
          </div>
        </div>
        <div class="gender-box">
          <h3>Gender preference</h3>
          <div class="gender-option">
            <div class="gender">
              <input type="radio" id="check-male" name="gender"  value="Male" />
              <label for="check-male">male</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="gender" value="Female" />
              <label for="check-female">Female</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-other" name="gender" value="No Preference" />
              <label for="check-other">Any</label>
            </div>
          </div>
        </div>
        <div class="gender-box">
          <h3>Rent</h3>
          <div class="gender-option">
            <div class="gender">
              <input type="radio" id="check-male" name="rent"  value="Yes" />
              <label for="check-male">Yes</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="rent" value="No" />
              <label for="check-female">No</label>
            </div>
          </div>
        </div>
        <div class="input-box">
          <label>Sublet</label>
          <input type="text" placeholder="Enter sublet duration, if no indicate 'N/A'" name="sublet" value="{{$editVacancy->sublet}}" required />
        </div>
        <div class="input-box">
            <label>Age Preference</label>
            <input type="number" placeholder="Enter age preference" name="age" value="{{$editVacancy->age}}" required />
          </div>
          <div class="input-box">
            <label>Description</label>
            <textarea name="description" id="" cols="30" rows="10"  value="{{$editVacancy->description}}"></textarea>
          </div>
          <div class="input-box">
            <input type="text" placeholder="user-id" name="user_id" value="{{$data->id}}" required hidden />
          </div>
          
        <button>Update</button>
      </form>
    </section>
      </div>
    </section>
  </div>
</body>
</html>
