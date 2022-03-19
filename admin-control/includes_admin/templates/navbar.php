
        <nav>
            <section class='profile-admin'>
                <div class='img-admin'>
                    <img src='layout_admin/images/img-admin.jpg' alt='profile-admin'/>
                </div>
                <p class='name-admin'>
                    <span><?php echo lang('welcome')?></span>
                    <span id='user_db'><?php echo  $_SESSION['Name']?>
                        <i class="flaticon-down-filled-triangular-arrow"></i>
                    </span>
                </p>
                <ul class='' id='setting_admin'>
                    <li>
                        <a href="members.php?action=manage&userid=<?php echo $_SESSION['ID'] ?>"><?php echo lang('manage_profile')?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo lang('settings')?></a>
                    </li>
                    <li>
                        <a href="logout.php"><?php echo lang('logout')?></a>
                    </li>
                </ul>
            </section>
            <section class='db-list'>
                <ul>
                    <li>
                        <a href="dashboard.php"><?php echo lang('dashboard')?></a>
                    </li>
                    <li>
                        <a href="categories.php?action=manege"><?php echo lang('categories')?></a>
                    </li>
                    <li>
                        <a href="items.php?action=manager">items</a>
                    </li>
                    <li>
                        <a href="comments.php?action=manger">comments</a>
                    </li>
                </ul>
            </section>
        </nav>