<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alumnilib {

    function build_carousel($id, $data) {
        $cache = '<div id="' . $id . '" class="carousel slide">';
        $cache .= '<ol class="carousel-indicators">';
        for ($i = 0; $i < count($data); $i++) {

            $cache .= '<li data-target="#' . $id . '" data-slide-to="' . $i . '"' . (($i == 0) ? ' class="active"' : '') . '></li>';
        }
        $cache .= '</ol>';
        $cache .= '<div class="carousel-inner">';
        $i = 0;
        foreach ($data as $item) {
            $cache .= '<div class="item' . (($i == 0) ? ' active' : '') . '">';
            $cache .= '<img src="' . base_url() . 'resources/img/' . $item->url . '" alt="">';
            $cache .= '<div class="carousel-caption">';
            $cache .= '<h4>' . $item->title . '</h4>';
            $cache .= '<p>' . $item->desc . '</p>';
            $cache .= '</div>';
            $cache .= '</div>';
            $i++;
        }
        $cache .= '</div>';
        $cache .= '<a class="left carousel-control" href="#' . $id . '" data-slide="prev">&lsaquo;</a>';
        $cache .= '<a class="right carousel-control" href="#' . $id . '" data-slide="next">&rsaquo;</a>';
        $cache .= '</div>';
        return $cache;
    }

    /*
     * <div id="myCarousel" class="carousel slide">
      <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
     */function get_serial_key() {
        return 'bycreatedtushar';
    }/*
      </ol>
      <div class="carousel-inner">
      <div class="item active">
      <img src="<?php echo base_url() ?>resources/img/a.jpg" alt="">

      <div class="carousel-caption">
      <h4></h4>
      <p></p>
      </div>
      </div>
      <div class="item">
      <img src="<?php echo base_url() ?>resources/img/b.jpg" alt="">
      <div class="carousel-caption">
      <h4></h4>
      <p></p>
      </div>
      </div>
      <div class="item">
      <img src="<?php echo base_url() ?>resources/img/c.jpg" alt="">
      <div class="carousel-caption">
      <h4></h4>
      <p></p>
      </div>
      </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
      </div>
     */
}
