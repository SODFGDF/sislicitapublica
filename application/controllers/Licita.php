<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Christian S Barbosa
 * @version : 0.1
 * @since : 02 Janeiro 2020
 */
class Licita extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('user_model');
        $this->load->model('Licita_model');
        //$this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
     public function index()
     {
        $this->load->library('pagination');
        $data['LicitacaoIndex'] = $this->Licita_model->getLicitacaoIndex();
        $this->global['pageTitle'] = 'NOVACAP : Dashboard Administrador';
        $this->loadViews("dashboard",$data);
     }

    function LicitaListing()
    { 
        $ModTipoId = $this->uri->segment(2);
        //$searchText = $this->security->xss_clean($this->input->post('searchText'));
        //$data['searchText'] = $searchText;

        $this->load->library('pagination');
        $data['Modalidades'] = $this->Licita_model->getModalidades();
        $data['LicitaModalidade'] = $this->Licita_model->licitaModalidadeVisivel($ModTipoId);
        $data['totLicitaModalidade'] = $this->Licita_model->licitaModalidadeVisiveltot($ModTipoId);
        foreach($data['LicitaModalidade'] as $item){
            $Modalidade = $item->ModalidadeId;
            foreach($data['Modalidades'] as $it){
                if($it->Id==$Modalidade){
                    $data['Modalidade'] = $it->Descricao;
                }       
            }         
        }            
        $this->loadViewsListing("licitacoes",$data);
    }

    function licitadetail()
    {
        $CertameId = $this->uri->segment(2); //CUIDADO, A DECLARAÇÃO NA ROTA INFLUENCIA NO SEGUIMENTO.
        $data["CertameInfo"] = $this->Licita_model->licitaModalidadeById($CertameId);
        $data["AnexoFTP"] = $this->Licita_model->getAnexoFTP($CertameId);
        $data["Lotes"] = $this->Licita_model->getLotes($CertameId);
        $data["Tramitacoes"] = $this->Licita_model->geTramitacoes($CertameId);
        //$data['Diretorias'] = $this->Licita_model->getDiretorias();
        $data['AuxLoteFases'] = $this->Licita_model->getFasesLote();
        $data['Empresas'] = $this->Licita_model->getEmpresa();
        $data['Sessoes'] = $this->Licita_model->getSessoes();
        $data['Modalidades'] = $this->Licita_model->getModalidades();
        $this->global['pageTitle'] = 'NOVACAP : Detalhamento de certame';
        $this->loadViews("certamedetail", $this->global, $data, NULL);
    }

    function download($licitacaoId, $fileName = NULL) {   
        if ($fileName) {
            $structure = 'E:/arquivos/';
            $struture = '//NOVACAPSV002/arquivos$'.DIRECTORY_SEPARATOR;
            $file = realpath ( $struture ) . "\\" . $fileName;

            //check file exists    
            if (file_exists ( $file )) {
                // get file content
                $data = file_get_contents ( $file );

                //force download
                force_download ( $fileName, $data);
            } else {
             // Redirect to base url
             redirect('licitadetail/'.$licitacaoid); //Deve apontar para ... verificar
            }
       }
    }

    function downloadbase() {  
        $fileName = 'manual_cadastro.rar'; 
        if ($fileName) {
            $structure = 'E:/arquivos/';
            $struture = '//NOVACAPSV002/arquivos$'.DIRECTORY_SEPARATOR;
            $file = realpath ( $struture ) . "\\" . $fileName;

            //check file exists    
            if (file_exists ( $file )) {
                // get file content
                $data = file_get_contents ( $file );

                //force download
                force_download ( $fileName, $data);
            } else {
             // Redirect to base url
             redirect('index'); //Deve apontar para ... verificar
            }
       }
    }

}
?>
