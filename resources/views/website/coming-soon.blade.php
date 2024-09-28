<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            background-color: #222;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .particle {
            position: absolute;
            background-color: #fff;
            border-radius: 50%;
            pointer-events: none;
            animation: moveParticle linear infinite;
        }

        @keyframes moveParticle {
            0% {
                transform: translateY(0) translateX(0);
            }
            100% {
                transform: translateY(-100vh) translateX(100vw);
            }
        }

        .container {
            background-color: #333;
            padding: 100px 20px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in-out;
            transition: transform 0.3s ease-in-out;
            position: relative;
            max-width: 700px;
            width: 100%;
            box-sizing: border-box;
        }

        .container:hover {
            transform: scale(1.05);
        }

        h1 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        p {
            color: #aaa;
            margin-bottom: 30px;
        }

        #countdown {
            display: flex;
            justify-content: space-around;
            font-size: 2rem;
            color: #fff;
            margin-bottom: 30px;
        }

        .countdown-btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #555;
            color: #fff;
            border: none;
            border-radius: 8px;
            margin: 0 10px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
            font-weight: bolder;
        }

        .countdown-btn:hover {
            transform: scale(1.1);
        }

        .colon {
            font-size: 2rem;
            color: #555;
            margin: 0 10px;
        }

        .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            max-width: 150px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }

            p {
                font-size: 1rem;
            }

            #countdown {
                font-size: 1.5rem;
            }

            .countdown-btn {
                padding: 10px 20px;
                margin: 0 5px;
            }

            .colon {
                font-size: 1.5rem;
                margin: 0 5px;
            }
        }
    </style>
</head>
<body>

<div class="particles"></div>

<div class="container">
    <img src="path/to/your/logo.png" alt="Logo" class="logo">
    <h1>Coming Soon</h1>
    <p>We're working on something awesome. Stay tuned!</p>
    <div id="countdown">
        <button class="countdown-btn" id="days"></button>
        <span class="colon">:</span>
        <button class="countdown-btn" id="hours"></button>
        <span class="colon">:</span>
        <button class="countdown-btn" id="minutes"></button>
        <span class="colon">:</span>
        <button class="countdown-btn" id="seconds"></button>
    </div>
</div>

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("dec 8, 2023 00:00:00").getTime();

    // Update the countdown every 1 second
    var x = setInterval(function() {
        // Get the current date and time
        var now = new Date().getTime();

        // Calculate the remaining time
        var distance = countDownDate - now;

        // Calculate days, hours, minutes, and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the countdown
        document.getElementById("days").innerHTML = days + "d";
        document.getElementById("hours").innerHTML = hours + "h";
        document.getElementById("minutes").innerHTML = minutes + "m";
        document.getElementById("seconds").innerHTML = seconds + "s";

        // If the countdown is over, display a message
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
    }, 1000);

    // Create particles
    var particlesContainer = document.querySelector('.particles');

    for (var i = 0; i < 50; i++) {
        var particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.width = Math.random() * 10 + 'px';
        particle.style.height = particle.style.width;
        particle.style.top = Math.random() * 100 + 'vh';
        particle.style.left = Math.random() * 100 + 'vw';
        particlesContainer.appendChild(particle);
    }
</script>

</body>
</html>
