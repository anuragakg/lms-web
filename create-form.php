<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/helper.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
</head>

<body>

	<?php include('parts/head-tag.php'); ?>
    <?php include('sidebar.php');?>
    <?php include('header.php');?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="page-header">
                            <div class="page-title">
                                <h1> Create Form </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="projects.html">Create Form</a></li>
                                    <li class="breadcrumb-item active"> Create Form</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">

                    <div class="row">

                        <div class="col-md-12 hidden ">
                            <form id="formID">
                                
                                <div class="row form">
                                    <div class="col-md-2 mt-2"><label for=""> Form Name </label></div>
                                    <div class="col-md-3 mb-2">
                                        <input type="text" name="title" id="title" placeholder="Enter Product Vertical Name" class="form-control form-control-sm"  required="">
                                    </div>
                                </div>    
                                <h2> Add Questions</h2><a onclick="add_Question();" href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                                <div  id="questions_container" >
                                    
                                </div>
                                <div class="row form">
                                    <div class="col-md-2"><button type="submit"  class="btn btn-sm btn-primary">Create</button></div>
                                </div>
                                

                            </form>
                        </div>
                     
                        
                    </div>
				</section>
			
			</div>


            
            
        </div>
    </div>
<?php include('parts/js-files.php'); ?>

<script id="questions_template" type="text/template">
    
    <div id="question_{{random_id}}">
        <div class="row form" >
            <div class="col-md-2 mt-2"><label for=""> Question <span class="question_number"></span></label></div>
            <div class="col-md-6 mb-2">
                <input type="text" class="form-control " name="question[question_text][{{random_id}}]" id="question_text_{{random_id}}" value="" required>
            </div>
            
        </div>
        <div class="row form" >
            <div class="col-md-2 mt-2"><label for=""> </label></div>
            <div class="col-md-3 mb-2">
                <select class="form-control " name="question[question_answer_option][{{random_id}}]" id="question_answer_option_{{random_id}}" onchange="change_options({{random_id}})" required>
                    <option value="">Select Options</option>
                    <option value="text">Text</option>
                    <option value="textarea">Textarea</option>
                    <option value="number">Number</option>
                    <option value="select">Select</option>
                    <option value="radio">Radio</option>
                    <option value="date">Date</option>
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <a onclick="delete_Question({{random_id}});" href="javascript:void(0)"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
            </div>
        </div>
        <div id="options_{{random_id}}">

        </div>
    </div>
</script>
<script id="select_template" type="text/template">
 <div class="row form options_{{question_random_id}}" id="option_{{question_random_id}}_{{random_id}}" >

    <div class="col-md-2 mt-2"><label for=""> Option <span class="option_number_{{question_random_id}}"></span></label>
    </div>
    <div class="col-md-6 mb-2">
        <input type="text" class="form-control " name="question[option_text][{{question_random_id}}][]" id="option_text_{{question_random_id}}_{{random_id}}" value="" required>
    </div>
    <div class="col-md-3 mb-2">
        <a onclick="add_options({{question_random_id}});" href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

        <a onclick="delete_options({{question_random_id}},{{random_id}});" href="javascript:void(0)"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
    </div>
</div>
</script>
<script>
var roles='';
$(function () {
    add_Question();
    $("#formID").submit(function(e) {
        e.preventDefault();
    }).validate({
        rules: {
            
            
        },
        messages: {
            
        },
        submitHandler: function(form) { 
            
            //const data=$('#formID').serializeArray();
            
            
            var url = conf.addForm.url;
            var method = conf.addForm.method;
            
            var form = $('#formID')[0];   
            var data = new FormData(form);  
            // if (edit_id != undefined && edit_id != '') 
            // {
            //     data.append('form_id', edit_id );
            // }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    
                    TRIFED.showMessage('success', 'Data saved successfully');
                    setTimeout(function() { window.location = 'forms-list.php'}, 3000);
                } else {
                    TRIFED.showError('error', response.message);
                }
            });
            return false;  //This doesn't prevent the form from submitting.
        }
    });      
});
    

    function add_Question(row=[]){
        
        var random_id=Date.now();
        var data = { 
            random_id:random_id,
            row
        };
        var template = $("#questions_template").html();
        var text = Mustache.render(template, data);

      $("#questions_container").append(text);
      
      
      inc_question();
    }
    function inc_question(){
        var question_number=0;
        
        $(".question_number").each(function() {
             ++question_number;
            $(this).html(question_number)
        });
    }
    
    function delete_Question(random_id){
        if($(".question_number").length >1){
            $('#question_'+random_id).remove();
            inc_question()    
        }
        
    }
    function change_options(question_random_id)
    {
        $(".options_"+question_random_id).remove();
        add_options(question_random_id);
    }
    function add_options(question_random_id)
    {
        var option_type=$('#question_answer_option_'+question_random_id).val();
        if(option_type=='select' || option_type=='radio' ||  option_type=='checkbox')
        {

            add_select_options(question_random_id);
        }else{
            $(".options_"+question_random_id).remove();
        }
    }
    function add_select_options(question_random_id)
    {
        var random_id=Date.now();
        var data = { 
            question_random_id,
            random_id
        };
        var template = $("#select_template").html();
        var text = Mustache.render(template, data);

        $("#options_"+question_random_id).append(text);
        inc_question_select(question_random_id);
    }
    inc_question_select=(question_random_id)=>{
        var option=0;
        
        $(".option_number_"+question_random_id).each(function() {
             ++option;
            $(this).html(option)
        });
    }
    function delete_options(question_random_id,random_id){
        if($(".option_number_"+question_random_id).length >1){
            $('#option_'+question_random_id+'_'+random_id).remove();
           inc_question_select(question_random_id);
        }
    }
    </script>
</script>
</body>

</html>