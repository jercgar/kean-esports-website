<?php include 'dbtab.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kean University eSports Arena</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        /* Additional CSS for header */
        header {
            background-color: #007bff; /* Bootstrap primary color */
            color: #fff; /* White text */
            padding: 20px; /* Add padding to the header */
            text-align: center; /* Center align the text */
        }

        /* Additional CSS for vertical line */
        .vertical-line {
            border-left: 1px solid #ccc;
            height: 30px; /* Adjust height as needed */
            margin: 0 10px; /* Adjust margin as needed */
        }

        .carousel {
  width: 100%;
  max-width: 600px; /* Adjust the width as needed */
  margin: 0 auto;
  position: relative;
  overflow: hidden;
}

.carousel-inner {
  display: flex;
  transition: transform 0.5s ease;
}

.carousel-item {
  width: 100%;
  flex: 0 0 auto;
}

.carousel-item img {
  width: 100%;
  height: auto;
}

.carousel-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.5);
  color: #000000;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 2;
}

.prev {
  left: 100;
}

.next {
  right: 100;
}
    </style>
</head>
<body>
    <header>
        <h1>Kean University eSports Arena</h1>
    </header>
    <nav class="navbar navbar-expand-lg" style="background-color: #154360;">
        <div class="container-fluid">
            <a class="navbar-brand"><img src="logos/KeanEsportsLogo_2.png" alt="Logo" height="100"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <?php echo $loginOption; ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="AboutUs.html">About</a>
                    </li>
                    <li class="nav-item">
                    <a class="btn btn-outline-light" href="availability.php">PC Availability</a>
                    </li>
                    <?php echo $dailyLogOption; ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="OperationHours.php">Hours</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="Download_Request_Form.php">Download Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="Rules.php">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="FAQ.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="Esports.html">Esports</a>
                    </li>
                    <?php echo $accountManagerOption; ?>
                    <?php echo $logoutOption; ?>
                </ul>
                <ul class="navbar-nav">
                    <!-- New list item for social media icons -->
                    <li class="nav-item">
                        <a class="nav-link" href="https://twitter.com/Kean_Esports" target="_blank"><img src="logos/xlogo.png" alt="Twitter Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                    <!-- Vertical line between icons -->
                    <li class="nav-item vertical-line"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.twitch.tv/kean_esports" target="_blank"><img src="logos/twitchlogo.png" alt="Twitch Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                    <!-- Vertical line between icons -->
                    <li class="nav-item vertical-line"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.instagram.com/kean_esports" target="_blank"><img src="logos/instagram.png" alt="Instagram Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                    <!-- Vertical line between icons -->
                    <li class="nav-item vertical-line"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://discord.gg/VEsmrtBM" target="_blank"><img src="logos/DiscordLogo.png" alt="Discord Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="home-page-main">
    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="youtube-video-1"></div>
                    <p class="card-text">Witness the Grand Opening of Kean University's eSports Arena</p>
                    <a href="https://youtu.be/LVuf_rm7TLg?si=xzkmi9TZGhKqfihT" class="btn btn-outline-primary">Click Here</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="youtube-video-2"></div>
                    <p class="card-text">Let's see how Kean University is changing the playing field with eSports</p>
                    <a href="https://youtu.be/hGYbm2clw8Q?si=r5NjGlVYkHPpuvHM" class="btn btn-outline-primary">Click Here</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>
    <div id="instagramCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <!-- Embedded Instagram post from the first link -->
          <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/reel/C20S_MhOB3v/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style="background:#FFF;border:0;border-radius:3px;box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15);margin:1px;max-width:540px;min-width:326px;padding:0;width:99.375%;width:-webkit-calc(100% - 2px);width:calc(100% - 2px);">
            <!-- Instagram Embed Code -->
          </blockquote>
          <script async src="//www.instagram.com/embed.js"></script>
        </div>
        <div class="carousel-item">
          <!-- Embedded Instagram post from the second link -->
          <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/reel/C2skZP8uPuU/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style="background:#FFF;border:0;border-radius:3px;box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15);margin:1px;max-width:540px;min-width:326px;padding:0;width:99.375%;width:-webkit-calc(100% - 2px);width:calc(100% - 2px);">
            <!-- Instagram Embed Code -->
          </blockquote>
          <script async src="//www.instagram.com/embed.js"></script>
        </div>
        <div class="carousel-item">
          <!-- Embedded Instagram post from the third link -->
          <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/reel/C4ZLmWYLhD0/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style="background:#FFF;border:0;border-radius:3px;box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15);margin:1px;max-width:540px;min-width:326px;padding:0;width:99.375%;width:-webkit-calc(100% - 2px);width:calc(100% - 2px);">
            <!-- Instagram Embed Code -->
          </blockquote>
          <script async src="//www.instagram.com/embed.js"></script>
        </div>
        <!-- Add more carousel items with embedded Instagram posts here -->
      </div>
    </div>
    
    
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<!-- Remove your custom JavaScript code -->

<script>
  // Initialize the carousel using Bootstrap
  $(document).ready(function(){
    $('#instagramCarousel').carousel();
  });
</script>

</main>
    <br><br><br><br><br><br><br>
    <footer class="footer">
        <div class="container text-center">
            <!-- Footer Links -->
            <p>Connect to the rest of Kean:</p>
            <a href="https://kean.edu" target="_blank">Kean University Website</a>
            <span class="footer-divider">|</span>
            <a href="https://keanathletics.com" target="_blank">Kean Athletics</a>
            <span class="footer-divider">|</span>
            <a href="https://webreg.kean.edu/WebAdvisor/WebAdvisor?TYPE=M&PID=CORE-WBMAIN&TOKENIDX=1241765240" target="_blank">KeanWISE</a>
            <span class="footer-divider">|</span>
            <a href="https://selfservice.kean.edu/Student/" target="_blank">Student Planning</a>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var options = {
            width: "100%",
            height: "400",
            channel: "Kean_eSports",
            autoplay: true,
            parent: ["localhost"]
        };
        var player = new Twitch.Player("player", options);
        player.setVolume(0.5);

        // YouTube API callback function
        function onYouTubeIframeAPIReady() {
            var player1 = new YT.Player('youtube-video-1', {
                height: '315',
                width: '100%',
                videoId: 'LVuf_rm7TLg',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
                
            });

            var player2 = new YT.Player('youtube-video-2', {
                height: '315',
                width: '100%',
                videoId: 'hGYbm2clw8Q',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });

            var currentPlayer;

            function onPlayerReady(event) {
                currentPlayer = event.target;
                currentPlayer.mute();
                currentPlayer.playVideo();
            }

            function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.ENDED) {
                    event.target.seekTo(0); // Seek to the beginning of the video
                    event.target.playVideo(); // Play the video again
                }
            }
        }
    </script>
    <script src="https://www.youtube.com/iframe_api"></script>
</body>
</html>