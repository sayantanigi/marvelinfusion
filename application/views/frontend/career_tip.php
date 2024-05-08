<?php 
 if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else{
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3><?= ucfirst(@$get_career->title)?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="max_height">
    <div class="block Career_Tips">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 column">
                    <div class="blog-single">
                        <h2><?= ucfirst(@$get_career->title)?></h2>
                        <p><?= ucfirst($get_career->description)?></p>
                    </div>
                </div>
                <div class="col-lg-5 column">
                    <div class="bs-thumb">
                        <?php if(!empty($get_career->image) && file_exists('uploads/career/'.$get_career->image)){?>
                        <img src="<?= base_url('uploads/career/'.$get_career->image)?>" alt="" />
                        <?php } else{ ?>
                        <img src="<?= base_url('uploads/no_image.png')?>" alt="" />
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
.blog-single {float: left;width: 85%;display: inline-block;margin-left: 75px;}
@media only screen and (max-width: 768px) {
    .blog-single {
        padding: 0 20px 0 20px !important;
        margin-left: 0px !important;
        width: 100% !important;
    }
    .col-lg-4 {
        padding-left: 60px !important;
        padding-right: 60px !important;
    }
}
</style>