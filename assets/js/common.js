var toastr;
var isRTL = false;
var Appp = {
  config: {
    siteUrl: 'http://localhost/dimatas/',
    AssetUrl: 'http://localhost/dimatas/assets/',
    loggedIn: false,
    userUrl:"",
    notification:"",
    not_type:"success"
  },
  init: function(config) {
    _this = this;
    $.extend(_this.config, config);
    _this.initCommon();    
    $(window).resize(function(event) {
      Appp.windowResize();
    });
    /* _this.showNotification('success','a','aaaa');*/
  },
  windowResize:function(){
    /*var clientHeight = $( document ).height();
    $('.login-bg').css('height', clientHeight);*/
  },
  handleValidate:function(){
    if (typeof($.fn.validate) != "undefined") {
      jQuery.validator.setDefaults({
        errorElement: "span",
        errorClass: "help-block",
        /*focusInvalid: !1,*/
        invalidHandler: function(e, r) {
          $(".alert-danger", $(".login-form")).show();
          Appp.windowResize();
        },
        highlight: function(r) {
          var $elm;
          if($(r).closest(".md-checkbox").length>0){
            $elm=$(r).closest(".md-checkbox");
          }
          else{
            $elm=$(r).closest(".form-group");
          }
          $elm.addClass("has-error");
          $(r).addClass('edited')

        },
        success: function(e,r) {
          var $elm;
          if($(r).closest(".md-checkbox").length>0){
            $elm=$(r).closest(".md-checkbox");
          }
          else{
            $elm=$(r).closest(".form-group");
          }
          $elm.removeClass("has-error"), e.remove()
        },
        errorPlacement: function(e, r) {
          if(typeof(r.attr("data-error-target"))!="undefined"){
            var $target= r.attr("data-error-target");
            if($target!="" && $target!="no" && $target.length>0){
              $target.html(e);
            }
          }
          else{
            e.insertAfter(r);
          }

          Appp.windowResize();
        },
        submitHandler: function(e) {
          e.submit()
        }
      });
$(".validate_form").validate();
}
$(".validate_form input").keypress(function(e) {
  return 13 == e.which ? ($(".validate_form").validate().form() && $(".validate_form").submit(), !1) : void 0
})
},
init_msg_portscan:function(){
  var a = new Datatable;
  a.init({
    src: $("#simplyportscan_mng_host"),
    onSuccess: function(a, e) {},
    onError: function(a) {},
    onDataLoad: function(a) {},
    loadingMessage: "Loading...",
    dataTable: {
     "bSortCellsTop": true,
     "autoWidth": false,
     "filter": true,
     "aoColumns": [
     { "data": "id","sClass": "text-center" },
     { "data": "host_name" },
     { "data": "host_alias" },
     { "data": "host_ip" },
     /*{ "data": "status","searchable": false,"sortable":false},*/
     { "data": "operation","searchable": false,"sortable":false}
     ],
     ajax: {
      url: config.siteUrl+"simplyportscan/hosts"
    }
  }
})
  a.addFilter([
    {column_number : 1, filter_type: "text","style_class":"form-control","filter_container_id":"filter_host_name"},
    {column_number : 2, filter_type: "text","style_class":"form-control","filter_container_id":"filter_host_alias"},
    {column_number : 3, filter_type: "text","style_class":"form-control","filter_container_id":"filter_host_ip"}  
    ])
},
init_simplymonitorhosts:function(){

 var a = new Datatable;
 a.init({
  src: $("#simplymonitor_mng_host"),
  onSuccess: function(a, e) {},
  onError: function(a) {},
  onDataLoad: function(a) {},
  loadingMessage: "Loading...",
  dataTable: {
   "bSortCellsTop": true,
   "autoWidth": false,
   "filter": true,
   "aoColumns": [
   { "data": "id","sClass": "text-center" },
   { "data": "host_name" },
   { "data": "host_alias" },
   { "data": "host_ip" },
   { "data": "operation","searchable": false,"sortable":false}
   ],
   ajax: {
    url: config.siteUrl+config.simply_monitor_scan+"/hosts"
  }
}
})
 a.addFilter([
  {column_number : 1, filter_type: "text","style_class":"form-control","filter_container_id":"filter_host_name"},
  {column_number : 2, filter_type: "text","style_class":"form-control","filter_container_id":"filter_host_alias"},
  {column_number : 3, filter_type: "text","style_class":"form-control","filter_container_id":"filter_host_ip"}  
  ])

},
init_simplyvulnerability_scans:function(){
  var a = new Datatable;
  a.init({
    src: $("#simplyvulnerability_scans"),
    onSuccess: function(a, e) {},
    onError: function(a) {},
    onDataLoad: function(a) {},
    loadingMessage: "Loading...",
    dataTable: {
     "bSortCellsTop": true,
     "autoWidth": false,
     "filter": true,
     "aoColumns": [
     { "data": "id","sClass": "text-center" },
     { "data": "host_id" },
     { "data": "task_id" },
     { "data": "status" },
     { "data": "operation","searchable": false,"sortable":false}
     ],
     ajax: {
      url: config.siteUrl+config.simply_vulnerability_scan+"/scans"
    }
  }
})
  a.addFilter([
    {column_number : 1, filter_type: "text","style_class":"form-control","filter_container_id":"filter_host_id"}
    ])
},

init_hostadd:function(){
  $("body").on('click',".button-go",function(event) {
    event.preventDefault();
    var h=$("#h").val();
    var datah=$("#h").attr("data-h");
    var reload=true;
    if(h!=""){
      $(".form-content").find(".host_error").remove();;
      if(datah!="" && h==datah){
        reload=false;
      }
      if(reload==true){
        var url=config.siteUrl+config.simply_port_scan+"/hosts/add?h="+encodeURI($("#h").val());
        location.replace(url);
      }      
    }
    else{
      if($(".form-content").find(".host_error").length==0){
        $(".form-content").prepend('<div class="alert alert-error host_error"><button class="close" data-dismiss="alert"></button>Please Enter host to continue.</div>');
      }
    }
  });

},
initLogin:function(){
  _this.windowResize();
  $('body').on('click','.sociallogin',function(e){
    e.preventDefault();
    var win_name = $(this).attr('data-window');
    var href = $(this).attr('href');
    var width = screen.width;
    var height = screen.height;
    var separator = (href.indexOf('?') !== -1) ? '&' : '?';
    var url = href + separator + 'popup=true',
    windowFeatures = 'menubar=no,toolbar=no,status=no,width=' + width +
    ',height=' + height;
    window.open(url, win_name,windowFeatures); 
  });
},
/* from old js */
getURLParameter: function (paramName) {
  var searchString = window.location.search.substring(1),
  i, val, params = searchString.split("&");

  for (i = 0; i < params.length; i++) {
    val = params[i].split("=");
    if (val[0] == paramName) {
      return unescape(val[1]);
    }
  }
  return null;
},
isRTL: function () {
  return isRTL;
},
/* from old js */
initCommon:function(){
  _this.handleValidate();
  if (typeof($.fn.prevue) != "undefined") {
    $('.preview-password').prevue();
  }
  if(Appp.config.notification != "" && Appp.config.notification != null)
  {
    Appp.showNotification(Appp.config.not_type,"Info",Appp.config.notification);
  }
  $("body").on('click','.cleartoasts',function() {
    toastr.clear()
  });
},
showNotification:function(type,title,message,showDuration,hideDuration,timeOut,extendedTimeOut,showEasing,hideEasing,showMethod,hideMethod){

  if(typeof type == "undefined")
    type = "success";

  if(typeof message == "undefined")
    message = "success";

  if(typeof title == "undefined")
    title = "success";  

  if(typeof showDuration == "undefined")
    showDuration = 1000;  

  if(typeof hideDuration == "undefined")
    hideDuration = 1000;

  if(typeof timeOut == "undefined")
    timeOut = 5000;

  if(typeof extendedTimeOut == "undefined")
    extendedTimeOut = 1000;


  if(typeof showEasing == "undefined")
    showEasing = "swing";

  if(typeof hideEasing == "undefined")
    hideEasing = "linear";

  if(typeof showMethod == "undefined")
    showMethod = "fadeIn";

  if(typeof hideMethod == "undefined")
    hideMethod = "fadeOut";
  var t, o = -1,
  e = 0;
  var o = type,
  a = message,
  i = title,
  s = showDuration,
  r = hideDuration,
  l = timeOut,
  c = extendedTimeOut,
  u = showEasing,
  h = hideEasing,
  p = showMethod,
  d = hideMethod,
  v = e++;
  toastr.options = {
    closeButton: $("#closeButton").prop("checked"),
    debug: $("#debugInfo").prop("checked"),
    positionClass: $("#positionGroup input:checked").val() || "toast-top-right",
    onclick: null
  };
  var m = toastr[o](a, i);
}

}