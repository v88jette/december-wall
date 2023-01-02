<?php

class Reply extends CI_Model {

    public function create($user_id, $reply){
        try{
            $result = ['status'=>true, 'result'=>[], 'message'=>''];

            if ($reply['post_id'] === '' || !is_int((int)$reply['post_id'])){
                throw new Exception('No post found or post is invalid');
            }
            if ($reply['content'] === '' || strlen($reply['content']) < 5){
                throw new Exception('Content is missing or too short, it must have at least 5 characters.');
            }
            if ($this->security->xss_clean($reply['content'], true) === false){
                throw new Exception('Cannot process, suspicious input detected.');
            }

            $insert_query = "INSERT INTO `replies` (`user_id`, `post_id`, `content`) VALUES (?, ?, ?)";
            $query_result = $this->db->query($insert_query, [$user_id, $reply['post_id'], $reply['content']]);

            if (!$query_result){
                throw new Exception('Failed to add new reply');
            }

            $result['result'] = $query_result;
        }catch(Exception $e){
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
    }

    public function destroy($reply_id){
        try{
            $result = ['status'=>true, 'result'=>[], 'message'=>''];
            
            $delete_reply = "DELETE FROM `replies` WHERE (`id` = ?)";
            $query_reply_result = $this->db->query($delete_reply, $reply_id);

            if (!$query_reply_result){
                throw new Exception('Failed to delete reply');
            }

            $result['result'] = $query_reply_result;
        }catch(Exception $e){
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
    }

}