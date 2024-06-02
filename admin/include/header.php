<?php
include_once 'classes/autoloader.php';
$db = new Database();
$header = new Header($db);
$header->handleLogout();
$newOrderCount = $header->getNewOrderCount();
$notifications = $header->getNotifications();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Admin Panel</title>
</head>
<body>
<header>
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="index.php" class="list-group-item list-group-item-action py-2 ripple" onclick="setActive(this)" aria-current="true">
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Hlavný panel</span>
        </a>
        <a href="products.php" class="list-group-item list-group-item-action py-2 ripple" onclick="setActive(this)">
          <i class="fas fa-chart-area fa-fw me-3"></i><span>Produkty</span>
        </a>
        <a href="bundles.php" class="list-group-item list-group-item-action py-2 ripple" onclick="setActive(this)"><i
            class="fas fa-chart-line fa-fw me-3"></i><span>Bundle</span>
        </a>
        <a href="orders.php" class="list-group-item list-group-item-action py-2 ripple" onclick="setActive(this)"><i
            class="fas fa-chart-bar fa-fw me-3"></i><span>Objednávky</span>
        </a>
        <a href="sales.php" class="list-group-item list-group-item-action py-2 ripple" onclick="setActive(this)"><i
            class="fas fa-money-bill fa-fw me-3"></i><span>Predaje</span>
        </a>
        <a href="?logout=true" class="list-group-item list-group-item-action text-danger py-2 ripple" onclick="return confirmLogout()">
          <i class="fas fa-sign-out-alt fa-fw me-3"></i><span>Odhlásiť sa</span>
        </a>
      </div>
    </div>
  </nav>
  <script>
    function confirmLogout() {
        return confirm('Naozaj sa chcete odhlásiť ?');
    }
  </script>
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
        aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <a class="navbar-brand" href="#">
        <img src="img/logo_dark.png" height="50" loading="lazy">
      </a>
      <ul class="navbar-nav ms-auto d-flex flex-row">
          <li class="nav-item dropdown">
              <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
                  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-bell"></i>
                  <span class="badge rounded-pill badge-notification <?php echo ($newOrderCount > 0) ? 'bg-danger' : ''; ?>" id="notificationCount">
                      <?php echo $newOrderCount; ?>
                  </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <?php if ($notifications): ?>
                <?php foreach ($notifications as $notification): ?>
                  <li>
                      <a class="dropdown-item" href="order-details.php?id=<?php echo $notification['id']; ?>">
                          <i class="fas fa-chart-bar fa-fw me-3"></i>Nová objednávka - <?php echo $notification['first_name']; ?>
                      </a>
                  </li>
                <?php endforeach; ?>
              <?php else: ?>
                  <li>
                      <a class="dropdown-item" href="#">
                          Žiadne upozornenia
                      </a>
                  </li>
              <?php endif; ?>
              </ul>
          </li>
      </ul>
      <script>
          function updateNotificationCount(count) {
              var notificationCount = document.getElementById('notificationCount');
              notificationCount.textContent = count;
              if (count > 0) {
                  notificationCount.classList.add('bg-danger');
              } else {
                  notificationCount.classList.remove('bg-danger');
              }
          }
      </script>
  </nav>
</header>

