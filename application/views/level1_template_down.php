</section>
<div class="footer-main">
                    Solution To Asset Management &copy, 2016
                </div>
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="<?php echo base_url() ; ?>asset/tmp_js/jquery.min.js" type="text/javascript"></script>
        <!--<script src="<?php echo base_url() ; ?>asset/tmp_js/jquery.min2.js" type="text/javascript"></script>-->

        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo base_url() ; ?>asset/tmp_js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url() ; ?>asset/tmp_js/bootstrap.min.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url() ; ?>asset/tmp_js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <script src="<?php echo base_url() ; ?>asset/tmp_js/plugins/chart.js" type="text/javascript"></script>

        <!-- datepicker
        <script src="tmp_js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
        <!-- Bootstrap WYSIHTML5
        <script src="tmp_js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
        <!-- iCheck -->
        <script src="<?php echo base_url() ; ?>asset/tmp_js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- calendar -->
        <script src="<?php echo base_url() ; ?>asset/tmp_js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>

        <!-- Director App -->
        <script src="<?php echo base_url() ; ?>asset/tmp_js/Director/app.js" type="text/javascript"></script>

        <!-- Director dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url() ; ?>asset/tmp_js/Director/dashboard.js" type="text/javascript"></script>
        

        <!-- Director for demo purposes -->
        <script type="text/javascript">
            $('input').on('ifChecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().addClass('highlight');
                $(this).parents('li').addClass("task-done");
                console.log('ok');
            });
            $('input').on('ifUnchecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().removeClass('highlight');
                $(this).parents('li').removeClass("task-done");
                console.log('not');
            });

        </script>
        <script>
            $('#noti-box').slimScroll({
                height: '400px',
                size: '5px',
                BorderRadius: '5px'
            });

            $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });
</script>
<script type="text/javascript">
    $(function() {
                "use strict";
                //BAR CHART
                var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [65, 59, 80, 81, 56, 55, 40]
                        },
                        {
                            label: "My Second dataset",
                            fillColor: "rgba(151,187,205,0.2)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: [28, 48, 40, 19, 86, 27, 90]
                        }
                    ]
                };
            new Chart(document.getElementById("linechart").getContext("2d")).Line(data,{
                responsive : true,
                maintainAspectRatio: false,
            });

            });
            // Chart.defaults.global.responsive = true;
</script>

<script src="<?php echo base_url(); ?>asset/datepicker/external/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>asset/datepicker/jquery-ui.js"></script>
<script>

$( "#accordion" ).accordion();

var availableTags = [
    "ActionScript",
    "AppleScript",
    "Asp",
    "BASIC",
    "C",
    "C++",
    "Clojure",
    "COBOL",
    "ColdFusion",
    "Erlang",
    "Fortran",
    "Groovy",
    "Haskell",
    "Java",
    "JavaScript",
    "Lisp",
    "Perl",
    "PHP",
    "Python",
    "Ruby",
    "Scala",
    "Scheme"
];

/*$( "#datepicker" ).datepicker({
    inline: true 
}); //.datepicker({ dateFormat: 'yy-mm-dd' });*/

//This will make the month and year a dropdown,suitable for date of birth
$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd', 
 changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0'
}).val();

$( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
$( ".datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();

$( "#date_installed" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
$( "#purchase_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();

</script>

<script>
/*Responsible for the accordion on the postloan page*/
$('.toggle').click(function (event) {
    event.preventDefault();
    var target = $(this).attr('href');
    $(target).toggleClass('hidden show');
});

$('.toggle2').click(function (event) {
    event.preventDefault();
    var target = $(this).attr('href');
    $(target).toggleClass('hidden show');
});

$('.toggle3').click(function (event) {
    event.preventDefault();
    var target = $(this).attr('href');
    $(target).toggleClass('hidden show');
});

$('.toggle4').click(function (event) {
    event.preventDefault();
    var target = $(this).attr('href');
    $(target).toggleClass('hidden show');
});

$('.toggle5').click(function (event) {
    event.preventDefault();
    var target = $(this).attr('href');
    $(target).toggleClass('hidden show');
});

$('.toggle6').click(function (event) {
    event.preventDefault();
    var target = $(this).attr('href');
    $(target).toggleClass('hidden show');
});


/*this javascript is to force users enter decimal number only in a an input field*/

$(document).ready(function() {
    $(".mobile_phone").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    });
});


</script>

<script>
/*responsible for pagination*/

$.fn.pageMe = function(opts){
    var $this = this,
        defaults = {
            perPage: 7,
            showPrevNext: false,
            hidePageNumbers: false
        },
        settings = $.extend(defaults, opts);
    
    var listElement = $this;
    var perPage = settings.perPage; 
    var children = listElement.children();
    var pager = $('.pager');
    
    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }
    
    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }
    
    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
    }
    
    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;
    }
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
    }
    
    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }
    pager.children().eq(1).addClass("active");
    
    children.hide();
    children.slice(0, perPage).show();
    
    pager.find('li .page_link').click(function(){
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    });
    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });
    
    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        goTo(goToPage);
    }
     
    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        goTo(goToPage);
    }
    
    function goTo(page){
        var startAt = page * perPage,
            endOn = startAt + perPage;
        
        children.css('display','none').slice(startAt, endOn).show();
        
        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }
        
        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }
        
        pager.data("curr",page);
        pager.children().removeClass("active");
        pager.children().eq(page+1).addClass("active");
    
    }
};

$(document).ready(function(){
    
  $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:50});
  $('#myTable2').pageMe({pagerSelector:'#myPager2',showPrevNext:true,hidePageNumbers:false,perPage:5});
  $('#myTable3').pageMe({pagerSelector:'#myPager3',showPrevNext:true,hidePageNumbers:false,perPage:5});
  $('#myTable_ledger').pageMe({pagerSelector:'#myPager_ledger',showPrevNext:true,hidePageNumbers:false,perPage:24});
    
});

</script>

<script>
 //disables all input fields inside this div--> #l1_loan
   $(document).ready(function(){
        $('#l1_loan :input').attr('disabled', true);
       });

</script>

<script>
 //disables all input fields inside this div--> #l1_loan
   $(document).ready(function(){
        $('#l1_loan :input').attr('disabled', true);
       });

      function disableall1(){
       $('#l1_loan :input').removeAttr('disabled');
       }

</script>

<script>
    //pass dropdown value to text box

   $(document).ready(function () {
    $("#titledd").change(function () {
    var selectedText2 =  $("#titledd option:selected").text();
    $('[name="title"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#means_of_iddd").change(function () {
    var selectedText2 =  $("#means_of_iddd option:selected").text();
    $('[name="means_of_id"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#marital_statusdd").change(function () {
    var selectedText2 =  $("#marital_statusdd option:selected").text();
    $('[name="marital_status"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#emp_statusdd").change(function () {
    var selectedText2 =  $("#emp_statusdd option:selected").text();
    $('[name="emp_status"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#industrydd").change(function () {
    var selectedText2 =  $("#industrydd option:selected").text();
    $('[name="industry"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#level_of_edudd").change(function () {
    var selectedText2 =  $("#level_of_edudd option:selected").text();
    $('[name="level_of_edu"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#pay_daydd").change(function () {
    var selectedText2 =  $("#pay_daydd option:selected").text();
    $('[name="pay_day"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#purp_of_loandd").change(function () {
    var selectedText2 =  $("#purp_of_loandd option:selected").text();
    $('[name="purp_of_loan"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#existing_loandd").change(function () {
    var selectedText2 =  $("#existing_loandd option:selected").text();
    $('[name="existing_loan"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#loan_typedd").change(function () {
    var selectedText2 =  $("#loan_typedd option:selected").text();
    $('[name="loan_type"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#bank_accountdd").change(function () {
    var selectedText2 =  $("#bank_accountdd option:selected").text();
    $('[name="bank_account"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#relationshipdd").change(function () {
    var selectedText2 =  $("#relationshipdd option:selected").text();
    $('[name="relationship"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#bank_namedd").change(function () {
    var selectedText2 =  $("#bank_namedd option:selected").text();
    $('[name="bank_name"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#genderdd").change(function () {
    var selectedText2 =  $("#genderdd option:selected").text();
    $('[name="gender"]').val(selectedText2);
    });
});

$(document).ready(function () {
    $("#dependentsdd").change(function () {
    var selectedText2 =  $("#dependentsdd option:selected").text();
    $('[name="dependents"]').val(selectedText2);
    });
});
</script>

<script>
   $(function() {
    $(".navbar-btn").trigger("click");
});

</script>

<!--jquery for printing-->
<script>
         function printContent(el)
         {
           var restorepage=$('body').html();
           var printcontent = $('#' + el).clone();
           $('body').empty().html(printcontent);
           window.print();
           $('body').html(restorepage);


         }
  </script>

  <!--This prevents entering #-->
  <script>
    $('#loan_amount').keyup(function(e) {
     var val = $.trim( this.value );
    if (e.shiftKey && e.which == 51) {
    $(this).val(val.replace(/\#/,''));
  }
});

 $('#monthly_salary').keyup(function(e) {
     var val = $.trim( this.value );
    if (e.shiftKey && e.which == 51) {
    $(this).val(val.replace(/\#/,''));
  }
});
  </script>

  <script>
//for means of id (moid)
 $(document).ready(function(){
  $('#category').change(function(){
   //if(this.checked){
   var selTable = $(this).val(); // selected name from dropdown #table
   //var group_id2 = $('#group_id').val();
   $.ajax({
    url: "<?php echo site_url(); ?>/qlip_controller/ajax_call_category", // or "resources/ajax_call" - url to fetch the next dropdown
    async: false,
    type: "POST",     // post
    data: "category="+selTable,  // variable send
    dataType: "html",    // return type
    success: function(data) {  // callback function
     $('#category_box').html(data);
    }
   })
  //}///////
  });
 });
  </script>

  <script type="text/javascript">
//javascript, note you might need to pass e to function(e)

//this js 

//for group selection
 $(document).ready(function(){
  $('#table1').change(function(){
   //if(this.checked){
   var selTable = $(this).val(); // selected name from dropdown #table
   //var group_id2 = $('#group_id').val();
   $.ajax({
    url: "<?php echo site_url(); ?>/qlip_controller/ajax_call1", // or "resources/ajax_call" - url to fetch the next dropdown
    async: false,
    type: "POST",     // post
    data: "table1="+selTable,  // variable send
    dataType: "html",    // return type
    success: function(data) {  // callback function
     $('#year').html(data);
    }
   })
  //}///////
  });
 });

 </script>
 
 



 

</body>
</html>