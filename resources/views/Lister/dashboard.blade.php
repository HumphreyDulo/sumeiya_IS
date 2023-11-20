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
        <h1>Welcome &nbsp; {{$data->name}}</h1>
        <i class="fas fa-user-cog"></i>
      </div>
      <div class="main-skills">
        <div class="card">
          <i class="fas fa-laptop-code"></i>
          <h3>Vacancy</h3>
          <p>Find a suitable client</p>
          <a href="/new-vacancy" class="card-button"><button>Add a Vacancy</button></a>
        </div>
        <div class="card">
          <i class="fas fa-laptop-code"></i>
          <h3>No of Vacancies</h3>
          <h4>{{$totalvacancies}}</h4>
        </div>
        <div class="card">
          <i class="fas fa-check"></i>
          <h3>Complete Transactions</h3>
          <h4>{{$successfulvacancies }}</h4>
        </div>
      </div>
    </section>
  </div>
</body>
</html>
