<div>

    <h1 class="text-center">Games</h1>
    <h3 class="text-center">Welcome, <?php echo($_POST['username']); ?>! Take a look at these games.</h3>
        
    <div class="page-contents text-center">

        <?php

            $file = fopen("data/game_data.csv", "rb");

            if (!$file) {
                die("Error opening $file");
            }

            //this skips the first line of the csv file so the page doesn't try to read the file headers
            fgetcsv($file);

            while (!feof($file)) {
                $game = fgetcsv($file);
                if (!$game) continue;
                $games[] = $game;
            }

            foreach ($games as $game) {
                echo("<div class='mainGameDiv'>
                        <div class='gameImg'><img src='$game[1]'></div>
                        <div class='gameTitle'><h3><a href='$game[3]' target='_blank'>$game[0]</a></h3></div>
                        <div class='gameDesc'>$game[2]</div>
                        <div class='gamePlatform'>Platform: $game[4]</div>
                        <div class='gameGenre'>Genre: $game[5]</div>
                    </div>");
            } 

        ?>

    </div>

</div>