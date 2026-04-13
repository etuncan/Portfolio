jQuery(function( ){
  jQuery(".team_read_toggle").click(function( ){
    var element=jQuery(this).closest(".custom_team_wrapper"), content1=element.find(".custom_team_cont"), content2=element.find(".custom_team_exc"),
button1=this;
content1.toggle(".hide_active");
content2.toggle(".hide_active");
if(button1.innerText!= "Read More"){
 button1.innerText= "Read More";
}else{
button1.innerText= "Read Less";
}                        
  }); 
});
