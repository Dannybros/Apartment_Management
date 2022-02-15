<div class="row">
    <div id="sidebar-collapse" class="col-sm-3 sidebar">
        <div id = "sidebar_nav" class="sidebar_nav">
            <span style="color:gold">Apartment &nbsp; </span> Management System</a>
        </div>
        
        <div class="profile_sidebar p-3 mb-2">
            <img src="img/user.png" alt="user">
            <div class="profile_name">
                <span>
                    <?php echo"$username"?>
                </span> <br> 
                <div  style="display: flex; align-items:center">
                    <div class="green__circle"></div>
                    Manager
                </div> 
            </div>
        </div>

        <ul class="menu__box">
            <li>
                <a href="index.php?room" class="menu__list <?php if (isset($_GET['room'])) echo 'active_list'?>">
                    <em class="fas fa-building">&nbsp;</em>
                    Room Management
                </a>
            </li>
            <li>
                <a href="index.php?booking" class="menu__list <?php if (isset($_GET['booking'])) echo 'active_list'?>">
                    <em class="fas fa-concierge-bell">&nbsp;</em>
                    Room Booking
                </a>
            </li>
            <li>
                <a href="index.php?staff" class="menu__list <?php if (isset($_GET['staff'])) echo 'active_list'?>">
                    <em class="fas fa-user">&nbsp;</em>
                    Staff
                </a>
            </li>
            <li>
                <a href="index.php?setting" class="menu__list <?php if (isset($_GET['setting'])) echo 'active_list'?>">
                    <em class="fas fa-sliders-h">&nbsp;</em>
                    Setting
                </a>
            </li>
            <li>
                <a href="index.php?report" class="menu__list <?php if (isset($_GET['report'])) echo 'active_list'?>">
                    <em class="fas fa-report">&nbsp;</em>
                    Report
                </a>
            </li>
            
        </ul>
        <section class="date_display mx-3">
            <?php 
                date_default_timezone_set("Asia/Bangkok");
                $date = date("Y/m/d");
                $time = date("h:i:a");
                echo "Today is <b> $date &nbsp; ($time)</b>";
            ?>
            <br/>
            You have logged in <span id="second_counter">00:00</span> seconds ago
        </section>
        <script>
            function loginTimer(){
                var el = document.getElementById('second_counter');
                var second =0;
                var minute = 0;
                
                function twoDigitNumber(num){
                    let result = num.toLocaleString('en-US', {
                        minimumIntegerDigits: 2,
                        useGrouping: false
                    })
                    return result;
                }
                
                function counterTimer(){
                    second+=1;
        
                    minute += Math.floor(second/60);
        
                    second = second%60;
                    el.innerText = twoDigitNumber(minute) +":" + twoDigitNumber(second);
                }
        
                setInterval(counterTimer, 1000);
            }
            loginTimer();
        </script>
    </div>