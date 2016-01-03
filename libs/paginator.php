<?php
/**
*@author  				The-Di-Lab
*@email   				thedilab@gmail.com
*@website 				www.the-di-lab.com
*@version               1.0
**/
class Paginator {		
		public $itemsPerPage;
		public $range;
		public $currentPage;
		public $total;
		public $textNav;
		private $_navigation;		
		private $_link;
		private $_pageNumHtml;
		private $_itemHtml;
        /**
         * Constructor
         */
        public function __construct($page)
        {
        	//set default values
        	$this->itemsPerPage = 10;
			$this->range        = 10;
			$this->currentPage  = 1;		
			$this->total		= 0;
			$this->textNav 		= false;
			$this->itemSelect   = array(10,25,50,100);			
			//private values
			$this->_navigation  = array(
					'next'=>'Next',
					'pre' =>'Pre',
					'ipp' =>'Item per page'
			);			
        	//$this->_link 		 = filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_STRING);
            $this->_link         = filter_var("http://".$_SERVER['HTTP_HOST']. '/oztinate/admin/'.$page, FILTER_SANITIZE_STRING);
            
        	$this->_pageNumHtml  = '';
        	$this->_itemHtml 	 = '';
        }
        
        /**
         * paginate main function
         * 
         * @author              The-Di-Lab <thedilab@gmail.com>
         * @access              public
         * @return              type
         */
		public function paginate()
		{
			//get current page
			if(isset($_GET['current'])){
				$this->currentPage  = $_GET['current'];		
			}			
			//get item per page
			if(isset($_GET['item'])){
				$this->itemsPerPage = $_GET['item'];
			}			
			//get page numbers
			$this->_pageNumHtml = $this->_getPageNumbers();			
			//get item per page select box
			$this->_itemHtml	= $this->_getItemSelect();	
		}
				
        /**
         * return pagination numbers in a format of UL list
         * 
         * @author              The-Di-Lab <thedilab@gmail.com>
         * @access              public
         * @param               type $parameter
         * @return              string
         */
        public function pageNumbers()
        {
        	if(empty($this->_pageNumHtml)){
        		exit('Please call function paginate() first.');
        	}
        	return $this->_pageNumHtml;
        }
        
        /**
         * return jump menu in a format of select box
         *
         * @author              The-Di-Lab <thedilab@gmail.com>
         * @access              public
         * @return              string
         */
        public function itemsPerPage()
        {          
        	if(empty($this->_itemHtml)){
        		exit('Please call function paginate() first.');
        	}
        	return $this->_itemHtml;	
        } 
        
       	/**
         * return page numbers html formats
         *
         * @author              The-Di-Lab <thedilab@gmail.com>
         * @access              public
         * @return              string
         */
        private function  _getPageNumbers()
        { 
            $html = '<div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate"><ul class="pagination">';
            
        	//previous link button
			if($this->textNav&&($this->currentPage>1)){
				$html .='<li><a href="'.$this->_link .'?current='.($this->currentPage-1).'"';
				$html .='>'.$this->_navigation['pre'].'</a></li>';
			}        	
        	//do ranged pagination only when total pages is greater than the range
        /*	if($this->total > $this->range){				
				$start = ($this->currentPage <= $this->range)?1:($this->currentPage - $this->range);
				$end   = ($this->total - $this->currentPage >= $this->range)?($this->currentPage+$this->range): $this->total;
        	}else{
        		$start = 1;
				$end   = $this->total;
        	}    */
      // echo $start.",".$end;
       //added by mufeed to avoid bug in range
                 $start = 1;
                $end   = $this->total/$this->itemsPerPage;
                if($this->total%$this->itemsPerPage>=1)
                    $end=$end+1;
        //end added by mufeed
                
        	//loop through page numbers
        	for($i = $start; $i <= $end; $i++){
					$html.='<li';
                    if($i==$this->currentPage){ $html.= " class='paginate_button active'";} else {$html.= " class='paginate_button'";}
                       $html.='><a href="'.$this->_link .'?current='.$i.'"';
					$html.='>'.$i.'</a></li>';
			}        	
        	//next link button
        	if($this->textNav&&($this->currentPage<$this->total)){
				$html .='<li><a href="'.$this->_link .'?current='.($this->currentPage+1).'"';
				$html .='>'.$this->_navigation['next'].'</a></li>';
			}
        	$html .= '</ul></div>';
        	return $html;
        }
		
        /**
         * return item select box
         *
         * @author              The-Di-Lab <thedilab@gmail.com>
         * @access              public
         * @return              string
         */
        private function  _getItemSelect()
        {
        	$items = '';
   			$ippArray = $this->itemSelect;   			
   			foreach($ippArray as $ippOpt){   
		    	$items .= ($ippOpt == $this->itemsPerPage) ? "<option selected value=\"$ippOpt\">$ippOpt</option>\n":"<option value=\"$ippOpt\">$ippOpt</option>\n";
   			}   			
	    	return "<label>".$this->_navigation['ipp']."</label>
	    	<select name=\"dataTables-example_length\" class=\"form-control input-sm\" onchange=\"window.location='$this->_link?current=1&item='+this[this.selectedIndex].value;return false\">$items</select>\n";   	
        }
}