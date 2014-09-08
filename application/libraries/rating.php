<?php
  class Rating {
    protected $_k;
    function __contruct ($k = 0)
    {
      $this->_k = $k;
    }
    public function set($a , $b)
    {
      if ($a == 0) $this->_k = 0;
      else if ($b == 0) $this->_k = 0;
      else $this->_k = $a / $b;
    }
    public function create_rate($k = 0,$class = '',$add = '') {
            $this->_k = $k;
          $div_class = 'rating';
          if ($class != '')$div_class .= ' '. $class;
          if (is_float ($this->_k)) {
              $this->_k = round($this->_k,1);
              $float = explode('.', $this->_k);
              $_float = end($float);
              $_int = $float[0];
              if ($_float > 2)$div_class .= ' r-'.$_int.'5';
          }
          $_int = isset($_int) ? $_int : $this->_k;
          $html = '<div class="'. $div_class . '">';          
          for($i = 5 ; $i > 0; $i --)
          {
            $html  .= '<span class="star empty';
              if ($i <= $_int) {
                $html .= ' filler';                
              }
              if (( $i == ($_int + 1)) && isset($_float) && $_float > 2) {
                $html .= ' haft-star';
                if ($_float < 5) $html .= ' haft-star-near';
                else $html .= ' haft-star-far';
              }
              if ($add != '') $html .=  ' ' . $add . '">';
              if ($add != 'filled') {
                $html .= '" id="rating_'.($i).'"';
                $html  .= ' onclick="rating('.($i).');">';
              }
              $html .= '</span>';          
          }
          $html .= '</div>';
        return $html;
    }
  }
  
?>