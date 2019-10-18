<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<footer class="footer">
    <div class="container-fluid">
        <hr>
        <center>
            DSA-Hub Version 1.0
            <br>
            <small>
                Copyright &copy;
                <?php
                $currentYear = date('Y');
                if($currentYear == 2016){
                    echo "2016";
                }
                elseif($currentYear > 2016){
                    echo "2016 - "
                    . $currentYear;
                }
                ?>
                <a href="mailto:andrei.bubeneck@yahoo.com">
                    Wilhelm Andrei Bubeneck
                </a>
                & Web AG
                <br>
                Created using <a href="http://getbootstrap.com/">Bootstrap</a>
                <br>
                <?php
                echo 'Page generated in '.$total_time.' seconds.';
                ?>
            </small>
        </center>
    </div>
    
</footer>