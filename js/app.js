 function showRooms(str){
    var search_query = document.getElementById('roomSearchBar').value;
    let sendQ = `${str}*${search_query}`;
    callRooms(sendQ);
}

function searchRoom(search){
    let room_type = document.getElementById('TypeSelector').value;
    let searchQ = `${room_type}*${search.value}`;
    callRooms(searchQ);
}

function callRooms(query){
    
    var display_room = document.getElementById('display__room');
    $.ajax({
        url:`includes/dbGetRooms.php?query=${query}`,
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
                    <div class="room__one"  data-toggle="modal" data-target="#roomModal${res[i].id}">
                        <div class="room_box" style='${style}'>
                            ${res[i].name}
                        </div>
                        <div style="background:white; cursor:pointer; user-select:none"> 
                        ${res[i].type} Room
                            &nbsp; 
                            (${res[i].status})
                        </div>
                    </div>
                `

               display_room.innerHTML+=display;
            }
        }

    })
}

function getRoomTypePrice(roomId, id){
    var price = document.getElementById(`room_price${id}`);
    $.ajax({
        url:`includes/dbGetRoomPrice.php?roomType=${roomId}`,
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
            url:`includes/dbGetRooms.php?roomId=${room_id}`,
            type:"GET",
            dataType:"JSON",
            success: function(res){
                roomNames.innerHTML="<option selected disabled> Select the Room Number</option>";

                room_price.value=res[0].price + " $";
                
                total.value=(parseInt(duration.value) * res[0].price);
                
                for(var i =0; i<res.length; i++){
                    var display =`
                        <option value='${res[i].name}'>${res[i].name}</option>
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

function cleanRoom(id, price){
    console.log(id);
    $.ajax({
        url:`includes/dbCleanRoom.php?id=${id}`,
        type:"GET",
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