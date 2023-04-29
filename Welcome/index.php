<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome User~</title>
  <script src="https://kit.fontawesome.com/981acb16d7.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="CSS/User/index.css" />
  <link rel="stylesheet" id="dm" />
  <script src="../Admin/JS/jquery-3.6.3.min.js"></script>
  <script src="JS/script.js"></script>
  <script src="JS/history.js"></script>
</head>

<body>
  <div class="popup" hidden></div>

  <nav>
    <ul>
      <li>
        <h1 id="darkmode" class="light"><i class="fa-solid fa-moon"></i></h1>
      </li>
      <li>
        <h1 class="title">E-Perpus Mejayan</h1>
      </li>
      <li>
        <div>
          <h2>Username</h2>
          <p>Anggota</p>
        </div>
        <img src="../.temp/default.jpg" alt="" />
      </li>
    </ul>
  </nav>

  <header>
    <ul>
      <li id="home" class="on"><i class="fa-solid fa-house"></i>Home</li>
      <li id="cari-buku"><i class="fa-solid fa-book"></i>Cari Buku</li>
      <li id="riwayat">
        <i class="fa-solid fa-clock-rotate-left"></i>Riwayat
      </li>
      <li id="feedback" onclick="
              $('main').load('component/feedback.php?usr_nm=data_dummy');
              $('*').removeClass('on');
              $(this).addClass('on');"><i class="fa-solid fa-comment-pen"></i>Feedback</li>
    </ul>
  </header>

  <main></main>

  <footer>
    <h2>
      COPYRIGHT &#x24B8;
      <a href="https://smkn1mejayan.sch.id/" target="_blank">
        2023 SMKN 1 MEJAYAN Kab. MADIUN</a>,All rights Reserved
    </h2>
  </footer>
</body>

</html>
<script>