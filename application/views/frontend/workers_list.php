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
                        <h3>Explore Talent</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max_height">
    <div class="block no-padding List_Of_Workers Employees_Search_List">
        <div class="container">
            <div class="row no-gape">
                <aside class="col-lg-3 column border-right Employees_Search_Panel">
                    <div class="Employees_Search_Panel_Data">
                        <form method="post" id="filter_form">
                            <div class="widget">
                                <div class="search_widget_job">
                                    <div class="field_w_search">
                                        <input type="text" id="title_keyword" name="title_keyword" placeholder="Search Keywords"/>
                                        <i class="la la-search"></i>
                                    </div>
                                    <div class="field_w_search">
                                        <input type="text" name="search_location" id="location" placeholder="All Locations" onchange="filter_job();" value="" autocomplete="off"/>
                                        <i class="la la-map-marker"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="widget">
                                <h3 class="sb-title closed">Specializations</h3>
                                <div class="specialism_widget">
                                    <div class="dropdown-field">
                                        <select id="example" class="example" name="specialist" multiple>
                                            <option value="">Choose Specializations</option>
                                            <?php if(!empty($get_specialist)){
                                            foreach ($get_specialist as $key) {?>
                                            <option value="<?= $key->specialist_name?>"><?= $key->specialist_name?></option>
                                            <?php  } } ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </aside>
                <div class="col-lg-9 column Employees_Search_Result">
                    <div class="padding-left">
                        <div class="emply-resume-sec">
                            <div id="worker_list"></div>
                            <div align="center" id="pagination_link"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
<style>
.jconfirm-content-pane{text-align: center; font-size: 20px;}
/* .jconfirm-buttons{margin-right: 140px; display: inline-block;} */
.jconfirm .jconfirm-box .jconfirm-buttons button.btn-blue {background: linear-gradient(180deg, rgba(249, 80, 30, 1) 0%, rgba(252, 119, 33, 1) 100%) !important;
    color: #fff !important; text-shadow: none; width: 200px; font-size: 14px !important; letter-spacing: 0px; padding: 10px 0 !important; width: 160px; border-radius: 20px; margin-right: 48px !important;}
.jconfirm .jconfirm-box .jconfirm-buttons button.btn-default {border-radius: 20px !important;}
@media screen and (max-width: 425px) and (min-width: 375px) {
    .emply-resume-list {
        box-shadow: 0 0 10px #dddddd !important;
        border: 0 !important;
        border-radius: 0 !important;
        padding: 5px !important;
    }
}
</style>
<script>
$(document).ready(function () {
    filter_data(1);
    //alert('hii'); return false;
    function filter_data(page) {
        var base_url = $("#base_url").val();
        var displayProduct = 5;
        $('#worker_list').html(createSkeleton(displayProduct));
        function createSkeleton(limit) {
            var skeletonHTML = '';
            for (var i = 0; i < limit; i++) {
                skeletonHTML += '<div class="ph-item">';
                skeletonHTML += '<div class="ph-col-4">';
                skeletonHTML += '<div class="ph-picture"></div>';
                skeletonHTML += '</div>';
                skeletonHTML += '<div>';
                skeletonHTML += '<div class="ph-row">';
                skeletonHTML += '<div class="ph-col-12 big"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '</div>';
                skeletonHTML += '</div>';
                skeletonHTML += '</div>';
            }
            return skeletonHTML;
        }
        var action = 'fetch_data';
        var title_keyword = $('#title_keyword').val();
        var location = $('#location').val();
        var specialist = $('#example').val();
        $.ajax({
            url: base_url + "home/workerlist_fetchdata/" + page,
            method: "POST",
            dataType: "JSON",
            data: {
                action: action,
                title_keyword: title_keyword,
                location: location,
                specialist: specialist,
            },
            success: function (data) {
                $('#worker_list').html(data.product_list);
                $('#pagination_link').html(data.pagination_link);
            }
        })
    }

    $(document).on('click', '.pagination li a', function (event) {
        event.preventDefault();
        var page = $(this).data('ci-pagination-page');
        filter_data(page);
    });

    $('#title_keyword').keyup(function () {
        filter_data(1);
    });

    $('#location').on('change', function () {
        filter_data(1);
    });

    $('#example').on('change', function () {
        filter_data(1);
    });
});
$(window).load(function(){
    $(window).resize(function() {
        if (window.innerWidth <= 425) { 
            console.log('inside if');
            $('.emply-resume-list').addClass('col-6');
        } else { 
            console.log('inside else');
            $('.emply-resume-list').removeClass('col-6');
        }
    });
});
function viewProfile() {
    $.confirm({
        title: '',
        content: "Please login to view talent profile",
        buttons: {
            somethingElse: {
                text: 'Go to Login Page',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function() {
                    window.location.replace("<?php echo base_url('/login')?>");
                }
            },
            back: function () {
            },
        }
    });
}
</script>
