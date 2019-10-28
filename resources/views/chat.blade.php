

@extends('layouts.app')

@section('content')


    
    

<div>
    <div id="messageField">
        <div id="messagesend_{{Auth::user()->id}}"> 
        </div>
        <div >
            <form class="form-group" id="messagesend_{{Auth::user()->id}}">
                <h1 align ="center">Chat</h1>
            <div class="row"> 
                <div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="form-control" style="align:center; border:2px solid grey; height: 50vh; background: #FAFAD2; overflow:scroll;" id="mess_comp"></div>
				</div>
            </div>
            <br>
            <div class="row"> 
                <div class="col-md-2"></div>
				<div class="col-md-7">
					<input class="form-control " type="text"  name="message" id="message" data-id="{{Auth::user()->id}}" class="form-control message" placeholder="Write a message...">
				</div>
				<div class="col-md-1">
					<button  type="button" class="btn btn-primary sendMessage" value="{{Auth::user()->id}}"> Send</button>
				</div>
            </div>
            </form>
        </div>
    </div>
</div>  

{{-- @endforeach --}}

<script> 
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        });
       
        getMessage({{Auth::user()->id}});
        updateChat();
        //setTimeout(updateChat,1000);
    

    $(document).on('click', '.sendMessage', function(){
       
                var id = $(this).val();
                if($('#message').val()==''){
                    alert('Please write a Message!');
                }
                else{
                    var messagesend = $('#message').serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'writemessage',
                        data: messagesend,
                        success: function(){
                            getMessage(id);
                            $('#message').val("");
                        },
                    });
                }
 
            });
   
   

$('#mess_comp').scrollTop($('#mess_comp')[0].scrollHeight);

    function getMessage(id){
            $.ajax({
                url: 'getmessage',
                data: {id:id},
                success: function(data){
                    $('#mess_comp').html("");
                    for(i=0;i<data.length;i++){
                        if(data[i].usersid=={{Auth::user()->id}}){
                            $('#mess_comp').append("<p style='margin-top:1px ;width:50%; margin-bottom:1px;margin-left:50%;border-radius: 25px; background-color: #82ccdd; text-align:right'>"+data[i].msg+" : " + data[i].name+"</p>");
                        }else{
                            $('#mess_comp').append("<p style='margin-top:1px ;width:50%; margin-bottom:1px;margin-right:50%;border-radius: 25px; background-color: #82ccdd; text-align:left'>"+data[i].name +" : " +data[i].msg+"</p>");
                        }
                        
                    }
                        $('#mess_comp').animate({
                            scrollTop: $('#mess_comp')[0].scrollHeight}, "slow");
                    
                     
                }
            });
        }


    function updateChat(){

        setInterval(function(){
            $.ajax ({
                type:'get',
                url:'updatechat',
                success:function(data){
                        $('#mess_comp').html("");
                        for(i=0;i<data.length;i++){
                            if(data[i].usersid=={{Auth::user()->id}}){
                                $('#mess_comp').append("<p style='margin-top:1px ;width:50%; margin-bottom:1px;margin-left:50%;border-radius: 25px; background-color: #82ccdd; text-align:right'>"+data[i].msg+" : " + data[i].name+"</p>");
                            }else{
                                $('#mess_comp').append("<p style='margin-top:1px ;width:50%; margin-bottom:1px;margin-right:50%;border-radius: 25px; background-color: #82ccdd; text-align:left'>"+data[i].name +" : " +data[i].msg+"</p>");
                            }
                            
                        }
                       $('#mess_comp').animate({
                            scrollTop: $('#mess_comp')[0].scrollHeight}, "slow");
                      
                    
                }
            });
        },2000);
    }


       
 });


</script> 

@endsection 


