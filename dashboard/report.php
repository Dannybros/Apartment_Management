    <section class="col-sm-9 main_box p-4">
        <div class="d-flex bg-white px-4 py-3 mb-3">
            <h2 class="m-0">
                Total Earned: 
                <?php
                    $sql ="SELECT SUM(`Total`) AS sum FROM `booking`";
                    $result = mysqli_query($conn, $sql);

                    $sum = mysqli_fetch_assoc($result)['sum'];

                    echo"<span id='booking_total_revenue' style='font-weight:bold'> $sum $</span>"
                ?>
            </h2>
        </div>
        <div class="bg-white px-4 py-3">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <input type="month" id="reportMonthly_Input" class="form-control mr-2" style="width:200px" onchange="searchBooking()">
                    <button class="btn btn-dark" onclick="resetMonthly_Input()">Clear</button>
                </div>

                <div class="input-group" style="width: 200px !important;">
                    <div class="input-group-prepend" >
                        <span class="input-group-text" style="background:white; width:40px; padding:0 auto;" id="basic-addon1"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" id="bookingSearchBar" class="form-control" placeholder="Search" value="" onkeyup="searchBooking()"/>
                </div>
            </div>
            <ul class="staff_table mt-3">
                <li class="d-flex" style="border-bottom:1px solid grey">
                    <span class="col-1 staff_list"> <b> ID </b>  </span>
                    <span class="col-2 staff_list"> <b> Customer Name </b> </span>
                    <span class="col-2 staff_list"> <b> Room Name </b> </span>
                    <span class="col-1 staff_list"> <b> Price </b>  </span>
                    <span class="col-2 staff_list"> <b> Check In </b> </span>
                    <span class="col-2 staff_list"> <b> Check Out </b> </span>
                    <span class="col-1 staff_list"> <b> Duration </b> </span>
                    <span class="col-1 staff_list"> <b> Total </b> </span>
                </li>
                <div id="bookingList">

                    <?php

                        $sql ="SELECT * FROM `booking` NATURAL JOIN rooms NATURAL JOIN customer NATURAL JOIN room_type";
                        $result = mysqli_query($conn, $sql);

                        while($booking = mysqli_fetch_array($result)){
                            $id = $booking['Booking_Id'];
                            $c_name = $booking['Customer_Name'];
                            $r_name = $booking['Room_Name'];
                            $price = $booking['Room_Type_Price']; 
                            $check_in = $booking['Check_In'];
                            $check_out = $booking['Check_Out'];
                            $duration = $booking['Duration'];
                            $total = $booking['Total']; ?> 

                            <li class="d-flex">
                                <span class="col-1 staff_list"> <?php echo $id?> </span>
                                <span class="col-2 staff_list"> <?php echo $c_name?> </span>
                                <span class="col-2 staff_list"> <?php echo $r_name?> </span>
                                <span class="col-1 staff_list"> <?php echo $price?> </span>
                                <span class="col-2 staff_list"> <?php echo $check_in?> </span>
                                <span class="col-2 staff_list"> <?php echo $check_out?> </span>
                                <span class="col-1 staff_list"> <?php echo $duration?> </span>
                                <span class="col-1 staff_list"> <?php echo $total?> </span>
                            </li>
                        <?php }
                    ?>

                </div>
            </ul>
        </div>
    </section>
</div>