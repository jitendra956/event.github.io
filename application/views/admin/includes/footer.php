<!-- <div id="alert_float_1" class="float-alert animated fadeInRight col-xs-10 col-sm-3 alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span class="fa fa-bell-o" data-notify="icon"></span><span class="alert-title">Timesheet added successfully.</span></div> -->
 <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
<!-- BY Mohit Start-->
        <div class="ajax_modal" style="display: none; z-index: 7777777777777777;">
          <div class="center">
              <img alt="" src="<?php echo base_url();?>assets/loader.gif" />
          </div>
        </div>

<!-- User Delete Modal content Start-->
        <div class="modal fade" id="user_delete_confirmation_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="margin-top: 260.5px;">
                  <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Do you really want to delete this User?</h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url();?>admin/user/user_delete">
                  <input type="hidden" name="delete_user_id" id="delete_user_id" value="0">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
<!-- User Delete Modal content End-->

<!-- product Delete Modal content Start-->
        <div class="modal fade" id="product_delete_confirmation_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="margin-top: 260.5px;">
                  <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Do you really want to delete this Ad?</h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url();?>admin/ads/ads_delete">
                  <input type="hidden" name="delete_product_id" id="delete_product_id" value="0">
                  <input type="hidden" name="redirect" value="<?php echo $this->uri->segment(1); ?>">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
<!-- User Delete Modal content End-->

<!-- Brand Delete Modal content Start-->
        <div class="modal fade" id="brand_delete_confirmation_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="margin-top: 260.5px;">
                  <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Do you really want to delete this Brand?</h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url();?>admin/brand/brand_delete">
                  <input type="hidden" name="delete_brand_id" id="delete_brand_id" value="0">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
<!-- Brand Delete Modal content End-->

<!-- Category Delete Modal content Start-->
        <div class="modal fade" id="category_delete_confirmation_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="margin-top: 260.5px;">
                  <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Do you really want to delete this Category?</h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url();?>admin/categories/category_delete">
                  <input type="hidden" name="delete_category_id" id="delete_category_id" value="0">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
<!-- Category Delete Modal content End-->

<!-- Category Delete Modal content Start-->
        <div class="modal fade" id="review_delete_confirmation_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="margin-top: 260.5px;">
                  <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Do you really want to delete this Review?</h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url();?>admin/reviews/review_delete">
                  <input type="hidden" name="delete_review_id" id="delete_review_id" value="0">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
<!-- Category Delete Modal content End-->

<!-- City Delete Modal content Start-->
        <div class="modal fade" id="city_delete_confirmation_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="margin-top: 260.5px;">
                  <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Do you really want to delete this City?</h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url();?>admin/cities/city_delete">
                  <input type="hidden" name="delete_city_id" id="delete_city_id" value="0">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
<!-- City Delete Modal content End-->

<!-- Term Delete Modal content Start-->
        <div class="modal fade" id="term_delete_confirmation_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="margin-top: 260.5px;">
                  <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Do you really want to delete this Term?</h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url();?>admin/terms/term_delete">
                  <input type="hidden" name="delete_term_id" id="delete_term_id" value="0">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
<!-- Term Delete Modal content End-->

<!-- Banner Delete Modal content Start-->
        <div class="modal fade" id="banner_delete_confirmation_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="margin-top: 260.5px;">
                  <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Do you really want to delete this Banner?</h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url();?>admin/banner/banner_delete">
                  <input type="hidden" name="delete_banner_id" id="delete_banner_id" value="0">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
<!-- Banner Delete Modal content End-->

<!-- By Mohit End-->
        <!-- Vendor js -->
        <script src="<?php echo base_url(); ?>assets/js/vendor.min.js"></script>

        <!--C3 Chart-->
        <script src="<?php echo base_url(); ?>assets/libs/d3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/libs/c3.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/libs/echarts.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/libs/dashboard.init.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/js/handlebars.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/list.min.js"></script>
          <script src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js"></script>
          <script src="<?php echo base_url(); ?>assets/js/Chart.bundle.min.js"></script>
<!--------------------------Chat--------------------->
<!--------------------------------------------------->
<!-- include summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#privacy_policy').summernote();
    });
</script>
<script>
$(document).ready(function () {
    $('#selectall').click(function () {
        $('.selectedId').prop('checked', this.checked);
    });

    $('.selectedId').change(function () {
        var check = ($('.selectedId').filter(":checked").length == $('.selectedId').length);
        $('#selectall').prop("checked", check);
    });
});
</script>
<script>
   var colors = ['#007bff','#28a745','#444444','#c3e6cb','#dc3545','#6c757d'];

var chBar = document.getElementById("chBar");
var chartData = {
  labels: ["S", "M", "T", "W", "T", "F", "S"],
  datasets: [{
    data: [589, 445, 483, 503, 689, 692, 634],
    backgroundColor: colors[0]
  },
  {
    data: [209, 245, 383, 403, 589, 692, 580],
    backgroundColor: colors[1]
  },
  {
    data: [489, 135, 483, 290, 189, 603, 600],
    backgroundColor: colors[2]
  },
  {
    data: [639, 465, 493, 478, 589, 632, 674],
    backgroundColor: colors[4]
  }]
};

if (chBar) {
  new Chart(chBar, {
  type: 'bar',
  data: chartData,
  options: {
    scales: {
      xAxes: [{
        barPercentage: 0.4,
        categoryPercentage: 0.5
      }],
      yAxes: [{
        ticks: {
          beginAtZero: false
        }
      }]
    },
    legend: {
      display: false
    }
  }
  });
}
</script>
<script>
   var colors = ['#007bff','#28a745','#444444','#c3e6cb','#dc3545','#6c757d'];

var chBar = document.getElementById("chBar1");
var chartData = {
  labels: ["S", "M", "T", "W", "T", "F", "S"],
  datasets: [{
    data: [589, 445, 483, 503, 689, 692, 634],
    backgroundColor: colors[0]
  },
  {
    data: [209, 245, 383, 403, 589, 692, 580],
    backgroundColor: colors[1]
  },
  {
    data: [489, 135, 483, 290, 189, 603, 600],
    backgroundColor: colors[2]
  },
  {
    data: [639, 465, 493, 478, 589, 632, 674],
    backgroundColor: colors[4]
  }]
};

if (chBar) {
  new Chart(chBar, {
  type: 'bar',
  data: chartData,
  options: {
    scales: {
      xAxes: [{
        barPercentage: 0.4,
        categoryPercentage: 0.5
      }],
      yAxes: [{
        ticks: {
          beginAtZero: false
        }
      }]
    },
    legend: {
      display: false
    }
  }
  });
}
</script>
<script>
        $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
        });
    });
</script>
<script>
            $(document).ready(function() {
    $('#example').DataTable();
} );
        </script>
       
        
        <script>
            $(document).ready(function() {
    $("input[name$='cars']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#Cars" + test).show();
    });
});
        </script>
         <script>
            $(document).ready(function() {
    $("input[name$='cars2']").click(function() {
        var test = $(this).val();

        $("div.desc2").hide();
        $("#Cars" + test).show();
    });
});
        </script>
         <script>
            $(document).ready(function() {
    $("input[name$='cars3']").click(function() {
        var test = $(this).val();

        $("div.desc3").hide();
        $("#Cars" + test).show();
    });
});
        </script>
        <script>
          function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
        </script>


<!-- Event JS Start -->


<!-- By Mohit -->
<script src="<?php echo base_url();?>assets/js/alert.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>


<script>
  var BASE_URL = '<?php echo base_url(); ?>admin/';

$(document).ready(function() {

  $('.alert').fadeOut(5000);
  $(document).on('click',"input[name$='cat_checkbox']",function(){
      var catid = $(this).val();
      $.ajax({
        type:'POST',
        dataType:'json',
        url: BASE_URL+'categories/category_update_status',
        data:{catid:catid},
        beforeSend: function () {
        $(".ajax_modal").show();
        },
        complete: function () {
            $(".ajax_modal").hide();
        },
        success:function(responce)
        {
          $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
          });
          // if(responce.status == 'true'){
          //   if($('#cat_checkbox-'+catid).is(":checked")){
          //       $('#myCheckbox-'+catid).prop('checked', false); // Checks it
          //   }
          //   else if($('#cat_checkbox-'+catid).is(":not(:checked)")){
          //       $('#cat_checkbox-'+catid).prop('checked', true); // Checks it
          //   }   
          // }
          // else{
            
          // }
        }
      });  
    });
  $(document).on('click',"input[name$='user_c_verify']",function(){
      var userid = $(this).val();
      $.ajax({
        type:'POST',
        dataType:'json',
        url: BASE_URL+'user/update_contact_status',
        data:{userid:userid},
        beforeSend: function () {
        $(".ajax_modal").show();
        },
        complete: function () {
            $(".ajax_modal").hide();
        },
        success:function(responce)
        {
          $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
          });
        }
      });  
    });
  $(document).on('click',"input[name$='user_e_verify']",function(){
      var userid = $(this).val();
      $.ajax({
        type:'POST',
        dataType:'json',
        url: BASE_URL+'user/update_email_status',
        data:{userid:userid},
        beforeSend: function () {
        $(".ajax_modal").show();
        },
        complete: function () {
            $(".ajax_modal").hide();
        },
        success:function(responce)
        {
          $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
          });
        }
      });  
    })

  $(document).on('click',"input[name$='product_status_change']",function(){
      var productid = $(this).val();
      $.ajax({
        type:'POST',
        dataType:'json',
        url: BASE_URL+'ads/approve_add',
        data:{productid:productid},
        beforeSend: function () {
        $(".ajax_modal").show();
        },
        complete: function () {
            $(".ajax_modal").hide();
        },
        success:function(responce)
        {
          $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
          });
        }
      });  
    });
 $(document).on('click',"input[name$='review_status']",function(){
      var reviewid = $(this).val();
      $.ajax({
        type:'POST',
        dataType:'json',
        url: BASE_URL+'reviews/change_reviews_status',
        data:{reviewid:reviewid},
        beforeSend: function () {
        $(".ajax_modal").show();
        },
        complete: function () {
            $(".ajax_modal").hide();
        },
        success:function(responce)
        {
          $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
          });
        }
      });  
    });

 $(document).on('click',"input[name$='city_status']",function(){
      var cityid = $(this).val();
      $.ajax({
        type:'POST',
        dataType:'json',
        url: BASE_URL+'cities/change_city_status',
        data:{cityid:cityid},
        beforeSend: function () {
        $(".ajax_modal").show();
        },
        complete: function () {
            $(".ajax_modal").hide();
        },
        success:function(responce)
        {
          $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
          });
        }
      });  
    });

  $(document).on('click',"input[name$='term_status']",function(){
      var termid = $(this).val();
      $.ajax({
        type:'POST',
        dataType:'json',
        url: BASE_URL+'terms/change_term_status',
        data:{termid:termid},
        beforeSend: function () {
        $(".ajax_modal").show();
        },
        complete: function () {
            $(".ajax_modal").hide();
        },
        success:function(responce)
        {
          $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
          });
        }
      });  
    });
    $(document).on('click',"input[name$='banner_checkbox']",function(){
      var bannerid = $(this).val();
      $.ajax({
        type:'POST',
        dataType:'json',
        url: BASE_URL+'banner/change_banner_status',
        data:{bannerid:bannerid},
        beforeSend: function () {
        $(".ajax_modal").show();
        },
        complete: function () {
            $(".ajax_modal").hide();
        },
        success:function(responce)
        {
          $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
          });
        }
      });  
    });

    $(document).on('click',"input[name$='product_features']",function(){
      var productid = $(this).val();
      $.ajax({
        type:'POST',
        dataType:'json',
        url: BASE_URL+'ads/set_product_features',
        data:{productid:productid},
        beforeSend: function () {
        $(".ajax_modal").show();
        },
        complete: function () {
            $(".ajax_modal").hide();
        },
        success:function(responce)
        {
          $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
          });
        }
      });  
    });

    $('#deleteAllads').click(function(){
        var checkbox = $('.selectedId:checked');
        if(checkbox.length > 0)
        {
         var checkbox_value = [];
         $(checkbox).each(function(){
          checkbox_value.push($(this).val());
         });
         console.log(checkbox_value);
         $.ajax({
          url:BASE_URL+"ads/multiads_delete",
          method:"POST",
          dataType:'json',
          data:{checkbox_value:checkbox_value},
          beforeSend: function () {
          $(".ajax_modal").show();
          },
          complete: function () {
              $(".ajax_modal").hide();
          },
          success:function(responce)
          {
             $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
              }); 
              location.reload();
          }
         })
        }
        else
        {
         alert('Select atleast one records');
        }
      });

      $('#deleteAllcategories').click(function(){
        var checkbox = $('.selectedId:checked');
        if(checkbox.length > 0)
        {
         var checkbox_value = [];
         $(checkbox).each(function(){
          checkbox_value.push($(this).val());
         });
         console.log(checkbox_value);
         $.ajax({
          url:BASE_URL+"Categories/multiCategories_delete",
          method:"POST",
          dataType:'json',
          data:{checkbox_value:checkbox_value},
          beforeSend: function () {
          $(".ajax_modal").show();
          },
          complete: function () {
              $(".ajax_modal").hide();
          },
          success:function(responce)
          {
             $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
              }); 
              location.reload();
          }
         })
        }
        else
        {
         alert('Select atleast one records');
        }
      });

      $('#deleteAllbrand').click(function(){
        var checkbox = $('.selectedId:checked');
        if(checkbox.length > 0)
        {
         var checkbox_value = [];
         $(checkbox).each(function(){
          checkbox_value.push($(this).val());
         });
         console.log(checkbox_value);
         $.ajax({
          url:BASE_URL+"Brand/multiBrand_delete",
          method:"POST",
          dataType:'json',
          data:{checkbox_value:checkbox_value},
          beforeSend: function () {
          $(".ajax_modal").show();
          },
          complete: function () {
              $(".ajax_modal").hide();
          },
          success:function(responce)
          {
             $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
              }); 
              location.reload();
          }
         })
        }
        else
        {
         alert('Select atleast one records');
        }
      });

      $('#deleteAllusers').click(function(){
        var checkbox = $('.selectedId:checked');
        if(checkbox.length > 0)
        {
         var checkbox_value = [];
         $(checkbox).each(function(){
          checkbox_value.push($(this).val());
         });
         console.log(checkbox_value);
         $.ajax({
          url:BASE_URL+"user/multiuser_delete",
          method:"POST",
          dataType:'json',
          data:{checkbox_value:checkbox_value},
          beforeSend: function () {
          $(".ajax_modal").show();
          },
          complete: function () {
              $(".ajax_modal").hide();
          },
          success:function(responce)
          {
             $.alert(responce.message, {
              title: responce.title,
              closeTime: 1000,
              position: ['top-right'],
              type: responce.type
              }); 
              location.reload();
          }
         })
        }
        else
        {
         alert('Select atleast one records');
        }
      });


  $("#subCategoryForm").validate({
  rules: {
    subcat: {
      required: true
    },
    subcatname:{
      required: true
    },
    subcatname_ar:{
      required: true
    },
    icon_image:{
      required: true
    }
  },
  messages: {
    subcat: {
      required: "Please Select Any category!"
    },
    subcatname: {
      required: "Please Enter Sub-category Name!"
    },
    subcatname_ar: {
      required: "Please Enter Sub-category Arabic Name!"
    },
    icon_image: {
      required: "Please Upload a Icon!"
    },
  submit: {
        settings: {
            scrollToError: {
                offset: -100,
                duration: 500
            }
        }
      }

  }
});

$("#cityForm").validate({
  rules: {
    name_en: {
      required: true
    },
    name_ar:{
      required: true
    },
    latitude:{
      required: true
    },
    longitude:{
      required: true
    }
  },
  messages: {
    name_en: {
      required: "Please Enter City Name!"
    },
    name_ar: {
      required: "Please Enter City Arabic Name!"
    },
    latitude: {
      required: "Please Enter City Latitude!"
    },
    longitude: {
      required: "Please Enter City Longitude!"
    },
  submit: {
        settings: {
            scrollToError: {
                offset: -100,
                duration: 500
            }
        }
      }

  }
});

$("#termForm").validate({
  rules: {
    title_en: {
      required: true
    },
    title_ar:{
      required: true
    },
    term_en:{
      required: true
    },
    term_ar:{
      required: true
    }
  },
  messages: {
    title_en: {
      required: "Please Enter Term Title in English!"
    },
    title_ar: {
      required: "Please Enter Term Title in Arabic!"
    },
    term_en: {
      required: "Please Enter Term in English!"
    },
    term_ar: {
      required: "Please Enter Term in Arabic!"
    },
  submit: {
        settings: {
            scrollToError: {
                offset: -100,
                duration: 500
            }
        }
      }

  }
});

$("#BrandForm").validate({
  rules: {
    brandlogo: {
      required: true
    },
    brandcat_id:{
      required: true
    },
    brandsubcat_id:{
      required: true
    },
    brandname:{
      required: true
    },
    brandname_ar:{
      required: true
    }
  },
  messages: {
    brandlogo: {
      required: "Please Upload Brand Logo!"
    },
    brandcat_id: {
      required: "Please Select Category!"
    },
    brandsubcat_id: {
      required: "Please Select Sub-category!"
    },
    brandname: {
      required: "Please Enter Brand Name!"
    },
    brandname_ar: {
      required: "Please Enter Brand Arabic Name!"
    },
  submit: {
        settings: {
            scrollToError: {
                offset: -100,
                duration: 500
            }
        }
      }

  }
});

  $("#brandcat_id").change(function(){
    var pcatid = $('#brandcat_id').val();
    // alert(pcatid);
    // var url = BASE_URL+'get/get_categoriesJSON';

    // $.getJSON(url, function (data) {
    //   $("#brandsubcat_id").empty();
    //     $.each(data, function (index, value) {
    //         // APPEND OR INSERT DATA TO SELECT ELEMENT.
    //         $('#brandsubcat_id').append('<option value="' + value.id + '">' + value.name + '</option>');
    //     });
    // });

    // $.ajax({
    //         url: BASE_URL+'get/get_categories',
    //         type: 'post',
    //         data: {pcatid:pcatid},
    //         dataType: 'html',
    //         success:function(response){
    //           $("#brandsubcat_id").html(response);
    //         }
    //     });

     $.ajax({
            url: BASE_URL+'get/get_categoriesJSON',
            type: 'post',
            data: {pcatid:pcatid},
            dataType: 'json',
            beforeSend: function () {
            $(".ajax_modal").show();
            },
            complete: function () {
                $(".ajax_modal").hide();
            },
            success:function(response){

                var len = response.length;

                $("#brandsubcat_id").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#brandsubcat_id").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });
});


    $(document).on('click','.delete_user',function()
    {
        $("#delete_user_id").val( $(this).val());
        $('#user_delete_confirmation_modal').modal('show');
    });
    $(document).on('click','.delete_product',function()
    {
        $("#delete_product_id").val( $(this).val());
        $('#product_delete_confirmation_modal').modal('show');
    });
    $(document).on('click','.delete_brand',function()
    {
        $("#delete_brand_id").val( $(this).val());
        $('#brand_delete_confirmation_modal').modal('show');
    });
    $(document).on('click','.delete_category',function()
    {
        $("#delete_category_id").val( $(this).val());
        $('#category_delete_confirmation_modal').modal('show');
    });
    $(document).on('click','.delete_review',function()
    {
        $("#delete_review_id").val( $(this).val());
        $('#review_delete_confirmation_modal').modal('show');
    });
    $(document).on('click','.delete_city',function()
    {
          $("#delete_city_id").val( $(this).val());
          $('#city_delete_confirmation_modal').modal('show');
    });
    $(document).on('click','.delete_term',function()
    {
          $("#delete_term_id").val( $(this).val());
          $('#term_delete_confirmation_modal').modal('show');
    });
    $(document).on('click','.delete_banner',function()
    {
          $("#delete_banner_id").val( $(this).val());
          $('#banner_delete_confirmation_modal').modal('show');
    });


$(document).ready(function()
{
    $(".chat-off-user").click(function()
    {
        var chatID = $(this).data("index");
        var by = $('#send-by-'+chatID).val();
        var to = $('#send-to-'+chatID).val();
        // alert('by'+by);
        // alert('to'+to);
        $.ajax({
            url: BASE_URL+'chat/get_chat',
            type: 'post',
            data: {by:by,to:to},
            dataType: 'json',
            beforeSend: function () {
            $(".ajax_modal").show();
            },
            complete: function () {
                $(".ajax_modal").hide();
            },
            success:function(response){
              $('.chat').html(response.chat);
            }
        });
    });
});
        </script>

<!--   <script src="<?php //echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
  <script type="text/javascript">
    // var socket = io.connect( 'https://'+window.location.hostname+':2200',{secure: true} );
    // var socket = io.connect( 'https://'+window.location.hostname+':9999',{secure: true} );
    var socket = io.connect( 'https://'+window.location.hostname+':5555',{secure: true} );

  socket.on( 'broadcast', function( data ) {
  console.log(data);
  });



  socket.on( 'chat_message', function( data ) {
  console.log(data);
  });

    socket.emit( 'chat_message', {
      chat_from:"1",
      chat_to:"23",
      chat_text:"Test Message.",
      chat_time:"12:47"
    });
  </script> -->

      <!-- <script type="text/javascript">
        var socket = io.connect( 'https://'+window.location.hostname+':8888',{secure: true} );
        socket.on( 'chat_message', function( data ) {
          console.log(data);
          });

        socket.on( 'broadcast', function( data ) {
          console.log(data);
          });
        var chatList = [
        ['Text', 'chat array'],
        ['sentFrom', 1],
        ['fileAttached', true],
        ['fileType', 'PDF/Image/Video'],
        ['file', 'Base64']
        ];
        socket.emit('chat_message', { 
            AppusrID: "1",
            webuserId: "1",
            time: "2020-21-04 06:23",
            Text: "test socket",
            sentFrom: "1",
            fileAttached: "false",
            fileType: "PDF",
            file: "Base64",
            chat:chatList
        });
    </script> -->
<!-- By Mohit End -->
    </body>
</html>