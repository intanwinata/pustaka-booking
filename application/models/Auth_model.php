<?php
class Auth_model extends CI_Model 
{
	
	public function __construct()
	{
        parent::__construct();
	}
 
	function register($name,$email,$username,$password)
	{
		$data = [
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
		$this->db->insert('users',$data);
    }
    
    function login_user($username,$password)
	{
        $query = $this->db->get_where('users',array('username'=>$username)); // SELECT * FROM users WHERE username = "usernamenya"
        if($query->num_rows() > 0) // Ngecek jumlah data yang kita terima dari database
        {
            $data_user = $query->row(); // ngambil data paling atas
            
            if (password_verify($password, $data_user->password)) { // verifikasi password yang ada dari database
                $this->session->set_userdata('user_id',$data_user->id);
                $this->session->set_userdata('username',$username);
                $this->session->set_userdata('name',$data_user->name);
                $this->session->set_userdata('email',$data_user->email);
                $this->session->set_userdata('is_admin',$data_user->is_admin);
				$this->session->set_userdata('is_login',TRUE);
                return TRUE;
            } else {
                return FALSE; // Ternyata passwordnya ngga sesuai
            }
        }
        else
        {
            return FALSE; // Ternyata usernamenya ngga sesuai
        }
	}
	
    function cek_login()
    {
        if(!$this->session->userdata('is_login'))
        {
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('name');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('is_admin');
            $this->session->set_userdata('is_login',FALSE);
			redirect('auth/login');
        }
    }
}