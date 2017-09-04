<style>
#overlay {
    position: fixed;
    <?php if(!isset($_SESSION['chat_client'])){echo 'display: none;';}?>
    margin-right: 2px;
    margin-bottom: -1%;
    bottom: 0;
    z-index: 2;
    cursor: pointer;
}
.chat
  {
   list-style: none;
   margin: 0;
   padding: 0;
  }

  .chat li
  {
   margin-bottom: 10px;
   padding-bottom: 5px;
   border-bottom: 1px dotted #B3A9A9;
  }

  .chat li.left .chat-body
  {
   margin-left: 60px;
  }

  .chat li.right .chat-body
  {
   margin-right: 60px;
  }


  .chat li .chat-body p
  {
   margin: 0;
   color: #777777;
  }

  .panel .slidedown .glyphicon, .chat .glyphicon
  {
   margin-right: 5px;
  }

  .panel-body
  {
   overflow-y: scroll;
   height: 320px;
  }

  ::-webkit-scrollbar-track
  {
   -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
   background-color: #F5F5F5;
  }

  ::-webkit-scrollbar
  {
   width: 12px;
   background-color: #F5F5F5;
  }

  ::-webkit-scrollbar-thumb
  {
   -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
   background-color: #555;
  }
  /*.pos{
    display: inline-block;
    vertical-align: bottom;
    float: none;
  }*/
</style>
    <div class="row pos" id="overlay" style="bottom:0;">
        <div class="col-md-4 pull-right">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Live Support
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li><a href="#"><span class="glyphicon glyphicon-refresh">
                            </span>Refresh</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-ok-sign">
                            </span>Available</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-remove">
                            </span>Busy</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-time"></span>
                                Away</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><span class="glyphicon glyphicon-off"></span>
                                End chat</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body" id="chat-panel">
                    <ul class="chat" id="chat">
                        <?=$chat;?>
                    </ul>
                </div>
                <div class="panel-footer">
                    <?=$chatfooter;?>
                </div>
            </div>
        </div>
    </div>
    <script>
         $(document).ready(function(){
           var interval = setInterval(function () {
             $.ajax({
               url: 'includes/loadmessages.php',
               success: function(data){
                 $('#chat').html(data);
                 $('#chat-panel').scrollTop($('#chat-panel')[0].scrollHeight);
               }
             });
           }, 1000);
         });
         function messageInsert()
         {
           $.ajax({
             type:'POST',
             url:'../core/sub/insert-message-sub.php',
             data:$('#chatBox').serialize(),
             success:function(response)
             {
               $('#chat-panel').html(response);
               $('#fadeinchat').fadeIn(2000);
             }
           });

           var form = $('#chatBox').reset();
           return false;
         }
        function on() {
          document.getElementById("overlay").style.display = "block";
        }

        function off() {
          document.getElementById("overlay").style.display = "none";
        }
    </script>
