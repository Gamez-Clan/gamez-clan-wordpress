jQuery(document).ready(function(){
    
   var jq=jQuery;
   jq("#bpgclite-del-image").on('click',function(){
      var $this=jq(this);
     
      
      jq.post(ajaxurl,{action:'bpgclite_del_image',
                      cookie:encodeURIComponent(document.cookie),
                       _wpnonce:jq($this.parents('form').get(0)).find('#_wpnonce').val()
          
      },
        function(response){
            //remove the current image
            jq("div#message").remove();
            $this.parent().before(jq("<div id='message' class='update'>"+response+"</div>"));
            $this.prev('current-bg').fadeOut(100);//hide current image
            $this.parent().remove();//remove from dom the delete link
            //give feedback
            //remove the body class to hide the image
            jq('body').removeClass('is-single-group');
            
        }
  

);
    return false;
       
   })
    
    
});