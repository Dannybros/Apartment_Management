    <div class="col-sm-9 main_box">
        <!-- create ROom button div -->
        <div class="d-flex justify-content-between align-items-center py-2 mb-2 room_page_nav">
            ROOMS
            <button class="btn btn-primary" data-toggle="modal" data-target="#CreateRoomModal">Add New Room</button>
        </div>
        <!-- nav searchbar -->
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
            <div class="input-group" style="width: 200px !important;">
                <div class="input-group-prepend" >
                    <span class="input-group-text" style="background:white; width:40px; padding:0 auto;" id="basic-addon1"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="roomSearchBar" class="form-control" placeholder="Search" value="" onkeyup="searchRoom(this)"/>
            </div>
        </div> 

        <!-- success & error message dialog -->
        <?php
            if(isset($_GET['error'])){
                echo'
                    <div class="alert alert-danger" role="alert">
                        Edit change failed. Please try again!
                    </div>
                ';
            }
            if(isset($_GET['success'])){
                $msg = "";
                if($_GET['success'] == "createRoom"){
                    $msg="New Room has been successfully created!";
                } 
                else if($_GET['success'] == "customerInfo"){
                    $msg="Customer Info has edited successfully!";
                }
                else if($_GET['success'] == "checkout"){
                    $msg="Room Check Out successfully!";
                }
                else if($_GET['success'] == "createRoom"){
                    $msg="New Room has been successfully created!";
                }
                else if($_GET['success'] == "del"){
                    $msg="Room has been successfully deleted!";
                }
                else{
                    $msg="Room has edited successfully!";
                }
                echo"
                    <div class='alert alert-success mt-2' role='alert'>
                       <b> $msg </b>
                    </div>
                ";
            }
        ?>

        <!-- display every room info -->
        <div class="display__room row" id="display__room">
            <?php
                $room_query = "SELECT * FROM `rooms` NATURAL JOIN `room_type` ORDER BY Room_Name";
                $room_result = mysqli_query($conn, $room_query);
                while ($rooms = mysqli_fetch_assoc($room_result)) {?>
                    <div class="room__one" >
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
                        <div style="background:white; cursor:pointer; user-select:none; border-bottom:1px solid grey"> 
                            <b>
                                <?php echo $rooms['Room_Type_Name'] ?> Room
                                &nbsp; 
                                (<?php echo $rooms['Status'] ?>)
                            </b>
                        </div>
                        <div class="bg-white p-2 d-flex justify-content-around">
                            <i class="fas fa-pen btn btn-success staff_icon" data-toggle="modal" data-target="#roomModal<?php echo $rooms['Room_Id'] ?>">&nbsp; Room</i>
                            <?php
                            if($rooms['Status']=="Booked"){?>
                                <i class="fas fa-user btn btn-primary staff_icon" data-toggle="modal" data-target="#clientModal<?php echo $rooms['Room_Id'] ?>">&nbsp; Client</i>
                            <?php }?>
                        </div>
                    </div>
                    
                <?php  }
            ?>
        </div>
    </div>

    <!-- Create Room Modal -->
    <div class="modal fade" id="CreateRoomModal" tabindex="-1" role="dialog" aria-labelledby="CreateRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateRoomModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form method="post" action="includes/roomDB/dbCreateRoom.php">
                    <main class="modal-body row" style="height:100%; row-gap:20px" >
                        <div class="col-6">
                            <label>Room Name</label>
                            <input type="text" class="form-control" name="room__name" data-error="please fill in the room title" required/>
                        </div>
                        <div class="col-6">
                            <label>Room Type</label>
                            <select 
                            name="room_modal_type" 
                            class=" form-control"
                            style="cursor:pointer; color:black" 
                            onchange="getRoomTypePrice(this.value, '-New_room')"
                            data-error="please choose the room type"
                            required
                            >
                                <option selected disabled> </option>
                                <option value="1">Single Rooms</option>
                                <option value="2">Double Rooms</option>
                                <option value="3">Triple Rooms</option>
                                <option value="4">Family Rooms</option>
                                <option value="5">King-Sized Rooms</option>
                                <option value="6">Master-Suite Rooms</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Room Price</label>
                            <input type="text" class="form-control" id="room_price-New_room" name="room__price" disabled value="0$ / month"/>
                        </div>
                    </main>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-warning" style="color:white">Start New</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit customer modal -->
    <?php
        $query= "SELECT * FROM  booking NATURAL JOIN customer NATURAL JOIN rooms WHERE `Status` = 'Booked'";
        $result = mysqli_query($conn, $query);
        while($customer= mysqli_fetch_assoc($result)){
            $room_id= $customer['Room_Id'];
            $room_name = $customer['Room_Name'];

            $c_id = $customer['Customer_ID'];
            $c_name = $customer['Customer_Name'];
            $c_email = $customer['Customer_Email'];
            $c_contact = $customer['Customer_Contact'];
            $c_id_card = $customer['Customer_ID_Card']; ?>
            <section class="modal fade" id="clientModal<?php echo $room_id?>" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel<?php echo $room_id?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Customer Info in Room <?php echo $room_name?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="includes/customerDB/dbEditCustomer.php">
                            <main class="modal-body row" style="height:100%; row-gap:20px ">
                                
                                <input type="text" class="form-control" name="customer_id" value="<?php echo $c_id?>" hidden/>

                                <div class="col-6">
                                    <label>Customer Name: </label> &nbsp;
                                    <input type="text" class="form-control" name="customer_name" value="<?php echo $c_name?>"/>
                                </div>

                                <div class="col-6">
                                    <label>Customer Email: </label> &nbsp;
                                    <input type="text" class="form-control" name="customer_email" value="<?php echo $c_email?>"/>
                                </div>

                                <div class="col-6">
                                    <label>Customer Contact: </label> &nbsp;
                                    <input type="text" class="form-control" name="customer_contact" value="<?php echo $c_contact?>"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                </div>

                                <div class="col-6">
                                    <label>Customer ID Card: </label> &nbsp;
                                    <input type="text" class="form-control" name="customer_ID_card" value="<?php echo $c_id_card?>"/>
                                </div>
                            </main>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </section>
        <?php }
    ?>
    
    <!--edit room modal--->
    <?php
        $roomModal_query="SELECT * FROM `rooms` Natural Join room_type";
        $roomModal_result = mysqli_query($conn, $roomModal_query);
        while ($roomModals = mysqli_fetch_assoc($roomModal_result)) {?>

            <section class="modal fade" id="roomModal<?php echo $roomModals['Room_Id']?>" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel<?php echo $roomModals['Room_Id']?>" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header" >
                            <h5 class="modal-title" id="exampleModalLabel">Room Information (<?php echo $roomModals['Room_Name']?>)</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="includes/roomDB/dbEditRoom.php">
                            <main class="modal-body row" style="height:100%; row-gap:20px">

                                <!-- room info -->
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

                                <!-- additional info for booked room (duration and date) -->
                                <?php 
                                    if($roomModals['Status']=="Booked"){
                                        $Room_Id = $roomModals['Room_Id'];
                                        $query= "SELECT * FROM  booking WHERE Room_Id='$Room_Id'";
                                        $result = mysqli_query($conn, $query);
                                        $data = mysqli_fetch_array($result);

                                        $total=$data['Total'];
                                        $d1= $data['Check_In'];
                                        $d2 = $data['Check_Out'];
                                        $room_price = $roomModals['Room_Type_Price'];
                                ?>
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

                                    <!-- button for save-->
                                    <button type="submit" class="btn btn-success">Edit</button>
                                    
                                    <!-- button for reset the modal -->
                                    <button type="reset" class="btn btn-warning">Default</button>
                                </div>
                                <div>

                                    <!-- button for checkout -->
                                    <?php
                                        if($roomModals['Status']=="Booked"){
                                    ?>
                                        <button type="button" class="btn btn-info" onclick='cleanRoom(<?php echo "`$Room_Id`,`$room_price`, `$d1`, `$d2`" ?>)'>Check Out</button>
                                    <?php } ?>

                                    <!-- button for del room -->
                                    <?php
                                        if($roomModals['Status']=="Free"){?>
                                            <button type="button" class="btn btn-danger" onclick='delRoom(<?php echo $roomModals["Room_Id"] ?>)'>Delete</button>
                                    <?php } ?>

                                    <!-- button close modal -->
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
    <?php }?>
</div>
