<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Dashboard</title>
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
                                <h1> Form </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="projects.html"> Form</a></li>
                                    <li class="breadcrumb-item active">  Form</li>
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
                                        <span id="title"></span>
                                    </div>
                                </div>    
                                <h2>  Questions</h2>

                                <div  id="questions_container" >
                                    
                                </div>
                                <div class="row form">
                                    <div class="col-md-2"><button type="submit"  class="btn btn-sm btn-primary">Submit</button></div>
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
            <div class="col-md-2 mt-2"><label for=""> Question <span class="question_number">{{question_no}}</span></label></div>
            <div class="col-md-6 mb-2" id="question_text_{{random_id}}">
                {{row.question}}
            </div>
            
        </div>
        
        <div id="options_{{random_id}}">

        </div>
    </div>
</script>
<script id="text_template" type="text/template">

    <div class="col-md-6 mb-2">
        <input type="text" class="form-control " name="question[{{row.id}}]" value="" {{#row.is_required}}required{{/row.is_required}} id="option_element_{{random_id}}" >
    </div>

</script>
<script id="textarea_template" type="text/template">

    <div class="col-md-6 mb-2">
        <textarea class="form-control " name="question[{{row.id}}]" value="" {{#row.is_required}}required{{/row.is_required}} id="option_element_{{random_id}}" ></textarea>
    </div>

</script>
<script id="number_template" type="text/template">

    <div class="col-md-6 mb-2">
        <input type="number" class="form-control " name="question[{{row.id}}]" value="" {{#row.is_required}}required{{/row.is_required}} id="option_element_{{random_id}}" >
    </div>

</script>
<script id="radio_template" type="text/template">

    <div class="col-md-6 mb-2">
        <input {{#row.is_required}}required{{/row.is_required}} type="radio" name="question[{{row.id}}]" value="{{options.option_text}}">{{options.option_text}}
    </div>

</script>


<script id="select_template" type="text/template">
 <select {{#row.is_required}}required{{/row.is_required}} id="question_select_{{row.id}}" name="question[{{row.id}}]">
    <option value="">Select</option>
 </select>
</script>
<script>
var roles='';
$(function () {
    const form_id = TRIFED.getUrlParameters().id;
    getQuestionsList(form_id);
    $("#formID").submit(function(e) {
        e.preventDefault();
    }).validate({
        rules: {
            
            
        },
        messages: {
            
        },
        submitHandler: function(form) { 
            
            //const data=$('#formID').serializeArray();
            
            
            var url = conf.addFormsAnswer.url;
            var method = conf.addFormsAnswer.method;
            
            var form = $('#formID')[0];   
            var data = new FormData(form);  
            data.append('form_id', form_id );
            // if (edit_id != undefined && edit_id != '') 
            // {
            //     data.append('form_id', edit_id );
            // }
            TRIFED.fileAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    
                    TRIFED.showMessage('success', 'Data saved successfully');
                    setTimeout(function() { window.location = 'answers_view.php?form_id='+form_id}, 3000);
                } else {
                    TRIFED.showError('error', response.message);
                }
            });
            return false;  //This doesn't prevent the form from submitting.
        }
    });  
});
getQuestionsList = (form_id) => {
    var url = conf.getQuestionsList.url(form_id);
    var method = conf.getQuestionsList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            $('#title').html(response.data.title);
            var questions=response.data.questions;
            var question_no=0;
            questions.forEach((row)=>{
                ++question_no;
                //if(row.element_type=='text')
                //{
                    var random_id=Date.now();
                    var data = { 
                        random_id:random_id,
                        question_no,
                        row
                    };
                    var template = $("#questions_template").html();
                    var text = Mustache.render(template, data);
                    $("#questions_container").append(text);
                    if(row.element_type=='text')
                    {
                        textTemplate(random_id,row)
                    }
                    if(row.element_type=='textarea')
                    {
                        textareaTemplate(random_id,row)
                    }
                    if(row.element_type=='number')
                    {
                        numberTemplate(random_id,row)
                    }
                    if(row.element_type=='select')
                    {
                        var options=row.options;
                        selectTemplate(random_id,row,options)
                        
                    }
                    if(row.element_type=='radio')
                    {
                        var options=row.options;
                        options.forEach((opt)=>{
                            radioTemplate(random_id,row,opt)
                        });
                    }
                    if(row.element_type=='date')
                    {
                        var options=row.options;
                        textTemplate(random_id,row);
                        $('#option_element_'+random_id).datepicker(
                            {
                                dateFormat: 'dd-mm-yy',
                                changeMonth: true,
                                changeYear: true,
                                yearRange: "c-100:c+10",
                            }
                        );
                        $('#option_element_'+random_id).prop('readonly',true)
                    }

                //}
            })
        }
    });
}
textTemplate=(random_id,row)=>{
    //var random_id=Date.now();
    var data = { 
        row,
        random_id
    };
    var template = $("#text_template").html();
    var text = Mustache.render(template, data);
    $("#options_"+random_id).html(text);
}
textareaTemplate=(random_id,row)=>{
    //var random_id=Date.now();
    var data = { 
        row,
        random_id
    };
    var template = $("#textarea_template").html();
    var text = Mustache.render(template, data);
    $("#options_"+random_id).html(text);
}
numberTemplate=(random_id,row)=>{
    //var random_id=Date.now();
    var data = { 
        row,
        random_id
    };
    var template = $("#number_template").html();
    var text = Mustache.render(template, data);
    $("#options_"+random_id).html(text);
}
radioTemplate=(random_id,row,options)=>{
    var data = { 
        row,
        options
    };
    var template = $("#radio_template").html();
    var text = Mustache.render(template, data);
    $("#options_"+random_id).append(text);
}
selectTemplate=(random_id,row,options)=>{
    var data = {
        row
    };
    var template = $("#select_template").html();
    var text = Mustache.render(template, data);
    $("#options_"+random_id).append(text);
    select_options='<option value="">Select</option>';
    options.forEach((opt)=>{
        select_options +='<option value="'+opt.option_text+'">'+opt.option_text+'</option>'
    });
    $('#question_select_'+row.id).html(select_options);
}
</script>
</script>
</body>

</html>