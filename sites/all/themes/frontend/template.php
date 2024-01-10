<?php
/**
 * Implements hook_preprocess_html().
 */
function frontend_preprocess_html(&$variables)
{
  dsm(current_path());
  $theme_path = drupal_get_path('theme', 'frontend');

  if(current_path() == 'user/login'){
    drupal_add_css($theme_path . '/app-assets/css/pages/authentication.css', array('group' => CSS_THEME, 'media' => 'all', 'weight' => -999));
    drupal_add_js($theme_path . '/app-assets/vendors/js/forms/validation/jquery.validate.min.js', array('group' => JS_THEME, 'media' => 'all', 'weight' => -999));
    drupal_add_js($theme_path . '/app-assets/js/scripts/pages/auth-login.js', array('group' => JS_THEME, 'media' => 'all', 'weight' => -999));
  }
  else if(current_path() == 'nguoi-dung'){
    drupal_add_js($theme_path . '/app-assets/js/core/chuc-nang/user.js', array('group' => JS_THEME));
  }
  else if(current_path() == 'don-hang'||current_path() == 'tra-cuu-don'||current_path() == 'view-don-hang'){
    drupal_add_js($theme_path . '/app-assets/js/core/chuc-nang/don-hang.js', array('group' => JS_THEME));
  }
  else if(current_path() == 'danh-muc'){
    drupal_add_js($theme_path . '/app-assets/js/core/chuc-nang/danh-muc.js', array('group' => JS_THEME));
  }
  else if(current_path() == 'san-pham'||current_path() == 'view-san-pham'){
    drupal_add_js($theme_path . '/app-assets/js/core/chuc-nang/san-pham.js', array('group' => JS_THEME));
  }
  else if(current_path() == 'ho-so-ca-nhan'){
    drupal_add_js($theme_path . '/app-assets/js/core/chuc-nang/ho-so-ca-nhan.js', array('group' => JS_THEME));
  }
  drupal_add_js($theme_path . '/app-assets/js/core/chuc-nang/main.js', array('group' => JS_THEME));
}

function getMainMenuQLHD(){
  $mainMenu = menu_tree_all_data('main-menu');
  $str = "";
  foreach ($mainMenu as $item){
    if($item['link']['hidden'] == 0){
      // Nếu không có menu con
      if (count($item['below']) == 0)
      {
        $str .="<li>";
        $str .=l($item['link']['link_title'],
          $item['link']['link_path'],
          array(
            'attributes' => array(
              'title' => '<span data-i18n="'.$item['link']['link_title'].'">'.$item['link']['link_title'].'</span>',
            ),
            'html' => true
          )
        );
      }else
      {
        $str .='<li class="dropdown nav-item" data-menu="dropdown">';
        $str .=l($item['link']['link_title'],
          $item['link']['link_path'],
          array(
            'fragment' => ' ',
            'attributes' => array(
              'class' => explode(' ', 'dropdown-toggle nav-link d-flex align-items-center '),
              'data-bs-toggle' => "dropdown",
              'title' => '<span data-i18n="'.$item['link']['link_title'].'">'.$item['link']['link_title'].'</span>',
              'external' => TRUE,
            ),
            'html' => true
          )
        );
      }

      // nếu có menu con
      if(count($item['below']) > 0){
        $str .='<ul class="dropdown-menu" data-bs-popper="none">';
        foreach($item['below'] as $subItem){
          $cls = '';
          if($subItem['link']['link_title'] == 'Thêm khách hàng')
            $cls = 'btn-them-moi-khach-hang';
          if($subItem['link']['link_title'] == 'Thêm thu chi')
            $cls = 'btn-them-thu-chi';

          if($subItem['link']['hidden'] == 0)
            $str .='<li data-menu="">'.l($subItem['link']['link_title'],
                $subItem['link']['link_path'],
                array(
                  'attributes' => array(
                    'class' => explode(' ', 'dropdown-item d-flex align-items-center '.$cls),
                    'title' => '<span data-i18n="'.$item['link']['link_title'].'">'.$item['link']['link_title'].'</span>',
                    'data-bs-toggle' => '',
                    'data-i18n' => $subItem['link']['link_title']
                  )
                )
              )."</li>";
        }
        $str .='</ul>';
      }
      $str .='</li>';
    }
  }
  return '<ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">'.$str.'</ul>';
}

