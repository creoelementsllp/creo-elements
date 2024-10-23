<?php
$maps = new GoogleMapsAPI($cache);
// İlgili yerde bu değişken dolduruluyor ve onunda altlarında kullanılıyor.
// Sesli rehbere ve bilete sahip duraklar bu dizi de toplanır.
$audioGuides = [];
$tickets    = [];
?>
<!DOCTYPE html>
<html lang="<?= $loc->getUserLang() ?>" data-x="html" data-x-toggle="html-overflow-hidden">
<head>
    <title><?= $loc->getTxt('meta_home_title') ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="alternate" hreflang="<?= $loc->getUserLang() ?>" href="<?= HOME_URL . "/" . $loc->getUserLang() ?>">
    <link rel="canonical" href="<?= HOME_URL . "/" . $loc->getUserLang() ?>">
    <meta name="description" content="<?= $loc->getTxt("meta_home_desc") ?>">
    <meta name="keywords" content="<?= $loc->getTxt("meta_home_keyw") ?>">
    <?php include 'inc/common-head.php'; ?>
    <link rel="stylesheet" href="<?= THEME_URL ?>/assets/css/flatpickr.min.css">
    <link href="<?= THEME_URL ?>/assets/css/select2.min.css" rel="stylesheet">
    <link rel="preload" fetchpriority="high" as="image" href="<?= HOME_URL . $settings->getSetting("home_img") ?>" type="image/jpeg">
</head>
<body>
    <main>
        <?php include 'inc/home-header.php'; ?>
        <section data-anim-wrap class="masthead -type-3 relative z-5 pb-0">
            <div data-anim-child="" class="masthead__bg">
                <img src="<?= HOME_URL . $settings->getSetting("home_img") ?>" alt="Mokan Travel Logo" title="Mokan Travel Logo" data-src="<?= HOME_URL . $settings->getSetting("home_img") ?>" class="js-lazy">
            </div>
            <div class=" container lg:px-0 header-image-text">
                <div class="row justify-center">
                    <div class="col-lg-12 col-10 lg:px-0">
                        <div class="">
                            <h1 class="text-60 lg:text-40 md:text-30 text-white lg:w-full w-1/2">
                                <?= $loc->getTxt("home_top_text") ?>
                            </h1>
                            <!-- <p data-anim-child="slide-up delay-5" class="text-white mt-6 md:mt-10">
                            <?= $loc->getTxt("home_top_alt_text") ?></p> -->
                            <div class="lh-13 text-white text-30 lg:text-18 fw-500 d-flex ">
                                <i class="icon-mokan-mark text-red-1 pt-2 text-24 lg:text-16 lg:pt-4 pr-8"></i>
                                <div class="d-flex flex-column">
                                    <?= $loc->getTxt('bosphorus') ?>
                                    <a href="<?= HOME_URL . '/' . $loc->getUserLang() ?>/tours?tour_stops%5B%5D=54"
                                        class="text-white text-24 lg:text-16 fw-300 hover:text-mokan-2"
                                        style="opacity:0.75;">
                                        <?= $loc->getTxt('more_information') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="masthead__tabs mt-15">
                            <div class="tabs -bookmark js-tabs scroll-auto">
                                <div class="d-flex items-center home-tabs-controls">
                                    <div class="">
                                        <a href="#" title="<?= $loc->getTxt("tour") ?>" class="px-20 py-20 lg:h-50 h-68 fw-600 text-25 text-white tabs__button is-tab-el-active">
                                            <i class="icon-map-mark-3 text-30 mr-10"></i><?= $loc->getTxt("tour") ?>
                                        </a>
                                    </div>
                                    <div class="">
                                        <a href="#" onclick="clickScroll(transfer)" title="<?= $loc->getTxt("transfer") ?>" class="px-20 py-20 lg:h-50 h-68 fw-600 text-25 text-white tabs__button">
                                            <i class="icon-bus-3 text-30 mr-10"></i><?= $loc->getTxt("transfer") ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="layout-pt-sm layout-pb-md" id="tour">
            <div class="container">
                <div class="row g-2 mb-20">
                    <?php
                    $tTCIds = array_column($hTourCats, 'id');
                    foreach ($tabTourCats as $key => $value) {
                        foreach ($hTourCats as $k => $v) {
                            if($value['id'] == $v['id']){
                                $catName    = $v[$loc->getUserLang() . '_category_name'] ?: $v['en_category_name'];
                                echo '<a href="'. HOME_URL . '/' . $loc->getUserLang() . '/'.$allTourPermalink.'/' . permalink($catName) .'"
                                    class="col-4 col-lg-2 hover-unset">
                                    <div class="rounded-8 d-grid pb-10 text-center h-full '.$value['css_color'].'">
                                        <i class="'.$value['icon'].' text-45 mb-5 pt-10" style="color:'.$value['style_color'].';"></i>
                                        <span class="text-16 fw-600 ls-2 lh-16">'.$value['title'].'</span>
                                    </div>
                                </a>';
                                break;

                            }
                        }
                    }
                    ?>
                </div>
                <form method="GET" action="<?= HOME_URL . '/' . $loc->getUserLang() . '/tours' ?>">
                    <div class="tabs__content js-tabs-content home-tabs-content mb-40">
                        <div class="tabs__pane -tab-item-1 is-tab-el-active">
                            <div class="mainSearch bg-white py-20 lg:pt-5 lg:pb-20 rounded-4">
                                <div class="items-center row g-2">
                                    <div class="searchMenu-loc  col-lg-3 col-12">
                                        <div class="select js-multiple-select" data-select-value="<?= $loc->getTxt('all') ?>">
                                            <button type="button" class="select__button js-button">
                                                <div class="d-flex align-items-center">
                                                    <i class="icon-guide text-24 lg:text-16 pr-8"></i>
                                                    <span class="js-button-title text-black"><?= $loc->getTxt('tour_cat') ?></span>
                                                </div>
                                                <i class="icon-chevron-sm-down select_chevron_icon text-gray-2" data-feather="chevron-down"></i>
                                            </button>
                                            <div class="select__dropdown js-dropdown">
                                                <div class="select__options js-options tour-cats">
                                                    <div class="select__options__button multiple-all-select" data-value="<?= $loc->getTxt('all') ?>">
                                                        <div class="form-checkbox pointer-events-none">
                                                            <input type="checkbox" name="tour_stops[]" value="">
                                                            <div class="form-checkbox__mark">
                                                                <div class="form-checkbox__icon icon-check"></div>
                                                            </div>
                                                        </div>
                                                        <span class="ml-10 js-target-title"><?= $loc->getTxt('all') ?></span>
                                                    </div>
                                                    <?php
                                                    foreach ($hTourCats as $key => $value) {
                                                        $catName = $value[$loc->getUserLang() . '_category_name'] ?: $value['en_category_name'];
                                                        echo '<div class="select__options__button other-selects" data-value="' . $catName . '">
                                                            <div class="form-checkbox pointer-events-none">
                                                                <input type="checkbox" name="tour_categories[]" value="' . $value['id'] . '">
                                                                <div class="form-checkbox__mark">
                                                                    <div class="form-checkbox__icon icon-check"></div>
                                                                </div>
                                                            </div>
                                                            <span class="ml-10 js-target-title">' . $catName . '</span>
                                                        </div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="searchMenu-loc col-lg-3 col-12 js-form-dd js-liverSearch">
                                        <div class="select js-multiple-select" data-select-value="<?= $loc->getTxt('all') ?>">
                                            <button type="button" class="select__button js-button">
                                                <div class="d-flex align-items-center">
                                                    <i class="icon-location text-24 lg:text-16 pr-8"></i>
                                                    <span class="js-button-title text-black"><?= $loc->getTxt('place_to_visit') ?></span>
                                                </div>
                                                <!-- <i class="select__icon" data-feather="chevron-down"></i> -->
                                                <i class="icon-chevron-sm-down select_chevron_icon text-gray-2" data-feather="chevron-down"></i>
                                            </button>
                                            <div class="select__dropdown js-dropdown">
                                                <div class="select__options js-options tour-stops">
                                                    <div class="select__options__button multiple-all-select" data-value="<?= $loc->getTxt('all') ?>">
                                                        <div class="form-checkbox pointer-events-none">
                                                            <input type="checkbox" name="tour_stops[]" value="">
                                                            <div class="form-checkbox__mark">
                                                                <div class="form-checkbox__icon icon-check"></div>
                                                            </div>
                                                        </div>
                                                        <span class="ml-10 js-target-title"><?= $loc->getTxt('all') ?></span>
                                                    </div>
                                                    <?php
                                                    $allTourStops  = $main->getAllTourStops();
                                                    foreach ($allTourStops as $key => $value) {
                                                        if ($value['entry_price_status'] == 1) {
                                                            $tickets[] = $value['id'];
                                                        }
                                                        if ($value['audio_guide_status'] == 1) {
                                                            $audioGuides[] = $value['id'];
                                                        }
                                                        $stopName       = $value['trans'][$loc->getUserLangId()]['stop_name'] ?? $value['trans'][1]['stop_name'];
                                                        echo '<div class="select__options__button other-selects" data-value="' . $stopName . '">
                                                            <div class="form-checkbox pointer-events-none">
                                                                <input type="checkbox" name="tour_stops[]" value="' . $value['id'] . '">
                                                                <div class="form-checkbox__mark">
                                                                    <div class="form-checkbox__icon icon-check"></div>
                                                                </div>
                                                            </div>
                                                            <span class="ml-10 js-target-title">' . $stopName . '</span>
                                                        </div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="searchMenu-date col-lg-2 col-12 px-4">
                                        <div data-x-dd-click="searchMenu-date">
                                            <div class="text-15 text-light-1 ls-2 lh-16 p-2 px-15 rounded-8 border-light d-flex align-items-center justify-between" style="min-height:44px;">
                                                <div class="d-flex align-items-center">
                                                    <i class="icon-calendar-2 text-24 lg:text-16 pr-8 text-black"></i>
                                                    <input type="date" name="tour_start_date" class="js-first-date flatpickr1 px-0 text-black">
                                                </div>
                                                <i class="icon-chevron-sm-down select_chevron_icon text-gray-2" data-feather="chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-item col-12 col-lg-4  lg:px-0 mt-lg-auto">
                                        <button type="submit" title="<?= $loc->getTxt("search") ?>" class="w-1/1 m-auto button -dark-1 lg:h-50 h-42 px-50 col-12 rounded-8 bg-mokan-2 uppercase text-white" id="tour_search"><?= $loc->getTxt("search") ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                $homeTourStops = $main->getHomePageTourStops();
                if (!empty($homeTourStops)) {
                    echo '<div data-anim="" class="row y-gap-20 justify-between items-end mb-10">
                            <div class="">
                                <div class="sectionTitle -md">
                                    <h2 class="sectionTitle__title text-center text-mokan-3 text-30 lg:text-24 uppercase fw-600 lg:fw-500">
                                        ' . $loc->getTxt('cultural_routes') . ' </h2>
                                    <p class=" sectionTitle__text mt-5 lg:text-16 text-16 sm:mt-0 text-center">
                                        ' . $loc->getTxt('cultural_routes_alt') . '
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">';

                    foreach ($homeTourStops as $key => $value) {
                        $counter    = $key + 1;
                        $stopName   = $value['trans'][$loc->getUserLangId()]['stop_name'] ?? $value['trans'][1]['stop_name'];
                        $stopImage  = $value['stop_images'][0]['detail_img'] ?? '';
                        $available   = str_replace('{TOUR_COUNT}', $value['total_tour'], $loc->getTxt('available_in_tour'));
                        if ($key == 0) {
                            echo '<div class="col-12 col-lg-6 tour_image_wrapper">
                                    <div class="relative">
                                        <a href="' . HOME_URL . '/' . $loc->getUserLang() . '/tours?tour_stops%5B%5D=' . $value['id'] . '">
                                            <img src="' . HOME_URL . $stopImage . '" class="rounded-16 tour_image" alt="'.$stopName.'" title="'.$stopName.'">
                                            <div class="activity_text">
                                                <p class="activity_name lg:text-16 text-26 fw-600 px-5 lh-15">' . $counter . '. ' . $stopName . '</p>
                                                <p class="activity_count lg:text-12 text-16 fw-600 px-5 w-fit">' . $available . '</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
                        } elseif ($key == 1) {
                            echo '<div class="col-6 tour_image_wrapper">
                                    <div class="relative ">
                                        <a href="' . HOME_URL . '/' . $loc->getUserLang() . '/tours?tour_stops%5B%5D=' . $value['id'] . '">
                                            <img src="' . HOME_URL . $stopImage . '" class="rounded-16 tour_image second_image" alt="'.$stopName.'" title="'.$stopName.'">
                                            <div class="activity_text">
                                                <p class="activity_name lg:text-16 text-26 fw-600 px-5 lh-15">' . $counter . '. ' . $stopName . '</p>
                                                <p class="activity_count lg:text-12 text-16 fw-600 px-5 w-fit">' . $available . '</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
                        } elseif ($key == 2) {
                            echo '<div class="col-6 col-lg-3 tour_image_wrapper">
                                    <div class="relative ">
                                        <a href="' . HOME_URL . '/' . $loc->getUserLang() . '/tours?tour_stops%5B%5D=' . $value['id'] . '">
                                            <img src="' . HOME_URL . $stopImage . '" class="rounded-16 tour_image second_image" alt="'.$stopName.'" title="'.$stopName.'">
                                            <div class="activity_text">
                                                <p class="activity_name lg:text-16 text-26 fw-600 px-5 lh-15">' . $counter . '. ' . $stopName . '</p>
                                                <p class="activity_count lg:text-12 text-16 fw-600 px-5 w-fit">' . $available . '</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
                        } elseif ($key == 3) {
                            echo '<div class="col-12 col-lg-3 tour_image_wrapper">
                                    <div class="relative ">
                                        <a href="' . HOME_URL . '/' . $loc->getUserLang() . '/tours?tour_stops%5B%5D=' . $value['id'] . '">
                                            <img src="' . HOME_URL . $stopImage . '" class="rounded-16 tour_image" alt="'.$stopName.'" title="'.$stopName.'">
                                            <div class="activity_text">
                                                <p class="activity_name lg:text-16 text-26 fw-600 px-5 lh-15">' . $counter . '. ' . $stopName . '</p>
                                                <p class="activity_count lg:text-12 text-16 fw-600 px-5 w-fit">' . $available . '</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
                        } elseif ($key == 4) {
                            echo '<div class="col-6 col-lg-3 tour_image_wrapper">
                                    <div class="relative ">
                                        <a href="' . HOME_URL . '/' . $loc->getUserLang() . '/tours?tour_stops%5B%5D=' . $value['id'] . '">
                                            <img src="' . HOME_URL . $stopImage . '" class="rounded-16 tour_image second_image" alt="'.$stopName.'" title="'.$stopName.'">
                                            <div class="activity_text">
                                                <p class="activity_name lg:text-16 text-26 fw-600 px-5 lh-15">' . $counter . '. ' . $stopName . '</p>
                                                <p class="activity_count lg:text-12 text-16 fw-600 px-5 w-fit">' . $available . '</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
                        } elseif ($key == 5) {
                            echo '<div class="col-6 col-lg-3 tour_image_wrapper">
                                    <div class="relative ">
                                        <a href="' . HOME_URL . '/' . $loc->getUserLang() . '/tours?tour_stops%5B%5D=' . $value['id'] . '">
                                            <img src="' . HOME_URL . $stopImage . '" class="rounded-16 tour_image second_image" alt="'.$stopName.'" title="'.$stopName.'">
                                            <div class="activity_text">
                                                <p class="activity_name lg:text-16 text-26 fw-600 px-5 lh-15">' . $counter . '. ' . $stopName . '</p>
                                                <p class="activity_count lg:text-12 text-16 fw-600 px-5 w-fit">' . $available . '</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
                        }
                    }
                    echo '</div>';
                }
                ?>
                <div data-anim="slide-up delay-1" class="row y-gap-20 justify-between items-end pt-40">
                    <div class="">
                        <div class="sectionTitle -md">
                            <h2 class="sectionTitle__title text-center text-mokan-3 text-30 lg:text-24 uppercase fw-600 lg:fw-500">
                                <?= $loc->getTxt("popular_tours") ?>
                            </h2>
                            <p class="sectionTitle__text mt-5 lg:text-16 text-16 sm:mt-0 text-center">
                                <?= $loc->getTxt("popular_alt_text") ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div data-anim="slide-up delay-2" class="relative pt-40 sm:pt-20 js-section-slider" data-gap="30" data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1">
                    <div class="swiper-wrapper">
                        <?php
                        $popularTours = $main->getPopularTours();
                        foreach ($popularTours as $key => $value) {
                            $tourName = $value['trans'][$loc->getUserLangId()]['tour_name'] ?? $value['trans'][1]['tour_name'];
                            echo '<div class="swiper-slide">
                            <a href="' . HOME_URL . "/" . $loc->getUserLang() . "/tour-detail/" . permalink($tourName) . "/" . $value['id'] . '" class="citiesCard -type-1 d-block rounded-4 ">
                                <div class="citiesCard__image ratio ratio-3:4">
                                    <img src="' . HOME_URL . $value['popular_img'] . '" data-src="' . HOME_URL . $value['popular_img'] . '" alt="'.$tourName.'" title="'.$tourName.'" class="js-lazy">
                                </div>
                                <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                                    <div class="citiesCard__bg"></div>
                                    <div class="citiesCard__top">
                                        <div class="text-14 text-white"></div>
                                    </div>
                                    <div class="citiesCard__bottom">
                                        <h4 class="text-16 tour_slider_text md:text-20 lh-13 text-white mb-20">' . $tourName . '</h4>
                                        <button class="button col-12 h-60 -mokan-2 bg-white text-dark-1">' . $loc->getTxt("discover") . '</button>
                                    </div>
                                </div>
                            </a>
                        </div>';
                            if ($key >= 5) {
                                break;
                            }
                        }
                        ?>
                    </div>
                    <button class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-prev">
                        <i class="icon icon-chevron-left text-12"></i>
                    </button>
                    <button class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-next">
                        <i class="icon icon-chevron-right text-12"></i>
                    </button>
                    <div class="section-slider-pagination blog-pagination pagination -dots mt-20 justify-content-center">
                    </div>
                </div>
            </div>
        </section>
        <?php
        $banners = new BannerSettings($db);
        $banners->setBanner();
        if ($banners->getBanner("banner_1_show") == 1 || $banners->getBanner("banner_2_show") == 1) { ?>
        <section class="layout-pt-md layout-pb-md bg-light-3">
            <div class="container">
                <div class="row y-gap-20">
                    <?php
                        if ($banners->getBanner("banner_1_show") == 1) {
                            echo '<div class="col-md-6">
                            <div class="ctaCard -type-1 rounded-4 ">
                                <div class="ctaCard__image ratio ratio-63:55">
                                    <img class="img-ratio js-lazy" src="#" data-src="' . HOME_URL . $banners->getBanner("banner_1_img") . '" alt="' . $banners->getBanner("banner_1_title_alt_" . $loc->getUserLang()) . '">
                                </div>
                                <div class="ctaCard__content py-70 px-70 lg:py-30 lg:px-30">
                                    <div class="text-15 fw-500 text-white mb-10">' . $banners->getBanner("banner_1_title_alt_" . $loc->getUserLang()) . '</div>
                                    <h4 class="text-40 lg:text-26 text-white">' . $banners->getBanner("banner_1_title_" . $loc->getUserLang()) . '</h4>
                                    <div class="d-inline-block mt-30">
                                        <a href="' . $banners->getBanner("banner_1_url_" . $loc->getUserLang()) . '" class="button px-48 py-15 -blue-1 -min-180 bg-white text-dark-1">' . $loc->getTxt("more") . '</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                        if ($banners->getBanner("banner_2_show") == 1) {
                            echo '<div class="col-md-6">
                            <div class="ctaCard -type-1 rounded-4 ">
                                <div class="ctaCard__image ratio ratio-63:55">
                                    <img class="img-ratio js-lazy" src="#" data-src="' . HOME_URL . $banners->getBanner("banner_2_img") . '" alt="' . $banners->getBanner("banner_2_title_alt_" . $loc->getUserLang()) . '">
                                </div>
                                <div class="ctaCard__content py-70 px-70 lg:py-30 lg:px-30">
                                    <div class="text-15 fw-500 text-white mb-10">' . $banners->getBanner("banner_2_title_alt_" . $loc->getUserLang()) . '</div>
                                    <h4 class="text-40 lg:text-26 text-white">' . $banners->getBanner("banner_2_title_" . $loc->getUserLang()) . '</h4>
                                    <div class="d-inline-block mt-30">
                                        <a href="' . $banners->getBanner("banner_2_url_" . $loc->getUserLang()) . '" class="button px-48 py-15 -blue-1 -min-180 bg-white text-dark-1">' . $loc->getTxt("more") . '</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                        ?>
                </div>
            </div>
        </section>
        <?php }
        ?>
        <section class="layout-pt-md" id="transfer">
            <div class="container mb-40">
                <div class="tabs js-tabs tab-to-switch">
                    <div class="tabs__controls row x-gap-10 justify-center js-tabs-controls mb-20">
                        <div class="col-auto m-1">
                            <button class="tabs__button tabs__button__red text-30 lg:text-24 fw-500 px-40 lg:px-20 py-10 lg:py-5 rounded-4 uppercase js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-transfer-1" id="transfer-tab-button"><?= $loc->getTxt("transfer") ?></button>
                        </div>
                        <div class="col-auto m-1">
                            <button class="tabs__button tabs__button__red text-30 lg:text-24 fw-500 px-40 lg:px-20 py-10 lg:py-5 rounded-4 uppercase js-tabs-button" data-tab-target=".-tab-item-transfer-2" id="rentacar-tab-button">
                                <?= $loc->getTxt('rent_a_car') ?>
                            </button>
                        </div>
                    </div>
                    <div class="tabs__content js-tabs-content">
                        <div class="tabs__pane -tab-item-transfer-1 is-tab-el-active">
                            <div class="row y-gap-20 justify-between items-end">
                                <div class="col-12">
                                    <div class="">
                                        <div class="sectionTitle -md">
                                            <h2 class="sectionTitle__title text-center text-mokan-3 text-30 lg:text-24 uppercase fw-600 lg:fw-500">
                                                <?= $loc->getTxt("home_transfer_text") ?>
                                            </h2>
                                            <p class=" sectionTitle__text mt-5 lg:text-16 text-16 sm:mt-0 text-center">
                                                <?= $loc->getTxt("home_transfer_text_alt") ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 text-white rounded-16 transfer_form relative">
                                <div class="d-flex justify-between col-12 border_transfer pb-10 mb-10">
                                    <div class="d-flex items-center fw-600">
                                        <i class="icon-map-mark-3 text-30"></i>
                                        <span class="text-24 ml-5"><?= $loc->getTxt('transfer') ?></span>
                                    </div>
                                    <div class="d-flex items-end">
                                        <img src="<?= THEME_URL ?>/assets/svg/default-svg.svg" class="h-34" alt="<?= $loc->getTxt('transfer') ?>" title="<?= $loc->getTxt('transfer') ?>">
                                    </div>
                                </div>
                                <form id="search_transfer_form">
                                    <div class=" row container mx-0 px-0 mt-0 g-3 justify-center ">
                                        <div class="row container mx-0 px-0 mt-0 g-3  transfer__form__container">
                                            <div class="searchMenu-loc col-lg-2 col-6 js-form-dd js-liverSearch">
                                                <h4 class=" fw-600 ls-2 lh-16 mb-1 d-flex items-center">
                                                    <i class="icon-mokan-mark text-18 mr-4"></i>
                                                    <span class="text-15"><?= $loc->getTxt('from_where') ?></span>
                                                </h4>
                                                <div data-x-dd-click="searchMenu-loc" class="search-input text-black">
                                                    <input autocomplete="off" type="search" placeholder="<?= $loc->getTxt('select_pickup') ?>" class="bg-white js-search js-dd-focus live-pickup-locations px-8" name="transfer_start_loc" data-type="start" value="<?= $maps->getStartLocationText() ?>">
                                                    <span id="error_transfer_start_loc" class="d-none"><?= $loc->getTxt('select_pickup') ?></span>
                                                </div>
                                                <div class="searchMenu-loc__field text-black shadow-2 js-popup-window d-none mt-0" data-x-dd="searchMenu-loc" data-x-dd-toggle="-is-active">
                                                    <div class="bg-white sm:px-0 sm:py-15 rounded-4">
                                                        <div class="y-gap-5 js-results autocomplate-search-results" data-type="start"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="searchMenu-loc col-lg-2 col-6 js-form-dd js-liverSearch ">
                                                <h4 class=" fw-600 ls-2 lh-16 mb-1 d-flex items-center">
                                                    <i class="icon-mokan-mark text-18 mr-4"></i>
                                                    <span class="text-15"><?= $loc->getTxt('to_where') ?></span>
                                                </h4>
                                                <div data-x-dd-click="searchMenu-loc-2" class="search-input text-black">
                                                    <input autocomplete="off" type="search" placeholder="<?= $loc->getTxt('select_dropoff') ?>" class="bg-white js-search js-dd-focus live-pickup-locations px-8" name="transfer_end_loc" data-type="end" value="<?= $maps->getEndLocationText() ?>">
                                                    <span id="error_transfer_end_loc" class="d-none"><?= $loc->getTxt('select_dropoff') ?></span>
                                                </div>
                                                <div class="searchMenu-loc__field text-black shadow-2 js-popup-window d-none mt-0" data-x-dd="searchMenu-loc-2" data-x-dd-toggle="-is-active">
                                                    <div class="bg-white sm:px-0 sm:py-15 rounded-4">
                                                        <div class="y-gap-5 js-results autocomplate-search-results" data-type="end"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <div class="searchMenu-date lg:px-0">
                                                    <div data-x-dd-click="searchMenu-date">
                                                        <h4 class=" fw-600 ls-2 lh-16 mb-1 d-flex items-center">
                                                            <i class="icon-calendar-2 text-18 mr-4"></i>
                                                            <span class="text-15"><?= $loc->getTxt('date_time') ?></span>
                                                        </h4>
                                                        <div class="d-flex text-15 text-light-1 ls-2 lh-16 bg-white rounded-8 border-light">
                                                            <input type="date" name="transfer_start_datetime" class="js-first-date w-0 h-0 p-0 border-none mt-auto flatpickr2">
                                                            <input type="date" name="transfer_end_datetime" class="js-first-date w-0 h-0 p-0 border-none mt-auto flatpickr3">
                                                            <div class="p-2 d-flex justify-between w-1/1 gap-2" style="padding-left: 5px !important; padding-right:0px !important;">
                                                                <div class="start-date-trigger"></div>
                                                                <div class="start-hours border-light absolute left-0 bg-white w-1/1" style="top:calc(100%);display:none;max-height:160px;overflow:auto;border-radius:10px">
                                                                    <ul></ul>
                                                                </div>
                                                                <div class="end-date-trigger"></div>
                                                                <div class="end-hours border-light absolute left-0 bg-white w-1/1" style="top:calc(100%);display:none;max-height:160px;overflow:auto;border-radius:10px">
                                                                    <ul></ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5 col-lg-2">
                                                <div>
                                                    <h4 class=" fw-600 ls-2 lh-16 mb-1 d-flex items-center">
                                                        <span class="text-15"><?= $loc->getTxt('roundtrip_return') ?></span>
                                                    </h4>
                                                    <label class="form_switch col-12">
                                                        <input type="checkbox" name="round_trip" value="1">
                                                        <span class="form_switch_slider form_switch"></span>
                                                        <div class="switch_bg">
                                                            <i class="icon-reverse form_switch_icon text-30 text-red-1"></i>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-7 col-lg-3">
                                                <div class="searchMenu-guests pr-0 col-12 pl-4 js-form-dd js-form-counters">
                                                    <div data-x-dd-click="searchMenu-guests">
                                                        <h4 class=" fw-600 ls-2 lh-16 mb-1 d-flex items-center">
                                                            <i class="icon-group text-18 mr-4"></i>
                                                            <span class="text-15"><?= $loc->getTxt("number_of_people") ?></span>
                                                        </h4>
                                                        <div class="text-15 text-dark-1 ls-2 lh-16 p-2 rounded-8 border-light bg-white h-44 cut-with-dots" id="transfer_participants">1 <?= $loc->getTxt('adult') ?>
                                                        </div>
                                                    </div>
                                                    <div class="searchMenu-guests__field shadow-2 mt-0 right-0 left-auto text-dark-1" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                                                        <div class="bg-white px-30 py-30 rounded-4">
                                                            <div class="row g-3">
                                                                <div class="d-flex justify-between align-items-center col-12">
                                                                    <div class="lh-14">
                                                                        <div class="fw-500"><?= $loc->getTxt('adult') ?></div>
                                                                        <div class="text-gray-2"><?= $loc->getTxt('above_age') ?></div>
                                                                    </div>
                                                                    <div class="input_number people_counter d-flex align-items-center">
                                                                        <span class="minus text-red-1 text-16 text-gray-2 fw-500 border-light">-</span>
                                                                        <input name="adult" data-type="adult" type="number" data-target="transfer_participants" data-id="adult" class="fw-600 people_count_input" value="<?= $loc->getTransferParticipantAdult() ?>">
                                                                        <span class="plus text-green-2 text-16 text-gray-2 fw-500 border-light">+</span>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-between align-items-center col-12">
                                                                    <div class="lh-14">
                                                                        <div class="fw-500"><?= $loc->getTxt('child') ?></div>
                                                                        <div class="text-gray-2"><?= $loc->getTxt('between_ages') ?></div>
                                                                    </div>
                                                                    <div class="input_number people_counter d-flex align-items-center">
                                                                        <span class="minus text-red-1 text-16 text-gray-2 fw-500 border-light">-</span>
                                                                        <input name="child" data-type="child" type="number" data-target="transfer_participants" data-id="child" class="fw-600 people_count_input" value="<?= $loc->getTransferParticipantChild() ?>">
                                                                        <span class="plus text-green-2 text-16 text-gray-2 fw-500 border-light">+</span>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex justify-between align-items-center col-12">
                                                                    <div class="lh-14">
                                                                        <div class="fw-500"><?= $loc->getTxt('baby') ?></div>
                                                                        <div class="text-gray-2"><?= $loc->getTxt('under_age') ?></div>
                                                                    </div>
                                                                    <div class="input_number people_counter d-flex align-items-center">
                                                                        <span class="minus text-red-1 text-16 text-gray-2 fw-500 border-light">-</span>
                                                                        <input name="baby" data-type="baby" type="number" data-target="transfer_participants" data-id="baby" class="fw-600 people_count_input" value="<?= $loc->getTransferParticipantBaby() ?>">
                                                                        <span class="plus text-green-2 text-16 text-gray-2 fw-500 border-light">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="arac_bul button bg-black text-white px-30 h-42 mb-1">
                                            <i class="icon-search text-20 mr-10"></i><?= $loc->getTxt('find_vehicle') ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tabs__pane -tab-item-transfer-2">
                            <div class="row y-gap-20 justify-between items-end">
                                <div class="col-12">
                                    <div class="">
                                        <div class="sectionTitle -md">
                                            <h2 class="sectionTitle__title text-center text-mokan-3 text-30 lg:text-24 uppercase fw-600 lg:fw-500">
                                                <?= $loc->getTxt("home_rent_a_car_text") ?>
                                            </h2>
                                            <p class=" sectionTitle__text mt-5 lg:text-16 text-16 sm:mt-0 text-center">
                                                <?= $loc->getTxt("home_rent_a_car_text_alt") ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 text-white rounded-16 transfer_form relative">
                                <div class="d-flex justify-between col-12 border_transfer pb-10 mb-10">
                                    <div class="d-flex items-center fw-600">
                                        <i class="icon-icon-driver text-30"></i>
                                        <span class="text-24 ml-5"><?= $loc->getTxt('rent_a_car') ?></span>
                                    </div>
                                    <div class="d-flex items-end">
                                        <img src="<?= THEME_URL ?>/assets/svg/default-svg.svg" class="h-34" alt="<?= $loc->getTxt('rent_a_car') ?>" title="<?= $loc->getTxt('rent_a_car') ?>">
                                    </div>
                                </div>
                                <form id="search_rentacar_form">
                                    <div class="col-12 ">
                                        <div class="row container mx-0 px-0 mt-0 g-3 justify-center transfer__form__container">
                                            <div class="searchMenu-loc col-lg-4 col-6 js-form-dd js-liverSearch">
                                                <h4 class=" fw-600 ls-2 lh-16 mb-1 d-flex items-center">
                                                    <i class="icon-mokan-mark text-18 mr-4"></i>
                                                    <span class="text-15"><?= $loc->getTxt('location') ?></span>
                                                </h4>
                                                <div data-x-dd-click="searchMenu-loc" class="search-input text-black">
                                                    <input autocomplete="off" type="search" placeholder="<?= $loc->getTxt('select_pickup') ?>" class="bg-white js-search js-dd-focus rent-live-pickup-locations px-8" name="rentacar_start_loc" data-type="rent_start" value="<?= $maps->getRentACarStartLocationText() ?>">
                                                    <span id="error_rentacar_start_loc" class="d-none"><?= $loc->getTxt('select_pickup') ?></span>
                                                </div>
                                                <div class="searchMenu-loc__field text-black shadow-2 js-popup-window mt-0 d-none" data-x-dd="searchMenu-loc" data-x-dd-toggle="-is-active">
                                                    <div class="bg-white sm:px-0 sm:py-15 rounded-4">
                                                        <div class="y-gap-5 js-results autocomplate-search-results" data-type="rent_start"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-2">
                                                <div class="searchMenu-date lg:px-0">
                                                    <div data-x-dd-click="searchMenu-date">
                                                        <h4 class=" fw-600 ls-2 lh-16 mb-1 d-flex items-center">
                                                            <i class="icon-calendar-2 text-18 mr-4"></i>
                                                            <span class="text-15"><?= $loc->getTxt('vehicle_selection') ?></span>
                                                        </h4>
                                                        <div class="text-15 text-light-1 ls-2 lh-16 p-2 bg-white rounded-8 border-light">
                                                            <select name="vehicle">
                                                                <?php
                                                                foreach ($hVehicles as $key => $value) {
                                                                    echo '<option value="'.$value['id'].'">' . $value['brand'] . ' ' . $value['model'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-2">
                                                <div class="searchMenu-date lg:px-0">
                                                    <div data-x-dd-click="searchMenu-date">
                                                        <h4 class=" fw-600 ls-2 lh-16 mb-1 d-flex items-center">
                                                            <i class="icon-calendar-2 text-18 mr-4"></i>
                                                            <span class="text-15"><?= $loc->getTxt('date_time') ?></span>
                                                        </h4>
                                                        <div class="d-flex text-15 text-light-1 ls-2 lh-16 bg-white rounded-8 border-light">
                                                            <input type="date" name="rentacar_start_datetime" class="js-first-date w-0 h-0 p-0 border-none mt-auto flatpickr4">
                                                            <div class="p-2 d-flex justify-between w-1/1 gap-2" style="padding-left: 5px !important; padding-right:0px !important;">
                                                                <div class="rent-start-date-trigger"></div>
                                                                <div class="rent-start-hours border-light absolute left-0 bg-white w-1/1" style="top:calc(100%);display:none;max-height:160px;overflow:auto;border-radius:10px;z-index:1;">
                                                                    <ul></ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-2">
                                                <div class="searchMenu-date lg:px-0">
                                                    <div data-x-dd-click="searchMenu-date">
                                                        <h4 class=" fw-600 ls-2 lh-16 mb-1 d-flex items-center">
                                                            <i class="icon-calendar-2 text-18 mr-4"></i>
                                                            <span class="text-15"><?= $loc->getTxt('duration') ?></span>
                                                        </h4>
                                                        <div class="text-15 text-light-1 ls-2 lh-16 p-2 bg-white rounded-8 border-light">
                                                            <select name="rental_period">
                                                                <?php
                                                                for ($i = 4; $i <= 12; $i++) {
                                                                    echo '<option value="'.$i.'">' . $i . ' ' . $loc->getTxt('hour') . '</option>';
                                                                }
                                                                for ($i = 1; $i <= 15; $i++) {
                                                                    echo '<option value="'.($i * 24).'">' . $i . ' ' . $loc->getTxt('day') . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-2">
                                                <div class="searchMenu-guests pr-0 col-12 pl-4 js-form-dd js-form-counters">
                                                    <div data-x-dd-click="searchMenu-guests">
                                                        <h4 class=" fw-600 ls-2 lh-16 mb-1 d-flex items-center">
                                                            <i class="icon-group text-18 mr-4"></i>
                                                            <span class="text-15"><?= $loc->getTxt("number_of_people") ?></span>
                                                        </h4>
                                                        <div class="text-15 text-dark-1 ls-2 lh-16 p-2 rounded-8 border-light bg-white h-44p cut-with-dots"
                                                            id="rent_a_car_participants">1 <?= $loc->getTxt('adult') ?>
                                                        </div>
                                                    </div>
                                                    <div class="searchMenu-guests__field shadow-2 mt-0 right-0 left-auto text-dark-1" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                                                        <div class="bg-white px-30 py-30 rounded-4">
                                                            <div class="row g-3">
                                                                <div class="d-flex justify-between align-items-center col-12">
                                                                    <div class="lh-14">
                                                                        <div class="fw-500"><?= $loc->getTxt('adult') ?>
                                                                        </div>
                                                                        <div class="text-gray-2">
                                                                            <?= $loc->getTxt('above_age') ?></div>
                                                                    </div>
                                                                    <div class="input_number people_counter d-flex align-items-center">
                                                                        <span class="minus text-red-1 text-16 text-gray-2 fw-500 border-light">-</span>
                                                                        <input name="adult" data-type="adult" type="number" data-target="rent_a_car_participants" data-id="adult"
                                                                            class="fw-600 people_count_input" value="1">
                                                                        <span class="plus text-green-2 text-16 text-gray-2 fw-500 border-light">+</span>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex justify-between align-items-center col-12">
                                                                    <div class="lh-14">
                                                                        <div class="fw-500"><?= $loc->getTxt('child') ?></div>
                                                                        <div class="text-gray-2"><?= $loc->getTxt('between_ages') ?></div>
                                                                    </div>
                                                                    <div class="input_number people_counter d-flex align-items-center">
                                                                        <span class="minus text-red-1 text-16 text-gray-2 fw-500 border-light">-</span>
                                                                        <input name="child" data-type="child" type="number" data-target="rent_a_car_participants" data-id="child"
                                                                            class="fw-600 people_count_input" value="0">
                                                                        <span class="plus text-green-2 text-16 text-gray-2 fw-500 border-light">+</span>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex justify-between align-items-center col-12">
                                                                    <div class="lh-14">
                                                                        <div class="fw-500"><?= $loc->getTxt('baby') ?></div>
                                                                        <div class="text-gray-2"><?= $loc->getTxt('under_age') ?></div>
                                                                    </div>
                                                                    <div class="input_number people_counter d-flex align-items-center">
                                                                        <span class="minus text-red-1 text-16 text-gray-2 fw-500 border-light">-</span>
                                                                        <input name="baby" data-type="baby" type="number" data-target="rent_a_car_participants" data-id="baby" class="fw-600 people_count_input" value="0">
                                                                        <span class="plus text-green-2 text-16 text-gray-2 fw-500 border-light">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="arac_bul button bg-black text-white px-30 h-42 mb-1">
                                                <i class="icon-search text-20 mr-10"></i><?= $loc->getTxt('find_vehicle') ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" id="transfer_search_div">
                <div class="row y-gap-20 justify-between items-end d-none" id="transfer_search">
                    <div class="col-12 py-0">
                        <hr class="lg:d-block">
                        <div class="">
                            <div class="sectionTitle -md">
                                <h2 class="sectionTitle__title lg:text-left lg:text-black text-center text-mokan-3 text-center text-30 lg:text-24 uppercase fw-600 lg:fw-500">
                                    <?= $loc->getTxt('search_result') ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row y-gap-10 pt-20 sm:pt-20 d-flex">
                    <div data-anim="slide-up delay-2" class="relative sm:pt-20 js-section-slider mb-20" data-gap="30" data-pagination="blog-pagination10" data-slider-cols="base-1" data-slides-per-view="xl-2 lg-2 md-1 sm-1 base-2" data-grid-rows="xl-3 lg-2 md-1 sm-1 base-3">
                        <div class="swiper-wrapper h-fit">
                            <div class="swiper-slide h-fit">
                                <div class="row g-3" id="transfer_search_result"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" id="rentacar_search_div">
                <div class="row y-gap-20 justify-between items-end d-none" id="rentacar_search">
                    <div class="col-12 py-0">
                        <hr class="lg:d-block">
                        <div class="">
                            <div class="sectionTitle -md">
                                <h2 class="sectionTitle__title lg:text-left lg:text-black text-center text-mokan-3 text-center text-30 lg:text-24 uppercase fw-600 lg:fw-500">
                                    <?= $loc->getTxt('search_result') ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row y-gap-10 pt-20 sm:pt-20 d-flex">
                    <div data-anim="slide-up delay-2" class="relative sm:pt-20 js-section-slider mb-20" data-gap="30" data-pagination="blog-pagination10" data-slider-cols="base-1" data-slides-per-view="xl-2 lg-2 md-1 sm-1 base-2" data-grid-rows="xl-3 lg-2 md-1 sm-1 base-3">
                        <div class="swiper-wrapper h-fit">
                            <div class="swiper-slide h-fit">
                                <div class="row g-3" id="rentacar_search_result"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row y-gap-20 justify-between items-end">
                    <div class="col-12 py-0">
                        <hr class="lg:d-block d-none">
                        <div class="">
                            <div class="sectionTitle -md">
                                <h2 class="sectionTitle__title lg:text-left lg:text-black text-center text-mokan-3 text-center text-30 lg:text-24 uppercase fw-600 lg:fw-500">
                                    <?= $loc->getTxt('popular_locations') ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row y-gap-10 pt-20 sm:pt-20 d-flex lg:d-none">
                    <div data-anim="slide-up delay-2" class="relative pt-40 sm:pt-20 js-section-slider mb-20" data-gap="30" data-pagination="blog-pagination10" data-slider-cols="base-1" data-slides-per-view="xl-2 lg-2 md-1 sm-1 base-2" data-grid-rows="xl-3 lg-2 md-1 sm-1 base-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="row g-3">
                                    <?php
                                    $quickTransfers = $main->getQuickTransfers();
                                    foreach ($quickTransfers as $k => $v) {
                                        echo '<div class="col-12 pt-0 col-lg-6">
                                            <div class="px-20 py-10 rounded-4 border-light">
                                                <div class="y-gap-10 justify-between xl:justify- vehicle-transport">
                                                    <div class="first-divider d-flex lg:justify-between">
                                                        <div class="col-auto">
                                                            <span class="d-block text-15 fw-500">'.$v['vehicle_name'] . ' '  . $v['vehicle_model']. '</span>
                                                            <img class="d-block mw-100px" src="'.$v['vehicle_img'].'" alt="'.$v['vehicle_name'] . ' '  . $v['vehicle_model']. '" title="'.$v['vehicle_name'] . ' '  . $v['vehicle_model']. '">
                                                            <span class="text-13">'.$loc->getTxt('or_similar').'</span>
                                                        </div>
                                                        <div class="col-auto lg:ml-0 ml-40 d-flex y-gap-10 flex-column align-self-center">
                                                            <div class="text-16 lh-15 text-light-1 mr-20 "><i class="icon-user-2 text-20 pr-10 text-red-1"></i>1 - 5</div>
                                                            <div class="text-16 lh-15 text-light-1 mr-20 "><i class="icon-luggage text-20 pr-10 text-red-1"></i>5</div>
                                                        </div>
                                                    </div>
                                                    <div class="second-divider">
                                                        <div class="lg:justify-between d-flex flex-column items-end w-fit lg:w-1/1 lg:flex-row float-inline-end lg:pt-10">
                                                            <div class="text-left align-self-start lg:my-auto">
                                                                <div class="lh-15 fw-700 lg:text-24 text-30" ><span class="format-price" data-price="'.$v['price'].'">'.$v['price'].'</span></div>                                                          
                                                            </div>
                                                            <form method="POST" class="quick-transfer-res" action="'. HOME_URL . '/' . $loc->getUserLang() . '/checkout">
                                                            <input type="text" name="start_location" value="'.$v['start_location'].'" hidden>
                                                            <input type="text" name="end_location" value="'.$v['end_location'].'" hidden>
                                                            <input type="text" name="checkout_type" value="'.$v['checkout_type'].'" hidden>
                                                            <input type="text" name="token" value="'.$v['token'].'" hidden>
                                                            <input type="number" name="vehicle_id" value="'.$v['vehicle_id'].'" hidden>
                                                            <input type="text" name="transfer_start_datetime" value="'.$v['transfer_start_datetime'].'" hidden>
                                                            <input type="text" name="transfer_end_datetime" value="'.$v['transfer_end_datetime'].'" hidden>
                                                            <input type="number" name="round_trip" value="'.$v['round_trip'].'" hidden>
                                                            <input type="number" name="adult" value="'.$v['adult'].'" hidden>
                                                            <input type="number" name="child" value="'.$v['child'].'" hidden>
                                                            <input type="number" name="baby" value="'.$v['baby'].'" hidden>
                                                            <input type="number" name="popular_transfer" value="1" hidden>
                                                            <button type="submit" data-id="'.$v['vehicle_id'].'" class="button bg-red-1 px-30 h-50 text-white text-20 w-fit">
                                                                '.$loc->getTxt('reservation').'
                                                            </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="row mx-0 third-divider pb-0">
                                                        <hr class="lg:d-block d-none">
                                                        <div class="col-auto  d-none lg:d-block p-0 my-3 my-lg-0">
                                                            <div class="flightLine">
                                                                <div></div>
                                                                <div></div>
                                                            </div>
                                                        </div>
                                                        <div class="row col-12 lg:pl-30">
                                                            <div class="col-lg-auto col-12 px-0">
                                                                <div class="text-15 lh-15 text-light-1">'.$loc->getTxt('pickup_location').'</div>
                                                                <div class="lh-15 fw-500">'.$v['start_loc_text'].'</div>
                                                            </div>
                                                            <div class="col text-center px-3 lg:py-35 lg:my-2 lg:px-0 lg:pt-0 pt-10">
                                                                <div class="col-lg-auto col-12 flightLine d-block lg:d-none">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                                <div class="d-flex flex-row justify-content-center lg:justify-start lg:pt-0 pt-10">
                                                                    <div class="text-15 lh-15 text-light-1 mr-20"><i class="icon-clock pr-4 text-gray"></i>'.$v['duration'].' '.$loc->getTxt('minute').' -
                                                                        <i class="icon-route-mark pr-4 text-gray"></i>'.ceil($v['distance']).' KM
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-auto col-12 px-0">
                                                                <div class="text-15 lh-15 text-light-1">
                                                                    '.$loc->getTxt('drop_location').'</div>
                                                                <div class="lh-15 fw-500">'.$v['end_loc_text'].'</div>
                                                            </div>
                                                        </div>
                                                        <hr class="mb-0 mt-3">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row y-gap-10 pt-20 sm:pt-20 d-none lg:d-block">
                    <div data-anim="slide-up delay-2" class="relative pt-40 sm:pt-20 js-section-slider mb-20" data-gap="30" data-pagination="blog-pagination11" data-slider-cols="base-1" data-slides-per-view="xl-2 lg-2 md-1 sm-1 base-2" data-grid-rows="xl-3 lg-2 md-1 sm-1 base-3">
                        <div class="swiper-wrapper">
                        <?php
                            $quickTransfers = $main->getQuickTransfers();
                            foreach ($quickTransfers as $k => $v) {
                                echo '<div class="swiper-slide">
                                        <div class="col-12 pt-0 col-lg-6">
                                            <div class="px-20 py-10 rounded-4 border-light">
                                                <div class="y-gap-10 justify-between xl:justify- vehicle-transport">
                                                    <div class="first-divider d-flex lg:justify-between">
                                                        <div class="col-auto">
                                                            <span class="d-block text-15 fw-500">'.$v['vehicle_name'] . ' ' . $v['vehicle_model'] .'</span>
                                                            <img class="d-block mw-100px" src="'.$v['vehicle_img'].'" alt="'.$v['vehicle_name'] . ' '  . $v['vehicle_model']. '" title="'.$v['vehicle_name'] . ' '  . $v['vehicle_model']. '">
                                                            <span class="text-13">'.$loc->getTxt('or_similar').'</span>
                                                        </div>
                                                        <div
                                                            class="col-auto lg:ml-0 ml-40 d-flex y-gap-10 flex-column align-self-center">
                                                            <div class="text-16 lh-15 text-light-1 mr-20 "><i
                                                                    class="icon-user-2 text-20 pr-10 text-red-1"></i>1 - 5
                                                            </div>
                                                            <div class="text-16 lh-15 text-light-1 mr-20 "><i
                                                                    class="icon-luggage text-20 pr-10 text-red-1"></i>5
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="second-divider">
                                                        <div
                                                            class="lg:justify-between d-flex flex-column items-end w-fit lg:w-1/1 lg:flex-row float-inline-end lg:pt-10">
                                                            <div class="text-left align-self-start lg:my-auto">
                                                                <div class="lh-15 fw-700 lg:text-24 text-30">
                                                                    <span class="format-price" data-price="'.$v['price'].'">'.$v['price'].'</span>
                                                                </div>
                                                            </div>
                                                            <form method="POST" class="quick-transfer-res" action="'. HOME_URL . '/' . $loc->getUserLang() . '/checkout">
                                                            <input type="text" name="start_location" value="'.$v['start_location'].'" hidden>
                                                            <input type="text" name="end_location" value="'.$v['end_location'].'" hidden>
                                                            <input type="text" name="checkout_type" value="'.$v['checkout_type'].'" hidden>
                                                            <input type="text" name="token" value="'.$v['token'].'" hidden>
                                                            <input type="number" name="vehicle_id" value="'.$v['vehicle_id'].'" hidden>
                                                            <input type="text" name="transfer_start_datetime" value="'.$v['transfer_start_datetime'].'" hidden>
                                                            <input type="text" name="transfer_end_datetime" value="'.$v['transfer_end_datetime'].'" hidden>
                                                            <input type="number" name="round_trip" value="'.$v['round_trip'].'" hidden>
                                                            <input type="number" name="adult" value="'.$v['adult'].'" hidden>
                                                            <input type="number" name="child" value="'.$v['child'].'" hidden>
                                                            <input type="number" name="baby" value="'.$v['baby'].'" hidden>
                                                            <input type="number" name="popular_transfer" value="1" hidden>
                                                            <button type="submit" data-id="'.$v['vehicle_id'].'" class="button bg-red-1 px-30 h-50 text-white text-20 w-fit">
                                                                '.$loc->getTxt('reservation').'
                                                            </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="row mx-0 third-divider pb-0">
                                                        <hr class="lg:d-block d-none">
                                                        <div class="col-auto  d-none lg:d-block p-0 my-3 my-lg-0">
                                                            <div class="flightLine">
                                                                <div></div>
                                                                <div></div>
                                                            </div>
                                                        </div>
                                                        <div class="row col-12 lg:pl-30">
                                                            <div class=" col-lg-auto col-12 px-0">
                                                                <div class="text-15 lh-15 text-light-1">
                                                                    '. $loc->getTxt("pickup_location") .'</div>
                                                                <div class="lh-15 fw-500">
                                                                    '.$v['start_loc_text'].'
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col text-center px-3 lg:py-35 lg:my-2 lg:px-0 lg:pt-0 pt-10">
                                                                <div class="col-lg-auto col-12 flightLine d-block lg:d-none">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                                <div
                                                                    class="d-flex flex-row justify-content-center lg:justify-start lg:pt-0 pt-10">
                                                                    <div class="text-15 lh-15 text-light-1 mr-20"><i
                                                                            class="icon-clock pr-4 text-gray"></i>'.$v['duration'].' '.$loc->getTxt('minute').'
                                                                        <i class="icon-route-mark pr-4 text-gray"></i>'.ceil($v['distance']).' KM
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-auto col-12 px-0">
                                                                <div class="text-15 lh-15 text-light-1">
                                                                    '. $loc->getTxt("drop_location") .'</div>
                                                                <div class="lh-15 fw-500">'.$v['end_loc_text'].'</div>
                                                            </div>
                                                        </div>
                                                        <hr class="mb-0 mt-3">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-slider-pagination blog-pagination10 pagination lg:d-none d-flex -dots mt-20 justify-content-center"></div>
            <div class="section-slider-pagination blog-pagination11 pagination lg:d-flex d-none -dots mt-20 justify-content-center"></div>
        </section>
        <section class="layout-pt-md layout-pb-lg p-5 m-0" id="food">
            <div class="container">
                <div class="tabs js-tabs tab-to-switch">
                    <div class="col-auto mb-40">
                        <div class="tabs__controls row x-gap-10 justify-center js-tabs-controls">
                            <div class="col-auto m-1">
                                <button class="tabs__button tabs__button__red text-30 lg:text-24 fw-500 px-40 lg:px-20 py-10 lg:py-5 rounded-4 uppercase js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1" id="tour-tab-button"><?= $loc->getTxt("tours") ?></button>
                            </div>
                            <div class="col-auto m-1">
                                <button class="tabs__button tabs__button__red text-30 lg:text-24 fw-500 px-40 lg:px-20 py-10 lg:py-5 rounded-4 uppercase js-tabs-button" data-tab-target=".-tab-item-2" id="food-tab-button">
                                    <?= $loc->getTxt('food') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row y-gap-20 justify-between items-end">
                        <div class="col-12">
                            <div class="">
                                <div class="sectionTitle -md">
                                    <h2 class="sectionTitle__title text-center text-mokan-3 text-30 lg:text-24 uppercase fw-600 lg:fw-500">
                                        <?= $loc->getTxt("recommended") ?>
                                    </h2>
                                    <p class=" sectionTitle__text mt-5 lg:text-16 text-16 sm:mt-0 text-center">
                                        <?= $loc->getTxt("recommended_services") ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabs__content js-tabs-content">
                        <div class="tabs__pane -tab-item-1 is-tab-el-active">
                            <div class="">
                                <div data-anim="slide-up delay-2" class="relative pt-40 sm:pt-20 js-section-slider" data-gap="30" data-scrollbar data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-pagination="blog-pagination2">
                                    <div class="swiper-wrapper">
                                        <?php
                                        $recTours = $main->getTours(['recommended' => true], 4);
                                        foreach ($recTours as $key => $value) {
                                            $tourName = $value['trans'][$loc->getUserLangId()]['tour_name'] ?? $value['trans'][1]['tour_name'];
                                            $tourListImages = $main->getTourListImages($value['id']);
                                            $priceList = $main->getTourPrices($value['id']);
                                            $minP      = $priceList[0]['min_person'];
                                            $maxP      = $priceList[0]['max_person'];
                                            $price     = $priceList[0]['price'] ?? 999;
                                            $listPrice = $price + ($price / 100 * $value['list_price']);
                                            $price     = $loc->formatMoney($loc->convertPrice($price));
                                            $listPrice = $loc->formatMoney($listPrice);
                                            $tourStopIds = $main->getTourStopsIdsByTourId($value['id']);
                                            $catName    = $main->getTourCategoriesByTourId($value['id']);
                                            $catName    = $catName[$loc->getUserLang() . '_category_name'] ?? $catName['en_category_name'];

                                            $attrHTML = '';
                                            if ($value['pickup_dropoff'] == 1) {
                                                $attrHTML .= '<li><i class="icon-map-marker text-red-1"></i><span class="text-light-1">' . $loc->getTxt('include_pickup_and_dropoff') . '</span></li>';
                                            }
                                            echo '<div class="swiper-slide h-auto"><div class="relative h-full">
                                                <div class="hotelsCard -type-1 h-full d-flex flex-column hover-unset"><div class="hotelsCard__image relative"><div class="cardImage ratio ratio-1:1">
                                                            <div class="cardImage__content">';
                                            if (count($tourListImages) <= 1) {
                                                echo '<img class="rounded-4 col-12" src="' . HOME_URL . $tourListImages[0] . '" alt="'.$tourName.'" title="'.$tourName.'">';
                                            } else {
                                                echo '<div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                                                                        <div class="swiper-wrapper">';
                                                foreach ($tourListImages as $k => $v) {
                                                    echo '<div class="swiper-slide">
                                                            <img class="col-12" src="' . HOME_URL . $v . '" alt="'.$tourName.'" title="'.$tourName.'">
                                                        </div>';
                                                }
                                                echo '</div>
                                                            <div class="cardImage-slider__pagination js-pagination"></div>
                                                            <div class="cardImage-slider__nav -prev">
                                                                <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 js-prev">
                                                                    <i class="icon-chevron-left text-10"></i>
                                                                </button>
                                                            </div>
                                                            <div class="cardImage-slider__nav -next">
                                                                <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 js-next">
                                                                    <i class="icon-chevron-right text-10"></i>
                                                                </button>
                                                            </div>
                                                        </div>';
                                            }
                                            echo '</div>
                                                        </div>';
                                            foreach ($tourStopIds as $k => $v) {
                                                if (in_array($v, $tickets)) {
                                                    $attrHTML .= '<li><i class="icon-external text-red-1"></i><span class="text-light-1">' . $loc->getTxt('entry_without_waiting') . '</span>';
                                                    break;
                                                }
                                            }
                                            foreach ($tourStopIds as $k => $v) {
                                                if (in_array($v, $audioGuides)) {
                                                    echo '<div class="hotelsCard__audio text-white fw-500 lh-1 d-flex items-center text-18">
                                                                        <i class="icon-headset-2 bg-green-3 ratio-1:1 p-1 rounded-full mr-4"></i> 
                                                                        ' . $loc->getTxt('audio_guide') . '
                                                                    </div>';
                                                    break;
                                                }
                                            }

                                            foreach ($priceList as $k => $v) {
                                                if($v['min_person'] != $v['max_person']){
                                                    $personRange = $v['min_person'] . '-' . $v['max_person'];
                                                }else{
                                                    $personRange = $v['min_person'];
                                                }
                                                break;
                                            }
                                            $personRange = str_replace('{MIN_MAX_PEOPLE}', $personRange, $loc->getTxt('for_x_y_people'));
                                            echo '</div>
                                                    <a href="' . HOME_URL . "/" . $loc->getUserLang() . "/tour-detail/" . permalink($tourName) . "/" . $value['id'] . '">
                                                    <div class="hotelsCard__content flex-fill  px-10 py-10 pt-15 border-light border-top-none">
                                                        <p class="lh-15 text-18 text-light-1">' . $catName . '</p>
                                                        <h4 class="hotelsCard__title text-dark-1 text-24 lh-1 fw-600 pb-5 hover:text-mokan-2">
                                                            <span>' . $tourName . '</span>
                                                        </h4>
                                                        <ul class="text-14  lh-17 mb-10">
                                                            ' . $attrHTML . '
                                                        </ul>
                                                        <ul class=" lh-1">
                                                            <li class="text-light-1 text-14">
                                                                <span class="text-green-2 text-16 fw-700">
                                                                    <i class="icon-group"></i> '.$personRange.'<br/>
                                                                    <span class="text-red-1 text-20 fw-700">' . $loc->getCurrencySymbol() . $price . '</span>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                   <div class="hotelsCard__duration">
                                                        <div class="hotelsCard__duration_relative">
                                                            <p class="lh-1 text-14 text-white">+' . $value['duration'] . ' ' . $loc->getTxt('hour') . '</p>
                                                        </div>
                                                    </div>
                                                    <div class="hotelsCard__badge rounded-4 fw-500 bg-black text-yellow-1 p-1 text-13 lh-1 uppercase">
                                                        <i class="icon-star text-13"></i> ' . $loc->getTxt('featured') . '
                                                    </div>
                                               
                                            </div></div></a>';
                                        }
                                        ?>
                                    </div>
                                    <button class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-prev">
                                        <i class="icon icon-chevron-left text-12"></i>
                                    </button>
                                    <button class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-next">
                                        <i class="icon icon-chevron-right text-12"></i>
                                    </button>
                                    <div class="section-slider-pagination blog-pagination2 pagination -dots mt-20 justify-content-center"></div>
                                </div>
                                <div class="row pt-20 d-none md:d-block">
                                    <div class="col-auto text-center">
                                        <div class="d-inline-block">
                                            <a href="#" class="button -md 1 bg-red-1 text-white">
                                                <?= $loc->getTxt("all_tours") ?>
                                                <div class="icon-arrow-top-right ml-15"></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tabs__pane -tab-item-2">
                            <div class="">
                                <div data-anim="slide-up delay-2" class="relative pt-40 sm:pt-20 js-section-slider" data-gap="30" data-scrollbar data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-pagination="blog-pagination4">
                                    <div class="swiper-wrapper">
                                        <?php
                                        $recTours = $main->getTours(['tour_categories' => [4]], 4);
                                        foreach ($recTours as $key => $value) {
                                            $tourName = $value['trans'][$loc->getUserLangId()]['tour_name'] ?? $value['trans'][1]['tour_name'];
                                            $tourListImages = $main->getTourListImages($value['id']);
                                            $priceList = $main->getTourPrices($value['id']);
                                            $minP      = $priceList[0]['min_person'];
                                            $maxP      = $priceList[0]['max_person'];
                                            $price     = $priceList[0]['price'] ?? 999;
                                            $listPrice = $price + ($price / 100 * $value['list_price']);
                                            $price     = $loc->formatMoney($loc->convertPrice($price));
                                            $listPrice = $loc->formatMoney($listPrice);
                                            $tourStopIds = $main->getTourStopsIdsByTourId($value['id']);
                                            $catName    = $main->getTourCategoriesByTourId($value['id']);
                                            $catName    = $catName[$loc->getUserLang() . '_category_name'] ?? $catName['en_category_name'];

                                            $attrHTML = '';
                                            if ($value['pickup_dropoff'] == 1) {
                                                $attrHTML .= '<li><i class="icon-map-marker text-red-1"></i><span class="text-light-1">' . $loc->getTxt('include_pickup_and_dropoff') . '</span></li>';
                                            }
                                            echo '<div class="swiper-slide"><div class="relative">
                                                <div class="hotelsCard -type-1 hover-unset"><div class="hotelsCard__image relative"><div class="cardImage ratio ratio-1:1">
                                                            <div class="cardImage__content">';
                                            if (count($tourListImages) <= 1) {
                                                echo '<img class="rounded-4 col-12" src="' . HOME_URL . $tourListImages[0] . '" alt="'.$tourName.'" title="'.$tourName.'">';
                                            } else {
                                                echo '<div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                                                                        <div class="swiper-wrapper">';
                                                foreach ($tourListImages as $k => $v) {
                                                    echo '<div class="swiper-slide">
                                                            <img class="col-12" src="' . HOME_URL . $v . '" alt="'.$tourName.'" title="'.$tourName.'">
                                                        </div>';
                                                }
                                                echo '</div>
                                                            <div class="cardImage-slider__pagination js-pagination"></div>
                                                            <div class="cardImage-slider__nav -prev">
                                                                <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 js-prev">
                                                                    <i class="icon-chevron-left text-10"></i>
                                                                </button>
                                                            </div>
                                                            <div class="cardImage-slider__nav -next">
                                                                <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 js-next">
                                                                    <i class="icon-chevron-right text-10"></i>
                                                                </button>
                                                            </div>
                                                        </div>';
                                            }
                                            echo '</div>
                                                        </div>';
                                            foreach ($tourStopIds as $k => $v) {
                                                if (in_array($v, $tickets)) {
                                                    $attrHTML .= '<li><i class="icon-external text-red-1"></i><span class="text-light-1">' . $loc->getTxt('entry_without_waiting') . '</span>';
                                                    break;
                                                }
                                            }
                                            foreach ($tourStopIds as $k => $v) {
                                                if (in_array($v, $audioGuides)) {
                                                    echo '<div class="hotelsCard__audio text-white fw-500 lh-1 d-flex items-center text-18">
                                                                        <i class="icon-headset-2 bg-green-3 ratio-1:1 p-1 rounded-full mr-4"></i> 
                                                                        ' . $loc->getTxt('audio_guide') . '
                                                                    </div>';
                                                    break;
                                                }
                                            }
                                            
                                            foreach ($priceList as $k => $v) {
                                                if($v['min_person'] != $v['max_person']){
                                                    $personRange = $v['min_person'] . '-' . $v['max_person'];
                                                }else{
                                                    $personRange = $v['min_person'];
                                                }
                                                break;
                                            }
                                            $personRange = str_replace('{MIN_MAX_PEOPLE}', $personRange, $loc->getTxt('for_x_y_people'));
                                            echo '</div>
                                                    <a href="' . HOME_URL . "/" . $loc->getUserLang() . "/tour-detail/" . permalink($tourName) . "/" . $value['id'] . '">
                                                    <div class="hotelsCard__content px-10 py-10 pt-15 border-light border-top-none">
                                                        <p class="lh-15 text-18 text-light-1">' . $catName . '</p>
                                                        <h4 class="hotelsCard__title text-dark-1 text-24 lh-1 fw-600 pb-5 hover:text-mokan-2">
                                                            <span>' . $tourName . '</span>
                                                        </h4>
                                                        <ul class="text-14  lh-17 mb-10">
                                                            ' . $attrHTML . '
                                                        </ul>
                                                        <ul class=" lh-1">
                                                            <li class="text-light-1 text-14">
                                                                <span class="text-green-2 text-16 fw-700">
                                                                    <i class="icon-group"></i> '.$personRange.'<br/>
                                                                    <span class="text-red-1 text-20 fw-700">' . $loc->getCurrencySymbol() . $price . '</span>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                   <div class="hotelsCard__duration">
                                                        <div class="hotelsCard__duration_relative">
                                                            <p class="lh-1 text-14 text-white">' . $value['duration'] . '+ ' . $loc->getTxt('hour') . '</p>
                                                        </div>
                                                    </div>
                                                    <div class="hotelsCard__badge rounded-4 fw-500 bg-black text-yellow-1 p-1 text-13 lh-1 uppercase">
                                                        <i class="icon-star text-13"></i> ' . $loc->getTxt('featured') . '
                                                    </div>
                                               
                                            </div></div></a>';
                                        }
                                        ?>
                                    </div>
                                    <button class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-prev">
                                        <i class="icon icon-chevron-left text-12"></i>
                                    </button>
                                    <button class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-next">
                                        <i class="icon icon-chevron-right text-12"></i>
                                    </button>
                                    <div class="section-slider-pagination blog-pagination4 pagination -dots mt-20 justify-content-center">
                                    </div>
                                </div>
                                <div class="row pt-20 d-none md:d-block">
                                    <div class="col-auto text-center">
                                        <div class="d-inline-block">
                                            <a href="#" class="button -md 1 bg-red-1 text-white">
                                                <?= $loc->getTxt("all_tours") ?>
                                                <div class="icon-arrow-top-right ml-15"></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $homePageEvents = $main->getEvents(['show_home' => 1], 5);
                        if (!empty($homePageEvents)) {
                        ?>
                        <div class="mt-40">
                            <div class="row y-gap-20 justify-between items-end">
                                <div class="col-12">
                                    <div class="">
                                        <div class="sectionTitle -md">
                                            <h2 class="sectionTitle__title text-center text-mokan-3 text-30 lg:text-24 uppercase fw-600 lg:fw-500">
                                                <?= $loc->getTxt('immersive_activities') ?>
                                            </h2>
                                            <p class=" sectionTitle__text mt-5 lg:text-16 text-16 sm:mt-0 text-center">
                                                <?= $loc->getTxt('immersive_activities_alt') ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <?php
                                $totalHomeEvents = count($homePageEvents);
                                foreach ($homePageEvents as $key => $value) {
                                    $eventName  = $value['trans'][$loc->getUserLangId()]['event_name'] ?? $value['trans'][1]['event_name'];
                                    $image      = $main->getEventDetailImages($value['id'])[0] ?? '';
                                    if($key <= 2){
                                        echo '<a href="' . HOME_URL . "/" . $loc->getUserLang() . "/event-detail/" . permalink($eventName) . "/" . $value['id'] . '" class="col-12 col-lg-6">
                                                <div class="relative experienceCard eCardType1">
                                                    <img src="'.HOME_URL.$image.'" alt="'.$eventName.'" title="'.$eventName.'">
                                                    <div class="absolute bg-red-1 text-white text-20 lg:text-14 p-2 fw-600 lh-1">
                                                        <span>'.($key + 1) . '. '.$eventName.'</span>
                                                    </div>
                                                </div>
                                            </a>';
                                    }else{
                                        if($totalHomeEvents >= 5){
                                            if($key == 3 ){
                                                echo '<div class="col-12 col-lg-6 ">
                                                    <div class="row h-full">';
                                            }

                                            echo '
                                                        <a href="' . HOME_URL . "/" . $loc->getUserLang() . "/event-detail/" . permalink($eventName) . "/" . $value['id'] . '" class="col-6 pr-4">
                                                            <div class="relative experienceCard eCardType2 h-full">
                                                                <img src="'.$image.'" alt="'.$eventName.'" title="'.$eventName.'">
                                                                <div
                                                                    class="absolute bg-red-1 text-white text-20 lg:text-14 p-2 fw-600 lh-1">
                                                                    <span>'.($key + 1) . '. '.$eventName.'</span>
                                                                </div>
                                                            </div>
                                                        </a>';
                                            if($key == 4){
                                                echo '</div>
                                                </div>';
                                            }

                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-40">
            <div class="container">
                <div class="row y-gap-20 justify-between items-end">
                    <div class="col-12">
                        <div class="">
                            <div class="sectionTitle -md">
                                <h2 class="sectionTitle__title text-center text-mokan-3 text-30 lg:text-24 uppercase fw-600 lg:fw-500">
                                    <?= $loc->getTxt('blogs') ?>
                                </h2>
                                <p class=" sectionTitle__text mt-5 lg:text-16 text-16 sm:mt-0 text-center">
                                    <?= $loc->getTxt('blogs_alt') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-anim="slide-up delay-2" class="relative pt-40 sm:pt-20 js-section-slider" data-gap="30" data-scrollbar data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-pagination="blog-pagination3">
                    <div class="swiper-wrapper">
                        <?php
                        $blogs = $main->getHomePageBlogs();
                        foreach ($blogs as $key => $value) {
                            $blogTitle  = $value['trans'][$loc->getUserLangId()]['blog_title'] ?? $value['trans'][1]['blog_title'];
                            $catName    = $value[$loc->getUserLang() . '_category_name'] ?? $value['en_category_name'];
                            echo '<div class="swiper-slide h-auto" >
                                    <div class="relative h-full d-flex flex-column">
                                        <div class="hotelsCard -type-1">
                                            <a href="' . HOME_URL . "/" . $loc->getUserLang() . "/blog/" . permalink($blogTitle) . "/" . $value['id'] . '">
                                                <div class="hotelsCard__image relative">
                                                    <div class="cardImage ratio ratio-3:2">
                                                        <div class="cardImage__content">
                                                            <img class="rounded-4 col-12" src="' . HOME_URL . $value['list_img'] . '" data-src="' . HOME_URL . $value['list_img'] . '" alt="'.$blogTitle.'" title="'.$blogTitle.'">
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="hotelsCard__content flex-fill px-10 py-10 pt-15 border-light border-top-none">
                                                <p class="lh-15 text-16 text-light-1"><a href="' . HOME_URL . '/' . $loc->getUserLang() . '/blogs?cat=' . permalink($catName) . '">' . $catName . '</a></p>
                                                <h4 class="hotelsCard__title text-dark-1 text-20 lh-16 fw-600">
                                                    <span><a href="' . HOME_URL . "/" . $loc->getUserLang() . "/blog/" . permalink($blogTitle) . "/" . $value['id'] . '">' . $blogTitle . '</a></span>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                        ?>
                    </div>
                    <button class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-prev">
                        <i class="icon icon-chevron-left text-12"></i>
                    </button>
                    <button class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-next">
                        <i class="icon icon-chevron-right text-12"></i>
                    </button>
                    <div class="section-slider-pagination blog-pagination3 pagination -dots mt-20 justify-content-center">
                    </div>
                    <div class="row pt-20 d-none md:d-block">
                        <div class="col-auto text-center">
                            <div class="d-inline-block">
                                <a href="#" class="button -md 1 bg-red-1 text-white">
                                    <?= $loc->getTxt("all_tours") ?> <div class="icon-arrow-top-right ml-15"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        if ($settings->getSetting("show_comments") == 1) {
            include 'inc/section-customer-comments.php';
            echo '<div class="section-slider-pagination blog-pagination5 pagination -dots mt-20 justify-content-center"></div>';
        }
        include 'inc/section-why-us.php';
        include 'inc/section-subscribe.php';
        include 'inc/footer.php';
        ?>
    </main>
    <?php
    include 'inc/modal-lang.php';
    include 'inc/modal-currency.php';
    include 'inc/common-footer.php';
    ?>
    <script src="<?= THEME_URL ?>/assets/js/flatpickr.js"></script>
    <script src="<?= THEME_URL ?>/assets/js/select2.min.js"></script>
    <?php
    // Flatpickr için dil dosyayını ekliyoruz.
    if ($loc->getUserLang() != "en") {
        echo '<script src="' . THEME_URL . "/assets/js/flatpickr/localization/" . $loc->getUserLang() . '.js"></script>';
    }
    echo $settings->getSetting("footer_code");
    ?>
    <script>
    function populateTimeList(dateTime, elementSelector, calendar, updateEndDate, endDate, endDateSettings,
        endTransferDate, isStartDate, type='') {
        const currentMinute = dateTime.getHours() * 60 + dateTime.getMinutes();
        const startDayIsToday = isToday(dateTime);

        for (let i = 0; i < 96; i++) {
            const hour = Math.floor(i / 4);
            const minute = (i % 4) * 15;
            const hourMinute = hour * 60 + minute;
            if (startDayIsToday && hourMinute < currentMinute) {
                continue;
            }

            const hourText = addZero(hour) + ':' + addZero(minute);
            const hourElement = document.createElement('li');
            if (hourMinute == currentMinute) {
                hourElement.classList.add('text-mokan-3');
            }
            hourElement.innerHTML = `<span style="font-weight:500;cursor:pointer">${hourText}</span>`;
            hourElement.addEventListener('click', function() {
                const newDate = new Date(calendar.selectedDates[0]);
                newDate.setHours(hour);
                newDate.setMinutes(minute);
                calendar.setDate(newDate);

                document.querySelector(elementSelector).style.display = 'none';
                hourElement.classList.add('text-mokan-3');
                document.querySelectorAll(`${elementSelector} ul li`).forEach(function(item) {
                    item.classList.remove('text-mokan-3');
                });

                if(type == 'rentacar'){
                    document.querySelector('.rent-start-date-trigger').innerHTML =
                        calendar?.altInput?.value || calendar
                        .formatDate(dateTime, 'd M H:i');
                }else{
                    isStartDate ? updateEndDate(newDate, endDate, endDateSettings, endTransferDate) : null;
                    document.querySelector(isStartDate ? '.start-date-trigger' : '.end-date-trigger').innerHTML =
                        calendar?.altInput?.value || calendar
                        .formatDate(dateTime, 'd M H:i');
                }
            });
            hourElement.classList.add('p-3');
            if (startDayIsToday && hourMinute < currentMinute) {
                hourElement.style.display = 'none';
            }
            document.querySelector(`${elementSelector} ul`).appendChild(hourElement);
        }

        document.querySelector(elementSelector).style.display = 'block';
    }

    const searchmenudateflatpickr = $(".flatpickr1").flatpickr({
        locale: CURRENT_LANG,
        minDate: new Date("<?= date('Y-m-d') ?>"),
        altInput: true,
        altFormat: "j F",
        dateFormat: "Y-m-d",
        disableMobile: true,
        defaultDate: new Date("<?= $loc->getMinTourDate() ?>"),
        onOpen: function() {
            $('.flatpickr1').addClass('-is-visible');
        },
        onClose: function() {
            $('.flatpickr1').removeClass('-is-visible');
        },

    });

    const endTransferDate = document.querySelector(".flatpickr3");
    var endDateSettings = {
        locale: CURRENT_LANG,
        time_24hr: true,
        minDate: new Date("<?= date('Y-m-d H:i', strtotime($loc->getMinTransferDate() . ' +2 hours')) ?>"),
        altInput: true,
        altFormat: "j F H:i",
        dateFormat: "Y-m-d H:i",
        disableMobile: true,
        defaultDate: new Date("<?= date('Y-m-d H:i', strtotime($loc->getMinTransferDate() . ' +2 hours')) ?>"),
        onReady: function(dates, toString, calendar) {
            if (dates) {
                var start = new Date(dates[0]);
                start =
                    `${start.getFullYear()}-${addZero(start.getMonth() + 1)}-${addZero(start.getDate())} ${addZero(start.getHours())}:${addZero(start.getMinutes())}`;
            }
            document.querySelector('.end-date-trigger').innerHTML = calendar.altInput.value;
        },
        onChange: function(dates, toString, calendar) {
            if (dates) {
                var start = new Date(dates[0]);
                start =
                    `${start.getFullYear()}-${start.getMonth() + 1}-${start.getDate()} ${addZero(start.getHours())}:${addZero(start.getMinutes())}`;
                // setTransferEndDate(start);
                const endDateTime = new Date(dates[0]);

                populateTimeList(endDateTime, '.end-hours', calendar, updateEndDate, endDate,
                    endDateSettings, endTransferDate, false);
            }
        }
    };
    var endDate = flatpickr(endTransferDate, endDateSettings);

    function updateEndDate(startDateTime, endDateP, endDateSettings, endTransferDate) {

        var endDateTime = new Date(endDate.selectedDates[0]);

        startDateTime.setHours(startDateTime.getHours() + 1);
        startDateTime.setMinutes(startDateTime.getMinutes() + 30);
        endDate.set('minDate', startDateTime);

        if (Date.parse(startDateTime) > Date.parse(endDateTime)) {
            endDate.destroy();
            endDateSettings.minDate = startDateTime;
            endDateSettings.defaultDate = startDateTime;
            endDate = flatpickr(endTransferDate, endDateSettings);
            if (document.querySelector('[name="round_trip"]').checked) {
                endDate.open();
            }
        }
    }
    const startTransferDate = document.querySelector(".flatpickr2");
    const startDate = flatpickr(startTransferDate, {
        locale: CURRENT_LANG,
        time_24hr: true,
        minDate: new Date("<?= date('Y-m-d H:i', strtotime($loc->getMinTransferDate() . ' +30 minute')) ?>"),
        altInput: true,
        altFormat: "j F H:i",
        dateFormat: "Y-m-d H:i",
        disableMobile: true,
        defaultDate: new Date("<?= date('Y-m-d H:i', strtotime($loc->getMinTransferDate() . ' +30 minute')) ?>"),
        onReady: function(dates, toString, calendar) {
            if (dates) {
                var start = new Date(dates[0]);
                start =`${start.getFullYear()}-${addZero(start.getMonth() + 1)}-${addZero(start.getDate())} ${addZero(start.getHours())}:${addZero(start.getMinutes())}`;
            }
            document.querySelector('.start-date-trigger').innerHTML = calendar.altInput.value;
        },
        onChange: function(dates, toString, calendar) {
            if (dates) {
                var start = new Date(dates[0]);
                var startDateTime = new Date(dates[0]);
                start = `${start.getFullYear()}-${start.getMonth() + 1}-${start.getDate()} ${addZero(start.getHours())}:${addZero(start.getMinutes())}`;
                // setTransferStartDate(start);
                populateTimeList(startDateTime, '.start-hours', calendar, updateEndDate, endDate, endDateSettings, endTransferDate, true);
            }
        }
    });

    
    const rentCar = document.querySelector(".flatpickr4");
    const rentCarDate = flatpickr(rentCar, {
        locale: CURRENT_LANG,
        time_24hr: true,
        minDate: new Date("<?= date('Y-m-d H:i', strtotime($loc->getMinTransferDate() . ' +30 minute')) ?>"),
        altInput: true,
        altFormat: "j F H:i",
        dateFormat: "Y-m-d H:i",
        disableMobile: true,
        defaultDate: new Date("<?= date('Y-m-d H:i', strtotime($loc->getMinTransferDate() . ' +30 minute')) ?>"),
        onReady: function(dates, toString, calendar) {
            if (dates) {
                var start = new Date(dates[0]);
                start =
                    `${start.getFullYear()}-${addZero(start.getMonth() + 1)}-${addZero(start.getDate())} ${addZero(start.getHours())}:${addZero(start.getMinutes())}`;
            }
            document.querySelector('.rent-start-date-trigger').innerHTML = calendar.altInput.value;
        },
        onChange: function(dates, toString, calendar) {
            if (dates) {
                var start = new Date(dates[0]);
                var startDateTime = new Date(dates[0]);
                start =
                    `${start.getFullYear()}-${start.getMonth() + 1}-${start.getDate()} ${addZero(start.getHours())}:${addZero(start.getMinutes())}`;
                // setTransferStartDate(start);
                populateTimeList(startDateTime, '.rent-start-hours', calendar, updateEndDate, endDate,
                    endDateSettings, endTransferDate, true, 'rentacar');
            }
        }
    });

    $('.js-first-date.flatpickr1.form-control:input').attr('aria-label', "<?= $loc->getTxt("select_tour_start_date") ?>");

    $(".quick-transfer-res").submit(function(e) {
        e.preventDefault();
        tmpThis = $(this);
        var start_location = $(this).find('[name="start_location"]').val();
        var end_location = $(this).find('[name="end_location"]').val();
        $.ajax({
            url: HOME_URL + '/api/v1/setQuickLocation',
            data: {
                start_location: start_location,
                end_location: end_location
            },
            type: 'POST',
            success: function(r) {
                if (r.code == 200) {
                    tmpThis.unbind('submit').submit();
                }
            },
            error: function(r) {
                alert('Server error');
            }
        });
    });

    (
        function() {
            document.querySelector('.start-date-trigger').addEventListener('click', function() {
                startDate.open();
            });
            document.querySelector('.end-date-trigger').addEventListener('click', function() {
                endDate.open();
            });
            document.querySelector('.rent-start-date-trigger').addEventListener('click', function() {
                rentCarDate.open();
            });
        }
    )();
    </script>
</body>

</html>