<?php
$get_setting=$this->Crud_model->get_single('setting');
$get_category=$this->Crud_model->GetData('category','',"status='Active'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php if($this->uri->segment(1) == 'workdetail') { ?>
    <title><?php echo @$post_data->post_title?> - <?php echo @$get_setting->website_name?></title>
    <?php } else if ($this->uri->segment(1) == 'career-tips') { ?>
    <title><?php if(!empty(@$get_career->title)) { echo @$get_career->title; } else { echo @$title; }?> - <?php echo @$get_setting->website_name?></title>
    <?php } else if ($this->uri->segment(1) == 'businessdetail') { ?>
    <title><?php echo @$userdata->companyname?> - <?php echo @$get_setting->website_name?></title>
    <?php } else if ($this->uri->segment(1) == 'talentdetail') { ?>
    <title><?php echo @$user_detail->firstname.' '.$user_detail->lastname?> - <?php echo @$get_setting->website_name?></title>
    <?php } else if ($this->uri->segment(1) == 'productdetail') { ?>
    <title><?php echo @$prod_details[0]['prod_name']; ?> - <?php echo @$get_setting->website_name?></title>
    <?php } else { ?>
    <title><?php echo @$title?> - <?php echo @$get_setting->website_name?></title>
    <?php } ?>

    <?php if($this->uri->segment(1) == 'businessdetail') { ?>
    <meta name="description" content="<?php echo @$userdata->short_bio?>">
    <?php } else if($this->uri->segment(1) == 'talentdetail') { ?>
    <meta name="description" content="<?php echo @$user_detail->short_bio?>">
    <?php } else if($this->uri->segment(1) == 'workdetail') { ?>
    <meta name="description" content="<?php echo @$post_data->description?>">
    <?php } else if($this->uri->segment(1) == 'about-us') { ?>
    <meta name="description" content="Afrebay embarked on its transformative journey in 2013 with an unwavering commitment to bridging the gap in the African and American workforce and trade economies. Rooted in the belief that collaboration knows no boundaries, we've tirelessly worked to create a platform that fosters connections, empowers entrepreneurs and businesses, and opens doors to a world of possibilities.
">
    <?php } else if ($this->uri->segment(1) == 'productdetail') { ?>
    <meta name="description" content="<?php echo $prod_details[0]['prod_description']; ?>">
    <?php } else if ($this->uri->segment(1) == 'findwork') { ?>
    <meta name="description" content="Your Bridge to career opportunities. Contact us today to start your journey toward a brighter future. Our experts are here to guide you in finding your dream job">
    <?php } else if ($this->uri->segment(1) == 'career-tips') { $description = explode('.', $get_career->description)?>
    <meta name="description" content="<?= $description[0]?>">
    <?php } else { ?>
    <meta name="description" content="<?php echo @$description?>">
    <?php } ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="<?=base_url(); ?>uploads/logo/<?= $get_setting->favicon?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap-grid.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>assets/css/icons.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>assets/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/chosen.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/colors/colors.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="<?=base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/rating_css.css" />
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
    <?php if(empty($this->uri->segment(1))) { ?>
    <meta property="og:title" content="><?php echo @$title?>" />
    <meta property="og:url" content="<?php echo base_url();?>" />
    <meta property="og:image" content="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" />
    <meta property="og:description" content="<?php echo @$description?>" />
    <meta property="og:site_name" content="<?php echo @$get_setting->website_name?>" />
    <?php } ?>
    <link rel="canonical" href="<?php echo current_url();?>">
    <style>
    .completeSub {display: none; text-align: center; margin-top: 20px; color: #fa5a1f; font-size: 20px;}
    #completeSub {position: relative;display: inline-block;}
    #completeSub #completeSubtext {visibility: hidden;width: max-content;background-color: white;color: #000;text-align: center;border-radius: 6px;padding: 5px 10px;position: absolute;z-index: 1;top: 50px;font-size: 13px;right: 0;}
    #completeSub:hover #completeSubtext {visibility: visible;}
    .User_Dashboard_Menu .Profile_dashboard_btn{width: 235px !important;}
    #frame #sidepanel #profile .wrap p {font-size: 14px !important;}
</style>
<script>
function completeSub() {
    $('.completeSub').show();
    setTimeout(function(){
        $('.completeSub').fadeOut('slow');
    },4000);
}
$(function () {
    $('#completeSub').mouseover(function(){
        $("#completeSub").css("background-color", "yellow");
    });
})
</script>
<script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
<script>
window.OneSignalDeferred = window.OneSignalDeferred || [];
OneSignalDeferred.push(function(OneSignal) {
    OneSignal.init({
        appId: "3730b45f-709e-49b5-b77a-defdd7fe63b4",
        safari_web_id: "web.onesignal.auto.45da02f8-0e2a-491b-9d85-c6fbaf55a283",
        notifyButton: {
          enable: true,
        },
        promptOptions: {
            slidedown: {
                prompts: [{
                    type: "push",
                    autoPrompt: true,
                    text: {
                        acceptButton: "Ok",
                        cancelButton: "No Thanks",
                        actionMessage: "We would like to show you notifications for the updates and latest news",
                        confirmMessage: "Thank You!",
                    },
                    delay: {
                        pageViews: 1,
                        timeDelay: 5
                    },
                }]
            }
        }
    });
    OneSignal.push(function()  {
        OneSignal.Notifications.addEventListener('permissionChange', function (isSubscribed) {
        if(!isSubscribed) return;
        OneSignal.push(async function() {
            let url = "<?php base_url('Home/addSubscription_id')?>";
            let formData = new FormData();
            formData.append("subscription_id", OneSignal.User.PushSubscription.id);
            let response = await fetch(url, {
                method: "POST",
                body: formData
            })
        });
    });
    })
});
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-63DY10P9S3"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-63DY10P9S3');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NMS5S3RF');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NMS5S3RF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <div class="page-loading">
        <img src="<?=base_url(); ?>assets/images/loader.gif" alt="" />
    </div>
    <div class="theme-layout" id="scrollup">
        <div class="responsive-header" style="background: #ffffff;">
            <div class="responsive-menubar" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="res-logo">
                    <a href="<?=base_url(); ?>" title=""><img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" /></a>
                </div>
                <div class="menu-resaction">
                    <div class="res-openmenu" style="color: #000;">Menu</div>
                    <div class="res-closemenu" style="color: #000;">Close</div>
                </div>
            </div>
            <div class="responsive-opensec" style="background: #f67a49; padding: 0;">
                <div class="btn-extars" style="display: flex; align-items: center; justify-content: space-between; border-color: #fff; padding: 20px 30px;">
                <?php
                if(!empty($_SESSION['afrebay']['userId'])) {
                    if($_SESSION['afrebay']['userType'] == '2') {
                        if($get_setting->required_subscription == '1') { 
                            $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['afrebay']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                            if(empty($get_sub_data)) { ?>
                            <a href="javascript:void(0)" title="" class="post-job-btn" id="completeSub"><i class="la la-plus"></i>Post Work<span id="completeSubtext">Please activate a subscription package and complete your profile to proceed with the post job activities.</span></a>
                            <?php } else if(!empty($get_sub_data)) {
                                $profile_check = $this->db->query("SELECT `profilePic`, `companyname`, `email`, `mobile`,`address`, `foundedyear`, `teamsize`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                                if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) { ?>
                                    <a href="javascript:void(0)" title="" class="post-job-btn" id="completeSub"><i class="la la-plus"></i>Post Work<span id="completeSubtext">Please activate a subscription package and complete your profile to proceed with the post job activities.</span></a>
                                <?php } else { ?>
                                    <a href="<?= base_url('postwork')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Work</a>
                                <?php } } else { ?>
                                <a href="<?= base_url('login')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Work</a>
                            <?php 
                            } } else {
                            $profile_check = $this->db->query("SELECT `profilePic`, `companyname`, `email`, `mobile`,`address`, `foundedyear`, `teamsize`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                            if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) 
                            { ?>
                                <a href="javascript:void(0)" title="" class="post-job-btn" id="completeSub"><i class="la la-plus"></i>Post Work<span id="completeSubtext">Please activate a subscription package and complete your profile to proceed with the post job activities.</span></a>
                            <?php 
                            } else { ?>
                                <a href="<?= base_url('postwork')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Work</a>
                            <?php } } }
                } else { ?>
                <!-- <a href="<?= base_url('login')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Work</a> -->
                <?php } ?>
                    <ul class="account-btns" style="margin: 0;">
                        <?php if(!empty($_SESSION['afrebay']['userId'])){?>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>dashboard"><i class="la la-key"></i> My Account</a>
                            </li>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>logout"><i class="la la-external-link-square"></i> Logout</a>
                            </li>
                        <?php } else {?>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>signup" title=""><i class="la la-key"></i> Sign Up</a>
                            </li>
                            <li class="signin-popup">
                                <a href="<?= base_url('login')?>" title=""><i class="la la-external-link-square"></i> Login</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="responsivemenu" style="padding-left: 30px; padding-right: 30px;">
                    <ul>
                        <li class="account-btns">
                            <a href="<?= base_url('findwork')?>" title="">Find Work</a>
                        </li>
                        <li class="account-btns">
                            <a href="<?= base_url('businesses')?>" title="">Businesses</a>                            
                        </li>
                        <li class="account-btns">
                            <a href="<?= base_url('talent')?>" title="">Talent</a>                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <header class="stick-top forsticky ">
            <div class="menu-sec">
                <div class="container Header_Menu_Nav">
                    <div class="logo">
                        <a href="<?=base_url(); ?>" title="">
                            <img class="hidesticky" src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" />
                            <img class="showsticky" src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" />
                            <input type="hidden" class="hidden-logo" value="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>">
                        </a>
                    </div>
                    <nav>
                        <ul>
                            <li class="">
                                <a href="<?= base_url('businesses')?>" title="">Businesses</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url('talent')?>" title="">Talent</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url('findwork')?>" title="">Find Work</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="btn-extars">
                        <?php
                        if(!empty($_SESSION['afrebay']['userId'])) {
                            if($_SESSION['afrebay']['userType'] == '2') {
                                if($get_setting->required_subscription == '1') { 
                                    $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['afrebay']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                                    if(empty($get_sub_data)) { ?>
                                    <a href="javascript:void(0)" title="" class="post-job-btn" id="completeSub"><i class="la la-plus"></i>Post Work<span id="completeSubtext">Please activate a subscription package and complete your profile to proceed with the post job activities.</span></a>
                                    <?php } else if(!empty($get_sub_data)) {
                                        $profile_check = $this->db->query("SELECT `profilePic`, `companyname`, `email`, `mobile`,`address`, `foundedyear`, `teamsize`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                                        if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) { ?>
                                            <a href="javascript:void(0)" title="" class="post-job-btn" id="completeSub"><i class="la la-plus"></i>Post Work<span id="completeSubtext">Please activate a subscription package and complete your profile to proceed with the post job activities.</span></a>
                                        <?php } else { ?>
                                            <a href="<?= base_url('postwork')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Work</a>
                                        <?php } } else { ?>
                                        <a href="<?= base_url('login')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Work</a>
                                    <?php 
                                    } } else {
                                    $profile_check = $this->db->query("SELECT `profilePic`, `companyname`, `email`, `mobile`,`address`, `foundedyear`, `teamsize`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                                    if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) 
                                    { ?>
                                        <a href="javascript:void(0)" title="" class="post-job-btn" id="completeSub"><i class="la la-plus"></i>Post Work<span id="completeSubtext">Please activate a subscription package and complete your profile to proceed with the post job activities.</span></a>
                                    <?php 
                                    } else { ?>
                                        <a href="<?= base_url('postwork')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Work</a>
                                    <?php } } }
                        } else { ?>
                        <!-- <a href="<?= base_url('login')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Work</a> -->
                        <?php } ?>

                        <ul class="account-btns">
                            <?php if(!empty($_SESSION['afrebay']['userId'])) { ?>
                                <li class="menu-item-has-children User_Dashboard_Menu">
                                    <a class="Profile_dashboard_btn" href="javascript:void(0)" title="">Hi,
                                        <?php if(!empty($_SESSION['afrebay']['firstname'])) {
                                            $fullname = $_SESSION['afrebay']['firstname']." ".$_SESSION['afrebay']['lastname'];
                                        } else {
                                            $fullname = $_SESSION['afrebay']['companyname'];
                                        }
                                        echo ucwords($fullname); ?>
                                    </a>
                                    <ul>
                                        <li>
                                            <?php 
                                            if($get_setting->required_subscription != '1') 
                                            {
                                                $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                                                if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) 
                                                { ?>
                                                    <a href="<?=base_url(); ?>profile" title="">Profile</a>
                                                <?php 
                                                } 
                                                else 
                                                { 
                                                ?>
                                                <a href="<?=base_url(); ?>dashboard" title="">Dashboard</a>
                                                <?php 
                                                }
                                            } else {
                                                $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['afrebay']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                                                if(empty($get_sub_data)) 
                                                {
                                                    if(@$_SESSION['afrebay']['userType']=='1') 
                                                    { ?>
                                                        <a href="<?=base_url(); ?>subscription" title="">Subscribe</a>
                                                    <?php 
                                                    } 
                                                    else 
                                                    { ?>
                                                        <a href="<?=base_url(); ?>subscription" title="">Subscribe</a>
                                                    <?php 
                                                    }
                                                } 
                                                else 
                                                {
                                                    $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['afrebay']['userId']."'")->result_array();
                                                    if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) 
                                                    { ?>
                                                        <a href="<?=base_url(); ?>profile" title="">Profile</a>
                                                    <?php 
                                                    } 
                                                    else 
                                                    { 
                                                    ?>
                                                    <a href="<?=base_url(); ?>dashboard" title="">Dashboard</a>
                                                    <?php 
                                                    } 
                                                } 
                                            }
                                            ?>
                                        </li>
                                        <li>
                                            <?php
                                            $uid = $_SESSION['afrebay']['userType'];
                                            if(@$_SESSION['afrebay']['userType']=='1') { ?>
                                            <a href="<?php echo base_url("talentdetail/".base64_encode($_SESSION['afrebay']['userId']))?>" title="">View Profile</a>
                                            <?php } else if(@$_SESSION['afrebay']['userType']=='2') { ?>
                                            <a href="<?php echo base_url("businessdetail/".base64_encode($_SESSION['afrebay']['userId']))?>" title="">View Profile</a>
                                            <?php } ?>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('password-reset')?>" title="">Change Password</a>
                                        </li>
                                        <li><a href="<?=base_url(); ?>logout">Logout</a></li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="">
                                    <a href="<?=base_url(); ?>signup"><i class="la la-key"></i> Sign Up</a>
                                </li>
                                <li class="">
                                    <a href="<?=base_url(); ?>login"><i class="la la-external-link-square"></i> Login</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
