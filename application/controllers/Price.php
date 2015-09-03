<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller {

    public function __construct(){
        parent::__construct();

    }

    /*
     * restrict access
     */
    public function _remap($method, $params = array()){
        if(!$this->ion_auth->logged_in()){  // @todo add admin priv-s checking
            redirect('admin/required', 'refresh');
        }
        else{
            if($method == 'index'){
                $this->index();
            }
            elseif($method == 'glload'){
                $this->glload();
            }
            elseif($method == 'filtergl'){
                $this->filtergl();
            }
            elseif($method == 'load'){
                $this->load();
            }
            elseif($method == 'afilter'){
                $this->afilter();
            }
            elseif($method == 'showgl'){
                $this->showgl();
            } //@todo add other options...
        }
    }

    public function index(){
        $this->load->view('price/index');
    }

    /**
     * open index-like page with ajax filter
     */
    public function filtergl(){
        $this->load->model('Profil_model', 'profil');

        $attr = array(
            'id'=>'profil'
        );

        $data['select'] = $this->profil->get_html_select($attr);
        $this->load->view('price/filter', $data);
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

            $profil_sym = $this->input->post('profil');

            $this->load->model('Price_gluh_model', 'price');
            $this->price->add_array_by_date($dt, $resar, $profil_sym);

            $this->load->model('Profil_model', 'profil');
            $data['profil_description'] = $this->profil->get_description_by_sym($profil_sym);
            $this->load->view('price/glok', $data);
        }

    }

    /**
     *
     */
    public function load(){
        $this->load->model('Profil_model', 'profil');
        $prof = $this->profil->get_all();

        $data['errors'] = '';
        $data['profil'] = $prof;
        $this->load->view('price/load', $data);
    }

    /**
     * показать таблицу цен для глухого окна
     */
    public function showgl(){
        $this->load->model('Price_gluh_model', 'price');
        $data['rows'] = $this->price->get_all();
        $this->load->view('price/showgl',$data);
    }

    /* --------------------
     * AJAX
     * */
    public function afilter(){
        $resar = array();
        $profil_sym = $this->input->post('profil_sym');

        $this->load->model('Price_gluh_model', 'price');
        $rows = $this->price->get_all_by_profil($profil_sym);

        // get profil description
        $this->load->model('Profil_model', 'profil');
        $profil_desc = $this->profil->get_description_by_sym($profil_sym);

        $resar["profil"] = $profil_desc;
        $resar["table"] = $rows;

        echo json_encode($resar);
    }


} 