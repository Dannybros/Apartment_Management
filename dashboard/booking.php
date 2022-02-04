    <?php
     $query = "SELECT * FROM  `rooms` NATURAL JOIN `room_type` WHERE `Status` = 'Free'";
     $result = mysqli_query($conn, $query);
    ?>
    <section class="col-sm-9 main_box" id="reservation_section" style="overflow-y:scroll">
        <div id="alertDialog">
            <?php
                if(isset($_GET['success'])){
                    echo'
                        <div class="alert alert-success" role="alert">
                            Registered Success!
                        </div>
                    ';
                }
                if(isset($_GET['fail'])){
                    echo'
                        <div class="alert alert-dangerous" role="alert">
                            Something wrong, please try again!
                        </div>
                    ';
                }
            ?>
        </div>
        <form class="container my-4" action="includes/dbBooking.php" method="post">
            <main class="bg-white h-100 p-3">
                <h4 class="reservation_title pb-2 mb-4">
                    Room Information
                </h4>
                <div class="booking__panel row mb-2">
                    <article class="form-group col-lg-6">
                        <label><b> Room Type</b></label>
                        <select class="form-control" id="ReserverRoomType" name="roomType"  onchange="fetchFreeRoom(this.value)" data-error="Select Room Type" required>
                            <option selected disabled> Select the Room Type</option>
                            <option value="1"> Single Rooms</option>
                            <option value="2"> Double Rooms</option>
                            <option value="3"> Triple Rooms</option>
                            <option value="4"> Family Rooms</option>
                            <option value="5"> King-Sized Rooms</option>
                            <option value="6"> Master-Suite Rooms</option>
                        </select>
                    </article>
                    <article class="col-lg-6 form-group">
                        <label><b>Room No.</b> </label>
                        <select 
                            class="form-control" 
                            id="availableRoomName" 
                            name="roomName" 
                            data-error="Select Room Type" 
                            required
                        >
                            <option selected disabled> </option>
                        </select>
                    </article>
                    <article class="col-lg-6 form-group">
                        <label><b> Check In Date</b></label>
                        <input 
                            type="month" 
                            id="check_in_reserve" 
                            onchange="getDuration(check_in_reserve, check_out_reserve, booking_room_price, booking_duration, booking_total)"  
                            name="checkInDate" 
                            class="form-control" 
                            min="<?php echo date("Y-m"); ?>" 
                            data-error="Select Check In Date"  
                            required
                        >
                        <div class="help-block with-errors"></div>
                    </article>
                    <article class="col-lg-6 form-group">
                        <label> <b>Check Out Data</b></label>
                        <input 
                            type="month" 
                            id="check_out_reserve" 
                            onchange="getDuration(check_in_reserve, check_out_reserve, booking_room_price, booking_duration, booking_total)" 
                            name="checkOutDate" 
                            class="form-control" 
                            min="<?php echo date("Y-m"); ?>" 
                            data-error="Select Check Out Date" 
                            required
                        >
                    </article>
                </div>
                <h5 class="ml-3">
                    <b>Duration: 
                        <input 
                            class="booking_duration"
                            type="text" 
                            name="duration" 
                            style="width:25px" 
                            readonly 
                            value="0" 
                            id="booking_duration"
                        > Month(s)
                    </b>
                </h5>
                <h5 class="ml-3">
                    <b>Price: 
                        <input 
                            type="text"
                            name="price" 
                            size='3' 
                            readonly 
                            value="0" 
                            class="booking_room_price"
                            id="booking_room_price"
                        > /$
                    </b>
                </h5>
                <h5 class="ml-3">
                    <b>Total Amount: 
                        <input 
                            type="text" 
                            name="total" 
                            size='3' 
                            value="0" 
                            class="booking_total"
                            id="booking_total"
                            readonly
                        > /$
                    </b>
                </h5>
            </main>

            <main class="bg-white h-100 p-3 my-4">
                <h4 class="customer_info pb-2 mb-4">
                    Customer Info
                </h4>
                <div class="booking__panel row mb-2">
                    <article class="col-lg-6 form-group">
                        <label><b>First Name</b> </label>
                        <input type="text" class="form-control" id="customer_firstName" name="customer_firstName" placeholder="First Name..." onkeypress="return /[a-z]/i.test(event.key)" data-error="Type First Name" required/>
                    </article>
                    <article class="col-lg-6 form-group">
                        <label><b> Last Name</b></label>
                        <input type="text" class="form-control" id="customer_lastName" name="customer_lastName" placeholder="Last Name..." onkeypress="return /[a-z]/i.test(event.key)" data-error="Type Last Name" required/>
                    </article>
                    <article class="col-lg-6 form-group">
                        <label> <b>Contact Number</b></label>
                        <input type="text" class="form-control" id="customer_contact" name="customerContact" placeholder="Contact No..." data-error="Fill in Contact Number" 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required/>
                    </article>
                    <article class="col-lg-6 form-group">
                        <label> <b>Email</b></label>
                        <input type="email" class="form-control" id="customer_email" name="customerEmail" placeholder="Email Address..." data-error="Fill in Email Address" required/>
                    </article>
                    <article class="col-lg-6 form-group">
                        <label> <b>ID Card / Passport</b></label>
                        <input type="text" class="form-control" id="customer_id_card" name="customerIdCard" placeholder="ID Card / Passport..." data-error="Fill in ID card / Passport number" required/>
                    </article>
                </div>
            </main>
            <main class="bg-white h-100 p-3 my-4 d-flex" >
                <button type="submit" class="btn btn-lg btn-success w-100 mx-3">Submit</button>
                <button type="reset" class="btn btn-lg btn-danger w-100 mx-3">Reset</button>
            </main>
        </form>
    </section>
</div>
