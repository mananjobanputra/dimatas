$(function(){
  if(typeof($.fn.validate)!="undefined"){
    jQuery.validator.setDefaults({
      onkeyup:function(element){
        $(element).parents(".form-group").removeClass('has-error');
      },
      errorElement:"p",
      errorClass:'help-block',
      highlight: function(element, errorClass, validClass) {
        $(element).parents(".form-group").addClass('has-error');
        if($(element).prop('tagName')!="SELECT"){
          $(element).addClass('edited');;
        }
      },
      unhighlight: function(element, errorClass, validClass) {
        
      
       $(element).parents(".form-group").removeClass('has-error');
       
     },
     errorPlacement: function(error, element) {
      error.insertAfter(element);
    }
  });
    $(".validate_form").validate();
  }

});
var Appad = {
  config: {
    siteUrl: 'http://localhost/dimatas/',
    AssetUrl: 'http://localhost/dimatas/assets/'
  },


  init: function(config) {
    _this = this;
    $.extend(_this.config, config);
    _this.initCommonPlugins();
  },
  delete_row:function($elm){
    var row = $elm.closest("tr").get(0);
    var dataTbl = $elm.parents('.dataTable').data("tbl");
    if ($.fn.DataTable.fnIsDataTable( dataTbl ) ) {
      var index = dataTbl.fnGetPosition(row); 
      dataTbl.fnDeleteRow(index, function (dtSettings, row) {
        console.log('Row deleted');
      }, true);
    }
  },
  refresh_table:function($dataTblElement){
    var dataTbl = $dataTblElement.data("tbl");
    if ($.fn.DataTable.fnIsDataTable( dataTbl ) ) {
      dataTbl.fnDraw();
    }
  },
  delete_record:function(id,url){
    url=  decodeURIComponent(url);
    var r = confirm("Are you sure to delete 1");
    if (r == true) {
      window.location = url;
    } else {

    }
  },
  displayMsg:function(msgText){
    $(".disp-js-msg").show();
    $(".js-msg-text").html(msgText);
    setTimeout(function(){ $(".disp-js-msg").hide(); }, 3000);
  },
  initCommonPlugins:function(){
    $("body").on('click','.delete_data',function(e){
      e.preventDefault();
      var dataTbl = $(this).parents('.dataTable').data("tbl");
      var  url = $(this).attr('href');
      var r = confirm("Are you sure to delete");
      var $this=$(this);
      if (r == true) {  
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'json',
          data: {},
          success:function(response){
            App.delete_row($this);
          },
          error:function(){
          }
        })
      } else {}      
    })

  },
  init_add_edit_users:function(){

   $(".add_edit_validate_form").validate({


    rules: {

      fullname: {
        required: true
      },
      email: {
        required: isEmailReq,
        email: isEmailReq,
        remote:config.siteUrl+"admin/manage_users/isUniqueEmail"
      },
      password: {
        required: true
      },
      rpassword: {
        equalTo: "#register_password"
      },

      address: {
        required: true
      },
      city: {
        required: true
      },
      country: {
        required: true
      },



      tnc: {
        required: true
      }
    },

    messages: { 
      email:{
        remote:"This email already exists."
      },
      tnc: {
        required: "Please accept TNC first."
      }
    },

  });
   $(document).on('click','#add_edit_user',function(e){
     /* e.preventDefault();*/

   })
 },
 init_mng_users:function(){
  $(document).on('switchChange.bootstrapSwitch','#tblmng_users .make-switch',function(){
    var u_id = $(this).attr('data-id');
    $.ajax({
      url: config.siteUrl+"admin/manage_users/change_status",
      type: 'POST',
      dataType: 'json',
      data: {'uid':u_id},
      success:function(response){

      },
      error:function(){
      }
    })

  })
  var a = new Datatable;
  a.init({
    src: $("#tblmng_users"),
    onSuccess: function(a, e) {},
    onError: function(a) {},
    onDataLoad: function(a) {},
    loadingMessage: "Loading...",
    dataTable: {
     "bSortCellsTop": true,
     "autoWidth": false,
     "filter": true,
     "aoColumns": [
     { "data": "id" },
     { "data": "full_name"},
     { "data": "email" },
     { "data": "status","searchable": false,"sortable":false},
     { "data": "operation","searchable": false,"sortable":false}
     ],
     ajax: {
      url: config.siteUrl+"admin/manage_users/index"
    }
  }
})
  a.addFilter([
    {column_number : 1, filter_type: "text","style_class":"form-control","filter_container_id":"filter_full_name"},

    {column_number : 2, filter_type: "text","style_class":"form-control","filter_container_id":"filter_email"}
    ])
},


}

