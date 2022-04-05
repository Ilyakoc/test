<?php
use common\components\helpers\HYii as Y; 
use common\components\helpers\HHtml; 
use iblock\components\helpers\HInfoBlock;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
    CmsHtml::head();
    CmsHtml::js($this->template . '/js/bootstrap.min.js');
    CmsHtml::js($this->template . '/js/jquery.mmenu.all.js');
    CmsHtml::js($this->template . '/js/script.js');
    CmsHtml::js('/js/slick.min.js');
    CmsHtml::js('/js/main.js');
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="canonical" href="<?=$this->createAbsoluteUrl('/').preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI'])?>" />
    <link rel="stylesheet" href="/css/main.css">
</head>

<body class="<?= D::c($this->isIndex(), 'index-page', 'inner-page') ?>">

  <div id="my-page">

      <div id="my-header">
        <header class="header">
        <?php if( D::cms('slogan') ): ?>
          <div class="header-slogan-wrapper">
            <div class="container">
              <div class="header-slogan">
                <?= D::cms('slogan') ?>
              </div>
            </div>
          </div>
        <?php endif; ?>

          <div class="header-top">
            <div class="container header-top-box">
              <div class="header-location">
                  <span>
                    <?= strip_tags(D::cms('address')) ?>
                  </span>
              </div>
              <div class="header-phone">
                <?= HHtml::phoneLink(D::cms('phone'), ['onclick'=>'yaCounter54389128.reachGoal(\'click_number\'); return true;']); ?>
                <?= HHtml::phoneLink(D::cms('phone2'), ['onclick'=>'yaCounter54389128.reachGoal(\'click_number\'); return true;']); ?>
                <? if(D::cms('emailPublic')) { ?>
                  <a href="mailto:<?= D::cms('emailPublic'); ?>" onclick="yaCounter54389128.reachGoal('click_mail'); return true;"><?= D::cms('emailPublic'); ?></a>
                <? } ?>
              </div>
              <? if(\crud\models\ar\Social::getItems()) { ?>
              <div class="header-social">
                Мы в соц. сетях
                <? \crud\models\ar\Social::render(); ?>
              </div>
              <? } ?>
            </div>
          </div>

          <div class="header-middle">
            <div class="container">
              <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5 col-12 order-1">
                  <a href="/" class="header-logo">
                    <div class="header-logo-left">
                      <?php $logo=\D::cms('logo_header') ? '/images/cms/' . \D::cms('logo_header') : '/images/logo.png'; ?>
                      <img class="js-mmenu-logo" src="<?=$logo?>" alt="<?= CHtml::encode(D::cms('sitename')) ?>"/>
                    </div>
                  </a>
                </div>
                <div class="col-xl-7 col-lg-5 col-md-12 col-sm-7 order-5 order-lg-2 ">
                  <div class="header-search">
                    <? $this->widget('widget.search.SearchWidget', ['submit'=>'', 'view'=>'search_form_flex']); ?>
                  </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5 offset-lg-0 offset-md-3 order-md-4 order-6 header-callback-col">
                  <div class="header-callback">
                    <?php if (D::yd()->isActive('feedback')):?>
                        <a href="javascript:;" class="btn callback-button" data-src="#form-callback" data-fancybox><span>Заказать звонок</span></a>
                    <?php endif;?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="header-bottom">
            <div class="container">
              <div class="row">
                <div class="col-sm-7 col-4 d-block d-xl-none">
                  <div class="header-hamburger">
                    <button class="hamburger hamburger--spin" type="button">
                      <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                      </span>
                    </button>
                  </div>
                </div>
                <div class="col-xl-10 d-xl-block d-none">
                  <div class="header-nav" id="nav-mmenu">
                    <?php
                    $this->widget('\menu\widgets\menu\MenuWidget', array(
                        'rootLimit' => D::cms('menu_limit'),
                        'cssClass' => 'menu nav nav-justified clearfix'
                    ));
                    ?>
                  </div>
                </div>
                <div class="col-xl-2 col-sm-5 col-8 d-flex justify-content-end">
	                <div id="fav-header-count" class="header-fav-block" style="display: none;">
		                <a href="<?= $this->createUrl('/catalog/favorites') ?>" class="fav-count"><i class="glyphicon glyphicon-heart-empty"></i><span class="val dcart-total-count"></span></a>
	                </div>
	                
                  <div class="header-cart-block">
                    <a href="/cart" class="header-cart">
                      <span class="dcart-total-count">
                        <?= Yii::app()->cart->getTotalCount() ?>
                      </span>
                    </a>
                    <div class="header-price">
                      <span class="dcart-total-price"><?= HtmlHelper::priceFormat(Yii::app()->cart->getTotalPrice());?> </span> руб.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>
      </div>

      <div id="my-content">
        <div class="container">

          <?php if (!$this->isIndex()): ?>
            <?php
              $this->widget('\ext\D\breadcrumbs\widgets\Breadcrumbs', array('breadcrumbs' => $this->breadcrumbs->get()));
            ?>
          <?php endif ?>

          <div class="row">

            <div class="col-lg-3 col-md-4">
              <aside class="side-bar">
                <div class="side-categories">
                  <div class="side-categories-header">Продукция <span class="arrow-down"></span></div>
                  <?php $this->widget('widget.ShopCategories.ShopCategories') ?>
                </div>

                <?php if ($this->isIndex()): ?>
                  <div class="side-sale d-none d-md-block">
                    <?php $this->widget('\widget\sale\SaleList') ?>
                  </div>

                  <div class="side-events d-none d-md-block">
                    <?php $this->widget('widget.Events.Events') ?>
                  </div>
                <?php endif ?>

              </aside>
            </div>

            <div class="col-lg-9 col-md-8">
              <main class="main-content">

                <?php if ($this->isIndex()): ?>
                  <div class="main-slider">
                    <?php  foreach (HInfoBlock::getElementsByCode('slider') as $element): ?>
                      <div class="slide">
                        <? if ($element['props']['LINK']): ?>
                          <a href="<?= $element['props']['LINK'] ?>">
                            <img src="<?= ResizeHelper::resize($element['preview'], 825, 495) ?>" alt="">
                          </a>
                          <? if (!empty($element['props']['TITLE']) || !empty($element['props']['DESC'])) { ?>
                          <div class="text-feild">
                            <? if (!empty($element['props']['TITLE'])) { ?>
                              <h2><?= $element['props']['TITLE'] ?></h2>
                            <? } ?>
                            <? if (!empty($element['props']['DESC'])) { ?>
                              <?= $element['props']['DESC']; ?>
                            <? } ?>
                          </div>
                          <? } ?>
                        <?php else: ?>
                          <img src="<?= ResizeHelper::resize($element['preview'], 825, 495) ?>" alt="">
                          <? if (!empty($element['props']['TITLE']) || !empty($element['props']['DESC'])) { ?>
                          <div class="text-feild">
                            <? if (!empty($element['props']['TITLE'])) { ?>
                              <h2><?= $element['props']['TITLE'] ?></h2>
                            <? } ?>
                            <? if (!empty($element['props']['DESC'])) { ?>
                              <?= $element['props']['DESC']; ?>
                            <? } ?>
                          </div>
                          <? } ?>
                        <?php endif ?>
                      </div>
                    <?php endforeach; ?>
                  </div>

                  <section class="product-carousel-section">
                    <h2 class="h2">Хиты продаж</h2>
                    <?php if (D::cms('shop_enable_carousel')) $this->widget('widget.catalog.ProductCarouselWidget'); ?>
                  </section>
                <?php endif ?>

                <section class="text text-main">
                    <?= $content ?>
                </section>
              </main>
            </div>

            <?php if ($this->isIndex()): ?>
              <div class="adaptive-block col-12 d-md-none d-block">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="side-sale">
                      <?php $this->widget('\widget\sale\SaleList') ?>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="side-events">
                      <?php $this->widget('widget.Events.Events') ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif ?>

          </div>
        </div>
      </div>

      <div id="my-footer">
        <footer class="footer">
          <div class="container">
            <div class="footer-top">
              <div class="row">
                <div class="col-lg-2 col-sm-4 col-6">
                  <div class="footer-copyright">
                    <div class="footer-contacts-wrap">
                      <a href="/" class="footer-logo">
                        <?php $logo=\D::cms('logo_footer') ? '/images/cms/' . \D::cms('logo_footer') : '/images/logo.png'; ?>
                        <img src="<?=$logo?>" alt="<?= CHtml::encode(D::cms('sitename')) ?>"/>
                      </a>
                      <div class="footer-copyright-text">
                        <?php ModuleHelper::Copyright() ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-6">
                  <div class="footer-phone">
                    <div class="footer-contacts-wrap">
                      <div class="footer-contacts-head">Телефоны:</div>
                      <div class="footer-contacts-text">
                        <?= HHtml::phoneLink(D::cms('phone'), ['onclick'=>'yaCounter54389128.reachGoal(\'click_number\'); return true;']); ?>
                        <?= HHtml::phoneLink(D::cms('phone2'), ['onclick'=>'yaCounter54389128.reachGoal(\'click_number\'); return true;']); ?>
                        <a href="mailto:<?= D::cms('emailPublic') ?>" onclick="yaCounter54389128.reachGoal('click_mail'); return true;"><?= D::cms('emailPublic') ?></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-6">
                  <? if(D::cms('address')) { ?>
                  <div class="footer-address">
                    <div class="footer-contacts-wrap">
                      <div class="footer-contacts-head">Адрес:</div>
                      <div class="footer-contacts-text">
                        <?= (D::cms('address')) ?>
                      </div>
                    </div>
                  </div>
                  <? } ?>
                </div>
                <div class="col-lg-2 col-sm-4 col-6">
                  <? if(D::cms('workingTime')) { ?>
                  <div class="footer-time">
                    <div class="footer-contacts-wrap">
                      <div class="footer-contacts-head">Режим работы:</div>
                      <div class="footer-contacts-text">
                        <?= (D::cms('workingTime')) ?>
                      </div>
                    </div>
                  </div>
                  <? } ?>
                </div>
                <div class="col-lg-2 col-sm-4 col-6">
                  <? if(D::cms('emailPublic')) { ?>
                  <div class="footer-mail">
                    <div class="footer-contacts-wrap">
                      <div class="footer-contacts-head">Электронная почта:</div>
                      <div class="footer-contacts-text">
                        <a href="mailto:<?= D::cms('emailPublic'); ?>"><?= D::cms('emailPublic'); ?></a>
                      </div>
                    </div>
                  </div>
                  <? } ?>
                </div>
                <div class="col-lg-2 col-sm-4 col-6">
                  <? if(\crud\models\ar\Social::getItems()) { ?>
                  <div class="footer-social">
                    <div class="footer-contacts-wrap">
                      <div class="footer-contacts-head">Мы в соц. сетях:</div>
                      <div class="footer-contacts-text">
                        <? \crud\models\ar\Social::render(); ?>
                      </div>
                    </div>
                  </div>
                  <? } ?>
                </div>
              </div>
            </div>

            <div class="footer-bottom">
              <div class="row">
                <div class="col-xl-7 col-lg-8 col-md-7 col-12">
                  <div class="footer-privacy">
                    <div class="footer-privacy-mail">
                      <?= \D::cms('privacy_policy_text'); ?>
                    </div>
                  </div>
                </div>

                <div class="col-xl-5 col-lg-4 col-md-5 col-12">
                  <div class="made">
                    <div class="made-left">
                    
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </footer>
      </div>

   </div>

</div>
  <div class="mob-link">
      <a href="https://api.whatsapp.com/send?phone=+79529245809" target="_blank">
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 40C31.0457 40 40 31.0457 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40Z" fill="#25D366"/>
              <path d="M28.8581 11.0906C26.5075 8.73751 23.3822 7.44126 20.0522 7.4397C13.1916 7.4397 7.60656 13.0234 7.60437 19.8869C7.60312 22.0813 8.17656 24.2228 9.26563 26.1097L7.5 32.5603L14.0984 30.8297C15.9169 31.8206 17.9638 32.3434 20.0472 32.3444H20.0525C26.9131 32.3444 32.4972 26.7597 32.5 19.8966C32.5016 16.5709 31.2075 13.4434 28.8581 11.0906ZM20.0525 30.2419H20.0484C18.1913 30.2413 16.3706 29.7425 14.7819 28.8L14.4041 28.5756L10.4884 29.6028L11.5331 25.7853L11.2872 25.3928C10.2513 23.7459 9.70406 21.8425 9.70531 19.8869C9.70719 14.1828 14.3488 9.54189 20.0556 9.54189C22.8194 9.54251 25.4166 10.6203 27.3703 12.5763C29.3238 14.5319 30.3988 17.1309 30.3981 19.8956C30.3963 25.6006 25.7547 30.2419 20.0525 30.2419ZM25.7275 22.4934C25.4163 22.3375 23.8872 21.5859 23.6019 21.4813C23.3166 21.3775 23.11 21.3259 22.9025 21.6372C22.695 21.9484 22.0991 22.6494 21.9172 22.8569C21.7359 23.0644 21.5547 23.0906 21.2434 22.9347C20.9322 22.7788 19.9303 22.4506 18.7431 21.3906C17.8181 20.5666 17.1938 19.5472 17.0125 19.2359C16.8313 18.9247 16.9931 18.7569 17.1491 18.6016C17.2891 18.4622 17.4603 18.2384 17.6156 18.0566C17.7709 17.8747 17.8228 17.745 17.9266 17.5378C18.0303 17.3303 17.9788 17.1488 17.9006 16.9931C17.8225 16.8372 17.2006 15.3063 16.9419 14.6834C16.6891 14.0769 16.4328 14.1591 16.2422 14.1497C16.0603 14.1409 15.8531 14.1384 15.6459 14.1384C15.4388 14.1384 15.1016 14.2163 14.8166 14.5278C14.5319 14.8391 13.7281 15.5913 13.7281 17.1228C13.7281 18.6534 14.8425 20.1328 14.9981 20.34C15.1538 20.5472 17.1913 23.6894 20.3113 25.0366C21.0531 25.3566 21.6328 25.5481 22.0844 25.6919C22.8294 25.9291 23.5075 25.895 24.0438 25.815C24.6413 25.7259 25.8838 25.0628 26.1434 24.3363C26.4025 23.61 26.4025 22.9875 26.3241 22.8575C26.2456 22.7272 26.0381 22.6494 25.7275 22.4934Z" fill="white"/>
          </svg>
      </a>
      <!--<a href="https://telegram.me/" target="_blank">
          <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M19.7622 0C25.21 0.0333535 29.8572 1.82333 33.7374 5.48109C37.6064 9.13886 39.7188 13.6749 39.9745 19.0004C40.2413 24.6927 38.418 29.6735 34.4711 33.7982C30.591 37.8562 25.7992 39.9464 20.1736 40.002C14.9371 40.0576 10.3454 38.301 6.49865 34.7544C1.96257 30.5629 -0.216523 25.3153 0.016952 19.1449C0.205955 13.9751 2.19605 9.52799 5.85382 5.88134C9.71171 2.02345 14.4257 0.100061 19.7622 0Z" fill="#0087CB"/>
              <path d="M13.8476 22.7026C12.7581 22.3691 11.6574 22.0244 10.5678 21.6909C10.0342 21.5241 9.50053 21.3574 8.96687 21.1906C8.76675 21.1239 8.57775 21.0572 8.41098 20.9349C8.09968 20.7014 8.07744 20.4123 8.34427 20.1233C8.52216 19.9232 8.74452 19.7897 8.98911 19.6897C9.63394 19.434 10.2788 19.1783 10.9236 18.9226C15.3707 17.2104 19.8179 15.4871 24.2761 13.775C25.6881 13.2302 27.0889 12.6854 28.5009 12.1407C28.6899 12.0628 28.89 12.0184 29.1013 12.0517C29.5238 12.1184 29.8462 12.4631 29.8906 12.9078C29.9129 13.1524 29.9018 13.397 29.8573 13.6416C29.3125 16.1987 28.7677 18.7669 28.223 21.324C27.7783 23.4364 27.3224 25.5488 26.8777 27.6723C26.7776 28.1504 26.6776 28.6284 26.5775 29.1065C26.5331 29.34 26.4663 29.5623 26.3552 29.7736C26.1328 30.1849 25.777 30.3406 25.3212 30.2516C25.0433 30.196 24.7987 30.0738 24.5763 29.907C23.0421 28.773 21.5078 27.6278 19.9624 26.4938C19.8957 26.4382 19.8179 26.3937 19.7512 26.3493C19.4843 26.2714 19.2953 26.0713 19.0841 25.9157C18.3503 25.382 17.6166 24.8261 16.8828 24.2925C16.8272 24.248 16.7716 24.2035 16.7271 24.1479C16.6604 24.0368 16.7271 23.9701 16.7938 23.9033C17.7944 23.0139 18.7839 22.1023 19.7845 21.2128C20.5072 20.5569 21.241 19.9009 21.9636 19.245C22.6863 18.589 23.4089 17.9442 24.1316 17.2994C24.6986 16.7879 25.2656 16.2876 25.8215 15.7762C25.866 15.7317 25.9105 15.6873 25.9549 15.6428C25.9883 15.5983 26.0328 15.5539 26.0105 15.4983C25.9883 15.4316 25.9216 15.4316 25.866 15.4316C25.6659 15.4093 25.4991 15.4871 25.3323 15.5872C24.7208 15.9541 24.1316 16.3432 23.5312 16.7212C21.7079 17.8664 19.8735 19.0226 18.0501 20.1678C16.7938 20.9571 15.5375 21.7465 14.2812 22.547C14.1367 22.6248 14.0366 22.7693 13.8476 22.7026Z" fill="#FCFDFE"/>
              <path d="M13.8475 22.7026C14.1477 22.5804 14.4034 22.3802 14.6814 22.2135C15.4819 21.7132 16.2823 21.2129 17.0828 20.7014C17.6498 20.3457 18.2057 19.9788 18.7727 19.623C19.7066 19.0338 20.6517 18.4445 21.5967 17.8553C22.2526 17.4439 22.9086 17.0214 23.5756 16.599C24.1538 16.2321 24.7319 15.8652 25.31 15.4983C25.499 15.3871 25.688 15.3204 25.9215 15.3426C25.9882 15.3538 26.0549 15.3538 26.0772 15.4205C26.1105 15.4872 26.0883 15.5539 26.0327 15.6206C25.8993 15.754 25.777 15.8985 25.6213 16.0208C25.3434 16.2432 25.0988 16.4989 24.832 16.7324C24.3984 17.0993 23.9981 17.4995 23.5645 17.8664C23.3866 18.022 23.2199 18.1888 23.042 18.3445C22.7863 18.5557 22.5417 18.8114 22.2971 19.0338C21.9191 19.3784 21.53 19.7119 21.152 20.0455C20.9852 20.2011 20.8073 20.3568 20.6517 20.5124C20.2403 20.9016 19.8067 21.2684 19.3953 21.6576C18.895 22.1134 18.3836 22.5581 17.8944 23.0251C17.5387 23.3586 17.1607 23.6699 16.7938 23.9923C16.7382 24.0368 16.7382 24.0813 16.7715 24.1369C16.6937 25.3932 16.6048 26.6495 16.5269 27.9058C16.5047 28.2393 16.4602 28.5617 16.4713 28.8953C16.4713 28.9953 16.4713 29.0843 16.3935 29.1621C16.3268 29.1843 16.249 29.1843 16.1823 29.1843C15.9822 29.1732 15.8376 29.0732 15.782 28.8842C15.7265 28.684 15.6597 28.495 15.6042 28.2949C15.0594 26.5049 14.5146 24.7039 13.9698 22.9139C13.9142 22.8361 13.8809 22.7694 13.8475 22.7026Z" fill="#CCD9E9"/>
              <path d="M16.3602 29.151C16.3268 28.7174 16.4046 28.2838 16.4158 27.8613C16.438 27.3944 16.4825 26.9274 16.5047 26.4605C16.5381 25.9824 16.5714 25.5043 16.6048 25.0374C16.6159 24.7928 16.6381 24.5482 16.6381 24.3147C16.6381 24.2369 16.6604 24.1813 16.7382 24.1368C17.6387 24.8039 18.5393 25.4599 19.4287 26.1269C19.5288 26.2048 19.6399 26.2603 19.7178 26.3604C18.8839 27.172 18.039 27.9836 17.2051 28.7952C16.9828 29.0176 16.7159 29.1955 16.3602 29.151Z" fill="#B1C8DB"/>
          </svg>
      </a>-->

  </div>
<div id="totop"><p>&#xe851;</p> ^ Наверх</div>

<?php if (D::yd()->isActive('feedback')): // обратный звонок ?>
    <div style="display: none;">
        <div id="form-callback">
            <div class="popup-info">
                <?php $this->widget('\feedback\widgets\FeedbackWidget', array('id' => 'callback')) ?>
            </div>
        </div>
    </div>
<?php endif; // обратный звонок ?>



<script src="/js/scripts.js"></script>
</body>
</html>
