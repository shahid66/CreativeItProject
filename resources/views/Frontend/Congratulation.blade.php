@extends('layouts.FrontEndMaster')

@section('contend')
 <!-- breadcrumb-area start -->
 <div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Shop</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Congratulation</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 text-center"><br><br>
            <img src="https://www.animatedimages.org/data/media/1103/animated-congratulation-image-0058.gif" border="0" alt="animated-congratulation-image-0058" />
<br><br>
            <h6>Thanks For purchase product! <br> Connected with us</h6>
            <span id="countdown"></span>
            <br><br>
        </div>
    </div>
</div>



@endsection

@section('footer_script')
<script>
    $().ready(function(){
        var time=10;
        var url='http://127.0.0.1:8000/';
        function countdown(){
            setTimeout(countdown,1000);
            $('#countdown').html("Redirect in"+ time + "Seconds");
            time --;
            if(time<0){
                window.location=url;
            }

        }
        countdown();
    })
</script>
@endsection





