<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url(<?php echo base_url()?>assets/images/resource/mslider1.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header" style="padding-top: 90px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="dashboardhak">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Add Education</h2>
                <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Education</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('sidebar');?>
<div class="col-md-12 col-sm-12 display-table-cell v-align form-design">
    <div class="user-dashboard">
        <form class="form" action="<?= $action; ?>" method="post" id="registrationForm" enctype="multipart/form-data">
            <div class="row row-sm">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="cardak profile-mobile">
                        <div class="container bootstrap snippet">
                            <div class="new-pro">
                                <a href="#" class="pull-right"></a>
                            </div>
                        </div>
                        <div class="profile-dsd">
                            <div class="tab-content">
                                <div class="tab-pane active" style="padding: 0px;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="first_name"><h4>Degree <span style="color: red">*</span></h4></label>
                                                <!-- <input type="text" class="form-control" name="education" placeholder="Enter Degree" value="<?= @$education; ?>" required list="education" autocomplete="off"/> -->
                                                <select class="form-control" name="education" required>
                                                    <option value="">Select Degree</option>
                                                    <option value="Professional Certificate" <?php if($education == "Professional Certificate") { echo "selected"; }?>>Professional Certificate</option>
                                                    <option value="Associates Degree" <?php if($education == "Associates Degree") { echo "selected"; }?>>Associates Degree</option>
                                                    <option value="Bachelor's Degree" <?php if($education == "Bachelor's Degree") { echo "selected"; }?>>Bachelor's Degree</option>
                                                    <option value="Master's Degree" <?php if($education == "Master's Degree") { echo "selected"; }?>>Master's Degree</option>
                                                    <option value="Doctoral Degree" <?php if($education == "Doctoral Degree") { echo "selected"; }?>>Doctoral Degree</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="first_name"><h4>Year of Graduation <span style="color: red">*</span></h4></label>
                                                <input type="text" class="form-control" name="passing_of_year" id="passing_of_year" placeholder="Enter the Year of Graduation"  value="<?= @$passing_of_year; ?>" required list="passing_of_year" autocomplete="off" onkeypress="only_number(event)" maxlength = '4'/>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="first_name"><h4>College/School/University Name <span style="color: red">*</span></h4></label>
                                                <input type="text" class="form-control" name="college_name" placeholder="Enter College/School/University Name"  value="<?= $college_name; ?>" required list="college_name" autocomplete="off"/>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="first_name"><h4>Major/Concentration </h4></label>
                                                <input type="text" class="form-control" name="department" placeholder="Major/Concentration"  value="<?= @$department; ?>" list="department" autocomplete="off"/>
                                                </div>
                                                <div class="col-lg-12"><br>
                                                    <label for="first_name"><h4>Description </h4></label>
                                                    <textarea type="text" class="form-control" name="description" maxlength="1000" id="description" value="<?= $description; ?>" ><?= @$description; ?></textarea>
                                                    <div id="the-count">
                                                    <span id="current">0</span>
                                                    <span id="maximum">/ 1000</span>
                                                </div>
                                                </div>
                                                <input type="hidden" name="id" value="<?= @$id; ?>">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <div class="col-xs-12 aksek">
                                            <button class="post-job-btn pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
//CKEDITOR.replace('description');
function only_number(event) {
    var x = event.which || event.keyCode;
    console.log(x);
    if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 || x == 46) {
        return;
    } else {
        event.preventDefault();
    }
}
$('#description').keyup(function() {  
    var characterCount = $(this).val().length,
        current = $('#current'),
        maximum = $('#maximum'),
        theCount = $('#the-count');
    current.text(characterCount);
    
    /*This isn't entirely necessary, just playin around*/
    if (characterCount < 500) {
        current.css('color', '#666');
    }
    if (characterCount > 500 && characterCount < 650) {
        current.css('color', '#6d5555');
    }
    if (characterCount > 650 && characterCount < 750) {
        current.css('color', '#793535');
    }
    if (characterCount > 750 && characterCount < 850) {
        current.css('color', '#841c1c');
    }
    if (characterCount > 850 && characterCount < 999) {
        current.css('color', '#8f0001');
    }

    if (characterCount >= 740) {
        maximum.css('color', '#8f0001');
        current.css('color', '#8f0001');
        theCount.css('font-weight','bold');
    } else {
        maximum.css('color','#666');
        theCount.css('font-weight','normal');
    }
});
</script>
