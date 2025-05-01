
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Freelancer Dashboard</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
    #app {
      display: flex;
      height: 100%;
      overflow: hidden;
    }
    .sidebar {
      width: 240px;
      background: #343a40;
      color: #fff;
      padding: 1rem;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
    }
    .sidebar h4 {
      margin-bottom: 1.5rem;
    }
    .sidebar .nav-link {
      color: #adb5bd;
    }
    .sidebar .nav-link.active {
      color: #fff;
      background: rgba(255,255,255,0.1);
      border-radius: .25rem;
    }
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }
    .navbar {
      flex-shrink: 0;
    }
    .content {
      flex: 1;
      overflow-y: auto;
      padding: 1rem;
      background: #f8f9fa;
    }
    .card {
      margin-bottom: 1.5rem;
    }
  </style>
</head>
<body>
  <div id="app">
    <nav class="sidebar">
      <h4 class="text-center">Dashboard</h4>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="#" class="nav-link active">Home</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Projects</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Earnings</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Messages</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Settings</a>
        </li>
      </ul>
    </nav>

    <div class="main">
      <nav class="navbar navbar-light bg-light px-4">
        <span class="navbar-brand mb-0 h1">Freelancer Dashboard</span>
        <div class="d-flex align-items-center ms-auto">
          <small id="lastUpdated" class="me-3 text-muted">Last updated: --:--:--</small>
          <div class="dropdown">
            <a
              href="#"
              class="d-flex align-items-center text-decoration-none dropdown-toggle"
              id="avatarDropdown"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <img
                src="https://via.placeholder.com/32"
                alt="Avatar"
                class="rounded-circle"
                width="32"
                height="32"
              />
            </a>
            <ul
              class="dropdown-menu dropdown-menu-end text-small"
              aria-labelledby="avatarDropdown"
            >
              <li><a class="dropdown-item" href="/profile">Profile</a></li>
              <li><a class="dropdown-item" href="/setting">Settings</a></li>
              <li><hr class="dropdown-divider" /></li>
              <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card text-white bg-primary">
              <div class="card-body">
                <h5 class="card-title">Earnings</h5>
                <p class="card-text display-6" id="earnings">$0</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-success">
              <div class="card-body">
                <h5 class="card-title">Active Projects</h5>
                <p class="card-text display-6" id="projects">0</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-warning">
              <div class="card-body">
                <h5 class="card-title">Pending Tasks</h5>
                <p class="card-text display-6" id="tasks">0</p>
              </div>
            </div>
          </div>
        </div>

        <h4 class="mt-4">Recent Projects</h4>
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th>Project</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="recentList">
              <!-- injected rows -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    const dummyProjects = [
      { name: 'Website Redesign', status: 'Completed', deadline: 'Apr 25, 2025' },
      { name: 'Mobile App', status: 'In Progress', deadline: 'May 10, 2025' },
      { name: 'Logo Design', status: 'Pending', deadline: 'May 15, 2025' },
      { name: 'API Integration', status: 'In Progress', deadline: 'May 20, 2025' },
      { name: 'Marketing Funnel', status: 'Pending', deadline: 'May 30, 2025' }
    ];

    function randomInt(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function updateMetrics() {
      document.getElementById('earnings').textContent = '$' + randomInt(1000, 10000);
      document.getElementById('projects').textContent = randomInt(1, 15);
      document.getElementById('tasks').textContent = randomInt(0, 10);
      document.getElementById('lastUpdated').textContent =
        'Last updated: ' + new Date().toLocaleTimeString();

      const tbody = document.getElementById('recentList');
      tbody.innerHTML = '';
      dummyProjects.forEach(proj => {
        const statusClass =
          proj.status === 'Completed' ? 'success'
          : proj.status === 'In Progress' ? 'warning'
          : 'danger';
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${proj.name}</td>
          <td><span class="badge bg-${statusClass}">${proj.status}</span></td>
          <td>${proj.deadline}</td>
          <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
        `;
        tbody.appendChild(tr);
      });
    }

    window.addEventListener('DOMContentLoaded', () => {
      updateMetrics();
      setInterval(updateMetrics, 5000);
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
