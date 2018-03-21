<?php
/**
 * Created by IntelliJ IDEA.
 * User: towerlau
 * Date: 2018/3/21
 * Time: 12:15
 */

class user_model extends LModel
{
    public function getX()
    {
        $query = $this->db->get('usr');
        return $query->result();
    }
}