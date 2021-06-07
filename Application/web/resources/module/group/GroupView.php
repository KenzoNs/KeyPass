<?
class GroupView {
    public function createGroupePage($info=null) { ?>
        <div id="container" style="flex-direction: column; align-items: center; justify-content: center">
            <form action="?module=group&action=doCreateGroup" style="display: flex; width: 100%; flex-direction: column; flex: 1;" method="post">
                <div style="display: flex; align-items: center; margin-bottom: var(--medium-marge)">
                    <label style="width:150px" for="group_name">Nom (*):</label>
                    <input id="group_name" tabindex="1" class="all_border_radius small_height" style="width: 250px" type="text" name="group_name" placeholder="Nom groupe" required>
                </div>

                <div id="error_authentication_container" class="small_bottom_marge">
                    <?=$info!=null?''.$info.'':''?>
                </div>

                <div style="display: flex;  width: 100%">
                    <a tabindex="3" href="?module=home&action=chooseAction" class="medium_right_marge button red max_width small_height all_border_radius ">Annuler</a>
                    <input tabindex="2" class="button green max_width small_height all_border_radius" type="submit" value="Valider">
                </div>
            </form>
        </div>
 <? }
}

