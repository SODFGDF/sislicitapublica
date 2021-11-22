<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : User_model (User Model)
 * User model class to get to handle user related data
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Licita_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

     function getModalidades()
     {
         $this->db->select('*');
         $this->db->from('AuxLicitacaoModalidade');
         $this->db->order_by('Descricao', 'ASC');
         //$this->db->where('roleId !=', 1);
         $query = $this->db->get();
         return $query->result();
     }

     function getDiretorias()
     {
         $this->db->select('*');
         $this->db->from('AuxOrganizacional');
         $this->db->order_by('Descricao', 'ASC');
         $this->db->where('Tipo', 0);
         $query = $this->db->get();
         return $query->result();
     }

     function getSessoes()
     {
         $this->db->select('*');
         $this->db->from('AuxOrganizacional');
         $this->db->order_by('Sigla', 'ASC');
         $this->db->where('Tipo', 3);
         $query = $this->db->get();
         return $query->result();
     }

     function getLicitacaoIndex()
     {
         $this->db->select('*');
         $this->db->from('vw_totalizacertames');
         //$this->db->where('Tipo > 0');
         $this->db->order_by('Descricao', 'ASC');
         $query = $this->db->get();
         return $query->result();
     }

     function getFasesLote()
     {
         $this->db->select('*');
         $this->db->from('licita.auxfaselote');
         $this->db->order_by('Descricao', 'ASC');
         $query = $this->db->get();
         return $query->result();
     }

     function getEmpresa()
     {
         $this->db->select('*');
         $this->db->from('vw_empresas');
         $this->db->order_by('RazaoSocial', 'ASC');
         $query = $this->db->get();
         return $query->result();
     }

     /**
      * This function is used to add new user to system
      * @return number $insert_id : This is last inserted id
      */
     function addNewLicita($licitaInfo)
     {
         $this->db->trans_start();
         $this->db->insert('licita.licitacao', $licitaInfo);
         $insert_id = $this->db->insert_id();
         $this->db->trans_complete();
         return $insert_id;
     }

     function UpdateLicita($licitaInfo,$licitacaoid)
     {
         $this->db->where('Id', $licitacaoid);
         $this->db->update('licita.licitacao', $licitaInfo);
         return TRUE;
     }

     function addNewAnexo($anexoInfo)
     {
         $this->db->trans_start();
         $this->db->insert('licita.anexos', $anexoInfo);
         $insert_id = $this->db->insert_id();
         $this->db->trans_complete();
         return $insert_id;
     }
     
     function addNewLote($loteInfo)
     {
         $this->db->trans_start();
         $this->db->insert('licita.lotes', $loteInfo);
         $insert_id = $this->db->insert_id();
         $this->db->trans_complete();
         return $insert_id;
     }


     function licitaModalidade($ModTipoId)
     {
   	    $this->db->query('SET ANSI_NULLS ON');
   	    $this->db->query('SET ANSI_WARNINGS ON');
   	    $sql = "Select * from vw_licitacoes where ModalidadeId=$ModTipoId order by Ano desc, Visivel, Numero desc";
   	    $query = $this->db->query($sql);
   	    return $query->result();
   	}

    function licitaModalidadeVisivel($ModTipoId)
    {
   	    $this->db->query('SET ANSI_NULLS ON');
   	    $this->db->query('SET ANSI_WARNINGS ON');
   	    $sql = "Select * from vw_licitacoes where ModalidadeId=$ModTipoId and Visivel = 1 order by Ano desc, Visivel, Numero desc";
   	    $query = $this->db->query($sql);
   	    return $query->result();
    }

    function licitaModalidadeVisiveltot($ModTipoId)
    {
   	    $this->db->query('SET ANSI_NULLS ON');
   	    $this->db->query('SET ANSI_WARNINGS ON');
   	    $sql = "Select * from vw_licitacoes where ModalidadeId=$ModTipoId and Visivel = 1;";
   	    $query = $this->db->query($sql);
   	    return $query->num_rows();
    }	

    function licitaModalidadeById($Id)
     {
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "Select * from vw_busca where Id=$Id order by Ano desc, Visivel, Numero desc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getCertameInfo($CertameId)
    {
       $this->db->query('SET ANSI_NULLS ON');
       $this->db->query('SET ANSI_WARNINGS ON');
       $sql = "Select * from licita.licitacao where Id=$CertameId";
       $query = $this->db->query($sql);
       return $query->result();
     }

     function getAnexoFTP($CertameId)
     {
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "Select * from licita.anexos where LicitacaoId=$CertameId Order by InclusaoData Desc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getLotes($CertameId)
    {
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "Select * from licita.lotes where LicitacaoId=$CertameId";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function geTramitacoes($CertameId)
    {
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "Select * from licita.tramitacao where LicitacaoId=$CertameId";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function anexoDetalhe($anexoId)
    {
       $this->db->query('SET ANSI_NULLS ON');
       $this->db->query('SET ANSI_WARNINGS ON');
       $sql = "Select * from licita.anexos where Id=$anexoId";
       $query = $this->db->query($sql);
       return $query->result();
   }

   function deleteAnexo($anexoId)
   {
        $this->db->where('Id', $anexoId);
        $this->db->delete('licita.anexos');
   }

   function alteraStatus($licitaId,$visivel)
   {
        $data = array(
            'Visivel' => $visivel
        );
        $this->db->set($data);
        $this->db->where('Id', $licitaId);
        $this->db->update('licita.licitacao');  
   }
















    // function getUserInfoWithRole($userId)
    // {
    //     $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.login, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
    //     $this->db->from('tbl_users as BaseTbl');
    //     $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
    //     $this->db->where('BaseTbl.userId', $userId);
    //     $this->db->where('BaseTbl.isDeleted', 0);
    //     $query = $this->db->get();
    //
    //     return $query->row();
    // }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function licitaListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.login, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, BaseTbl.isDeleted, BaseTbl.createdBy, BaseTbl.createdDtm, BaseTbl.updatedBy, BaseTbl.updatedDtm, BaseTbl.matricula, BaseTbl.setor, BaseTbl.empregado,
            Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.userId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }


    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('userId, name, login, email, mobile, roleId, matricula, setor, empregado');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();

        return $query->row();
    }


    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);

        return TRUE;
    }



    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);

        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);

        return $this->db->affected_rows();
    }


    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     */
    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function used to get user information by id with role
     * @param number $userId : This is user id
     * @return aray $result : This is user information
     */
    function getUserInfoWithRole($userId)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.login, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->row();
    }

}
