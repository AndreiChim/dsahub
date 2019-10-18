<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * COMMON DATABASE FOR PARENT PAGE AND ALL MODULES
 * These are the database login details defined as constants at runtime
 */  
define("HOST", "localhost:3306");     // The host you want to connect to.
define("USER", "alumnidb");    // The database username. 
define("PASSWORD", "@n3Bub3n3ck!");    // The database password. 
define("DATABASE", "alumni_");    // The database name.

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);