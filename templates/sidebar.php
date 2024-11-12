<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

<body>
    <a class="profile" href="home.php">
        Admin
        <svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="35px" fill="#8B5CF6">
            <path
                d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z" />
        </svg>
    </a>
    <nav>
        <img src="img/Logo.svg" alt="logo-schedulepal" width="170px">
        <div class="nav-links">
            <a href="fakultas.php" id="fakultas">
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                    fill="#8B5CF6">
                    <path
                        d="M240-80q-50 0-85-35t-35-85v-560q0-50 35-85t85-35h440v640H240q-17 0-28.5 11.5T200-200q0 17 11.5 28.5T240-160h520v-640h80v720H240Zm120-240h240v-480H360v480Zm-80 0v-480h-40q-17 0-28.5 11.5T200-760v447q10-3 19.5-5t20.5-2h40Zm-80-480v487-487Z" />
                </svg>
                Fakultas
            </a>
            <a href="requests.php" id="requests">
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                    fill="#8B5CF6">
                    <path
                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v268q-19-9-39-15.5t-41-9.5v-243H200v560h242q3 22 9.5 42t15.5 38H200Zm0-120v40-560 243-3 280Zm80-40h163q3-21 9.5-41t14.5-39H280v80Zm0-160h244q32-30 71.5-50t84.5-27v-3H280v80Zm0-160h400v-80H280v80Zm200-190q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM720-40q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40Zm-20-80h40v-100h100v-40H740v-100h-40v100H600v40h100v100Z" />
                </svg>
                Schedule Requests
            </a>
            <a href="user.php" id="user">
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                    fill="#8B5CF6">
                    <path
                        d="M186.67-120q-27 0-46.84-19.83Q120-159.67 120-186.67v-586.66q0-27 19.83-46.84Q159.67-840 186.67-840h194q3.33-36.67 32-63.67 28.66-27 67.33-27t67.33 27q28.67 27 32 63.67h194q27 0 46.84 19.83Q840-800.33 840-773.33v586.66q0 27-19.83 46.84Q800.33-120 773.33-120H186.67ZM480-811.33q13 0 21.5-8.5t8.5-21.5q0-13-8.5-21.5t-21.5-8.5q-13 0-21.5 8.5t-8.5 21.5q0 13 8.5 21.5t21.5 8.5ZM186.67-226.67q58-55 132.43-88.16Q393.53-348 479.93-348t160.9 33.17q74.5 33.16 132.5 88.16v-546.66H186.67v546.66Zm294.66-200.66q58 0 98.34-40.34Q620-508 620-566t-40.33-98.33q-40.34-40.34-98.34-40.34T383-664.33Q342.67-624 342.67-566T383-467.67q40.33 40.34 98.33 40.34ZM250-186.67h460V-196q-50-42.33-108.33-63.83-58.34-21.5-121.67-21.5t-121.67 21.5Q300-238.33 250-196V-186.67ZM481.33-494q-30 0-51-21t-21-51q0-30 21-51t51-21q30 0 51 21t21 51q0 30-21 51t-51 21Zm-1.33-6.33Z" />
                </svg>
                User Schedule
            </a>
        </div>
        <div class="lower-nav">
            <a class="logout-button" href="logOut.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px"
                    fill="#8B5CF6">
                    <path
                        d="M120-120v-80h80v-640h400v40h160v600h80v80H680v-600h-80v600H120Zm160-640v560-560Zm160 320q17 0 28.5-11.5T480-480q0-17-11.5-28.5T440-520q-17 0-28.5 11.5T400-480q0 17 11.5 28.5T440-440ZM280-200h240v-560H280v560Z" />
                </svg>
                Log Out
            </a>
            <p>©2024 by Svelte Group</p>
        </div>
    </nav>
</body>
<script src="scripts/sidebar.js"></script>