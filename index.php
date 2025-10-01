<?php
// === light.php logic ===
function run_light_sequence($target) {
    // Yellow ON for 3 seconds
    shell_exec("sh /root/yellow_light.sh");
    sleep(3);

    // Then go to target color
    if ($target == "red") {
        shell_exec("sh /root/red_light.sh");
    } elseif ($target == "green") {
        shell_exec("sh /root/green_light.sh");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $color = $_POST['color'] ?? '';

    header('Content-Type: application/json');

    if ($color === "red" || $color === "green") {
        run_light_sequence($color);
        echo json_encode(['status'=>'ok','color'=>$color]);
    }
    elseif ($color === "yellow") {
        shell_exec("sh /root/yellow_light.sh");
        echo json_encode(['status'=>'ok','color'=>'yellow']);
    }
    else {
        http_response_code(400);
        echo json_encode(['status'=>'error','message'=>'invalid color']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Traffic Light Control</title>
  <style>
    /* === style.css === */
    @import url('https://fonts.googleapis.com/css?family=Trirong');

    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Trirong', sans-serif;
    }

    body{
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
        background-color: lightblue;
    }

    h1{
        position: absolute;
        top: 0;
        text-align: center;
        padding-top: 100px;
        color: black;
    }

    .container{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        height: 250px;
        width: 80px;
        padding: 20px 0;
        border-radius: 50px;
        background-color: black;
    }

    .circle{
        position: relative;
        height: 45px;
        width: 45px;
        border-radius: 100%;
        background-color: black;
    }

    .circle.col1{
        background-color: red;
        box-shadow: 0 0 60px 10px red;
    }

    .circle.col2{
        background-color: yellow;
        box-shadow: 0 0 60px 10px yellow;
    }

    .circle.col3{
        background-color: green;
        box-shadow: 0 0 60px 10px green;
    }
  </style>
</head>
<body>
  <h1>Traffic Signal Control</h1>
  <div class="container">
    <div class="circle col1" color="col1"></div>
    <div class="circle"   color="col2"></div>
    <div class="circle"   color="col3"></div>
  </div>

  <script>
    // === script.js ===

    // URL to your PHP endpoint (same file)
    const API_ENDPOINT = window.location.pathname;

    const circles = document.querySelectorAll('.circle');
    let flashInterval = null;

    async function sendColor(color) {
      try {
        const res = await fetch(API_ENDPOINT, {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `color=${encodeURIComponent(color)}`
        });
        if (!res.ok) throw new Error(`Status ${res.status}`);
        const data = await res.json();
        console.log('light.php response:', data);
      } catch (err) {
        console.error('Error sending color to server:', err);
      }
    }

    function light(colorClass) {
      circles.forEach(c => {
        c.classList.remove('col1','col2','col3');
        if (c.getAttribute('color') === colorClass) {
          c.classList.add(colorClass);
        }
      });
    }

    function stopFlashing() {
      if (flashInterval) {
        clearInterval(flashInterval);
        flashInterval = null;
      }
    }

    function delay(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function runGreenSequence() {
      stopFlashing();
      sendColor('green');

      light('col1');
      await delay(500);
      light('col2');

      await delay(500);

      light('col3');
    }

    async function runRedSequence() {
      stopFlashing();
      sendColor('red');
      light('col3');
      await delay(500);
      light('col2');
      await delay(500);
      light('col1');
    }

    function startYellowFlashing() {
      stopFlashing();
      sendColor('yellow');
      circles.forEach(c => c.classList.remove('col1','col2','col3'));
      const yellowCircle = document.querySelector('.circle[color="col2"]');
      flashInterval = setInterval(() => {
        yellowCircle.classList.toggle('col2');
      }, 500);
    }

    // initialize
    light('col1');

    circles.forEach(circle => {
      circle.addEventListener('click', () => {
        const color = circle.getAttribute('color');
        switch (color) {
          case 'col3': runGreenSequence(); break;
          case 'col1': runRedSequence();   break;
          case 'col2': startYellowFlashing(); break;
        }
      });
    });
  </script>
</body>
</html>
