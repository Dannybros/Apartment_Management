//rooms

function showRooms(str){
    var search_query = document.getElementById('roomSearchBar').value;
    let sendQ = `${str}*${search_query}`;
    loadRooms(sendQ);
}

function searchRoom(search){
    let room_type = document.getElementById('TypeSelector').value;
    let searchQ = `${room_type}*${search.value}`;
    loadRooms(searchQ);
}

function loadRooms(query){
    
    var display_room = document.getElementById('display__room');
    $.ajax({
        url:`includes/roomDB/dbGetRooms.php?query=${query}`,
        type:"GET",
        dataType:"JSON",
        success: function(res){
            display_room.innerHTML="";
            for(var i=0; i<res.length; i++){
                let status = res[i].status;
                let style ='';
                if(status=='Free'){
                    style="background:rgb(209, 209, 209)";
                }else{
                    style="background:rgb(255, 142, 134)";
                }

                var display=`
                    <div class="room__one">
                        <div class="room_box" style='${style}'>
                            ${res[i].name}
                        </div>
                        <div style="background:white; cursor:pointer; user-select:none border-bottom:1px solid grey"> 
                        ${res[i].type} Room
                            &nbsp; 
                            (${status})
                        </div>
                        <div class="bg-white p-2 d-flex justify-content-around">
                            <i class="fas fa-pen btn btn-success staff_icon" data-toggle="modal" data-target="#roomModal${res[i].id}">&nbsp; Room</i>
                            ${status==='Booked'?
                               `<i class="fas fa-user btn btn-primary staff_icon" data-toggle="modal" data-target="#clientModal${res[i].id}">&nbsp; Client</i>`
                               :
                               ``                       
                            }
                        </div>
                    </div>
                `
               display_room.innerHTML+=display;
            }
        }

    })
}

function getRoomTypePrice(roomTypeId, id){
    var price = document.getElementById(`room_price${id}`);
    $.ajax({
        url:`includes/roomDB/dbGetRoomPrice.php?roomType=${roomTypeId}`,
        type:"GET",
        dataType:"JSON",
        success: function(res){
            let val = res['Room_Type_Price'];
            price.value = val+"$ / month";
        }   
    })
}

function fetchFreeRoom(room_id){

    var roomNames = document.getElementById('availableRoomName');
    var room_price = document.getElementById('booking_room_price');
    var total = document.getElementById('booking_total');
    var duration = document.getElementById('booking_duration');

    if(room_id!=null){
        $.ajax({
            url:`includes/roomDB/dbGetRooms.php?roomId=${room_id}`,
            type:"GET",
            dataType:"JSON",
            success: function(res){
                roomNames.innerHTML="<option selected disabled> Select the Room Number</option>";

                room_price.value=res[0].price + " $";
                
                total.value=(parseInt(duration.value) * res[0].price) + " $";
                
                for(var i =0; i<res.length; i++){
                    var display =`
                        <option value='${res[i].id}'>${res[i].name}</option>
                    `;
                    roomNames.innerHTML+=display;
                }
            }   
        })
    }
}

function getMonthBetween(d1, d2){
    var year = (d2.split('-')[0] - d1.split('-')[0]) * 12;
    var month = d2.split('-')[1] - d1.split('-')[1];

    return (year+month);
}

function getNextMonth(d){
    var year =parseInt( d.split('-')[0]);
    var month = parseInt(d.split('-')[1]);

    let new_month = (month + 1).toLocaleString('en-US', {
        minimumIntegerDigits: 2,
        useGrouping: false
    });
    let new_year = year;

    if(new_month>12){
        new_month= (new_month % 12).toLocaleString('en-US', {
            minimumIntegerDigits: 2,
            useGrouping: false
        });;
        new_year +=1;
    }

    return new_year +"-"+ new_month;
}

function getDuration(d1, d2, price, duration, total){
    if(d1.value!==""){
        d2.min=getNextMonth(d1.value);
        d2.focus();
    }

    if(d1.value !=="" && d2.value !==""){
        let totalStay = getMonthBetween(d1.value, d2.value);
        duration.value= totalStay + " months";
        total.value = (totalStay * parseInt(price.value)) + " $";
    }
}

function cleanRoom(roomId, price, d1, d2){

    const d = new Date();

    const dateMonth = (d.getMonth()+1).toLocaleString('en-US', {
        minimumIntegerDigits: 2,
        useGrouping: false
    });

    const currentDate = `${d.getFullYear()}-${dateMonth}`;

    if(getMonthBetween(currentDate, d1)>0){
        const confirmCheckout= confirm(`Are you willing to cancel the booking?`);
        if(confirmCheckout){
            dataOption = {
                id:roomId,
                checkout:'cancel'
            }
        }

    }else{
        const dateDiff = getMonthBetween(currentDate, d2);
        
        let dataOption={};
    
        if(dateDiff>=0){
            dataOption = {
                id:roomId,
                checkout:'onTime'
            }
        }else{
            const confirmCheckout= confirm(`You still have ${dateDiff} months left to stay. Do you will wish to check out?`);
            if(confirmCheckout){
                const duration = getMonthBetween(d1, currentDate);
                const total = price * duration;
                dataOption={
                    id:roomId,
                    d2:currentDate,
                    duration:duration,
                    total:total,
                    checkout:'earlier'
                };
            }
        }
    }

    $.ajax({
        url:`includes/roomDB/dbCheckout.php`,
        type:"GET",
        data:dataOption,
        success: function(res){
            if(res==='failed'){
                alert("SQL failed. Please try again")
            }
            if(res==='success'){
                window.location.replace('index.php?room&success=checkout')
            }
        }
    })

}

function delRoom(roomId){
    $.ajax({
        url:`includes/roomDB/dbDelRoom.php`,
        type:"GET",
        data:{
            id:roomId
        },
        success: function(res){
            if(res==='success'){
                window.location.replace('index.php?room&success=del');
            }
            if(res==='failed'){
                alert("SQL failed. Please try again");
            }
        }
    })
}


//staff

function delStaff(staffId){

    const confirmDelStaff= confirm(`Do you wish to delete this staff?`);

    if(confirmDelStaff){
        $.ajax({
            url:`includes/staffDB/dbDelStaff.php`,
            type:"GET",
            data:{
                id:staffId
            },
            success: function(res){
                if(res==='success'){
                    window.location.replace('index.php?staff&success=delStaff');
                }
                if(res==='failed'){
                    alert("SQL failed. Please try again");
                }
            }
        })
    }
}

function searchStaff(search){
    const display_staff = document.getElementById('staff_list_display');

    display_staff.innerHTML="";

    $.ajax({
        url:`includes/staffDB/dbSearchStaff.php?query=${search}`,
        type:"GET",
        dataType:"JSON",
        success: function(res){
            for(var i =0; i<res.length; i++){
               var display = `
                    <li class="d-flex justify-content-between">
                        <span class="col-1 staff_list">
                            ${res[i].id}
                        </span>
                        <span class="col-2 staff_list" style="text-transform: capitalize;">
                            ${res[i].name}
                        </span>
                        <span class="col-2 staff_list">
                            ${res[i].job}
                        </span>
                        <span class="col-3 staff_list">
                            ${res[i].shift}
                        </span>
                        <span class="col-1 staff_list">
                            ${res[i].salary} $
                        </span>
                        <span class="col-1 staff_list">
                            <button class="btn_staff_shift" data-toggle="modal" data-target="#ChangeShift${res[i].id}">
                                Change
                            </button>
                        </span>
                        <span class="col-2 staff_list justify-content-around">
                                <i class="fas fa-pen btn btn-primary staff_icon" data-toggle="modal" data-target="#EditStaff${res[i].id}"></i>
                                <i class="fas fa-trash btn btn-danger staff_icon" onclick="delStaff(${res[i].id})"></i>
                                <i class="fas fa-eye btn btn-success staff_icon"></i>
                        </span>
                    </li>
               `
               display_staff.innerHTML+=display;
            }
        }
    })
}

//setting
function delSettingType(dataTable, dataField, RoomTypeID){
    const confirmDelStaff= confirm(`Do you wish to delete ?`);

    if(confirmDelStaff){
        $.ajax({
            url:`includes/settingDB/dbDelSettingType.php`,
            type:"GET",
            data:{
                id:RoomTypeID,
                dt:dataTable,
                dt_field:dataField
            },
            success: function(res){
                if(res==='success'){
                    window.location.replace('index.php?setting&success=delSetting');
                }
                if(res==='failed'){
                    alert("SQL failed. Please try again");
                }
            }
        })
    }
}

//report

function resetMonthly_Input(){
    var date = document.getElementById('reportMonthly_Input');
    var search = document.getElementById('bookingSearchBar').value;

    date.value="";
    loadBookingSearch(date.value, search)
}

function searchBooking(){
    var date = document.getElementById('reportMonthly_Input').value;
    var search = document.getElementById('bookingSearchBar').value;
    loadBookingSearch(date, search)
}

function loadBookingSearch(date, search){
    var booking_display = document.getElementById('bookingList');
    var total_revenue = document.getElementById('booking_total_revenue');
    var sum =0;

    $.ajax({
        url:`includes/reportDB/dbReport.php`,
        type:"POST",
        data:{
            date:date,
            search:search,
        },
        dataType:"JSON",
        success: function(res){
            booking_display.innerHTML="";
            total_revenue.textContent = "0 $"
            
            for(var i =0; i<res.length; i++){
                
                sum +=parseInt(res[i].total);
                total_revenue.textContent = `${sum} $`;

                var display =`
                    <li class="d-flex">
                        <span class="col-1 staff_list"> ${res[i].id} </span>
                        <span class="col-2 staff_list"> ${res[i].c_name} </span>
                        <span class="col-2 staff_list"> ${res[i].r_name} </span>
                        <span class="col-1 staff_list"> ${res[i].price} $ </span>
                        <span class="col-2 staff_list"> ${res[i].check_in} </span>
                        <span class="col-2 staff_list"> ${res[i].check_out} </span>
                        <span class="col-1 staff_list"> ${res[i].duration} </span>
                        <span class="col-1 staff_list"> ${res[i].total} $</span>
                    </li>
                `
                booking_display.innerHTML+=display;
            }
        }
    })
}
