<?php

class Calculator extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(['datatables']);
        if(!$this->session->userdata('isLogin')) redirect ('user/login');
        $this->load->model(array(
            'Bank_m',
            'Product_m',
            'Insurance_type_m',
            'Underwriting_m',
            'Benefit_type_m',
            'Benefit_product_m',
            'Rate_m'
            ));
    }

    public function index(){         
        $this->data['title_1']                        =   "Kalkulator";
        $this->data['title_2']                        =   "Simulasi Kredit";
        $this->data['get_bank']                       =   $this->Bank_m->getAll();
        $this->data['get_insurance_type']             =   $this->Insurance_type_m->getAll();
        $this->data['getBenefitType']                 =   $this->Benefit_type_m->getAll();
        $this->data['val_product']                    =   $this->Product_m->getByBankId(10);
        $this->data['content']                        =   $this->load->view('calculator/form',$this->data,TRUE);
        $this->load->view('layout/main',$this->data);
    }

    public function detail(){
        if($this->input->post('submit')){
            $this->data['title_1']                      = "Kalkulator";
            $this->data['title_2']                      = "Simulasi Kredit";

            $bank_id        = $this->input->post('bank_id');
            $sum_insured    = $val_clean = str_replace('.', '', $this->input->post('sum_insured'));
            // PRODUCT
            $val_product    = $this->Product_m->getByBankId($bank_id);
            $product_id     = $val_product->product_id;
            // END PRODUCT
            // COUNT AGE
            $datebirth      = date('Y-m-d', strtotime($this->input->post('datebirth')));
            $period_start   = date('Y-m-d', strtotime($this->input->post('period_start')));
            $age            = round((strtotime($period_start) - strtotime($datebirth))/(24*60*60*365.25));
            // END COUNT AGE
            // COUNT PERIOD END
            $period     = $this->input->post('period');
            $period_end = date('Y-m-d', strtotime('+'.$period.' years', strtotime($this->input->post('period_start'))));
            // END COUNT PERIOD END
            // UNDREWRITING
            $val_underwriting   = $this->Underwriting_m->get($sum_insured, $age, $product_id);
            $underwriting       = $val_underwriting->underwriting;
            $underwriting_type  = $val_underwriting->underwriting_type;
            $underwriting_id    = $val_underwriting->underwriting_id;
            // END UNDREWRITING
            // BENEFIT
            $benefit_count = $this->input->post('benefit_id');
                foreach ($benefit_count as $selected_benefit) {
                    # code...
                    // RATE AND PREMI
                    $val_rate   = $this->Rate_m->get($period, $age, $product_id, $selected_benefit, $this->input->post('insurance_type_id'));
                    $rate       = $val_rate->rate;
                    $premi      = ($rate / 1000) * $sum_insured;
                    $rate_id    = $val_rate->rate_id;
                    // END RATE AND PREMI
                }
            // END BENEFIT
            
            $this->data['get_bank']                     = $this->Bank_m->getById($bank_id);
            $this->data['get_product']                  = $this->Product_m->getByBankId($bank_id);
            $this->data['get_insurance_type']           = $this->Insurance_type_m->getById($this->input->post('insurance_type_id'));
            $this->data['debitur_name']                 = $this->input->post('debitur_name');
            $this->data['datebirth']                    = $this->input->post('datebirth');
            $this->data['period']                       = $this->input->post('period');
            $this->data['sum_insured']                  = $this->input->post('sum_insured');
            $this->data['period_start']                 = $period_start;
            $this->data['period_end']                   = $period_end;
            $this->data['age']                          = $age;
            $this->data['rate']                         = $rate;
            $this->data['premi']                        = $premi;
            $this->data['underwriting_type']            = $underwriting_type;
            $this->data['content']                      = $this->load->view('calculator/form_detail',$this->data,TRUE);
            $this->load->view('layout/main',$this->data);
        } else {
            redirect('calculator');
        }
    }
}