<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_model extends CI_Model{

    public function getPurchaseDetailInfo(){
        $this->db->select('*');
        $this->db->from("purchase_searcher");
        $query = $this->db->get();  
        //$query = $this->db->limit('10',$this->uri->segment(3))->get();
        return $query->result();
    }
    public function getPurchaseEditInfo($purchase_id){ //EDIT FOR Purchase Details
        $this->db->select("*");
        $this->db->from("tbl_purchase_order");
        $this->db->where("purchase_id",$purchase_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function getPurchaseDetailEditInfo($purchase_id){ //EDIT FOR Purchase Details
        $this->db->select("*");
        $this->db->from("tbl_purchase_detail");
        $this->db->where("purchase_id",$purchase_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getDetailedView($purchase_id){
        $this->db->select('*');
        $this->db->from("purchase_detailed_view");
        $this->db->where("purchase_id",$purchase_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getPayment($purchase_id){
        $this->db->select('*');
        $this->db->from("tbl_purchase_order");
        $this->db->where("purchase_id",$purchase_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function getPurchaseOrderInfo(){
        $this->db->select("(MAX(purchase_id)+1) as cavins");
        $this->db->from("tbl_purchase_order");
        $query = $this->db->get();
        return $query->result();
    }
    public function getSupplierInfo(){
        $this->db->select("*");
        $this->db->from("tbl_supplier");
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getProductInfo(){
        $this->db->select("*");
        $this->db->from("tbl_product");
        $query = $this->db->get();
        return $query->result();
    }
    
    public function search_order($searchorder){
        $query = $this->db->query("Select * from purchase_searcher where Date_Ordered like '%$searchorder%' or supplier_name like '%searchorder%' or product_name like '%$searchorder%'");
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            $query = $this->db->query("Select * from purchase_searcher where supplier_name like '%$searchorder%'");
            if($query->num_rows()>0){
                return $query->result();
            }
            else{
                $query = $this->db->query("Select * from purchase_searcher where product_name like '%$searchorder%'");
                if($query->num_rows()>0){
                    return $query->result();
                }
                else{
                    $query = $this->db->query("Select * from purchase_searcher where purchase_id like '%$searchorder%'");
                    if($query->num_rows()>0){
                        return $query->result();
                    }
                    else{
                        $query = $this->db->query("Select * from purchase_searcher where total_amount like '%$searchorder%'");
                        if($query->num_rows()>0){
                            return $query->result();
                        }
                        else{
                            $query = $this->db->query("Select * from purchase_searcher where total_payment like '%$searchorder%'");
                            if($query->num_rows()>0){
                                return $query->result();
                            }
                            else{
                                $query = $this->db->query("Select * from purchase_searcher where total_balance like '%$searchorder%'");
                                if($query->num_rows()>0){
                                    return $query->result();
                                }
                                else{
                                    return $query->result();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function unpaid(){
        $this->db->select("*");
        $this->db->from("purchase_searcher");
        $this->db->where('total_balance >', '0');
        $query = $this->db->get();
        return $query->result();
    }
    public function paying($purchase_id){
        
        $total_balance = $_POST['total_balance'];
        $this->db->query("UPDATE tbl_purchase_order SET total_balance = '$total_balance' where purchase_id ='$purchase_id'");
        $query= $this->db->query("CALL updatetotal('$purchase_id')");
        return $purchase_id;
    }
    public function filter_date($from_date,$to_date){
        $query = $this->db->query("SELECT * FROM `purchase_searcher` WHERE `Date_Ordered` >= '$from_date' and `Date_Ordered` <= '$to_date'");
        if($query->num_rows()>0){
            return $query->result();
        }
        else{
            $query = $this->db->query("SELECT * FROM `purchase_searcher` WHERE `Date_Ordered` = '$from_date'");
            if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return $query->result();
            }
            
        }
    }    
       
    public function edit_batch($data){
        $pur_order = array(
            
            'Date_Ordered' => $data['purdate'],
            'employee_id' => 00000001,
            'Date_updated' => $data['update'],
            'total_amount' => $data['tamount'],
            'total_payment' => $data['tpayment'],
            'total_balance' => $data['tbalance'],
            'notes' => $data['notes'],
            );
        $this->db->where('purchase_id',$data['purchase_id']);
        $this->db->update('tbl_purchase_order',$pur_order);
        $count = count($data['supplier_id']);
        for($i=0;$i<$count;$i++){
            $entries[] = array(
                'supplier_id' => $data['supplier_id'][$i],
                'product_id' => $data['product_id'][$i],
                'purchase_id' => $data['purchase_id'],
                'qty_IN' => $data['purchaseqty'][$i],
                'total_amount' => $data['totalsum'][$i],
                'purchase_price' => $data['purchaseprice'][$i],
                'selling_price' => $data['selling-price'][$i],
                'uniqID' => $data['uniqID'][$i],
                );
        }

        $this->db->update_batch('tbl_purchase_detail',$entries,'uniqID');
        $this->db->query('CALL cleanDetail();');

    }
    public function insert_batch($data){
        $pur_order = array(
            'purchase_id' => $data['purchase_id'],
            'Date_Ordered' => $data['purdate'],
            'employee_id' => 00000001,
            'Date_updated' => $data['update'],
            'total_amount' => $data['tamount'],
            'total_payment' => $data['tpayment'],
            'total_balance' => $data['tbalance'],
            'notes' => $data['notes'],
            );
        $count = count($data['supplier_id']);
        for($i=0;$i<$count;$i++){
            $entries[] = array(
                'supplier_id' => $data['supplier_id'][$i],
                'product_id' => $data['product_id'][$i],
                'purchase_id' => $data['purchase_id'],
                'qty_IN' => $data['purchaseqty'][$i],
                'total_amount' => $data['totalsum'][$i],
                'purchase_price' => $data['purchaseprice'][$i],
                'selling_price' => $data['selling-price'][$i],
                'uniqID' => $data['uniqID'][$i],
                );
            
        }
        $this->db->insert('tbl_purchase_order',$pur_order);
        $this->db->insert_batch('tbl_purchase_detail',$entries);
        $this->db->query('CALL cleanDetail();');
        
    
    }
    public function delete_order($purchase_id){
        
        $this->db->where_in('purchase_id',$purchase_id);
        $this->db->delete('tbl_purchase_detail');
        $this->db->where_in('purchase_id',$purchase_id);
        $this->db->delete('tbl_purchase_order');
    }

   
}