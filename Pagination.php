<?php 

class Pagination extends Db{
    // The database connection
   
   private $_limit;
   private $_page;
   private $_bothSide;
   private $_total;
   private $_table;
   private $_perPage;
   private $_qry;
   public function __construct($pk,$table,$where="",$page_no,$both_side,$perPage) {

      $connection= $this-> connect();
      $this->_page=$page_no;
      $this->_bothSide=$both_side;
      $this->_perPage=$perPage;
      $this->_table=$this->dbPrefix().$table;
      $this->_qry=$sql="SELECT ".$pk." From ".$this->_table." where 1 && deleted='0'".$where;
      $result=$connection->query($sql);
    
       
       $this->_total = ceil($result->num_rows/$perPage);
        
   }
   public function total_row(){
   	return $this->_total;
   }
   public function getData( $page = 1 ,$sql="") {
    $limit=$this->_perPage;
    $connection = $this-> connect();
    $start=($page-1)*$limit;
    $sql.=" Limit $start,$limit";
    return $result=$connection->query($sql); 

   }

   public function createLinks( $links="") {

      $strt_num=$this->_page-$this->_bothSide;
      $end_num=$this->_page+$this->_bothSide;
      $total_page=$this->_total;
       $paginate_link='';
      if($total_page>1){
        if($strt_num<=0){
          $strt_num=1;
        } 
        if($end_num>=$total_page){
          $end_num=$total_page;
        }
       
        $prev_id=$this->_page-1;
        $next_id=$this->_page+1;
        // Start Pagination -->
        $paginate_link.='<div class="container pagination_container">';
        $paginate_link.='<div class="row">';
        $paginate_link.='<div class="col-lg-8 col-xs-12 col-md-8">';
        if($prev_id>0){
          $paginate_link.='<div class="pull-left"><a href="'.$links.'page='.$prev_id.'" class="prevnext"><i class="fa fa-angle-left"></i></a></div>';
        }
        
        $paginate_link.='<div class="pull-left">';
        $paginate_link.='<ul class="paginationforum">';
        for($i=$strt_num;$i<=$end_num;$i++){
          $active="";
          $link=' href="'.$links.'page='.$i.'"';
          if($i==$this->_page){
            $active=' class="active"';
            $link=' href="javascript:void(0);"';

          }
          
          $paginate_link.='<li><a '.$link.$active.'>'.$i.'</a></li>';
        }
        
        
        $paginate_link.='</ul>';
        $paginate_link.='</div>';
        if($next_id<=$total_page){
        $paginate_link.='<div class="pull-left"><a href="'.$links.'page='.$next_id.'" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>';
        }
        $paginate_link.='<div class="clearfix"></div>';
        $paginate_link.='</div>';
        $paginate_link.='</div>';
        $paginate_link.='</div>';
        // End Pagination -->
      }
      

      return $paginate_link;

   }
}
?>