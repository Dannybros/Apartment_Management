    <div class="col-sm-9 main_box">
        <div class="d-flex justify-content-between align-items-center room_search_bar">
            <select name="floor" id="TypeSelector" class="floorSelector" onchange="showRooms(this.value)">
                <option value="all" selected="select">All</option>
                <option value="1" >Single Rooms</option>
                <option value="2">Double Rooms</option>
                <option value="3">Triple Rooms</option>
                <option value="4">Family Rooms</option>
                <option value="5">King-Sized Rooms</option>
                <option value="6">Master-Suite Rooms</option>
            </select>
            ROOMS
            <div class="input-group" style="width: 200px !important;">
                <div class="input-group-prepend" >
                    <span class="input-group-text" style="background:white; width:40px; padding:0 auto;" id="basic-addon1"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="roomSearchBar" class="form-control" placeholder="Search" value="" onkeyup="searchRoom(this)"/>
            </div>
        </div> 
        <?php
            if(isset($_GET['error'])){
                echo'
                    <div class="alert alert-danger" role="alert">
                        Edit change failed. Please try again!
                    </div>
                ';
            }
            if(isset($_GET['success'])){
                $msg = "adf";
                if($_GET['success'] == "checkout"){
                    $msg="Room Check Out successfully!";
                }else{
                    $msg="Room has edited successfully!";
                }
                echo"
                    <div class='alert alert-success mt-2' role='alert'>
                       <b> $msg </b>
                    </div>
                ";
                
            }
        ?>
        <div class="display__room row" id="display__room">
            <?php
                $room_query = "SELECT * FROM `rooms` NATURAL JOIN `room_type`";
                $room_result = mysqli_query($conn, $room_query);
                while ($rooms = mysqli_fetch_assoc($room_result)) {?>
                    <div class="room__one" data-toggle="modal" data-target="#roomModal<?php echo $rooms['Room_Id'] ?>">
                        <div class="room_box"
                            <?php
                            if($rooms['Status']=="Free"){
                                echo'style="background:rgb(209, 209, 209);"';
                            }else{
                                echo'style="background:rgb(255, 142, 134)"';
                            }
                            ?>
                        >
                            <?php echo $rooms['Room_Name'] ?>
                        </div>
                        <div style="background:white; cursor:pointer; user-select:none"> 
                            <?php echo $rooms['Room_Type_Name'] ?> Room
                            &nbsp; 
                            (<?php echo $rooms['Status'] ?>)
                        </div>
                    </div>
                    
                <?php  }
            ?>
        </div>

        
    </div>
    
    <!--edit modal--->
    <?php
        $roomModal_query="SELECT * FROM `rooms` Natural Join room_type";
        $roomModal_result = mysqli_query($conn, $roomModal_query);
        while ($roomModals = mysqli_fetch_assoc($roomModal_result)) {?>

            <section class="modal fade" id="roomModal<?php echo $roomModals['Room_Id']?>" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel<?php echo $room['Room_Id']?>" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header" >
                            <h5 class="modal-title" id="exampleModalLabel">Room Information (<?php echo $roomModals['Room_Name']?>)</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="includes/dbEditRoom_Customer.php">
                            <main class="modal-body row" style="height:100%; row-gap:20px ">
                                <div class="col-6">
                                    <label>Room ID</label>
                                    <input type="text" class="form-control" id="edit_room__id" name="room__id" readonly value="<?php echo $roomModals['Room_Id']?>"/>
                                </div>
                                <div class="col-6">
                                    <label>Room Name</label>
                                    <input type="text" class="form-control" name="room__name" <?php if($roomModals['Status']!="Free") echo 'readonly'?> value="<?php echo $roomModals['Room_Name']?>"/>
                                </div>
                                <div class="col-6">
                                    <label>Room Type</label>
                                    <select 
                                    name="room_modal_type" 
                                    <?php if($roomModals['Status']!="Free") echo 'disabled'?>
                                    class=" form-control"
                                    style="cursor:pointer; color:black" 
                                    onchange="getRoomTypePrice(this.value, <?php echo $roomModals['Room_Id']?>)"
                                    >
                                        <option value="1" <?php if($roomModals['Room_Type_Id']=="1") echo 'selected="selected" '?> >Single Rooms</option>
                                        <option value="2" <?php if($roomModals['Room_Type_Id']=="2") echo 'selected="selected" '?> >Double Rooms</option>
                                        <option value="3" <?php if($roomModals['Room_Type_Id']=="3") echo 'selected="selected" '?> >Triple Rooms</option>
                                        <option value="4" <?php if($roomModals['Room_Type_Id']=="4") echo 'selected="selected" '?> >Family Rooms</option>
                                        <option value="5" <?php if($roomModals['Room_Type_Id']=="5") echo 'selected="selected" '?> >King-Sized Rooms</option>
                                        <option value="6" <?php if($roomModals['Room_Type_Id']=="6") echo 'selected="selected" '?> >Master-Suite Rooms</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Room Price</label>
                                    <input type="text" class="form-control" id="room_price<?php echo $roomModals['Room_Id']?>" name="room__price" disabled value="<?php echo $roomModals['Room_Type_Price']?>$ / month"/>
                                </div>
                                <div class="col-12 pt-2" style=" border-bottom:1px solid grey" >
                                    <label>Room Status:</label> &nbsp;
                                    <em style="color:<?php if($roomModals['Status']=="Free") echo 'green'; else echo 'darkred'; ?>">(<?php echo $roomModals['Status']?>)</em>
                                </div>
                                <?php 
                                    if($roomModals['Status']=="Booked"){
                                        $RoomName = $roomModals['Room_Name'];
                                        $query= "SELECT * FROM  booking NATURAL JOIN customer WHERE Room_Name='$RoomName'"; //SELECT * FROM rooms NATURAL JOIN booking WHERE Room_Name='$name'
                                        $result = mysqli_query($conn, $query);
                                        $data = mysqli_fetch_array($result);

                                        $total=$data['Total'];
                                        $d1= $data['Check_In'];
                                        $d2 = $data['Check_Out'];
                                        $room_id = $roomModals['Room_Id'];
                                        $room_price = $roomModals['Room_Type_Price'];
                                ?>
                                    <div class="col-6">
                                        <label>Customer Name: </label> &nbsp;
                                        <input type="text" class="form-control" name="customer_name" value="<?php echo $data['Customer_Name']?>"/>
                                    </div>
                                    <div class="col-6">
                                        <label>Customer Email: </label> &nbsp;
                                        <input type="text" class="form-control" name="customer_email" value="<?php echo $data['Customer_Email']?>"/>
                                    </div>
                                    <div class="col-6">
                                        <label>Customer Contact: </label> &nbsp;
                                        <input type="text" class="form-control" name="customer_contact" value="<?php echo $data['Customer_Contact']?>"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                    </div>
                                    <div class="col-6">
                                        <label>Customer ID Card: </label> &nbsp;
                                        <input type="text" class="form-control" name="customer_ID" value="<?php echo $data['Customer_ID_Card']?>"/>
                                    </div>
                                    <div class="col-6">
                                        <label>Check In</label> &nbsp;
                                        <input type="month" class="form-control" id="room_check_in" name="room_check_in" value="<?php echo $d1?>" onchange="getDuration(room_check_in, room_check_out, room_price<?php echo $roomModals['Room_Id']?>, roomDurationEdit, roomCheckTotal)"/>
                                    </div>
                                    <div class="col-6">
                                        <label>Check Out</label> &nbsp;
                                        <input type="month" class="form-control" id="room_check_out" name="room_check_out" value="<?php echo $d2?>" onchange="getDuration(room_check_in, room_check_out, room_price<?php echo $roomModals['Room_Id']?>, roomDurationEdit, roomCheckTotal)"/>
                                    </div>
                                    <div class="col-6">
                                        <label>Duration</label> &nbsp;
                                        <input type="text" class="form-control" id="roomDurationEdit" name="room_stay_duration" value='<?php echo $data['Duration']?> months' readonly/>  
                                    </div>
                                    <div class="col-6">
                                        <label>Total</label> &nbsp;
                                        <input type="text" class="form-control total_input" id="roomCheckTotal" name="room_price_total" value='<?php echo $total?> $' readonly/>
                                    </div>
                                <?php }?>
                            </main>
                            <div class="modal-footer d-flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn btn-success">Edit</button>
                                    
                                    <button type="reset" class="btn btn-danger">Default</button>
                                </div>
                                <div>
                                    <?php
                                        if($roomModals['Status']=="Booked"){
                                    ?>
                                        <button type="button" class="btn btn-warning" onclick='cleanRoom(<?php echo "`$room_id`,`$RoomName`,`$room_price`, `$d1`, `$d2`" ?>)'>Check Out</button>
                                    <?php } ?>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        <?php }
    ?>
</div>
