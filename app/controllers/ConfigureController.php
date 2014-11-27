<?php
class ConfigureController extends BaseController {
        /*
         * Get array value from query result
         */
        protected $result = array();
        
        /*
         * log user id as integer
        */
        protected $id;


        public function __construct() {
            if(Session::has('id')) {
                $this->id = Session::get('id');
                $segment = Request::segment(1);
            } else {
                $this->beforeFilter(function(){
                    return Redirect::to('login');
                });
            }
        }
        
    /*
     * Purpose: Configure panel
     * return view
     */
     public function configPanel(){
         return View::make('configManager.configurePanel');
     }
}
?>

