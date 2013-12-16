<?php
/*
*	Model file "My_model" by M.Kazakov
*/
class My_model extends CI_Model{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    /************ BEGIN: new model ************/

    function freeQuery($que)
    {
        return $this->db->query($que);
    }

    function getCountRow($table)
    {
        return $this->db->get($table)
            ->num_rows();
    }

    function getFields($table,$fields,$where,$order,$sort,$limit,$offset)
    {
        $this->db->distinct()
            ->select($fields)
            ->from($table)
            ->where($where)
            ->order_by($order,$sort)
            ->limit($limit,$offset);
        return $this->db->get();
    }

    function autocomplete($table, $field ,$order, $sort, $match, $limit, $offset)
    {
        $this->db->distinct()
            ->select($field)
            ->from($table)
            ->like("name", $match, 'after')
            ->order_by($order,$sort)
            ->limit($limit,$offset);
        return $this->db->get();
    }

    function addRecord($table, $data)
    {
        $this->db->insert($table,$data);
    }

    function update($id,$table,$data)
    {
        $this->db->where('id', $id);
        $this->db->update($table,$data);
    }

    function delete($table,$where)
    {
        $this->db->delete($table,$where);
    }

    /************ END: new model ************/

    /************ begin: general function ************/

    /* user-func */
    function how_much()
    {
        $query = $this->db->query('SELECT * FROM user');
        $result = $query->num_rows();
        return $result;
    }

    function get_user_pswd($login)
    {
        $this->db->select('password');
        $this->db->where('login',$login);
        $this->db->limit(1);
        $result = $this->db->get('user');
        return $result;
    }

    function get_user_id($login)
    {
        $this->db->where('login',$login);
        $this->db->limit(1);
        $result = $this->db->get('user');
        return $result;
    }

    function get_user_data($id)
    {
        $this->db->where('id',$id);
        $this->db->limit(1);
        $result = $this->db->get('user');
        return $result;
    }

    function check_user_login($login)
    {
        $this->db->where('login',$login);
        $result = $this->db->get('user');
        return $result->num_rows();
    }


    /* parametr-func */
    function get_parametr_user($user_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->order_by("date", "desc");
        $result = $this->db->get('parametr');
        return $result;
    }

    function get_parametr_current($user_id)				//��������� �����������(�������) ���� ����������
    {
        $this->db->select_max('id','current');
        $this->db->where('user_id',$user_id);
        $result = $this->db->get('parametr');
        return $result;
    }

    /* dish-func */
    function get_dish_eating($eat_id) //get �� eat_id
    {
        $this->db->where('eating_id',$eat_id);
        $this->db->order_by('time','asc');
        $result = $this->db->get('dish');
        return $result;
    }

    function get_pitanie_view($user_id, $type, $begin, $end)
    {
        $this->db->where('user_id',$user_id);
        if($type)$this->db->where('type',$type);
        $this->db->where('date >=', $begin);
        $this->db->where('date <=',$end);
        $this->db->order_by('date','desc');
        $result = $this->db->get('dish');
        return $result;
    }

    function get_sport_pitanie_view($user_id, $type, $begin, $end)
    {
        $type = "sport";
        $this->db->where('user_id',$user_id);
        $this->db->where('type',$type);
        $this->db->where('datetime >=', $begin);
        $this->db->where('datetime <=',$end);
        $this->db->order_by('datetime','desc');
        $result = $this->db->get('dish');
        return $result;
    }

    function get_sup_pitanie_view($user_id, $type, $begin, $end)
    {
        $type = "sup";
        $this->db->where('user_id',$user_id);
        $this->db->where('type',$type);
        $this->db->where('datetime >=', $begin);
        $this->db->where('datetime <=',$end);
        $this->db->order_by('datetime','desc');
        $result = $this->db->get('dish');
        return $result;
    }

    /* lifestyle-func */
    function get_lifestyle_user($user_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->order_by("date", "desc");
        $result = $this->db->get('lifestyle');
        return $result;
    }

    function get_lifesyle_over_period($user_id,$begin, $end)
    {
        $this->db->where('user_id',$user_id);
        $this->db->where('date >=',$begin);
        $this->db->where('date <=',$end);
        $result = $this->db->get('lifestyle');
        return $result;
    }

    function get_lifestyle_current($user_id)				//��������� �����������(�������) ���� ����������
    {
        $this->db->select_max('id','current');
        $this->db->where('user_id',$user_id);
        $result = $this->db->get('lifestyle');
        return $result;
    }

    /* cycle-func */
    function get_last_cycle_user($user_id)		//get �� ���� id
    {
        $this->db->select_max('id');
        $this->db->where('user_id',$user_id);
        $result = $this->db->get('cycle');
        return $result;
    }

    function get_cycle_user_over_period($user_id, $begin, $end)	//get �� ���� id �� ������
    {
        $this->db->where('user_id',$user_id);
        $this->db->where('start >=',$begin);
        $this->db->where('start <=',$end);
        $result = $this->db->get('cycle');
        return $result;
    }

    function get_cycle_id_user_over_period($user_id, $begin, $end)	//get ������ cycle_id, start, end �� ���� id �� ������
    {
        $this->db->select('id,start,end');
        $this->db->where('user_id',$user_id);
        $this->db->where('start >=',$begin);
        $this->db->where('start <=',$end);
        $result = $this->db->get('cycle');
        return $result;
    }

    /* training-func */
    function get_training_user($user_id) 		//get �� user_id
    {
        $this->db->where('user_id',$user_id);
        $result = $this->db->get('training');
        return $result;
    }

    function get_training_cycle($cycle_id) 		//get �� cycle_id
    {
        $this->db->where('cycle_id',$cycle_id);
        $result = $this->db->get('training');
        return $result;
    }

    function get_training_cycle_over_period($cycle_id,$begin, $end) //get �� cycle_id �� ������
    {
        $this->db->where('cycle_id',$cycle_id);
        $this->db->where('date >=',$begin);
        $this->db->where('date <=',$end);
        $result = $this->db->get('training');
        return $result;
    }

    function get_training_over_period($user_id,$type,$begin,$end)
    {
        $this->db->where('user_id',$user_id);
        $this->db->where('date >=',$begin);
        $this->db->where('date <=',$end);
        $this->db->order_by('date','desc');
        $result = $this->db->get('training');
        return $result;
    }

    /* foto-func */
    function get_foto_user($user_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->order_by("date", "desc");
        $result = $this->db->get('foto');
        return $result;
    }

    function get_foto_over_period($user_id,$begin, $end)
    {
        $this->db->where('user_id',$user_id);
        $this->db->where('date >=',$begin);
        $this->db->where('date <=',$end);
        $result = $this->db->get('foto');
        return $result;
    }

    /************ end: general function ************/

    /************ begin: dictionary functions ************/

    /* caloric content */
    function get_calor_content()
    {
        $this->db->distinct();
        $result = $this->db->get('static_calor_content');
        return $result;
    }

    function autocomplete_food($match)
    {
        $this->db->like('name', $match, 'after');
        $this->db->limit(10);
        $result = $this->db->get('static_calor_content');
        return $result;
    }


    function get_calor_content_key($key)
    {
        $this->db->distinct();
        $this->db->like('name',$key,'after');
        $result = $this->db->get('static_calor_content');
        return $result;
    }

    function insert_calor_content($data)
    {
        $this->db->insert('static_calor_content', $data);
    }

    /* caloric expense */
    function get_calor_expense($limit,$offset)
    {
        $this->db->distinct();
        $result = $this->db->get('static_calor_expense',$limit,$offset);
        return $result;
    }

    function get_calor_expense_key($key)
    {
        $this->db->distinct();
        $this->db->like('doing',$key,'after');
        $result = $this->db->get('static_calor_expense');
        return $result;
    }

    function insert_calor_expense($data)
    {
        $this->db->insert('static_calor_expense', $data);
    }

    /* vitamins content */
    function get_vitamins_content($limit,$offset)
    {
        $this->db->distinct();
        $result = $this->db->get('static_vitamins_content',$limit,$offset);
        return $result;
    }

    function get_vitamins_content_key($key)
    {
        $this->db->distinct();
        $this->db->like('name',$key,'after');
        $result = $this->db->get('static_vitamins_content');
        return $result;
    }

    function insert_vitamins_content($data)
    {
        $this->db->insert('static_vitamins_content', $data);
    }

    /* exercise dict */
    function get_exercise($limit,$offset)
    {
        $this->db->distinct();
        $result = $this->db->get('static_exercise',$limit,$offset);
        return $result;
    }

    function autocomplete_exercise($match)
    {
        $this->db->like('name', $match, 'after');
        $this->db->limit(10);
        $result = $this->db->get('static_exercise');
        return $result;
    }

    function insert_exercise($data)
    {
        $this->db->insert('static_exercise', $data);
    }
    /************ end: dictionary function ************/


    /************ begin: getter-functions ************/

    function get_user()
    {
        $result = $this->db->get('user');
        return $result;
    }

    function get_parametr()
    {
        $result = $this->db->get('parametr');
        return $result;
    }

    function get_private_score()
    {
        $result = $this->db->get('private_score');
        return $result;
    }

    function get_eating()
    {
        $result = $this->db->get('eating');
        return $result;
    }

    function get_dish()
    {
        $result = $this->db->get('dish');
        return $result;
    }

    function get_lifestyle()
    {
        $result = $this->db->get('lifestyle');
        return $result;
    }

    function get_cycle()
    {
        $result = $this->db->get('cycle');
        return $result;
    }

    function get_training()
    {
        $result = $this->db->get('training');
        return $result;
    }

    function get_foto()
    {
        $result = $this->db->get('foto');
        return $result;
    }
    /************ end: getter-functions ************/

    /************ begin: insert-functions ************/
    function insert_user($data)
    {
        $this->db->insert('user', $data);
    }

    function insert_parametr($data)
    {
        $this->db->insert('parametr', $data);
    }

    function insert_private_score($data)
    {
        $this->db->insert('private_score', $data);
    }

    function insert_eating($data)
    {
        $this->db->insert('eating', $data);
    }

    function insert_dish($data)
    {
        $this->db->insert('dish', $data);
    }

    function insert_lifestyle($data)
    {
        $this->db->insert('lifestyle', $data);
    }

    function insert_cycle($data)
    {
        $this->db->insert('cycle', $data);
    }

    function insert_training($data)
    {
        $this->db->insert('training', $data);
    }

    function insert_foto($data)
    {
        $this->db->insert('foto',$data);
    }
    /************ end: insert-functions ************/

    /************ begin: delete_functions ************/
    function delete_user($id)
    {
        $this->db->delete('user', array('id' => $id));
    }

    function delete_parametr($id)
    {
        $this->db->delete('parametr', array('id' => $id));
    }

    function delete_private_score($id)
    {
        $this->db->delete('private_score', array('id' => $id));
    }

    function delete_eating($id)
    {
        $this->db->delete('eating', array('id' => $id));
    }

    function delete_dish($id)
    {
        $this->db->delete('dish', array('id' => $id));
    }

    function delete_lifesyle($id)
    {
        $this->db->delete('lifesyle', array('id' => $id));
    }

    function delete_cycle($id)
    {
        $this->db->delete('cycle', array('id' => $id));
    }

    function delete_training($id)
    {
        $this->db->delete('training', array('id' => $id));
    }

    function delete_foto($id)
    {
        $this->db->delete('foto',array('id'=>$id));
    }
    /************ end: delete_functions ************/

}
/* End of file model0.php */
/* Location: ./application/models/model0.php */