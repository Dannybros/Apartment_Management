<?php
http_response_code(404);
?>
<style>
    button{
        position: absolute;
        top: 80%;
        left: 50%;
        transform: translate(-50%, -80%);
        border:1px solid yellow;
        padding:20px 100px;
        background:none; 
        font-size:40px; 
        font-family:'Times New Roman', Times, serif; 
        font-weight:bold;
        color: white;
        cursor: pointer;
        transition: all 0.3s linear;
    }
    button:hover{
        background:rgba(255,255,255,0.7);
        color: #BD7D61;
    }
</style>
<div style="display: grid; place-items:center; position:relative">
    <img src="404_page.jpg" alt="">
    <button onclick="goDashboard()">
        Go Home
    </button>
</div>
<script>
    function goDashboard(){
        window.location.replace('index.php');
    }
</script>