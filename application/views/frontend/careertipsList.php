<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<style>
.layer.color::before {background-color: #c34e106b !important;}
</style>
<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Career Tips</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="block Career">
        <div data-velocity="-.1" style="background: #F9FAFC" class="parallax scrolly-invisible no-parallax"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-sec">
                        <div class="row">
                            <?php if(!empty($getcareer)){ 
                            foreach($getcareer as $career){
                            if(strlen($career->description)>100) {
                                $desc=substr($career->description,0,100).'...';
                            } else {
                                $desc=$career->description;
                            }
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="my-blog">
                                    <div class="blog-thumb">
                                        <a href="<?= base_url('career-tips/'.$career->slug)?>" title="">
                                            <?php if(!empty($career->image)&& file_exists('uploads/career/'.$career->image)){?>
                                            <img src="<?=base_url('uploads/career/'.$career->image); ?>" alt="" />
                                            <?php } else{?>
                                            <img src="<?=base_url(); ?>assets/images/resource/b1.jpg" alt="" />
                                            <?php } ?>
                                        </a>
                                        <div class="blog-metas">
                                            <a href="javascript:void(0)"
                                                title=""><?= date('M d,Y',strtotime($career->tipsdate))?></a>
                                            <a href="javascript:void(0)" title="">0 Comments</a>
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h3><a href="<?= base_url('career-tips/'.$career->slug)?>" title=""><?= ucfirst($career->title)?></a></h3>
                                        <div><?= ucfirst(strip_tags($desc))?></div>
                                        <a href="<?= base_url('career-tips/'.$career->slug)?>" title=""><span>Read More</span></a>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
@media only screen and (max-width: 767px) {
    .col-lg-4 {
        padding-left: 60px !important;
        padding-right: 60px !important;
    }
}
</style>