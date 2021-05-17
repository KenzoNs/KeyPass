<?php
class HomeView {
    public function homePage() { ?>

        <div id="container">

                <div id="result_search">

                </div>
            </div>
        </body>
        </html>
    <?php }

    public function chooseActionPage(){ ?>
        <div id="container" class="center">
            <a style="width: 400px" class="button blue large_height all_border_radius" href="?module=user&action=createUser">Ajouter un utilisateur</a></br>
            <a style="width: 400px" class="button blue large_height all_border_radius" href="">Ajouter un groupe</a>
        </div>
    <?php }

}