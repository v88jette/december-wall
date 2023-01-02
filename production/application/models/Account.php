<?php

class Account extends CI_Model {

	public function process_login($data){
        $result = ['status' => true, 'result' => null, 'message' => ''];
        try{
            foreach($data as $key => $value){
                if ($this->security->xss_clean($value, TRUE) === FALSE){
                    throw new Exception('You enterned a suspicious input');
                }
            }
            
            if($data['email'] === ''){
                throw new Exception('Email is missing');
            }
            if(!preg_match(EMAIL_REGEX, $data['email'])){
                throw new Exception('Invalid email format');
            }
            if($data['password'] === ''){
                throw new Exception('Password is missing');
            }

            $query = "SELECT id, password FROM users WHERE email = ?";
            $query_result = $this->db->query($query, [$data['email']])->row_array();

            if(!$query_result){
                throw new Exception('No user account found');
            }

            $xpassword = md5($data['password'].SECRET_KEY);
            $password = $query_result['password'];
            if($password !== $xpassword){
                throw new Exception('Incorrect password');
            }

            $user_id = $query_result['id'];
            $result['result'] = $user_id;
        }catch(Exception $e){   
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
	}

	public function process_signup($data){
        $result = ['status' => true, 'result' => null, 'message' => ''];
        try{
            foreach($data as $key => $value){
                if ($this->security->xss_clean($value, TRUE) === FALSE){
                    throw new Exception('You enterned a suspicious input');
                }
            }
            if($data['fname'] === '' || strlen($data['fname']) < 2){
                throw new Exception('First name is missing or too short, at least 2 chars is required');
            }
            if(!preg_match(NAME_REGEX, $data['fname'])){
                throw new Exception('Invalid first name');
            }
            if($data['lname'] === '' || strlen($data['lname']) < 2){
                throw new Exception('Last name is missing or too short, at least 2 chars is required');
            }
            if(!preg_match(NAME_REGEX, $data['lname'])){
                throw new Exception('Invalid last name');
            }
            if($data['email'] === ''){
                throw new Exception('Email is missing');
            }
            if(!preg_match(EMAIL_REGEX, $data['email'])){
                throw new Exception('Invalid email format');
            }
            if($data['password'] === '' || strlen($data['password']) < 8){
                throw new Exception('Password is missing or too short, at least 8 chars is required');
            }
            if($data['confirm_password'] === '' || strlen($data['confirm_password']) < 8){
                throw new Exception('Confirm password is missing, at least 8 chars is required');
            }
            if($data['confirm_password'] !== $data['password']){
                throw new Exception('Confirm password and password must match');
            }
            
            $query = "SELECT id, password FROM users WHERE email = ?";
            $query_result = $this->db->query($query, [$data['email']])->row_array();

            if($query_result){
                throw new Exception('Email is already taken');
            }

            $password = md5($data['password'].SECRET_KEY);
            
            $insert_query = "INSERT INTO `wall`.`users` (`fname`, `lname`, `email`, `password`) VALUES (?, ?, ?, ?)";
            $run_query = $this->db->query($insert_query, [$data['fname'], $data['lname'], $data['email'], md5($data['password'].SECRET_KEY)]);
           
            if (!$run_query){
                throw new Exception('Failed to create a new user account');
            }

            $user_id = $this->db->insert_id();
            $result['result'] = $user_id;
        }catch(Exception $e){   
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
	}
}