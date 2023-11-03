jQuery(document).ready(function ($) {
  var currentlist=0;
  var filename='';
  $(".vc_ui-panel-content-container").on("click", function (e) {
    var clickedElement = e.target; // Get the clicked element

    // Check the class of the clicked element
    if ($(clickedElement).hasClass("vc-c-icon-close")) {
      e.preventDefault();
      e.target.closest(".added").remove();
    }
    // Check the class of the clicked element
    if ($(clickedElement).hasClass("mediabtn")) {
      e.preventDefault();
      var mymain = e.target.closest(".vc_param_group-wrapper");
      const min = 0; // Replace with your desired minimum value
      const max = 100; // Replace with your desired maximum value
      const precision = 0; // Number of decimal places    
      currentlist = (Math.random() * (max - min) + min).toFixed(precision);
      mymain.setAttribute("id",`unique_${currentlist}`);
      sessionStorage.setItem("unique_id",`unique_${currentlist}`);
      var addimage = mymain.children[0].children[1].children[3];
      addimage.click();


      $(".media-modal").find(".media-frame-title").find("h1").text("ADD Media");
      $(".media-modal")
        .find(".media-toolbar")
        .find(".media-button-select")
        .text("Set Media");
      $(".media-modal").on("click", ".thumbnail", function () {
        $(".media-modal")
          .find(".media-toolbar")
          .find(".media-button-select")
          .text("Set Media");
       
      });
      $(".media-toolbar").on("click",function (e) { 
        var clickbtn = e.target;      
        e.preventDefault();
        if ($(clickbtn).hasClass("media-button-select")){
          filename=$(".media-sidebar").find("input#attachment-details-title").val();
          setTimeout(()=>{
            addMediaName(filename);
          },1000);
         
        }      
      });
    }
  });
  
  function addMediaName(){
    var getid=sessionStorage.getItem("unique_id");
    if(getid !== ""){ 
      getid =`#${getid}`;
      // var filepath=document.getElementById(getid).children[0].children[1].children[1].children[0].children[0].children[0].children[0];
      var filepath=$(getid).find('li.added').find("img");
      // var inputtext= document.getElementById(getid).children[1].children[1].children[0];
      var inputtext=$(getid).find('.document_items_quote_author');
     var  filenamesurl=filepath.attr("src");
     var filename=filenamesurl.split("/");
      filename=filename[filename.length-1];
      inputtext.val(filename);
     var vcdesc=$(getid).find('.document_items_quote_author').siblings('span.vc_description');
      if($(getid).find(".filepath").length <= 0){
        vcdesc.html(`<p class="filepath">${filenamesurl}</p>`);
        vcdesc.css("opacity","1");
      }
    }
  }

});
