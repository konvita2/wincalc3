<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller {

    public function __construct(){
        parent::__construct();

    }

    // @todo remap

    public function index(){
        $this->load->view('price/index');
    }

    /**
     * загрузить csv с ценами для глухого окна без СП
     */
    public function glload(){

        $cfg['upload_path'] = './uploads/';
        $cfg['allowed_types'] = 'csv';
        $cfg['max_size'] = '2000000';

        $this->load->library('upload', $cfg);

        if(!$this->upload->do_upload()){
            $data['errors'] = $this->upload->display_errors();
            $this->load->view('price/load', $data);
        }
        else{
            $fdata = $this->upload->data();
            $data['upload_data'] = $fdata;
            //
            $fullpath = $fdata['full_path'];

            //
            $resar = array();

            // read csv
            if(($fh = fopen($fullpath, 'r')) !== FALSE){
                while(($csv = fgetcsv($fh, 1000, ";")) !== FALSE) {
                    if($csv[0] == 'w') continue;

                    $csv_ready = array(
                        'w' => $csv[0],
                        'h' => $csv[1],
                        'p' => $csv[2],
                    );

                    $resar[] = $csv_ready;
                }
                fclose($fh);
            }

            $resar = $this->mycsv->prep_data_gluh($resar);
            $data['csv'] = $resar;

            $dt = date('Ymd');

            $this->load->model('Price_gluh_model', 'price');
            $this->price->add_array_by_date($dt, $resar);

            $this->load->view('price/glok', $data);
        }

    }

    /**
     *
     */
    public function load(){
        $data['errors'] = '';
        $this->load->view('price/load', $data);
    }


} 