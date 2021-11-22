<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Christian S Barbosa
 * @version : 0.1
 * @since : 01 janeiro 2020
 */
class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }

    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('login');
        }
        else
        {
            redirect('/dashboard');
        }
    }


    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('login', 'Login', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $login = strtolower($this->security->xss_clean($this->input->post('login')));
            $password = $this->input->post('password');

            $result = $this->login_model->loginMe($login, $password);

            if(!empty($result))
            {
                $lastLogin = $this->login_model->lastLoginInfo($result->userId);

                $sessionArray = array(
                    'userId'=>$result->userId,
                    'role'=>$result->roleId,
                    'roleText'=>$result->role,
                    'name'=>$result->name,
                    'lastLogin'=> $lastLogin->createdDtm,
                    'isLoggedIn' => TRUE);

                $this->session->set_userdata($sessionArray);

                unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                $loginInfo = array("userId"=>$result->userId, "sessionData" => json_encode($sessionArray),
                    "machineIp"=>$_SERVER['REMOTE_ADDR'],
                    "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(),
                    "platform"=>$this->agent->platform(), "createdDtm"=>date('Y-m-d h:i:sa'));

                $this->login_model->lastLogin($loginInfo);

                redirect('/dashboard');
            }
            else
            {
                $this->session->set_flashdata('error', 'Usuário ou senha não conferem');
                $this->index();
            }
        }
    }

    public function loginMeAD()
	{

        $this->load->library('form_validation');

        $this->form_validation->set_rules('login', 'Login', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $this->load->library('table');
            //BUSCA REGRAS DE ACESSO E PERMISSAO DO USUARIO NO SISTEMA
            $this->load->model('user_model');

            /*
            *receber os dados do usuario para testar acesso ao sistema
            *verificar se ele e da empresa ou se externo, se for da empresa
            *devera fazer acesso pelo ad se for externo deverá fazer acesso pelo banco
            *vamos comecar perguntando se o usuario e se ele e da empresa ou de fora.
            *O sistema somente permite um unico nome de login
            */

            $login = $this->input->post('login');
            $password = $this->input->post('password');
            "login - " .$login;
            "Pass - " .$password;

            $ldap_host = "ldap://nsv22.novacap.sede/";
            $ldap_host2 = "ldap://nsv23.novacap.sede/";
            $ldap_dn = "DC=novacap,DC=sede";
            $ldap_user_group = "CIASOPERADOR";
            $ldap_manager_group = "CIASADMIN";
            $ldap_usr_dom = '@novacap.sede';

            $access = 0;
            $email = null;
            $name = null;
            $mobile = null;
            $roleId = 0;
            $isDeleted = 0;
            $createdBy = 1; //usuario interno do sistema
            $createdDtm = date('Y-m-d H:i:s');
            $updatedBy = 1; //usuario interno do sistema
            $updatedDtm = date('Y-m-d H:i:s');
            $matricula = null;
            $setor = null;


            //Procura se existe algum usuario com este nome de login unico no banco
            $userData = $this->login_model->getUserInformationByLoginName($login);
            if(!empty($userData)){
                //caso exista o usuario, verificar se a senha e a mesma
                //echo "UserdataPassword = ".$userData->password;
                if(password_verify($password, $userData->password)){
                    //sendo igual a senha pode continuar com a autenticacao

                    $lastLogin = $this->login_model->lastLoginInfo($userData->userId);

                    $sessionArray = array (
                        'userId'=>$userData->userId,
                        'role'=>$userData->roleId,
                        'roleText'=>$userData->role,
                        'name'=>$userData->name,
                        'lastLogin'=> $lastLogin->createdDtm,
                        'isLoggedIn' => TRUE
                    );

                    $this->session->set_userdata($sessionArray);

                    unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                    $loginInfo = array("userId"=>$userData->userId, "sessionData" => json_encode($sessionArray),
                        "machineIp"=>$_SERVER['REMOTE_ADDR'],
                        "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(),
                        "platform"=>$this->agent->platform(), "createdDtm"=>date('Y-m-d h:i:sa'));

                    $this->login_model->lastLogin($loginInfo);

                    redirect('/dashboard');

                }else{
                    //sendo a senha diferente vamos testar autenticacao pelo AD.
                    //e caso nao seja a mesma do AD ae ele nao tera acesso ao sistema
                    //e devera falar com ASINF


                    $ldap = ldap_connect($ldap_host);

                    if($ldap == false)
                    {
                        $ldap = ldap_connect($ldap_host2);
                    }
                    else
                    {
                        // nao foi possivel usar o ldap servidor AD fora do ar
                        $this->session->set_flashdata('error', 'ERRO-02: . Servidor AD não pode ser conectado. Contacte a ASINF no ramal 2660.');
                        redirect('/login');
                    }

                    ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION,3);
                    ldap_set_option($ldap,LDAP_OPT_REFERRALS,0);

                    // verify login and password authentication no AD
                    if($bind = @ldap_bind($ldap, $login.$ldap_usr_dom, $password))
                    {
                        $filter = "(sAMAccountName=".$login.")";
                        $attr = array("displayName","description","cn","ou","dc","givenName","sn","mail","co","mobile","company","displayName","memberof");
                        $result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
                        $entries = ldap_get_entries($ldap, $result);

                        // echo '<pre>';
                        //     print_r($entries);
                        // echo '<pre/>';

                        ldap_unbind($ldap);



                        foreach($entries[0]['memberof'] as $grps)
                        {
                            if(strpos($grps, $ldap_manager_group))
                            {
                                $access = 1; //administrador
                                $roleId = 1;
                                break;
                            }
                            if(strpos($grps, $ldap_user_group))
                            {
                                $access = 2; //operador
                                $roleId = 2;
                            }
                        }

                        //echo "reoleId encontrado = ".$roleId;

                        for ($i=0; $i<$entries["count"]; $i++)
                        {
                            if ($login == 'teste.desenv') {
                                $email = 'teste.desenv@novacap.df.gov.br';
                            } else {
                                $email = $entries[$i]["mail"][0];
                            }

                            if ($login == 'myke.tyson') {
                                $email = 'myke.tysonv@novacap.df.gov.br';
                            }

                            // to show the attribute displayName (note the case!)
                            $name =  $entries[$i]["displayname"][0];
                            $setor_matricula = $entries[$i]["description"][0];
                            $setor_matricula =  explode(' ', $setor_matricula);
                            $setor = $setor_matricula[0];
                            $matricula = $setor_matricula[2];
                        }


                        if($email == null){
                            $this->session->set_flashdata('error', 'ERRO-03: Não foi possível prosseguir precisa de email cadastrado no AD. Para usar o sistema contacte a ASINF no ramal 2660.');
                            redirect('/login');
                        }

                        //monta array do usuario para atualizar no banco
                        $userInfo = array('login' => $login, 'email'=>$email,
                            'password'=>getHashedPassword($password),
                            'name'=> $name,
                            'roleId'=>$roleId,
                            'updatedBy' => $updatedBy, 'updatedDtm'=>$updatedDtm,
                            'matricula' => $matricula, 'setor' => $setor,
                            'empregado' => 1);

                        // altera os dados do usuario principalmente a senha
                        $result = $this->user_model->editUser($userInfo, $userData->userId);

                        if($result == true)
                        {
                            $lastLogin = $this->login_model->lastLoginInfo($userData->userId);

                            $sessionArray = array('userId'=>$userData->userId,
                                'role'=>$userData->roleId,
                                'perfil' => $access,
                                'roleText'=>$userData->role,
                                'name'=>$userData->name,
                                'lastLogin'=> $lastLogin->createdDtm,
                                'isLoggedIn' => TRUE,
                                'matricula' => $matricula,
                                'setor' => $setor);

                            $this->session->set_userdata($sessionArray);

                            unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                            $loginInfo = array("userId"=>$result->userId, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());

                            $this->login_model->lastLogin($loginInfo);
                            if ($access == 1) {
                                redirect('/dashboard');
                            }else{
                                redirect('/dashboard2');
                            }

                        }
                        else
                        {
                            $this->session->set_flashdata('error', 'ERRO-04: Não foi possível atualizar os dados usuário.
                                Assim não poderá acessar o sistema visto que sua senha foi alterada no AD.
                                Contacte a ASINF no ramal 2660.');
                            redirect('/login');
                        }

                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'ERRO-05: Acesso não autorizado! Nome e senha incorretos ou não consta a inclusão do servidor nos grupos de acesso. Contacte a ASINF no ramal 2660.');
                        redirect('/login');
                    }

                }
            }else{
                // nao foi encontrado no banco nenhum usuario com o nome de login
                // ae so resta ver se ele tem cadastro no ad e se esta em algum grupo
                // se ele tiver em grupo e no ad ae iremos inserir ele no sistema e
                //conceder acesso. Caso contrario sera informado de usuario nao existe

                $ldap = ldap_connect($ldap_host);

                if($ldap == false)
                {
                    $ldap = ldap_connect($ldap_host2);
                }

                if($ldap == false)
                {
                    // nao foi possivel usar o ldap servidor AD fora do ar
                    $this->session->set_flashdata('error', 'ERRO-02: . Servidor AD não pode ser conectado. Contacte a ASINF no ramal 2660.');
                    redirect('/login');
                }

                ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION,3);
                ldap_set_option($ldap,LDAP_OPT_REFERRALS,0);

                // print_r($ldap);
                // $bind = @ldap_bind($ldap, $login.$ldap_usr_dom, $password);
                // print_r($bind);
                // verify login and password authentication no AD
                if($bind = @ldap_bind($ldap, $login.$ldap_usr_dom, $password))
                {
                    $filter = "(sAMAccountName=".$login.")";
                    $attr = array("displayName","description","cn","ou","dc","givenName","sn","mail","co","mobile","company","displayName","memberof");
                    $result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
                    $entries = ldap_get_entries($ldap, $result);

                    // echo '<pre>';
                    //     print_r($entries);
                    // echo '<pre/>';

                    ldap_unbind($ldap);
                    foreach($entries[0]['memberof'] as $grps)
                    {
                        if(strpos($grps, $ldap_manager_group))
                        {
                            $access = 1; //administrador
                            $roleId = 1;
                            break;
                        }
                        if(strpos($grps, $ldap_user_group))
                        {
                            $access = 2; //operador
                            $roleId = 2;
                        }
                    }

                    //echo "reoleId encontrado = ".$roleId;

                    for ($i=0; $i<$entries["count"]; $i++)
                    {
                        if ($login == 'teste.desenv') {
                            $email = 'teste.desenv@novacap.df.gov.br';
                        } else {
                            $email = $entries[$i]["mail"][0];
                        }

                        if ($login == 'myke.tyson') {
                            $email = 'myke.tysonv@novacap.df.gov.br';
                        }

                        // to show the attribute displayName (note the case!)
                        $name =  $entries[$i]["displayname"][0];
                        $setor_matricula = $entries[$i]["description"][0];
                        $setor_matricula =  explode(' ', $setor_matricula);
                        $setor = $setor_matricula[0];
                        $matricula = $setor_matricula[2];
                    }


                    if($email == null){
                        $this->session->set_flashdata('error', 'ERRO-03: Não foi possível prosseguir precisa de email cadastrado no AD. Para usar o sistema contacte a ASINF no ramal 2660.');
                        redirect('/login');
                    }


                    //monta array do usuario
                    $userInfo = array('login' => $login, 'email'=>$email,
                        'password'=>getHashedPassword($password),
                        'name'=> $name, 'mobile'=> null,
                        'roleId'=>$roleId,
                        'createdBy'=>$createdBy, 'createdDtm'=>$createdDtm,
                        'matricula' => $matricula, 'setor' => $setor,
                        'empregado' => 1);

                    // inclui usuario do AD no banco de dados do sistema
                    $resultId = $this->user_model->addNewUser($userInfo);

                    if($resultId == true)
                    {

                        $userData = $this->login_model->getUserInformationByLoginName($login);

                        $sessionArray = array('userId'=>$resultId,
                            'role'=>$userData->roleId,
                            'perfil' => $access,
                            'roleText'=>$userData->role,
                            'name'=>$userData->name,
                            'lastLogin'=> $createdDtm,
                            'isLoggedIn' => TRUE,
                            'matricula' => $matricula,
                            'setor' => $setor);

                        $this->session->set_userdata($sessionArray);

                        unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                        $loginInfo = array("userId"=>$result->userId, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());

                        $this->login_model->lastLogin($loginInfo);
                        if ($access == 1) {
                            redirect('/dashboard');
                        }else{
                            redirect('/dashboard2');
                        }

                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'ERRO-04: Não foi possível atualizar os dados usuário.
                            Assim não poderá acessar o sistema visto que sua senha foi alterada no AD.
                            Contacte a ASINF no ramal 2660.');
                        redirect('/login');
                    }

                }
                else
                {
                    // $this->session->set_flashdata('error', 'ERRO-01: Usuário não está cadastrado no banco de dados. Contacte a ASINF no ramal 2660.');
                    // redirect('/login');
                }
            }
        }
    }
    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('forgotPassword');
        }
        else
        {
            redirect('/dashboard');
        }
    }

    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('login_email','Email','trim|required|valid_email');

        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else
        {
            $email = strtolower($this->security->xss_clean($this->input->post('login_email')));

            if($this->login_model->checkEmailExist($email))
            {
                $encoded_email = urlencode($email);

                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();

                $save = $this->login_model->resetPasswordUser($data);

                if($save)
                {
                    $data1['reset_link'] = base_url() . "resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);

                    if(!empty($userInfo)){
                        $data1["name"] = $userInfo->name;
                        $data1["email"] = $userInfo->email;
                        $data1["message"] = "Refaça sua senha";
                    }

                    $sendStatus = resetPasswordEmail($data1);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "Link para refazer a senha enviado , por favor confira seu email.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Falha ao enviar ao e-mail, tente novamente.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "Parece ter havido algum erro, tente novamente.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "Este e-mail não esta registrado.");
            }
            redirect('/forgotPassword');
        }
    }

    /**
     * This function used to reset the password
     * @param string $activation_id : This is unique id
     * @param string $email : This is user email
     */
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);

        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);

        $data['email'] = $email;
        $data['activation_code'] = $activation_id;

        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('/login');
        }
    }

    /**
     * This function used to create new password for user
     */
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = strtolower($this->input->post("email"));
        $activation_id = $this->input->post("activation_code");

        $this->load->library('form_validation');

        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');

        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');

            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);

            if($is_correct == 1)
            {
                $this->login_model->createPasswordUser($email, $password);

                $status = 'success';
                $message = 'Senha alterada com sucesso';
            }
            else
            {
                $status = 'error';
                $message = 'Não foi possível alterar a senha';
            }

            setFlashData($status, $message);

            redirect("/login");
        }
    }
}

?>
