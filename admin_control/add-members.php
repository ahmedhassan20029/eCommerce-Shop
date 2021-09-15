<?php
// this page add new members
session_start(); // start sestion

//check session found
if(isset($_SESSION['UserName'])) {

    //incloud file init
    include 'init.php';
// start code html
?>
    <div class='add_members'>
        <h1>add new member</h1>
        <form>
            <div class='mb-3'>
                <label class='form-label'>full name</label>
                <input type='text' class='form-control'/>
            </div>
             <div class='mb-3'>
                <label class='form-label'>user name</label>
                <input type='text' class='form-control'/>
            </div>
            <div class='mb-3'>
                <label class='form-label'>e-mail</label>
                <input type='email' class='form-control'/>
            </div>
            <div class='mb-3'>
                <label class='form-label'>password</label>
                <input type='password' class='form-control'/>
            </div>
            <div class='mb-3'>
                <label class='form-label'>phone</label>
                <input type='tel' class='form-control'/>
            </div>
        </form>
    </div>
















<?php

    //include file footer
    include $dir_templates . 'footer.php';


} else { // if not found sesion redirect page 404.php

    header('location: 404.php');

}